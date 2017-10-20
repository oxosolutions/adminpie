<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Organization\User;
use Session;
use App\Model\Group\GroupUsers ;

class userRegister extends Mailable
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
        $email = Session::get('new_user_register_email');
        $name = Session::put('new_user_register_name');

        $email = GroupUsers::where('email',$email)->first();
        $name = GroupUsers::where('email',$name)->first();
            return $this->from('oxosolutionsindia@gmail.com')
                    ->subject('New User Register')
                    ->view('organization.login.signup-email-template')
                    ->with(['email' => $email , 'name' => $name]);
    }
}
