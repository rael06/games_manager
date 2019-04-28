<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$dataStr = file_get_contents( "php://input" );
$dataArray = json_decode( $dataStr );

foreach ($dataArray as $key => $data) {
    $g_delete_query_str = "DELETE FROM videogames WHERE id = " . $data->ID;
    $bdd->query($g_delete_query_str);
}

$returnMessage = new stdClass();
$returnMessage->status = true;
$returnMessage->mesChecked = $dataArray;
$returnMessage->message = "Blabla";
print(json_encode($returnMessage));