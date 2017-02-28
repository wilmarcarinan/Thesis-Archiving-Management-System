<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'StudentID' => 'required|max:255|unique:users',
            'FirstName' => 'required|max:255',
            'MiddleName' => 'required|max:255',
            'LastName' => 'required|max:255',
            'Course' => 'required|max:255',
            'College' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'StudentID' => $data['StudentID'],
            'FirstName' => $data['FirstName'],
            'MiddleName' => $data['MiddleName'],
            'LastName' => $data['LastName'],
            'Course' => $data['Course'],
            'College' => $data['College'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if(Auth::check()){
            $log = new Log;

            $log->Subject = 'Register';
            $log->Details = Auth::user()->FirstName.' '.Auth::user()->MiddleName.' '.Auth::user()->LastName.' [User] has been registered.';
            $log->student_id = Auth::id();

            $log->save();

            $log = new Log;

            $log->Subject = 'Login';
            $log->Details = Auth::user()->FirstName.' '.Auth::user()->MiddleName.' '.Auth::user()->LastName.' [User] has been logged in.';
            $log->student_id = Auth::id();

            $log->save();
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('status','You have now been registered!');
    }
}
