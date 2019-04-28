<?php
var_dump($_POST);

$game_number = 0;
if(isset($_POST["game"])) {
    $_SESSION["games"] = $_POST["game"];
    foreach($_POST["game"] as $object) {
        $game = json_decode($object);
        $game_number++;
        $_SESSION["game_id_" . $game_number] = $game->ID;
    }
}
?>