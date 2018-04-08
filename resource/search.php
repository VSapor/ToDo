<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *          R E S O U R C E   S E A R C H   M A S T E R   S C R I P T          *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/
$error = false;         // Default to no errors
$results = false;       // Array of search results from query or false if we don't want to show results

// See if we are searching
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'search') {

    //check to make sure that all values are NOT EMPTY  
    if (EMPTY($_REQUEST['search_id'])&&
        EMPTY($_REQUEST['search_first_name'])&&
        EMPTY($_REQUEST['search_last_name'])&&
        EMPTY($_REQUEST['search_skill'])&&
        EMPTY($_REQUEST['search_rate'])) {
            $errors[] = 'Please enter at least one field to begin your resource search.';
    } //end IF all values EMPTY
    
    else { //at least one search value is was entered           
         
        //store search fields in array to pass to function BuiltWhereClause
        $searchFields = [
            'id' => ['dbfield' => 'resource_id', 'searchfield' => '$searchID', 'value' => strtolower($_REQUEST['search_id']), 'actlen' => 0, 'minlen' => 0],
            'firstName' => ['dbfield' => 'resource_first_name', 'searchfield' => '$searchFirstName', 'value' => strtolower($_REQUEST['search_first_name']), 'actlen' => strlen($_REQUEST['search_first_name']), 'minlen' => 2],
            'lastName' => ['dbfield' => 'resource_last_name', 'searchfield' => '$searchLastName', 'value' => strtolower($_REQUEST['search_last_name']), 'actlen' => strlen($_REQUEST['search_last_name']), 'minlen' => 3],
            'skill' => ['dbfield' => 'resource_skill', 'searchfield' => '$searchSkill', 'value' => strtolower($_REQUEST['search_skill']), 'actlen' => 0, 'minlen' => 0],
            'dailyRate' => ['dbfield' => 'resource_daily_rate', 'searchfield' => '$searchDailyRate','value' => $_REQUEST['search_rate'], 'actlen' => 0, 'minlen' => 0]
        ];

        //build where clause using search fields
        $wheres = build_where_clause($searchFields, 'resource');
        $errors = $_SESSION['build_where_clause_errors'];

        if (!$errors) {
            // set up and run SELECT query
            $likeQuery = "SELECT 
                                *
                            FROM 
                                `resources`
                            WHERE
                                ".implode(' AND ', $wheres)."
                            ORDER BY 
                                `resource_id`";
            // Get results from query
            $results = db_results($likeQuery);
            if(!$results) $errors[] = 'Query failed.'.mysqli_error($link);
        } // END IF no errors
    } //end ELSE at least one search field entered
} //end IF searching

// Show the search page
echo view('resource/search/tpl', [
    'results' => $results,
    'errors' => $errors
]);