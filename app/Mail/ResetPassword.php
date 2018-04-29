<?php

namespace SCF\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use SCF\Models\User;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User instance.
     *
     * @var User
     */
    public $user;

    /**
     * Token code.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account.reset-password');
    }
}
