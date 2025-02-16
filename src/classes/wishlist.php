<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class wishlist {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertWishlist($productId, $customer_id) {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
        $wishlistQuery = "SELECT * FROM tbl_wishlist WHERE customerId='$customer_id' AND productId='$productId'";
        $wishlistResult = $this->db->select($wishlistQuery);
        if($wishlistResult) {
            $msg = "<span class='error'>Product Already Added to Wishlist</span>";
            return $msg;
        }
        $query = "SELECT * FROM tbl_product WHERE productId='$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];
        $query_cmp = "INSERT INTO tbl_wishlist(customerId, productId, productName, price, `image`) 
                        VALUES('$customer_id', '$productId', '$productName', '$price', '$image')";
        $result_cmp = $this->db->insert($query_cmp);
        if($result_cmp) {
            $alter = "<span class='success'>Insert Wishlist Successfu!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Insert Wishlist Failed!</span>";
            return $alter;
        }
    }
    public function showWishlist($id) {
        $query = "SELECT * FROM tbl_wishlist WHERE customerId='$id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function deleteWishlist($id) {
        $query = "DELETE FROM tbl_wishlist WHERE id='$id'";
        $result = $this->db->DELETE($query);
        if($result) {
            $alter = "<span class='success'>Product Deleted Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Product Deleted Not Success!</span>";
            return $alter;
        }
    }
}