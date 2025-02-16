<?php 
	include("inc/header.php");

    $loginCheck = Session::get('customer_login');
    if(!$loginCheck) header('Location: login.php');
?>
<style>
    .wrapper_method {
        text-align: center;
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        padding: 20px;
        border-radius: 10px;
        background: cornsilk;
    }
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 20px;
    }
    .wrapper_method a {
        padding: 10px;
        border-radius: 5px;
        background: red;
        color: #fff;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Choosen your method payment</h3>
                    <a href="offlinepayment.php">Offline payment</a>
                    <a href="onlinepayment.php">Online payment</a>
                    <br><br><br>
                    <a style="background:grey" href="cart.php">Previous</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>