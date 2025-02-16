<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../../lib/session.php");
Session::init();
if (!Session::get('admin')) {
    header("Location: login.php");
    exit();
}
include_once($filepath . "/../../lib/database.php");
include_once($filepath . "/../helpers/format.php");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
spl_autoload_register(function ($className) {
    $file = "../classes/" . $className . ".php";
    if (file_exists($file)) {
        include_once $file;
    }
});
$db = new Database();
$fm = new Format();
$class = new admin();
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
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/table/demo_page.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- END: load jquery -->
    <!-- BEGIN: load jquery -->
    <!-- <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.accordion.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.effects.core.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.effects.slide.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.mouse.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.sortable.min.js"></script>
    <script type="text/javascript" src="js/table/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/setup.js"></script>
    <script type="text/javascript" src="js/table/table.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
</head>
<style>
    .submenu li.active a {
        background-color:#2cbdc5 !important;
        color: black;
        font-style: italic;
        font-weight: bold;
        border-radius: 4px;
    }
</style>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/logo_1.png" style="width: 65px;" alt="Logo" />
                </div>
                <div class="floatleft middle">
                    <h1>Admin Management Page</h1>
                    <p></p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('username') ?></li>
                            <?php
                            if (isset($_GET["action"]) && $_GET["action"] == "logout") {
                                Session::destroy();
                            }
                            ?>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li><a href="index.php"><i class="fas fa-tachometer-alt"> Dashboard</i></a></li>
                <li><a href="profile.php"><i class="fas fa-user"> User Profile</i></a></li>
                <li><a href="changepassword.php"><i class="fas fa-key"> Change Password</i></a></li>
                <li><a href="inbox.php"><i class="fas fa-envelope"> Inbox</i></a></li>
                <li><a href=""><i class="fas fa-globe"> Visit Website</i></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>