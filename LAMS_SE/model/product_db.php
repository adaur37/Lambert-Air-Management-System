<?php
function get_products_by_category($tbl_name) { // get_records_by_tablename($table_name)
    global $db;
    $query = str_replace('{}',$tbl_name,'SELECT * FROM {}');
    $statement = $db->prepare($query);
    //$statement->bindValue(':table_name', $tbl_name);  // Didnt work to bind to :table_name, seems like only works in WHERE clause?
    $statement->execute(); // add index column key?
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function get_product($table_name, $key) { //get_record($table_name, $key)
    global $db;
    $query = 'SELECT * FROM :table_name
              WHERE PRIMARY KEY = :record_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':table_name', $table_name);
    $statement->bindValue(':record_id', $key);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

function delete_product($table, $primary_key) {
    global $db;
    $query = str_replace('{}', $table, 'DELETE FROM {} WHERE '); 
    $query = $query.'{}'; // primary_key[0] is column name, primary_key[1] is value of said column.
    $query = str_replace('{}', "".$primary_key[0]." ='".$primary_key[1]."'", $query );
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function add_product($category_id, $code, $name, $authorName, $price) {
    global $db;
    $query = "INSERT INTO products
                 (genreID, productCode, productName, authorName, listPrice)
              VALUES
                 (:category_id, :code, :name, :authorName, :price)";
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':authorName', $authorName);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}
?>