<?php
session_start();
var_dump($_POST);
var_dump($_SESSION);
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

for($i = 1; $i <= count($_SESSION["games"]); $i++) {
    $g_id = intval($_SESSION["game_id_" . $i]);

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
    


    $g_title_query_str = "UPDATE videogames SET Title = '" . $g_title . "' WHERE videogames.id = " . $g_id .";";
    $g_releaseDate_query_str = "UPDATE videogames SET ReleaseDate = '" . $g_releaseDate . "' WHERE videogames.id = " . $g_id .";";
    $g_developer_query_str = "UPDATE videogames SET idDeveloper = '" . $g_developer_id . "' WHERE videogames.id = " . $g_id .";";
    $g_platform_query_str = "UPDATE videogames SET idPlatform = '" . $g_platform_id . "' WHERE videogames.id = " . $g_id .";";
    $g_publisher_query_str = "UPDATE videogames SET idPublisher = '" . $g_publisher_id . "' WHERE videogames.id = " . $g_id .";";
    $bdd->query($g_title_query_str);
    $bdd->query($g_releaseDate_query_str);
    $bdd->query($g_developer_query_str);
    $bdd->query($g_platform_query_str);
    $bdd->query($g_publisher_query_str);
}

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
