<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                     T A S K   U P D A T E   D R I V E R                     *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/
require_once '../main.php';
$errors = false;

//check if multiple records were selected for update
if (count($_REQUEST['selected']) > 1) {
    $msg = 'Only 1 record can be selected for update at a time.';
    $_SESSION['FLASH_MSG'] = $msg;
    header('Location: /projects/ToDo/task/index.php?search');
    exit;    
} //END IF MORE THAN 1 RECORD SELECTED

//only 1 record seleted for update 
if (selected_record_found()) {
    unset($_REQUEST['action']);
    require_once 'updateSQL.php';
} //END IF selected record found
else {  
    die('** FATAL ERROR: NO SELECTED RECORD FOUND **');
} //END ELSE FATAL ERROR no selected record found