<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class cart {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function update() {
        $id = session_id();
        $totalQuery = "SELECT SUM(price * quantity) totalPrice, SUM(quantity) totalQuantity 
                        FROM tbl_cart WHERE sessionId='$id'";
        $totalResult = $this->db->select($totalQuery);
        if ($totalResult) {
            $row = $totalResult->fetch_assoc();
            $_SESSION['sum'] = $row['totalPrice'];
            $_SESSION['quantity'] = $row['totalQuantity'];
        } else {
            $_SESSION['sum'] = 0;
            $_SESSION['quantity'] = 0;
        }
    }
    public function addToCart($stock, $quantity, $id) {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $stock = $this->fm->validation($stock);
        $stock = mysqli_real_escape_string($this->db->link, $stock);
        if($stock < $quantity) {
            $msg = "<span class='error'>Purchase quantity must be less than stock quantity</span>";
            return $msg;
        }
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sessionId = session_id();
        $queryCheck = "SELECT * FROM tbl_cart WHERE productId='$id' AND sessionId='$sessionId'";
        $resultCheck = $this->db->select($queryCheck);
        if($resultCheck) {
            $row = $resultCheck->fetch_assoc();
            $newQuantity = (int)$quantity + (int)$row['quantity'];
            $updateQuery = "UPDATE tbl_cart SET quantity='$newQuantity' WHERE productId='$id' AND sessionId='$sessionId'";
            $updateResult = $this->db->update($updateQuery);
            if(!$updateResult) return "<span class='error'>Add failed product</span>";
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId='$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $addQuery = "INSERT INTO tbl_cart(productId, sessionId, productName, price, quantity, image) 
                        VALUES('$id', '$sessionId', '$result[productName]', '$result[price]', '$quantity', '$result[image]')";
            $addResult = $this->db->insert($addQuery);
            if(!$addResult) return "<span class='error'>Add failed product</span>";
        }
        $this->update();
        return "<span class='success'>Product added successfully</span>";
    }
    public function updateQuantityCart($cartId, $quantity) {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $queryQuantity = "SELECT quantity
                        FROM tbl_product
                        WHERE productId=(
                            SELECT productId
                            FROM tbl_cart
                            WHERE cartId=$cartId
                        )";
        $stock = $this->db->select($queryQuantity)->fetch_assoc()['quantity'];
        if($stock < $quantity) return "<span class='error'>Purchase quantity must be less than stock quantity</span>";
        $query = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId'";
        $result = $this->db->update($query);
        $this->update();
        if($result) return "<span class='success'>Product Quantity Updated Successful</span>";
        return "<span class='error'>Product Quantity Updated Not Successful</span>";
    }
    public function deleteCart($id) {
        $query = "DELETE FROM tbl_cart WHERE cartId='$id'";
        $result = $this->db->delete($query);
        $this->update();
        if($result) return "<span class='success'>Product Deleted success!</span>";
        $this->update();
        return "<span class='error'>Product Deleted Failed!</span>";
    }
    public function deleteAllCart() {
        $sessionId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sessionId='$sessionId'";
        $result = $this->db->delete($query);
        $this->update();
        return $result;
    }
    public function deletePurchasedProducts() {
        $sessionId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sessionId='$sessionId' AND buy=1";
        $result = $this->db->delete($query);
        $this->update();
        return $result;
    }
    public function getCarts() {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId='$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>