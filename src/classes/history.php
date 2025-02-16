<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class history {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function getHistoryGroupOrderCode($id) { 
        $query = "SELECT *
                FROM tbl_purchase_history 
                WHERE customerId='$id' 
                GROUP BY order_code 
                ORDER BY date_received DESC";
        $result = $this->db->select($query);
        return $result; 
    }
    public function getDetailOrder($id) {
        $query = "SELECT * FROM tbl_purchase_history WHERE order_code='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>