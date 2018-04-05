<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *         P R O J E C T   S E A R C H   M A I N   M E N U   P A G E          *                                    
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
    <form action="/projects/ToDo/project/index.php?search" method="POST">
        <input type="hidden" name="action" value="search" />
        <div style="text-align: center;">
            <h1 style="color: blue;">Project Search Menu</h1>

            <h2>Enter at least 1 search value in the fields below: </h2>

            Project ID: <input type="text" name="search_id"> <br>
            Project Name: <input type="text" name="search_name"> <br>
            Project Priority: 
                <select name="search_priority">
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
                    <option value=*>
                        Any
                    </option>
                </select><br>
            Project Status:
                <select name="search_status">
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
                    <option value=*>
                        Any
                    </option>
                </select><br><br>
            <input type="submit" value ="Search For Project">
            <br><br><br>
            <a href="/projects/ToDo/project/index.php">
                <strong>Click here to return to To Project Management Menu</strong>
            </a>
            <br><br><br>
        </div>
    </form>
</html>