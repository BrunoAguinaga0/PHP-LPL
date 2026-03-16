<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header("Location: Pages/inicio.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Assets/CSS/index.css">
</head>

<body>
    <div class="login-container">
        <form action="Api/reigistro.php" method="post" class="login-card">
            <h1>Batalla Naval</h1>
            <h3>Iniciar Sesión</h3>
            <div class="input-group">
                <input type="text" id="user" name="usuario" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="contrasenia" placeholder="Contraseña" required>
            </div>
            <div class="input-group-recuerdame">
                <div class="input-recuerdame">
                    <input type="checkbox" id="remember" checked="checked" name="remember">
                    <label for="remember">Recuerdame</label>
                </div>
                <a href="Pages/recuperar.php">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
            <div class="login-footer">
                <a href="Pages/registro.php">Crear Cuenta</a>
            </div>
        </form>
    </div>

</body>

</html>