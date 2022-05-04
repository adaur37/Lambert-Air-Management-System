<?php require_once('../view/header.php'); ?>

<h1 style='display: inline-block;'>In / Out Dashboard &nbsp;&nbsp;&nbsp;</h1><span>u-lvl: >= Default</span>
<?php
    if ( session_id() != "")
    {
        // Check for passed category_id in URL from 'specific_list.php'
        if ( !empty($_GET['category_id']) )
        { $category_id = filter_input(INPUT_GET, 'category_id'); }

        if ( $_SESSION['UROLE_ID'] != NULL AND $_SESSION['UROLE_ID'] > -1)
        {
            $UNAME = $_SESSION['UNAME'];
            $UPASSWD = $_SESSION['UPASSWD'];
            $UROLE_ID = $_SESSION['UROLE_ID'];

            require_once('../model/database.php');
            require_once('../model/category_db.php');
            $categories = get_categories();
            if ( !empty($category_id) )
            { 
                require_once('../model/product_db.php');
                $products = get_products_by_category($category_id); 
            }
            $target_tables = "arrivaldepartureboard, delaycancelboard, countries";
            require_once('specific_list.php');
        }
    }
?>

<?php require_once('../view/footer.php'); ?>