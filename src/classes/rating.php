<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class rating {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function getRating($id) {
        $query = "SELECT * FROM tbl_rating WHERE productId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}