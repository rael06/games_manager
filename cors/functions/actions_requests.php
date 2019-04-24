<?php
var_dump($_POST);
$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$query = $bdd->query("SELECT Title FROM videogames");
// var_dump($query->fetchAll(PDO::FETCH_OBJ));