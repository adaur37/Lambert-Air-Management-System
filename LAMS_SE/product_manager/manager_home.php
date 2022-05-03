<?php
/*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Product Manager : manager_home.php
 * Joshua Snider
 * Apr292022
 * Serves user with chosen action for database data editing, can add, delete, or list, list is default if nothing chosen
*//////////////////////////////////////////////////////////////////////////////////////////////////

require_once("../view/header.php");
/*    echo "<h1 style='display: inline-block; margin-right: 10%;'>ADMIN ONLY - Product Manager</h1>
        <a style='margin-left: 10%;' href='http://localhost/jSnider_jsBookshop/product_manager'><input type='button' value='LOG OUT'/></a>
        <br>";
*/
    $UNAME = "";
    $UPASSWD = "";
    $matched_user = "NONE";
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
            include('../errors/database_error.php');
            exit();
        }
        if ( empty($error_message) )
        { $matched_user = true; }
        else
        { $matched_user = false; }
    }

    //echo "<span>matched_user.uname : ".print_r( $matched_user )."</span><br>";

// FORCE USER LOGIN TO ALWAYS SUCCEED CHECK ///////////////////////////////////////////////////////////
//   $matched_user[0] = $UNAME;  
// END DEBUG FORCE LOGIN //////////////////////////////////////////////////////////////////////////////

    if( $matched_user )
    {
        require_once('../model/database.php');
        require_once('../model/product_db.php');
        require_once('../model/category_db.php');

        $action = filter_input(INPUT_POST, 'action');
        if ($action == NULL) 
        {
            $action = filter_input(INPUT_GET, 'action');
            if ($action == NULL) 
            { $action = 'list_products'; }
        }

        if ($action == 'list_products') 
        {
            $category_id = filter_input(INPUT_GET, 'category_id');
            if ($category_id == NULL || $category_id == FALSE) {
		    $category_id = 'airlines';
            }
            $category_name = get_category_name($category_id);
            $categories = get_categories();
            $products = get_products_by_category($category_name);
            include('product_list.php');
        } 
        else if ($action == 'delete_product') 
        {
            $product_id = filter_input(INPUT_POST, 'product_id');
            $product_id = array( substr($product_id,0,strpos($product_id, "||" ) ),
                                substr($product_id,strpos($product_id, "||")+2  ) );
            $category_id = filter_input(INPUT_POST, 'category_id');
            if ($category_id == NULL || $category_id == FALSE ||
                    $product_id == NULL || $product_id == FALSE) {
                $error = "Missing or incorrect product id or category id.";
                include('../errors/error.php');
            } else { 
                delete_product( $category_id, $product_id);
                header("Location: manager_home.php?category_id=$category_id");
            }
        } 
        else if ($action == 'show_add_form') 
        {
            $categories = get_categories();
            include('product_add.php');    
        } 
        else if ($action == 'add_product') 
        {
            $category_id = filter_input(INPUT_POST, 'category_id', 
                    FILTER_VALIDATE_INT);
            $code = filter_input(INPUT_POST, 'code');
            $name = filter_input(INPUT_POST, 'name');
            $authorName = filter_input(INPUT_POST, 'authorName');
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            if ($category_id == NULL || $category_id == FALSE || $code == NULL || 
                    $name == NULL || $price == NULL || $price == FALSE) {
                $error = "Invalid product data. Check all fields and try again.";
                include('../errors/error.php');
            } else { 
                add_product($category_id, $code, $name, $authorName, $price);
                header("Location: manager_home.php?category_id=$category_id");
            }
        }   
    }
    else
    {   //Display iframe of the page without any material imports, thereby diabling interaction
        echo ("
            <h2>LOG IN FAILED</h2>
            <span>Wrong username and password combination, here is a preview of what this system looks like, 
                click on the '<< BACK' or 'LOG OUT' buttons to try again:</span>
            <br>
            <img src='../images/product_manager_preview.jfif' />
            <br>"
            );

    }

    require_once("../view/footer.php");
?>
