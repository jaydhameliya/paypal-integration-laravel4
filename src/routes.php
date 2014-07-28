<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::post("paypal/ipn", function() {
    $notification = new \Jay\Paypal\PaypalNotification();
    $input = Input::all();
    $notification->save($input);
});
