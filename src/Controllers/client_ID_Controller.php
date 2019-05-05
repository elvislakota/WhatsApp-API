<?php

namespace WhatsAppAPI\Controllers;

use WhatsAppAPI\Constants\InternalConstants;

/**
 * Class client_ID_Controller
 * @package WhatsAppAPI\Controllers
 */
class client_ID_Controller extends InternalConstants {

	/**
	 * @var string $activationPattern
	 */
	protected $activationPattern = '';

	/**
	 * @var ID_Encoder $ID_Encoder
	 */
	protected $ID_Encoder;

	/**
	 * client_ID_Controller constructor.
	 * @param clientEntity $clientEntity
	 *
	 * @throws \Exception
	 */
	public function __construct($clientEntity) {
		$this->activationPattern = $this->getClientEntityTParam() . $clientEntity->getActivationPattern();

		$this->ID_Encoder = new ID_Encoder();
	}


	/**
	 * @param $id
	 *
	 * @return string
	 *
	 * @throws \Exception
	 */
	public function __encryptID() {
		$tmpArray = [0, 2];
		$a = 4;
		$b = 16;
		$c = 20;
		$d = count($tmpArray);
		$all = $this->add($d, $a, $b, $c);

		$rcFileLen = $this->getFileLength();

		$srcStart = 2;
		if ($rcFileLen >= $all) {

			$destArray = [0, 0];
			$destArray = $this->rc2_array_copy($srcStart, $destArray, 0, $d);

			$srcStart += $a;

			$destArray2 = [0, 0, 0, 0];
			$destArray2 = $this->rc2_array_copy($srcStart, $destArray2, 0, $a);

			$srcStart += $b;

			$destArray3 = array_fill(0, 16, 0);
			$destArray3 = $this->rc2_array_copy($srcStart, $destArray3, 0, $b);

			$secretKey = $this->ID_Encoder->getSecretKey($this->activationPattern, $destArray2);
			$iv = '';


			foreach ($destArray3 as $item) {
				$iv .= $item;
			}
			$i3 = $rcFileLen - $srcStart;


			$rcData = $this->rc2Seek($srcStart, $i3);


			$enc = openssl_encrypt($rcData,'AES-128-OFB', $secretKey, OPENSSL_ZERO_PADDING,$iv);
			$dec = openssl_decrypt($enc,'AES-128-OFB',$secretKey);
			echo $dec, PHP_EOL;
			echo $enc, PHP_EOL;
			echo $dec, PHP_EOL;
			return $enc;


		} else {
			throw new \Exception('size mismatch');
		}

	}

	/**
	 * @return int
	 */
	protected function getFileLength() {
		$fileName = dirname(__DIR__) . '\\Session\rc2';
		return filesize($fileName);

	}

	/**
	 *
	 * @param $srcPos int This is the starting position in the source array.
	 *
	 * @param $destPos int This is the starting position in the destination data.
	 * @param $dest  array This is the destination array.
	 *
	 * @param $length int This is the number of array elements to be copied.
	 *
	 * @return array
	 */
	public function rc2_array_copy($srcPos, $dest, $destPos, $length) {
		$destPotT = $destPos;
		$returnArray = $dest;
		for ($i = $srcPos; $i <= $srcPos + $length - 1; $i++) {
			$returnArray[$destPotT] = $this->rc2Seek($i);
			$destPotT += 1;
		}

		return $returnArray;
	}

	/**
	 * Seek file
	 *
	 * @param $offset int
	 *
	 * @return bool|string
	 */
	protected function rc2Seek($offset, $len = 1) {
		$filename = dirname(__DIR__) . '\\Session\rc2';

		$fp = fopen($filename, 'rb');

		fseek($fp, $offset);


		$data = fread($fp, $len);   // read 8 bytes from byte 7

		fclose($fp);
		return $data;
	}

	/**
	 * @return string
	 *
	 * @throws \Exception
	 */
	public function getRC2File() {
		$filename = dirname(__DIR__) . '\\Session\rc2';

		$handle = fopen($filename, "rb");
		$fsize = filesize($filename);
		$contents = fread($handle, $fsize);


		if ($contents !== false) {
			return $contents;
		} else {
			throw new \Exception('No rc2/verify/exists');
		}

	}

	/**
	 * @param $d int
	 * @param $a int
	 * @param $b int
	 * @param $c int
	 *
	 * @return int
	 */
	protected function add($d, $a, $b, $c) {
		return $d + $a + $b + $c;
	}
}
