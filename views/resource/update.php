<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *         R E S O U R C E   U P D A T E   M A I N   M E N U                  *
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

    <center><h2><u><font color="Blue">Resource Update Menu</h2></u></font>
        <br><br><br>

        <?php if($errors): ?>
            <?php foreach($errors as $msg): ?>
                <p class="search-error" style="color: red; text-align: center;">
                    <?php echo $msg; ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="/projects/ToDo/resource/update.php?action=update" method="POST">
            <input type="hidden" name="action" value="update" />
            <center>
                <div>
                    <p><strong>ID: </strong> <input type="text" name="resourceID" value="<?php echo $results['resource_id'] ?>" readonly></p>
                    <strong>First Name: *</strong> <input type="text" maxlength = "20" name="firstname" value="<?php if(isset($results['resource_first_name'])) {echo $results['resource_first_name'];} ?>"><br>
                    <strong>Last Name: *</strong> <input type="text" maxlength = "20" name="lastname" value="<?php if(isset($results['resource_last_name'])) {echo $results['resource_last_name'];} ?>"><br>
                    <strong>% Available: *</strong> <input type="number" step="any" name="pctavail" value="<?php if(isset($results['resource_pct_avail'])) {echo $results['resource_pct_avail'];} ?>"><br>
                    <strong>Unavailable Date Start: </strong> <input type="date" name="unavaildatestart" value="<?php if(isset($results['resource_unavail_date_start'])) {echo $results['resource_unavail_date_start'];} ?>"><br>
                    <strong>Unavailable Date End: </strong> <input type="date" name="unavaildateend" value="<?php if(isset($results['resource_unavail_date_end'])) {echo $results['resource_unavail_date_end'];} ?>"><br>
                    <strong>Skill: *</strong> <input type="text" maxlength = "15" name="skill" value="<?php if(isset($results['resource_skill'])) {echo $results['resource_skill'];} ?>"><br>
                    <strong>Daily Rate: *</strong> <input type="number" step="any" name="dailyrate" value="<?php if(isset($results['resource_daily_rate'])) {echo $results['resource_daily_rate'];} ?>"><br>
                    <label for="title"><strong>Notes:</strong> </label>
                    <br>
                    <textarea rows="4" cols="50" id="title" name="notes" maxlength='100'><?php if(isset($results['resource_notes'])) {echo $results['resource_notes'];} ?></textarea>
                    <br>
                    <p>* Required</p>
                    <input type="reset" value="Reset">
                    <input type="submit" name="submit" value="Update Resource">
                    <input type="button" value="Cancel" onClick="window.location='/projects/ToDo/resource/index.php?search'"><br><br><br>
                    <a href="/projects/ToDo/resource/index.php"><strong>Click here to return to Resource Management Menu</strong></a>
                </div>
            </center>
        </form>
    </body>
    <!-- Printing some vars for debugging purposes.  Can be removed when no longer needed -->
        <pre style="padding: 20px; border: 1px solid #ccc; background: #fff;">
            Results: <?php print_r($results); ?>

            Request: <?php print_r($_REQUEST); ?>

            Session: <?php print_r($_SESSION); ?>
        </pre>
</html>