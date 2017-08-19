<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Organization\EmailLayout;
use App\Model\Organization\EmailTemplate;
class CampaignEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $layout;
    private $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($layout,$template)
    {
        $this->layout = $layout;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $layoutHTML = EmailLayout::find($this->layout);
        $templateHTML = EmailTemplate::find($this->template);
        return $this->view('common.template-renderer',['layout'=>$layoutHTML,'template'=>$templateHTML])->subject($templateHTML->subject);
    }
}
