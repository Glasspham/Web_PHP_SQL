<?php 
	include_once 'inc/header.php';
	include_once 'inc/sidebar.php';
	if(isset($_GET['delId'])) {
		$delPost = $post->deletePost($_GET['delId']);
    }
	if(isset($_GET['statusId'])) {
		$post->changeStatus($_GET['statusId'], $_GET['type']);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php
                if(isset($delPost)) {
                    echo $delPost;
                }
            ?>      
			<table class="data display datatable tblone" id="example">
				<thead>
					<tr>
						<th width="5%">No.</th>
						<th width="25%">Title</th>
						<th width="50%">Description</th>
						<th width="10%">Status</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$showPost = $post->showPost();
						if($showPost) {
							$i = 0;
							while($result = $showPost->fetch_assoc()) {
								$i++;
						
					?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['title'] ?></td>
						<td><?php echo $fm->textShorten($result['description'], 1000) ?></td>
						<td>
						<?php 
							if($result['status']) {
								echo '
									<a href="?statusId='.$result['id'].'&type=1" style="color:red">On</a>
									| 
									<a href="?statusId='.$result['id'].'&type=0">Off</a>
								';
							} else {
								echo '
									<a href="?statusId='.$result['id'].'&type=1">On</a> 
									| 
									<a href="?statusId='.$result['id'].'&type=0" style="color:red">Off</a>
								';
							}
						?>
						</td>
						<td><a href="postedit.php?postId=<?php echo $result['id'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete')" href="?delId=<?php echo $result['id'] ?>">Delete</a></td>
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