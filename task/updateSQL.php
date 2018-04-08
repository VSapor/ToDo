<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *                     T A S K   U P D A T E   S Q L                           *
 *                                                                             *
 *                                                                             *                                                                         
 ******************************************************************************/
require_once '../main.php';
$errors = false;

//check if coming in on confirmation path
if(isset($_REQUEST['confirm'])) {
    // See if yes or no was chosen for confirm action
    if($_REQUEST['choice'] == 0) {
        // Send back to search
        $msg = 'Update task canceled';
        $_SESSION['FLASH_MSG'] = $msg;
        header('Location: /projects/ToDo/task/index.php?search');
        exit;
    } //END IF confirm = NO
    
    //Do updates
    $updateQuery = 
           "UPDATE `tasks`
            SET
                `first_name` = '".$_SESSION['updatedFirstName']."',
                `last_name` = '".$_SESSION['updatedLastName']."',
                 `pct_avail` = '".$_SESSION['updatedPctAvail']."',
                `unavail_date_start` = '".$_SESSION['updatedUnavailDateStart']."',
                `unavail_date_end` = '".$_SESSION['updatedUnavailDateEnd']."',
                `skill` = '".$_SESSION['updatedSkill']."',
                `daily_rate` = '".$_SESSION['updatedDailyRate']."',
                `notes` = '".$_SESSION['updatedNotes']."'
            WHERE
                `id` = '".$_SESSION['selectedID']."'
            ";

            $result = db_query($updateQuery);
            if($result) $_SESSION['FLASH_MSG'] = 'Successfully updated task ID: '.$_SESSION['selectedID'];
            else $errors[] = 'UPDATE Query failed.'.mysqli_error($link);

    // Send back to search
    header('Location: /projects/ToDo/task/index.php?search');
    exit;
} //END IF confirm processed

//check if coming in on UPDATE page submitted path
if(isset($_REQUEST['action']) && $_REQUEST['action'] = 'update') {
    if (EMPTY($_REQUEST['firstname']) ||
            EMPTY($_REQUEST['lastname']) ||
            IS_NULL($_REQUEST['pctavail']) ||
            EMPTY($_REQUEST['skill']) ||
            IS_NULL($_REQUEST['dailyrate'])) {
            $errors[] = 'Please enter all required fields.';
    } //END IF MISSING REQUIRED FIELD
    else {

        //save REQUESTED data to SESSION variables
        $_SESSION['updatedFirstName']= db_str($_REQUEST['firstname']); 
        $_SESSION['updatedLastName'] = db_str($_REQUEST['lastname']); 
        $_SESSION['updatedPctAvail'] = floatval($_REQUEST['pctavail']);  
        $_SESSION['updatedUnavailDateStart'] = db_str($_REQUEST['unavaildatestart']);
        $_SESSION['updatedUnavailDateEnd'] = db_str($_REQUEST['unavaildateend']);
        $_SESSION['updatedSkill'] = db_str($_REQUEST['skill']);
        $_SESSION['updatedDailyRate'] = floatval($_REQUEST['dailyrate']);
        $_SESSION['updatedNotes'] = db_str($_REQUEST['notes']);
       
        // Show the confirmation form to choose yes/no
        echo view('task/update/confirm');
        exit;
    }
 } // END IF update page submitted
 
// Show the update page
echo view('task/update', [
        'results' => $_SESSION['selected[]'],
        'errors' => $errors
    ]);