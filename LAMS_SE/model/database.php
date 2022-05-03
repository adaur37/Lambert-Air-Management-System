<?php
/*/////////////////////////////////////////////////////////////////////////////////////////////////
 * model : database.php
 * Joshua Snider
 * Apr252022
 * Serves user with chosen action for database data editing, can add, delete, or list, list is default if nothing chosen, loads user from _SESSION or passed login.
*//////////////////////////////////////////////////////////////////////////////////////////////////


    $dsn = 'mysql:host=localhost;dbname=cs440_flightmgmtsys';

    try {
        if (session_id() != "")
        {
            // if (!empty($_SESSION['UNAME']) )
            // { $username = $_SESSION['UNAME']; }
            // if (!empty($_SESSION['UPASSWD']) )
            // { $password = strtoupper($_SESSION['UPASSWD'] ); }

            if( $username = '' or $password = '' )
            { echo ("<script type='text/javascript'> console.log('[SESSION-ERROR] Session for user found, but empty login credentials provided.')</script>" ); }

            if ( session_id() != "")
            { $db = new PDO($dsn, $_SESSION['UNAME'], strtoupper($_SESSION['UPASSWD']) ); }
        }
        else
        { // action to take if a session is not opened (should be impossible if logging in)
//            $db = new PDO($dsn, "", ""); 
            if ( !empty($UNAME) )
            { $db = new PDO($dsn, $UNAME, strtoupper($UPASSWD) ); }
            echo ("<script type='text/javascript'> console.log('[INFO] No user session found, variable fallback.' )</script> )" );
        }
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>