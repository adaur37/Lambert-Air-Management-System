<html lang="en">

<!-- /*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Product Manager : index.php
 * Joshua Snider (based on Professor Onyon's Guitar Shop)
 * Apr272022
 * Provides Login enforcement layer to Product Manager, handled by PHP using $_SESSION, User must have a login in the database with an MD5 hashed password.
*////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <?php require_once("../view/header.php"); ?>
    <?php 

        if( isset($_SESSION['UNAME'] ) )
        { unset($_SESSION['UNAME']); } 
        else
        { $_SESSION['UNAME'] = ""; }
        if( isset($_SESSION['UPASSWD'] ) )
        { unset($_SESSION['UPASSWD']); } 
        else
        { $_SESSION['UPASSWD'] = ""; }
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
        <h1>Product Manager : Login</h1>
        <br><br>
        <div id="login_container">
            <table>
                <th>Please Login:</th>
                <tr><td>
                    <form name="login_info" id="login_info" action="manager_home.php" method="post">
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
