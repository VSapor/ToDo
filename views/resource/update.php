</html>
<!DOCTYPE html>
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
    
    <form action="/projects/ToDo/resource/updateSQL.php?action=update" method="POST">
        <input type="hidden" name="action" value="update" />
        <center>
            <div>
                <strong>ID:</strong> <?php echo $_SESSION['selectedID'];?></p>
                <strong>First Name: *</strong> <input type="text" maxlength = "20" name="firstname" value="<?php if(isset($_SESSION['selectedFirstName'])) {echo $_SESSION['selectedFirstName'];} ?>"><br>
                <strong>Last Name: *</strong> <input type="text" maxlength = "20" name="lastname" value="<?php if(isset($_SESSION['selectedLastName'])) {echo $_SESSION['selectedLastName'];} ?>"><br>
                <strong>% Available: *</strong> <input type="number" step="any" name="pctavail" value="<?php if(isset($_SESSION['selectedPctAvail'])) {echo $_SESSION['selectedPctAvail'];} ?>"><br>
                <strong>Unavailable Date Start: </strong> <input type="date" name="unavaildatestart" value="<?php if(isset($_SESSION['selectedUnavailDateStart'])) {echo $_SESSION['selectedUnavailDateStart'];} ?>"><br>
                <strong>Unavailable Date End: </strong> <input type="date" name="unavaildateend" value="<?php if(isset($_SESSION['selectedUnavailDateEnd'])) {echo $_SESSION['selectedUnavailDateEnd'];} ?>"><br>
                <strong>Skill: *</strong> <input type="text" maxlength = "15" name="skill" value="<?php if(isset($_SESSION['selectedSkill'])) {echo $_SESSION['selectedSkill'];} ?>"><br>
                <strong>Daily Rate: *</strong> <input type="number" step="any" name="dailyrate" value="<?php if(isset($_SESSION['selectedDailyRate'])) {echo $_SESSION['selectedDailyRate'];} ?>"><br>
                <label for="title"><strong>Notes:</strong> </label>
                <br>
                <textarea rows="4" cols="50" id="title" name="notes" maxlength='100'><?php if(isset($_SESSION['selectedNotes'])) {echo $_SESSION['selectedNotes'];} ?></textarea>
                <br>
                <p>* Required</p>
                <input type="submit" name="submit" value="Update Resource"><br><br><br>
                <a href="/projects/ToDo/resource/index.php"><strong>Click here to return to Resource Management Menu</strong></a>
            </div>
        </center>
    </form>
</body>
</html>