<?php 
	include("inc/header.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $key = $_POST["key"];
        $search = $product->searching($key);
    }
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Searching: <?php echo $key ?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php 
                if($search) {
                    while($result = $search->fetch_assoc()) {
            ?>
            <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0">
                <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
                <h2><?php echo $result['productName']?></h2>
                <p><span class="price">$<?php echo $fm->format_currency($result['price']) ?></span></p>
                <div class="button">
                    <span><a href="details.php?productId=<?php echo $result['productId']?>" class="details">Details</a></span>
                </div>
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