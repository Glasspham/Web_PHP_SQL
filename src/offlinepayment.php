<?php 
ob_start();
	include("inc/header.php");
    if(isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
        $customerId = Session::get('customer_id');
        $order->insertOrder($customerId);
        $delCart = $cart->deletePurchasedProducts();
        header('Location:notify.php');
        exit();
    }
?>
<style>
    .box_left {
        float: left;
        width: 50%;
        border: 1px solid #666;
        padding: 10px;
    }
    .box_right {
        float: right;
        width: 44%;
        border: 1px solid #666;
        padding: 10px;
    }
    .buttoms {
        float: right;
        padding: 10px;
    }
    .submitorder {
        padding: 10px 30px;
        border-radius: 5px; 
        background: orange; 
        color: aqua;
        cursor: pointer;
    }
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Offline Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <?php 
                            if(isset($updateQuantityCart))echo $updateQuantityCart;
                            if(isset($delCart)) echo $delCart;
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="10%">Id</th>
                                <th width="35%">Product Name</th>
                                <th width="20%">Price</th>
                                <th width="15%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <?php
                                $getCarts = $cart->getCarts();
                                $subTotal=0;
                                $costVat=0;
                                $totalQuantity=0;
                                if($getCarts) {
                                    $i=0;
                                    while($result = $getCarts->fetch_assoc()) {
                                        if($result['buy']) {
                                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td>$<?php echo $fm->format_currency($result['price']) ?></td>
                                <td><?php $totalQuantity += $result['quantity']; echo $result['quantity'] ?></td>
                                <td>$<?php 
                                        $total = $result['price'] * $result['quantity'];
                                        $subTotal += $total;
                                        echo $fm->format_currency($total);
                                    ?>
                                </td>
                            </tr>
                            <?php 
                                        }
                                    }
                                }
                            ?>
                        </table>
                        <?php 
                            if($subTotal == 0) 
                            echo "Your cart is Empty! Please shopping now!";
                        ?>
                        <hr>
                        <table style="float: right; text-align: left" width="40%">
                            <tr>
                                <th>Sub Total:</th>
                                <td>$<?php echo $fm->format_currency($subTotal); ?>
                                </td>
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
                <div class="box_right">
                    <table class="tblone">
                        <?php 
                            $id = Session::get('customer_id');
                            $getCustomer = $cus->showCustomer($id);
                            if($getCustomer) {
                                $result = $getCustomer->fetch_assoc();
                        ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['country'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Zip-code</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['zipcode'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td style="float:left"><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Edit Profile</a></td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </table>
                    <?php 
                        $checkCart = $cart->getCarts();
                        if($checkCart) echo ' 
                            <hr>
                            <div class="buttoms">
                                <a class="submitorder" href="?orderId=order" >Order</a>
                            </div>
                        ';
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
<?php 
	include("inc/footer.php");
?>