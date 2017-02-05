<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use Illuminate\Validation\Rule;

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
        $this->middleware('guest', ['except' => 'logout']);
    }
	
	public function username(){
		return 'StudentID';
	}

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    protected function authenticated()
    {
        if(Auth::check()){
            $log = new Log;

            $log->Subject = 'Login';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->LastName."[".Auth::user()->Role."] has logged in.";
            $log->student_id = Auth::id();

            $log->save();
        }

        return redirect()->intended('home');
    }

    public function logout(Request $request)
    {
        if( Auth::check()){
            $log = new Log;

            $log->Subject = 'Logout';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->LastName."[".Auth::user()->Role."] has logged out.";
            $log->student_id = Auth::id();

            $log->save();
        }        

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => [
            'required',
            Rule::exists('users')->where(function ($query) {
                $query->where('Status', 'Active');
            }),
            ], 
            'password' => 'required',
        ]);
    }
}
