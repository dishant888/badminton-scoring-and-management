<?php
include("header.php");
$tournament_id = base64_decode($_GET['tournament_id']);

$search_query = "SELECT * FROM `tournaments` WHERE `id` = " . $tournament_id;
$result = mysqli_query($connection, $search_query);
$tournament = mysqli_fetch_array($result);

if (isset($_POST['generate_draws'])) {
    $size_of_draws = 2;
    $number_of_rounds = 1;
    $players = $_POST['players'];
    $no_of_players = count($players);

    while ($size_of_draws < $no_of_players) {
        $size_of_draws *= 2;
        $number_of_rounds++;
    }
    $rows = $size_of_draws / 4;

    shuffle($players);
    $no_of_bye = $size_of_draws - $no_of_players;
    $odd = 1;
    for ($n = 0; $n < $no_of_bye; $n++) {
        array_splice($players, $odd, 0, 0);
        $odd += 2;
    }

    $insert_query = '';
    $matches_bye_update_query = '';

    for ($i = 0; $i < $number_of_rounds; $i++) {
        $round_no = $i + 1;
        $m_no = 1;
        $next_m_no = 1;

        for ($j = 0; $j < $rows; $j++) {

            $match_no = "$tournament_id-$round_no-$m_no";
            $next_round_no = $round_no + 1;
            $next_match_no = "$tournament_id-$next_round_no-$next_m_no";
            if ($round_no == 1) {
                $player_a = array_pop($players);
                $player_b = array_pop($players);

                $insert_query .= "INSERT INTO `matches`(`match_no`,`next_match_no`,`tournament_id`,`round_no`,`player_a`,`player_b`) VALUES('$match_no','$next_match_no',$tournament_id,$round_no,$player_a,$player_b);";
                if ($player_a == 0) {
                    $matches_bye_update_query .= "UPDATE `matches` SET `winner` = $player_b WHERE `match_no` = '$match_no';";
                    if ($m_no % 2) {
                        $matches_bye_update_query .= "UPDATE `matches` SET `player_a` = $player_b WHERE `match_no` = '$next_match_no';";
                    } else {
                        $matches_bye_update_query .= "UPDATE `matches` SET `player_b` = $player_b WHERE `match_no` = '$next_match_no';";
                    }
                }

                $m_no++;
                $match_no = "$tournament_id-$round_no-$m_no";
                $player_a = array_pop($players);
                $player_b = array_pop($players);

                $insert_query .= "INSERT INTO `matches`(`match_no`,`next_match_no`,`tournament_id`,`round_no`,`player_a`,`player_b`) VALUES('$match_no','$next_match_no',$tournament_id,$round_no,$player_a,$player_b);";
                if ($player_a == 0) {
                    $matches_bye_update_query .= "UPDATE `matches` SET `winner` = $player_b WHERE `match_no` = '$match_no';";
                    if ($m_no % 2) {
                        $matches_bye_update_query .= "UPDATE `matches` SET `player_a` = $player_b WHERE `match_no` = '$next_match_no';";
                    } else {
                        $matches_bye_update_query .= "UPDATE `matches` SET `player_b` = $player_b WHERE `match_no` = '$next_match_no';";
                    }
                }
            } else {
                if ($round_no == $number_of_rounds) {
                    $insert_query .= "INSERT INTO `matches`(`match_no`,`tournament_id`,`round_no`) VALUES('$match_no',$tournament_id,$round_no);";
                } else {
                    $insert_query .= "INSERT INTO `matches`(`match_no`,`next_match_no`,`tournament_id`,`round_no`) VALUES('$match_no','$next_match_no',$tournament_id,$round_no);";
                    $m_no++;
                    $match_no = "$tournament_id-$round_no-$m_no";
                    $insert_query .= "INSERT INTO `matches`(`match_no`,`next_match_no`,`tournament_id`,`round_no`) VALUES('$match_no','$next_match_no',$tournament_id,$round_no);";
                }
            }
            $m_no++;
            $match_no = "";
            $next_m_no++;
            $next_match_no = "";
        }
        $rows /= 2;
    }
    $update_query = "UPDATE `tournaments` SET `draws_generated` = 1 WHERE `id` = $tournament_id";
    $insert_query .= $matches_bye_update_query;
    mysqli_query($connection, $update_query);
    mysqli_multi_query($connection, $insert_query);
    echo "<meta http-equiv='refresh' content='0'>"; // refresh the page
}
?>
<style>
    .won {
        background-color: #ff000029;
    }

    .lost {
        background-color: #00800022;
    }
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $tournament['name'] ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0 d-print-none">
            <div class="btn-group me-3" role="group" aria-label="Basic example">
                <button type="button" onclick="window.print()" class="page-link">Print</button>
                <a href="tournaments.php" class="page-link">Back</a>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs d-print-none" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="Overview" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="draws-tab" data-bs-toggle="tab" data-bs-target="#draws" type="button" role="tab" aria-controls="draws" aria-selected="false">Draws</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="matches-tab" data-bs-toggle="tab" data-bs-target="#matches" type="button" role="tab" aria-controls="matches" aria-selected="false">Matches</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <br>
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
                                    $class_a1 = '';
                                    $class_b1 = '';
                                    $class_a2 = '';
                                    $class_b2 = '';

                                    if ($match[$j]['winner'] != -1) {
                                        $class_a1 = $match[$j]['winner'] == $match[$j]['player_a'] ? "lost" : "won";
                                        $class_b1 = $match[$j]['winner'] == $match[$j]['player_b'] ? "lost" : "won";
                                    }

                                    if ($i == $round_count - 1) {
                                        $player_a_name = $match[$j]['pa_f'] . " " . $match[$j]['pa_l'];
                                        $player_b_name = $match[$j]['pb_f'] . " " . $match[$j]['pb_l'];
                                ?>
                                        <div class="playoff-table-group">
                                            <div class="playoff-table-pair playoff-table-pair-style">
                                                <div class="playoff-table-left-player <?= $class_a1 ?>"><?= $player_a_name ?></div>
                                                <div class="playoff-table-right-player <?= $class_b1 ?>"><?= $player_b_name ?></div>
                                            </div>
                                        </div>
                                    <?php } else {
                                        $player_a1_name = $match[$j]['player_a'] == 0 ? "Bye" : $match[$j]['pa_f'] . " " . $match[$j]['pa_l'];
                                        $player_b1_name = $match[$j]['player_b'] == 0 ? "Bye" :  $match[$j]['pb_f'] . " " . $match[$j]['pb_l'];
                                        $player_a2_name = $match[$j + 1]['player_a'] == 0 ? "Bye" : $match[$j + 1]['pa_f'] . " " . $match[$j + 1]['pa_l'];
                                        $player_b2_name = $match[$j + 1]['player_b'] == 0 ? "Bye" : $match[$j + 1]['pb_f'] . " " . $match[$j + 1]['pb_l'];

                                        if ($match[$j + 1]['winner'] != -1) {
                                            $class_a2 = $match[$j + 1]['winner'] == $match[$j + 1]['player_a'] ? "lost" : "won";
                                            $class_b2 = $match[$j + 1]['winner'] == $match[$j + 1]['player_b'] ? "lost" : "won";
                                        }

                                    ?>
                                        <div class="playoff-table-group">
                                            <div class="playoff-table-pair playoff-table-pair-style">
                                                <div class="playoff-table-left-player <?= $class_a1 ?>"><?= $player_a1_name ?></div>
                                                <div class="playoff-table-right-player <?= $class_b1 ?>"><?= $player_b1_name ?></div>
                                            </div>
                                            <div class="playoff-table-pair playoff-table-pair-style">
                                                <div class="playoff-table-left-player <?= $class_a2 ?>"><?= $player_a2_name ?></div>
                                                <div class="playoff-table-right-player <?= $class_b2 ?>"><?= $player_b2_name ?></div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>

                            </div>
                        <?php  } ?>
                    </div>
                </div>
                <br>
            <?php } else {
                $select_players_query = "SELECT `id`, `first_name`, `last_name`, `district` FROM `players` ORDER BY `district`";
                $result = mysqli_query($connection, $select_players_query);
            ?>
                <br>
                <form method="POST">
                    <table class="table table-hover table-bordered w-25">
                        <caption id="selected_count" class="d-print-none" style="caption-side: top;">0 selected</caption>
                        <thead>
                            <th class="d-print-none"><input type="checkbox" id="select_all"></th>
                            <th>Name</th>
                            <th>District</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($player = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="d-print-none">
                                        <input type="checkbox" class="checkbox" name="players[]" value="<?= $player['id'] ?>">
                                    </td>
                                    <td><?= $player['first_name'] . " " . $player['last_name'] ?></td>
                                    <td><?= $player['district'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <input type="submit" disabled id="generate_draw_btn" name="generate_draws" class="btn d-print-none btn-primary" value="Generate Draws">
                </form>
                <br>
            <?php } ?>
        </div>
        <div class="tab-pane fade" id="matches" role="tabpanel" aria-labelledby="matches-tab">
            <?php if ($tournament['draws_generated']) {
                $select_matches_query = "SELECT `matches`.*, pa.`first_name` AS pa_f, pa.`last_name` AS pa_l, pb.`first_name` AS pb_f, pb.`last_name` AS pb_l FROM `matches` LEFT JOIN `players` AS pa ON `matches`.`player_a` = pa.id LEFT JOIN `players` AS pb ON `matches`.`player_b` = pb.id WHERE `tournament_id` = $tournament_id AND (`player_a` > 0 AND `player_b` > 0)";
                $result = mysqli_query($connection, $select_matches_query);
            ?>
                <br>
                <table id="matches_table" class="table table-hover text-center">
                    <thead>
                        <th>#</th>
                        <th>Round</th>
                        <th>Match</th>
                        <th>Score</th>
                        <th>Duration</th>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        while ($match_row = mysqli_fetch_assoc($result)) {
                            $player_a = $match_row['pa_f'] . " " . $match_row['pa_l'];
                            $player_b = $match_row['pb_f'] . " " . $match_row['pb_l'];
                            $select_scores_query = "SELECT * FROM `scores` WHERE `match_no` = '" . $match_row['match_no'] . "'";
                            $scores_result = mysqli_query($connection, $select_scores_query);
                            $match_played = $scores_result->num_rows;
                        ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= $match_row['round_no'] ?></td>
                                <?php if ($match_played) {
                                    $score = mysqli_fetch_assoc($scores_result);
                                    $winner_score = $score['player_a_set_1'] . "-" . $score['player_b_set_1'] . ", " . $score['player_a_set_2'] . "-" . $score['player_b_set_2'] . ", " . $score['player_a_set_3'] . "-" . $score['player_b_set_3']
                                ?>
                                    <td>
                                        <b class="text-<?= $match_row['winner'] == $match_row['player_a'] ? 'success' : 'danger'; ?>"><?= $player_a ?></b>
                                        VS
                                        <b class="text-<?= $match_row['winner'] == $match_row['player_b'] ? 'success' : 'danger'; ?>"><?= $player_b ?></b>
                                    </td>
                                    <td>
                                        <?= $winner_score ?>
                                    </td>
                                    <td>
                                        <?= $score['duration'] ?>
                                    </td>
                                <?php } else { ?>
                                    <td><?= $player_a ?> VS <?= $player_b ?></td>
                                    <td>
                                        <a style="text-decoration: none;" href="start_match.php?match_no=<?= base64_encode($match_row['match_no']) ?>">Start Match</a>
                                    </td>
                                    <td>
                                        --
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
            <?php } else {
            ?>
                <br>
                <h5 class="text-center">Please generate draws first</h5>
            <?php } ?>
        </div>
    </div>
</main>
<script>
    function getSelectedCount() {
        var count = $('input.checkbox:checked').length;
        return count;
    }

    $('#select_all').on('click', function() {
        var checked = $(this).is(':checked');
        if (checked) {
            $('input.checkbox').attr('checked', true);
        } else {
            $('input.checkbox').attr('checked', false);
        }
    });

    $('input:checkbox').on('change', function() {
        $('#selected_count').text(getSelectedCount() + ' selected');
        if (getSelectedCount() >= 3) {
            $('#generate_draw_btn').attr('disabled', false);
        } else {
            $('#generate_draw_btn').attr('disabled', true);
        }
    });

    $('#matches_table').dataTable({
        paging: false
    });
</script>
<?php include("footer.php"); ?>