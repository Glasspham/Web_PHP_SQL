<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class product {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertProduct($data, $files) { 
        $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
        $brand = mysqli_real_escape_string($this->db->link, $data["brand"]);
        $category = mysqli_real_escape_string($this->db->link, $data["category"]);
        $description = mysqli_real_escape_string($this->db->link, $data["description"]);
        $price = mysqli_real_escape_string($this->db->link, $data["price"]);
        $type = mysqli_real_escape_string($this->db->link, $data["type"]);
        $quantity = mysqli_real_escape_string($this->db->link, $data["quantity"]);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../uploads/product/".$unique_image;
        if($productName=="" || $brand=="" || $category=="" || $description=="" || $price=="" || $quantity=="" || $type=="" || $file_name=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_product(productName, catId, brandId, `description`, price, `type`, `image`, quantity) 
                    VALUES('$productName', '$category', '$brand', '$description', '$price', '$type', '$unique_image', '$quantity')";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Insert Product Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Insert Product Not Successfully!</span>";
            return $alter;
        }
    }
    public function updateProduct($data, $files, $id) {
        $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
        $brand = mysqli_real_escape_string($this->db->link, $data["brand"]);
        $category = mysqli_real_escape_string($this->db->link, $data["category"]);
        $description = mysqli_real_escape_string($this->db->link, $data["description"]);
        $price = mysqli_real_escape_string($this->db->link, $data["price"]);
        $type = mysqli_real_escape_string($this->db->link, $data["type"]);
        $quantity = mysqli_real_escape_string($this->db->link, $data["quantity"]);
        // Check the image and put it in the uploads folder
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../uploads/product/".$unique_image;
        if($productName=="" || $brand=="" || $category=="" || $description=="" || $price=="" || $type=="" || $quantity=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        if(!empty($file_name)) {
            // Change new picture
            if(in_array($file_ext, $permited) === false) {
                $alter = "<span class='error'>You Can Upload Only:-".implode(', ',$permited)."</span>";
                return $alter;
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    `description` = '$description',
                    price = '$price',
                    `type` = '$type',
                    `image` = '$unique_image',
                    quantity = '$quantity'
                    WHERE productId='$id'";
        } else {
            $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    `description` = '$description',
                    price = '$price',
                    `type` = '$type',
                    quantity = '$quantity'
                    WHERE productId='$id'";
        }
        $result = $this->db->update($query);
        if($result) {
            $alter = "<span class='success'>Product Updated Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Product Updated Not Success!</span>";
            return $alter;
        }
    }
    public function deleteProduct($id) {
        $query = "DELETE FROM tbl_product WHERE productId='$id'";
        $result = $this->db->delete($query);
        if($result) {
            $alter = "<span class='success'>Product Deleted Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Product Deleted Not Success!</span>";
            return $alter;
        }
    }
    public function showProduct() {
        $query = "SELECT A.*, B.catName, C.brandName
                FROM tbl_product A
                    INNER JOIN tbl_category B ON A.catId = B.catId
                    INNER JOIN tbl_brand C ON A.brandId = C.brandId
                ORDER BY A.productName";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductById($id) {
        $query = "SELECT A.*, B.catName, C.brandName
                FROM tbl_product A
                    INNER JOIN tbl_category B ON A.catId = B.catId
                    INNER JOIN tbl_brand C ON A.brandId = C.brandId
                WHERE A.productId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductByBrandId($id) {
        $query = "SELECT * FROM tbl_product WHERE brandId='$id' ORDER BY productId LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAllProductFeatured() {
        $query = "SELECT * FROM tbl_product WHERE type=1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductFeatured($page = 1) {
        $productPerPage = 4;
        $offset = ($page - 1) * $productPerPage;  
        $query = "SELECT * FROM tbl_product WHERE type=1 ORDER BY productId DESC LIMIT $productPerPage OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductNew($page = 1) {
        $productPerPage = 4;
        $offset = ($page - 1) * $productPerPage; 
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $productPerPage OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }    
    public function getProductAll() {
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }
    public function searching($key) {
        $key = $this->fm->validation($key);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$key%' ORDER BY type DESC";
        $result = $this->db->select($query);
        return $result;
    }
    
}
?>