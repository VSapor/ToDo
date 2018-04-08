<!doctype html>
<html lang="en">
<head>
    <title>Project Task Flow Chart With Dependencies</title>
    <meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<h1>Project Task Flow Chart With Dependencies</h1>
<?php
require_once '../main.php';

function get_tasks($tasks, $dependency) { //recursive
$D = $dependency;
    // Display the task, and process any dependencies
    foreach ( $tasks as $task ) {        
        //echo '<br>'.'**$task[tasks_FK]: '.$task['tasks_FK'].' '.$depdendencyExists.'<br>';
        $key = $task['tasks_FK'];
        //print the task
        if ($D == 'TRUE') {
            //echo "<ul>";
                //echo "<li>";
        } //END IF dependency exists
        else {
            //echo "</li>";
            //echo "<li>";
            //$D = 'TRUE';
        } //END ELSE no depdency exists
        ?>
        <a href='#'><?php //echo $task['tasks_FK'].' '.$task['task_name']; ?></a>
        <?php
    //echo '$key = '.$task['tasks_ID'].'<br>';
        //set up SELECT query to retrieve any/all dependent tasks for each project task
        $selectDependencies = 
            "SELECT  
                `TD`.`dependency_id` AS `tasks_FK`,
                `T`.`task_name` 
            FROM `task_dependencies` `TD`
            JOIN `tasks` `T`
            ON	
                `TD`.`dependency_id` = `T`.`task_id`
            WHERE 
                `TD`.`task_id` = '$key'
            ORDER BY    
                `TD`.`dependency_id`";
        
    // Get results from query
        $dependenciesResults = db_results($selectDependencies); 
        //print_r($dependenciesResults);
        //check if any depdendencies exist for this task
        if (!$dependenciesResults) { //no dependencies exist for current task_id
            //echo "</li>";
            echo '** NO RESULTS **'.$key.' '.$D = 'FALSE'.'<br>';
//echo '<br>'.'**NO DEPENDENCY FOUND ** '.$task['tasks_FK'].' '.$depdendencyExists.'<br>';
        } //END IF no dependencies exist
        else { //no depdendencies
            echo '** YES RESULTS **'.$key.' '.$D = 'TRUE'.'<br>';
//echo '<br>'.'**DEPENDENCY FOUND ** '.$task['tasks_FK'].' '.$depdendencyExists.'<br>';
            get_tasks($dependenciesResults, $D);
        } //END ELSE depdendencies exist
    } //END foreach task
} //END function gettasks

function get_dependencies ($resultsArray) {
    $i = 0;
    $results_dependencies = [['task_FK', 'task_name', 'dep_flag']];
    foreach($resultsArray as $tasks) {
        //print_r($tasks);
        $key = $tasks['tasks_FK'];

        $selectDependencies = 
                "SELECT  
                    `TD`.`dependency_id`,
                    `T`.`task_name` 
                FROM `task_dependencies` `TD`
                JOIN `tasks` `T`
                ON	
                    `TD`.`dependency_id` = `T`.`task_id`
                WHERE 
                    `TD`.`task_id` = '$key'
                ORDER BY    
                    `TD`.`dependency_id`";

        // Get results from query
            $dependenciesResults = db_results($selectDependencies);
            if ($dependenciesResults) {
                $results_dependencies[$i]['tasks_FK'] =  $tasks['tasks_FK'];
                $results_dependencies[$i]['task_name'] =  $tasks['task_name'];
                $results_dependencies[$i]['dep_flag'] =  'YES';

            } //END IF dependency found
            else {
                $results_dependencies[$i]['tasks_FK'] =  $tasks['tasks_FK'];
                $results_dependencies[$i]['task_name'] =  $tasks['task_name'];
                $results_dependencies[$i]['dep_flag'] =  'NO';

            } //END ELSE no dependent tasks
            ++$i;
    } //END FOREACH tasksResults array as tasks array
    return($results_dependencies);
} //END FUNCTION get_dependencies

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

//find and store all dependencies tasks for each project task
$tasksWithDependencies = get_dependencies($tasksResults);
print_r($tasksWithDependencies) ; die;

echo "<h2>Tasks for Project '$projectID':</h2>";
?>
    <div class="tree">
<?php
//call recursive function to get all task dependencies
get_tasks( $tasksResults, $dependencyExists, $keys, $kCount );
?>  
            </li>
        </ul>
    </div>
</body>
</html>