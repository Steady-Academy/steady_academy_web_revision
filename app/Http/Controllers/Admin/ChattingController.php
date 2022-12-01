<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class ChattingController extends Controller
{


    public function index()
    {
        try {
            $uid = Session::get('uid');
            $fireauth = app('firebase.auth');
            $firestore = app('firebase.firestore')->database();
            $firerealtime = app('firebase.database');
            $users = [];

            $currentUser = $fireauth->getUser($uid);
            $userAdmin = $firestore->collection('Users')->where('role', '=', 'Admin')->documents();
            foreach ($userAdmin as $user) {
                $claims = $fireauth->getUser($user->data()['uid'])->customClaims;
                if (in_array('Admin', $claims)) {
                    $users = $fireauth->getUser($user->data()['uid']);
                }
            }
            // $firerealtime->getReference('messages');

            $messageUser = NULL;
            return view('admin.chatting.index', compact('userAdmin', 'currentUser', 'messageUser', 'users'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update(Request $request, $messageID)
    {
        try {
            $uid = Session::get('uid');
            $fireauth = app('firebase.auth');
            $firestore = app('firebase.firestore')->database();
            $firerealtime = app('firebase.database');
            $users = [];
            $ids = $uid . "_" . $messageID;

            // $firerealtime->getReference('messages/' . $ids)->getSnapshot();
            // dd($firerealtime);

            $currentUser = $fireauth->getUser($uid);
            $userAdmin = $firestore->collection('Users')->where('role', '=', 'Admin')->documents();
            foreach ($userAdmin as $user) {
                $claims = $fireauth->getUser($user->data()['uid'])->customClaims;
                if (in_array('Admin', $claims)) {
                    $users = $fireauth->getUser($user->data()['uid']);
                }
            }
            $messageUser = $fireauth->getUser($messageID);
            return view('admin.chatting.index', compact('currentUser', 'userAdmin', 'messageUser', 'users'));
        } catch (\Exception $e) {
            return $e;
        }
    }
}
