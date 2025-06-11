session_start();
<?php
if (!isset($_COOKIE["usuario"])) {
    header("Location: registrarse.php");
    exit();
} else if ($_SESSION["recordar"] === true) {
    header("Location: app.php");
} else {
    header("Location: login.php");
    exit();
}
?>