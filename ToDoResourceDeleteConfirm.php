<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                R E S O U R C E   D E L E T E   C O N F I R M               *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/

#set up error handling settings
ini_set('error_reporting', E_ALL);

#start new session if not already started
if (session_status() == PHP_SESSION_NONE) { #new session
    session_start();
} # END IF new session
      
/******************************************************************************
 *                        FUNCTION TO CONFIRM DELETE REQUEST                  *
 ******************************************************************************/

if (isset($_POST['selected'])) { #submit key clicked
    if (EMPTY($_POST['selected'])) { #no records selected for DELETE
        echo 'No records selected for delete.'.'<br>';
    } #END IF no records selected
    else { #at least 1 record selected for DELETE
/******************************************************************************
 *          DISPLAY RECORDS KEYS SELECTED FOR DELETE BACK TO USER             *
 ******************************************************************************/
        $numSelected = count($_POST['selected']);
        $_SESSION['numSelected'] = $numSelected;
        echo '<center><strong>'.'You selected these '.$numSelected.' resource ID(s): ';
        echo $inClause = implode(',',$_POST['selected']);
        $_SESSION['inClause'] = $inClause;
                
        if ($numSelected == 0) { # no records selected
            echo 'No records selected for delete.'.'<br>';
        } # END IF at least 1 record selected
        echo'</center></strong><br>';
/******************************************************************************
 *                  END DISPLAY RECORDS SELECTED FOR DELETE BACK TO USER      *
 ******************************************************************************/             
        #display confirmation page
        require 'ToDoResourceDeleteConfirmChoice.html';
    } #END ELSE at least 1 record selected for DELETE
} # END IF submit key clicked
else { # no records selected
    #display NO RECORDS message page
    require 'ToDoResourceDeleteConfirmNORECS.html';
} # END ELSE no records selected

/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *          E N D   R E S O U R C E   D E L E T E   C O N F I R M             *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/