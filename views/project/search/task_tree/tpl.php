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
    <h1 style="text-align: center; color: blue;">Project Task Flow Chart With Dependencies</h1>

    <?php foreach($projects as $project): ?>
        <div style="padding: 20px; margin: 15px 0;">
            <?php echo view('project/search/task_tree/project_list', ['project' => $project]); ?>
        </div>
    <?php endforeach; ?>

    <p>
        <a href="/projects/ToDo/project/index.php">
            <strong>Click here to return to To Project Management Menu</strong>
        </a>
    </p>

    <!-- Printing some vars for debugging purposes.  Can be removed when no longer needed -->
    <pre style="padding: 20px; border: 1px solid #ccc; background: #fff;">
        <?php echo print_r($projects, true); ?>
    </pre>
</body>
</html>