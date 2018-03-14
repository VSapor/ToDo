<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                      R E S O U R C E   A D D   D R I V E R                  *
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
 * Set SESSION action to 'add' and call ResourceAddMaster script         *
 ******************************************************************************/
#add action selected
$action = 'add';
$_SESSION['action'] = $action;

/******************************************************************************
 *                                                                            *
 *           Set session variables to be used on next screen                  *
 *                                                                            *
 ******************************************************************************/
$header1 = 'Resource Add Menu';
$header3 = 'add:';
$_SESSION['header1'] = $header1;
$_SESSION['header3'] = $header3;

/******************************************************************************
 *    Call RESOURCE ADD MASTER script                                         *
 ******************************************************************************/
require 'ToDoResourceAddMaster.php';

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *             E N D   R E S O U R C E   A D D   D R I V E R                   *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/