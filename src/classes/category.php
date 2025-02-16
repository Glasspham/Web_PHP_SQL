<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class category {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertCategory($catName) { 
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if(empty($catName)) {
            $alter = "<span class='error'>Category must be not empty!</span>";
            return $alter;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query);
            if($result) {
                $alter = "<span class='success'>Insert Category Success!</span>";
                return $alter;
            } else {
                $alter = "<span class='error'>Insert Category Not Success!</span>";
                return $alter;
            }
        }
    }
    public function updateCategory($catName, $id) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($catName)) {
            $alter = "<span class='error'>Category must be not empty!</span>";
            return $alter;
        } else {
            $query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
            $result = $this->db->insert($query);
            if($result) {
                $alter = "<span class='success'>Category Updated Success!</span>";
                return $alter;
            } else {
                $alter = "<span class='error'>Category Updated Not Success!</span>";
                return $alter;
            }
        }
    }
    public function deleteCategory($id) {
        $query = "DELETE FROM tbl_category WHERE catId='$id'";
        $result = $this->db->delete($query);
        if($result) {
            $alter = "<span class='success'>Category Deleted Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Category Deleted Not Success!</span>";
            return $alter;
        }
    }
    public function showCategory() {
        $query = "SELECT * FROM tbl_category ORDER BY catName";
        $result = $this->db->select($query);
        return $result;
    }
    public function getCatById($id) {
        $query = "SELECT * FROM tbl_category WHERE catId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductByCat($id) {
        $query = "SELECT * FROM tbl_product WHERE catId='$id'";
        $result = $this->db->select($query);
        return $result;    
    }
}
?>