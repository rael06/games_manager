<?php
$jsonStrPretty = "[]";

$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$query = $bdd->query(
    'SELECT videogames.ID,
    Title, 
    ReleaseDate,
    developers.NAME AS "Developers", 
    platform.NAME AS "Platform",
    platform.abbreviation AS "abbreviation",
    constructor.NAME AS "Constructor", 
    genres.NAME AS "Kinds",
    publishers.NAME AS "Publishers"
    FROM videogames
    INNER JOIN developers ON developers.id = idDeveloper
    INNER JOIN platform ON idPlatform = platform.id
    INNER JOIN constructor ON idConstructor = constructor.id
    INNER JOIN gamesgenres ON idVideoGame = videogames.id
    INNER JOIN genres ON idGenre = genres.id
    INNER JOIN publishers ON idPublisher = publishers.id;'
    );

require_once "class/Games.php";
$listGames = $query->fetchAll(PDO::FETCH_OBJ);
require_once "json_manager.php";