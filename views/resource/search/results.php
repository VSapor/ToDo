<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          R E S O U R C E   S E A R C H   R E S U L T S   P A G E           *                                    
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <form action="/projects/ToDo/resource/index.php?mod" method="POST">
        <h1 style="text-align: center; color: blue;">Resource Search Results</h1>
        
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
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php unset($_SESSION['results[]']); $row=0; ?>
                <?php foreach($results as $resource): ?>
                    <?php $_SESSION['results[]'][$row] = $resource; $row++;?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected[]" value="<?php echo $resource['resource_id']; ?>">
                            <input type="button" value="Edit" onClick="window.location='/projects/ToDo/resource/update.php?row=<?php echo $row-1 ?>'">
                        </td>

                    <?php foreach($resource as $k => $v): ?>
                        <td>
                            <?php echo htmlspecialchars($v);?>
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
            <br><br>
            
            <button type="submit" name="action" value="delete">Delete Selected</button>
            <button type="submit" name="action" value="showtasks">Show Assigned Tasks</button>
            
        <br><br><br>
        <a href="/projects/ToDo/resource/index.php">
            <strong>Click here to return to Resource Management Menu</strong>
        </a>
        <br><br><br>
    </form>
</html>