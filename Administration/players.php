<?php
include("header.php");
$select_query = 'SELECT `id`, `first_name`, `last_name`, `date_of_birth`, `district`, `gender` FROM `players` ORDER BY `district`';
$result = mysqli_query($connection, $select_query);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Players</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="add_player.php" class="page-link">Add Player</a>
        </div>
    </div>
    <table id="players_table" class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>District</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Actions</th>
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
                        <?= $player['first_name'] . " " . $player['last_name'] ?>
                    </td>
                    <td><?= $player['district'] ?></td>
                    <td><?= $player['date_of_birth'] ?></td>
                    <td><?= $player['gender'] ?></td>
                    <td>
                        <a href="view_player.php?player_id=<?= base64_encode($player['id']); ?>">View</a> |
                        <a href="edit_player.php?player_id=<?= base64_encode($player['id']); ?>" class="text-success">Edit</a> |
                        <a href="delete_player.php?player_id=<?= base64_encode($player['id']); ?>" class="text-danger">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>
<script>
    $(document).ready(function() {
        $('#players_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-sm btn-primary',
                    title: 'Players',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
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
                    className: 'btn btn-sm btn-primary',
                    title: 'Players',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.styles.tableBodyEven.alignment = 'center';
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn btn-sm btn-primary',
                    title: 'Players',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                }
            ]
        });
    });
</script>
<?php include("footer.php"); ?>