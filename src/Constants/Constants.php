<?php

namespace WhatsAppAPI\Constants;


/**
 * Class Constants
 *
 * WhatsApp Constants
 *
 * @package WhatsAppAPI\Constants
 */
class Constants {

	/**
	 * @var string
	 */
	protected $tokenSalt = 'PkTwKSZqUfAUyR0rPQ8hYJ0wNsQQ3dW1+3SCnyTXIfEAxxS75FwkDf47wNv/c8pP3p0GXKR6OOQmhyERwx74fw1RYSU10I4r1gyBVDbRJ40pidjM41G1I1oN';

	/**
	 * @return string
	 */
	public function getTokenSalt() {
		return base64_decode($this->tokenSalt);
	}



}
