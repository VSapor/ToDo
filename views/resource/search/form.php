<html>
<!--
 ******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *         R E S O U R C E   S E A R C H   M A I N   M E N U   P A G E        *                                    
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
    <form action="/projects/ToDo/resource/index.php?search" method="POST">
        <input type="hidden" name="action" value="search" />
        <div style="text-align: center;">
            <h1 style="color: blue;">Resource Search Menu</h1>

            <h2>Enter at least 1 search value in the fields below: </h2>

            Resource ID: <input type="text" name="search_id"> <br>
            Resource First Name: <input type="text" name="search_first_name"> <br>
            Resource Last Name: <input type="text" name="search_last_name"> <br>
            Resource Skill: <input type="text" name="search_skill"> <br>
            Resource Maximum Daily Rate:
            <select name="search_rate">
                <option value="">
                    Select
                </option>
                <option value=100>
                    $100
                </option>
                <option value=250>
                    $250
                </option>
                <option value=500>
                    $500
                </option>
                <option value=1000>
                    $1000
                </option>
                <option value=1250>
                    $1250
                </option>
                <option value=*>
                    Any
                </option>
            </select><br><br>
            <input type="submit" value ="Search For Resource">
            <br><br><br>
            <a href="/projects/ToDo/resource/index.php">
                <strong>Click here to return to To Resource Management Menu</strong>
            </a>
            <br><br><br>
        </div>
    </form>
</html>