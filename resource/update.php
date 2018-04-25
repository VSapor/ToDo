<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *               R E S O U R C E   U P D A T E   D R I V E R                   *
 *                                                                             *
 *                                                                             *                                                                         *
 ******************************************************************************/
require_once '../main.php';
$errors = false;

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
        //Do updates
        
        $updatedFirstName = db_str($_REQUEST['firstname']);
        $updatedLastName = db_str($_REQUEST['lastname']);
        $updatedPctAvail = floatval($_REQUEST['pctavail']);
        $updatedUnavailDateStart = db_str($_REQUEST['unavaildatestart']);
        $updatedUnavailDateEnd = db_str($_REQUEST['unavaildateend']);
        $updatedSkill = db_str($_REQUEST['skill']);
        $updatedDailyRate = floatval($_REQUEST['dailyrate']);
        $updatedNotes = db_str($_REQUEST['notes']);
        
        $updateQuery = 
               "UPDATE `resources`
                SET
                    `resource_first_name` = '".$updatedFirstName."',
                    `resource_last_name` = '".$updatedLastName."',
                    `resource_pct_avail` = '".$updatedPctAvail."',
                    `resource_unavail_date_start` = '".$updatedUnavailDateStart."',
                    `resource_unavail_date_end` = '".$updatedUnavailDateEnd."',
                    `resource_skill` = '".$updatedSkill."',
                    `resource_daily_rate` = '".$updatedDailyRate."',
                    `resource_notes` = '".$updatedNotes."'
                WHERE
                    `resource_id` = '".$_REQUEST['resourceID']."'
                ";

            $result = db_query($updateQuery);
            if($result) $_SESSION['FLASH_MSG'] = 'Successfully updated resource ID: '.$_SESSION['selectedID'];
            else $errors[] = 'UPDATE Query failed.'.mysqli_error($link);

        // Send back to search
        header('Location: /projects/ToDo/resource/index.php?search');
        exit;
    } //END ELSE all required fields entered - do update
} //END IF update submitted
else { //initial call; retrieve and store value of $row
    $_SESSION['row']  = $_GET['row'];
}

// Show the update page
echo view('resource/update', [
        'results' => $_SESSION['results[]'][$_SESSION['row']],
        'errors' => $errors
    ]);