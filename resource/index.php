<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *          R E S O U R C E   M A I N   N A V I G A T I O N   M E N U          *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

require_once '../main.php';

// The $route var will return the first $_REQUEST key (i.e. index.php?search will be "search")
$route = strtolower(array_keys($_REQUEST)[0]);

switch($route) {
    case 'mod':                            // Perform action on selected resources (this can be update, delete or show assigned tasks)
        if (!isset($_REQUEST['selected']) && !isset($_REQUEST['confirm'])) { //page submitted without making a selection
            $msg = 'You must select at least one record to proceed.';
            $_SESSION['FLASH_MSG'] = $msg;
            header('Location: /projects/ToDo/resource/index.php?search');
            exit;  
        }
        switch(strtolower($_REQUEST['action'])) {
            case 'delete':                  // Handle delete
                require_once 'delete.php';
                break;
            
            case 'showtasks':                  // Handle show assigned tasks
                require_once 'showtasks.php';
                break;
        }
        break;
    
    case 'search':                          // Show the resource search
        require_once 'search.php';
        break;
       
            default:                                // Just show the resource "home"
        echo view('resource/home');
}