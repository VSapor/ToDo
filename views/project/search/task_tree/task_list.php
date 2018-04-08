<ul>
    <?php foreach($tasks as $task): ?>
        <li>
            <?php echo $task['task_id']; ?>: <?php echo $task['task_name']; ?>
            
            <?php echo view('project/search/task_tree/task_list', ['tasks' => $task['child_tasks']]); ?>
        </li>
    <?php endforeach; ?>
</ul>