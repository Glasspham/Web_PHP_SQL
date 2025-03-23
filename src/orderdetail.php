<?php 
	include("inc/header.php");
    $loginCheck = Session::get('customer_login');
    if(!$loginCheck) header('Location: login.php');
?>
<style>
    .box_left {
        width: 98%;
        border: 1px solid #666;
        padding: 10px;
    }
</style>
<form action="" method="">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Your Details Order</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="10%">Id</th>
                                <th width="25%">Product Name</th>
                                <th width="20%">Image</th>
                                <th width="20%">Price</th>
                                <th width="5%">Quantity</th>
                                <th width="20%">Date</th>
                            </tr>
                            <?php
                                $id = Session::get("customer_id");
                                if(!isset($_GET['ordercode']) || $_GET['ordercode'] == NULL)
                                    echo "<script>window.location = 'error404.php'</script>";
                                else $ordercode = $_GET['ordercode'];
                                $getOrder = $order->showOrder($id, $ordercode);
                                $subTotal=0;
                                if($getOrder) {
                                    $i=0;
                                    while($result = $getOrder->fetch_assoc()) {
                                        $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td> <img src="uploads/product/<?php echo $result['image'] ?>" style="width:30%; height:30%;" alt=""></td>
                                <td>$<?php $subTotal += $result['price']; echo $fm->format_currency($result['price']); ?></td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td><?php echo $fm->formatDate($result['date']) ?></td>
                            </tr>
                            <?php 
                                    }
                                }
                            ?>
                        </table>
                        <hr>
                        <table style="float: right; text-align: left" width="40%">
                            <tr>
                                <th>Sub Total:</th>
                                <td>$<?php echo $fm->format_currency($subTotal); ?></td>
                            </tr>
                            <tr>
                                <th>VAT 10%:</th>
                                <td>$<?php $costVat = $subTotal * 0.1; echo $fm->format_currency($costVat); ?></td>
                            </tr>
                            <tr>
                                <th>Grand Total:</th>
                                <td>$<?php echo $fm->format_currency($costVat + $subTotal)?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php 
	include("inc/footer.php");
?>