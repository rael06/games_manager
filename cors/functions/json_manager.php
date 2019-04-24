<?php
$json = "datas/sql_request.json";

function requestJson($jsonToWrite, $array) {
/*
    // references
    function games_reference($array) {
        $letter = "A";
        $num = 1;
        $references = [];
        $title_1 = $array[1]->Title;
        $title_0 = $array[0]->Title;
        $abbreviation = $array[1]->Abbreviation;
        $reference = $abbreviation . str_pad($num, 3, "0", STR_PAD_LEFT) . "A";
        if ($title_1 !== $title_0) {
            $num++;
        }
        $references[] = $reference;

        for ($i = 1; $i < count($array); $i++) {
            $title = $array[$i]->Title;
            $titlePrev = $array[$i - 1]->Title;
            $abbreviation = $array[$i]->Abbreviation;
            if ($title !== $titlePrev) {
                $num++;
                $letter = "A";
            } else {
                $letter++;
            }
            $reference = $abbreviation . str_pad($num, 3, "0", STR_PAD_LEFT) . $letter;
            $references[] = $reference;
        }
        return $references;
    }
*/
/*
    $games_references = games_reference($array);

    $bdd_test = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    for($i = 0; $i < count($games_references); $i++) {
        $query_test = "UPDATE videogames SET Ref_games = '" . $games_references[$i] . "' WHERE id = " . ($i + 1);
        var_dump($query_test);
        $query = $bdd_test->query($query_test);
        var_dump($query);
    }
*/

    $jsonStrPretty = json_encode($array, JSON_PRETTY_PRINT);
    if (json_last_error_msg() > 0) {
        var_dump(json_last_error_msg());
    }
    $jsonStrPretty = "var datas = " . $jsonStrPretty;
    file_put_contents($jsonToWrite, $jsonStrPretty);
}

requestJson($json, $listGames);
