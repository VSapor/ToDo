<!DOCTYPE html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                T O   D O   N A V I G A T I O N   P A G E                   *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
-->
<html>
<body bgcolor="aqua">
<center><h1><font color="Blue">To Do Main Menu </h1></font>
    <h3><u>Resource Management</h3></u>
    <nav>
        <ul>
            <a href="/projects/ToDo/resource/index.php">Resource Menu</a>
        </ul>
        <h3><u>Task Management</h3></u>
        <ul>
            <a href="/projects/ToDo/task/index.php">Task Menu</a>
        </ul>
        <h3><u>Budget Management</h3></u>
        <ul>
            <a href="/projects/ToDo/budget/index.php">Budget Menu</a>
        </ul>
    </nav>
</center>
<!-- Printing some vars for debugging purposes.  Can be removed when no longer needed -->
<pre style="padding: 20px; border: 1px solid #ccc; background: #fff;">
    Results: <?php print_r($results); ?>

    Request: <?php print_r($_REQUEST); ?>

    Session: <?php print_r($_SESSION); ?>
</pre>
</body>
</html>