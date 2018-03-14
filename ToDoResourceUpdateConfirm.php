<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                R E S O U R C E   U P D A T E   C O N F I R M               *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} # END IF new session
 
#check for user submission 
if (isset($_POST['selected'])) { #submit key clicked
    if (EMPTY($_POST['selected'])) { #no records selected for update
        echo 'No records selected for update.'.'<br>';
    } #END IF no records selected
    else { #at least 1 record selected for update
/******************************************************************************
 *          VERIFY ONLY 1 RECORD SELECTED FOR UPDATE                          *
 ******************************************************************************/
        $numSelected = count($_POST['selected']);
                
        #check if no records selected
        if ($numSelected == 0) { #no records selected
            echo 'No records selected for update.'.'<br>';
        } #END IF no records selected
        
        #check if more than 1 record selected
        if ($numSelected > 1) { #more than 1 record selected
            require 'ToDoResourceUpdateMultipleRecordsErrorPage.html';
        } # END IF more than 1 record selected
        else { #only 1 record selected verified
            $key = $_POST['selected'][0];
            echo '<center><strong>'.'You selected resource ID '.$key.' for update: '.'<br><br>';
                #scan DB search results to find selected record by ID
                foreach($_SESSION['rowArray'] as $selectedRow) {  
                    if ($selectedRow['id'] == $key) { #$_SESSION ID matches selected ID 
                        $_SESSION['selectedID'] = $selectedRow['id'];
                        $_SESSION['selectedFirstName'] = $selectedRow['first_name'];
                        $_SESSION['selectedLastName'] = $selectedRow['last_name'];
                        $_SESSION['selectedPctAvail'] = $selectedRow['pct_avail'];
                        $_SESSION['selectedUnavailDateStart'] = $selectedRow['unavail_date_start'];
                        $_SESSION['selectedUnavailDateEnd'] = $selectedRow['unavail_date_end'];
                        $_SESSION['selectedSkill'] = $selectedRow['skill'];
                        $_SESSION['selectedDailyRate'] = $selectedRow['daily_rate'];
                        $_SESSION['selectedNotes'] = $selectedRow['notes'];
                    } #END IF ID match found
                } #END FOREACH $_SESSION
            #display confirmation page
            require 'ToDoResourceUpdateEditResults.html';
        } #END ELSE only 1 record selected 
        
/******************************************************************************
 *                  END VERIFY ONLY 1 record selected for update              *
 ******************************************************************************/             
    } #END ELSE at least 1 record selected for update
} #END IF submit key clicked
else { #no records selected
    #display NO RECORDS message page
    require 'ToDoResourceUpdateConfirmNORECS.html';
} #END ELSE no records selected

/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          E N D   R E S O U R C E   U P D A T E   C O N F I R M             *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/