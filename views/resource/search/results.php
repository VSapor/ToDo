<form action="/resource/index.php?mod" method="POST">
    <h1 style="text-align: center; color: blue;">Resource Search Results</h1>

    <table class="search-results-table">
        <thead>
            <tr>
                <?php if($interactive): ?>
                    <th>&nbsp;</th>
                <?php endif; ?>

                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>% Avail</th>
                <th>Unavail Date Start</th>
                <th>Unavail Date End</th>
                <th>Skill</th>
                <th>Daily Rate</th>
                <th>Task ID</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $resource): ?>
                <tr>
                    <?php if($interactive): ?>
                    <td>
                        <input type="checkbox" name="selected[]" value="<?php echo $resource['id']; ?>">
                    </td>
                    <?php endif; ?>

                    <?php foreach($resource as $k => $v): ?>
                        <td>
                            <?php echo htmlspecialchars($v); ?>
                        </td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach; ?>
    
            <!-- No search results -->
            <?php if(!$results): ?>
                <tr>
                    <td colspan="9" style="text-align: center; font-style: italic; padding: 20px;">No resources matched your query.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($interactive): ?>
        <br><br>
        <button type="submit" name="action" value="update">Update Selected</button>
        <button type="submit" name="action" value="delete">Delete Selected</button>
    <?php endif; ?>

    <br><br><br>
    <a href="ToDoResourceNav.html">
        <strong>Click here to return to Resource Management Menu</strong>
    </a>
    <br><br><br>
</form>