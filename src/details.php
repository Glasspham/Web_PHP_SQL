<?php 
	include("inc/header.php");
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL)
        echo "<script>window.location = 'error404.php'</script>";
    else $productId = $_GET['productId'];
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
        $stock = $_POST['stock'];
        $quantity = $_POST['quantity'];
		$addtocart = $cart->addToCart($stock, $quantity, $productId);
	}
    $customer_id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
        $productId = $_POST['productid'];
		$insertCompare = $cmp->insertCompare($productId, $customer_id);
	}
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist'])) {
        $productId = $_POST['productid'];
		$insertwishlist = $wl->insertWishlist($productId, $customer_id);
	}
    if(isset($_POST['comment'])) {
        $insertComment = $cus->insertComment();
    }
?>
<style>
    .img-product {
        width: 100% !important;
        height: 340px !important;
		object-fit: scale-down !important;
		border-radius: 5px !important;
	}
</style>
<div class="main">
    <div class="content">
        <!-- Details Product -->
        <div class="section group">
            <?php 
                $getProduct = $product->getProductById($productId);
                if($getProduct) {
                    $result = $getProduct->fetch_assoc();
            ?>
            <div class="cont-desc span_1_of_2">
                <div class="grid images_3_of_2">
                    <img class="img-product" src="uploads/product/<?php echo $result['image']?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $result['productName']?></h2>
                    <p><?php echo $fm->textShorten($result['description'], 50)?></p>
                    <div class="price">
                        <p>Price: <span><?php echo $fm->format_currency($result['price'])?></span></p>
                        <p>Category: <span><?php echo $result['catName']?></span></p>
                        <p>Brand: <span><?php echo $result['brandName']?></span></p>
                        <p>Stock: <span><?php echo $result['quantity']?></span></p>
                        <ul style="margin: 0 0 25px" >
                            <?php 
                                $getRating = $rat->getRating($productId);
                                $avgRating = 0;
                                if($getRating) {
                                    $rowCount = $getRating->num_rows;
                                    $totalRating = 0;
                                    while($rating = $getRating->fetch_assoc()) 
                                        $totalRating += $rating['rating'];
                                    $avgRating = round($totalRating / $rowCount,2);
                                }
                                for($count = 1; $count <= 5; $count++) {
                                    if($count <= $avgRating) echo '<li class="rating" style="color:yellow; font-size:30px;">&#9733</li>';
                                    else echo  '<li class="rating" style="color:#ccc; font-size:30px;">&#9733</li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="add-cart">
                        <form action="" method="post">
                            <?php 
                                if($result['quantity'] > 0)
                                    echo '
                                        <input type="hidden" class="buyfield" name="stock" value="'.$result['quantity'].'"/>
                                        <input type="number" class="buyfield" name="quantity" value="1" min="1"/>
                                        <input type="submit" class="buysubmit" name="buy" value="Add To Cart" />
                                    ';
                                else echo'<span class="error">Out of stock</span>';
                            ?>
                        </form>
                    </div>
                    <div class="add-cart">
                        <form action="" method="POST">
                            <input type="hidden" name="productid" value="<?php echo $result['productId'] ?>"/>
                            <?php 
                                $loginCheck = Session::get('customer_login');
                                if($loginCheck) {
                                    echo '
                                        <input type="submit" class="buysubmit" name="compare" value="Compare Product"/>
                                        <input type="submit" class="buysubmit" name="wishlist" value="Favourite"/>
                                    ';
                                }
                                if(isset($insertCompare)) echo '<p>'.$insertCompare.'</p>';
                                if(isset($insertwishlist)) echo '<p>'.$insertwishlist.'</p>';   
                                if(isset($addtocart)) echo 
                                    "<div id='modal' class='box-confirm'>
                                        <div class='box-confirm-content'>
                                            <span>$addtocart</span>
                                            <br>
                                            <button id='closeBtn' data-variables='productId' data-values='$productId'>OK</button>
                                        </div>
                                    </div>";
                            ?>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="product-desc">
                    <h2>Product Details</h2>
                    <span><?php echo $result['description']?></span>
                </div>
                <ul>
                    <?php 
                        $getRating = $rat->getRating($productId);
                        $avgRating = 0;
                        if($getRating) {
                            $rowCount = $getRating->num_rows;
                            $totalRating = 0;
                            while($rating = $getRating->fetch_assoc()) 
                                $totalRating += $rating['rating'];
                            $avgRating = round($totalRating / $rowCount,2);
                        }
                        for($count = 1; $count <= 5; $count++) {
                            if($count <= $avgRating) $color = 'color:#ffcc00';
                            else $color = '#ccc';
                            if(Session::get('customer_id')) {
                    ?>
                    <li class="rating" 
                        style="cursor:pointer; <?php echo $color?>; font-size:30px;" 
                        id="<?php echo $result['productId'].'-'.$count?>" 
                        data-product_id="<?php echo $result['productId']?>"
                        data-rating="<?php echo $count?>"
                        data-index="<?php echo $count?>"
                        data-customer_id="<?php echo Session::get('customer_id')?>"
                    >&#9733</li>
                    <?php 
                            } else echo '<li class="rating_login" style="cursor:pointer; font-size:30px; color:#ccc; display:inline-block">&#9733</li>';
                        } 
                    ?>
                    <li><?php echo $avgRating?>/5 star</li>
                </ul>
            </div>
            <?php 
                }
            ?>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php 
                        $getAllCat = $cat->showCategory();
                        if($getAllCat) {
                            while($result = $getAllCat->fetch_assoc()) {
                    ?>
                    <li><a href="productbycat.php?catid=<?php echo $result['catId']; ?>&catName=<?php echo urlencode($result['catName']); ?>"><?php echo $result['catName']?></a></li>
                    <?php 
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Comment Product -->
        <form action="" method="POST">
            <div class="comment" style="width:67.1%; padding:1.5%;">
                <div class="product-desc">
                    <h2>Comments</h2>
                    <?php if(isset($insertComment)) echo $insertComment; ?>
                </div>
                <p><input type="hidden" name="productId" value="<?php echo $productId ?>"></p>
                <p><input type="text" class="form-control" name="username" placeholder="Username"></p>
                <p><textarea rows="6" style="resize:none" class="form-control" name="content" placeholder="Content"></textarea></p>
                <p style="float:right"><input type="submit" class="btn btn-success" name="comment" value="Comment"></p>
                <br><br>
                <hr>
                <div class="printcomment">
                    <div class="container">
                        <!-- Chưa làm -->
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="clear"></div>
</div>
<?php 
	include("inc/footer.php");
?>