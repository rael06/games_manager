<?php
$datetime = new DateTime();
$releaseDate_array = [];
$actual_year = $datetime->format("Y");
if (!isset($_POST["game"])) {
    $actual_day = $datetime->format("d");
    $actual_month = $datetime->format("m");
    switch ($actual_month) {
        case "01":
            $actual_month = "January";
            break;
        case "02":
            $actual_month = "February";
            break;
        case "03":
            $actual_month = "March";
            break;
        case "04":
            $actual_month = "April";
            break;
        case "05":
            $actual_month = "May";
            break;
        case "06":
            $actual_month = "June";
            break;
        case "07":
            $actual_month = "July";
            break;
        case "08":
            $actual_month = "August";
            break;
        case "09":
            $actual_month = "September";
            break;
        case "11":
            $actual_month = "October";
            break;
        case "11":
            $actual_month = "November";
            break;
        case "12":
            $actual_month = "December";
            break;
        default:
            $actual_month = "January";
            break;
    }
    $releaseDate_array[]= $actual_day;
    $releaseDate_array[]= $actual_month;
    $releaseDate_array[]= $actual_year;
} else {
    $releaseDate_array = explode(" ", $game->ReleaseDate);
}
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
        