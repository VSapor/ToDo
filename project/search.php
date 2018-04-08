<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *          P R O J E C T   S E A R C H   M A S T E R   S C R I P T            *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/
$error = false;         // Default to no errors
$results = false;       // Array of search results from query or false if we don't want to show results

// See if we are searching
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'search') {
   
    //check to make sure that all values are NOT EMPTY  
    if (EMPTY($_REQUEST['search_id'])&&
        EMPTY($_REQUEST['search_name'])&&
        IS_NULL($_REQUEST['search_priority'])&&
        IS_NULL($_REQUEST['search_status'])) {
            $errors[] = 'Please enter at least one field to begin your project search.';
    } //end IF all values EMPTY
    
    else { //at least one search value is was entered           
         
        //store search fields in array to pass to function BuiltWhereClause
        $searchFields = [
            'id' => ['dbfield' => 'project_id', 'searchfield' => '$searchID', 'value' => strtolower($_REQUEST['search_id']), 'actlen' => 0, 'minlen' => 0],
            'name' => ['dbfield' => 'project_name', 'searchfield' => '$searchName', 'value' => strtolower($_REQUEST['search_name']), 'actlen' => strlen($_REQUEST['search_name']), 'minlen' => 2],
            'priority' => ['dbfield' => 'project_priority', 'searchfield' => '$searchPriority', 'value' => $_REQUEST['search_priority'], 'actlen' =>  0, 'minlen' => 0],
            'status' => ['dbfield' => 'project_status', 'searchfield' => '$searchStatus', 'value' => $_REQUEST['search_status'], 'actlen' => 0, 'minlen' => 0]
        ];

        //build where clause using search fields
        $wheres = build_where_clause($searchFields, 'project');
        $errors = $_SESSION['build_where_clause_errors'];

        if (!$errors) {
            // set up and run SELECT query
            $likeQuery = "SELECT 
                                *
                            FROM 
                                `projects`
                            WHERE
                                ".implode(' AND ', $wheres)."
                            ORDER BY 
                                `project_id`";
            // Get results from query
            $results = db_results($likeQuery);
            if(!$results) $errors[] = 'Query failed.'.mysqli_error($link);
        } // END IF no errors
    } //end ELSE at least one search field entered
} //end IF searching

// Show the search page
echo view('project/search/tpl', [
    'results' => $results,
    'errors' => $errors
]);