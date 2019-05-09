<?php

namespace WhatsAppAPI\Controllers;

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
	 * @var $userPublicKey string
	 */
	protected $userPublicKey;

	/**
	 * GCM_BlockEngine constructor.
	 * @param string $keyAgreement
	 * @param string $userPublicKey
	 */
	public function __construct($keyAgreement, $userPublicKey) {
		$this->keyAgreement = $keyAgreement;
		$this->userPublicKey = $userPublicKey;
	}

	/**
	 * @param $encQuery string
	 *
	 * @return string
	 */
	public function encryptExistRequest($encQuery) {
		$jarFileName = dirname(__DIR__).'\\java_exec\\PHP_Encrypt_helper.jar';

		$data = "encryptExistRequest " . base64_encode($this->keyAgreement) . " " . base64_encode($this->userPublicKey) . " " . base64_encode($encQuery);
		$aesN = shell_exec("java -jar " . $jarFileName . " " . $data);
		return $aesN;
	}


}
