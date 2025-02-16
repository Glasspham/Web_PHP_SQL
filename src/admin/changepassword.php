<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = Session::get('id');
		$password = md5($_POST['password']);
		$newpassword = md5($_POST['newpassword']);
		$changepass = $class->changePassword($id, $password, $newpassword);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">
            <?php 
                if(isset($changepass)) echo $changepass;
            ?>               
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..."  name="password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="newpassword" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>