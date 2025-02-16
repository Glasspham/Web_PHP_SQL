<?php 
	include("inc/header.php");
    $loginCheck = Session::get('customer_login');
    if(!$loginCheck) header('Location: login.php');
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Ordered Item Details</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
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
                                    $order_code = $_GET['order_code'];
                                    $showOrder = $hst->getDetailOrder($order_code);
                                    if ($showOrder) {
                                        $totalPrice=0;
                                        $i=0;
                                        while($result = $showOrder->fetch_assoc()) {
                                            $i++;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i?></th>
                                    <td><?php echo $result['productName']?></td>
                                    <td><img src="admin/uploads/<?php echo $result['image']?>" alt="" width="70px"></td>
                                    <td><?php echo $result['quantity']?></td>
                                    <td>$<?php $totalPrice += $result['totalPrice']; echo $result['totalPrice']?></td>
                                </tr>
                                <?php 
                                        }
                                    }
                                    echo '<tr><td colspan="5" >Total amount: $'.$totalPrice * (1 + 0.1).'</td></tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>