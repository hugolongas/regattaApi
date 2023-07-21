<?php 

namespace App\Services;


use App\Mail\DoubleOptin;

use Illuminate\Support\Facades\Mail;

class MailService{

    public function sendDoubleOptinEmail($email, $token){
        $vue_url = config("vueUrl");
        $vue_url = env("VUE_APP_URL");
        $url = $vue_url."/validate?token=".$token;

        Mail::to($email)->send(new DoubleOptin($url));
    }
}