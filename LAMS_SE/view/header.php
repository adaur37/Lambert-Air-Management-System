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
          href="http://localhost/jSnider_LAMS/styles.css">
</head>

<!-- the body section -->
<body>
<header>
    <h1 style="display: inline-block;"> Lambert Air </h1>
    <div style="display:inline-block; margin-left: 30%;">
        <a href="http://localhost/jSnider_LAMS/">Home</a>
        <a href="http://localhost/jSnider_LAMS/product_manager">Admin</a>
        <a href="http://localhost/jSnider_LAMS/quote">Quote</a>
        <a href="http://localhost/jSnider_LAMS/about_us">About</a>

        <?php
            if ( $_SESSION['UNAME'] != "")
            {
                // Does User have priviledges and on what level?
                $UNAME = "";
                $UPASSWD = "";
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
                    require_once('../model/database.php');
                    try {
                        $query = "SELECT * FROM flights";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $result = $statement->fetch();
                        $statement->closeCursor();
                    } catch (PDOException $e) {
                        $error_message = $e->getMessage();
                        exit();
                    }
                    if ( empty($error_message) )
                    { $matched_user = true; }
                }

                if ( $matched_user )
                {
                    echo (
                    "<a href='http://localhost/jSnider_LAMS/settings'>".
                    "<img style='height: 40px;' src='http://localhost/jSnider_LAMS/images/login-icon.png' alt='login-icon'></img>".
                    "<p id='logged_in_uname'>".$UNAME.
                    "</p></a>"
                    );
                }
                else
                {
                    echo (
                        "<a href='http://localhost/jSnider_LAMS/sign_in'>".
                        "<img style='height: 40px;' src='http://localhost/jSnider_LAMS/images/login-icon.png' alt='login-icon'></img>".
                        "Sign In".
                        "</a>"
                        );
                }
            }
            else
            {
                echo (
                    "<a href='http://localhost/jSnider_LAMS/sign_in'>".
                    "<img style='height: 40px;' src='http://localhost/jSnider_LAMS/images/login-icon.png' alt='login-icon'></img>".
                    "Sign In".
                    "</a>"
                    );
            }
        ?>
        <!--
        <div style="display: inline-block; width: 35%; text-align: right;">
        <a href="http://localhost/jSnider_LAMS/cart">
            <img src="http://localhost/jSnider_LAMS/images/cart.png" alt="shopping-cart"/>
            <br>
            <span>CART</span>
        </a>
        </div>
        -->
    </div>
    <h2 style="vertical-align: top;">Management System</h2>
</header>
