<?php

/*
This is the main file that should be included by every other file you create. It will hold
or include all common settings/functionality.
*/

error_reporting(E_ALL & ~E_NOTICE);

/*
Set some constants to use throughout the app.
Constants are more convenient than GLOBAL vars, since we can use them inside functions without using "GLOBAL $var;"
Typically, declared constants are all uppercase
*/
const APP_PATH = __DIR__;                   // Current directory (containing this main.php file) as the main app path
const APP_PATHS = [
    'config' => APP_PATH.'/config',         // Path to config directory
    'lib' => APP_PATH.'/lib',               // Path to lib directory
    'views' => APP_PATH.'/views',           // Path to views directory
];

// Start the session
session_start();

// Include the common lib functions
require_once APP_PATHS['lib'].'/functions.php';

// Include the db config
require_once APP_PATHS['config'].'/db.php';

// Attempt to connect to the database
$link = db_init($mySQLHost, $mySQLUserName, $mySQLPassword, $mySQLDBName);