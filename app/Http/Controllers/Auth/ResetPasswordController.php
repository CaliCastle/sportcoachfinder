<?php

namespace SCF\Http\Controllers\Auth;

use Illuminate\Validation\ValidationException;
use SCF\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null              $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm($token = null, $email)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse($response)
    {
        return [
            'status'   => trans($response),
            'redirect' => url($this->redirectTo)
        ];
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string                   $response
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        throw ValidationException::withMessages([
            'email' => trans($response)
        ]);
    }
}
