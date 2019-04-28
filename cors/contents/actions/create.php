<?php
include "cors/functions/get_column.php";
$constructors = get_column("constructor");
$developers = get_column("developers");
$platforms = get_column("platform");
$kinds = get_column("genres");
$publishers = get_column("publishers");
unset($_SESSION["games"]);
$game_number = 1;
$_SESSION["game_id_" . $game_number] = 1
?>
<form action="cors/functions/create_request.php" method="POST">
    <div class="game_form">
    <div class="field">
        <label for="title">Titre :</label>
        <input type="text" name="title_<?= $game_number ?>" value="">
    </div>
    <div class="field">
        <?php include "cors/contents/date_form.php" ?>
    </div>
    <div class="field">
        <label for="developer">Développeur :</label>
        <select name="developers_<?= $game_number ?>">
            <option type="text" value=""></option>
            <?php
            foreach ($developers as $developer) :
            ?>
            <option type="text" value="<?= $developer->name ?>"><?= $developer->name ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="field">
        <label for="platform">Console :</label>
        <select name="platform_<?= $game_number ?>">
            <option type="text" value=""></option>
            <?php
            foreach ($platforms as $platform) :
            ?>
            <option type="text" value="<?= $platform->name ?>"><?= $platform->name ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="field">
        <label for="publisher">Éditeur :</label>
        <select name="publishers_<?= $game_number ?>">
            <option type="text" value=""></option>
            <?php
            foreach ($publishers as $publisher) :
            ?>
            <option type="text" value="<?= $publisher->name ?>"><?= $publisher->name ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="kinds_update">
        <label for="kind">Genre :</label>
        <span></span>
        <br>
        <div class="kinds_checkboxxes">
            <?php

            foreach ($kinds as $kind) :
            ?>
            <div class="choices">
                <input class="kinds_checkbox" type="checkbox" name="kinds_<?= $game_number ?>[]" value="<?= $kind->name ?>"><?= $kind->name ?></option>
            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
    <button type="submit" name="form_type_send" value="create_send">Envoyer</button>
    </div>
</form>