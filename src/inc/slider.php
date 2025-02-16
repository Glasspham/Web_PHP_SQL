<?php 
    $nameBrand1="dell";
    $nameBrand2="samsung";
    $nameBrand3="gucci";
    $nameBrand4="apple";
?>
<style>
    .img-product {
		width: 160px; 
		height: 160px;
        object-fit: scale-down;
		border-radius: 5px;
	}
</style>
<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
                $brandName = $brand->getBrandByName($nameBrand1);
                $id = $brandName->fetch_assoc()['brandId'];
                $getLastes = $product->getProductByBrandId($id);
                if(isset($getLastes)) {
                    $result = $getLastes->fetch_assoc();
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $result['productId']?>"><img class="img-product" src="uploads/product/<?php echo $result['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $fm->textShorten($result['productName'], 12)?></h2>
                    <p><?php echo $fm->textShorten($result['description'], 50) ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $result['productId']?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php 
                }
                $brandName = $brand->getBrandByName($nameBrand2);
                $id = $brandName->fetch_assoc()['brandId'];
                $getLastes = $product->getProductByBrandId($id);
                if(isset($getLastes)) {
                    $result = $getLastes->fetch_assoc();
            ?>		
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $result['productId']?>"><img class="img-product" src="uploads/product/<?php echo $result['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $fm->textShorten($result['productName'], 12)?></h2>
                    <p><?php echo $fm->textShorten($result['description'], 50) ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $result['productId']?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="section group">
            <?php
                $brandName = $brand->getBrandByName($nameBrand3);
                $id = $brandName->fetch_assoc()['brandId'];
                $getLastes = $product->getProductByBrandId($id);
                if(isset($getLastes)) {
                    $result = $getLastes->fetch_assoc();
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $result['productId']?>"><img class="img-product" src="uploads/product/<?php echo $result['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $fm->textShorten($result['productName'], 12)?></h2>
                    <p><?php echo $fm->textShorten($result['description'], 50) ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $result['productId']?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php 
                }
                $brandName = $brand->getBrandByName($nameBrand4);
                $id = $brandName->fetch_assoc()['brandId'];
                $getLastes = $product->getProductByBrandId($id);
                if(isset($getLastes)) {
                    $result = $getLastes->fetch_assoc();
            ?>		
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $result['productId']?>"><img class="img-product" src="uploads/product/<?php echo $result['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $fm->textShorten($result['productName'], 12)?></h2>
                    <p><?php echo $fm->textShorten($result['description'], 50) ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $result['productId']?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <?php 
                        $getSlider = $slider->showSlider();
                        if(isset($getSlider)) {
                            while($result = $getSlider->fetch_assoc()) {
                                if($result['type']) {
                                    $sliderName = $result['sliderName'];
                                    $sliderAlt = str_replace(' ', '_', $sliderName);
                    ?>
                    <li><img src="uploads/slider/<?php echo $result['image'] ?>" alt="<?php echo htmlspecialchars($sliderAlt, ENT_QUOTES); ?>"/></li>
                    <?php 
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
        </section>
    </div>
    <div class="clear"></div>
</div>	