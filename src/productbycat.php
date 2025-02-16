<?php 
	include("inc/header.php");
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = '404.php'</script>";
    } else {
        $id = $_GET['catid'];
        $catName = $_GET['catName'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addToCart'])) {
        $stock = $_POST['stock'];
		$productId = $_POST['productId'];
		$addtocart = $cart->addToCart($stock, 1, $productId);
        echo "<script>window.location = 'cart.php'</script>";
	}
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Category: <?php echo $catName ?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php 
                $productByCat = $cat->getProductByCat($id);
                if($productByCat) {
                    while($result = $productByCat->fetch_assoc()) {
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?productId=<?php echo $result['productId']?>"><img class="img-product" src="uploads/product/<?php echo $result['image']?>" alt="" /></a>
                <h2><?php echo $result['productName']?></h2>
                <p><span class="price">$<?php echo $fm->format_currency($result['price']) ?></span></p>
                <?php 
					if($result['quantity'] > 0) {
				?>
				<form action="" method="POST">
					<input type="hidden" value="<?php echo $result['productId']?>" name="productId" >
					<input type="hidden" value="<?php echo $result['quantity']?>" name="stock" >
					<input type="submit" value="Add To Cart" class="btn btn-success" name="addToCart" style="margin:10px;">
				</form>
				<?php 
					} else {
						echo '<span class="error btn">Out of stock</span>';
					}
				?>
            </div>
            <?php 
                    }
                } else {
            ?>
            <h3 style="font-weight: bold; font-size: 40px; text-align: center;">Category Not Available</h3>
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>