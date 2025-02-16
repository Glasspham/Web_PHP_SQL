<?php 
	include_once 'inc/header.php';
	include_once 'inc/sidebar.php';
	if(isset($_GET['delId'])) {
		$id = $_GET['delId'];
		$delProduct = $product->deleteProduct($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">
			<?php 
				if(isset($delProduct))
					echo $delProduct;
			?>
            <table class="data display datatable tblone" id="example">
				<thead>
					<tr>
						<th style="text-align:center" width="4%" >Id</th>
						<th style="text-align:center" width="15%" >Product Name</th>
						<th style="text-align:center" width="10%" >Price</th>
						<th style="text-align:center" width="8%" >Quantiy</th>
						<th style="text-align:center" width="15%" >Image</th>
						<th style="text-align:center" width="10%" >Type</th>
						<th style="text-align:center" width="10%" >Category</th>
						<th style="text-align:center" width="10%" >Brand</th>
						<th style="text-align:center" width="10%" >Description</th>
						<th style="text-align:center" width="8%" >Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$productList = $product->showProduct();
						if($productList) {
							$i = 0;
							while($result = $productList->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td style="text-align:center"><?php echo $i ?></td>
						<td><?php echo $result['productName'] ?></td>
						<td style="text-align:center"><?php echo $fm->format_currency($result['price']) ?></td>
						<td style="text-align:center"><?php echo $result['quantity'] ?></td>
						<td style="text-align:center"><img class="img" src="../uploads/product/<?php echo $result['image'] ?>" width="50px" alt=""></td>
						<td style="text-align:center"><?php 
							if($result['type']) echo "Featured";
							else echo "Non-Featured"
						?></td>
						<td style="text-align:center"><?php echo $result['catName'] ?></td>
						<td style="text-align:center"><?php echo $result['brandName'] ?></td>
						<td><?php echo $fm->textShorten($result['description'], 50) ?></td>
						<td style="text-align:center"><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a> || <a href="?delId=<?php echo $result['productId'] ?>">Delete</a></td>
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
