<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Session;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

    use RegistersUsers;
    protected $auth;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'instruktur/formulir';
    public function __construct(FirebaseAuth $auth)
    {
        $this->middleware('guest');
        $this->auth = $auth;
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telepon' => ['required', 'digits_between:11,13', 'min:11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function register(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            $userProperties = [
                'email' => $request->input('email'),
                'emailVerified' => false,
                'password' => $request->input('password'),
                'displayName' => $request->input('nama'),
                'telepon' => $request->input('telepon'),
                'disabled' => false,
                'photoUrl' => 'https://avatars.dicebear.com/api/human/' . str_replace(' ', '_', $request->input('nama')) . '.svg?b=white&r=50&size=150',
            ];

            $createdUser = $this->auth->createUser($userProperties);

            $db = app('firebase.firestore')->database()->collection('Users')->document($createdUser->uid);
            $db->set([
                'uid' => $createdUser->uid,
                'name' => $createdUser->displayName,
                'photoUrl' => 'https://avatars.dicebear.com/api/human/' . str_replace(' ', '_', $request->input('nama')) . '.svg?b=white&r=50&size=150',
                'email' => $request->input('email'),
                'role' => 'Instruktur',
                'phoneNumber' => $request->input('telepon'),
                'provider' => 'Email dan password',
                'registered' => false,
                'created_at' => Carbon::now()->toDayDateTimeString(),
            ]);


            return redirect()->route('login')->with('success', 'Berhasil mendaftar, silahkan masuk untuk verifikasi.');
        } catch (FirebaseException $e) {
            Session::flash('error', 'Email telah digunakan oleh akun lain');
            return back()->withInput();
        }
    }
}
