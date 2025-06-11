<?php
session_start();
require_once("usuario.class.php");
if (!isset($_SESSION["recordar"])) {
    $_SESSION["recordar"] = false; // Inicializar la sesión si no existe
}
?>
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['iniciarSesion'])) {
                $DNI = $_POST['DNI'];
                $clave = $_POST['clave'];
                if (isset($_COOKIE[$DNI])){
                    $usuario = unserialize($_COOKIE[$DNI]);
                    if (password_verify($clave, $usuario->getClave())) {
                        setcookie("usuario-actual", $DNI, time() + (86400 * 30), "/"); // Guardar el usuario actual
                        if (isset($_POST['recuerdame']) && $_POST['recuerdame'] == '1') {
                            $_SESSION["recordar"] = true; // Guardar la preferencia de recordar
                        } else {
                            $_SESSION["recordar"] = false; // No recordar
                        }
                        header("Location: imc.php");
                    } else {
                        echo "<h1>Contraseña incorrecta</h1>";
                    }
                }else {
                    echo "<h1>No hay usuario registrado con el DNI: $DNI</h1>";
            }
            }
            ?>
            <h1>Iniciar Sesión</h1>
            <form action="login.php" method="post">
                <input type="number" name="DNI" required placeholder="Documento de Identidad" maxlength="8" minlength="7" min="1000000" max="99999999">
                <input type="password" name="clave" required placeholder="Contraseña">
                <div>
                    <input type="checkbox" name="recuerdame" value="1">
                    <label for="recuerdame">Recuérdame</label>
                </div>
                <input id="iniciarSesion" type="submit" value="Iniciar Sesión" name="iniciarSesion">
            </form>
        </article>
    </section>
</body>
</html>