<?php

// app/Mail/ForgotPasswordMail.php

// app/Mail/ForgotPasswordMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newPassword;

    // Constructor to pass the new password to the email
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->view('forgot-password-content')
                    ->with('password', $this->newPassword);
    }
}

