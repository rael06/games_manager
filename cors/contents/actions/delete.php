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
} else {
    
}

die;
?>
<div class="overlay"></div>
<div class="pop_up">
    <p class="pop_up_text">Confirmez-vous la suppression ?</p>
    <form action="cors/functions/delete_request.php" method="POST">
        <button class="cancel_button action_button" type="submit" name="cancel" value="cancel">Annuler</button>
        <button class="confirm_button action_button" type="submit" name="confirm" value="confirm">Confirmer</button>
        <input class="close_button" type="submit" name="close" value="X">
    </form>
</div>