<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                R E S O U R C E   D E L E T E   C O N F I R M               *
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
        if(isset($_POST['choice'])) { #user has entered a choice to confirm or cancel DELETE request
            $response = $_POST['choice'];
/******************************************************************************
 *                        CHECK USER CONFIRMATION RESPONSE                    *
 ******************************************************************************/

            #test $response value passed back with control from ResourceDeleteConfirm external call
            if ($response) {#user responded YES to confirmation choice

/******************************************************************************
 *                   DELETE RESOURCE RECORDS FROM DB                          *
 ******************************************************************************/
                
                #call external code to run SQL to delete records and return message
                $confirmMessage = require 'ToDoResourceDeleteSQL.php'; 

/******************************************************************************
 *               END DELETE RESOURCE RECORDS FROM DB                          *
 ******************************************************************************/
            }#END IF confirmation = YES

            else { #user selected NO - cancel DELETE
                $confirmMessage = 'Delete request canceled.';
            } #END ELSE UPDATE canceled
/******************************************************************************
 *                     END CHECK USER CONFIRMATION RESPONSE                   *
 ******************************************************************************/                    

/******************************************************************************
 *                        DISPLAY CONFIRMATION PAGE                           *
 ******************************************************************************/
            require 'ToDoResourceDeleteConfirmPage.html';
/******************************************************************************
 *                    END DISPLAY CONFIRMATION PAGE                           *
 ******************************************************************************/
        } #END IF isset $response
        else { #no valide response submitted
            $confirmMessage = 'Delete request canceled.';
            require 'ToDoResourceDeleteConfirmPage.html';
        } #END ELSE no valide response submitted
        
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          E N D   R E S O U R C E   D E L E T E   C O N F I R M             *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/