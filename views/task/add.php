<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                   T A S K   A D D   M A I N   M E N U                      *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <body bgcolor="aqua">
    <!-- Show flash message here -->
    <?php if(flash_message_exists()): ?>
        <p style="text-align: center; color: red;">
            <?php echo flash_message(); ?>
        </p>
    <?php endif; ?>

    <center><h2><u><font color="Blue">Task Add Menu</h2></u></font>
        <br><br><br>

        <?php if($errors): ?>
            <?php foreach($errors as $msg): ?>
                <p class="search-error" style="color: red; text-align: center;">
                    <?php echo $msg; ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="/projects/ToDo/task/add.php" method="post">
            <input type="hidden" name="action" value="add" />
            <center>
                <div>
                    <strong>Task Name: *</strong> <input type="text" maxlength = "100" name="name" value="<?php if(isset($input['name'])) { echo $input['name'];} ?>"><br>
                    <strong>Project ID: </strong> <input type="number" name="projectid" value="<?php if(isset($input['projectid'])) { echo $input['projectid'];} ?>"><br>
                    <strong>Priority *</strong> 
                        <select name="priority">
                            <option value="">
                                Select
                            </option>
                            <option value=5>
                                On Critical Path
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
                    <strong>Duration (days) *</strong> <input type="number" step="any" name="duration" value="<?php if(isset($input['duration'])) { echo $input['duration'];} ?>"><br>
                    <strong>Start By Date: </strong> <input type="date" name="startbydate" value="<?php if(isset($input['startbydate'])) { echo $input['startbydate'];} ?>"><br>
                    <strong>End By Date: </strong> <input type="date" name="endbydate" value="<?php if(isset($input['endbydate'])) { echo $input['endbydate'];} ?>"><br>
                    <strong>Actual Start Date: </strong> <input type="date" name="realstartdate" value="<?php if(isset($input['realstartdate'])) { echo $input['realstartdate'];} ?>"><br>
                    <strong>Actual End Date: </strong> <input type="date" name="realenddate" value="<?php if(isset($input['realenddate'])) { echo $input['realenddate'];} ?>"><br>
                    <strong>Status *</strong> 
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
                    <label for="title"><strong>Notes:</strong> </label>
                    <br>
                    <textarea rows="4" cols="50" id="title" name="notes" maxlength='100'><?php if(isset($input['notes'])) { echo $input['notes'];} ?></textarea>
                    <br>
                    <p>* Required</p>
                    <input type="submit" name="submit" value="Add Task"><br><br><br>
                    <a href="/projects/ToDo/task/index.php"><strong>Click here to return to Task Management Menu</strong></a>
                </div>
            </center>
        </form>
    </body>
</html>