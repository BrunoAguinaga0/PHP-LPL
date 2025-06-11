<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>App</h1>
    </header>
    <section>
        <article>
            <p>Bienvenido a la aplicación.</p>
            <?php
            require_once('Usuario.class.php'); 
            $nombre_usuario = $_COOKIE["usuario-actual"];
            $usuario = unserialize($_COOKIE["usuario-".$nombre_usuario]);
            echo "<h2>Hola, " . htmlspecialchars($usuario->getNombreUsuario()) . "!</h2>";
            setcookie("usuario-".$nombre_usuario, serialize($usuario), time() + (86400 * 30), "/"); // Actualizar el usuario en la cookie
            echo "<p>Número de visitas: " . $usuario->getVisitas() . "</p>";
            ?>
            <div id="contenedor-botones">
                <form action="cerrar_sesion.php" method="post">
                    <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
                </form>
                <button><a href="index.php" style="text-decoration: none; color: inherit;">Ir a la página principal</a></button>
                <button><a href="imc.php" style="text-decoration: none; color: inherit">Ir a la Calculadora de IMC</a></button>
            </div>
        </article>
    </section>
    <footer>
        <p>&copy; 2025</p>
    </footer>
</body>
</html>