<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Auth;
use Session;
use App\Models\User;

class LoginController extends Controller
{
    /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $auth;
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FirebaseAuth $auth)
    {
        $this->middleware('guest')->except('logout');
        $this->auth = $auth;
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'g-recaptcha-response' => 'recaptcha',
        ]);
    }

    protected function login(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
                'g-recaptcha-response' => 'recaptcha',
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withInput()->withErrors($validate);
            }

            $signInResult = $this->auth->signInWithEmailAndPassword($request['email'], $request['password']);
            $user = new User($signInResult->data());

            //uid Session
            $loginuid = $signInResult->firebaseUserId();
            Session::put('uid', $loginuid);

            $db = app('firebase.firestore')->database();
            $snapshot = $db->collection('Users')->document($loginuid)->snapshot();
            if ($snapshot->data()['role'] == 'Admin') {
                $result = Auth::login($user);
                $userDetails = app('firebase.auth')->getUser($loginuid);

                // update user data

                $db_users = app('firebase.firestore')->database()->collection('Users')->document($loginuid);
                $db_users->update([
                    ['path' => 'login_at', 'value' => Carbon::now()->toDayDateTimeString()]
                ]);
                return redirect($this->redirectPath());
            }
            Session::flush();
            return redirect()->back()->with('message', 'Akun kamu tidak memiliki akses ke Steady Admin');
        } catch (FirebaseException $e) {
            Session::flash('error', 'email atau password salah!');
            throw ValidationException::withMessages([$this->username() => [trans('auth.failed')],]);
        }
    }
    public function username()
    {
        return 'email';
    }
}
