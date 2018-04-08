<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *               T A S K   S E A R C H   R E S U L T S   P A G E              *                                    
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <form action="/projects/ToDo/task/index.php?mod" method="POST">
        <h1 style="text-align: center; color: blue;">Task Search Results</h1>

        <table class="search-results-table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
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
                <?php unset($_SESSION['results[]']);; $row=0; ?>
                <?php foreach($results as $task): ?>
                    <?php $_SESSION['results[]'][$row] = $task; $row++;?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected[]" value="<?php echo $task['id']; ?>">
                        </td>

                    <?php foreach($task as $k => $v): ?>
                        <td>
                            <?php echo htmlspecialchars($v);?>
                        </td>
                    <?php endforeach;?>
                    </tr>
                <?php endforeach; ?>

                <!-- No search results -->
                <?php if(!$results): ?>
                    <tr>
                        <td colspan="9" style="text-align: center; font-style: italic; padding: 20px;">No tasks matched your query.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            <br><br>
            <button type="submit" name="action" value="update">Update (1) Selection</button>
            <button type="submit" name="action" value="delete">Delete Selected</button>
            <button type="submit" name="action" value="dependencies">Show Dependencies</button>
            <button type="submit" name="action" value="successors">Show Successors</button>

        <br><br><br>
        <a href="/projects/ToDo/task/index.php">
            <strong>Click here to return to Task Management Menu</strong>
        </a>
        <br><br><br>
    </form>
</html>