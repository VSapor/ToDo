<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *    P R O J E C T   D E L E T E   C O N F I R M A T I O N   P A G E         *                                                                  *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
    <body bgcolor="aqua">
    <form action="/projects/ToDo/project/index.php?mod&action=delete" method="POST">
        <center><h2><u><font color="Blue">Confirm Delete Request</h2></u></font>
            <br><br><br>
            Are you sure you want to delete these projects?<br><br>
            YES <input type="radio" name="choice" value=1 /><br>
            NO <input type="radio" name="choice" value=0 /><br><br>
            <button type="submit" name="confirm">CONFIRM</button><br><br><br>

            <a href="/projects/ToDo/project/index.php"><strong>Click here to return to Project Management Menu</strong></a><br><br><br>
        </center>
    </form>
    </body>
</html>