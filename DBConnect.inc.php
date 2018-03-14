<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                                                                             *
 *      C O N N E C T   T O   S E R V E R   A N D   D A T A B A S E            *
 *                                                                             *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

#initialize ERROR reporting
ini_set('error_reporting', E_ALL);
 
#connect to the server
$serverConnectError = 'Connection to server failed: '.$mySQLHost;
$DBConnectError = 'Connection to database failed: '.$mySQLDBName;

#if server connect or DB connect fails, kill program and echo error
if (!@mysqli_connect($mySQLHost,$mySQLUserName,$mySQLPassword)){ #CONNECT failed
        die ($serverConnectError);
} #END IF connect failed
else { #CONNECTED successfully
    $link = @mysqli_connect($mySQLHost, $mySQLUserName, $mySQLPassword, '');
    #verify DB SELECT successful
    if(!@mysqli_select_db($link,$mySQLDBName)) { #DB SELECT successful
        die($DBConnectError);
    }#END IF DB SELECT successful
} #END ELSE CONNECT successful

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                                                                             *
 *   E N D   C O N N E C T   T O   S E R V E R   A N D   D A T A B A S E       *
 *                                                                             *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/