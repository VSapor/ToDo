<?php
/*******************************************************************************
 *                                                                             *
 *         R E S O U R C E   S E A R C H   M A S T E R   S C R I P T           *
 *                                                                             *
 *               (Called from 'ToDoResourceSearchDriver.php')              *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) { #new session
    session_start();
} # END IF new session

/*******************************************************************************
 *                                                                             *
 *                          INTERNAL FUNCTIONS                                 *
 *                                                                             *                                                                            *
 ******************************************************************************/

/******************************************************************************
 *                BUILD SEARCH SELECT WHERE CLAUSE FUNCTION                   *
 ******************************************************************************/
function buildwhereclause($DBField,$searchValue)
{
    GLOBAL $link;
    GLOBAL $numSearchFields;
    GLOBAL $whereClause;
    
    #check if WHERE condition already added and if so add '&' before adding additonal WHERE conditions
    if ($numSearchFields > 1) {
        $whereClause = $whereClause.' AND ';
    } #end IF numSearchFields > 1
    $searchValue = '%'.mysqli_real_escape_string($link,$searchValue).'%';
    $whereClause = $whereClause."$DBField LIKE '$searchValue'";
}#END buildwhereclause FUNCTION

/******************************************************************************
 *                         END buildwhereclause FUNCTION                      *
 ******************************************************************************/

/*******************************************************************************
 *                                                                             *
 *                      END INTERNAL FUNCTIONS                                 *
 *                                                                             *                                                                            *
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

/******************************************************************************
 *                       DISPLAY SEARCH RESOURCE MAIN MENU                    *
 ******************************************************************************/
require ('ToDoResourceSearchMenu.html');
/******************************************************************************
 *                       END DISPLAY SEARCH RESOURCE MAIN MENU                *
 ******************************************************************************/

