<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            $instructur = app('firebase.firestore')->database();
            $users = $instructur->collection('Users');
            $query = $users->where('role', '=', 'Instruktur');
            $documents = $query->documents();

            $instructur = [];
            foreach ($documents as $document) {
                array_push($instructur, $document->data());
            }
            $data = collect($instructur);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn =  '
                <div class="d-flex gap-2">
                <a href=' . '#' . ' class="btn btn-info"><i class="fas fa-search"></i></a>
                <a href=' . "#" . ' class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                <form method="POST" action=' . "#" . ' id="data-' . "#" . '">
                ' . csrf_field() . '
                <input name="_method" type="hidden" value="DELETE">
                <button type="button" class="btn btn-danger" onclick="confirmDelete(' . '\'' . "#" . '\'' . ')" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
                </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.instructur.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
