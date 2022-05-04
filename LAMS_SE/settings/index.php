<?php require_once("../view/header.php"); ?>

<?php
    if ( session_id() != "")
    {
        $UNAME = $_SESSION['UNAME'];
        $UPASSWD = $_SESSION['UPASSWD'];
        $UROLE_ID = $_SESSION['UROLE_ID'];
        $urole_title = '';

        if ( !empty($db) ) // Retrieve Role Title from DB, then use to set controls as 'available' to the user
        {
            try {
                if ( file_exists('../model/database.php') )
                { require_once('../model/database.php'); }
                else
                { require_once('./model/database.php'); }

                if ( !empty($db) )
                {
                    $query = "SELECT role_title FROM user_roles WHERE role_id = '".$UROLE_ID."'";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $urole_title = $statement->fetch();
                    $statement->closeCursor();

                    $urole_title = $urole_title['role_title'];
                    echo("<script type='text/javascript'> document.getElementById('access_level').innerHTML = '".$urole_title."' </script>");
                }
            } catch (PDOException $e) {
                $error_message = $e;
//						$e->getMessage();
            }
        }
    }
?>
<div class='settings-home'>
    <div>
        <h3> USER INFO </h3>
        <span><b>username</b> : <?php echo $UNAME; ?></span><p style='display: inline-block; width: 20px;'></p>
        <input type="button" value="Password Reset" onclick=""></input><p style='display: inline-block; width: 20px;'></p>
        <span><b>role_title</b> : <?php echo $urole_title; ?></span><p style='display: inline-block; width: 20px;'></p>
    </div>
    <br>
    <input type="button" value="Request Alt User Tier" onclick=""></input>
    <br><br>
    <input type="button" value="LOG OUT" onclick="window.location = './log_out.php'"></input>
</div>

<?php require_once("../view/footer.php"); ?>