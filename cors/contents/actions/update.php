<div class="update">
    <?php
    include "cors/functions/get_column.php";
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
        if(isset($_POST["game"])) :
            $_SESSION["games"] = $_POST["game"];
            foreach($_POST["game"] as $object) :
                $game = json_decode($object);
                $game_number++;
                $_SESSION["game_id_" . $game_number] = $game->ID;
                ?>
                <div class="game_form">
                    <!-- title -->
                    <div class="field">
                        <label for="title">Titre :</label>
                        <input type="text" name="title_<?= $game_number ?>" value="<?= $game->Title ?>">
                    </div>
                    <!-- date -->
                    <div class="field">
                        <?php include "cors/contents/date_form.php" ?>
                    </div>
                    <!-- developer -->
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
                    <!-- platform -->
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
                    <!-- publisher -->
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
                    <!-- kinds -->
                    <div class="kinds_update">
                        <label for="kind">Genre :</label>
                        <span><?= $game->Kinds ?></span>
                        <br>
                        <div class="kinds_checkboxxes">
                            <?php
                            foreach ($kinds as $kind) :
                                // to mark as "checked" every existing kind of game
                                $array_kinds = explode(", ", $game->Kinds);
                                if(in_array($kind->name, $array_kinds)) {
                                    $checked = "checked";
                                } else {
                                    $checked = "";
                                }
                                //
                            ?>
                            <div class="choices">
                                <input class="kinds_checkbox" type="checkbox" name="kinds_<?= $game_number ?>[]" value="<?= $kind->name ?>" <?= $checked ?>><?= $kind->name ?></option>
                            </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <button type="submit" name="form_type_send" value="update_send">Envoyer</button>
                </div>
            <?php
            endforeach;
            else :
                $_SESSION["games"] = [];
                $game_number = 1;
                ?>
                <div class="game_form">
                    <div class="field">
                        <label for="title">Titre :</label>
                        <input type="text" name="title_<?= $game_number ?>" value="">
                    </div>
                    <div class="field">
                        <?php include "cors/contents/date_form.php" ?>
                    </div>
                    <div class="field">
                        <label for="developer">Développeur :</label>
                        <select name="developer_<?= $game_number ?>">
                            <option type="text" value=""></option>
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
                            <option type="text" value=""></option>
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
                            <option type="text" value=""></option>
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
                        <label for="publisher">Éditeur :</label>
                        <select name="publisher_<?= $game_number ?>">
                            <option type="text" value=""></option>
                            <?php
                            foreach ($publishers as $publisher) :
                            ?>
                            <option type="text" value="<?= $publisher->name ?>"><?= $publisher->name ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="kinds_update">
                        <label for="kind">Genre :</label>
                        <span></span>
                        <br>
                        <div class="kinds_checkboxxes">
                            <?php
                            foreach ($kinds as $kind) :
                            ?>
                            <div class="choices">
                                <input class="kinds_checkbox" type="checkbox" name="kinds_<?= $game_number ?>[]" value="<?= $kind->name ?>"><?= $kind->name ?></option>
                            </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <button type="submit" name="form_type_send" value="create_send">Envoyer</button>
                </div>
            <?php
            endif;
            ?>
        </div>
    </form>
</div>