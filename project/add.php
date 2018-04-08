<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                P R O J E C T   A D D   D R I V E R                          *
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
        $addQuery = "INSERT INTO `projects` 
            (
                `project_first_name`, 
                `project_last_name`, 
                `project_pct_avail`, 
                `project_unavail_date_start`, 
                `project_unavail_date_end`, 
                `project_skill`, 
                `project_daily_rate`, 
                `project_notes`
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
        if($result) $_SESSION['FLASH_MSG'] = 'Successfully added project ID: '.db_insert_id();
        else $errors[] = 'ADD Query failed.'.mysqli_error($link);
    }
}

echo view('project/add', [
    'input' => $_REQUEST,
    'errors' => $errors
]);