<?php

namespace SCF\Http\Controllers\Auth;

use Mail;
use SCF\Models\User;
use Illuminate\Http\Request;
use SCF\Mail\AccountCreated;
use SCF\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|string|max:50',
            'lastName'  => 'required|string|max:50',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \SCF\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['firstName'] . ' ' . $data['lastName'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user, $request->input('remember'));

        return $this->registered($request, $user)
            ? : redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed                    $user
     *
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->generateConfirmationCode($request);

        return [
            'redirect' => redirect()->intended()->getTargetUrl()
        ];
    }
}
