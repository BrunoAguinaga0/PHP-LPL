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
    <link rel="stylesheet" href="../Assets/CSS/index.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="login-container">
        <form action="../Backend/registroBack.php" id="register-form" method="post" class="login-card register-card">
            <h1>Batalla Naval</h1>
            <h3>Registrarse</h3>
            <div class="input-group">
                <label>Usuario:</label>
                <input type="text" id="user" name="usuario" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <label>Contraseña:</label>
                <input type="password" id="password" name="contrasenia" placeholder="Contraseña" required>
            </div>
            <div class="input-group">
                <label>Confirmar Contraseña:</label>
                <input  type="password" id="confirm_password" name="confirmar_contrasenia" placeholder="Contraseña"
                    required>
            </div>
            <?php
                if (isset($_SESSION["error_usuario"])) {
                    echo '<p id="error-servidor" class="error-message">' . $_SESSION["error_usuario"] . '</p>';
                    unset($_SESSION["error_usuario"]);
                }
                if (isset($_SESSION["error_contrasenia"])) {
                    echo '<p class="error-message">' . $_SESSION["error_contrasenia"] . '</p>';
                    unset($_SESSION["error_contrasenia"]);
                }
            ?>
            <button type="submit" id="register-button" class="btn-login">Registrarse</button>
            <div class="login-footer">
                <a href="../index.php">Ir a iniciar sesión</a>
            </div>
        </form>
    </div>
    <script src="../Assets/JavaScript/IndexJS/registro.js"></script>
</body>

</html>