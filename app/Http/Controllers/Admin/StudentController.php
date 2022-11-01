<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
use Kreait\Auth\Request\UpdateUser;
use Kreait\Firebase\Exception\FirebaseException;

use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $test = $data->toJson();
        // dd(DataTables::of($data));
        // dd($data->all());


        if ($request->ajax()) {
            $students = app('firebase.firestore')->database();
            $users = $students->collection('Users');
            $query = $users->where('role', '=', 'Student');
            $documents = $query->documents();

            $students = [];
            foreach ($documents as $document) {
                array_push($students, $document->data());
            }
            $data = collect($students);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return view('admin.users.student.partialsTable.account')->with('data', $data);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.users.student.partialsTable.button')->with('data', $data);
                })
                ->editColumn('phoneNumber', function ($data) {
                    if (!$data['phoneNumber']) {
                        return $data['phoneNumber'] = "--- ---- --- ----";;
                    } else {
                        return $data['phoneNumber'];
                    }
                })
                ->editColumn('login_at', function ($data) {
                    $date = Carbon::parse($data['login_at'])->locale('id');
                    $date->settings(['formatFunction' => 'translatedFormat']);
                    $login_at = $date->format('l, j F Y  h:i a');
                    return $login_at;
                })
                ->editColumn('created_at', function ($data) {
                    $date = Carbon::parse($data['created_at'])->locale('id');
                    $date->settings(['formatFunction' => 'translatedFormat']);
                    $created_at = $date->format('l, j F Y  h:i a');
                    return $created_at;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('admin.users.student.index');
    }

    protected function rules(Request $request)
    {
        if (filter_var($request->foto, FILTER_VALIDATE_URL)) {
            return [
                'foto' => 'sometimes',
            ];
        } else {
            return [
                'foto' => 'required|image|mimes:jpg,png,jpeg,svg|max:1024',
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $uid = Session::get('uid');
        $student = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        return view('admin.users.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auth = app('firebase.auth');
        $user = $auth->getUser($id);
        try {
            if ($request->password_baru == '' && $request->password_confirmation_baru == '') {
                $validate = $request->validate([
                    'nama' => 'required|string',
                    'email' => 'required|email:dns',
                    'telepon' => 'nullable',
                    'konfirmasi' => 'required',
                    'terdaftar' => 'required',
                    'foto' => 'sometimes',
                ]);

                $properties = [
                    'displayName' => $request->nama,
                    'email' => $request->email,
                ];

                $updateStudent = $auth->updateUser($id, $properties);

                if ($user->email != $request->email) {
                    $auth->updateUser($id, ['emailVerified' => false]);
                }
                if (!$request->foto) {
                    $request->foto = $request->oldPicture;
                } else {
                    $getProfile = $validate['foto'];
                    $firebase_storage_path_profile = 'Users/' . $id . '/Profile/';
                    $name = $id;
                    $localfolder = public_path('storage/users/' . $id) . '/Profile/';
                    $extension = $validate['foto']->getClientOriginalExtension();
                    $profile = $name . '.' . $extension;
                    if ($getProfile->storeAs('public/users/' . $id . '/Profile/', $profile)) {
                        $uploadedfile = fopen($localfolder . $profile, 'r');
                        app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_profile . $profile]);
                        unlink($localfolder . $profile);
                    }
                    $expiresAt = new \DateTime('20-12-2222');
                    $imageReference = app('firebase.storage')->getBucket()->object($firebase_storage_path_profile . $profile);
                    if ($imageReference->exists()) {
                        $image = $imageReference->signedUrl($expiresAt);
                    }
                }
                // add data to firestore
                $db = app('firebase.firestore')->database()->collection('Users')->document($user->uid);
                if ($request->foto == $request->oldPicture) {
                    $db->set([
                        'name' => $validate['nama'],
                        'phoneNumber' => $validate['telepon'],
                        'photoUrl' => $request->foto,
                        'registered' => $validate['terdaftar'],
                        'is_confirmed' => $validate['konfirmasi'],
                    ], ['merge' => true]);
                } else {
                    $db->set([
                        'name' => $validate['nama'],
                        'phoneNumber' => $validate['telepon'],
                        'photoUrl' => $image,
                        'registered' => $validate['terdaftar'],
                        'is_confirmed' => $validate['konfirmasi'],
                    ], ['merge' => true]);
                }

                return redirect()->route('admin.student.index');
            } else {
                $request->validate([
                    'password_baru' => 'required|min:8',
                    'password_confirmation_baru' => 'same:password_baru'
                ]);
                $updateStudent = $auth->changeUserPassword($id, $request->password_baru);
                return redirect()->route('admin.student.index');
            }
        } catch (\Exception $e) {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
