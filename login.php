<?php
include("header.php");

if (isset($_SESSION['logged_in'])) {
    header("location:index.php");
}

$error = false;
$error_message = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));

    $select_query = "SELECT `id`, `first_name`, `last_name`, `password`, `email` FROM `players` WHERE `email` = '$email'";
    $result = mysqli_query($connection, $select_query);

    if ($result->num_rows == 1) {
        $error = false;
        $player = mysqli_fetch_assoc($result);
        if ($player['password'] == $password) {
            $error = false;
            $_SESSION['logged_in'] = true;
            $_SESSION['player_id'] = $player['id'];
            $_SESSION['player_name'] = $player['first_name'] . " " . $player['last_name'];
            $_SESSION['player_email'] = $player['email'];
            header("location:index.php");
        } else {
            $error = true;
            $error_message = "Invalid Password";
        }
    } else {
        $error = true;
        $error_message = "You are not registered, please register first";
    }
}
?>

<main class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3 border p-5 pt-3">
            <?php if ($error) { ?>
                <div class="alert alert-danger">
                    <?= $error_message ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Login</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="login_form" action="login.php" method="POST">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <br>
                            <input type="submit" value="Login" name="login" class="btn w-100 btn-success">
                        </div>
                    </form>
                    <br>
                    <a href="player_registration.php" class="page-link text-center w-25">Register</a>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $('#login_form').validate({
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true
            }
        }
    })
</script>
<?php include("footer.php"); ?>