<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 15/08/2017
 * Time: 10:54
 */

namespace SecretSanta\Controllers;

use Ds\Set;
use SecretSanta\Model\GamerGiftReceiver;

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

	/**
	 * Setea los parcipantentes en el amigo invisible
	 *
	 * @param array $gamers
	 */
	public function setGamers(array $gamers): void {
		$this->persons                 = new Set($gamers);
		$this->posibleInvisibleFriends = new Set($gamers);
	}

	/**
	 * Retorna una pareja de jugador y amigo invisible o null en caso de que no se haya podido generar dicha pareja
	 * @return null | GamerGiftReceiver
	 */
	public function getNextPairPersonAndGiftReceiver() {
		$person       = $this->getFriend($this->generate(0, ($this->persons->count() - 1)));
		$giftReceiver = $this->getGiftReceiver($this->generate(0, ($this->posibleInvisibleFriends->count() - 1)));

		if ($this->isSeleccionable($person, $giftReceiver)) {
			$this->markSelectedFriend($person);
			$this->markSelectedGiftReciver($giftReceiver);

			return new GamerGiftReceiver($person, $giftReceiver);
		}

		return null;
	}

	/**
	 * Retorna si hay aún jugadores que no tienen seleccionado amigo invisible
	 * @return bool
	 */
	public function isThereMorePosibilitities() {
		return !$this->persons->isEmpty();
	}

	/**
	 * Metodo sobreescrito que devuelve un random entre dos números
	 *
	 * @param int $min
	 * @param int $max
	 *
	 * @return int
	 */
	public function generate(int $min, int $max): int {
		return random_int($min, $max);
	}

	/**
	 * Evita que se pueda clonar el Singleton
	 */
	public function __clone() {
		throw new \Exception('No se puede clonar un objeto sigleton');
	}

	/**
	 * Selecciona un jugador random
	 *
	 * @param int $i
	 *
	 * @return string
	 */
	private function getFriend(int $i): string {
		return $this->selectPosibility($this->persons, $i);
	}

	/**
	 * Selecciona un posible recibidor de regalo
	 *
	 * @param int $i
	 *
	 * @return string
	 */
	private function getGiftReceiver(int $i): string {
		return $this->selectPosibility($this->posibleInvisibleFriends, $i);
	}

	/**
	 * Abstraccion de getFriend y getGiftReceiver
	 *
	 * @param Set $setPosibilities
	 * @param int $i
	 *
	 * @return string
	 * @throws \Exception
	 */
	private function selectPosibility(Set $setPosibilities, int $i): string {
		if ($i > $setPosibilities->count() - 1) {
			throw new \Exception("El índice no es seleccionable ");
		}

		return $setPosibilities->get($i);
	}

	/**
	 * Marca a un jugador como ya seleccionado
	 *
	 * @param string $friend
	 */
	private function markSelectedFriend(string $friend) {
		$this->persons->remove($friend);
	}

	/**
	 * Marca un amigo invisible como seleccionado
	 *
	 * @param string $giftReciver
	 */
	private function markSelectedGiftReciver(string $giftReciver) {
		$this->posibleInvisibleFriends->remove($giftReciver);
	}

	/**
	 * Indica si un jugador y un recibidor de regalo son seleccionables
	 *
	 * @param $jugador
	 * @param $posibleGiftReceiver
	 *
	 * @return bool
	 */
	private function isSeleccionable($person, $posibleGiftReceiver) {
		if ($this->persons->count() != 2 && $person != $posibleGiftReceiver) {
			return true;
		}

		$x = array_values(array_diff($this->persons->toArray(), array($person)));
		$y = array_values(array_diff($this->posibleInvisibleFriends->toArray(), array($posibleGiftReceiver)));

		return $x[0] != $y[0];
	}
}