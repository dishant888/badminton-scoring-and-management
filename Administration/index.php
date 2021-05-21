<?php
include("header.php");

$select_player_query = "SELECT COUNT(`id`) AS total FROM `players`";
$players = mysqli_fetch_assoc(mysqli_query($connection, $select_player_query));

$select_tournament_query = "SELECT COUNT(`id`) AS total FROM `tournaments`";
$tournaments = mysqli_fetch_assoc(mysqli_query($connection, $select_tournament_query));
?>
<style>
    .box {
        min-height: 150px;
    }

    a {
        text-decoration: none;
    }
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4 box box-p bg-primary offset-1 border">
                <br><br>
                <h1 class="text-center text-white"><?= $players['total'] ?> Players</h1>
                <br>
                <a class="text-white" href="add_player.php">Add Player</a>
                <a class="text-white float-end" href="players.php">View Players</a>
            </div>
            <div class="col-4 box box-p bg-primary offset-1 border">
                <br><br>
                <h1 class="text-center text-white"><?= $tournaments['total'] ?> Tournaments</h1>
                <br>
                <a class="text-white" href="add_tournament.php">Add tournament</a>
                <a class="text-white float-end" href="tournaments.php">View tournaments</a>
            </div>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>