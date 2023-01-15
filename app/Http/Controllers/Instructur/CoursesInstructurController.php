<?php

namespace App\Http\Controllers\Instructur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CoursesInstructurController extends Controller
{
    public function index()
    {
        $db = app('firebase.firestore')->database();
        $uid = Session::get('uid');

        $user = $db->document('Users/' . $uid);
        $courses = $db->collection('Courses');
        $query = $courses->where('instructur', '=', $user);
        $data = $query->documents();

        return view('instructur.course.index', compact('data'));
    }

    public function show($id)
    {
        $course = app('firebase.firestore')->database()->collection('Courses')->document($id)->snapshot();
        return view('instructur.course.show', compact('course'));
    }
}
