<?php

namespace WhatsAppAPI\Requests;

use Ramsey\Uuid\Uuid;
use WhatsAppAPI\Constants\Constants;
use WhatsAppAPI\Constants\InternalConstants;
use WhatsAppAPI\Controllers\client_ID_Controller;
use WhatsAppAPI\Controllers\clientEntity;
use WhatsAppAPI\Controllers\Curve25519_Controller;
use WhatsAppAPI\Controllers\GCM_BlockEngine;
use WhatsAppAPI\Controllers\token_Generator_Controller;
use WhatsAppAPI\Curve_DH\Curve25519;

/**
 * Class RegistrationExist
 * @package WhatsAppAPI\Requests
 */
class RegistrationExist {

	/**
	 * @var $clientEntity clientEntity
	 */
	protected $clientEntity;
	/**
	 * @var $id string
	 */
	protected $id;
	/**
	 * @var $token string
	 */
	protected $token;

	/**
	 * @var int $mistyped
	 */
	protected $mistyped = 6;
	/**
	 *
	 * @var string $offline_ab_exposure
	 */
	protected $offline_ab_exposure = '';

	/**
	 * @var $uuid string
	 */
	protected $uuid;

	/**
	 * @var $expid string
	 */
	protected $expid;

	/**
	 * See "Network Types.txt" under /src/Constants/
	 *
	 * @var int $network_radio_type
	 */
	protected $network_radio_type = 1;

	/**
	 * @var $simnum int
	 */
	protected $simnum = 1;

	/**
	 * If the rc2 file is present then this is 1
	 * otherwise 0
	 *
	 * @var int $hasinrc
	 */
	protected $hasinrc = 1;

	/**
	 * Process ID
	 *
	 * @var int $pid
	 */
	protected $pid = 3400;

	/**
	 * More info in RC_Info.txt under /src/Constants/
	 *
	 * @var int $rc
	 */
	protected $rc = 0;

	/**
	 * WhatsApp server Public Key Base64 Encoded
	 *
	 * @var string $serverPublicKey
	 */
	protected $serverPublicKey = 'jowPdMPrxdemhlxsPIQ4VrBhIczo6ndNIvtvEiUSMC0=';

	/**
	 * @var string
	 */
	protected $encodedReq = "";

	/**
	 * RegistrationExist constructor.
	 * @param $clientEntity clientEntity
	 *
	 * @throws \Exception
	 */
	public function __construct($clientEntity) {
		$this->clientEntity = $clientEntity;
		$client_id_Controller = new client_ID_Controller($clientEntity);
		$token_controller = new token_Generator_Controller($clientEntity);
		$uuid4 = Uuid::uuid4();


		$this->id = $client_id_Controller->__encryptID();
		$this->token = $token_controller->encodeToken();
		$this->uuid = $uuid4->toString() . $this->bchexdec($uuid4->getMostSignificantBitsHex()) . $this->bchexdec($uuid4->getLeastSignificantBitsHex());
		$this->expid = base64_encode($this->uuid);

		$curve25519 = new Curve25519();

		$privateKey = $curve25519->generatePrivateKey();
		$publicKey = $curve25519->generatePublicKey($privateKey);

		$serverPublicKey = base64_decode('jowPdMPrxdemhlxsPIQ4VrBhIczo6ndNIvtvEiUSMC0=');


		$keyAgreement = $curve25519->calculateAgreement($privateKey, $serverPublicKey);
		$GCM = new GCM_BlockEngine($keyAgreement, $publicKey);

		$query = $this->build_http_query();

		$this->encodedReq = $GCM->encryptExistRequest($query);

	}

	/**
	 * @return string
	 */
	public function getEncodedReq() {
		return $this->encodedReq;
	}

	/**
	 * Builds an http query string.
	 * @return string       // http query string.
	 **/
	function build_http_query() {

		$query = [
			"cc" => $this->clientEntity->getCc(),
			"in" => $this->clientEntity->getIn(),
			"lg" => $this->clientEntity->getLg(),
			"lc" => $this->clientEntity->getLc(),
			"id" => $this->getId(),
			"token" => $this->getToken(),
			"mistyped" => $this->getMistyped(),
			"offline_ab_exposure" => "",
			"authkey" => "",        //TODO: FIND OUT
			"e_regid" => "",        //TODO: FIND OUT
			"e_keytype" => "",      //TODO: FIND OUT
			"e_ident" => "",        //TODO: FIND OUT
			"e_skey_id" => "",      //TODO: FIND OUT
			"e_skey_val" => "",     //TODO: FIND OUT
			"e_skey_sig" => "",     //TODO: FIND OUT
			"fdid" => "",           //TODO: FIND OUT
			"expid" => "",          //TODO: FIND OUT
			"network_radio_type" => $this->getNetworkRadioType(),
			"simnum" => $this->getSimnum(),
			"hasinrc" => $this->hasinrc,
			"pid" => $this->getPid(),
			"rc" => $this->getRc(),
		];

		$query_array = [];
		foreach ($query as $key => $key_value) {
			$query_array[] = urlencode($key) . '=' . urlencode($key_value);
		}

		return implode('&', $query_array);

	}

	/**
	 * Hex to decimal
	 *
	 * @param $hex string
	 *
	 * @return int|string
	 */
	function bchexdec($hex) {
		$dec = 0;
		$len = strlen($hex);
		for ($i = 1; $i <= $len; $i++) {
			$dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($len - $i))));
		}
		return $dec;
	}

	/**
	 * @return clientEntity
	 */
	public function getClientEntity() {
		return $this->clientEntity;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @return int
	 */
	public function getMistyped() {
		return $this->mistyped;
	}

	/**
	 * @return string
	 */
	public function getOfflineAbExposure() {
		return $this->offline_ab_exposure;
	}

	/**
	 * @return string
	 */
	public function getUuid() {
		return $this->uuid;
	}

	/**
	 * @return string
	 */
	public function getExpid() {
		return $this->expid;
	}

	/**
	 * @return int
	 */
	public function getNetworkRadioType() {
		return $this->network_radio_type;
	}

	/**
	 * @return int
	 */
	public function getSimnum() {
		return $this->simnum;
	}

	/**
	 * @return int
	 */
	public function getHasinrc() {
		return $this->hasinrc;
	}

	/**
	 * @return int
	 */
	public function getPid() {
		return $this->pid;
	}

	/**
	 * @return int
	 */
	public function getRc() {
		return $this->rc;
	}

	/**
	 * @return string
	 */
	public function getServerPublicKey() {
		return $this->serverPublicKey;
	}


}

