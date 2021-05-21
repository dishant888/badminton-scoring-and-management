<?php
include("header.php");
$alert = false;
$alert_message = "";
$class = "";
if (isset($_POST['submit'])) {

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $gender = $_POST['gender'];
    $father_name = trim($_POST['father_name']);
    $mother_name = trim($_POST['mother_name']);
    $address = trim($_POST['address']);
    $district = trim($_POST['district']);
    $phone_number = trim($_POST['phone_number']);
    $pin_code = trim($_POST['pin_code']);
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    $dob = $_POST['date'] . "/" . $_POST['month'] . "/" . $_POST['year'];
    $file_source = $_FILES['photo']['tmp_name'];
    $file_destination = "../uploads/photos/" . $_FILES['photo']['name'];
    $file_path = "uploads/photos/" . $_FILES['photo']['name'];

    $select_query = "SELECT `id` FROM `players` WHERE `email` = '$email'";
    $result = mysqli_query($connection, $select_query);

    if ($result->num_rows == 0) {
        $alert = false;
        if (move_uploaded_file($file_source, $file_destination)) {
            $alert = false;
            $insert_query = "INSERT INTO `players`(`first_name`, `last_name`, `gender`, `father_name`, `mother_name`, `address`, `district`, `phone_number`, `date_of_birth`, `photo_path`, `pin_code`, `email`, `password`) VALUES ('$first_name', '$last_name', '$gender', '$father_name', '$mother_name', '$address', '$district', '$phone_number', '$dob', '$file_path', '$pin_code', '$email', '$password')";
            if (mysqli_query($connection, $insert_query)) {
                $alert = true;
                $class = "success";
                $alert_message = 'Player Added Successfully';
            } else {
                $alert = true;
                $class = "danger";
                $alert_message = 'Unable to register, please try again later';
            }
        } else {
            $alert = true;
            $class = "danger";
            $alert_message = 'Unable to upload the file, please try again.';
        }
    } else {
        $alert = true;
        $class = "danger";
        $alert_message = "This email is already registered";
    }
}
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Player</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="players.php" class="page-link">Back</a>
        </div>
    </div>
    <?php if ($alert) { ?>
        <div class="alert alert-<?= $class ?>">
            <?= $alert_message ?>
        </div>
    <?php } ?>
    <form id="player_registration_form" class="row pt-2 p-3" action="add_player.php" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-6 mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" checked name="gender" type="radio" value="Male">
                <label class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="gender" type="radio" value="Female">
                <label class="form-check-label">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="gender" type="radio" value="Other">
                <label class="form-check-label">Other</label>
            </div>
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>District</label>
            <select name="district" class="form-select">
                <option value="">---Select---</option>
                <option value="Ajmer">Ajmer</option>
                <option value="Alwar">Alwar</option>
                <option value="Banswara">Banswara</option>
                <option value="Baran">Baran</option>
                <option value="Barmer">Barmer</option>
                <option value="Bharatpur">Bharatpur</option>
                <option value="Bhilwara">Bhilwara</option>
                <option value="Bikaner">Bikaner</option>
                <option value="Bundi">Bundi</option>
                <option value="Chittorgarh">Chittorgarh</option>
                <option value="Churu">Churu</option>
                <option value="Dausa">Dausa</option>
                <option value="Dholpur">Dholpur</option>
                <option value="Dungarpur">Dungarpur</option>
                <option value="Hanumangarh">Hanumangarh</option>
                <option value="Jaipur">Jaipur</option>
                <option value="Jaisalmer">Jaisalmer</option>
                <option value="Jalore">Jalore</option>
                <option value="Jhalawar">Jhalawar</option>
                <option value="Jhunjhunu">Jhunjhunu</option>
                <option value="Jodhpur">Jodhpur</option>
                <option value="Karauli">Karauli</option>
                <option value="Kota">Kota</option>
                <option value="Nagaur">Nagaur</option>
                <option value="Pali">Pali</option>
                <option value="Pratapgarh">Pratapgarh</option>
                <option value="Rajsamand">Rajsamand</option>
                <option value="Sawai Madhopur">Sawai</option>
                <option value="Sikar">Sikar</option>
                <option value="Sirohi">Sirohi</option>
                <option value="Sri Ganganagar">Sri</option>
                <option value="Tonk">Tonk</option>
                <option value="Udaipur">Udaipur</option>
            </select>
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Pin Code</label>
            <input type="number" name="pin_code" class="form-control" placeholder="Enter pin code">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Login Details</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
            <input type="password" id="password" name="password" class="form-control a mt-3" placeholder="Password">
            <input type="password" name="confirm_password" class="form-control mt-3" placeholder="Confirm Password">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Date of Birth</label>
            <select name="date" class="form-select">
                <option value="">---Select Date---</option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php
                }
                ?>
            </select>
            <select name="month" class="form-select mt-3">
                <option value="">---Select Month---</option>
                <?php
                $months = array(
                    '01' => 'January', '02' => 'Feburary', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June',
                    '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                );
                foreach ($months as $key => $month) {
                ?>
                    <option value="<?= $key ?>"><?= $month ?></option>
                <?php
                }
                ?>
            </select>
            <select name="year" class="form-select mt-3">
                <option value="">---Select Year---</option>
                <?php
                $startYear = Date('Y') - 5;
                $endYear = $startYear - 75;

                for ($i = $startYear; $i >= $endYear; $i--) {
                ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Father's Name</label>
            <input type="text" name="father_name" class="form-control" placeholder="Enter father's name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Mother's Name</label>
            <input type="text" name="mother_name" class="form-control" placeholder="Enter mother's name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Phone Number</label>
            <input type="number" name="phone_number" class="form-control" placeholder="Enter mobile no">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Upload your Photo</label>
            <input name="photo" class="form-control" type="file">
        </div>
        <div class="form-group text-center col-md-12 mb-3">
            <br>
            <input type="submit" name="submit" value="Register" class="btn w-50 btn-primary">
        </div>
    </form>
</main>
<script>
    $('#player_registration_form').validate({
        validClass: 'valid',
        rules: {
            first_name: {
                required: true,
                lettersonly: true
            },
            last_name: {
                required: true,
                lettersonly: true
            },
            address: {
                required: true
            },
            district: {
                required: true
            },
            phone_number: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                minlength: 5,
                equalTo: '#password'
            },
            date: {
                required: true
            },
            month: {
                required: true
            },
            year: {
                required: true
            },
            photo: {
                required: true
            },
            father_name: {
                required: true,
                lettersonly: true
            },
            mother_name: {
                required: true,
                lettersonly: true
            },
            pin_code: {
                required: true,
            }
        }
    });
</script>
<?php include("footer.php"); ?>