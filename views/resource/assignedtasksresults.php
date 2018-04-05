<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *  R E S O U R C E   A S S I G N E D   T A S K S   R E S U L T S   P A G E   *                                    
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <form>
        <h1 style="text-align: center; color: blue;">Resource Assigned Tasks</h1>

        <table class="assigned-tasks-results-table">
            <thead>
                <tr>
                    <th>Resource ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Task ID</th>
                    <th>Task Name</th>
                </tr>
            </thead>
            <tbody> 
                <?php if($results): //results returned from JOIN query ?>          
                    <?php foreach ($results as $row) : ?>
                        <?php foreach($row as $record): ?>
                        <tr>
                            <?php foreach($record as $field => $value): ?>
                                <td>
                                    <?php echo htmlspecialchars($value); ?>
                                </td>
                            <?php endforeach; //field ?>
                        </tr>
                        <?php endforeach; //record ?>
                    <?php endforeach; //row ?>
                <?php else: ?> 
                    <td colspan="9" style="text-align: center; font-style: italic; padding: 20px;">No tasks assigned to selected resource(s).</td>
                <?php endif; //results exist ?>
            </tbody>
        </table>
            
        <br><br><br>
        <a href="/projects/ToDo/resource/index.php">
            <strong>Click here to return to Resource Management Menu</strong>
        </a>
        <br><br><br>
    </form>
</html>