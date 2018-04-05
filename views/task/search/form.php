<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *           T A S K   S E A R C H   M A I N   M E N U   P A G E              *                                    
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <style>
            p {color:red; font-style: italic; text-align: center}
    </style>
    <?php if(flash_message_exists()): ?>
        <?php echo flash_message(); ?>
    <?php endif; ?>
    <form action="/projects/ToDo/task/index.php?search" method="POST">
        <input type="hidden" name="action" value="search" />
        <div style="text-align: center;">
            <h1 style="color: blue;">Task Search Menu</h1>

            <h2>Enter at least 1 search value in the fields below: </h2>

            <strong>Task ID: <input type="text" name="search_id"></strong><br>
            <strong>Task Name: </strong> <input type="text" maxlength = "100" name="name" value="<?php if(isset($input['name'])) { echo $input['name'];} ?>"><br>
            <strong>Project ID: </strong> <input type="number" name="projectid" value="<?php if(isset($input['projectid'])) { echo $input['projectid'];} ?>"><br>
            <strong>Priority </strong> 
                <select name="priority">
                    <option value="">
                        Select
                    </option>
                    <option value=5>
                        Critical
                    </option>
                    <option value=4>
                        High
                    </option>
                    <option value=3>
                        Medium
                    </option>
                    <option value=2>
                        Low
                    </option>
                    <option value=1>
                        Optional
                    </option>
                </select><br>
            <strong>Duration<select name="priority">
                    <option value="">
                        Select
                    </option>
                    <option value=1>
                        1 Day
                    </option>
                    <option value=7>
                        1 Week
                    </option>
                    <option value=14>
                        2 Weeks
                    </option>
                    <option value=30>
                        1 Month
                    </option>
                    <option value=60>
                        2 Months
                    </option>
                    <option value=999>
                        Any
                    </option>
                </select><br>
            <strong>Status </strong> 
                <select name="priority">
                    <option value="">
                        Select
                    </option>
                    <option value=0>
                        Not Scheduled
                    </option>
                    <option value=1>
                        Scheduled
                    </option>
                    <option value=2>
                        Started
                    </option>
                    <option value=3>
                        Completed
                    </option>
                    <option value=4>
                        Pending
                    </option>
                    <option value=5>
                        Canceled
                    </option>
                </select><br>
            <strong>Successor ID: </strong> <input type="number" name="successorid" value="<?php if(isset($input['successorid'])) { echo $input['successorid'];} ?>"><br>
            <br><br>
            <input type="submit" value ="Search For Task">
            <br><br><br>
            <a href="/projects/ToDo/task/index.php">
                <strong>Click here to return to To Task Management Menu</strong>
            </a>
            <br><br><br>
        </div>
    </form>
</html>