<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \URL;
return array(
    /**
     * specify senbox is use or not 
     * value 
     *      true, false
     */
    "sendbox" => true,
    /**
     * Paypal Murtund Account Id
     */
    "business" => 'example@example.com', 
    /**
     * Currency Code  
     *  Value :-
     *          USD,AUD,CAD etc..
     */
    "currency_code" => "USD",
    /**
     * Paypal Process Command
     * Value:- 
     *       _xclick                 'Buy Now Button'   
     *      _cart                    'For shopping cart purchases'
     *      _oe-gift-certificate     'Buy Gift Certificate button'
     *      _xclick-subscriptions    'Subscribe button'
     *      _xclick-auto-billing     'Automatic Billing button'
     *      _xclick-payment-plan     'Installment Plan button'
     *      _donations               'Donate button'
     *      _s-xclick                'protected from tampering by using encryption'   
     */
    "cmd" => "_xclick",
    /**
     * Image Path Of Your Site
     */
    "image_url" => '',
    /**
     * display Cancel Url
     */
    "cancel_return" => URL::to("payment/cancel"),
    /**
     * Conplete Trasection After Redirect This page.
     */
    "return" => URL::to("payment/success"),
    /**
     * No Shipping Address Display.
     * Value :- '0' or '1'
     */
    "no_shipping" => '1',
    /**
     * Sets the language for the billing information/log-in page only
     * Default is 'US'
     * Reffer liki :- https://developer.paypal.com/docs/classic/api/country_codes/#CountryCodes_id083SG0U0OY4
     */
    "lc" => 'US',
    /**
     * Sets the character set and character encoding for the billing information/log-in page
     */
    "charset" => "utf-8",
);
