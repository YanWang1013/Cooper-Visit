<?php


namespace App\Http;

use App\Settings;
use Twilio\Rest\Client;

class Utils
{

    static public function sendSmsForVerify($phone_number, $verify_code) {

        $twilio_sid = Settings::where('key', 'twilio_sid')->first();
        $twilio_token = Settings::where('key', 'twilio_token')->first();
        $twilio_trial_number = Settings::where('key', 'twilio_trial_number')->first();

        if (isset($twilio_sid)) {
            $twilio_sid=$twilio_sid->value;
        } else {
            $twilio_sid='';
        }

        if (isset($twilio_token)) {
            $twilio_token=$twilio_token->value;
        } else {
            $twilio_token='';
        }
        if (isset($twilio_trial_number)) {
            $twilio_trial_number=$twilio_trial_number->value;
        } else {
            $twilio_trial_number='';
        }

        $twilio = new Client($twilio_sid, $twilio_token);

        $message = $twilio->messages
            ->create($phone_number, // to
                array(
                    "from"=>$twilio_trial_number,
                    "body"=>"Verify Code:" . $verify_code
                )
            );

        return response()->json([
            'result'=>$message->sid
        ]);
    }

    static public function paypalfee($amount) {
        $amount_val = (double) $amount;
        return round($amount_val*0.039+0.3,2);
    }

}