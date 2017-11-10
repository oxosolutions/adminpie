<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class userApprove extends Mailable
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
        $template_id = json_decode(get_organization_meta('user_notification_template',true));
        $emailTemplate = '';
        $emailLayout = '';
        if($template_id != null || !empty($template_id)){
            $get_template = EmailTemplate::with(['templateMeta'])->where('id',$template_id)->first();
            $emailTemplate = $get_template->toArray();
        }
        if($get_template->templateMeta != null || !empty($get_template->templateMeta)){
            foreach ($get_template->templateMeta as $key => $value) {
                if($value->key == 'layout'){
                    if($value->value != ''){
                        $emailLayout = EmailLayout::where('id',$value->value)->get()->toArray()[0];
                    }
                }
            }
        }
            
        $email = Session::get('approveUser');
        $userEmail = GroupUsers::where('email',$email)->first()['email'];

        return $this->from('oxosolutionsindia@gmail.com')
                ->subject($emailTemplate['subject']) 
                ->view('organization.login.signup-email-template')
                ->with(['emailTemplate' => $emailTemplate,'emailLayout' => $emailLayout ,'userEmail' => $userEmail , 'userName' => $userName]);

    }
}
