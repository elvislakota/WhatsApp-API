<?php

namespace WhatsAppAPI\Controllers;

/**
 * Class GCM_BlockEngine
 * @package WhatsAppAPI\Controllers
 */
/**
 * Class GCM_BlockEngine
 * @package WhatsAppAPI\Controllers
 */
class GCM_BlockEngine {

	/**
	 * @var string
	 */
	protected $keyAgreement;

	/**
	 * @var string
	 */
	protected $IV;

	/**
	 * @var bool|string
	 */
	protected $zeroByte ;

	/**
	 * @var $userPublicKey string
	 */
	protected $userPublicKey;

	/**
	 * GCM_BlockEngine constructor.
	 * @param string $keyAgreement
	 * @param string $userPublicKey
	 */
	public function __construct( $keyAgreement, $userPublicKey) {
		$this->keyAgreement = $keyAgreement;
		$this->userPublicKey =  $userPublicKey;
		$this->IV = base64_decode('AAAAAAAAAAAAAAAAsd');
		$this->zeroByte = base64_decode('sd');
	}

	/**
	 * @param $encQuery string
	 *
	 * @return string
	 */
	public function encryptExistRequest($encQuery){
		$TAG = null;


		$encrypted = openssl_encrypt($encQuery, 'aes-128-gcm', $this->keyAgreement, 0,$this->IV, $ta, $this->zeroByte);
		return $this->userPublicKey . $encrypted;
	}
}
