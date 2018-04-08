<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                      R E S O U R C E   U P D A T E   D R I V E R            *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/

#initialize error reporting settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*******************************************************************************
 * Set SESSION action to 'update' and call ResourceUpdateMaster script         *
 ******************************************************************************/
#update action selected
$action = 'update';
$_SESSION['action'] = $action;


/*******************************************************************************
 *    Call RESOURCE UPDATE master script                                       *
 ******************************************************************************/
require 'ToDoResourceUpdateMaster.php';

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *             E N D   R E S O U R C E   U P D A T E   D R I V E R             *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/