#check to make sure at least on search value was entered
if(isset($_POST['search_id']) ||
   isset($_POST['search_first_name']) ||
   isset($_POST['search_last_name']) ||
   isset($_POST['search_skill']) ||
   isset($_POST['search_rate'])) {#at least one search value was entered
    
    #check to make sure that all values are NOT EMPTY  
    if (EMPTY($_POST['search_id'])&&
        EMPTY($_POST['search_first_name'])&&
        EMPTY($_POST['search_last_name'])&&
        EMPTY($_POST['search_skill'])&&
        EMPTY($_POST['search_rate'])) {
            echo '<br><strong><font color=red><center>'.
                    'Please enter at least one field to begin your resource search.'.
                '</strong></font></center><br>';
    } #end IF all values EMPTY
    
    else { #at least one search value is was entered

        #assign all user inputs to internal variables
        $searchID = strtolower($_POST['search_id']);
        $searchFirstName = strtolower($_POST['search_first_name']);
        $searchLastName = strtolower($_POST['search_last_name']);
        $searchSkill = strtolower($_POST['search_skill']);
        $searchRate = $_POST['search_rate'];
        $numSearchFields = 0;
        $whereClause = '';
        
/******************************************************************************
 * BUILD WHERE CLAUSE BASED ON USER INPUT                                     *
 ******************************************************************************/
        #if a ID was entered, add it to the SELECT WHERE clause
        if (!empty($searchID)) {
            #check that at least 2 characters of search string entered
            if (strlen($searchID) >= 2) {
                $numSearchFields++;
                $fieldName = "`id`";
                buildwhereclause($fieldName,$searchID);
            } #END IF at least 2 characters
            else { #too few letters entered
                die('You must provide at least 2 numbers of resource ID to search. Please try again.');
            } #end ELSE too few letters entered
        } #end IF searchID !EMPTY
        
        
        #if a FIRST_NAME was entered, add it to the SELECT WHERE clause
        if (!empty($searchFirstName)) {
            #check that at least 2 characters of search string entered
            if (strlen($searchFirstName) >= 2) {
                $numSearchFields++;
                $fieldName = "`first_name`";
                buildwhereclause($fieldName,$searchFirstName);
            } #END IF at least 2 characters
            else { #too few letters entered
                die('You must provide at least 2 letters of first name search. Please try again.');
            } #end ELSE too few letters entered
        } #end IF searchFirstName !EMPTY
        
        #if a LAST_NAME was entered, add it to the SELECT WHERE clause
        if (!empty($searchLastName)) {
            #check that at least 3 characters of search string entered
            if (strlen($searchLastName) >= 3) {
                $numSearchFields++;
                $fieldName = "`last_name`";
                buildwhereclause($fieldName,$searchLastName);
            } #END IF at least 3 characters
            else { #too few letters entered
                die('You must enter at least 3 letters of last name search. Please try again.');
            } #end ELSE too few letters entered
        } #end IF searchLastName !EMPTY
        
        #if a SKILL was entered, add it to the SELECT WHERE clause
        if (!empty($searchSkill)) {
            $numSearchFields++;
            $fieldName = "`skill`";
            buildwhereclause($fieldName,$searchSkill);
        } #END IF searchSkill !EMPTY
        
        #if a RATE was entered, add it to the SELECT WHERE clause
        if (!empty($searchRate)) {
            $numSearchFields++;
           #check if WHERE condition already added and if so add & before adding additonal WHERE conditions
            if ($numSearchFields > 1) {
                $whereClause = $whereClause.' AND ';
            }#END IF numSearchFields > 1
            $whereClause = $whereClause."`daily_rate` <= $searchRate";  
        }#end IF searchRate !EMPTY
       
/******************************************************************************
* END BUILD WHERE CLAUSE BASED ON USER INPUT                                  *
*******************************************************************************/

/******************************************************************************
* SET UP SEARCH QUERY WITH WHERE CLAUSE SEARH CRITERIA                        *
*******************************************************************************/
        
        $likeQuery = "SELECT 
                            *
                        FROM 
                            `resources`
                        WHERE
                            $whereClause
                        ORDER BY 
                            `id`";
/******************************************************************************
 * END SET UP SEARCH QUERY WITH WHERE CLAUSE SEARH CRITERIA                   *
 ******************************************************************************/
        
        
/******************************************************************************
 * RUN QUERY AND DISPLAY RESULTS                                              *
 ******************************************************************************/
        #run LIKE query and test if it was successful
        if($result = mysqli_query($link,$likeQuery)) {#$link is assigned in connect.inc

               #capture number of rows returned
                $numRows = mysqli_num_rows($result);
                $_SESSION['numRows'] = $numRows;
                $_SESSION['result'] = $result;
                
                #check if at least 1 row matched query
                if ($numRows != 0) {
/******************************************************************************
 * OUTPUT RESULTS IN TABULAR FORMAT                                           *
 ******************************************************************************/
                    #choose which display script to use based on ACTION chosen
                    $action = strtoupper($_SESSION['action']);
                    switch ($action) {
                        case "SEARCH":
                            #display SEARCH results with no checkboxes
                            require 'ToDoResourceSearchDisplayResults.php';
                            exit;
                        case "DELETE" :
                            #display DELETE results with checkboxes
                            require 'ToDoResourceDeleteDisplayResults.php';
                            exit;
                        case "UPDATE" :
                            #display UPDATE results with checkboxes
                            require 'ToDoResourceUpdateDisplayResults.php';
                            exit;
                        default :
                            die ('% UNKNOWN ACTION: FATAL ERROR %');
                    }
                                     
/******************************************************************************
 * END OUTPUT RESULTS IN TABULAR FORMAT                                       *
 ******************************************************************************/
                } #end if at least 1 row returned
                else {#no rows matched query
                    echo 'No resources matched your query.'.'<br>';
                } #end else no rows matched query
                
                # free all DB resources
                mysqli_free_result($result);
                
        } #end IF SELECT LIKE query successful
        else {  #SELECT LIKE QUERY FAILED
                echo 'Query failed.'.mysqli_error($link),'<br>';
        }       #end ELSE SELECT LIKE query failed
/******************************************************************************
 * END RUN QUERY AND DISPLAY RESULTS                                          *
 ******************************************************************************/        
    } #end IF at least one search field !EMPTY
} #end IF at least one field entered
else {#no search fields entered
    #echo '<br><strong><font color=red>'.'Please enter your search criteria.'.'</strong>'.'</font>';
} #end ELSE no search fields entered

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *    E N D   R E S O U R C E   S E A R C H   M A S T E R   S C R I P T        *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/