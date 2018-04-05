<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                       T A S K   A D D   D R I V E R                         *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/
require_once '../main.php';

$errors = false;

// Add form submitted
if(isset($_REQUEST['action']) && $_REQUEST['action'] = 'add') {
    if (EMPTY($_REQUEST['firstname']) ||
        EMPTY($_REQUEST['lastname']) ||
        IS_NULL($_REQUEST['pctavail']) ||
        EMPTY($_REQUEST['skill']) ||
        IS_NULL($_REQUEST['dailyrate'])
    ) {
        $errors[] = 'Please enter all required fields.';
    }
    else {
       // Add new record
        $addQuery = "INSERT INTO `tasks` 
            (
                `first_name`, 
                `last_name`, 
                `pct_avail`, 
                `unavail_date_start`, 
                `unavail_date_end`, 
                `skill`, 
                `daily_rate`, 
                `notes`
            ) 
        VALUES 
            ( 
                '".db_str($_REQUEST['firstname'])."', 
                '".db_str($_REQUEST['lastname'])."', 
                '".floatval($_REQUEST['pctavail'])."', 
                '".db_str($_REQUEST['unavaildatestart'])."', 
                '".db_str($_REQUEST['unavaildateend'])."', 
                '".db_str($_REQUEST['skill'])."', 
                '".floatval($_REQUEST['dailyrate'])."', 
                '".db_str($_REQUEST['notes'])."'
            )";

        $result = db_query($addQuery);
        if($result) $_SESSION['FLASH_MSG'] = 'Successfully added task ID: '.db_insert_id();
        else $errors[] = 'ADD Query failed.'.mysqli_error($link);
    }
}

echo view('task/add', [
    'input' => $_REQUEST,
    'errors' => $errors
]);