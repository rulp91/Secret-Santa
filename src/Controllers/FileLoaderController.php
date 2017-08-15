<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 15/08/2017
 * Time: 9:40
 */

namespace SecretSanta\Controllers;


class FileLoaderController {

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
	 * Evita que se pueda clonar el Singleton
	 */
	public function __clone() {
		throw new Exception('No se puede clonar un objeto sigleton');
	}
}