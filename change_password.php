<?php
include("header.php");

if (!isset($_SESSION['logged_in'])) {
    header("location:login.php");
}

$error = false;
$error_message = "";
$success = false;
$success_message = "";

if (isset($_POST['update'])) {
    $current_password = md5(trim($_POST['current_password']));
    $new_password = md5(trim($_POST['new_password']));
    $player_id = $_SESSION['player_id'];

    $select_query = "SELECT `password` from `players` WHERE `id` = $player_id";
    $result = mysqli_query($connection, $select_query);
    $player = mysqli_fetch_assoc($result);

    if ($player['password'] == $current_password) {
        $error = false;
        $update_query = "UPDATE `players` SET `password` = '$new_password' WHERE `id` = $player_id";
        if (mysqli_query($connection, $update_query)) {
            $error = false;
            $success = true;
            $success_message = "Password updated successfully";
        } else {
            $error = true;
            $error_message = "Unable to update password, please try again later";
        }
    } else {
        $error = true;
        $error_message = "Invalid current password";
    }
}
?>

<main class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 border p-5 pt-3">
            <?php if ($error) { ?>
                <div class="alert alert-danger">
                    <?= $error_message ?>
                </div>
            <?php } ?>
            <?php if ($success) { ?>
                <div class="alert alert-success">
                    <?= $success_message ?>
                </div>
            <?php } ?>
            <h3 class="text-center">Change Password</h3>
            <form action="change_password.php" method="POST" id="change_password_form">
                <div class="form-group">
                    <label>Current Password:</label>
                    <input type="password" name="current_password" class="form-control form-control-sm">
                </div>
                <br>
                <hr>
                <div class="form-group">
                    <label>New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label>Confirm New Password:</label>
                    <input type="password" name="confirm_new_password" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <br>
                    <input type="submit" name="update" value="Update" class="btn w-100 btn-sm btn-success">
                </div>
            </form>
        </div>
    </div>
</main>
<script>
    $('#change_password_form').validate({
        rules: {
            current_password: {
                required: true
            },
            new_password: {
                required: true,
                minlength: 5
            },
            confirm_new_password: {
                minlength: 5,
                equalTo: '#new_password'
            }
        }
    })
</script>
<?php include("footer.php"); ?>