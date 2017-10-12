<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 15/08/2017
 * Time: 11:48
 */

namespace SecretSanta\Controllers;


use SecretSanta\Contracts\Game;
use SecretSanta\Contracts\Output;

class GameController implements Game, Output {

	private const PATH_FILE = 'players.txt';

	/**
	 * @type GameController
	 */
	private static $instance;

	/**
	 * GameController constructor.
	 */
	private function __construct() {
	}

	/**
	 * Acceso al singleton
	 * @return GameController
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Ejecuta el juego
	 */
	public function play() : array {

		$gamers = $this->readPlayers();

		$invisibleFriendController = InvisibleFriendController::getInstance();
		$invisibleFriendController->setGamers($gamers);

		$results = array();
		while ($invisibleFriendController->isThereMorePosibilitities()) {
			if ($pair = $invisibleFriendController->getNextPairPersonAndGiftReceiver()) {
			   $results[] = $pair;
			}
		}

		return $results;
	}

	/**
	 * Sobreescribe Output
	 *
	 * @param string $line
	 */
	public function printLine(string $line) {
		echo $line;
	}

	/**
	 * Lee los jugadores
	 * @return array
	 */
	private function readPlayers(): array {
		$fileLoaderController = FileLoaderController::getInstance();
		$fileLoaderController->setFilePath(self::PATH_FILE);

		return FileLoaderController::getInstance()->read();
	}

}