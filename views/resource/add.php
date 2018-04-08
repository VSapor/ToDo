<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                R E S O U R C E    A D D   M A I N   M E N U                *
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

    <center><h2><u><font color="Blue">Resource Add Menu</h2></u></font>
        <br><br><br>

        <?php if($errors): ?>
            <?php foreach($errors as $msg): ?>
                <p class="search-error" style="color: red; text-align: center;">
                    <?php echo $msg; ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="/projects/ToDo/resource/add.php" method="post">
            <input type="hidden" name="action" value="add" />
            <center>
                <div>
                    <strong>First Name: *</strong> <input type="text" maxlength = "20" name="firstname" value="<?php if(isset($input['firstname'])) { echo $input['firstname'];} ?>"><br>
                    <strong>Last Name: *</strong> <input type="text" maxlength = "20" name="lastname" value="<?php if(isset($input['lastname'])) { echo $input['lastname'];} ?>"><br>
                    <strong>% Available: *</strong> <input type="number" step="any" name="pctavail" value="<?php if(isset($input['pctavail'])) { echo $input['pctavail'];} ?>"><br>
                    <strong>Unavailable Date Start: </strong> <input type="date" name="unavaildatestart" value="<?php if(isset($input['unavaildatestart'])) { echo $input['unavaildatestart'];} ?>"><br>
                    <strong>Unavailable Date End: </strong> <input type="date" name="unavaildateend" value="<?php if(isset($input['unavaildateend'])) { echo $input['unavaildateend'];} ?>"><br>
                    <strong>Skill: *</strong> <input type="text" maxlength = "15" name="skill" value="<?php if(isset($input['skill'])) { echo $input['skill'];} ?>"><br>
                    <strong>Daily Rate: *</strong> <input type="number" step="any" name="dailyrate" value="<?php if(isset($input['dailyrate'])) { echo $input['dailyrate'];} ?>"><br>
                    <label for="title"><strong>Notes:</strong> </label>
                    <br>
                    <textarea rows="4" cols="50" id="title" name="notes" maxlength='100'><?php if(isset($input['notes'])) { echo $input['notes'];} ?></textarea>
                    <br>
                    <p>* Required</p>
                    <input type="submit" name="submit" value="Add Resource"><br><br><br>
                    <a href="/projects/ToDo/resource/index.php"><strong>Click here to return to Resource Management Menu</strong></a>
                </div>
            </center>
        </form>
    </body>
</html>