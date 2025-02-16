<?php 
	include_once "inc/header.php";
	include_once "inc/slider.php";
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
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group" id="featured-products"></div>
		<div class="page">
			<?php
				$productAll = $product->getAllProductFeatured();
				$productCount = mysqli_num_rows($productAll);
				$productBotton = ceil($productCount / 4);
				for($i = 1; $i <= $productBotton; $i++) {
					if($i == 1) 
						echo '<a style="margin:0 5px; cursor:pointer;" class="selected pagination-link-feature" data-page_feature="'.$i.'">'.$i.'</a>';
					else echo '<a style="margin:0 5px; cursor:pointer;" class=" pagination-link-feature" data-page_feature="'.$i.'">'.$i.'</a>';
				}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group" id="new-products"></div>
		<div class="page">
			<?php
				$productAll = $product->getProductAll();
				$productCount = mysqli_num_rows($productAll);
				$productBotton = ceil($productCount / 4);
				for($i = 1; $i <= $productBotton; $i++) {
					if($i == 1)
						echo '<a style="margin:0 5px; cursor:pointer;" class="selected pagination-link" data-page="'.$i.'">'.$i.'</a>';
					else echo '<a style="margin:0 5px; cursor:pointer;" class="pagination-link" data-page="'.$i.'">'.$i.'</a>';
				}
			?>
		</div>
	</div>
</div>
<?php 
	include("inc/footer.php");
?>