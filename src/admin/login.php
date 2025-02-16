<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/session.php");
Session::init();
if (Session::get('admin')) {
	header("Location: index.php");
	// echo "<script>window.location = 'index.php'</script>";
	exit();
}
include("../classes/admin.php");
$class = new admin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$loginCheck = $class->loginAdmin($username, $password);
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container">
		<section id="content">
			<form action="login.php" method="POST">
				<h1>Admin Login</h1>
				<span><?php
				if (isset($loginCheck)) {
					echo $loginCheck;
				}
				?></span>
				<div>
					<input type="text" placeholder="Username" required="" name="username" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form>
			<div class="button">
				<a href="#">Training with live project</a>
			</div>
		</section>
	</div>
</body>
</html>