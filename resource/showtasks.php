<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 * R E S O U R C E   S H O W   A S S I G N E D   T A S K S   S C R I P T       *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

// Capture ID for each resource record selected
$taskIDs = [];
$numSelected = 0;
$results= [];
foreach($_REQUEST['selected'] as $id) {
    $taskIDs[] = intval($id);
    ++$numSelected;
} //END foreach ID selected

//run JOIN query for each resource ID selected
$resultsFound = 0;
for ($i=0; $i < $numSelected; ++$i) {
    $joinQuery = 
        "SELECT
            `R`.`resource_id`,
            `R`.`resource_first_name`,
            `R`.`resource_last_name`,
            `T`.`task_id`,
            `T`.`task_name`
        FROM `resources` `R`
        INNER JOIN `jnct_tasks_resources` `TR`
            ON 
                `R`.`resource_id` = `TR`.`Resource_FK`
        INNER JOIN `tasks` `T`
            ON	
                `T`.`task_id` = `TR`.`Task_FK`
        WHERE 
            `R`.`resource_id` = '$taskIDs[$i]'
        ORDER BY
            `R`.`resource_id`, `T`.`task_id`";
    
    // Get results from query
    $results[$i] = db_results($joinQuery);
    $resultsFound = $resultsFound + count($results[$i]);
    if(!$results) $errors[] = 'JOIN Query failed.'.mysqli_error($link);
} // END FOR loop

if (!$resultsFound) { //no results returned from JOIN query
    $results = [];
}

//display resource assigned tasks results page
echo view('resource/assignedtaskstpl', [
    'results' => $results,
    'errors' => $errors
]);