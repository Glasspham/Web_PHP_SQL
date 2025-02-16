<?php 
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$insertBlog = $blog->insertBlog($_POST, $_FILES);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New blog</h2>
        <div class="block">         
            <?php
                if(isset($insertBlog)) {
                    echo $insertBlog;
                }
            ?>     
            <form action="blogadd.php" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" class="medium" />
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
                                    $postlist = $post->showPost();
                                    if($postlist) {
                                        while($result = $postlist->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $result['catpostId'] ?>">
                                    <?php echo $result['title']?>
                                </option>
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
                            <textarea name="description" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea name="content" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Status</label>
                        </td>
                        <td>
                            <select id="select" name="status">
                                <option value="0">Off</option>
                                <option value="1">On</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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