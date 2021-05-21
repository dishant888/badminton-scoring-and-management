<?php
include("header.php");
$player_id = $_GET['player_id'];

$delete_query = "DELETE FROM `players` WHERE `id` = " . base64_decode($player_id);
mysqli_query($connection, $delete_query);

include("footer.php");
?>
<script type="text/javascript">
    window.location.href = history.back();
</script>