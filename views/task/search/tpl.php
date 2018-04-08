<html>
    <head>
        <title>Task Search Menu</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS style can replace inline html style -->
        <style>
            .search-results-table {
                width: 100%;
                border-collapse: collapse;
            }
            .search-results-table thead th {
                padding: 3px 5px;
                font-weight: bold;
            }
            .search-results-table tbody td {
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #fff;
            }
            .search-results-table tbody td {
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #fff;
            }
            .search-results-table tbody tr:nth-last-of-type(even) td {
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

        <?php echo view('task/search/form'); ?>

        <?php if($errors): ?>
            <?php foreach($errors as $msg): ?>
                <p class="search-error" style="color: red; text-align: center;">
                    <?php echo $msg; ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if($results !== false): ?>
            <?php echo view('task/search/results', ['results' => $results]); ?>
        <?php endif; ?>

        <!-- Printing some vars for debugging purposes.  Can be removed when no longer needed -->
        <pre style="padding: 20px; border: 1px solid #ccc; background: #fff;">
            Results: <?php print_r($results); ?>

            Request: <?php print_r($_REQUEST); ?>

            Session: <?php print_r($_SESSION); ?>
        </pre>
    </body>
</html>