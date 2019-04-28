<?php
$jsonStrPretty = "[]";

$bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$query = $bdd->query(
    'SELECT videogames.ID,
    Title, 
    ReleaseDate,
    Ref_games AS "References", 
    developers.NAME AS "Developers", 
    platform.NAME AS "Platform",
    platform.abbreviation AS "Abbreviation",
    constructor.NAME AS "Constructor", 
    GROUP_CONCAT(genres.NAME SEPARATOR ", ") AS "Kinds",
    publishers.NAME AS "Publishers"
    FROM videogames
    LEFT OUTER JOIN developers ON developers.id = idDeveloper
    LEFT OUTER JOIN platform ON idPlatform = platform.id
    LEFT OUTER JOIN constructor ON idConstructor = constructor.id
    LEFT OUTER JOIN gamesgenres ON idVideoGame = videogames.id
    LEFT OUTER JOIN genres ON idGenre = genres.id
    LEFT OUTER JOIN publishers ON idPublisher = publishers.id
    GROUP BY videogames.ID;'
    );
$listGames = $query->fetchAll(PDO::FETCH_OBJ);
require_once "json_manager.php";
