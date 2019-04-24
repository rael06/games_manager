<?php
session_start();
var_dump($_POST);
var_dump($_SESSION);
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
/*for($i = 1; $i <= count($_SESSION["games"]); $i++) {
    $g_id = intval($_SESSION["game_id_" . $i]);
    $g_title = $_POST["title_" . $i];
    $test = "UPDATE videogames SET Title = '" . $g_title . "' WHERE videogames.id = " . $g_id;
    var_dump($test);
    $bdd->query($test);
}*/
//var_dump($query->fetchAll(PDO::FETCH_OBJ));


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
