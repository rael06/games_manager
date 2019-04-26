<?php
function get_column ($column) {
    $videogames_bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $column_query = $videogames_bdd->query("SELECT name FROM " . $column . " ORDER BY name");
    return $column_query->fetchAll(PDO::FETCH_OBJ);
}
