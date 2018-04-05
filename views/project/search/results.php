<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          P R O J E C T   S E A R C H   R E S U L T S   P A G E             *                                    
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <form action="/projects/ToDo/project/index.php?mod" method="POST">
        <h1 style="text-align: center; color: blue;">Project Search Results</h1>

        <table class="search-results-table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Priority</th>
                    <th>Planned Start Date</th>
                    <th>Planned End Date</th>
                    <th>Actual Start Date</th>
                    <th>Actual End Date</th>
                    <th>Status</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php unset($_SESSION['results[]']); $row=0; ?>
                <?php foreach($results as $project): ?>
                <?php
                    switch($project['project_priority']) : //map priority code to displayed priority
                        case 5 :
                            $project['project_priority'] = 'Critical';
                        case 4 :
                            $project['project_priority'] = 'High';
                        case 3 :
                            $project['project_priority'] = 'Medium';
                        case 2 :
                            $project['project_priority'] = 'Low';
                        case 1 :
                            $project['project_priority'] = 'Optional';
                    endswitch; //priority
                    
                    switch($project['project_status']) : //map status code to displayed status                            
                        case 1 :
                            $project['project_status'] = 'Scheduled';
                        case 2 :
                            $project['project_status'] = 'Started';
                        case 3 :
                            $project['project_status'] = 'Completed';
                        case 4 :
                            $project['project_status'] = 'Pending';
                        case 5 :
                            $project['project_status'] = 'Canceled';
                        default : 
                            $project['project_status'] = 'Not Scheduled'; //status = 0
                    endswitch; //status
                    
                    $_SESSION['results[]'][$row] = $project; $row++;
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected[]" value="<?php echo $project['project_id']; ?>">
                        </td>

                    <?php foreach($project as $k => $v): ?>
                        <td>
                            <?php echo htmlspecialchars($v);?>
                        </td>
                    <?php endforeach;?>
                    </tr>
                <?php endforeach; ?>

                <!-- No search results -->
                <?php if(!$results): ?>
                    <tr>
                        <td colspan="9" style="text-align: center; font-style: italic; padding: 20px;">No projects matched your query.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            <br><br>
            <button type="submit" name="action" value="update">Update (1) Selection</button>
            <button type="submit" name="action" value="delete">Delete Selected</button>
            <button type="submit" name="action" value="projecttree">Show Project Tasks Diagram</button>
            
        <br><br><br>
        <a href="/projects/ToDo/project/index.php">
            <strong>Click here to return to Project Management Menu</strong>
        </a>
        <br><br><br>
    </form>
</html>