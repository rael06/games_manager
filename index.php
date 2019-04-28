<?php
session_start();
//session_unset();
include "cors/contents/header.php";
if (!isset($_SESSION["user"]) || $_SESSION["user"] === "wrong") {
    require "cors/contents/login.php";
} else {
    include "cors/functions/request.php";
    if (isset($_POST["create"])) {
        include "cors/contents/actions/create.php";
    } elseif (isset($_POST["update"])) {
        if (isset($_POST["game"]) && count($_POST["game"]) > 0) {
            include "cors/contents/actions/update.php";
        } else {
            include "cors/contents/table_display.php";
        }
    } elseif (isset($_POST["delete"]) && !isset($_POST["game"])) {
        include "cors/contents/table_display.php";
    } elseif (isset($_POST["delete"]) && count($_POST["game"]) > 0) {
        include "cors/contents/table_display.php";
        include "cors/contents/actions/delete.php";
    } else {
        include "cors/contents/table_display.php";
    }
}
include "cors/contents/footer.php";
?>