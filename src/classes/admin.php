<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../lib/database.php");
include_once($filepath."/../helpers/format.php");

class admin {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function loginAdmin($username, $password) { 
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        if(empty($username) || empty($password)) {
            $alter = "Username or Password must be not empty!";
            return $alter;
        } else {
            $query = "SELECT * 
                        FROM tbl_admin 
                        WHERE username='$username' 
                        AND `password`='$password' 
                        LIMIT 1";
            $result = $this->db->select($query);
            if($result) {
                $value = $result->fetch_assoc();
                Session::set("admin", true);
                Session::set("id", $value["id"]);
                Session::set("username", $value["username"]);
                Session::set("name", $value["name"]);
                header("Location:index.php");
            } else {
                $alter = "Username or Password not match!";
                return $alter;
            }
        }
    }
    public function changePassword($id, $password, $newpassword) {
        $password = $this->fm->validation($password);
        $queryCheck = "SELECT * FROM tbl_admin WHERE id='$id' AND `password`='$password'";
        $resultCheck = $this->db->select($queryCheck);
        if($resultCheck) {
            $newpassword = $this->fm->validation($newpassword);
            $query = "UPDATE tbl_admin SET `password`='$newpassword'";
            $result = $this->db->update($query);
            if($result) {
                return "<span class='success'>Password Change Successful</span>";
            }
        } else return "<span class='error'>Wrong Password</span>";
    }
    public function show() {
        $id = Session::get('id');
        if($id) {
            $query = "SELECT * FROM tbl_admin WHERE id='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }
}
?>