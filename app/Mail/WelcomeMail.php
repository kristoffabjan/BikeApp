<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    

    public function __construct() {
        // allocate your stuff
    }

    public static function user(User $user ) {
        $instance = new self();
        $instance->$user = $user;
        return $instance;
    }

    public static function no_user() {
        $instance = new self();
        return $instance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome mail')
                    ->markdown('emails.welcome_mail')
                    ->from('bikefinder24@gmail.com', 'BikeFinder');
    }
}
