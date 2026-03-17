<?php
    session_start();
    if(!isset($_SESSION["id_usuario"]) && !isset($_COOKIE["recuerdame"])){
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <form action="../Backend/logout.php" method="POST">
        <button type="submit" name="cerrar-sesion">Apretame</button>
    </form>
</body>
</html>