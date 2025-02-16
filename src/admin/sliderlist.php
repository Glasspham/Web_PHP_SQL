<?php 
	include_once 'inc/header.php';
	include_once 'inc/sidebar.php';
	if(isset($_GET['typeId'])) {
		$slider->changeSlider($_GET['typeId'], $_GET['type']);
	}
	if(isset($_GET['delId'])) {
		$delSlider = $slider->deleteSlider($_GET['delId']);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getSlider = $slider->showSlider();
					if($getSlider) {
						$i=0;
						while($result = $getSlider->fetch_assoc()) {
							// print_r($result);
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['sliderName']?></td>
					<td><img src="../uploads/slider/<?php echo $result['image']?>" height="80px" width="250px"/></td>				
					<td>
						<?php 
							if($result['type']) {
								echo '
									<a href="?typeId='.$result['sliderId'].'&type=1" style="color:red">On</a>
									| 
									<a href="?typeId='.$result['sliderId'].'&type=0">Off</a>
								';
							} else {
								echo '
									<a href="?typeId='.$result['sliderId'].'&type=1">On</a> 
									| 
									<a href="?typeId='.$result['sliderId'].'&type=0" style="color:red">Off</a>
								';
							}
						?>
					</td>
					<td><a onclick="return confirm('Are you sure to Delete!');" href="?delId=<?php echo $result['sliderId']?>" >Delete</a></td>
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
