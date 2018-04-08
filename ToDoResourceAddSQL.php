<?php
/******************************************************************************
 *                                                                             *
 *                                                                             *
 *                    A D D   R E S O U R C E   S Q L                          *
 *                                                                             *  
 *                                                                             *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

/*******************************************************************************
 *                                                                             *
 *                             Build ADD query                              *
 *                                                                             *
 *******************************************************************************/
$id = $_SESSION['id'];
$firstName = $_SESSION['firstname'];
$lastName = $_SESSION['lastname'];
$pctAvail = $_SESSION['pctavail'];
$unavailDateStart = $_SESSION['unavaildatestart'];
$unavailDateEnd = $_SESSION['unavaildateend'];
$skill = $_SESSION['skill'];
$dailyRate = $_SESSION['dailyrate'];
$notes = $_SESSION['notes'];

$addQuery = "INSERT INTO `resources` 
                            (`id`, 
                            `first_name`, 
                            `last_name`, 
                            `pct_avail`, 
                            `unavail_date_start`, 
                            `unavail_date_end`, 
                            `skill`, 
                            `daily_rate`, 
                            `notes`) 
                        VALUES 
                            ('$id', 
                            '$firstName', 
                            '$lastName', 
                            '$pctAvail', 
                            '$unavailDateStart', 
                            '$unavailDateEnd', 
                            '$skill', 
                            '$dailyRate', 
                            '$notes')";
/*******************************************************************************
 *                                                                             *
 *                          END Build ADD query                             *
 *                                                                             *
 *******************************************************************************/

/*******************************************************************************
 *                                                                             *
 *                   Run SQL ADD Query and verify successful                *
 *                                                                             *
 *******************************************************************************/
if($result = mysqli_query($link,$addQuery)) { #ADD Query successful
    $addMessage = 'Successfully added resource ID: '.$id;
}#END IF ADD query successful
else { #ELSE query FAILED
    $addMessage = 'ADD Query failed.'.mysqli_error($link);
} #end ELSE ADD query failed

/*******************************************************************************
 *                                                                             *
 *              END Run SQL ADD Query and verify successful                 *
 *                                                                             *
 *******************************************************************************/

#return control back to ResourceAddConfirm and pass $addMessage
return $addMessage; 

# free DB resources
mysqli_free_result();

/******************************************************************************
 *                                                                             *
 *                                                                             *
 *                  E N D   A D D   R E S O U R C E   S Q L                    *
 *                                                                             *  
 *                                                                             *
 ******************************************************************************/