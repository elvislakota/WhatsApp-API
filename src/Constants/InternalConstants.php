<?php

namespace WhatsAppAPI\Constants;

/**
 * Class InternalConstants
 * @package WhatsAppAPI\Constants
 */
class InternalConstants {
	/**
	 * @var string
	 */
	protected $a = 'http://clients3.google.com/generate_204';

	/**
	 * @var string
	 */
	protected $b = 'https://v.whatsapp.net';

	/**
	 * @var string
	 */
	protected $c = 'https://v.whatsapp.net/v2/exist';

	/**
	 * @var string
	 */
	protected $d = 'https://v.whatsapp.net/v2/code';

	/**
	 * @var string
	 */
	protected $e = 'https://v.whatsapp.net/v2/register';

	/**
	 * @var string
	 */
	protected $f = 'https://v.whatsapp.net/v2/security';

	/**
	 * @var string
	 */
	protected $g = 'https://www.whatsapp.com/status.php?v=2';

	/**
	 * @var string
	 */
	protected $h = 'https://api.foursquare.com/v2/venues/search';

	/**
	 * @var string
	 */
	protected $i = 'PFUJY2FLEXYLBCXHERGFZIQVW501IVXCXMXSHXNDWDIXUQAT';

	/**
	 * @var string
	 */
	protected $j = 'XQJA0HW2Y1HIYPN2DBMWR3DPPDTHW2E1V33PLAFVRJFEMJS1';

	/**
	 * @var string
	 */
	protected $k = '20140601';

	/**
	 * @var string
	 */
	protected $l = 'https://graph.facebook.com/v2.3/';

	/**
	 * @var string
	 */
	protected $m = '1609427805955024|f1de6fcdcb11b215ea7a2d3cd062ecff';

	/**
	 * @var string
	 */
	protected $n = 'https://www.bingapis.com/api/v6/images/search';

	/**
	 * @var string
	 */
	protected $o = 'Strict';

	/**
	 * @var string
	 */
	protected $p = 'D41D8CD98F00B204E9800998ECF8427E4F4A7492';

	/**
	 * @var string
	 */
	protected $q = 'Square';

	/**
	 * @var string
	 */
	protected $r = 'ApnLIIIzvjcRC-f8HvE0lXByv6YX8DEtCK63ZQmUqWpJuvcSPTu9rdtpqNUHYG3D';

	/**
	 * @var string
	 */
	protected $s = 'LM4NgcjF-X_EedaZ6MwPVSH0Sac=';

	/**
	 * Used to generate the Client Entity ID
	 *
	 * @var $t string
	 */
	protected $t = 'UxYPUgMKRC0QLS0tLUY6IWkpV0E=';

	/**
	 * @var string
	 */
	protected $u = 'waprivacy-tenor-777626885.us-east-1.elb.amazonaws.com';

	/**
	 * @var string
	 */
	protected $v = 'waprivacy-giphy-690867290.us-east-1.elb.amazonaws.com';

	/**
	 * @var string
	 */
	protected $w = 'NX2ZM22Q1B3I';

	/**
	 * @var string
	 */
	protected $x = 'g3Dm3RlhPhuOA';


	/**
	 * @return string
	 */
	public function getA() {
		return $this->a;
	}

	/**
	 * @return string
	 */
	public function getB() {
		return $this->b;
	}

	/**
	 * @return string
	 */
	public function getC() {
		return $this->c;
	}

	/**
	 * @return string
	 */
	public function getD() {
		return $this->d;
	}

	/**
	 * @return string
	 */
	public function getE() {
		return $this->e;
	}

	/**
	 * @return string
	 */
	public function getF() {
		return $this->f;
	}

	/**
	 * @return string
	 */
	public function getG() {
		return $this->g;
	}

	/**
	 * @return string
	 */
	public function getH() {
		return $this->h;
	}

	/**
	 * @return string
	 */
	public function getI() {
		return $this->i;
	}

	/**
	 * @return string
	 */
	public function getJ() {
		return $this->j;
	}

	/**
	 * @return string
	 */
	public function getK() {
		return $this->k;
	}

	/**
	 * @return string
	 */
	public function getL() {
		return $this->l;
	}

	/**
	 * @return string
	 */
	public function getM() {
		return $this->m;
	}

	/**
	 * @return string
	 */
	public function getN() {
		return $this->n;
	}

	/**
	 * @return string
	 */
	public function getO() {
		return $this->o;
	}

	/**
	 * @return string
	 */
	public function getP() {
		return $this->p;
	}

	/**
	 * @return string
	 */
	public function getQ() {
		return $this->q;
	}

	/**
	 * @return string
	 */
	public function getR() {
		return $this->r;
	}

	/**
	 * @return string
	 */
	public function getS() {
		return $this->s;
	}

	/**
	 * @return string
	 */
	public function getT() {
		return $this->getClientEntityTParam();
	}

	/**
	 * @return string
	 */
	public function getU() {
		return $this->u;
	}

	/**
	 * @return string
	 */
	public function getV() {
		return $this->v;
	}

	/**
	 * @return string
	 */
	public function getW() {
		return $this->w;
	}

	/**
	 * @return string
	 */
	public function getX() {
		return $this->x;
	}

	/**
	 * @return string
	 */
	public function getClientEntityTParam() {
		return base64_decode($this->t);
	}

}