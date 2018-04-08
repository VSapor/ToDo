<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *               R E S O U R C E   D E L E T E   D R I V E R                   *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/
require_once '../main.php';

if(isset($_REQUEST['confirm'])) {
    // See if yes or no was chosen for confirm action
    if($_REQUEST['choice'] == 0) {
        // Send back to search
        $msg = 'Delete resource canceled';
        $_SESSION['FLASH_MSG'] = $msg;
        header('Location: /projects/ToDo/resource/index.php?search');
        exit;
    }
    
    // Do the delete
    $ids = [];
    foreach($_SESSION['DELETE_IDS'] as $id) {
        $ids[] = intval($id);
    }

    $msg = count($ids).' resource record(s) successfully deleted';
    $result = db_query("DELETE FROM `resources` WHERE `resource_id` IN (".implode(',', $ids).")");
    if(!$result) $msg = 'DELETE Query failed. '.mysqli_error($link);
    unset($_SESSION['DELETE_IDS']);
    $_SESSION['FLASH_MSG'] = $msg;

    // Send back to search
    header('Location: /projects/ToDo/resource/index.php?search');
    exit;
}
else {
    $_SESSION['DELETE_IDS'] = $_REQUEST['selected'];

    // Show the confirmation form to choose yes/no
    echo view('resource/delete/confirm');
}