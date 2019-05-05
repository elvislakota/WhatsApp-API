<?php

namespace WhatsAppAPI\Controllers;

/**
 * Class token_Generator_Controller
 * @package WhatsAppAPI\Controllers
 */
class token_Generator_Controller extends PBKDF2_Controller {

	/**
	 * Sale encoded in Base64
	 *
	 * @var string
	 */
	protected $tokenSalt = 'PkTwKSZqUfAUyR0rPQ8hYJ0wNsQQ3dW1+3SCnyTXIfEAxxS75FwkDf47wNv/c8pP3p0GXKR6OOQmhyERwx74fw1RYSU10I4r1gyBVDbRJ40pidjM41G1I1oN';
	protected $signature = 'MIIDMjCCAvCgAwIBAgIETCU2pDALBgcqhkjOOAQDBQAwfDELMAkGA1UEBhMCVVMxEzARBgNVBAgTCkNhbGlmb3JuaWExFDASBgNVBAcTC1NhbnRhIENsYXJhMRYwFAYDVQQKEw1XaGF0c0FwcCBJbmMuMRQwEgYDVQQLEwtFbmdpbmVlcmluZzEUMBIGA1UEAxMLQnJpYW4gQWN0b24wHhcNMTAwNjI1MjMwNzE2WhcNNDQwMjE1MjMwNzE2WjB8MQswCQYDVQQGEwJVUzETMBEGA1UECBMKQ2FsaWZvcm5pYTEUMBIGA1UEBxMLU2FudGEgQ2xhcmExFjAUBgNVBAoTDVdoYXRzQXBwIEluYy4xFDASBgNVBAsTC0VuZ2luZWVyaW5nMRQwEgYDVQQDEwtCcmlhbiBBY3RvbjCCAbgwggEsBgcqhkjOOAQBMIIBHwKBgQD9f1OBHXUSKVLfSpwu7OTn9hG3UjzvRADDHj+AtlEmaUVdQCJR+1k9jVj6v8X1ujD2y5tVbNeBO4AdNG/yZmC3a5lQpaSfn+gEexAiwk+7qdf+t8Yb+DtX58aophUPBPuD9tPFHsMCNVQTWhaRMvZ1864rYdcq7/IiAxmd0UgBxwIVAJdgUI8VIwvMspK5gqLrhAvwWBz1AoGBAPfhoIXWmz3ey7yrXDa4V7l5lK+7+jrqgvlXTAs9B4JnUVlXjrrUWU/mcQcQgYC0SRZxI+hMKBYTt88JMozIpuE8FnqLVHyNKOCjrh4rs6Z1kW6jfwv6ITVi8ftiegEkO8yk8b6oUZCJqIPf4VrlnwaSi2ZegHtVJWQBTDv+z0kqA4GFAAKBgQDRGYtLgWh7zyRtQainJfCpiaUbzjJuhMgo4fVWZIvXHaSHBU1t5w//S0lDK2hiqkj8KpMWGywVov9eZxZy37V26dEqr/c2m5qZ0E+ynSu7sqUD7kGx/zeIcGT0H+KAVgkGNQCo5Uc0koLRWYHNtYoIvt5R3X6YZylbPftF/8ayWTALBgcqhkjOOAQDBQADLwAwLAIUAKYCp0d6z4QQdyN74JDfQ2WCyi8CFDUM4CaNB+ceVXdKtOrNTQcc0e+t';

	/**
	 * @var string
	 */
	protected $packageName = 'com.whatsapp';

	/**
	 * @var string
	 */
	protected $classesdexMD5 = 'xxTVenqUCIFp+ac7Z2G3bQ==';

	/**
	 * @var clientEntity
	 */
	protected $clientEntity;

	/**
	 * token_Generator_Controller constructor.
	 * @param $clientEntity clientEntity
	 */
	public function __construct($clientEntity) {
		$this->clientEntity = $clientEntity;
	}

	/**
	 * @return string
	 *
	 * @throws \Exception
	 */
	public function getAboutImage() {
		$filename = dirname(__DIR__) . '\\WhatsAppData\about_logo.png';

		$handle = fopen($filename, "rb");
		$fsize = filesize($filename);
		$contents = fread($handle, $fsize);


		if ($contents !== false) {
			return $contents;
		} else {
			throw new \Exception('No logo/verify/exists');
		}

	}


	/**
	 * @return bool|mixed|string
	 * @throws \Exception
	 */
	public function encodeToken() {
		$password = $this->packageName . $this->getAboutImage();
		$saltDecoded = base64_decode($this->tokenSalt);
		$key = $this->pbkdf2('sha1', $password, $saltDecoded, 128, 512, true);
		$data = base64_decode($this->signature) . base64_decode($this->classesdexMD5) . $this->clientEntity->getIn();

		$enc = hash_hmac('sha1', $data, $key, true);
		return $enc;
	}

}
