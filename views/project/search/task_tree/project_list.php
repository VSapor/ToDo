<h2>Tasks for Project <?php echo $project['id']; ?> :</h2>

<?php echo view('project/search/task_tree/task_list', ['tasks' => $project['tasks']]); ?>