<?php

// Initialize db connection
function db_init($mySQLHost, $mySQLUserName, $mySQLPassword, $mySQLDBName) {
    $link = @mysqli_connect($mySQLHost, $mySQLUserName, $mySQLPassword, '');
    if(!$link) die ('Connection to server failed: '.$mySQLHost);
    if(!mysqli_select_db($link, $mySQLDBName)) die('Connection to database failed: '.$mySQLDBName);
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
    if(!$result) return false;

    // Get all results
    while($row = mysqli_fetch_assoc($result)) {
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

// Get the content of a view file, with data plugged into it
function view($file, $vars = []) {
    
    // Check for the file in the 'views' folder
    $viewFile = APP_PATHS['views'].'/'.$file.'.php';
    if(!file_exists($viewFile)) die('View file does not exist: '.$viewFile);
    
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