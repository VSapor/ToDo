<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                   R E S O U R C E   A D D   C O N F I R M                  *
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
        if(isset($_POST['choice'])) { #user has entered a choice to confirm or cancel ADD request
            $response = $_POST['choice'];
/******************************************************************************
 *                        CHECK USER CONFIRMATION RESPONSE                    *
 ******************************************************************************/

            #test $response value passed back with control from ResourceAddConfirm external call
            if ($response) {#user responded YES to confirmation choice

/******************************************************************************
 *                   ADD RESOURCE RECORDS FROM DB                          *
 ******************************************************************************/
                
                #call external code to run SQL to addrecords and return message
                $confirmMessage = require 'ToDoResourceAddSQL.php'; 
                
/******************************************************************************
 *               END ADD RESOURCE RECORDS FROM DB                          *
 ******************************************************************************/
            }#END IF confirmation = YES

            else { #user selected NO - cancel ADD
                $confirmMessage = 'Add request canceled.';
                #blank out add fields so they do not appear on confirmation page
                $id = '';
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
            require 'ToDoResourceAddConfirmPage.html';
/******************************************************************************
 *                    END DISPLAY CONFIRMATION PAGE                           *
 ******************************************************************************/
        } #END IF isset $response
        else { #SUBMIT key clicked without a valid response
            $confirmMessage = 'Add request canceled.';
            #blank out add fields so they do not appear on confirmation page
            $id = '';
            $firstName = '';
            $lastName = '';
            $pctAvail = '';
            $unavailDateStart = '';
            $unavailDateEnd = '';
            $skill = '';
            $dailyRate = '';
            $notes = '';
            require 'ToDoResourceAddConfirmPage.html';
        } #END ELSE SUBMIT key clicked without valid response
        
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *             E N D   R E S O U R C E   A D D   C O N F I R M                *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/