<?php

require_once '../main.php';

// The $route var will return the first $_REQUEST key (i.e. index.php?search will be "search")
$route = strtolower(array_keys($_REQUEST)[0]);

switch($route) {
    case 'mod':                             // Perform action on selected resources (this can be update or delete)
        switch(strtolower($_REQUEST['action'])) {
            case 'delete':                  // Handle delete
                require_once 'delete.php';
                break;

            case 'update':                  // Handle update
                require_once 'update.php';
                break;        
        }
        break;
    
    case 'search':                          // Show the resource search
        require_once 'search.php';
        break;
        
    default:                                // Just show the resource "home"
        echo view('resource/home');
}