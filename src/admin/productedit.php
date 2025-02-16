<?php 
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location = 'productlist.php'</script>";
    } else {
        $id = $_GET['productId'];
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$updateProduct = $product->updateProduct($_POST, $_FILES, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product Repair</h2>
        <div class="block">         
            <?php
                if(isset($updateProduct)) {
                    echo $updateProduct;
                }
                $getProductById = $product->getProductById($id);
                if(isset($getProductById)) {
                    $res = $getProductById->fetch_assoc()
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $res['productName'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>---Select Category---</option>
                                <?php 
                                    $catList = $cat->showCategory();
                                    if($catList) {
                                        while($result = $catList->fetch_assoc()) {
                                ?>
                                    <option <?php if($result['catId'] == $res['catId']) echo'selected';?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName']?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>---Select Brand---</option>
                                <?php 
                                    $brandList = $brand->showBrand();
                                    if($brandList) {
                                        while($result = $brandList->fetch_assoc()) {
                                ?>
                                <option <?php if($result['brandId'] == $res['brandId']) echo'selected';?> value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
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
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $res['price'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="../uploads/product/<?php echo $res['image'] ?>" width="120px">
                            <br>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Quantity</label>
                        </td>
                        <td>
                            <input type="number" name="quantity" min="1" value="<?php echo $res['quantity']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php 
                                    if($res['type']) 
                                        echo '<option selected value="1">Featured</option>
                                            <option value="0">Non-Featured</option>';
                                    else echo '<option value="1">Featured</option>
                                            <option selected value="0">Non-Featured</option>';
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


