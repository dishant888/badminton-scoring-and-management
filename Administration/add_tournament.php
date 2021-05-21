<?php
include("header.php");

$alert = false;
$alert_message = "";
$class = "";

if (isset($_POST['submit'])) {
    $tournament_name = trim($_POST['name']);
    $venue = trim($_POST['venue']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);
    $address = trim($_POST['address']);
    $organised_by = trim($_POST['organised_by']);
    $contact_name = trim($_POST['contact_name']);
    $contact_number = trim($_POST['contact_number']);
    $contact_email = trim($_POST['contact_email']);

    $query = "INSERT INTO `tournaments`(`name`, `start_date`, `end_date`, `venue`, `address`, `organised_by`, `contact_name`, `contact_number`, `contact_email`) VALUES('$tournament_name', '$start_date', '$end_date', '$venue', '$address', '$organised_by', '$contact_name', '$contact_number', '$contact_email')";

    if (mysqli_query($connection, $query)) {
        $alert = true;
        $alert_message = "Successfully added tournament";
        $class = "success";
    } else {
        $alert = true;
        $alert_message = "Unable to add tournament, please try again later";
        $class = "danger";
    }
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Tournament</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="tournaments.php" class="page-link">Back</a>
        </div>
    </div>
    <?php if ($alert) { ?>
        <div class="alert alert-<?= $class ?>">
            <?= $alert_message ?>
        </div>
    <?php } ?>
    <form method="POST" id="tournament_form" action="add_tournament.php" class="row pt-2 p-3">
        <div class="form-group col-md-6 mb-3">
            <label>Tournament Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Tournament name">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Venue</label>
            <input type="text" name="venue" class="form-control" placeholder="Enter venue">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Start Date</label>
            <input type="text" name="start_date" class="form-control" placeholder="Enter start date">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>End Date</label>
            <input type="text" name="end_date" class="form-control" placeholder="Enter end date">
        </div>
        <div class="form-group col-12 mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Organised By</label>
            <input type="text" name="organised_by" class="form-control" placeholder="Enter name of Association">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Organiser Name</label>
            <input type="text" name="contact_name" class="form-control" placeholder="Enter organiser date">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Organiser Contact</label>
            <input type="text" name="contact_number" class="form-control" placeholder="Enter organiser contact">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label>Organiser Email</label>
            <input type="email" name="contact_email" class="form-control" placeholder="Enter organiser email">
        </div>
        <div class="form-group text-center">
            <br>
            <input type="submit" name="submit" class="btn btn-primary w-50" value="Create Tournament">
        </div>
    </form>
</main>
<script>
    $('#tournament_form').validate({
        rules: {
            name: "required",
            venue: "required",
            start_date: "required",
            end_date: "required",
            address: "required",
            organised_by: "required",
            contact_name: "required",
            contact_number: "required",
            contact_email: "required",
        }
    });
</script>
<?php include("footer.php"); ?>