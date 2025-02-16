<?php
include("inc/header.php");
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $updateCustomer = $cus->updateCustomer($_POST, $customer_id);
}
$loginCheck = Session::get('customer_login');
if (!$loginCheck)
    header('Location: login.php');
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Edit Profile</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="POST">
                <table class="tblone">
                    <tr>
                        <?php
                        if (isset($updateCustomer))
                            echo '<td colspan="3">' . $updateCustomer . '</td>';
                        ?>
                    </tr>
                    <?php
                    $getCustomer = $cus->showCustomer($customer_id);
                    if ($getCustomer) {
                        $result = $getCustomer->fetch_assoc();
                        ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Zip-code</td>
                            <td>:</td>
                            <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" name="save" value="Save" class="grey"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
include("inc/footer.php");
?>