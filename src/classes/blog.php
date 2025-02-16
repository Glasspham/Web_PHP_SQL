<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");

class blog {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertBlog($data, $files) { 
        $title = mysqli_real_escape_string($this->db->link, $data["title"]);
        $category_post = mysqli_real_escape_string($this->db->link, $data["category_post"]);
        $description = mysqli_real_escape_string($this->db->link, $data["description"]);
        $content = mysqli_real_escape_string($this->db->link, $data["content"]);
        $status = mysqli_real_escape_string($this->db->link, $data["status"]);
        // Check the image and put it in the uploads folder
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../uploads/blog/".$unique_image;
        if($title=="" || $category_post=="" || $description=="" || $content=="" || $status=="" || $file_name=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        }
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_blog(title, category_post, `description`, content, `status`, `image`) 
                    VALUES('$title', '$category_post', '$description', '$content', '$status', '$unique_image')";
        $result = $this->db->insert($query);
        if($result) {
            $alter = "<span class='success'>Insert Blog Successfully!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Insert Blog Failedy!</span>";
            return $alter;
        }
    }
    public function updateBlog($data, $files, $id) {
        $title = mysqli_real_escape_string($this->db->link, $data["title"]);
        $category_post = mysqli_real_escape_string($this->db->link, $data["category_post"]);
        $description = mysqli_real_escape_string($this->db->link, $data["description"]);
        $content = mysqli_real_escape_string($this->db->link, $data["content"]);
        $status = mysqli_real_escape_string($this->db->link, $data["status"]);
        // Check the image and put it in the uploads folder
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../uploads/blog/".$unique_image;

        if($title=="" || $category_post=="" || $description=="" || $content=="" || $status=="") {
            $alter = "<span class='error'>Fields must be not empty!</span>";
            return $alter;
        } else {
            if(!empty($file_name)) {
                // Change new picture
                if($file_size > 20480) {
                    $alter = "<span class='error'>Image Size Should Be Less Then 20MB (<20MB)</span>";
                    return $alter;
                } elseif(in_array($file_ext, $permited) === false) {
                    $alter = "<span class='error'>You Can Upload Only:-".implode(', ',$permited)."</span>";
                    return $alter;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_blog SET 
                        title = '$title',
                        category_post = '$category_post',
                        `description` = '$description',
                        content = '$content',
                        `status` = '$status',
                        `image` = '$unique_image'
                        WHERE id='$id'";
            } else {
                $query = "UPDATE tbl_blog SET 
                        title = '$title',
                        category_post = '$category_post',
                        `description` = '$description',
                        content = '$content',
                        `status` = '$status'
                        WHERE id='$id'";
            }
        }
        $result = $this->db->update($query);
        if($result) {
            $alter = "<span class='success'>Blog Updated Successful!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Blog Updated Failed!</span>";
            return $alter;
        }
    }
    public function deleteBlog($id) {
        $query = "DELETE FROM tbl_blog WHERE id='$id'";
        $result = $this->db->delete($query);
        if($result) {
            $alter = "<span class='success'>Blog Deleted Success!</span>";
            return $alter;
        } else {
            $alter = "<span class='error'>Blog Deleted Failed!</span>";
            return $alter;
        }
    }
    public function showBlog() {
        $query = "SELECT A.*, B.title catTitle
                FROM tbl_blog A
                INNER JOIN tbl_post_category B ON A.category_post=B.id
                ORDER BY id";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBlogById($id) {
        $query = "SELECT A.*, B.title catTitle
                FROM tbl_blog A
                INNER JOIN tbl_post_category B ON A.category_post=B.id
                WHERE A.id='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function changeStatus($id, $n) {
        if($n) $query = "UPDATE tbl_blog SET `status`=1 WHERE id='$id'";
        else $query = "UPDATE tbl_blog SET `status`=0 WHERE id='$id'";
        $this->db->update($query);
    }
}
?>