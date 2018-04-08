<?php
/******************************************************************************
 *                                                                             *
 *                                                                             *
 *              U P D A T E   R E S O U R C E   S Q L                          *
 *                                                                             *  
 *                                                                             *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

#assign variables used in connect.inc.php
$mySQLHost = 'localhost';
$mySQLUserName = 'root';
$mySQLPassword = ''; #no password assigned to our local server
$mySQLDBName = 'todo';

#include code to connect to TODO DB
require 'DBConnect.inc.php';

/*******************************************************************************
 *                                                                             *
 *                             Build UPDATE query                              *
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

$updateQuery = "UPDATE `resources` 
                SET `first_name` = '$firstName',
                    `last_name` = '$lastName',
                    `pct_avail` = '$pctAvail',
                    `unavail_date_start` = '$unavailDateStart',
                    `unavail_date_end` = '$unavailDateEnd',
                    `skill` = '$skill',
                    `daily_rate` = '$dailyRate',
                    `notes` = '$notes'
                WHERE `id` = '$id'";
/*******************************************************************************
 *                                                                             *
 *                          END Build UPDATE query                             *
 *                                                                             *
 *******************************************************************************/

/*******************************************************************************
 *                                                                             *
 *                   Run SQL UPDATE Query and verify successful                *
 *                                                                             *
 *******************************************************************************/
if($result = mysqli_query($link,$updateQuery)) { #UPDATE Query successful
    $updateMessage = 'Successfully updated resource ID: '.$id;
}#END IF UPDATE query successful
else { #ELSE query FAILED
    $updateMessage = 'UPDATE Query failed.'.mysqli_error($link);
} #end ELSE UPDATE query failed

/*******************************************************************************
 *                                                                             *
 *              END Run SQL UPDATE Query and verify successful                 *
 *                                                                             *
 *******************************************************************************/

#return control back to ResourceUpdateConfirm and pass $updateMessage
return $updateMessage; 

# free DB resources
mysqli_free_result();

/******************************************************************************
 *                                                                             *
 *                                                                             *
 *              E N D   U P D A T E   R E S O U R C E   S Q L                  *
 *                                                                             *  
 *                                                                             *
 ******************************************************************************/