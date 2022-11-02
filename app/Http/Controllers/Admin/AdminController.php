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


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admin = app('firebase.firestore')->database();
            $users = $admin->collection('Users');
            $query = $users->where('role', '=', 'Admin');
            $documents = $query->documents();

            $admin = [];
            foreach ($documents as $document) {
                array_push($admin, $document->data());
            }
            $data = collect($admin);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return view('admin.users.admin.partialsTable.account')->with('data', $data);
                })
                ->addColumn('action', function ($data) {
                    $user = app('firebase.auth')->getUser($data['uid']);
                    return view('admin.users.admin.partialsTable.button', compact('data', 'user'));
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
        return view('admin.users.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = app('firebase.firestore')->database()->collection('Users')->document($id)->snapshot();
        return view('admin.users.admin.show', compact('admin'));
    }
}
