<?php
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
    $games_references = games_reference($_SESSION["listGames"]);
    
    $bdd_test = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    function references_maker($games_references_array, $bdd) {
        for($i = 0; $i < count($games_references_array); $i++) {
            $update_query_str = "UPDATE videogames SET Ref_games = '" . $games_references_array[$i] . "' WHERE id = " . ($i + 1);
            $bdd->query($update_query_str);
        }
    }

    references_maker($games_references, $bdd_test);