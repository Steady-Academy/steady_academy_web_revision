<?php

namespace App\Http\Controllers\Instructur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructurStudentController extends Controller
{
    public function index(Request $request)
    {

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
                    return view('instructur.users.student.partialsTable.account')->with('data', $data);
                })
                ->addColumn('action', function ($data) {
                    $user = app('firebase.auth')->getUser($data['uid']);
                    return view('instructur.users.student.partialsTable.button', compact('data', 'user'));
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
        return view('instructur.users.student.index');
    }
}
