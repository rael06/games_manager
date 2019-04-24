<?php
    session_start();
    $_SESSION["login_message"] = "Vous êtes déconnecté";
    unset($_SESSION["user"]);
    header("location: ../../index.php");