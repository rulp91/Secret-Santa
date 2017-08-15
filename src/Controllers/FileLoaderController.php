<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 15/08/2017
 * Time: 9:40
 */

namespace SecretSanta\Controllers;


use SecretSanta\Contracts\Input;

class FileLoaderController implements Input {

	/**
	 * @type FileLoaderController
	 */
	private static $instance;

	/**
	 * Indica si la apertura del fichero fue satisfactoria
	 * @type bool
	 */
	private $handleFopenConnection;

	/**
	 * Almacen de cadenas que almacenrá las lineas leidas
	 * @type array
	 */
	private $linesReaded;

	/**
	 * Almacenará la ubicación del fichero en el sistema de archivos
	 * @type string
	 */
	private $filePath;

	/**
	 * FileLoaderController constructor.
	 */
	private function __construct() {
		$this->linesReaded = array();
	}

	/**
	 * Acceso al singleton
	 * @return FileLoaderController
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param string $filePath
	 */
	public function setFilePath(string $filePath) {
		$this->filePath = $filePath;
	}

	/**
	 * Read the list of players from a text file
	 *
	 * @return string[] An array with all player names as strings
	 */
	public function read(): array {
		if ($this->load()) {
			$this->readFile();
			$this->closeFileIfNeeded();
		} else {
			$this->closeFileIfNeeded();
			throw new \Exception('El fichero no puede ser leido ya sea por falta de permisos o porque la ruta está mal');
		}

		return $this->linesReaded;
	}

	/**
	 * Evita que se pueda clonar el Singleton
	 */
	public function __clone() {
		throw new \Exception('No se puede clonar un objeto sigleton');
	}

	/**
	 * Comprueba si el fichero puede ser leido
	 *
	 * @param string $file_url
	 *
	 * @return bool
	 */
	private function load() {
		if ($this->handleFopenConnection = fopen($this->filePath, 'cb+')) {
			return $this->handleFopenConnection;
		}

		return false;
	}

	/**
	 * Cierra el descriptor de fichero
	 */
	private function closeFileIfNeeded() {
		if (!feof($this->handleFopenConnection)) {
			fclose($this->handleFopenConnection);
		}
	}

	/**
	 * Limpia y almacena una cadena
	 * @type string $buffer
	 */
	private function store($buffer) {
		$this->linesReaded[] = str_replace(PHP_EOL, '', $buffer);
	}

	/**
	 * Itera para leer el fichero
	 */
	private function readFile(): void {
		while (($buffer = fgets($this->handleFopenConnection, filesize($this->filePath))) !== false) {
			$this->store($buffer);
		}
	}
}