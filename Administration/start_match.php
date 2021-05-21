<?php
include("header.php");
$match_no = base64_decode($_GET['match_no']);
$tournament_id = base64_encode(explode('-', $match_no)[0]);
$m_no = explode('-', $match_no)[2];

$select_match_query = "SELECT `matches`.*, pa.`first_name` AS pa_f, pa.`last_name` AS pa_l, pb.`first_name` AS pb_f, pb.`last_name` AS pb_l FROM `matches` LEFT JOIN `players` AS pa ON `matches`.`player_a` = pa.id LEFT JOIN `players` AS pb ON `matches`.`player_b` = pb.id WHERE `matches`.`match_no` = '$match_no'";
$result = mysqli_query($connection, $select_match_query);
$match = mysqli_fetch_assoc($result);
$player_a = $match['pa_f'] . " " . $match['pa_l'];
$player_b = $match['pb_f'] . " " . $match['pb_l'];
$next_match_no = $match['next_match_no'];


if (isset($_POST['submit'])) {

    $duration = $_POST['duration'];
    $player_a_set_1 = $_POST['player_a_set_1'];
    $player_b_set_1 = $_POST['player_b_set_1'];
    $player_a_set_2 = $_POST['player_a_set_2'];
    $player_b_set_2 = $_POST['player_b_set_2'];
    $player_a_set_3 = $_POST['player_a_set_3'];
    $player_b_set_3 = $_POST['player_b_set_3'];

    $player_a_sum = $player_a_set_1 + $player_a_set_2 + $player_a_set_3;
    $player_b_sum = $player_b_set_1 + $player_b_set_2 + $player_b_set_3;
    $winner = ($player_a_sum > $player_b_sum) ? $match['player_a'] : $match['player_b'];
    $player = ($m_no % 2) ? 'player_a' : 'player_b';

    $queries = "INSERT INTO `scores`(`match_no`,`player_a_set_1`,`player_b_set_1`,`player_a_set_2`,`player_b_set_2`,`player_a_set_3`,`player_b_set_3`,`duration`) VALUES('$match_no',$player_a_set_1,$player_b_set_1,$player_a_set_2,$player_b_set_2,$player_a_set_3,$player_b_set_3,'$duration');";
    $queries .= "UPDATE `matches` SET `winner` = $winner WHERE `match_no` = '$match_no';";
    $queries .= "UPDATE `matches` SET `$player` = $winner WHERE `match_no` = '$next_match_no';";
    mysqli_multi_query($connection, $queries);
    echo '<META HTTP-EQUIV="refresh" content="0;URL=view_tournament.php?tournament_id=' . $tournament_id . '">';
}

?>
<style>
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4><?= $player_a ?> VS <?= $player_b ?></h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <h4><label id="minutes">00</label>:<label id="seconds">00</label></h4>
            <button class="page-link ms-4" onclick="history.back();">Back</button>
        </div>
    </div>
    <form class="row p-2 p-lg-0 m-3" method="POST">
        <input type="hidden" name="duration" id="duration" value="00:00">
        <div class="col-12 col-sm-6 col-lg-4 border p-3 mb-3">
            <div class="row text-center">
                <div class="col-12 border-bottom pb-1">
                    <h5>SET - 1</h5>
                    <div class="row">
                        <div class="col-6 border-end">
                            <b><?= $player_a ?></b>
                        </div>
                        <div class="col-6 border-start">
                            <b><?= $player_b ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-6 border-end">
                            <div class="input-group">
                                <button type="button" class="input-group-text decrement" disabled>-</button>
                                <input type="text" name="player_a_set_1" min=0" class="form-control text-center score" value="0">
                                <button type="button" class="input-group-text increment">+</button>
                            </div>
                        </div>
                        <div class="col-6 border-start">
                            <div class="input-group">
                                <button type="button" class="input-group-text decrement" disabled>-</button>
                                <input type="text" name="player_b_set_1" class="form-control text-center score" value="0">
                                <button type="button" class="input-group-text increment">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 border p-3 mb-3">
            <div class="row text-center">
                <div class="col-12 border-bottom pb-1">
                    <h5>SET - 2</h5>
                    <div class="row">
                        <div class="col-6 border-end">
                            <b><?= $player_a ?></b>
                        </div>
                        <div class="col-6 border-start">
                            <b><?= $player_b ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-6 border-end">
                            <div class="input-group">
                                <button type="button" class="input-group-text decrement" disabled>-</button>
                                <input type="text" name="player_a_set_2" class="form-control text-center score" value="0">
                                <button type="button" class="input-group-text increment">+</button>
                            </div>
                        </div>
                        <div class="col-6 border-start">
                            <div class="input-group">
                                <button type="button" class="input-group-text decrement" disabled>-</button>
                                <input type="text" name="player_b_set_2" class="form-control text-center score" value="0">
                                <button type="button" class="input-group-text increment">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 offset-sm-3 offset-lg-0 col-lg-4 border p-3 mb-3">
            <div class="row text-center">
                <div class="col-12 border-bottom pb-1">
                    <h5>SET - 3</h5>
                    <div class="row">
                        <div class="col-6 border-end">
                            <b><?= $player_a ?></b>
                        </div>
                        <div class="col-6 border-start">
                            <b><?= $player_b ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-6 border-end">
                            <div class="input-group">
                                <button type="button" class="input-group-text decrement" disabled>-</button>
                                <input type="text" name="player_a_set_3" class="form-control text-center score" value="0">
                                <button type="button" class="input-group-text increment">+</button>
                            </div>
                        </div>
                        <div class="col-6 border-start">
                            <div class="input-group">
                                <button type="button" class="input-group-text decrement" disabled>-</button>
                                <input type="text" name="player_b_set_3" class="form-control text-center score" value="0">
                                <button type="button" class="input-group-text increment">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <br>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary w-50">
            </div>
        </div>
    </form>
</main>
<script>
    var sec = 0;

    function pad(val) {
        return val > 9 ? val : "0" + val;
    }
    setInterval(function() {
        sec++;
        $("#seconds").html(pad(sec % 60));
        $("#minutes").html(pad(parseInt(sec / 60, 10)));
        $('#duration').val(pad(parseInt(sec / 60, 10)) + ":" + pad(sec % 60));
    }, 1000);

    $('button.increment').on('click', function() {
        var input = $(this).closest('div.input-group').find('input.score');
        var score = input.val();
        score++;
        input.val(score);
        var dec = $(this).closest('div.input-group').find('button.decrement');
        (score > 0) ? dec.attr('disabled', false): dec.attr('disabled', true);
    });
    $('button.decrement').on('click', function() {
        var input = $(this).closest('div.input-group').find('input.score');
        var score = input.val();
        score--;
        input.val(score);
        (score > 0) ? $(this).attr('disabled', false): $(this).attr('disabled', true);
    });
</script>
<?php include("footer.php") ?>