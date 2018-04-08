<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *     P R O J E C T   S H O W   P R O J E C T   T A S K   T R E E             *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/
require_once '../main.php';

// Check child tasks (dependencies) of a parent task
function childTasks($parentId) {
    // Get all the task that belong to this task
    $childTasks = db_results("SELECT task_id, task_name FROM tasks_new WHERE task_parent = ".$parentId);

    // Loop through each child and see if it has children
    foreach($childTasks as $k => $task) {
        $childTasks[$k]['child_tasks'] = childTasks($task['task_id']);
    }
    return $childTasks;
}

// Get tasks for each selected project recursively
$projects = [];
foreach((array) $_REQUEST['selected'] as $projectId) {
    // All tasks with task_parent_id = 0 are top-level tasks, get those and find children of each recursively
    $topLevelTasks = db_results("SELECT task_id, task_name FROM tasks_new WHERE task_project_id = ".$projectId." AND task_parent = 0");
    foreach($topLevelTasks as $k => $task) {
        $topLevelTasks[$k]['child_tasks'] = childTasks($task['task_id']);
    }

    $projects[$projectId] = [
        'id' => $projectId,
        'tasks' => $topLevelTasks,
    ];
}

echo view('project/search/task_tree/tpl', [
    'projects' => $projects
]);
exit;













//function to print project tasks with dependencies
function printProjectTree( $task_id, $task_name ) { //recursive function
    
    //loop thru current task id to get all dependcies
    $dependencyResults = 1;
    $previous_dependency_id = 0;
    $current_task = $task_id;
    $projectTasks = [];
    $i = 0;
    while ( $dependencyResults ) { //while results of get dependency query is TRUE continue to process depdencies
        //select dependecy records 1 at a time in ascending id order
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

    echo "<ul>"; //break on new parent tasks
    // Display the task, and process any dependencies
    foreach($projectTasks as $tasks) {
        $key = $tasks['task_id'];
        if ($key) :
            echo"<li>";
            echo $key.' '.$tasks['task_name']; 
            echo "</li>";
        endif; //if key not null
        //if task has dependencies, recursively call printtree function
        if ($tasks['DEP_FLAG']) printProjectTree( $tasks['task_id'], $tasks['task_name']); //recursive call for all dependency tasks
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
    $firstGenRecords = db_results($firstGenQuery);

    return($firstGenRecords);
} //END function firstGenTasks

?>
<html>
    <head>
        <title>Project Task Flow Chart With Dependencies</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS style can replace inline html style -->
        <style>
            .project-tree {
                width: 100%;
                border-collapse: collapse;
            }
            .project-tree thead th {
                padding: 3px 5px;
                font-weight: bold;
            }
            .project-tree tbody td {
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #fff;
            }
            .project-tree tbody td {
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #fff;
            }
            .project-tree tbody tr:nth-last-of-type(even) td {
                background: #e8e8e8;
            }
        </style>
    </head>
    <body style="background-color: aqua;">

<?php
//initialize variables
$error = false;         // Default to no errors
$tasksResults = false;  // Array of select results from query or false if we don't want to show results

// Capture ID for each resource record selected
$projectIDs = [];
$numSelected = 0;
foreach($_REQUEST['selected'] as $id) {
    $projectIDs[] = intval($id);
    ++$numSelected;
} //END foreach ID selected

//loop through each project ID selected
for ($i=0; $i < $numSelected; ++$i) {
    ?>  <h1 style="text-align: center; color: blue;">Project Task Flow Chart With Dependencies</h1>
        <h2>Tasks for Project <?= $projectIDs[$i] ?> :</h2>
        
        <!-- Show flash message here -->
        <?php if(flash_message_exists()): ?>
            <p style="text-align: center; color: red;">
                <?php echo flash_message(); ?>
            </p>
        <?php endif; ?>        
    
    <?php 
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
            `projects_fk` = '$projectIDs[$i]' 
        ORDER BY    
            `tasks_fk`";

    //get results of query
    $tasksResults = db_results($selectTasks);
    
    if(!$tasksResults) : 
        echo '** NO TASKS FOUND **'; 
        $errors[] = 'Query failed.'.mysqli_error($link);
    endif;
    ?>

    <?php if($errors): ?>
        <?php foreach($errors as $msg): ?>
            <p class="search-error" style="color: red; text-align: center;">
                <?php echo $msg; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php
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
                printProjectTree($firstGenTasks['task_id'], $firstGenTasks['task_name']); //call printProjectTree for each first generation task found
                echo "</ul>";
            } // END FOREACH firstGenResults as firstGenTasks
        endif; //first generation tasks
    } //END FOREACH tasksArray as tasks
    ?>
    <br><br><br>
    <a href="/projects/ToDo/project/index.php">
        <strong>Click here to return to To Project Management Menu</strong>
    </a>
    <br><br><br>
    <?php
} //END FOREACH selected project
?>
    </body>
</html>