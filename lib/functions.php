<?php

// Initialize db connection
function db_init($mySQLHost, $mySQLUserName, $mySQLPassword, $mySQLDBName) {
    $link = @mysqli_connect($mySQLHost, $mySQLUserName, $mySQLPassword, '');
    if (!$link)
        die('Connection to server failed: ' . $mySQLHost);
    if (!mysqli_select_db($link, $mySQLDBName))
        die('Connection to database failed: ' . $mySQLDBName);
    return $link;
}

// Wrapper for mysqli_real_escape_string
function db_str($v) {
    global $link;
    return mysqli_real_escape_string($link, $v);
}

// Get query result
function db_query($query) {
    global $link;
    $result = mysqli_query($link, $query);
    return $result;
}

// Get results from a query
function db_results($query) {
    global $link;
    $results = [];
    $result = mysqli_query($link, $query);
    if (!$result)
        return false;

    // Get all results
    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
    }
    mysqli_free_result($result);

    return $results;
}

// Get last inserted id
function db_insert_id() {
    global $link;
    return mysqli_insert_id($link);
}

// Get the flash message
function flash_message() {
    $msg = $_SESSION['FLASH_MSG'];

    // Unset the session var so the message won't show when refreshing.  Show only show once
    unset($_SESSION['FLASH_MSG']);
    return $msg;
}

// See if there is a flash message
function flash_message_exists() {
    return $_SESSION['FLASH_MSG'] ? true : false;
}

//find selected record for UPDATE
function selected_record_found() {
    $_SESSION['SELECTED_RECORD_FOUND'] = 'FALSE';
    $key = 0; //set key to 0 as there only 1 record allowed for update
    $numRows = count($_SESSION['results[]']);
    //find selected record for update
    for ($i = 0; $i <= $numRows; $i++) {
        if ($_SESSION['results[]'][$i]['id'] == $_REQUEST['selected'][$key]) {
            $_SESSION['SELECTED_RECORD_FOUND'] = 'TRUE';
            $_SESSION['selectedID'] = $_SESSION['results[]'][$i]['id'];
            $_SESSION['selectedFirstName'] = db_str($_SESSION['results[]'][$i]['first_name']);
            $_SESSION['selectedLastName'] = db_str($_SESSION['results[]'][$i]['last_name']);
            $_SESSION['selectedPctAvail'] = floatval($_SESSION['results[]'][$i]['pct_avail']);
            $_SESSION['selectedUnavailDateStart'] = $_SESSION['results[]'][$i]['unavail_date_start'];
            $_SESSION['selectedUnavailDateEnd'] = $_SESSION['results[]'][$i]['unavail_date_end'];
            $_SESSION['selectedSkill'] = db_str($_SESSION['results[]'][$i]['skill']);
            $_SESSION['selectedDailyRate'] = floatval($_SESSION['results[]'][$i]['daily_rate']);
            $_SESSION['selectedNotes'] = db_str($_SESSION['results[]'][$i]['notes']);
        } //END IF find selected record
    } //END FOR EACH ROW LOOP
    return $_SESSION['SELECTED_RECORD_FOUND'] ? true : false;
}

//END function selected_record_found
//build where clause
function build_where_clause($searchValues) {
    $wheres = [];
    $_SESSION['build_where_clause_errors'] = [];

    foreach ($searchValues as $row) {
        if ($row['value']) {
            if ($row['dbfield'] == 'daily_rate') {
                $wheres[] = "daily_rate <= " . intval($row['value']);
            } //END IF daily_rate entered
            else {
                if ($row['actlen'] < $row['minlen']) {
                    $_SESSION['build_where_clause_errors'][] = 'You must provide at least ' . $row['minlen'] . 'numbers of ' . $row['searchfield'] . ' to search. Please try again.';
                } //END IF actual len <min len
                else {
                    $wheres[] = "`" . $row['dbfield'] . "` LIKE '%" . $row['value'] . "%'";
                } //END ELSE actual len >= min len
            } //END ELSE search field not numeric
        } //END IF search field populated
    } //END foreach $searchValues
    return $wheres;
}

//END function build_where_clause

// Get the content of a view file, with data plugged into it
function view($file, $vars = []) {

    // Check for the file in the 'views' folder
    $viewFile = APP_PATHS['views'] . '/' . $file . '.php';
    if (!file_exists($viewFile))
        die('View file does not exist: ' . $viewFile);

    extract($vars);

    // Strart Buffer
    ob_start();

    // Include View file with the extracted vars plugged in
    include($viewFile);

    // Return Contents & Clean Object
    $buffer = ob_get_contents();
    @ob_end_clean();

    return $buffer;
}
