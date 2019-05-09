<?php

require('vendor/autoload.php');

error_reporting(1);

$curve25519 = new \WhatsAppAPI\Curve_DH\Curve25519();

$ident = new \WhatsAppAPI\Controllers\clientEntity(" Country code", "Phone number without country code", "en", "US");
//clientIdentity(countryCode, Phone number without country code, language, country)
//you need to copy your rc file in sessions folder
try {
	$request = new \WhatsAppAPI\Requests\RegistrationExist($ident);

	$response = (new \WhatsAppAPI\Requests\Request())->request((new \WhatsAppAPI\Constants\InternalConstants())->getC() . "?ENC=" . $request->getEncodedReq());
	echo $response->getBody()->getContents();

} catch (Exception $e) {
	echo "Error Occured: ", $e->getMessage();
}

