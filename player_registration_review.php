<?php
include('header.php');
$player_id = $_GET['player_id'];

$search_query = "SELECT `first_name`, `last_name`, `gender`, `father_name`, `mother_name`, `address`, `district`, `phone_number`, `date_of_birth`, `photo_path`, `pin_code`, `email` FROM `players` WHERE `id` = " . base64_decode($player_id);
$result = mysqli_query($connection, $search_query);
$player = mysqli_fetch_array($result);
?>
<style>
    table th,
    td {
        height: 80px;
    }
</style>
<main class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Registration Form</h1>
        </div>
    </div>
    <div class="row d-print-none">
        <div class="col-12 ps-5">
            <button type="button" class="btn btn-success btn-sm" onclick="window.print()">Print</button>
            <button type="button" class="btn btn-success btn-sm" onclick="Export()">PDF</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-5 pt-2">
            <table class="table table-responsive table-bordered border-dark align-middle text-center" id="player_form">
                <tr>
                    <th style="width: 25%;">Name:</th>
                    <td style="width: 60%;"><?= $player['first_name'] . " " . $player['last_name'] ?></td>
                    <td rowspan="4" colspan="2" style="width: 15%;">
                        <img src="./<?= $player['photo_path'] ?>" alt="image" height="200" width="150">
                    </td>
                </tr>
                <tr>
                    <th>Father's Name:</th>
                    <td><?= $player['father_name'] ?></td>
                </tr>
                <tr>
                    <th>Mother's Name:</th>
                    <td><?= $player['mother_name'] ?></td>
                </tr>
                <tr>
                    <th>Phone No:</th>
                    <td><?= $player['phone_number'] ?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?= $player['address'] ?></td>
                    <th>Gender:</th>
                    <td><?= $player['gender'] ?></td>
                </tr>
                <tr>
                    <th>District:</th>
                    <td colspan="3"><?= $player['district'] ?></td>
                </tr>
                <tr>
                    <th>Pin Code:</th>
                    <td colspan="3"><?= $player['pin_code'] ?></td>
                </tr>
                <tr>
                    <th>Date of Birth:</th>
                    <td colspan="3"><?= $player['date_of_birth'] ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td colspan="3"><?= $player['email'] ?></td>
                </tr>
            </table>
        </div>
    </div>
</main>
<script>
    function Export() {
        html2canvas(document.getElementById('player_form'), {
            onrendered: function(canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                pdfMake.createPdf(docDefinition).download("<?= $player['first_name'] . "_" . $player['last_name'] ?>.pdf");
            }
        });
    }
</script>
<?php include('footer.php'); ?>