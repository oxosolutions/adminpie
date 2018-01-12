<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Organization\AssignDocument;
class DocumentAssigned extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($document_id)
    {
        $this->document_id = $document_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->from('oxosolutionsasr@gmail.com','OXO Solutions Pvt Ltd.')->subject('Document Assigned')->view('organization.emails.document_assigned');
    }
}
