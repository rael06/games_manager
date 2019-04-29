<?php
include "./request.php";
include "./reference_maker.php";
include "./request.php";

function requestJson($array) {




    $jsonStr = json_encode($array);
    if (json_last_error_msg() > 0) {
        var_dump(json_last_error_msg());
    }
    return $jsonStr;
}

print( requestJson($_SESSION["listGames"]) );
