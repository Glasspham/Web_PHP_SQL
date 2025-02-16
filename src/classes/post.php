<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class post {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertPost($title, $description, $status) { 
        $title = $this->fm->validation($title);
        $status = $this->fm->validation($status);
        $description = $this->fm->validation($description);
        $title = mysqli_real_escape_string($this->db->link, $title);
        $status = mysqli_real_escape_string($this->db->link, $status);
        $description = mysqli_real_escape_string($this->db->link, $description);
        if(empty($title) || empty($description)) {
            $alter = "<span class='error'>Must Fill In All Fields!</span>";
            return $alter;
        } 
        $query = "INSERT INTO tbl_post_category(title, `description`, `status`) VALUES('$title', '$description', '$status')";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Insert Post Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Insert Post Failed!</span>";
            return $alter;
        }
    }
    public function updatePost($data, $files, $id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $title = $this->fm->validation($data['title']);
        $status = $this->fm->validation($data['status']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $status = mysqli_real_escape_string($this->db->link, $status);
        $title = mysqli_real_escape_string($this->db->link, $title);
        if($title=='' || $description=='' || $status== '') {
            $alter = "<span class='error'>Must Fill In All Fields!</span>";
            return $alter;
        }
        $query = "UPDATE tbl_post_category SET title='$title', `description`='$description', `status`='$status' WHERE id='$id'";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Post Updated Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Post Updated Failed!</span>";
            return $alter;
        }
    }
    public function deletePost($id) {
        $query = "DELETE FROM tbl_post_category WHERE id='$id'";
        $result = $this->db->delete($query);
        if($result) {
            $alter = "<span class='success'>Post Deleted Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Post Deleted Failed!</span>";
            return $alter;
        }
    }
    public function showPost() {
        $query = "SELECT * FROM tbl_post_category ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getPostById($id) {
        $query = "SELECT * FROM tbl_post_category WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function changeStatus($id, $n) {
        if($n) $query = "UPDATE tbl_post_category SET `status`=1 WHERE id='$id'";
        else $query = "UPDATE tbl_post_category SET `status`=0 WHERE id='$id'";
        $this->db->update($query);
    }
    public function getCategoryPost($id) {
        $query = "SELECT A.title catTitle, B.*
                FROM tbl_post_category A
                INNER JOIN tbl_blog B ON A.id=B.category_post
                WHERE A.id='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>