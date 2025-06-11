<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SIGN UP</h1>
    </header>
    <section>
        <article>
            <?php
                require_once('Usuario.class.php');
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $nombre_usuario = $_POST["usuario"];
                    $passwd = $_POST["passwd"];
                    $confirmar_passwd = $_POST["confirmar_passwd"];

                    if ($passwd === $confirmar_passwd) {
                        $usuario = new Usuario($nombre_usuario, password_hash($passwd, PASSWORD_DEFAULT));
                        setcookie("usuario-".$nombre_usuario, serialize($usuario), time() + (86400 * 30), "/"); // 30 días de expiración
                        setcookie("usuario-actual", $nombre_usuario, time() + (86400 * 30), "/"); // Guardar el usuario actual
                        header("Location: bienvenido.php"); // Redirigir a una página de bienvenida
                    } else {
                        echo "<h1>Error: Las contraseñas no coinciden</h1>";
                        echo "<button><a href='signup.php' style='text-decoration: none; color: inherit'>Volver al registro</a></button>";
                    }
                } else {
            ?>
            <form action="signup.php" method="post">
                <input required name="usuario" type="text" placeholder="Usuario">
                <input required name="passwd" type="password" placeholder="Contraseña">
                <input required name="confirmar_passwd" type="password" placeholder="Confirmar Contraseña">
                <button name="submit" type="submit">Sign Up</button>
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