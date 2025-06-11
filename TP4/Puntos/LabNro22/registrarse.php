<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <article>
        <?php
        require_once("usuario.class.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crearUsuario'])) {
            if (isset($_COOKIE[$_POST['DNI']])) {
                echo "<h1>Ya existe un usuario con el DNI: $_POST[DNI]</h1>";
            }else{
                echo "<h1>Usuario creado correctamente</h1>";
                $DNI = $_POST['DNI'];
                $clave = $_POST['clave'];
                $usuario = new Usuario($DNI, password_hash($clave, PASSWORD_DEFAULT));
                setcookie($DNI, serialize($usuario), time() + (86400 * 30), "/"); // 30 días de expiración
                setcookie("usuario", $DNI, time() + (86400 * 30), "/"); // Guardar el usuario actual
            }
        }
        ?>
        <h1>Crear Usuario</h1>
            <form action="registrarse.php" method="post">
                <input type="number" name="DNI" required placeholder="Documento de Identidad" maxlength="8" minlength="7" min="1000000" max="99999999">
                <input type="password" name="clave" required placeholder="Contraseña">
                <input class="crearUsuario" type="submit" value="Crear Usuario" name="crearUsuario">
            </form>
        </article>
    </section>
</body>
</html>