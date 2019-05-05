<?php

namespace WhatsAppAPI\Controllers;

class ID_Encoder extends PBKDF2_Controller {

	public function getSecretKey($password, $salt) {
		$iterationCount = 16;
		$keyLength = 128;
		$saltS = '';
		foreach ($salt as $item) {
			$saltS .= $item;
		}
		return $this->PBEKeySpec($password, $saltS, $iterationCount, $keyLength);

	}

	public function PBEKeySpec($password, $salt, $iterationCount, $keyLength) {
		return $this->pbkdf2('sha1', mb_convert_encoding($password, "UTF-8"), $salt, $iterationCount, $keyLength, true);
	}

}
