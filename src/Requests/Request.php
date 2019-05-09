<?php

namespace WhatsAppAPI\Requests;

use GuzzleHttp\Client;

class Request {

	/**
	 * @var Client
	 */
	protected $guzzleClient;

	/**
	 * Request constructor.
	 */
	public function __construct() {
		$this->guzzleClient = new Client();


	}

	/**
	 * @param $uri
	 *
	 * @return bool|\Psr\Http\Message\ResponseInterface
	 *
	 */
	public function request($uri) {
		try {

			return $this->guzzleClient->request('GET', trim($uri), [
				'verify' => false,
				'headers' => [
					"User-Agent" => "WhatsApp/2.19.115 Android/5.1.1 Device/samsung-SM-N950N",
					"Accept-Charset" => "UTF-8",
					"Accept-Encoding" => "gzip, deflate",
				]
			]);
		} catch (\GuzzleHttp\Exception\GuzzleException $e) {
			echo "Error: ", $e->getMessage();
			return false;
		}

	}
}
