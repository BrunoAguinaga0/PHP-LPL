<?php
session_start();
require_once('Usuario.class.php');
if (!isset($_SESSION["recordar"])) {
    $_SESSION["recordar"] = false; // Inicializar la sesión si no existe
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>LOG IN</h1>
    </header>
    <section>
        <article>
            <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST["recordar"]) && $_POST["recordar"] === "on") {
                        $_SESSION["recordar"] = true; // Guardar la preferencia de recordar
                    } else {
                        $_SESSION["recordar"] = false; // No recordar
                    }
                    $nombre_usuario = $_POST["usuario"];
                    $passwd = $_POST["passwd"];

                    if (isset($_COOKIE) && isset($_COOKIE["usuario-".$nombre_usuario])) {
                        $usuario = unserialize($_COOKIE["usuario-".$nombre_usuario]);
                        
                        if ($usuario->getNombreUsuario() === $nombre_usuario && password_verify($passwd, $usuario->getPasswd())) {
                            setcookie("usuario-actual", $nombre_usuario, time() + (86400 * 30), "/"); // Guardar el usuario actual
                            $usuario->setVisitas($usuario->getVisitas() + 1); // Incrementar visitas
                            setcookie("usuario-".$nombre_usuario, serialize($usuario), time() + (86400 * 30), "/"); // Actualizar el usuario en la cookie
                            header("Location: imc.php"); // Redirigir a una página de bienvenida
                        } else {
                            echo "<h1>Error: Usuario o contraseña incorrectos</h1>";
                            echo "<button><a href='login.php' style='text-decoration: none; color: inherit;'>Reintentar</a></button>";
                        } 
                    } else {
                        echo "<h1>Error: No hay usuario registrado</h1>";
                        echo "<button><a href='signup.php' style='text-decoration: none; color: inherit;'>Regístrate aquí</a></button>";
                    }
                } else {
            ?>
            <form action="login.php" method="post">
                <input required name="usuario" type="text" placeholder="Usuario">
                <input required name="passwd" type="password" placeholder="Contraseña">
                <div id="contenedor_recordar">
                    <input type="checkbox" name="recordar" id="recordar">
                    <label for="recordar">Recordarme</label>
                </div>
                <button type="submit">Log In</button>
                <p><a href="signup.php">¿No tienes una cuenta? Regístrate aquí</a></p>
            </form>
            <?php
                }
            ?>
        </article>
    </section>
    <footer>
        <p></p>
    </footer>
</body>
</html>