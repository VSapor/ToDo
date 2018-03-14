<?php
/*******************************************************************************
 *                                                                             *
 *         R E S O U R C E   U P D A T E   M A S T E R   S C R I P T           *
 *                                                                             *
 *              (Called from 'ToDoResourceUpdateDriver.php')               *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/******************************************************************************
 *    Call script to display SEARCH resource screen                           *
 *    to allow user to search for records to update first                     *
 ******************************************************************************/
require 'ToDoResourceSearchMaster.php';

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *    E N D   R E S O U R C E   U P D A T E   M A S T E R   S C R I P T        *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/