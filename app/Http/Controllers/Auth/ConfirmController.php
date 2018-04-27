<?php

namespace SCF\Http\Controllers\Auth;

use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ConfirmController extends Controller
{
    /**
     * ConfirmController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Attempts a confirmation.
     *
     * @param Request $request
     *
     * @return array
     * @throws \Exception
     */
    public function attemptConfirmation(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|digits:6'
        ]);

        if ($request->session()->get('confirmation_code') == $request->input('code')) {
            $request->session()->remove('confirmation_code');

            $request->user()->verified();

            return [
                'redirect' => route('home')
            ];
        }

        throw ValidationException::withMessages([
            'code' => ['Invalid code']
        ]);
    }

    /**
     * Resend confirmation to user.
     *
     * @param Request $request
     *
     * @return array
     */
    public function resendConfirmation(Request $request)
    {
        $user = $request->user();

        if ($user->verified == false) {
            $user->generateConfirmationCode($request);

            return ['status' => 'success'];
        }

        abort(403, 'Invalid action');
    }
}
