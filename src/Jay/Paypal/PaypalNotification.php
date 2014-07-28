<?php

namespace Jay\Paypal;
use Paypaldata;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paypal
 *
 * @author lakhani
 */
class PaypalNotification {

    var $paypal_url;
    var $sendbox;
    var $cmd;

    public function __construct() {
        //set notify validate
        $this->cmd = "_notify-validate";
        //set paypal url
        $this->sendbox = \Config::get("paypal::sendbox");
        if ($this->sendbox) {
            $this->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }
    }

    public function save($input) {
        //check verify
        if ($this->checkVerify($input)) {
//        if (TRUE) {
            list($user, $id) = explode("|", $input['custom']);
            try {
                //check user is exiting or not.
                $user::findOrFail($id);
                $paypal_input = [
                    'status' => $input['payment_status'],
                    'inp_string' => json_encode($input),
                    'customer_id' => $id,
                    'customer_type' => $user,
                ];
                # insert ipn response data in paypaldata table
                $paypal = \Paypaldata::create($paypal_input);
                #run user ipn method ..
                $paypal->customer->ipnProcess();
            } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                //send mail to admin 
            }
        } else {
            //unsuccess
        }
    }

    private function checkVerify($input) {
        //response
        $fields = http_build_query(array('cmd' => $this->cmd) + $input);
        // curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->paypal_url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if errors...
        if (curl_errno($ch)) {
            //$errors = curl_error($ch);
            // close
            curl_close($ch);

            // return
            return false;
        } else {
            // close
            curl_close($ch);

            // if success...
            if ($code == 200 and $response == 'VERIFIED') {
                return true;
            }

            // if NOT success...
            else {
                return false;
            }
        }
    }

}
