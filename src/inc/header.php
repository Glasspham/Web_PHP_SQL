<?php 
    include_once "lib/session.php";
	include_once "lib/database.php";
	include_once "helpers/format.php";
    Session::init();
	header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    header("Cache-Control: max-age=2592000");
	spl_autoload_register(function($className){
		$file = "classes/".$className.".php";
        if (file_exists($file)) {
            include_once $file;
        }
	});
	$db = new Database();
	$fm = new Format();
	$brand = new brand();
	$cart = new cart();
	$cat = new category();
	$product = new product();
	$cus = new customer();
	$post = new post();
	$blog = new blog();
	$order = new order();
	$placed = new placed();
	$cmp = new compare();
	$wl = new wishlist();
	$slider = new slider();
	$rat = new rating();
	$hst = new history();
?>
<!DOCTYPE HTML>
<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<!-- <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> Version oldest  -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-3.3.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script> 
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script type="text/javascript">
		$(document).ready(function($){
			$('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
		});
	</script>
</head>
<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="POST">
						<input type="text" name="key" placeholder="Search Product" >
						<input type="submit" name="search" value="SEARCH">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product"><?php
									$quantity = Session::get("quantity");
									if(!isset($quantity) || $quantity == 0) {
										Session::set("quantity", 0);
										Session::set("sum", 0);
										$quantity = 0;
									}
									echo $quantity;
								?>
							</span>
						</a>
					</div>
				</div>
				<?php 
					if(isset($_GET['customerId'])) {
						$customerId = $_GET['customerId'];
						$delCart = $cart->deleteAllCart();
						$delCompare = $cmp->deleteAllCompare($customerId);
						Session::destroy();
					}
					$loginCheck = Session::get('customer_login');
					if(!$loginCheck) {
						echo '
							<div class="login">
								<a href="login.php" style="">Login</a>
							</div>
						';
					} else { echo '
						<div class="floatright">
							<div class="floatleft">
								<img src="admin/img/img-profile.jpg" alt="Profile Pic" />
							</div>
							<div class="floatleft marginleft10">
								<ul class="inline-ul floatleft">
									<li><a href="profile.php">Hello '.Session::get('customer_name').'</a></li>
									<li><a class="abefore" href="?customerId='.Session::get('customer_id').'">Logout</a> </li>
								</ul>
							</div>
						</div>
						';
					}
				?>
				<div class="clear"></div>
			</div>
	<div class="clear"></div>
			</div>
			<div class="menu">
				<nav class="navbar navbar-inverse">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<li class="active"><a href="index.php">Home</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Category <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php 
										$showcat = $cat->showCategory();
										if($showcat) {
											while($result = $showcat->fetch_assoc()) {
									?>
									<li><a href="productbycat.php?catid=<?php echo $result['catId']?>&catName=<?php echo $result['catName']?>"><?php echo $result['catName']?></a></li>
									<?php 			
											}
										} else {
											echo '<li><a><strong>Updating in progress</strong></a></li>';
										}
									?>
								</ul>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Brand <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php 
										$showBrand = $brand->showBrand();
										if($showBrand) {
											while($result = $showBrand->fetch_assoc()){ 
									?>
									<li><a href="topbrand.php?brandId=<?php echo $result['brandId']?>&brandName=<?php echo $result['brandName']?>"><?php echo $result['brandName']?></a></li>
									<?php 
											}
										} else {
											echo '<li><a><strong>Updating in progress</strong></a></li>';
										}
									?>
								</ul>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">News <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php 
										$showpost = $post->showPost();
										if($showpost) {
											while($result = $showpost->fetch_assoc()){ 
									?>
									<li><a href="news.php?newsId=<?php echo $result['id']?>"><?php echo $result['title']?></a></li>
									<?php
											}
										} else {
											echo '<li><a><strong>Updating in progress</strong></a></li>';
										}
									?>
								</ul>
							</li>
							<?php 
								$customer_id = Session::get('customer_id');
								$checkplaced = $placed->checkPlaced($customer_id);
								if($checkplaced) echo '<li><a href="order.php">Ordered</a></li>';
								if($loginCheck) {
									echo '
										<li><a href="cart.php">Cart</a></li>
										<li><a href="compare.php">Compare</a></li>
										<li><a href="wishlist.php">Favourite</a></li>
										<li><a href="history_order.php">History Order</a></li>
									';
								}
							?>
							<li><a href="contact.php">Contact</a> </li>
							<div class="clear"></div>
						</ul>
					</div>
				</nav>
			</div>