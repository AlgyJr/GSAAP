<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC101ac118177efa351db8d83a8d59e651';
$auth_token = 'a724bc4cc2d546d0da34a13f97a9f3c0';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+16466792405";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    $number,
    array(
        'from' => $twilio_number,
        'body' => $msg
    )
);
