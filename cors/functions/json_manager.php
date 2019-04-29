<?php

function requestJson($array) {

    include "reference_maker.php";



    $jsonStrPretty = json_encode($array, JSON_PRETTY_PRINT);
    if (json_last_error_msg() > 0) {
        var_dump(json_last_error_msg());
    }
    return $jsonStrPretty;
}

print( requestJson($listGames) );
