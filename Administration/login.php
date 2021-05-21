<?php

session_start();
$connection = mysqli_connect("localhost", "root", "", "badminton_scoring_system");

if (!$connection) {
    die('<center><h1>Unable to connect...!</h1></center>');
}

$error = false;
$error_message = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));

    $query = "SELECT `id`, `email`, `password`, `first_name`, `last_name` FROM `admins` WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows == 1) {
        $error = false;
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_name'] = $admin['first_name'] . " " . $admin['last_name'];
        header("location:index.php");
    } else {
        $error = true;
        $error_message = "Invalid Email or Password";
    }
}

?>
<html>

<head>
    <title>Admin Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9faff;
        }

        .row {
            height: 100vh;
        }

        .login-box {
            position: relative;
            width: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 15px;
        }

        .form-control {
            height: 68px;
            padding: 0 25px 0 25px;
            border-radius: 0;
        }

        .btn {
            height: 68px;
        }

        label.error {
            padding-right: 10px;
            padding-left: 10px;
            margin-top: 5px;
            border: 0.5px dashed #b7111159;
            border-radius: 2px;
            color: #b71111d9;
            font-style: italic;
            font-size: 14px;
            background-color: #ff000042;
        }

        label.error::before {
            content: "* ";
        }

        input.error,
        select.error {
            border: 1px solid #b7111159;
        }

        input.valid,
        select.valid {
            border: 1px solid #0080005e;
        }

        textarea:hover,
        input:hover,
        textarea:active,
        input:active,
        textarea:focus,
        input:focus,
        button:focus,
        button:active,
        button:hover,
        label:focus,
        .btn:active,
        .btn.active {
            outline: 0px !important;
            -webkit-appearance: none;
            box-shadow: none !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <form id="login_form" action="login.php" method="POST" class="login-box bg-white text-center p-5 pt-1 shadow border">
                    <?php if ($error) { ?>
                        <div class="alert alert-danger">
                            <?= $error_message ?>
                        </div>
                    <?php } ?>
                    <img src="../images/header-logo.png">
                    <h2 class="display-6">Admin Panel Login</h2>
                    <br>
                    <div class="form-group mb-1">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <br>
                        <input type="submit" name="login" value="Login" class="btn btn-primary w-100">
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/jqueryvalidation.js"></script>
<script>
    $('#login_form').validate({
        rules: {
            email: {
                required: true
            },
            password: {
                required: true
            }
        }
    });
</script>

</html>