<?php
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// "_1_" is included in variables cause i need it from the file "date_form.php" that is used for "update_request.php" too

function getReleaseDate() {
    //date
    $g_day = $_POST["game_1_day"]?:NULL;
    $g_month = $_POST["game_1_month"]?:NULL;
    $g_year = $_POST["game_1_year"]?:NULL;

    $g_releaseDate = $g_day . $g_month . $g_year;
    return empty($g_releaseDate) ? "" : trim($g_day . $g_month . $g_year);
}

function getPostValues ($post) {
    if (isset($_POST[$post . "_1"]) && !empty($_POST[$post . "_1"])) {
        $g_post = $_POST[$post . "_1"];
    } else {
        $g_post = "null";
    }
    return $g_post;
}

$g_title = getPostValues("title");
$g_releaseDate = getReleaseDate();
$g_developer_id = getPostValues("developer");
$g_platform_id = getPostValues("platform");
$g_publisher_id = getPostValues("publisher");
$kinds = getPostValues("kinds");

//kinds
if (isset($_POST["kinds_1"])) {
    $kinds = $_POST["kinds_1"];
    for ($j = 0; $j < count($kinds); $j++) { // to find kinds id
        $g_kind_str = $_POST["kinds_1"][$j];
        $g_kind_id_query = $bdd->query("SELECT id FROM Genres WHERE genres.name = '" . $g_kind_str . "'");
        $g_kind_id = $g_kind_id_query->fetch()[0];
        $g_kinds_id[] = $g_kind_id;
    }
} else {
    $kinds = [];
}


$g_new_game_query_str = "INSERT INTO videogames (Title, ReleaseDate, idDeveloper, idPlatform, idPublisher) VALUES ('" . $g_title . "', '" . $g_releaseDate . "', " . $g_developer_id . ", " . $g_platform_id . ", " . $g_publisher_id . ")";
$bdd->query($g_new_game_query_str);
$new_game_id = $bdd->query("SELECT id FROM videogames ORDER BY id DESC LIMIT 1")->fetch()[0];
for ($k = 0; $k < count($kinds); $k++) {
    $g_new_game_gamesgenres_query_str = "INSERT INTO gamesgenres (idGenre, idVideoGame) VALUES (" . $g_kinds_id[$k] . ", " . $new_game_id . ")";
    $bdd->query($g_new_game_gamesgenres_query_str);
}
header("location: ../../index.php");
