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


class RequestInstructurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $req_instructur = app('firebase.firestore')->database();
            $users = $req_instructur->collection('Users');
            $query = $users->where('role', '=', 'Instruktur')->where('registered', '=', true)->where('is_confirmed', '=', false);
            $documents = $query->documents();

            $req_instructur = [];
            foreach ($documents as $document) {
                array_push($req_instructur, $document->data());
            }
            $data = collect($req_instructur);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return view('admin.request.partialsTable.account')->with('data', $data);
                })
                ->addColumn('action', function ($data) {
                    $user = app('firebase.auth')->getUser($data['uid']);
                    return view('admin.request.partialsTable.button', compact('data', 'user'));
                })
                ->editColumn('phoneNumber', function ($data) {
                    if (!$data['phoneNumber']) {
                        return $data['phoneNumber'] = "--- ---- --- ----";;
                    } else {
                        return $data['phoneNumber'];
                    }
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
        return view('admin.request.index');
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
        $req_instructur = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        return view('admin.request.show', compact('req_instructur'));
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
        $req_instructur = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        return view('admin.request.edit', compact('req_instructur'));
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

                $updateInstructur = $auth->updateUser($id, $properties);

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

                return redirect()->route('admin.request.index');
            } else {
                $request->validate([
                    'password_baru' => 'required|min:8',
                    'password_confirmation_baru' => 'same:password_baru'
                ]);
                $updateReqRequest = $auth->changeUserPassword($id, $request->password_baru);
                toast('Berhasil mengubah password', 'success');
                return redirect()->route('admin.request.index');
            }
        } catch (\Exception $e) {
            return back()->withInput();
        }
    }


    public function approve(Request $request, $id)
    {
        $db = app('firebase.firestore')->database()->collection('Users')->document($id);
        $approve = $db->set([
            'is_confirmed' => true,
        ], ['merge' => true]);
        if ($approve) {
            toast("User telah menjadi instructur", 'success');
            return redirect()->back();
        }
        toast("User gagal menjadi instructur", 'success');
        return redirect()->back();
    }

    public function disabled(Request $request, $id)
    {
        $updatedUser = app('firebase.auth')->disableUser($id);
        if ($updatedUser) {
            $db = app('firebase.firestore')->database()->collection('Users')->document($id);
            $disable = $db->set([
                'registered' => false,
                'is_confirmed' => false,
            ], ['merge' => true]);
            toast("Instructur berhasil dinonaktifkan", 'success');
            return redirect()->back();
        }
        toast("Instructur gagal dinonaktifkan", 'danger');
        return redirect()->back();
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $db = app('firebase.firestore')->database();
    //     $db->collection('Users')->document($id)->delete();
    //     if ($db) {
    //         app('firebase.auth')->deleteUser($id);
    //         toast("Instructur berhasil dihapus", 'success');
    //         return redirect()->back();
    //     } else {
    //         toast("Instructur gagal dihapus", 'danger');
    //         return redirect()->back();
    //     }
    // }
}
