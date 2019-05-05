<?php

namespace WhatsAppAPI\Controllers;

/**
 * Class clientEntity
 * @package WhatsAppAPI\Controllers
 */
class clientEntity {

	/**
	 * @var $cc int
	 */
	protected $cc;

	/**
	 * @var $in int
	 */
	protected $in;

	/**
	 * @var $lg string
	 */
	protected $lg;

	/**
	 * @var $lc string
	 */
	protected $lc;

	/**
	 * clientEntity constructor.
	 *
	 * @param int $cc Country code
	 * @param int $in Phone number without country code
	 * @param string $lg Language
	 * @param string $lc Country code
	 */
	public function __construct($cc, $in, $lg = 'en', $lc = 'US') {
		$this->cc = $cc;
		$this->in = $in;
		$this->lg = $lg;
		$this->lc = $lc;
	}

	/**
	 * @return string
	 *
	 * @throws \Exception
	 */
	public function getActivationPattern(){

		$string = $this->cc . $this->in;
		$output_array = [];
		$is_Success = preg_match("^([17]|2[07]|3[0123469]|4[013456789]|5[12345678]|6[0123456]|8[1246]|9[0123458]|\\d{3})\\d*?(\\d{4,6})$^", $string, $output_array);
		if ($is_Success !== false) {
			return $output_array[1] . $output_array[2];
		} else {
			throw new \Exception('verifytwofactorauth/checkifexists/error');
		}
	}

	/**
	 * @return int
	 */
	public function getCc() {
		return $this->cc;
	}

	/**
	 * @return int
	 */
	public function getIn() {
		return $this->in;
	}

	/**
	 * @return string
	 */
	public function getLg() {
		return $this->lg;
	}

	/**
	 * @return string
	 */
	public function getLc() {
		return $this->lc;
	}




}
