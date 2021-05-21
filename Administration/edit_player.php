<?php
include('header.php');

$player_id = $_GET['player_id'];

$search_query = "SELECT * FROM `players` WHERE `id` = " . base64_decode($player_id);
$result = mysqli_query($connection, $search_query);
$player = mysqli_fetch_array($result);
$dob = strtotime($player['date_of_birth']);
$date = date('m', $dob);
$month = date('d', $dob);
$year = date('Y', $dob);

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
    $password = ($player['password'] == $_POST['password']) ? $_POST['password'] : md5(trim($_POST['password']));
    $dob = $_POST['date'] . "/" . $_POST['month'] . "/" . $_POST['year'];
    $file_source = $_FILES['photo']['tmp_name'];
    $file_destination = "../uploads/photos/" . $_FILES['photo']['name'];
    $file_path = ($_FILES['photo']['name'] == "") ? $player['photo_path'] : "uploads/photos/" . $_FILES['photo']['name'];

    if ($_FILES['photo']['name']) {
        if (move_uploaded_file($file_source, $file_destination)) {
            $alert = false;
        } else {
            $alert = true;
            $class = "danger";
            $alert_message = 'Unable to upload the file, please try again.';
        }
    }

    $update_query = "UPDATE `players` SET `first_name` = '$first_name', `last_name` = '$last_name', `gender` = '$gender', `address` = '$address', `district` = '$district', `pin_code` = '$pin_code', `email` = '$email', `password` = '$password', `date_of_birth` = '$dob', `father_name` = '$father_name', `mother_name` = '$mother_name', `phone_number` = '$phone_number', `photo_path` = '$file_path' WHERE `id` = " . base64_decode($player_id);
    if (mysqli_query($connection, $update_query)) {
        $alert = true;
        $class = "success";
        $alert_message = 'Player Updated Successfully';
    } else {
        $alert = true;
        $class = "danger";
        $alert_message = 'Unable to register, please try again later';
    }
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap d-print-none flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Player</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="players.php" class="page-link">Back</a>
        </div>
    </div>
    <?php if ($alert) { ?>
        <div class="alert alert-<?= $class ?>">
            <?= $alert_message ?>
        </div>
    <?php } ?>
    <form id="player_form" class="row pt-2 p-3" action="edit_player.php?player_id=<?= base64_encode($player['id']) ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-6 mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= $player['first_name'] ?>" class="form-control" placeholder="Enter first name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= $player['last_name'] ?>" class="form-control" placeholder="Enter last name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" <?= ($player['gender'] == "Male" ? "checked" : "") ?> name="gender" type="radio" value="Male">
                <label class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" <?= ($player['gender'] == "Female" ? "checked" : "") ?> name="gender" type="radio" value="Female">
                <label class="form-check-label">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" <?= ($player['gender'] == "Other" ? "checked" : "") ?> name="gender" type="radio" value="Other">
                <label class="form-check-label">Other</label>
            </div>
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Address</label>
            <input type="text" name="address" value="<?= $player['address'] ?>" class="form-control" placeholder="Enter address">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>District</label>
            <select name="district" class="form-select">
                <option value="">---Select---</option>
                <option <?= ($player['district'] == "Ajmer") ? "selected" : "" ?> value="Ajmer">Ajmer</option>
                <option <?= ($player['district'] == "Alwar") ? "selected" : "" ?> value="Alwar">Alwar</option>
                <option <?= ($player['district'] == "Banswara") ? "selected" : "" ?> value="Banswara">Banswara</option>
                <option <?= ($player['district'] == "Baran") ? "selected" : "" ?> value="Baran">Baran</option>
                <option <?= ($player['district'] == "Barmer") ? "selected" : "" ?> value="Barmer">Barmer</option>
                <option <?= ($player['district'] == "Bharatpur") ? "selected" : "" ?> value="Bharatpur">Bharatpur</option>
                <option <?= ($player['district'] == "Bhilwara") ? "selected" : "" ?> value="Bhilwara">Bhilwara</option>
                <option <?= ($player['district'] == "Bikaner") ? "selected" : "" ?> value="Bikaner">Bikaner</option>
                <option <?= ($player['district'] == "Bundi") ? "selected" : "" ?> value="Bundi">Bundi</option>
                <option <?= ($player['district'] == "Chittorgarh") ? "selected" : "" ?> value="Chittorgarh">Chittorgarh</option>
                <option <?= ($player['district'] == "Churu") ? "selected" : "" ?> value="Churu">Churu</option>
                <option <?= ($player['district'] == "Dausa") ? "selected" : "" ?> value="Dausa">Dausa</option>
                <option <?= ($player['district'] == "Dholpur") ? "selected" : "" ?> value="Dholpur">Dholpur</option>
                <option <?= ($player['district'] == "Dungarpur") ? "selected" : "" ?> value="Dungarpur">Dungarpur</option>
                <option <?= ($player['district'] == "Hanumangarh") ? "selected" : "" ?> value="Hanumangarh">Hanumangarh</option>
                <option <?= ($player['district'] == "Jaipur") ? "selected" : "" ?> value="Jaipur">Jaipur</option>
                <option <?= ($player['district'] == "Jaisalmer") ? "selected" : "" ?> value="Jaisalmer">Jaisalmer</option>
                <option <?= ($player['district'] == "Jalore") ? "selected" : "" ?> value="Jalore">Jalore</option>
                <option <?= ($player['district'] == "Jhalawar") ? "selected" : "" ?> value="Jhalawar">Jhalawar</option>
                <option <?= ($player['district'] == "Jhunjhunu") ? "selected" : "" ?> value="Jhunjhunu">Jhunjhunu</option>
                <option <?= ($player['district'] == "Jodhpur") ? "selected" : "" ?> value="Jodhpur">Jodhpur</option>
                <option <?= ($player['district'] == "Karauli") ? "selected" : "" ?> value="Karauli">Karauli</option>
                <option <?= ($player['district'] == "Kota") ? "selected" : "" ?> value="Kota">Kota</option>
                <option <?= ($player['district'] == "Nagaur") ? "selected" : "" ?> value="Nagaur">Nagaur</option>
                <option <?= ($player['district'] == "Pali") ? "selected" : "" ?> value="Pali">Pali</option>
                <option <?= ($player['district'] == "Pratapgarh") ? "selected" : "" ?> value="Pratapgarh">Pratapgarh</option>
                <option <?= ($player['district'] == "Rajsamand") ? "selected" : "" ?> value="Rajsamand">Rajsamand</option>
                <option <?= ($player['district'] == "Sawai") ? "selected" : "" ?> value="Sawai Madhopur">Sawai</option>
                <option <?= ($player['district'] == "Sikar") ? "selected" : "" ?> value="Sikar">Sikar</option>
                <option <?= ($player['district'] == "Sirohi") ? "selected" : "" ?> value="Sirohi">Sirohi</option>
                <option <?= ($player['district'] == "Sri") ? "selected" : "" ?> value="Sri Ganganagar">Sri</option>
                <option <?= ($player['district'] == "Tonk") ? "selected" : "" ?> value="Tonk">Tonk</option>
                <option <?= ($player['district'] == "Udaipur") ? "selected" : "" ?> value="Udaipur">Udaipur</option>
            </select>
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Pin Code</label>
            <input type="number" value="<?= $player['pin_code'] ?>" name="pin_code" class="form-control" placeholder="Enter pin code">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Login Details</label>
            <input type="email" value="<?= $player['email'] ?>" name="email" class="form-control" placeholder="Email">
            <input type="text" value="<?= $player['password'] ?>" id="password" name="password" class="form-control a mt-3" placeholder="Password">
            <input type="text" value="<?= $player['password'] ?>" name="confirm_password" class="form-control mt-3" placeholder="Confirm Password">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Date of Birth</label>
            <select name="date" class="form-select">
                <option value="">---Select Date---</option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                ?>
                    <option <?= ($date == $i) ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?></option>
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
                foreach ($months as $key => $value) {
                ?>
                    <option <?= ($month == $key) ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
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
                    <option <?= ($year == $i) ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Father's Name</label>
            <input type="text" value="<?= $player['father_name'] ?>" name="father_name" class="form-control" placeholder="Enter father's name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Mother's Name</label>
            <input type="text" value="<?= $player['mother_name'] ?>" name="mother_name" class="form-control" placeholder="Enter mother's name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Phone Number</label>
            <input type="text" value="<?= $player['phone_number'] ?>" name="phone_number" class="form-control" placeholder="Enter mobile no">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Upload your Photo</label>
            <input name="photo" class="form-control" type="file">
        </div>
        <div class="form-group text-center col-md-12 mb-3">
            <br>
            <input type="submit" name="submit" value="Update" class="btn w-50 btn-primary">
        </div>
    </form>
</main>
<script>
    $('#player_form').validate({
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
                maxlength: 10,
                minlength: 10
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