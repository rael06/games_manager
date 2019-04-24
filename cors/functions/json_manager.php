<?php
$json = "datas/sql_request.json";

function requestJson($jsonToWrite, $array) {
    for ($i = 0; $i < count($array) - 1; $i++) {
        $id = $array[$i]->ID;
        $idNext = $array[$i + 1]->ID;
        if ($id === $idNext) {
            $array[$i]->Kinds = $array[$i]->Kinds . " " . $array[$i + 1]->Kinds;
            array_splice($array, $i + 1, 1);
        }
    }
// to be continued.. references
/*
    for ($i = 0; $i < count($array) - 1; $i++) {
        $title = $array[$i]->Title;
        $titleNext = $array[$i + 1]->Title;
        $abbreviation = $array[$i]->abbreviation;
        if ($title === $titleNext) {
            //$array[$i]->Kinds = $array[$i]->Kinds . " " . $array[$i + 1]->Kinds;
        } else {
            echo $abbreviation . " : " . $i . "<br>";
        }
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
