<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Organization\User;
use Session;

class forgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $model = User::where('remember_token',Session::get('reset_token'))->first();
        return $this->from('oxosolutionsindia@gmail.com')
                    ->subject('Reset Password')
                    ->view('organization.login.reset-email-template')
                    ->with(['model' => $model]);
    }
}
