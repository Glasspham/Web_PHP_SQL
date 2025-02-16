<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    if(!isset($_GET['brandId']) || $_GET['brandId'] == NULL) {
        echo "<script>window.location = 'brandlist.php'</script>";
    } else {
        $id = $_GET['brandId'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$brandName = $_POST['brandName'];
		$updatetBrand = $brand->updateBrand($brandName, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Brand</h2>
        <div class="block copyblock"> 
            <?php 
                if(isset($updatetBrand)) {
                    echo $updatetBrand;
                }
                $getBrandName = $brand->getBrandById($id);
                if($getBrandName){
                    $result = $getBrandName->fetch_assoc();
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td><input type="text" value="<?php echo $result['brandName'] ?>" name="brandName" placeholder="Enter Brand New Name..." class="medium" /></td>
                    </tr>
                    <tr> 
                        <td><input type="submit" name="submit" Value="Update" /></td>
                    </tr>
                </table>
            </form>
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>