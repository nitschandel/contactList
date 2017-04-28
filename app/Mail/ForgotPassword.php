<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $changePasswordLink;

    public function __construct(User $user)
    {
        $this->changePasswordLink = $user->link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Reset your password")
                    ->view('auth.passwords.forgotPasswordEmail')
                    ->with('changePasswordLink', $this->changePasswordLink);
    }
}
