<?php
session_start();
if (!isset($_COOKIE["usuario-actual"])) {
    header("Location: signup.php");
    exit();
} else if ($_SESSION["recordar"] === true) {
    header("Location: app.php");
} else {
    header("Location: login.php");
    exit();
}
?>