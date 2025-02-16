<?php 
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$insertPost = $post->insertPost($_POST['title'],  $_POST['description'], $_POST['status']);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add News</h2>
        <div class="block"> 
            <?php 
                if(isset($insertPost)) {
                    echo $insertPost;
                }
            ?>
            <form autocomplete="off" action="postadd.php" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title News</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Title News..." class="medium" />
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
                        <td>
                            <label>Status News</label>
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