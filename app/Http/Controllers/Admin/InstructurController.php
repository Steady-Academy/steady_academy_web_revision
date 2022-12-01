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
use RealRashid\SweetAlert\Facades\Alert;

use Carbon\Carbon;


class InstructurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $instructurs = app('firebase.firestore')->database();
            $users = $instructurs->collection('Users');
            $query = $users->where('role', '=', 'Instruktur')->where('registered', '=', true)->where('is_confirmed', '=', true);
            $documents = $query->documents();

            $instructurs = [];
            foreach ($documents as $document) {
                array_push($instructurs, $document->data());
            }
            $data = collect($instructurs);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return view('admin.users.instructur.partialsTable.account')->with('data', $data);
                })
                ->addColumn('action', function ($data) {
                    $user = app('firebase.auth')->getUser($data['uid']);
                    return view('admin.users.instructur.partialsTable.button', compact('data', 'user'));
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
        return view('admin.users.instructur.index');
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
        $instructur = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        return view('admin.users.instructur.show', compact('instructur'));
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
        $instructur = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        return view('admin.users.instructur.edit', compact('instructur'));
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
                    'telepon' => 'sometimes',
                    'konfirmasi' => 'required',
                    'terdaftar' => 'required',
                    'foto' => 'sometimes',
                ]);

                $properties = [
                    'displayName' => $request->nama,
                    'email' => $request->email,
                ];

                $updateInstructur = $auth->updateUser($id, $properties);

                if ($user->email != $request->email) {
                    $auth->updateUser($id, ['emailVerified' => false]);
                }
                if (!$request->foto) {
                    $request->foto = $request->oldPicture;
                } else {
                    $old = $request->oldPicture;
                    $decode = urldecode($old);
                    $url_token = explode('?', $decode);
                    $url = explode('/', $url_token[0]);
                    $oldPicture = $url[4] . '/' . $url[5] . '/' . $url[6] . '/' . $url[7];
                    $imageDeleted = app('firebase.storage')->getBucket()->object($oldPicture)->delete();

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
                        'registered' => $validate['terdaftar'] == 'true' ? true : false,
                        'is_confirmed' => $validate['konfirmasi'] == 'true' ? true : false,
                    ], ['merge' => true]);
                } else {
                    $db->set([
                        'name' => $validate['nama'],
                        'phoneNumber' => $validate['telepon'],
                        'photoUrl' => $image,
                        'registered' => $validate['terdaftar'] == 'true' ? true : false,
                        'is_confirmed' => $validate['konfirmasi'] == 'true' ? true : false,
                    ], ['merge' => true]);
                }
                toast('Berhasil mengubah ' . $validate['nama'], 'success')->padding('8px');

                return redirect()->route('admin.instructur.index');
            } else {
                $request->validate([
                    'password_baru' => 'required|min:8',
                    'password_confirmation_baru' => 'same:password_baru'
                ]);
                $updateInstructur = $auth->changeUserPassword($id, $request->password_baru);
                toast('Berhasil mengubah password', 'success');
                return redirect()->route('admin.instructur.index');
            }
        } catch (\Exception $e) {
            return back()->withInput();
        }
    }


    public function enable(Request $request, $id)
    {

        $updatedUser = app('firebase.auth')->enableUser($id);

        if ($updatedUser) {
            toast("Instructur berhasil diaktifkan", 'success');
            return redirect()->back();
        } else {
            toast("Instructur gagal diaktifkan", 'danger');
            return redirect()->back();
        }
    }

    public function disabled(Request $request, $id)
    {
        $updatedUser = app('firebase.auth')->disableUser($id);
        if ($updatedUser) {
            toast("Instructur berhasil dinonaktifkan", 'success');
            return redirect()->back();
        } else {
            toast("Instructur gagal dinonaktifkan", 'danger');
            return redirect()->back();
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
        $snapshot = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        $photo = $snapshot->data()['photoUrl'];
        $cv = $snapshot->data()['profile']['dokumen_cv'];

        $decode = urldecode($photo);
        $url_token = explode('?', $decode);
        $url = explode('/', $url_token[0]);
        dd($url);
        $photo = $url[4] . '/' . $url[5] . '/' . $url[6] . '/' . $url[7];
        app('firebase.storage')->getBucket()->object($photo)->delete();

        $decode = urldecode($cv);
        $url_token = explode('?', $decode);
        $url = explode('/', $url_token[0]);
        $cv = $url[4] . '/' . $url[5] . '/' . $url[6] . '/' . $url[7];
        app('firebase.storage')->getBucket()->object($cv)->delete();

        $db = app('firebase.firestore')->database();
        $db->collection('Users')->document($id)->delete();
        if ($db) {
            app('firebase.auth')->deleteUser($id);
            toast("Instructur berhasil dihapus", 'success');
            return redirect()->back();
        } else {
            toast("Instructur gagal dihapus", 'danger');
            return redirect()->back();
        }
    }
}
