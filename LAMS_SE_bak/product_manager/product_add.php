<?php
    $UNAME = $_SESSION["UNAME"];
    $UPASSWD = $_SESSION["UPASSWD"];

    if ( empty($UNAME) )
    { $UNAME = filter_input(INPUT_POST, 'in_uname'); }
    if ( empty($UPASSWD) )
    { $UPASSWD = filter_input(INPUT_POST, 'in_upasswd'); }


    if ( empty($action) )
    {
        $action = filter_input(INPUT_GET, "action");
        if ( empty($action) )
        { $action = filter_input(INPUT_POST, "action"); }
    }



    if ( empty($category) )
    { 
        $category = filter_input(INPUT_GET, "category"); 
        if ( empty($category) )
        { $category = filter_input(INPUT_POST, "category");  }
    }
    else
    {
        // No category or entity to add to selected, form is meaningless with no destination.
    }


    if ( $action == "submit_data" )
    {
        global $category;
        $columns = array();
        foreach ( $_POST as $key => $value)
        { 
            if ( $key != "action" AND $key != "in_uname" AND $key != "in_upasswd")
            { array_push($columns, [$key, $value]); }
        }

        $build_insert = "";
        $i = 0;
        foreach ( $columns as $value)
        { 
            global $i;
            $end_msg = ",  ";
            if ( $i == count($columns)-1 )
            { $end_msg = "  )"; }
            $build_insert = $build_insert.("'".$value[1]."'".$end_msg); 
            $i++;
        }

        $sql_command = str_replace('{}', $category, "INSERT INTO {} VALUES("  );
        $sql_command = $sql_command.$build_insert;
        if ( strlen($sql_command) >= 50 )
        {
            include_once('../model/database.php');
            $statement = $db->prepare($sql_command);
            $statement->execute();
        }
        echo("<script type='text/javascript'>alert('Add Record Operation Complete.' ); window.location.replace('manager_home.php?action=list_products');</script>" );
    }
    else {
?>
<main>
    <h1>Add Product</h1>
    <form action="product_add.php?action=submit_data&category=<?php echo $category  ?>" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_product">

            <?php
                require_once('../model/database.php');
                require_once('../model/product_db.php');
                $products = get_products_by_category($category);
            ?>

            <table>
            <?php foreach ($products as $index => $record) : ?> <!-- https://stackoverflow.com/questions/12802482/javascript-onclick-redirect--> 
                    <!-- CODE BLOCK 'light_blue service item' used to be here -->
                    <!-- CODE BLOCK 'DB RECORD INTO TABLE ROW' -->
                    <tr>
                        <?php
                            if ( $index == 0)
                            {
                                $columns = array();
                                foreach( $record as $column => $value )
                                {
                                    if ( intval($column) == 0 AND $column != '0' )
                                    { array_push($columns, $column); }
                                }

                                foreach ( $columns as $column)
                                { echo ("<th>".$column."</th>" ); }
                            }
                        ?>
                    </tr>
                    <tr>
                        <?php
                            for($i = 0; $i < sizeof($record)/2 ; $i++){
                                $column = $record[$i];
                                echo ("<td class='right'>" );
                                echo ($column );
                                echo ("</td>" );
                            }

                            break; // TERMINATE LOOP AFTER A SINGLE ROW PRINTED, ONLY FOR ./product_manager/product_add.php
                        ?>
                    </tr>
                <?php endforeach; ?>
        </table>

        <?php
            foreach ( $columns as $column)
            {
                echo("<label>".$column.":</label>".
                    "<input type='text' name='".$column."' /><br>"
                    );
            }
            
        ?>

        <label>&nbsp;</label>
        <input type="submit" value="Add Product" />
        <br>

        <input type="text" id="in_uname" name="in_uname" style="visibility: hidden;" value="<?php echo $UNAME; ?>" />
        <input type="text" id="in_upasswd" name="in_upasswd" style="visibility: hidden;" value="<?php echo $UPASSWD; ?>" />
    </form>
    <p class="last_paragraph">
        <a href="manager_home.php?action=list_products">View Product List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>
<?php } // Close ELSE statement ?>