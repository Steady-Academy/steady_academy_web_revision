<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uid = Session::get('uid');
        $user = app('firebase.firestore')->database()->collection('Users')->document($uid)->snapshot();
        if ($user->data()['registered'] == true && $user->data()['role'] == 'Admin') {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
