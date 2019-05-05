<?php


namespace WhatsAppAPI\Controllers;

use WhatsAppAPI\Curve_DH\Curve25519;


/**
 * Class Curve25519_Controller
 * @package WhatsAppAPI\Controllers
 */
class Curve25519_Controller extends Curve25519 {

	/**
	 * @var $privateKey string
	 */
	protected $privateKey;

	/**
	 * @var $publicKey string
	 */
	protected $publicKey;

	/**
	 * Curve25519_Controller constructor.
	 * @throws \Exception
	 */
	public function __construct() {
		$this->privateKey = random_bytes(32);
		$this->publicKey = $this->publicKey($this->privateKey);

	}

	public function calculateAgreement($serverPublicKey) {
		return $this->sharedKey($this->privateKey, $serverPublicKey);
	}

	/**
	 * @return string
	 */
	public function getPrivateKey() {
		return $this->privateKey;
	}

	/**
	 * @return string
	 */
	public function getPublicKey() {
		return $this->publicKey;
	}




}

