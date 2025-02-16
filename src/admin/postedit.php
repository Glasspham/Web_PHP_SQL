<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    if(!isset($_GET['postId']) || $_GET['postId'] == NULL) {
        echo "<script>window.location = 'postlist.php'</script>";
    } else {
        $id = $_GET['postId'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$updatetPost = $post->updatePost($_POST, $_FILES, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>
        <div class="block"> 
            <?php 
                if(isset($updatetPost)) {
                    echo $updatetPost;
                }
                $getPost = $post->getPostById($id);
                if($getPost){
                    $result = $getPost->fetch_assoc();
            ?>
            <form autocomplete="off" action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title News</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result['title']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="description" style="width:400px; height:250px; resize:none"><?php echo $result['description']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Status News</label>
                        </td>
                        <td>
                            <select id="select" name="status">
                                <?php 
                                    if($result['status'])
                                        echo '<option value="0">Off</option><option selected value="1">On</option>';
                                    else echo '<option selected value="0">Off</option><option value="1">On</option>';
                                ?>  
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
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
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php';?>