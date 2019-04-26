<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

for($i = 1; $i <= count($_SESSION["games"]); $i++) {
    $g_id = intval($_SESSION["game_id_" . $i]);
    $g_ref = $bdd->query("SELECT SUBSTR(ref_games, 1, 6) FROM videogames WHERE id = " . $g_id)->fetch()[0];

    //title
    $g_title = $_POST["title_" . $i];

    //date
    $g_day = $_POST["game_" . $i . "_day"];
    $g_month = $_POST["game_" . $i . "_month"];
    $g_year = $_POST["game_" . $i . "_year"];
    $g_releaseDate = $g_day . " " . $g_month . " " . $g_year;

    //developer
    $g_developer_str = $_POST["developer_" . $i];
    $g_developer_id_query = $bdd->query("SELECT id FROM Developers WHERE developers.name = '" . $g_developer_str . "'");
    $g_developer_id = $g_developer_id_query->fetch()[0];

    //platform
    $g_platform_str = $_POST["platform_" . $i];
    $g_platform_id_query = $bdd->query("SELECT id FROM Platform WHERE platform.name = '" . $g_platform_str . "'");
    $g_platform_id = $g_platform_id_query->fetch()[0];

    //publisher
    $g_publisher_str = $_POST["publisher_" . $i];
    $g_publisher_id_query = $bdd->query("SELECT id FROM Publishers WHERE publishers.name = '" . $g_publisher_str . "'");
    $g_publisher_id = $g_publisher_id_query->fetch()[0];

    //kinds
    $g_kinds_str = [];
    if (isset($_POST["kinds_" . $i])) {
        $kinds = $_POST["kinds_" . $i];
        for ($j = 0; $j < count($kinds); $j++) {
            $g_kind_str = $_POST["kinds_" . $i][$j];
            $g_kind_id_query = $bdd->query("SELECT id FROM Genres WHERE genres.name = '" . $g_kind_str . "'");
            $g_kind_id = $g_kind_id_query->fetch()[0];
            $g_kinds_id[] = $g_kind_id;
        }


        $g_ids = $bdd->query("SELECT id FROM videogames INNER JOIN gamesgenres ON id = idVideoGame WHERE ref_games LIKE '" . $g_ref . "%' ORDER BY idGenre")->fetchAll(PDO::FETCH_OBJ);
        for ($k = 0; $k < count($g_ids); $k++){
            //deletes old kinds for each game's id of same reference
            $g_delete_old_entries_str = "DELETE FROM gamesgenres WHERE idVideoGame = " . $g_ids[$k]->id;
            $bdd->query($g_delete_old_entries_str);
        }
        for ($j = 0; $j < count($g_kinds_id); $j++) {
            $idGenre = intval($g_kinds_id[$j]);
            for ($k = 0; $k < count($g_ids); $k++){
                //inserts new kinds for each game's id of same reference
                $g_kinds_query_str = "INSERT INTO gamesgenres (idGenre, idVideoGame) VALUES (" . $idGenre . ", " . $g_ids[$k]->id . ")";
                $bdd->query($g_kinds_query_str);
            }
        }
    } else {
        $kinds = [];
    }
    
    $g_title_query_str = "UPDATE videogames SET Title = '" . $g_title . "' WHERE ref_games LIKE '" . $g_ref . "%'";
    $g_releaseDate_query_str = "UPDATE videogames SET ReleaseDate = '" . $g_releaseDate . "' WHERE ref_games LIKE '" . $g_ref . "%'";
    $g_developer_query_str = "UPDATE videogames SET idDeveloper = '" . $g_developer_id . "' WHERE ref_games LIKE '" . $g_ref . "%'";
    $g_platform_query_str = "UPDATE videogames SET idPlatform = '" . $g_platform_id . "' WHERE ref_games LIKE '" . $g_ref . "%'";
    $g_publisher_query_str = "UPDATE videogames SET idPublisher = '" . $g_publisher_id . "' WHERE ref_games LIKE '" . $g_ref . "%'";
    $bdd->query($g_title_query_str);
    $bdd->query($g_releaseDate_query_str);
    $bdd->query($g_developer_query_str);
    $bdd->query($g_platform_query_str);
    $bdd->query($g_publisher_query_str);
}
unset($_SESSION["games"]);
header("location:../../index.php");

//var_dump($query->fetchAll(PDO::FETCH_OBJ));
/*
function ref_remaker($pdo) {
    $query_string = "SELECT platform.name FROM Platform";
    $ref_query = $pdo->query($query_string);
    $selected = $ref_query->fetchAll(PDO::FETCH_OBJ);
    
    for ($i = 0; $i < count($selected); $i++) {
        
    }
    
}
ref_remaker($bdd);
*/
/*
$back_up_json = file_get_contents("../../datas/back_up.json");
$back_up_decoded = json_decode($back_up_json);
if (json_last_error_msg() > 0) {
    var_dump(json_last_error_msg());
}
var_dump(count($back_up_decoded));
for ($i = 0; $i < count($back_up_decoded); $i++) {
    $g_title = $back_up_decoded[$i]->Title;
    $back_up_title_query = "UPDATE videogames SET Title = '" . $g_title . "'";
    $bdd->query($back_up_title_query);
}
*/
