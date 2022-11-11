<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
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
    protected $redirectTo = '/';

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
    protected function login(Request $request)
    {

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($request['email'], $request['password']);
            $user = new User($signInResult->data());

            //uid Session
            $loginuid = $signInResult->firebaseUserId();
            Session::put('uid', $loginuid);

            $db = app('firebase.firestore')->database();
            $snapshot = $db->collection('Users')->document($loginuid)->snapshot();

            if ($snapshot->data()['role'] == 'Instruktur') {
                $result = Auth::login($user);
                $userDetails = app('firebase.auth')->getUser($loginuid);

                // update user data
                $db_users = app('firebase.firestore')->database()->collection('Users')->document($loginuid);
                $db_users->update([
                    ['path' => 'login_at', 'value' => Carbon::now()->toDayDateTimeString()]
                ]);
                return redirect()->route('form.instructur');
            }


            Session::flush();
            return redirect()->back()->with('message', 'Akun kamu tidak memiliki akses ke Steady Instruktur');
        } catch (FirebaseException $e) {
            Session::flash('error', 'email atau password salah!');
            throw ValidationException::withMessages([$this->username() => [trans('auth.failed')],]);
        }
    }
    public function username()
    {
        return 'email';
    }
    public function handleCallback(Request $request, $provider)
    {
        $socialTokenId = $request->input('social-login-tokenId', '');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($socialTokenId);
            $user = new User();
            $user->displayName = $verifiedIdToken->claims()->get('name');
            $user->email = $verifiedIdToken->claims()->get('email');
            $user->localId = $verifiedIdToken->claims()->get('user_id');
            $user->photoUrl = $verifiedIdToken->claims()->get('picture');
            $uid = $user->localId;
            // adding user data
            $db = app('firebase.firestore')->database();
            $snapshot = $db->collection('Users')->document($uid)->snapshot();
            if (!$snapshot->exists()) {
                $db = app('firebase.firestore')->database()->collection('Users')->document($uid);
                $db->set([
                    'uid' => $uid,
                    'name' => $user->displayName,
                    'photoUrl' => $user->photoUrl,
                    'email' => $user->email,
                    'role' => 'Instruktur',
                    'provider' => 'Google',
                    'login_at' => Carbon::now()->toDayDateTimeString(),
                    'phoneNumber' => null,
                    'registered' => false,
                    'created_at' => Carbon::now()->toDayDateTimeString(),
                ]);
            } else if ($snapshot->data()['role'] == 'Student' || $snapshot->data()['role'] == 'Admin') {
                Session::flush();
                return redirect()->back()->with('message', 'Akun kamu tidak memiliki akses ke Steady Instruktur');
            }
            Session::put('uid', $uid);
            Auth::login($user);
            return redirect()->route('form.instructur');
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('login');
        } catch (InvalidToken $e) {
            return redirect()->route('login');
        }
    }
}
