<html>
    <head>
        <title>Resource Search Menu</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS style can replace inline html style -->
        <style>
            .assigned-tasks-results-table {
                width: 100%;
                border-collapse: collapse;
            }
            .assigned-tasks-results-table thead th {
                padding: 3px 5px;
                font-weight: bold;
            }
            .assigned-tasks-results-table tbody td {
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #fff;
            }
            .assigned-tasks-results-table tbody td {
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #fff;
            }
            .assigned-tasks-results-table tbody tr:nth-last-of-type(even) td {
                background: #e8e8e8;
            }
        </style>
    </head>
    <body style="background-color: aqua;">
        <!-- Show flash message here -->
        <?php if(flash_message_exists()): ?>
            <p style="text-align: center; color: red;">
                <?php echo flash_message(); ?>
            </p>
        <?php endif; ?>

        <?php if($errors): ?>
            <?php foreach($errors as $msg): ?>
                <p class="assigned-tasks-error" style="color: red; text-align: center;">
                    <?php echo $msg; ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if($results !== false): ?>
            <?php echo view('resource/assignedtasksresults', ['results' => $results]); ?>
        <?php endif; ?>

        <!-- Printing some vars for debugging purposes.  Can be removed when no longer needed -->
        <pre style="padding: 20px; border: 1px solid #ccc; background: #fff;">
            Results: <?php print_r($results); ?>

            Request: <?php print_r($_REQUEST); ?>

            Session: <?php print_r($_SESSION); ?>
        </pre>
    </body>
</html>