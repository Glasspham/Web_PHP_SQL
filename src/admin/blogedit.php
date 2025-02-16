<?php 
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
    if(!isset($_GET['blogId']) || $_GET['blogId'] == NULL) {
        echo "<script>window.location = 'bloglist.php'</script>";
    } else {
        $id = $_GET['blogId'];
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$updateBlog = $blog->updateBlog($_POST, $_FILES, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Blog Repair</h2>
        <div class="block">         
            <?php
                if(isset($updateBlog)) {
                    echo $updateBlog;
                }
                $getBlogById = $blog->getBlogById($id);
                if(isset($getBlogById)) {
                    $res = $getBlogById->fetch_assoc();
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $res['title'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category Post</label>
                        </td>
                        <td>
                            <select id="select" name="category_post">
                                <option>---Select---</option>
                                <?php 
                                    $postList = $post->showPost();
                                    if($postList) {
                                        while($result = $postList->fetch_assoc()) {
                                ?>
                                    <option <?php if($result['catpostId'] == $res['category_post']) echo'selected';?> value="<?php echo $result['catpostId'] ?>"><?php echo $result['title']?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="description" class="tinymce"><?php echo $res['description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                        <textarea name="content" class="tinymce"><?php echo $res['content'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="uploads/blog/<?php echo $res['image'] ?>" width="120px">
                            <br>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Status</label>
                        </td>
                        <td>
                            <select id="select" name="status">
                                <option>Select Type</option>
                                <?php 
                                    if($res['status']) 
                                        echo '<option selected value="1">On</option>
                                            <option value="0">Off</option>';
                                    else echo '<option value="1">On</option>
                                            <option selected value="0">Off</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="update" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>