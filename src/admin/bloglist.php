<?php 
	include_once 'inc/header.php';
	include_once 'inc/sidebar.php';
	if(isset($_GET['delId'])) {
		$deleteBlog = $blog->deleteBlog($_GET['delId']);
	}
	if(isset($_GET['statusId'])) {
		$blog->changeStatus($_GET['statusId'], $_GET['type']);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">
			<?php 
				if(isset($deleteBlog)) echo $deleteBlog;
			?>
            <table class="data display datatable tblone" id="example">
				<thead>
					<tr>
						<th width="5%" style="text-align:center">Id</th>
						<th width="10%" style="text-align:center">Title</th>
						<th width="30%" style="text-align:center">Description</th>
						<th width="10%" style="text-align:center">Category Post</th>
						<th width="25%" style="text-align:center">Image</th>
						<th width="10%" style="text-align:center">Status</th>
						<th width="10%" style="text-align:center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$blogList = $blog->showBlog();
						if($blogList) {
							$i = 0;
							while($result = $blogList->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td style="text-align:center"><?php echo $i ?></td>
						<td><?php echo $result['title'] ?></td>
						<td><?php echo $format->textShorten($result['description'], 100) ?></td>
                        <td style="text-align:center"><?php echo $result['catTitle'] ?></td>
						<td style="text-align:center"><img class="img" src="../uploads/blog/<?php echo $result['image'] ?>" width="60px" alt=""></td>
						<td style="text-align:center">
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
						<td style="text-align:center"><a href="blogedit.php?blogId=<?php echo $result['id'] ?>">Edit</a> || <a href="?delId=<?php echo $result['id'] ?>">Delete</a></td>
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
