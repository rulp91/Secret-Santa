<?php
/**
 * Implementación de un controlador frontal que servirá de punto de entrada a la aplicación
 * User: Raul
 * Date: 15/08/2017
 * Time: 9:20
 */

use SecretSanta\Controllers\GameController;

$loader = require __DIR__.'/vendor/autoload.php';

GameController::getInstance()->play();