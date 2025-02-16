<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class compare {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertCompare($productId, $customer_id) {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
        $compareQuery = "SELECT * FROM tbl_compare WHERE customerId='$customer_id' AND productId='$productId'";
        $compareResult = $this->db->select($compareQuery);
        if($compareResult) {
            $msg = "<span class='error'>Product Already Added to Compare</span>";
            return $msg;
        }
        $query = "SELECT * FROM tbl_product WHERE productId='$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];
        $query_cmp = "INSERT INTO tbl_compare(customerId, productId, productName, price, `image`) 
                        VALUES('$customer_id', '$productId', '$productName', '$price', '$image')";
        $result_cmp = $this->db->insert($query_cmp);
        if($result_cmp) {
            $alter = "<span class='success'>Insert Compare Successfu!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Insert Compare Failed!</span>";
            return $alter;
        }
    }
    public function showCompare($id) {
        $query = "SELECT * FROM tbl_compare WHERE customerId='$id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function deleteCompare($id) {
        $customerId = Session::get( 'customer_id');
        $query = "DELETE FROM tbl_compare WHERE customerId='$customerId' AND id='$id'";
        $result = $this->db->delete($query);
        if($result) {
            $msg = "<span class='success'>Delete Successful</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Delte Failed</span>";
            return $msg;
        }
    }
    public function deleteAllCompare($customerId) {
        $query = "DELETE FROM tbl_compare WHERE customerId='$customerId'";
        $result = $this->db->delete($query);
        return $result;
    }
}