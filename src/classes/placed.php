<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
include_once ($filepath."/../classes/order.php");

class placed {
    private $db;
    private $fm;
    private $order;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
        $this->order = new order();
    }
    public function checkPlaced($customerId) {
        $query = "SELECT * FROM tbl_placed WHERE customerId='$customerId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getInboxCart() { 
        $query = "SELECT A.*, B.*
                FROM tbl_placed A, tbl_customer B
                WHERE A.customerId=B.id
                ORDER BY date_created";
        $result = $this->db->select($query);
        return $result; 
    }
    public function shifted($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_placed SET status=1 WHERE placedId='$id'";
        $result = $this->db->update($query);
        if($result) {
            $msg = "<span class='success'>Order Update Successful</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Order Update Failed</span>";
            return $msg;
        }
    }
    public function confirmShifted($id) {
        $ordercode = $this->getPlacedById($id)->fetch_assoc()['order_code'];
        $customerId = Session::get("customer_id");
        $getProductOrder = $this->order->showOrder($customerId, $ordercode);
        if($getProductOrder) {
            while($res = $getProductOrder->fetch_assoc()) {
                $productName = $res["productName"];
                $quantity = $res["quantity"];
                $price = $res["price"];
                $image = $res["image"];
                $query = "INSERT INTO tbl_purchase_history(order_code, customerId, productName, quantity, totalPrice, `image`)
                            VALUES('$ordercode', '$customerId', '$productName', '$quantity', '$price', '$image')";
                $this->db->insert($query);
            }
            $this->order->deleteByOrderCode($ordercode);
            $this->delShifted($id);
        }
    }
    public function delShifted($id) {
        $query = "DELETE FROM tbl_placed WHERE placedId='$id'";
        $result = $this->db->delete($query);
    }
    public function getPlacedById($id) {
        $query = "SELECT * FROM tbl_placed WHERE placedId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>