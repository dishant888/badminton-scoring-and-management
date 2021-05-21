<?php
include("header.php");
$select_query = 'SELECT * FROM `tournaments` ORDER BY `id` DESC';
$result = mysqli_query($connection, $select_query);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tournaments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="add_tournament.php" class="page-link">Add Tournament</a>
        </div>
    </div>
    <table id="tournaments_table" class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Tournament Name</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($tournament = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><a href="view_tournament.php?tournament_id=<?= base64_encode($tournament['id']) ?>"><?= $tournament['name'] ?></a></td>
                    <td><?= $tournament['start_date'] ?></td>
                    <td><?= $tournament['end_date'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>
<script>
    $(document).ready(function() {
        $('#tournaments_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-sm btn-primary',
                    title: 'Tournaments',
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
                    title: 'Tournaments',
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
                    title: 'Tournaments',
                }
            ]
        });
    });
</script>
<?php include("footer.php"); ?>