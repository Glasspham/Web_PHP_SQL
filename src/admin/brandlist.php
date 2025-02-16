<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	if(isset($_GET['delId'])) {
        $id = $_GET['delId'];
		$delBrand = $brand->deleteBrand($id);
    }
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Brand List</h2>
		<div class="block">
			<?php
                if(isset($delBrand)) {
                    echo $delBrand;
                }
            ?>      
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$showBrand = $brand->showBrand();
						if ($showBrand) {
							$i = 0;
							while($result = $showBrand->fetch_assoc()) {
								$i++;	
					?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['brandName'] ?></td>
						<td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete')" href="?delId=<?php echo $result['brandId'] ?>">Delete</a></td>
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