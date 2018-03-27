<?php

//build where clause
function build_where_clause($searchFields) {
    foreach ($searchFields as $row) {
    if ($row['value']) {
        if ($row['actlen'] < $row['minlen']) {
            $errors[] = 'You must provide at least '.$row['minlen'].'numbers of '.$row['searchfield'].' to search. Please try again.';
        }
        else {
            echo $wheres[] = "'".$row['dbfield']."' LIKE '%".$row['searchfield']."%'";
        }
    } //END IF search field populated
} //END foreach $searchFields
    
    return ($wheres);
}

/*
//if a ID was entered, add it to the SELECT WHERE clause
    if (!empty($searchID)) {
        //check that at least 2 characters of search string entered
        if (strlen($searchID) >= 2) $wheres[] = "id LIKE '%".db_str($searchID)."%'";
        else $errors[] = 'You must provide at least 2 numbers of resource ID to search. Please try again.';
    } //end IF searchID !EMPTY

    //if a FIRST_NAME was entered, add it to the SELECT WHERE clause
    if (!empty($searchFirstName)) {
        //check that at least 2 characters of search string entered
        if (strlen($searchFirstName) >= 2) $wheres[] = "first_name LIKE '%".db_str($searchFirstName)."%'";
        else $errors[] = 'You must provide at least 2 letters of first name search. Please try again.';
    } //end IF searchFirstName !EMPTY

    //if a LAST_NAME was entered, add it to the SELECT WHERE clause
    if (!empty($searchLastName)) {
        //check that at least 3 characters of search string entered
        if (strlen($searchLastName) >= 3) $wheres[] = "last_name LIKE '%".db_str($searchLastName)."%'";
        else $errors[] = 'You must enter at least 3 letters of last name search. Please try again.';
    } //end IF searchLastName !EMPTY

    //if a SKILL was entered, add it to the SELECT WHERE clause
    if (!empty($searchSkill)) $wheres[] = "skill LIKE '%".db_str($searchSkill)."%'";

    //if a RATE was entered, add it to the SELECT WHERE clause
    if (!empty($searchRate)) $wheres[] = "daily_rate <= ".intval($searchRate);

$searchID = 100;
$searchFirstName = 'Vincent';
$searchLastName = 'Saporito';
$searchSkill = 'Handyman';
$searchDailyRate = 0;

$searchFields = [
            'id' => ['dbfield' => 'id', 'searchfield' => '$searchID', 'value' => $searchID , 'actlen' => 0, 'minlen' => 0],
            'firstName' => ['dbfield' => 'firstname', 'searchfield' => '$searchFirstName', 'value' => $searchFirstName , 'actlen' => strlen($searchFirstName), 'minlen' => 2],
            'lastName' => ['dbfield' => 'lastname', 'searchfield' => '$searchLastName', 'value' => $searchLastName , 'actlen' => strlen($searchLastName), 'minlen' => 3],
            'skill' => ['dbfield' => 'skill', 'searchfield' => '$searchSkill', 'value' => $searchSkill , 'actlen' => 0, 'minlen' => 0],
            'dailyRate' => ['dbfield' => 'dailyrate', 'searchfield' => '$searchDailyRate','value' => $searchDailyRate , 'actlen' => 0, 'minlen' => 0],
];


//print_r($searchFields);

echo 'Num fields = '.$numRows = count($searchFields).'<br>';
        
echo '<br><br><br>'.'Where clause = WHERE '.$whereClause = implode(' AND ', $wheres);

*/