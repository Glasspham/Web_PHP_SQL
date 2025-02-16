<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once ($filepath."/../helpers/format.php");
    $db = new Database();
    $id_cart = $_POST['id_cart'];
    $cart_status = $_POST['cart_status'];
    $query = "UPDATE tbl_cart SET buy='$cart_status' WHERE cartId='$id_cart'";
    $result = $db->insert($query);
    if($result) {
        echo "Successful";
    } else {
        echo"Failed";
    }
?>