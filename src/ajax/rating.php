<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    $db = new Database();
    if(isset($_POST["index"])) {
        $index = $_POST["index"];
        $product_id = $_POST["product_id"];
        $customer_id = $_POST["customer_id"];
        $queryCheck = "SELECT * FROM tbl_rating WHERE productId='$product_id' AND customerId='$customer_id'";
        $resultCheck = $db->select($queryCheck);
        if($resultCheck) {
            $query = "UPDATE tbl_rating SET rating='$index' WHERE productId='$product_id' AND customerId='$customer_id'";
            $result = $db->update($query);
        } else {
            $query = "INSERT INTO tbl_rating(rating, productId, customerId) VALUES('$index', '$product_id', '$customer_id')";
            $result = $db->insert($query);
        }
    }
?>