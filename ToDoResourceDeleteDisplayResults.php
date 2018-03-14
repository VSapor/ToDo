<?php

/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          D I S P L A Y   S E A R C H   R E S U L T S   F O R               *
 *                      D E L E T E   A C T I O N                             *                                                                       
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/

#initialize error reporting settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) { #new session
    session_start();
} #END IF new session

/******************************************************************************
 *     DISPLAY RETURNED DATA IN TABULAR FORMAT WITH CHECKBOXES                *
 ******************************************************************************/

if (mysqli_num_rows($result) > 0) { #at least 1 record found
    ?>
    <form action="ToDoResourceDeleteConfirm.php" method="POST">
        <body bgcolor="aqua">
            <center><h1><font color="Blue">Resource Delete Search</h1></center></font>
            <h3>Select records to delete:</h3>
                <table style="border: 1px solid black">
                    <tr>
                       <td><strong></strong></td>
                        <td><strong><u>First Name</u></strong></td>
                        <td><strong><u>Last Name</u></strong></td>
                        <td><strong><u>% Avail</u></strong></td>
                        <td><strong><u>Unavail Date Start</u></strong></td>
                        <td><strong><u>Unavail Date End</u></strong></td>
                        <td><strong><u>Skill</u></strong></td>
                        <td><strong><u>Daily Rate</u></strong></td>
                        <td><strong><u>Notes</u></strong></td>
                    </tr>
                    <?php
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            echo '<tr><td>';
                            echo '<input type="checkbox" name="selected[]" value="'.$row['id'].'"/>';
                            echo '</td>';
                            foreach ($row as $key => $value)
                                echo '<td>'.htmlspecialchars($value).'</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            <br><br><input type="submit" value='Delete Resource'/><br><br><br>
            <a href="ToDoResourceNav.html"><strong>Click here to return to Resource Management Menu</strong></a><br><br><br>
        </body>
    </form>
    <?php
} #END IF at least 1 record found
else { #no records found
    echo '<p>No resource records exist.</p>';
} # END ELSE no records found
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          E N D   D I S P L A Y   S E A R C H   R E S U L T S   F O R       *
 *                          D E L E T E   A C T I O N                         *                                                                       
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/