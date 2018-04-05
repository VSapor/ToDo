<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *          P R O J E C T   M A I N   N A V I G A T I O N   M E N U            *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

require_once '../main.php';

// The $route var will return the first $_REQUEST key (i.e. index.php?search will be "search")
$route = strtolower(array_keys($_REQUEST)[0]);

switch($route) {
    case 'mod':                            // Perform action on selected projects (this can be update, delete or display project tasks tree diagram)
        if (!isset($_REQUEST['selected']) && !isset($_REQUEST['confirm'])) { //page submitted without making a selection
            $msg = 'You must select at least one record to proceed.';
            $_SESSION['FLASH_MSG'] = $msg;
            header('Location: /projects/ToDo/project/index.php?search');
            exit;  
        } //END IF page submitted without selection
        switch(strtolower($_REQUEST['action'])) {
            case 'delete':                  // Handle delete
                require_once 'delete.php';
                break;

            case 'update':                  // Handle update
                require_once 'update.php';
                break;
            
            case 'projecttree':             // Show project tree diagram
                require_once 'projecttree.php';
                break;
            
        } //END action switch
        break;
    
    case 'search':                          // Show the project search
        require_once 'search.php';
        break;
    
    default:                                // Just show the project "home"
        echo view('project/home');
} //END route switch