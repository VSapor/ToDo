<form action="/resource/index.php?search" method="POST">
    <input type="hidden" name="action" value="search" />
    <div style="text-align: center;">
        <h1 style="color: blue;">Resource Search Menu</h1>

        <h2>Enter your search criteria in the fields below: </h2>

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
            <option value=1000000>
                Any
            </option>
        </select><br><br>
        <input type="submit" value ="Search For Resource">
        <br><br><br>
        <a href="/resource/index.php">
            <strong>Click here to return to To Resource Management Menu</strong>
        </a>
        <br><br><br>
    </div>
</form>