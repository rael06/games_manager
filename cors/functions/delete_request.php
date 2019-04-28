<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$g_ids = [];
for ($i = 1; $i <= count($_SESSION["games"]); $i++) {
    $g_ids[] = $_SESSION["game_id_" . $i];
    unset($_SESSION["game_id_" . $i]);
}
foreach ($g_ids as $id) {
    $g_delete_query_str = "DELETE FROM videogames WHERE id = " . $id;
    $bdd->query($g_delete_query_str);
}
header("location:../../index.php");