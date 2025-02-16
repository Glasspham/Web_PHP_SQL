<?php
    include_once "inc/header.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $insertCustomer = $cus->insertCustomer($_POST);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $loginCustomer = $cus->loginCustomer($_POST);
    }
    $loginCheck = Session::get('customer_login');
    if($loginCheck){
        echo "<script>window.location = 'index.php'</script>";
    }
?>
<div class="main">
    <div class="content">
        <?php ?>
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="" method="POST">
                <input type="text" name="account" class="field" placeholder="Enter Username or Username" />
                <input type="text" name="password" class="field" placeholder="Enter Password" />
                <?php
                if (isset($loginCustomer))
                    echo $loginCustomer;
                ?>
                <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                <div class="buttons">
                    <div><input type="submit" name="login" class="grey" value="Sign In"></div>
                </div>
            </form>
        </div>
        <div class="register_account">
            <h3>Register New Account</h3>
            <?php
            if (isset($insertCustomer))
                echo $insertCustomer;
            ?>
            <form action"" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Enter Name ..." />
                                </div>
                                <div>
                                    <input type="text" name="city" placeholder="Enter City ..." />
                                </div>
                                <div>
                                    <input type="text" name="zipcode" placeholder="Enter Zipcode ..." />
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Enter Email ..." />
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Enter Address ..." />
                                </div>
                                <div>
                                    <select id="country" name="country" class="frm-field required">
                                        <option value="null">Select a Country</option>
                                        <option value="AF">Afghanistan</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="text" name="phone" placeholder="Enter Phone ..." />
                                </div>
                                <div>
                                    <input type="text" name="password" placeholder="Enter Password ..." />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search" style="margin:50px">
                    <div><input type="submit" name="submit" class="grey" value="Create Account"></div>
                </div>
                <p class="terms" >By clicking 'Create Account' you agree to the<a href="#">Terms &amp; Conditions</a>.</p>
                <div class="clear"></div>
            </form>
        </div>  
        <div class="clear"></div>
    </div>
</div>
<?php
include("inc/footer.php");
?>