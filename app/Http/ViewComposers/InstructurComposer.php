<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Session;

class InstructurComposer
{
    public function compose(View $view)
    {
        $uid = Session::get('uid');
        if ($uid) {
            $snapshot = app('firebase.firestore')->database()->collection('Users')->document($uid)->snapshot();
            $user = $snapshot->data();

            // $instructur = app('firebase.firestore')->database();
            // $users = $instructur->collection('Users');
            // $query = $users->where('role', '=', 'Instruktur')->where('registered', '=', true)->where('is_confirmed', '=', false)->limit(5);
            // $documents = $query->documents();
            // $notif = collect($documents);

            // $instructur = [];
            // foreach ($documents as $document) {
            //     array_push($instructur, $document->data());
            // }
            // $notif = collect($instructur);

            $view->with(['user' => $user]);
        }
    }
}
