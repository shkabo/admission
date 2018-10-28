<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        // check if user is active or not
        if ($this->isActive($request)) {
            return $this->guard()->attempt(
                $this->credentials($request), $request->filled('remember')
            );
        }
        throw ValidationException::withMessages([
        $this->username() => [trans('auth.failed')],
    ]);
    }
    public function isActive(Request $request)
    {
        // Check if provided credentials are correct
        $user = User::where('email', $request->input('email'))->first();
        if (!is_null($user) && Hash::check($request->input('password'), $user->password))
        {
            // check if the user is active or not ?
            return $user->active == '1';
        }
        // Bad credentials, nothing to check
        return false;
    }
}
