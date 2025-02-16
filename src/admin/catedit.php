<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location = 'catlist.php'</script>";
    } else {
        $id = $_GET['catId'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName'];
		$updatetCat = $cat->updateCategory($catName, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock"> 
            <?php 
                if(isset($updatetCat)) {
                    echo $updatetCat;
                }
                $getCatName = $cat->getCatById($id);
                if($getCatName){
                    $result = $getCatName->fetch_assoc();
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td><input type="text" value="<?php echo $result['catName'] ?>" name="catName" placeholder="Enter Category New Name..." class="medium" /></td>
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