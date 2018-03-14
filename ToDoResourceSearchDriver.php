<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *              R E S O U R C E   S E A R C H   D R I V E R                    *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/

#initialize error reporting settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} # END IF new session

/*******************************************************************************
 * Set SESSION action to 'search' and call ResourceSearch master               *
 ******************************************************************************/
#SEARCH action selected
$action = 'SEARCH';
$_SESSION['action'] = $action;

#display RESOURCE navigation screen
require ('ToDoResourceSearchMaster.php');

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *             E N D   R E S O U R C E   S E A R C H   D R I V E R             *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/