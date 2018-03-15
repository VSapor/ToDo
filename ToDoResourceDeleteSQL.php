<?php
/******************************************************************************
 *                                                                             *
 *                                                                             *
 *              D E L E T E  R E S O U R C E   S Q L                           *
 *                                                                             *  
 *                                                                             *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) { #new session
    session_start();
} #END IF new session

#initialize local variables from SESSION variables already set
$inClause = $_SESSION['inClause'];
$numSelected = $_SESSION['numSelected'];

#assign variables used in connect.inc.php
$mySQLHost = 'localhost';
$mySQLUserName = 'root';
$mySQLPassword = ''; #no password assigned to our local server
$mySQLDBName = 'todo';

#include code to connect to TODO DB
require 'DBConnect.inc.php';

# build DELETE query
$deleteQuery = "DELETE FROM `resources` WHERE `id` IN ($inClause)";

#run DELETE query and test if it was successful
if(mysqli_query($link,$deleteQuery)) {
    $deleteMessage = 'The following '.$numSelected.' resource record(s) successfully deleted: '.$inClause;
}#END IF DELETE query successful
else { #ELSE query FAILED
    $deleteMessage = 'DELETE Query failed.'.mysqli_error($link);
} #end ELSE DELETE query failed

#return control back to ResourceDeleteConfirm and pass $deleteMessage
return $deleteMessage; 

# free DB resources
mysqli_free_result();

/******************************************************************************
 *                                                                             *
 *                                                                             *
 *              E N D   D E L E T E  R E S O U R C E   S Q L                   *
 *                                                                             *  
 *                                                                             *
 ******************************************************************************/