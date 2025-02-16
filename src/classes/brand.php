<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class brand {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertBrand($brandName) { 
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if(empty($brandName)) {
            $alter = "<span class='error'>Brand must be not empty!</span>";
            return $alter;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
            $result = $this->db->insert($query);
            if($result) {
                $alter = "<span class='success'>Insert Brand Success!</span>";
                return $alter;
            } else {
                $alter = "<span class='error'>Insert Brand Not Success!</span>";
                return $alter;
            }
        }
    }
    public function updateBrand($brandName, $id) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($brandName)) {
            $alter = "<span class='error'>Brand must be not empty!</span>";
            return $alter;
        } else {
            $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id'";
            $result = $this->db->insert($query);
            if($result) {
                $alter = "<span class='success'>Brand Updated Success!</span>";
                return $alter;
            } else {
                $alter = "<span class='error'>Brand Updated Not Success!</span>";
                return $alter;
            }
        }
    }
    public function deleteBrand($id) {
        $query = "DELETE FROM tbl_brand WHERE brandId='$id'";
        $result = $this->db->delete($query);
        if($result) {
            $alter = "<span class='success'>Brand Deleted Successful!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Brand Deleted Not Successful!</span>";
            return $alter;
        }
    }
    public function showBrand() {
        $query = "SELECT * FROM tbl_brand ORDER BY brandName";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBrandById($id) {
        $query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBrandByName($name) {
        $query = "SELECT * FROM tbl_brand WHERE brandName='$name'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductByBrand($id) {
        $query = "SELECT * FROM tbl_product WHERE brandId='$id'";
        $result = $this->db->select($query);
        return $result;    
    }
}
?>