<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->with('username', $this->data['username'])
                    ->with('email', $this->data['email'])
                    ->with('link', $this->data['link'])
                    ->subject('【おもてなし学検定事務局】メールアドレス認証のお願い')
                    ->view('mail.web.register');
        

    }

}