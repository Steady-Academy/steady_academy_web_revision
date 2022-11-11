<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Session;

class HomeComposer
{
    public function compose(View $view)
    {
        $uid = Session::get('uid');
        if ($uid) {
            $snapshot = app('firebase.firestore')->database()->collection('Users')->document($uid)->snapshot();
            $user = $snapshot->data();
            $view->with('user', $user);
        }
    }
}
