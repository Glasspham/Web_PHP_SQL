<?php 
	include_once 'inc/header.php'; 
	include_once 'inc/sidebar.php';
	if(isset($_GET['shiftid'])) {
        $id = $_GET['shiftid'];
		$shifted = $placed->shifted($id);
		echo "<meta http-equiv='refresh' content='0;URL=?'>";
    }
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">
			<?php 
				if(isset($shifted)) echo $shifted;
				if(isset($delShifted)) echo $delShifted;
			?>    
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Date</th>
						<th>Order Code</th>
						<th>Customer Name</th>
						<th>View</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$getPlaced = $placed->getInboxCart();
						if($getPlaced) {
							$i=0;
							while($result = $getPlaced->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i ?></td>
						<td><?php echo $fm->formatDate($result['date_created']) ?></td>
						<td><?php echo $result['order_code'] ?></td>
						<td><?php echo $result['name'] ?></td>
						<td><a href="customer.php?customerId=<?php echo $result['customerId']?>&order_code=<?php echo $result['order_code']?>">View Order</a></td>
						<td>
							<?php 
								if($result['status'] == 0) echo '<a href="?shiftid='.$result['placedId'].'">Pending</a>';
								elseif($result['status'] == 1) echo '<strong>Shifting...</strong>';
							?>
						</td>
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
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
