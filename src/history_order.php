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
                    <h3>Order History</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <table class="table table-striped table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No.</th>
								<th>Date</th>
								<th>Order Code</th>
								<th>View</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                                $getHistoryBuy = $hst->getHistoryGroupOrderCode(Session::get('customer_id'));
								if($getHistoryBuy) {
									$i=0;
									/* $jsonResults = []; */
									while($result = $getHistoryBuy->fetch_assoc()) {
										$i++;
										/* $jsonResults[] = $result; */
							?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $fm->formatDate($result['date_received']) ?></td>
								<td><?php echo $result['order_code'] ?></td>
								<td><a href="history_order_detail.php?order_code=<?php echo $result['order_code']?>">View Order</a></td>
								<td>Success</td>
							</tr>
							<?php 
									}
								}
							?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>