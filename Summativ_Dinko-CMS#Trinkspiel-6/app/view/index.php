<?php
//Fehler Report
error_reporting( E_ALL );
ini_set( 'display_errors', '1' );
// Hinzuziehung der Config Datei
require_once('../config/config.php');
// Autoloader für Ordner src/*.php
spl_autoload_register(function($class) {
	require_once APPROOT.'/backend/src/'.strtolower($class).".php";
});
// Objekt App
$app = new App;
?>