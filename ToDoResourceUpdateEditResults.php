<?php

/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          D I S P L A Y   D A T A B A S E   C O N T E N T                   *
 *                      F O R   E D I T I N G                                 *                                                                       
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/

#initialize error reporting settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} #END IF new session

#check if form was submitted
if (isset($_POST['firstname']) ||
    isset($_POST['lastname']) ||
    isset($_POST['pctavail']) ||
    isset($_POST['unavaildatestart']) ||
    isset($_POST['unavaildateend']) ||
    isset($_POST['skill']) ||
    isset($_POST['dailyrate']) ||
    isset($_POST['notes']) 
    ) { #submit key clicked
    if (EMPTY($_POST['firstname']) ||
        EMPTY($_POST['lastname']) ||
        IS_NULL($_POST['pctavail']) ||
        EMPTY($_POST['skill']) ||
        IS_NULL($_POST['dailyrate']) 
        ) { #not all required fields have been populated          
        echo '<br><br>';
        echo 'Please enter all required fields.'.'<br><br>';
    } #END IF any required field is EMPTY
    else { #all required fields are populated
        
        #save POSTED data to SESSION variables
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['firstname']= htmlentities($_POST['firstname']); 
        $_SESSION['lastname'] = htmlentities($_POST['lastname']); 
        $_SESSION['pctavail'] = $_POST['pctavail'];  
        $_SESSION['unavaildatestart'] = $_POST['unavaildatestart'];
        $_SESSION['unavaildateend'] = $_POST['unavaildateend'];
        $_SESSION['skill'] = htmlentities($_POST['skill']);
        $_SESSION['dailyrate'] = $_POST['dailyrate'];
        $_SESSION['notes'] = htmlentities($_POST['notes']);
        
        #present user with page to confirm or cancel UPDATEs
        require 'ToDoResourceUpdateConfirmChoice.html';
        
    } #END ELSE all required fields populated
} #END IF form submitted

/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          E N D  D I S P L A Y   D A T A B A S E   C O N T E N T            *
 *                      F O R   E D I T I N G                                 *                                                                       
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/