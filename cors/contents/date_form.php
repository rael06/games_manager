<?php
$datetime = new DateTime();
$actual_year = $datetime->format("Y");
$releaseDate_array = explode(" ", $game->ReleaseDate);
$releaseDate_day = $releaseDate_array[0];
$releaseDate_month = $releaseDate_array[1];
$releaseDate_year = $releaseDate_array[2];
?>
<label for="date">Date :</label>
<div class="date_form">
    <select name="game_<?= $game_number ?>_day">
        <option type="text" value="<?= $releaseDate_day ?>"><?= $releaseDate_day ?></option>
        <?php for ($i = 1; $i <= 31; $i++) : ?>
            <option type="text" value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <select name="game_<?= $game_number ?>_month">
        <option type="text" value="<?= $releaseDate_month ?>"><?= $releaseDate_month ?></option>
        <option type="text" value="January">Janvier</option>
        <option type="text" value="February">Février</option>
        <option type="text" value="March">Mars</option>
        <option type="text" value="April">Avril</option>
        <option type="text" value="May">Mai</option>
        <option type="text" value="June">Juin</option>
        <option type="text" value="July">Juillet</option>
        <option type="text" value="August">Août</option>
        <option type="text" value="September">Septembre</option>
        <option type="text" value="October">Octobre</option>
        <option type="text" value="November">Novembre</option>
        <option type="text" value="December">Décembre</option>
    </select>
    <select name="game_<?= $game_number ?>_year">
        <option type="text" value="<?= $releaseDate_year ?>"><?= $releaseDate_year ?></option>
        <?php for ($i = 1950; $i <= $actual_year; $i++) : ?>
            <option type="text" value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select>
</div>
        