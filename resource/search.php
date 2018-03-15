<?php

$error = false;         // Default to no errors
$results = false;       // Array of search results from query or false if we don't want to show results
$interactive = false;   // If true, show the checkboxes

// See if we are searching
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'search') {
    $wheres = [];           // Array of where clauses to use for search

    #check to make sure that all values are NOT EMPTY  
    if (EMPTY($_REQUEST['search_id'])&&
        EMPTY($_REQUEST['search_first_name'])&&
        EMPTY($_REQUEST['search_last_name'])&&
        EMPTY($_REQUEST['search_skill'])&&
        EMPTY($_REQUEST['search_rate'])) {
            $errors[] = 'Please enter at least one field to begin your resource search.';
    } #end IF all values EMPTY
    
    else { #at least one search value is was entered

        #assign all user inputs to internal variables
        $searchID = strtolower($_REQUEST['search_id']);
        $searchFirstName = strtolower($_REQUEST['search_first_name']);
        $searchLastName = strtolower($_REQUEST['search_last_name']);
        $searchSkill = strtolower($_REQUEST['search_skill']);
        $searchRate = $_REQUEST['search_rate'];

        /******************************************************************************
         * BUILD WHERE CLAUSE BASED ON USER INPUT                                     *
         ******************************************************************************/
        #if a ID was entered, add it to the SELECT WHERE clause
        if (!empty($searchID)) {
            #check that at least 2 characters of search string entered
            if (strlen($searchID) >= 2) $wheres[] = "id LIKE '%".db_str($searchID)."%'";
            else $errors[] = 'You must provide at least 2 numbers of resource ID to search. Please try again.';
        } #end IF searchID !EMPTY
        
        
        #if a FIRST_NAME was entered, add it to the SELECT WHERE clause
        if (!empty($searchFirstName)) {
            #check that at least 2 characters of search string entered
            if (strlen($searchFirstName) >= 2) $wheres[] = "first_name LIKE '%".db_str($searchFirstName)."%'";
            else $errors[] = 'You must provide at least 2 letters of first name search. Please try again.';
        } #end IF searchFirstName !EMPTY
        
        #if a LAST_NAME was entered, add it to the SELECT WHERE clause
        if (!empty($searchLastName)) {
            #check that at least 3 characters of search string entered
            if (strlen($searchLastName) >= 3) $wheres[] = "last_name LIKE '%".db_str($searchLastName)."%'";
            else $errors[] = 'You must enter at least 3 letters of last name search. Please try again.';
        } #end IF searchLastName !EMPTY
        
        #if a SKILL was entered, add it to the SELECT WHERE clause
        if (!empty($searchSkill)) $wheres[] = "skill LIKE '%".db_str($searchSkill)."%'";

        #if a RATE was entered, add it to the SELECT WHERE clause
        if (!empty($searchRate)) $wheres[] = "daily_rate <= ".intval($searchRate);

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
                            ".implode(' AND ', $wheres)."
                        ORDER BY 
                            `id`";
        /******************************************************************************
         * END SET UP SEARCH QUERY WITH WHERE CLAUSE SEARH CRITERIA                   *
         ******************************************************************************/

        // Get results from query
        $results = db_results($likeQuery);
        if(!$results) $errors[] = 'Query failed.'.mysqli_error($link);

        // See if we want the checkboxes in search results
        $action = strtoupper($_SESSION['action']);
        switch ($action) {
            case "DELETE" :
            case "UPDATE" :
                $interactive = true;
        }
    } #end IF at least one search field !EMPTY
} #end IF at least one field entered

/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *    E N D   R E S O U R C E   S E A R C H   M A S T E R   S C R I P T        *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

// Show the search page
echo view('resource/search/tpl', [
    'results' => $results,
    'errors' => $errors,
    'interactive' => $interactive
]);