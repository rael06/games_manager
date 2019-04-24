<?php
session_start();
//session_unset();
include "cors/contents/header.php";
if (!isset($_SESSION["user"]) || $_SESSION["user"] === "wrong") {
    require "cors/contents/login.php";
} else {
    include "cors/functions/request.php";
    if (isset($_POST["create"])) {
        include "cors/contents/actions/update.php";
    } elseif (isset($_POST["update"])) {
        include "cors/contents/actions/update.php";
    } elseif (isset($_POST["delete"])) {
        include "cors/contents/actions/delete.php";
    } else {
        include "cors/contents/table_display.php";
    }
}
include "cors/contents/footer.php";
?>