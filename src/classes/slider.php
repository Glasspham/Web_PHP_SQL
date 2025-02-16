<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class slider {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertSilder($data, $files) {
        $sliderName = mysqli_real_escape_string($this->db->link, $data["title"]);
        $type = mysqli_real_escape_string($this->db->link, $data["type"]);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../uploads/slider/".$unique_image;
        if($sliderName=="" || $file_name==""|| $type=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_slider(sliderName, `image`, `type`) VALUES('$sliderName', '$unique_image', '$type')";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Insert Picture Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Insert Picture Failed!</span>";
            return $alter;
        }
    }
    public function showSlider() {
        $query = "SELECT * FROM tbl_slider ORDER BY `type` DESC, sliderId";
        $result = $this->db->select($query);
        return $result;
    }
    public function changeSlider($id, $n) {
        if($n == 1) $query = "UPDATE tbl_slider SET `type`=1 WHERE sliderId='$id'";
        else $query = "UPDATE tbl_slider SET `type`=0 WHERE sliderId='$id'";
        $this->db->update($query);
    }
    public function deleteSlider($id) {
        $query = "DELETE FROM tbl_slider WHERE sliderId='$id'";
        $result = $this->db->DELETE($query);
        if($result) {
            $alter = "<span class='success'>Product Deleted Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Product Deleted Not Success!</span>";
            return $alter;
        }
    }
}