<div class="update">
    <?php
    function get_column ($column) {
        $videogames_bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $column_query = $videogames_bdd->query("SELECT name FROM " . $column);
        return $column_query->fetchAll(PDO::FETCH_OBJ);
    }

    $constructors = get_column("constructor");
    $developers = get_column("developers");
    $platforms = get_column("platform");
    $kinds = get_column("genres");
    $publishers = get_column("publishers");
    ?>
    <form action="cors/functions/actions_requests.php" method="POST">
        <div class="forms">
        <?php
        $game_number = 0;
        foreach($_POST["game"] as $object) :
            $game = json_decode($object);
            $game_number++;
            ?>
            <div class="game_form">
                <div class="field">
                    <label for="title">Titre :</label>
                    <input type="text" name="title_<?= $game_number ?>" value="<?= $game->Title ?>">
                </div>
                <div class="field">
                    <!-- <input type="text" name="date" value="<?php // $game->ReleaseDate ?>"> -->
                    <?php include "cors/contents/date_form.php" ?>
                </div>
                <div class="field">
                    <label for="developer">Développeur :</label>
                    <select name="developer_<?= $game_number ?>">
                        <option type="text" value="<?= $game->Developers ?>"><?= $game->Developers ?></option>
                        <?php
                        foreach ($developers as $developer) :
                        ?>
                        <option type="text" value="<?= $developer->name ?>"><?= $developer->name ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="field">
                    <label for="platform">Console :</label>
                    <select name="platform_<?= $game_number ?>">
                        <option type="text" value="<?= $game->Platform ?>"><?= $game->Platform ?></option>
                        <?php
                        foreach ($platforms as $platform) :
                        ?>
                        <option type="text" value="<?= $platform->name ?>"><?= $platform->name ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="field">
                    <label for="constructor">Constructeur :</label>
                    <select name="constructor_<?= $game_number ?>">
                        <option type="text" value="<?= $game->Constructor ?>"><?= $game->Constructor ?></option>
                        <?php
                        foreach ($constructors as $constructor) :
                        ?>
                        <option type="text" value="<?= $constructor->name ?>"><?= $constructor->name ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="field">
                    <label for="kind">Genre :</label>
                    <select name="kind_<?= $game_number ?>">
                        <option type="text" value="<?= $game->Kinds ?>"><?= $game->Kinds ?></option>
                        <?php
                        foreach ($kinds as $kind) :
                        ?>
                        <option type="text" value="<?= $kind->name ?>"><?= $kind->name ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                
                <div class="field">
                    <label for="publisher">Éditeur :</label>
                    <select name="publisher_<?= $game_number ?>">
                        <option type="text" value="<?= $game->Publishers ?>"><?= $game->Publishers ?></option>
                        <?php
                        foreach ($publishers as $publisher) :
                        ?>
                        <option type="text" value="<?= $publisher->name ?>"><?= $publisher->name ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        <?php
        endforeach;
        ?>
        </div>
        <button type="submit" name="update_send" value="update_send">Envoyer</button>
    </form>
</div>