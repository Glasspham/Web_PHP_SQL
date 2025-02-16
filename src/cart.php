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
    .tblone td {
        vertical-align: middle; /* Căn giữa nội dung trong từng ô */
    }

    .tblone td img {
        width: 100px;
        max-width: 100px; /* Giới hạn kích thước ảnh nếu quá lớn */
        height: auto;
    }

    .tblone td input[type="number"] {
        width: 60px; /* Điều chỉnh kích thước input number */
        text-align: center;
    }

    .tblone td form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tblone td input[type="checkbox"] {
        transform: scale(1.2); /* Làm checkbox lớn hơn nếu quá nhỏ */
    }

</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php 
                    if(isset($updateQuantityCart)) {
                        echo "<div id='modal' class='box-confirm'>
                                <div class='box-confirm-content'>
                                    <span>$updateQuantityCart</span>
                                    <br>
                                    <button id='closeBtn'>OK</button>
                                </div>
                            </div>";
                    }
                    if(isset($delCart)) {
                        echo "<div id='modal' class='box-confirm'>
                                <div class='box-confirm-content'>
                                    <span>$delCart</span>
                                    <br>
                                    <button id='closeBtn'>OK</button>
                                </div>
                            </div>";
                    }
                    $checkCart = $cart->getCarts();
                    if(!$checkCart) {
                        echo "<span><strong>Your cart is Empty! Please shopping now!</strong></span>";
                    } else {
                ?>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="10%">Total Price</th>
                        <th width="10%">Buy</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                        $getCarts = $cart->getCarts();
                        $costVat = 0;
                        if ($getCarts) {
                            while ($result = $getCarts->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
                        <td>$<?php echo $fm->format_currency($result['price']) ?></td>
                        <td>
                            <form action="" method="post" style="display: flex; flex-direction: column; align-items: center;">
                                <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
                                <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                        </td>
                        <td>$<?php 
                                $total = $result['price'] * $result['quantity'];
                                echo $fm->format_currency($total);
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <input type="checkbox" <?php echo ($result['buy']) ? 'checked' : '' ?> class="buy_checked" value="<?php echo $result['cartId']?>">
                        </td>
                        <td><a onclick="return confirm('Are you want to delete')" href="?delId=<?php echo $result['cartId']?>">X</a></td>
                    </tr>
                    <?php 
                            }
                        }
                    ?>
                </table>
                <?php 
                    }
                ?> 
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
    $('.buy_checked').change(function() {
        let id_cart = $(this).val();
        // alert(id_cart);
        if($(this).is(':checked')) {
            let cart_status = 1;
            $.ajax({
                url: 'ajax/stickbuy.php',
                data: {
                    id_cart: id_cart,
                    cart_status:cart_status
                },
                type: 'post',
            })
        } else {
            let cart_status = 0;
            $.ajax({
                url: 'ajax/stickbuy.php',
                data: {
                    id_cart: id_cart,
                    cart_status:cart_status
                },
                type: 'post',
            })
        }
    })
</script>
<?php 
	include("inc/footer.php");
?>