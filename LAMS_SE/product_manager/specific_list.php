<?php include_once '../view/header.php'; ?>
<?php

/*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Product Manager : specific_list.php
 * Joshua Snider
 * May022022
 * Like product_list.php but allows filtering for different page layouts.
*//////////////////////////////////////////////////////////////////////////////////////////////////

    $UNAME = $_SESSION["UNAME"];
    $UPASSWD = $_SESSION["UPASSWD"];
    $FILTER = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ( !empty($_POST['target_tables']) )
        {
            $target_tables = filter_input(INPUT_POST, 'target_tables');
            $target_tables = explode(" ,", $target_tables );

            $FILTER = $target_tables;
        }
    }
    else
    {
        $target_tables = explode(", ", $target_tables );
        $FILTER = $target_tables;
    }

    // If user clicks on an entity, show them the table.
    $category_name = filter_input(INPUT_GET, 'category_id');
?>
<main>
    <h1>Entities <?php if ( $UROLE_ID == 0 ){ echo '>> READ-ONLY mode'; } ?></h1>

    <div>
        <!-- display a list of categories -->
        <ol class="c-services_b">
            <!-- if this item is the entity that was chosen by the user, highlight with different color -->
            <?php foreach($categories as $category) : ?>
                <?php
                    $keepItem = false;
                    foreach ( $FILTER as $sel_tbl_name)
                    {
                        if ( $category['Table_name'] == $sel_tbl_name )
                        { $keepItem = true; }
                    }
                ?>

                <?php if ( $keepItem ) : ?>
                <li class="<?php if ($category['Table_name'] == $category_name ){ echo 'c-services__item_b'; } else{ echo 'c-services__item'; } ?>" 
                    onclick="window.location = '?category_id=<?php echo $category['Table_name']; ?>';">
                    <a href="?category_id=<?php echo $category['Table_name']; ?>">
                        <?php echo $category['Table_name']; ?>
                    </a>
                    <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>

    <div>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <div style="max-height: 860px; overflow: auto;">
        <table>
            <?php if ( !empty($products) ){ foreach ($products as $index => $record) : ?> <!-- https://stackoverflow.com/questions/12802482/javascript-onclick-redirect--> 
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
                        ?>
                        <td><form action="manager_home.php?action=delete_product" method="post">
                        <input type="hidden" name="action"
                            value="delete_product">
                        <input type="hidden" name="product_id"
                            value="<?php echo $columns[0]."||".$record[0]; ?>">
                        <input type="hidden" name="category_id"
                            value="<?php echo $category_name; ?>">
                        <input type="<?php if ( $UROLE_ID > 0) { echo 'submit'; } else { echo 'hidden'; } ?>" value="Delete">                        
                        </form></td>
                    </tr>
                <?php endforeach; } ?>
        </table>
    </div>
    <?php 
        if ( $UROLE_ID > 0 )
        {
            if ( $products != NULL)
            {
                echo("<div style='text-align:center;'>".
                    "<a href='?action=show_add_form&category=".$category_name."' id='last_paragraph'>".
                    "<input type='button' value='Add Product'></input>".
                    "</a>".
                    "</div>"
                );
            }
        }
    ?>
</main>
<?php include '../view/footer.php'; ?>
<script> if ( document.getElementById("logged_in_uname").innerHTML == "") { window.location.reload(true); } </script>