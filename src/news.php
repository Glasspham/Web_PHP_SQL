<?php 
	include_once "inc/header.php";
    if(!isset($_GET['newsId']) || $_GET['newsId'] == NULL)
        echo '<script>window.location = "error404.php"</script>';
    else $id = $_GET['newsId'];
?>
<div class="main">
    <div class="content">
        <?php 
            $showCategoryPost = $post->getCategoryPost($id);
            if($showCategoryPost) {
                while($result = $showCategoryPost->fetch_assoc()) {
        ?>
        <div class="content_top">
            <div class="heading">
                <h3><?php echo $result['catTitle']?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="grid_1_of_4 images_1_of_4">
                <a href="preview-3.php"><img src="uploads/product/blog/<?php echo $result['image']?>" alt="" /></a>
                <h2><?php echo $result['title']?></h2>
                <p><?php echo $result['description']?></p>
                <div class="button">
                    <span><a href="newsdetails.php?blogId=<?php echo $result['id']?>" class="details">Details</a></span>
                </div>
            </div>
        </div>
        <?php 
                }
            } else {
                echo 'There is currently no news in this category!';
            }
        ?>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>