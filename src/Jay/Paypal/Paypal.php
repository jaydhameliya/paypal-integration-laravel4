<?php

namespace Jay\Paypal;
use \URL;
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
class Paypal {

    var $form_action;
    var $cmd;
    var $sendbox;
    var $config;

    public function __construct() {
        $this->config = array_except(\Config::get("paypal::config"), array('sendbox', 'cmd'));
        $this->cmd = \Config::get("paypal::cmd");
        $this->sendbox = \Config::get("paypal::sendbox");
        if ($this->sendbox) {
            $this->form_action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $this->form_action = 'https://www.paypal.com/cgi-bin/webscr';
        }
    }

    public function send($attributes, PaypalInterface $user) {
        $custom = get_class($user) . '|' . $user->id;

        echo '<form action="' . $this->form_action . '" method="post" name="payment_form"> ';
        echo '<input type="hidden" name="cmd" value="' . $this->cmd . '" />';
        echo '<input type="hidden" name="custom" value="' . $custom . '" />';
        echo '<input type="hidden" name="notify_url" value="' . URL::to('paypal/ipn') . '" />';
        $configs = array_filter($this->config);
        foreach ($configs as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
        }
        foreach ($attributes as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
        }

        echo '</form>';
        echo '<script>';
        echo 'document.forms["payment_form"].submit();';
        echo '</script>';
    }

    public function setCmd($value) {
        $this->cmd = $value;
        return $this;
    }

}
