<?php
/*******************************************************************************
 *                                                                             *
 *         R E S O U R C E   A D D   M A S T E R   S C R I P T                 *
 *                                                                             *
 *            (Called from 'ToDoResourceAddDriver.php')                    *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

#display RESOURCE ADD main menu
require 'ToDoResourceAddMenu.html';

#check if form was submitted
if (isset($_POST['id']) ||
    isset($_POST['firstname']) ||
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
    } #END IF any required field is NULL
    else { #all required fields are populated      
        #save POSTED data to SESSION variables
        if (EMPTY($_POST['id'])) { #no ID specified; allow SQL to auto increment unique ID 
            $_SESSION['id'] = NULL;
        } #END IF ID empty
        else { #ID entered
            $_SESSION['id'] = $_POST['id'];
            $id = $_SESSION['id'];
            
/*******************************************************************************
 *                  TEST IF ID ALREADY EXISTS                                  *
 ******************************************************************************/
/******************************************************************************
 *                         CONNECT TO DB                                      *
 ******************************************************************************/
#assign variables used in connect.inc.php
$mySQLHost = 'localhost';
$mySQLUserName = 'root';
$mySQLPassword = '';#no password assigned to our local server
$mySQLDBName = 'todo';

#include code to connect to TODO DB
require 'DBConnect.inc.php';
/******************************************************************************
 *                      END CONNECT TO DB                                     *
 ******************************************************************************/
/*******************************************************************************
 *          SET UP SEARCH QUERY USING USER SPECIFIED ID                        *
 ******************************************************************************/
            $selectQuery = "SELECT 
                                `id`
                            FROM 
                                `resources`
                            WHERE
                                `id` = '$id'";            
/*******************************************************************************
 *          END SET UP SEARCH QUERY USING USER SPECIFIED ID                    *
 ******************************************************************************/
        
/******************************************************************************
 * RUN SELECT QUERY AND VERIFY RESULTS                                        *
 ******************************************************************************/
            if($result = mysqli_query($link,$selectQuery)) {#$link is assigned in connect.inc
                   #capture number of rows returned
                    $numRows = mysqli_num_rows($result);
                    #check if any rows match query
                    if ($numRows != 0) { #resource ID already exists
                        echo "<font color='red'>".'That resource ID already exists. Please enter a new one.'."</font>".'<br>';
                    }#END IF resource ID already exists
                    else { #unique ID entered by user
                        $_SESSION['firstname']= htmlentities($_POST['firstname']); 
                        $_SESSION['lastname'] = htmlentities($_POST['lastname']); 
                        $_SESSION['pctavail'] = $_POST['pctavail'];  
                        $_SESSION['unavaildatestart'] = $_POST['unavaildatestart'];
                        $_SESSION['unavaildateend'] = $_POST['unavaildateend'];
                        $_SESSION['skill'] = htmlentities($_POST['skill']);
                        $_SESSION['dailyrate'] = $_POST['dailyrate'];
                        $_SESSION['notes'] = htmlentities($_POST['notes']);

                        #present user with page to confirm or cancel ADD
                        require 'ToDoResourceAddConfirmChoice.html';
                    }#END ELSE unique ID entered by user
            } #end IF SELECT query successful
        else {  #SELECT QUERY FAILED
                echo 'Query failed.'.mysqli_error($link),'<br>';
        }       #end ELSE SELECT query failed
/******************************************************************************
 * END RUN QUERY AND VERIFY RESULTS                                           *
 ******************************************************************************/
/*******************************************************************************
 *              END TEST IF ID ALREADY EXISTS                                  *
 ******************************************************************************/     
        } #END ELSE ID entered
        
    } #END ELSE all required fields populated
} #END IF form submitted
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *    E N D   R E S O U R C E   A D D   M A S T E R   S C R I P T              *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/