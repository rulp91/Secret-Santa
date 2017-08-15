<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 15/08/2017
 * Time: 10:54
 */

namespace SecretSanta\Controllers;

use Ds\Set;

class InvisibleFriendController {


	/**
	 * @type InvisibleFriendController
	 */
	private static $instance;

	/**
	 * @type Set
	 */
	private $persons;

	/**
	 * @type Set
	 */
	private $posibleInvisibleFriends;

	/**
	 * InvisibleFriendController constructor.
	 */
	private function __construct() {

	}

	/**
	 * Acceso al singleton
	 * @return InvisibleFriendController
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function setGamers(array $gamers): void {

	}

	/**
	 * Evita que se pueda clonar el Singleton
	 */
	public function __clone() {
		throw new \Exception('No se puede clonar un objeto sigleton');
	}
}