<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $db = app('firebase.firestore')->database();
        // $category = $db->collection('Course_category')->documents;
        $courses = $db->collection('Courses');
        $query = $courses->orderBy('created_at', 'DESC');
        // $snapshot = $this->getSnapshot($query);
        // $data = json_decode($snapshot);
        $data = $query->documents();



        return view('admin.course.index', compact('data'));
    }

    // public function getSnapshot($query)
    // {
    //     $json = [];
    //     $snapshot = $query->documents();
    //     foreach ($snapshot as $document) {
    //         if ($document->exists()) {
    //             $d = [];
    //             foreach ($document->data() as $key => $data) {
    //                 if (is_object($data)) {
    //                     $d[$key] = $data->formatAsString();
    //                 } else {
    //                     $d[$key] = $data;
    //                 }
    //             }

    //             $json[] = $d;
    //         }
    //     }
    //     return json_encode($json);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
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
