<?php include_once '../view/header.php'; ?>
<?php

/*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Product Manager : product_list.php
 * Joshua Snider
 * Apr282022
 * Entity listing page chunk for Product Manager, served when user does not have a specified action like add or delete.
*//////////////////////////////////////////////////////////////////////////////////////////////////

    $UNAME = $_SESSION["UNAME"];
    $UPASSWD = $_SESSION["UPASSWD"];
?>
<main>
    <h1>Entities</h1>

    <div>
        <!-- display a list of categories -->
        <ol class="c-services_b">
            <!-- if this item is the entity that was chosen by the user, highlight with different color -->
            <?php foreach($categories as $category) : ?>
                <li class="<?php if ($category['Table_name'] == $category_name ){ echo 'c-services__item_b'; } else{ echo 'c-services__item'; } ?>" 
                    onclick="window.location = '?category_id=<?php echo $category['Table_name']; ?>';">
                    <a href="?category_id=<?php echo $category['Table_name']; ?>">
                        <?php echo $category['Table_name']; ?>
                    </a>
                    <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
                </li>
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
                        <input type="submit" value="Delete">
                        </form></td>
                    </tr>
                <?php endforeach; } ?>
        </table>
    </div>
    <?php 
        if ( $products != NULL)
        {
            echo("<div style='text-align:center;'>".
                "<a href='?action=show_add_form&category=".$category_name."' id='last_paragraph'>".
                "<input type='button' value='Add Product'></input>".
                "</a>".
                "</div>"
            );
        }
    ?>
</main>
<?php include '../view/footer.php'; ?>
<script> if ( document.getElementById("logged_in_uname").innerHTML == "") { window.location.reload(true); } </script>