<?php 
	include_once "inc/header.php";
    if(!isset($_GET['blogId']) || $_GET['blogId'] == NULL)
        echo '<script>window.location = "error404.php"</script>';
    else $id = $_GET['blogId'];
?>
<div class="main">
    <div class="content">
        <?php 
            $showBlog = $blog->getBlogById($id);
            if($showBlog) {
                $result = $showBlog->fetch_assoc();
        ?>
        <div class="content_top">
            <div class="heading">
                <h3><?php echo $result['title']?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="col-md-12">
                <p><?php echo $result['content']?></p>
            </div>
        </div>
        <?php 
            }
        ?>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>