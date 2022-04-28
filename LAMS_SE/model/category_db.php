<?php
function get_categories() {
    global $db;
    $query = "SELECT Table_name FROM information_schema.tables WHERE table_schema = 'cs440_flightmgmtsys'";
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;    
}

function get_category_name($category_id) {
    global $db;
    $query = "SELECT Table_name FROM information_schema.tables WHERE table_schema = 'cs440_flightmgmtsys' AND Table_name = :category_id";    
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();    
    $category = $statement->fetch();
    $statement->closeCursor();    
    $category_name = $category['Table_name'];
    return $category_name;
}
?>