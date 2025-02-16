<?php 
	include("inc/header.php");

    $loginCheck = Session::get('customer_login');
    if(!$loginCheck) header('Location: login.php');
?>
<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #f6d365;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Profile</h3>
                </div>
                <div class="clear"></div>
            </div>
            <table class="tblone">
                <?php 
                    $id = Session::get('customer_id');
                    $getCustomer = $cus->showCustomer($id);
                    if($getCustomer) {
                        $result = $getCustomer->fetch_assoc();
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country'] ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                <tr>
                    <td>Zip-code</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Edit Profile</a></td>
                </tr>
                <?php 
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<?php 
	include("inc/footer.php");
?>