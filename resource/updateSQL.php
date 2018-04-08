<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *               R E S O U R C E   U P D A T E   S Q L                         *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/
require_once '../main.php';
$errors = false;

//check if coming in on confirmation path
if(isset($_REQUEST['confirm'])) {
    // See if yes or no was chosen for confirm action
    if($_REQUEST['choice'] == 0) {
        // Send back to search
        $msg = 'Update resource canceled';
        $_SESSION['FLASH_MSG'] = $msg;
        header('Location: /projects/ToDo/resource/index.php?search');
        exit;
    } //END IF confirm = NO
    
    //Do updates
    $updateQuery = 
           "UPDATE `resources`
            SET
                `resource_first_name` = '".$_SESSION['updatedFirstName']."',
                `resource_last_name` = '".$_SESSION['updatedLastName']."',
                `resource_pct_avail` = '".$_SESSION['updatedPctAvail']."',
                `resource_unavail_date_start` = '".$_SESSION['updatedUnavailDateStart']."',
                `resource_unavail_date_end` = '".$_SESSION['updatedUnavailDateEnd']."',
                `resource_skill` = '".$_SESSION['updatedSkill']."',
                `resource_daily_rate` = '".$_SESSION['updatedDailyRate']."',
                `resource_notes` = '".$_SESSION['updatedNotes']."'
            WHERE
                `resource_id` = '".$_SESSION['selectedID']."'
            ";

            $result = db_query($updateQuery);
            if($result) $_SESSION['FLASH_MSG'] = 'Successfully updated resource ID: '.$_SESSION['selectedID'];
            else $errors[] = 'UPDATE Query failed.'.mysqli_error($link);

    // Send back to search
    header('Location: /projects/ToDo/resource/index.php?search');
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
        echo view('resource/update/confirm');
        exit;
    }
 } // END IF update page submitted
 
// Show the update page
echo view('resource/update', [
        'results' => $_SESSION['selected[]'],
        'errors' => $errors
    ]);