<html lang="en">

<!-- /*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Product Manager : index.php
 * Joshua Snider (based on Professor Onyon's Guitar Shop)
 * Apr272022
 * Provides Login enforcement layer to Product Manager, handled by PHP using $_SESSION, User must have a login in the database with an MD5 hashed password.
*////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <?php require_once("../view/header.php"); ?>
    <?php 
        if ( session_id() == "")
        { session_start(); }

        if( isset($_SESSION['UNAME'] ) )
        { ; } //retired, used to use to 'log out' before functionality created by unset() method
        else
        { $_SESSION['UNAME'] = ""; }
        if( isset($_SESSION['UPASSWD'] ) )
        { ; } //retired, used to use to 'log out' before functionality created by unset() method
        else
        { $_SESSION['UPASSWD'] = ""; }

        if ( isset($_SESSION['UNAME']) AND isset($_SESSION['UPASSWD']) AND !empty($_SESSION['UNAME']) )
        { header("Location: manager_home.php" ); }
        else
        { header("Location: ../sign_in/index.php" ); }
    ?>
    
	<?php require_once("../view/footer.php"); ?>
</html>