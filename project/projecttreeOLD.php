<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *     P R O J E C T   S H O W   P R O J E C T   T A S K   T R E E             *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/
require_once 'main.php'; 

//function to print project tasks with dependencies
function printProjectTree( $task_id, $task_name ) { //recursive function
    
    //loop thru current task id to get all dependcies
    $dependencyResults = 1;
    $previous_dependency_id = 0;
    $current_task = $task_id;
    $projectTasks = [['task_id','task_name','DEP_FLAG']];
    $i = 0;
    while ( $dependencyResults ) { //while results of get dependency query is TRUE continue to process depdencies
        //select dependecy records 1 at a time using limit = 1 and getting the next higher depdency task until no more
        $dependencyQuery = 
            "SELECT 
              `TD`.`dependency_id`,
              `T`.`task_name` AS `dependency_name`
            FROM `task_dependencies` `TD`
            JOIN `tasks` `T`
            ON
                `TD`.`dependency_id` = `T`.`task_id`
            WHERE `TD`.`task_id` = '$task_id' 
                AND `TD`.`dependency_id` > '$previous_dependency_id' 
                ORDER BY `TD`.`dependency_id` LIMIT 1";

        $dependencyResults = db_results($dependencyQuery);
        $previous_dependency_id = $dependencyResults[0]['dependency_id'];
        
        if ( $dependencyResults ) :
            //add this dependent task to list of tasks to get processed recursively
            ++$i;
            $projectTasks[$i]['task_id'] =  $dependencyResults[0]['dependency_id'];
            $projectTasks[$i]['task_name'] =  $dependencyResults[0]['dependency_name'];
            $projectTasks[$i]['DEP_FLAG'] =  1; //flag this task as having dependencies
        endif; //if dependency found assign to depdendencyTask array
    } //END WHILE loop

    // Display the task, and process any dependencies
    echo "<ul>";
    
    
    foreach($projectTasks as $tasks) {
            $key = $tasks['task_id'];
            echo"<li>"; echo $key.' '.$tasks['task_name'];
            //if task has dependencies, recursively call printtree function
            if ($tasks['DEP_FLAG']) printProjectTree( $tasks['task_id'], $tasks['task_name']); 
            echo "</li>";
    } //END FOREACH projectTasks as tasks

    echo "</ul>";
} //END function printProjectTree

//function to identify all first generation tasks
function firstGenTasks($tasksArray) {    
    $key = $tasksArray['tasks_FK'];
    $firstGenQuery = 
        "SELECT `T`.`task_id`, `T`.`task_name` 
            FROM `tasks` `T`
        WHERE 
            `T`.`task_id` = '$key' AND
            `T`.`task_id` NOT IN (SELECT `TD`.`dependency_id` FROM `task_dependencies` `TD`)";

    //get results of query
    $firstGenRecords = db_results($firstGenQuery);        //call printProjectTree for each first generation task

    return($firstGenRecords);
    
} //END function firstGenTasks

?>
<html lang="en">
<head>
    <title>Project Task Flow Chart With Dependencies</title>
    <meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Project Task Flow Chart With Dependencies</h1>
<h2>Tasks for Project '$projectID':</h2>

    <?php
//initialize variables
$error = false;         // Default to no errors
$results = false;       // Array of search results from query or false if we don't want to show results

//assign selected project ID from user input
$projectID = '10000';

//set up SELECT query to retrieve all tasks associated with selected project_id
$selectTasks = 
    "SELECT  
        `TP`.`tasks_FK`,
        `T`.`task_name`
    FROM `jnct_tasks_projects` `TP`
    JOIN `tasks` `T`
    ON	
        `T`.`task_id` = `TP`.`tasks_FK`
    WHERE 
        `projects_fk` = '$projectID' 
    ORDER BY    
        `tasks_fk`";

//get results of query
$tasksResults = db_results($selectTasks);
if(!$tasksResults) : echo '** NO TASKS FOUND **'; die; //$errors[] = 'Query failed.'.mysqli_error($link);
endif;

//identify and process all first generation tasks
$firstGenTasks = [];
foreach($tasksResults as $tasks) {
    //find all tasks where no other task is dependent on it and flag as first generation task
    $firstGenResults = firstGenTasks($tasks);
    if($firstGenResults) : 
        foreach ($firstGenResults as $firstGenTasks) {
            echo"<ul>";
                echo "<li>"; echo $firstGenTasks['task_id'].' '. $firstGenTasks['task_name'];
            echo"</li>";
            printProjectTree($firstGenTasks['task_id'], $firstGenTasks['task_name']);
            echo "</ul>";
        } // END FOREACH firstGenResults as firstGenTasks
    endif; //first generation tasks
} //END FOREACH tasksArray as tasks
?>
</body>
</html>