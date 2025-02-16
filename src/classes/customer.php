<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class customer {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertCustomer($data) {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        /* $name = isset($data['name']) ? mysqli_real_escape_string($this->db->link, $data['name']) : '';
        $address = isset($data['address']) ? mysqli_real_escape_string($this->db->link, $data['address']) : '';
        $city = isset($data['city']) ? mysqli_real_escape_string($this->db->link, $data['city']) : '';
        $country = isset($data['country']) ? mysqli_real_escape_string($this->db->link, $data['country']) : '';
        $zipcode = isset($data['zipcode']) ? mysqli_real_escape_string($this->db->link, $data['zipcode']) : '';
        $phone = isset($data['phone']) ? mysqli_real_escape_string($this->db->link, $data['phone']) : '';
        $email = isset($data['email']) ? mysqli_real_escape_string($this->db->link, $data['email']) : '';
        $password = isset($data['password']) ? mysqli_real_escape_string($this->db->link, md5($data['password'])) : ''; */
        if($name=="" || $address=="" || $city=="" || $country=="" || $phone=="" || $email=="" || $password=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        $queryCheckEmail = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
        $resultCheckEmail = $this->db->select($queryCheckEmail);
        if($resultCheckEmail) {
            $alter = "<span class='error'>This email has been created</span>";
            return $alter;
        }
        if($zipcode=="") {
        $query = "INSERT INTO tbl_customer(name, address, city, country, phone, email, password) 
                    VALUES('$name', '$address', '$city', '$country', '$phone', '$email', '$password')";
        } else {
        $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) 
                    VALUES('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";
        }
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Account Created Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Account Creation Failed!</span>";
            return $alter;
        }
    }
    public function loginCustomer($data) {
        $account = mysqli_real_escape_string($this->db->link, $data['account']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if($account=="" || $password== "") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        $queryCheckByEmail = "SELECT * FROM tbl_customer WHERE email='$account' AND password='$password'";
        $resultCheckByEmail = $this->db->select($queryCheckByEmail);
        $queryCheckByUsername = "SELECT * FROM tbl_customer WHERE name='$account' AND password='$password'";
        $resultCheckByUsername = $this->db->select($queryCheckByUsername);
        if($resultCheckByEmail) {
            $value = $resultCheckByEmail->fetch_assoc();
            // print_r($value);
            Session::set("customer_login", true);
            Session::set("customer_id", $value['id']);
            Session::set("customer_name", $value['name']);
        } elseif($resultCheckByUsername) {
            $value = $resultCheckByUsername->fetch_assoc();
            // print_r($value);
            Session::set("customer_login", true);
            Session::set("customer_id", $value['id']);
            Session::set("customer_name", $value['name']);
        } else {
            $alter = "<span class='error'>Wrong Password Or Account!</span>";
            return $alter;
        }
        // header('Location: order.php');
    }
    public function showCustomer($id) { 
        $query = "SELECT * FROM tbl_customer WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function updateCustomer($data, $id) {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        if($name=="" || $address=="" || $phone=="" || $email=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        if($zipcode=="") $query = "UPDATE tbl_customer SET name='$name', address='$address', phone='$phone', email='$email' WHERE id='$id'";
        else $query = "UPDATE tbl_customer SET name='$name', address='$address', zipcode='$zipcode', phone='$phone', email='$email' WHERE id='$id'";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Account Updated Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Account Update Failed!</span>";
            return $alter;
        }
    }
    public function insertComment() {
        $id = $_POST['productId'];
        $username = $_POST['username'];
        $content = $_POST['content'];
        if($id=='' || $username=='' || $content=='') {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        $query = "INSERT INTO tbl_comment(userName, content, productId) VALUES('$username', '$content', '$id')";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Comment Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Comment Failed!</span>";
            return $alter;
        }
    }
    public function showOrder($order_code) {
        $query = "SELECT * FROM tbl_order WHERE order_code='$order_code'";
        $result = $this->db->select($query);
        return $result; 
    }
}
?>