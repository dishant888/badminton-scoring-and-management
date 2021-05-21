<?php
include("header.php");

$tournament_id = base64_decode($_GET['tournament_id']);

$search_query = "SELECT * FROM `tournaments` WHERE `id` = " . $tournament_id;
$result = mysqli_query($connection, $search_query);
$tournament = mysqli_fetch_array($result);
?>
<style>
    .playoff-table .playoff-table-pair:before,
    .playoff-table .playoff-table-group:after,
    .playoff-table .playoff-table-left-player:before {
        background-color: green;
    }
</style>
<main class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h3><?= $tournament['name'] ?></h3>
        </div>
    </div>

    <ul class="nav nav-tabs d-print-none" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="Overview" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="draws-tab" data-bs-toggle="tab" data-bs-target="#draws" type="button" role="tab" aria-controls="draws" aria-selected="false">Draws</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <br>
            <h3><?= $tournament['organised_by'] ?></h3>
            <br>
            <p>
                <b>Venue: </b><?= $tournament['venue'] ?><br>
                <b>Address: </b><?= $tournament['address'] ?><br>
            </p>
            <h4>Tournament Contact</h4>
            <p>
                <b>Name:</b> <?= $tournament['contact_name'] ?><br>
                <b>Number:</b> <?= $tournament['contact_number'] ?><br>
                <b>Email:</b> <?= $tournament['contact_email'] ?>
            </p>
            <h4>Tournament Days</h4>
            <p>
                <?= $tournament['start_date'] ?> to <?= $tournament['end_date'] ?>
            </p>
        </div>

        <div class="tab-pane fade" id="draws" role="tabpanel" aria-labelledby="draws-tab">
            <?php if ($tournament['draws_generated']) {

                $round_query = "SELECT `id` FROM `matches` WHERE `tournament_id` = $tournament_id GROUP BY `round_no`";
                $result = mysqli_query($connection, $round_query);
                $round_count = $result->num_rows;

                $rounds = array();
                for ($i = 0; $i < $round_count; $i++) {
                    $r_no = $i + 1;
                    $select_query = "SELECT `matches`.*, pa.`first_name` AS pa_f, pa.`last_name` AS pa_l, pb.`first_name` AS pb_f, pb.`last_name` AS pb_l FROM `matches` LEFT JOIN `players` AS pa ON `matches`.`player_a` = pa.id LEFT JOIN `players` AS pb ON `matches`.`player_b` = pb.id WHERE `matches`.`tournament_id` = $tournament_id AND `matches`.`round_no` = $r_no;";
                    $result = mysqli_query($connection, $select_query);
                    $matches = array();
                    while ($match = mysqli_fetch_assoc($result)) {
                        array_push($matches, $match);
                    }
                    $rounds[$i] = $matches;
                }
            ?>
                <div class="playoff-table">
                    <div class="playoff-table-content">
                        <?php for ($i = 0; $i < count($rounds); $i++) {
                            $match = $rounds[$i];
                        ?>
                            <div class="playoff-table-tour">

                                <?php for ($j = 0; $j < count($match); $j += 2) {
                                    if ($i == $round_count - 1) {
                                ?>
                                        <div class="playoff-table-group">
                                            <div class="playoff-table-pair playoff-table-pair-style">
                                                <div class="playoff-table-left-player"><?= $match[$j]['pa_f'] . " " . $match[$j]['pa_l'] ?></div>
                                                <div class="playoff-table-right-player"><?= $match[$j]['pb_f'] . " " . $match[$j]['pb_l'] ?></div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="playoff-table-group">
                                            <div class="playoff-table-pair playoff-table-pair-style">
                                                <div class="playoff-table-left-player"><?= $match[$j]['player_a'] == 0 ? "Bye" : $match[$j]['pa_f'] . " " . $match[$j]['pa_l'] ?></div>
                                                <div class="playoff-table-right-player"><?= $match[$j]['player_b'] == 0 ? "Bye" :  $match[$j]['pb_f'] . " " . $match[$j]['pb_l'] ?></div>
                                            </div>
                                            <div class="playoff-table-pair playoff-table-pair-style">
                                                <div class="playoff-table-left-player"><?= $match[$j + 1]['player_a'] == 0 ? "Bye" : $match[$j + 1]['pa_f'] . " " . $match[$j + 1]['pa_l'] ?></div>
                                                <div class="playoff-table-right-player"><?= $match[$j + 1]['player_b'] == 0 ? "Bye" : $match[$j + 1]['pb_f'] . " " . $match[$j + 1]['pb_l'] ?></div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>

                            </div>
                        <?php  } ?>
                    </div>
                </div>
            <?php } else {
            ?>
                <br><br>
                <h5 class="text-center">Draws will be updated soon</h5>
            <?php } ?>
        </div>
    </div>

</main>
<?php include("footer.php"); ?>