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
}    
        #check if a response was entered
        if(isset($_POST['choice'])) { #user has entered a choice to confirm or cancel UPDATE request
            $response = $_POST['choice'];
/******************************************************************************
 *                        CHECK USER CONFIRMATION RESPONSE                    *
 ******************************************************************************/

            #test $response value passed back with control from ResourceUpdateConfirm external call
            if ($response) {#user responded YES to confirmation choice

/******************************************************************************
 *                   UPDATE RESOURCE RECORDS FROM DB                          *
 ******************************************************************************/
                
                #call external code to run SQL to update records and return message
                $confirmMessage = require 'ToDoResourceUpdateSQL.php'; 
                
/******************************************************************************
 *               END UPDATE RESOURCE RECORDS FROM DB                          *
 ******************************************************************************/
            }#END IF confirmation = YES

            else { #user selected NO - cancel UPDATE
                $confirmMessage = 'Update request canceled.';
                #blank out updated fields so they do not appear on confirmation page
                $firstName = '';
                $lastName = '';
                $pctAvail = '';
                $unavailDateStart = '';
                $unavailDateEnd = '';
                $skill = '';
                $dailyRate = '';
                $notes = '';
            }
/******************************************************************************
 *                     END CHECK USER CONFIRMATION RESPONSE                   *
 ******************************************************************************/                    

/******************************************************************************
 *                        DISPLAY CONFIRMATION PAGE                           *
 ******************************************************************************/
            require 'ToDoResourceUpdateConfirmPage.html';
/******************************************************************************
 *                    END DISPLAY CONFIRMATION PAGE                           *
 ******************************************************************************/
        } #END IF isset $response
        else { #SUBMIT key clicked without a valid response
            $confirmMessage = 'Update request canceled.';
            #blank out updated fields so they do not appear on confirmation page
            $firstName = '';
            $lastName = '';
            $pctAvail = '';
            $unavailDateStart = '';
            $unavailDateEnd = '';
            $skill = '';
            $dailyRate = '';
            $notes = '';
            require 'ToDoResourceUpdateConfirmPage.html';
        } #END ELSE SUBMIT key clicked without valid response
        
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