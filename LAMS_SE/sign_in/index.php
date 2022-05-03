<html lang="en">

<!-- /*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Sign In : index.php
 * Joshua Snider 
 * Apr272022
 * Provides Login enforcement layer to program, handled by PHP using $_SESSION, User must have a login for the database.
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
        { header("Location: http://localhost/LAMS_SE" ); }
    ?>
    <script>
        function submit_toast() {
            alert("The form has been submitted.")
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", "hidden"); }, 3000);
        }
    </script>

    <body>
        <h1>Sign In Page : Login</h1>
        <br>
        <div id="login_container">
            <table>
                <th>Please Login:</th>
                <tr><td>
                    <form name="login_info" id="login_info" action="http://localhost/LAMS_SE/" method="post">
                        <label for="uname">User: </label>
                        <input type="text" id="in_uname" name="in_uname" maxlength="100"></input><br><br>
                        <label for="password" maxlength="100">Password: </label>
                        <input type="password" id="in_upasswd" name="in_upasswd"></input><br><br><br>
                        
                        <input type="submit" onclick="submit_toast()"></input>
                    </form>
                </td></tr>
            </table>
        </div>

        <div class="hidden" id="snackbar">Attempting Log In...</div>
        
    </body>
	<?php require_once("../view/footer.php"); ?>
</html>