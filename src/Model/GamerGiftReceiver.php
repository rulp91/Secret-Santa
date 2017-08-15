<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 15/08/2017
 * Time: 10:37
 */

namespace SecretSanta\Model;

class GamerGiftReceiver {

	/**
	 * @type string
	 */
	private $gamer;

	/**
	 * @type string
	 */
	private $giftReceiver;

	/**
	 * GamerGiftReceiver constructor.
	 *
	 * @param string $gamer
	 * @param string $giftReceiver
	 */
	public function __construct($gamer, $giftReceiver) {
		$this->gamer        = $gamer;
		$this->giftReceiver = $giftReceiver;
	}

	/**
	 * Sobreescribe el toString
	 */
	public function __toString() {
		return $this->gamer . " -> " . $this->giftReceiver . "\n";
	}

}