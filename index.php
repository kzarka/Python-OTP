<?php
require_once __DIR__ . '/vendor/autoload.php'; 

use OTPHP\TOTP;

// A random secret will be generated from this.
// You should store the secret with the user for verification.
const SECRET_KEY = 'KNCUGUSFKRPUGT2EIU======';
$otp = TOTP::create(
    SECRET_KEY, // Let the secret be defined by the class
    30,     // The period (30 seconds)
    'sha512', // The digest algorithm
    6      // The output will generate 6 digits
);

$otpContent = $otp->now();

$otpFromApp = !empty($_REQUEST['otp']) ? $_REQUEST['otp'] : '';
$message = 'Matched';
if ($otpFromApp != $otpContent) {
    $message = 'Invalid OTP';
}

echo json_encode(['message' => $message, 'OTP' => $otpContent, 'APP_OTP' => $otpFromApp]);die;