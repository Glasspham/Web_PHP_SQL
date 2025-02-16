<?php 
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$insertSlider = $slider->insertSilder($_POST, $_FILES);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
        <?php 
            if(isset($insertSlider)) echo $insertSlider;
        ?>
    <div class="block">             
        <form action="slideradd.php" method="POST" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option value="0">Off</option>
                            <option value="1">On</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Save" />
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