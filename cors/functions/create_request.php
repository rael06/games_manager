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

function getPostValue ($post) {
    if (isset($_POST[$post . "_1"]) && !empty($_POST[$post . "_1"])) {
        $g_post = $_POST[$post . "_1"];
    } else {
        $g_post = "null";
    }
    return $g_post;
}

function getPostValueID ($post, $bdd) {
    $postValue = getPostValue($post);
    if($postValue !== "null") {
        $id_query_str = "SELECT id FROM " . $post . " WHERE name = '" . $postValue . "'";
        $id = $bdd->query($id_query_str)->fetch(PDO::FETCH_OBJ)->id;
        return $id;
    } else return $postValue;
} 

$g_title = getPostValue("title");
$g_releaseDate = getReleaseDate();
$g_developer_id = getPostValueID("developers", $bdd);
$g_platform_id = getPostValueID("platform", $bdd);
$g_publisher_id = getPostValueID("publishers", $bdd);
$kinds = getPostValue("kinds");

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
$new_game_id = $bdd->query("SELECT id FROM videogames ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_OBJ)->id;
for ($k = 0; $k < count($kinds); $k++) {
    $g_new_game_gamesgenres_query_str = "INSERT INTO gamesgenres (idGenre, idVideoGame) VALUES (" . $g_kinds_id[$k] . ", " . $new_game_id . ")";
    var_dump($bdd->query($g_new_game_gamesgenres_query_str));
}

header("location: ../../index.php");
