<?php
/*******************************************************************************
 *                                                                             *
 *                                                                             *
 *          T A S K   M A I N   N A V I G A T I O N   M E N U                  *
 *                                                                             *
 *                                                                             *
 ******************************************************************************/

require_once '../main.php';

// The $route var will return the first $_REQUEST key (i.e. index.php?search will be "search")
$route = strtolower(array_keys($_REQUEST)[0]);

switch($route) {
    case 'mod':                             // Perform action on selected task (this can be update, delete, show dependencies, or show successors)
        switch(strtolower($_REQUEST['action'])) {
            case 'delete':                  // Handle delete
                require_once 'delete.php';
                break;

            case 'update':                  // Handle update
                require_once 'update.php';
                break;
            
            case 'dependencies':                  // Handle show dependencies
                require_once 'showdependencies.php';
                break;
            
            case 'successors':                  // Handle show successors
                require_once 'showsuccessors.php';
                break; 
        }
        break;
    
    case 'search':                          // Show the task search
        require_once 'search.php';
        break;
        
    default:                                // Just show the task "home"
        echo view('task/home');
}