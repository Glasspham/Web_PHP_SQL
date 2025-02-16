<?php 
	include("inc/header.php");
    /* if(isset($_GET['orderId']) || $_GET['orderId'] == 'order') {
        $customerId = Session::get('customer_id');
        $cart->insertOrder($customerId);
        $delCart = $cart->deleteAllCart();
        header('Location:notify.php');
    } */
?>
<style>
    .main {
        border: 3px solid red;
    }
    h2.success_order {
        text-align: center;
        color: red;
    }
    p.note{
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
</style>
<form action="" method="">
    <div class="main">
        <div class="content">
            <div class="section group">
                <?php 
                    $total=0;
                    $customerId = Session::get('customer_id');
                    $getAmount = $order->getAmountPrice($customerId);
                    if($getAmount) {
                        while($result = $getAmount->fetch_assoc()) {
                            $total += $result['price'];    
                        }
                    }
                ?>
                <h2 class="success_order">Success Order</h2>
                <p class="note">Total Price You Have Bought From My Website: $<?php echo $fm->format_currency($total * 0.1 + $total)?></p>
                <p class="note">We will contract as soon as possible. Please see your order deta here <a href="order.php">Click here</a></p>
            </div>
        </div>
    </div>
</form>
<?php 
	include("inc/footer.php");
?>