<?php

session_start();

// Core Classes
require_once "core/Config.php";
require_once "core/App.php";
require_once "core/Controller.php";
require_once "core/HTML.php";

// Useful Free Functions
require_once "scripts/functions.php";

// Auto load models
spl_autoload_register(function($class) {
  require_once 'models/' . $class . '.php';
});

// Instantiate a single database model
$db = new DbContext;
$debug = new Debugger;

?>
