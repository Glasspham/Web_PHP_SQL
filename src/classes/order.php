<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class order {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertOrder($customerId) {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId='$sessionId' AND buy=1";
        $getProduct = $this->db->select($query);
        $order_code = rand(00000, 99999);
        if($getProduct) {
            while($result = $getProduct->fetch_assoc()) {
                $productId = $result["productId"];
                $productName = $result["productName"];
                $quantity = $result["quantity"];
                $price = $result["price"] * $quantity;
                $image = $result["image"];
                $query_order = "INSERT INTO tbl_order(productId,  productName, price, quantity, `image`, customerId, order_code) 
                        VALUES('$productId', '$productName', '$price', '$quantity', '$image', '$customerId', '$order_code')";
                $this->db->insert($query_order);
            }
            $query_placed = "INSERT INTO tbl_placed(order_code, `status`, customerId) 
                    VALUES('$order_code', '0', '$customerId')";
            $this->db->insert($query_placed);
        }
    }
    public function getAmountPrice($customerId) {
        $query = "SELECT price FROM tbl_order WHERE customerId='$customerId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function showOrder($customerId, $ordercode) {
        $query = "SELECT * FROM tbl_order WHERE customerId='$customerId' AND order_code='$ordercode'";
        $result = $this->db->select($query);
        return $result; 
    }
    public function deleteByOrderCode($ordercode) {
        $query = "DELETE FROM tbl_order WHERE order_code='$ordercode'";
        $result = $this->db->delete($query);
        return $result;
    }
}
?>