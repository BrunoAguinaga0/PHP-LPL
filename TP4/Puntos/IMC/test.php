<?php
require_once ('Usuario.class.php');
print_r($_COOKIE);
$usuario = unserialize($_COOKIE["usuario"]);
echo "<h1>Usuario: " . $usuario->getNombreUsuario() . "</h1>";
?>