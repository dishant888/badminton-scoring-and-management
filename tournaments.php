<?php
include("header.php");
$select_query = 'SELECT * FROM `tournaments` ORDER BY `id` DESC';
$result = mysqli_query($connection, $select_query);
?>
<main class="container">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <h3>Tournaments</h3>
        </div>
    </div>
    <?php while ($tournament = mysqli_fetch_assoc($result)) { ?>
        <div class="row">
            <div class="col-12 ps-5 pe-5">
                <h4><a style="text-decoration: none;" href="view_tournament.php?tournament_id=<?= base64_encode($tournament['id']) ?>"><?= $tournament['name'] ?></a></h4>
                <br>
                <p>
                    <b><?= $tournament['organised_by'] ?></b> | <?= $tournament['venue'] ?>
                    <br>
                    <b><?= $tournament['start_date'] ?></b> to <b><?= $tournament['end_date'] ?></b>
                </p>
            </div>
            <hr>
        </div><br>
    <?php } ?>
</main>
<?php include("footer.php"); ?>