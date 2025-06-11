<?php
session_start();
if (!isset($_SESSION["recordar"])) {
    $_SESSION["recordar"] = false; // Inicializar la sesión si no existe
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>
            Bienvenido, 
            <?php
            require_once('Usuario.class.php');
            $nombre_usuario = $_COOKIE["usuario-actual"];
            $usuario = unserialize($_COOKIE["usuario-".$nombre_usuario]);
            echo htmlspecialchars($usuario->getNombreUsuario());
            ?>
        </h1>
    </header>
    <section>
        <article>
            <p>Se ha registrado correctamente.</p>
            <button><a href="app.php" style="text-decoration: none; color: inherit;">Ir a la aplicación</a></button>
        </article>
    </section>
    <footer>
        <p>&copy; 2025</p>
    </footer>
</body>
</html>