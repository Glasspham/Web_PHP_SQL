<?php 
	include("inc/header.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
		$updateQuantityCart = $cart->updateQuantityCart($cartId, $quantity);
        if($quantity <= 0) $delCart = $cart->deleteCart($cartId);
	}
    if(isset($_GET['delId'])) {
        $delId = $_GET['delId'];
		$delCart = $cart->deleteCart($delId);
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
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <div class="heading">
                    <h2>Payment Online</h2>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
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
                                <td>$<?php
                                    $grandTotal = $costVat + $subTotal;
                                    echo $fm->format_currency($grandTotal)?>
                                </td>
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
                    <div class="clear"></div>
                    <hr>
                    <table class="tblone">
                        <tr>
                            <td>
                                <form action="gatewayvnpay.php" method="POST">
                                    <input type="hidden" name="grandtotal" value="<?php echo $grandTotal?>">
                                    <button class="btn btn-success" name="redirect" id="redirect">Payment</button>
                                </form>
                            </td>
                            <td>
                                <form action="gatewaymomo.php" method="POST">
                                    <input type="hidden" name="grandtotal" value="<?php echo $grandTotal?>">
                                    <button class="btn btn-success" name="captureWallet" >MOMO QR</button>
                                </form>
                            </td>
                            <td>
                                <form action="gatewaymomo.php" method="POST">
                                    <input type="hidden" name="grandtotal" value="<?php echo $grandTotal?>">
                                    <button class="btn btn-success" name="payWithATM" >MOMO ATM</button>
                                </form>
                            </td>
                            <td>
                                <form action="gatewayonepay.php" method="POST">
                                    <input type="hidden" name="grandtotal" value="<?php echo $grandTotal?>">
                                    <button class="btn btn-success" name="onepay" >OnePay</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>