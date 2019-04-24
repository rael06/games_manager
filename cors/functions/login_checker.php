<?php
session_start();
$users_bdd = new PDO("mysql:host=localhost;dbname=videogames", "root", "");
$users_query = $users_bdd->query("SELECT logins, passwords, idPrivileges, privileges.id, roles FROM Users INNER JOIN Privileges ON users.idPrivileges = privileges.id;");
$users_infos = $users_query->fetchAll(PDO::FETCH_OBJ);

function secure($donnees){
    $donnees = trim($donnees);
    $donnees = addslashes($donnees);
    return $donnees;
}

if (isset($_POST["login"])) {
    $_SESSION["login"] = secure($_POST["login"]);
} else $_SESSION["login"] = "";

if (isset($_POST["password"])) {
    $_SESSION["password"] = secure($_POST["password"]);
} else $_SESSION["password"] = "";

// check login, password and privileges
foreach($users_infos as $user) { // foreach user in users bdd

    if ($_SESSION["login"] === $user->logins && $_SESSION["password"] === $user->passwords && $user->roles === "admin") { 
        $_SESSION["user"] = "ok";
        break;
    } else {
        $_SESSION["user"] = "wrong";
        if ($_SESSION["password"] !== $user->passwords) {
            $_SESSION["login_message"] = "Mauvais mot de passe";
        } elseif (empty($_POST["login"]) && empty($_POST["password"])) {
            $_SESSION["login_message"] = "Les champs sont vides";
        } elseif ($_SESSION["login"] === $user->logins && $_SESSION["password"] === $user->passwords && $user->roles !== "admin") {
            $_SESSION["login_message"] = "Vous n'êtes pas autorisé";
        } elseif ($_SESSION["login"] !== $user->logins) {
            $_SESSION["login_message"] = "Mauvais identifiant";
        }
    }
}
header("Location: ../../index.php");