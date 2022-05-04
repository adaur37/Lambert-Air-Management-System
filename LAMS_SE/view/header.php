<!DOCTYPE html>
<html>

<!-- /*/////////////////////////////////////////////////////////////////////////////////////////////////
 * View : header.php
 * Joshua Snider
 * Apr262022
 * Project wide header file to give title of project and basic navigation.
*////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- the head section -->
<head>
    <title>LAMS Flight Manager</title>
    <link rel="stylesheet" type="text/css"
          href="http://localhost/LAMS_SE/styles.css">
</head>

<!-- the body section -->
<body>
<header>
    <h1 style="display: inline-block;"> Lambert Air </h1>
    <div style="">
        <a href="http://localhost/LAMS_SE/">Home</a>
        <a href="http://localhost/LAMS_SE/product_manager">Admin</a>
        <a href="http://localhost/LAMS_SE/quote">Quote</a>
        <a href="http://localhost/LAMS_SE/about_us">About</a>

        <?php
			if ( session_id() == "")
			{ session_start(); }
			if ( isset($_SESSION['UNAME'] ) )
			{
				// Does User have priviledges and on what level?
				$UNAME = "";
				$UPASSWD = "";
				$UROLE_ID = -1;
				$matched_user = false;
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					if ( empty($_POST["in_upasswd"]))
					{ $UPASSWD = ""; }
					else
					{ $UPASSWD = md5( $_POST["in_upasswd"] ); }

					if ( empty($_POST["in_uname"]) )
					{ $UNAME = ""; }
					else
					{ $UNAME = ( $_POST["in_uname"]); }

				}
				if ( empty($_SESSION["UNAME"]))
				{
					$_SESSION["UNAME"] = $UNAME;
					$_SESSION["UPASSWD"] = $UPASSWD;
				}
				else
				{
					$UNAME = $_SESSION["UNAME"];
					$UPASSWD = $_SESSION["UPASSWD"];
				}

				// echo "<span>UNAME : ".$UNAME."</span><br>";
				// echo "<span>UPASSWD : ".$UPASSWD."</span><br>";

				if ( $UNAME != "") // Test connection
				{ 
					try {
						if ( file_exists('../model/database.php') )
						{ require_once('../model/database.php'); }
						else
						{ require_once('./model/database.php'); }

						if ( !empty($db) )
						{
							$query = "SELECT * FROM flights";
							$statement = $db->prepare($query);
							$statement->execute();
							$result = $statement->fetch();
							$statement->closeCursor();
						}
					} catch (PDOException $e) {
						$error_message = $e;
//						$e->getMessage();
					}
					if ( empty($error_message) )
					{ $matched_user = true; }
				}

				if ( $matched_user )
				{
					// GET USER ROLE ID AND SAVE
					if( isset($_SESSION['UROLE_ID']) )
					{
						$UROLE_ID = $_SESSION['UROLE_ID'];
					}
					else
					{
						try {
							$query = "SELECT user_role FROM users WHERE username = '".$UNAME."'";
							$statement = $db->prepare($query);
							$statement->execute();
							$UROLE_ID = $statement->fetch();
							$statement->closeCursor();

							$UROLE_ID = $UROLE_ID['user_role'];
							$_SESSION['UROLE_ID'] = $UROLE_ID;
						} catch (PDOException $e) {
							$error_message = $e;
//							$e->getMessage();
						}
					}
				}
				echo (
					"<a href='http://localhost/LAMS_SE/settings'>".
					"<img style='height: 40px;' src='http://localhost/LAMS_SE/images/login-icon.png' alt='login-icon'></img>".
					"<p style='color: white; width: 120px; height: 23px; overflow: hidden; display: inline-block;' id='logged_in_uname'>".$UNAME.
					"</p></a>"
					);
				if ( empty($db) ) // After displaying username in header, check if db is active, and highlight username red if cant connect.
				{ 
					echo ("<script type='text/javascript'> 
						document.getElementById('logged_in_uname').style = 'color: red; width: 120px; height: 23px; overflow: hidden; display: inline-block;' 
						</script>" 
						); 
				}
				else
				{
					// Give User Role Tag underneath
					try {
						$query = "SELECT role_title FROM user_roles WHERE role_id = '".$UROLE_ID."'";
						$statement = $db->prepare($query);
						$statement->execute();
						$urole_tag = $statement->fetch();
						$statement->closeCursor();

						$urole_tag = $urole_tag['role_title'];
					} catch (PDOException $e) {
						$error_message = $e;
//							$e->getMessage();
					}
					// Use $urole_tag to make <p> element to use as text tag for user auth level.
					//
					//
				}
			}
			else
			{
				echo (
					"<a href='http://localhost/LAMS_SE/sign_in'>".
					"<img style='height: 40px;' src='http://localhost/LAMS_SE/images/login-icon.png' alt='login-icon'></img>".
					"<span id='logged_in_uname'></span>Sign In".
					"</a>"
					);
			}
			
        ?>
        <!--
        <div style="display: inline-block; width: 35%; text-align: right;">
        <a href="http://localhost/LAMS_SE/cart">
            <img src="http://localhost/LAMS_SE/images/cart.png" alt="shopping-cart"/>
            <br>
            <span>CART</span>
        </a>
        </div>
        -->
    </div>
    <h2 style="vertical-align: top;">Management System</h2>
</header>
