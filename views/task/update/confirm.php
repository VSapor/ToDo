<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *    R E S O U R C E   U P D A T E   C O N F I R M A T I O N   P A G E       *                                                                  *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <body bgcolor="aqua">
    <form action="/projects/ToDo/resource/updateSQL.php" method="POST">
        <center><h2><u><font color="Blue">Confirm Update Request</h2></u></font>
            <br><br><br>
            Are you sure you want to update this resource?<br><br>
            YES <input type="radio" name="choice" value=1 /><br>
            NO <input type="radio" name="choice" value=0 /><br><br>
            <button type="submit" name="confirm">CONFIRM</button><br><br><br>

            <a href="/projects/ToDo/resource/index.php"><strong>Click here to return to Resource Management Menu</strong></a><br><br><br>
        </center>
    </form>
    <!-- Printing some vars for debugging purposes.  Can be removed when no longer needed -->
    </body>
</html>