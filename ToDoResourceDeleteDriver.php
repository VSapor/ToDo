<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                      R E S O U R C E   D E L E T E   D R I V E R            *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/

#initialize error reporting settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) { #new session
    session_start();
} #END IF new session

/*******************************************************************************
 * Set SESSION action to 'delete' and call ResourceDeleteMaster script         *
 ******************************************************************************/
#DELETE action selected
$action = 'delete';
$_SESSION['action'] = $action;


/******************************************************************************
 *    Call script to display SEARCH resource screen                           *
 *    to allow user to search for records to delete first.                    *
 ******************************************************************************/
require 'ToDoResourceSearchMaster.php';

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *             E N D   R E S O U R C E   D E L E T E   D R I V E R             *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/