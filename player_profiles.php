<?php
include('header.php');
$select_query = 'SELECT `id`, `first_name`, `last_name`, `date_of_birth`, `district`, `gender` FROM `players` ORDER BY `district`';
$result = mysqli_query($connection, $select_query);
?>
<style>
    a {
        text-decoration: none;
    }
</style>
<main class="container">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <h3>Player Profiles</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table id="player_profiles" class="table border text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($player = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <a href="<?= "./player_registration_review.php?player_id=" . base64_encode($player['id']) ?>">
                                    <?= $player['first_name'] . " " . $player['last_name'] ?>
                                </a>
                            </td>
                            <td><?= $player['district'] ?></td>
                            <td><?= $player['date_of_birth'] ?></td>
                            <td><?= $player['gender'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#player_profiles').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-sm btn-success',
                    title: 'List of Players',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'btn btn-sm btn-success',
                    title: 'List of Players',
                    customize: function(doc) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.styles.tableBodyEven.alignment = 'center';
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn btn-sm btn-success',
                    title: 'List of Players',
                }
            ]
        });
    });
</script>
<?php include('footer.php') ?>