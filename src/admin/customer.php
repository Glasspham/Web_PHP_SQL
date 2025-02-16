<?php
include 'inc/header.php';
include 'inc/sidebar.php';
if (!isset($_GET['customerId']) || $_GET['customerId'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['customerId'];
    $order_code = $_GET['order_code'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer</h2>
        <div class="block copyblock">
            <?php
                $getCustomer = $cus->showCustomer($id);
                if ($getCustomer) {
                    $result = $getCustomer->fetch_assoc();
            ?>
            <form action="" method="POST">
                <h1>Customer Information</h1>
                <table class="form">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="name"
                                class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="phone"
                                class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="email"
                                class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['country'] ?>"
                                name="country" class="medium" /></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" name="city"
                                class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['address'] ?>"
                                name="address" class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Zip-code</td>
                        <td>:</td>
                        <td><input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>"
                                name="zipcode" class="medium" /></td>
                    </tr>
                </table>
            </form>
            <?php
                }
            ?>
        </div>
        <hr>
        <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Procduct Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $showOrder = $cus->showOrder($order_code);
                        if ($showOrder) {
                            $totalPrice=0;
                            $i=0;
                            while($result = $showOrder->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i?></th>
                        <td><?php echo $result['productName']?></td>
                        <td><img src="../uploads/product/<?php echo $result['image']?>" alt="" width="70px"></td>
                        <td><?php echo $result['quantity']?></td>
                        <td>$<?php $totalPrice += $result['price']; echo $result['price']?></td>
                    </tr>
                    <?php 
                            }
                        }
                        echo '
                            <tr><td colspan="5" >Total amount: $'.$totalPrice.'</td></tr>
                            <tr><td colspan="5" >Price includes VAT: $'.$totalPrice * (1 + 0.1).'</td></tr>
                        ';
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>