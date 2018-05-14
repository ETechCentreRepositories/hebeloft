<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    //this one is the mail function alr
    public function mailto($to, $from, $subject, $message){
        //this one is for the email server to detect if its text or tml and the php version to adjust accordingly.
        $headers = "MIME-Version:1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From" . $from . "\r\n" . "Reply-To" . $from . "\r\n" . "X-Mailer: PHP/" . phpversion();
        // if(mail($to, $subject, $message, $headers){ 
            
        // }
        // else{
        //     //but then we dont have any "alternate flow" so this one i think fuc it lol
        // }
    }
}
