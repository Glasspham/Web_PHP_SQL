<?php 
	include("inc/header.php");
    $loginCheck = Session::get('customer_login');
    if(!$loginCheck) {
        echo "<script>window.location = 'login.php'</script>";
        exit();
    }
    if(isset($_GET['confirmId'])) {
        $id = $_GET['confirmId'];
		$placed->confirmShifted($id);
    }
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
                    <?php 
                        if(isset($confirmShifted)) echo 
                        "<div id='modal' class='box-confirm'>
                            <div class='box-confirm-content'>
                                <span class='box-confirm-close'>&times;</span>
                                <span>
                                    $confirmShifted
                                    <br>
                                    Thank you for choosing to purchase our products!
                                </span>
                                <br>
                                <button id='closeBtn'>OK</button>
                            </div>
                        </div>";
                    ?>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="10%">No.</th>
                                <th width="30%">Date</th>
                                <th width="15%">Order Code</th>
                                <th width="15%">Detail Order</th>
                                <th width="15%">Status</th>
                                <th width="15%">Action</th>
                            </tr>
                            <?php
                                $id = Session::get("customer_id");
                                $getPlaced = $placed->checkPlaced($id);
                                if($getPlaced) {
                                    $i=0;
                                    // print_r($getPlaced->fetch_assoc());
                                    while($result = $getPlaced->fetch_assoc()) {
                                        $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $fm->formatDate($result['date_created']) ?></td>
                                <td><?php echo $result['order_code'] ?></td>
                                <td><a href="orderdetail.php?ordercode=<?php echo $result['order_code'] ?>">Views</a></td>
                                <?php 
                                    if($result['status'] == 0) echo '<td>Pending</td><td>N/A</td>';
                                    elseif($result['status'] == 1) echo '<td>Shifting...</td><td><a href="?confirmId='.$result['placedId'].'">Confirm</a></td>';
                                    else echo '<td>Confirmed</td><td>Received</td>';
                                ?>
                            </tr>
                            <?php 
                                    }
                                }
                            ?>
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