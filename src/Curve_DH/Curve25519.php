<?php

namespace WhatsAppAPI\Curve_DH;

class Curve25519 {

	public function generatePrivateKey() {
		return random_bytes(32);
	}

	public function generatePublicKey($privateKey) {
		return sodium_crypto_scalarmult_base($privateKey);
	}

	public function calculateAgreement($privateKey, $serverPublicKey) {
		return sodium_crypto_scalarmult($privateKey, $serverPublicKey);
	}
}
