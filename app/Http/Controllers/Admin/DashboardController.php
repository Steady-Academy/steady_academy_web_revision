<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $firestore = app('firebase.firestore')->database();

        // users
        $students = $firestore->collection('Users')->where('role', '=', 'Student')->documents();
        $totalStudents = count(collect($students));
        $instructurs = $firestore->collection('Users')->where('role', '=', 'Instruktur')->documents();
        $totalInstructurs = count(collect($instructurs));
        $courses = $firestore->collection('Courses')->documents();
        $totalCourses = count(collect($courses));

        $currentStudents = $totalStudents > 0 ? $totalStudents / 2 : $totalStudents = 1;
        $newStudents = $currentStudents / $totalStudents;

        $currentInstructurs = $totalInstructurs > 0 ? $totalInstructurs / 2 : $totalInstructurs = 1;
        $newInstructurs = $currentInstructurs / $totalInstructurs;

        $currentCourses = $totalCourses > 0 ? $totalCourses / 2 : $totalCourses = 1;
        $newCourses = $currentCourses / $totalCourses;

        // categories
        $categories = $firestore->collection('Category_course')->documents();
        $dataCategories = [];
        foreach ($categories as $key => $value) {
            array_push($dataCategories, $value->data()['name']);
        }
        $categoryName = json_encode($dataCategories);

        // request
        $requestInstructurs = $firestore->collection('Users')->where('role', '=', 'Instruktur')->where('registered', '=', true)->where('is_confirmed', '=', false)->limit(4)->documents();


        return view('admin.dashboard', compact([
            'totalStudents',
            'totalInstructurs',
            'totalCourses',
            'newStudents',
            'newInstructurs',
            'newCourses',
            'categoryName',
            'requestInstructurs'
        ]));
    }
}
