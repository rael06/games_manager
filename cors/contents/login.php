<?php
$first_message = "Veuillez vous identifier";
$login = "";
if (isset($_SESSION["login"])) {
    $login = $_SESSION["login"];
}

$password = "";
if (isset($_SESSION["password"])) {
    $password = $_SESSION["password"];
}

$login_message = "";
if(!isset($_SESSION["login_message"])) {
    $_SESSION["login_message"] = $first_message;
}
$login_message = $_SESSION["login_message"];
?>
<div class="loginDiv">
    <h2>Login</h2>
    <p class="login_message"><?= $login_message ?></p>
    <form action="cors/functions/login_checker.php" method="POST" class="loginForm">
        <label for="login">Identifiant : </label>
        <input type="text" name="login" placeholder="Identifiant" value="<?= $login ?>" class="login_input">
        <label for="password">Mot de passe : </label>
        <input type="password" name="password" placeholder="Mot de passe" value="<?= $password ?>" class="login_input">
        <button type="submit" name="send" value="send" class="login_submit game_action_button">Envoyer</button>
    </form>
</div>