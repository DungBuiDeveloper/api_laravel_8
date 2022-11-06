<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $urlReset = env('APP_FE_URL')."/change-password?token=$this->token";
        return $this->markdown('Email.resetPassword')->with([
            'urlReset' => $urlReset
        ]);        
    }
}