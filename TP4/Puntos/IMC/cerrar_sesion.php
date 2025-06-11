<?php
session_start();
if (isset($_POST['cerrar_sesion'])) {
    // Destruir la sesión
    $_SESSION = array(); // Limpiar la sesión actual
    session_destroy();
    
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>