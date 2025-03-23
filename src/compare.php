<?php 
	include("inc/header.php");
    if(isset($_GET['delId'])) {
        $id = $_GET['delId'];
		$delcmp = $cmp->deleteCompare($id);
    }
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Compare Product</h2>
                <?php 
                    if(isset($delcmp)) echo $delcmp;
                ?>
                <table class="tblone">
                    <tr>
                        <th width="10%">Id Compare</th>
                        <th width="30%">Product Name</th>
                        <th width="30%">Image</th>
                        <th width="20%">Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                        $customer_id = Session::get("customer_id");
                        $getCompare = $cmp->showCompare($customer_id);
                        if($getCompare) {
                            $i=0;
                            while($result = $getCompare->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="uploads/product/<?php echo $result['image'] ?>" alt="" /></td>
                        <td><?php echo $fm->format_currency($result['price']) ?></td>
                        <td><a href="details.php?productId=<?php echo $result['productId']?>">View</a> | <a href="?delId=<?php echo $result['id']?>">X</a></td>
                    </tr>
                    <?php 
                            }
                        }
                    ?>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>