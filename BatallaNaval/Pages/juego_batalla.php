<?php
require_once "../Classes/entities/tablero.class.php";
session_start();
if(!isset($_SESSION["id_usuario"]) && !isset($_COOKIE["recuerdame"])){
    header("Location: ../index.php");
    exit();
}
if (!isset($_SESSION['config_partida'])) {
    header("Location: inicio.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalla Naval - Combate</title>
    <link rel="stylesheet" href="../Assets/CSS/partida.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="layout-principal">
    <header class="seccion-superior">
        <div class="espacio-cronometro">
            <span class="reloj" id="timer">10:00</span>
        </div>
    </header>
    <main class="seccion-central">
        <div class="zona-tableros">
            <div class="modulo-tablero">
                <div class="header-tablero">Tus Flota</div>
                <div class="cuerpo-tablero" id="contenedor-jugador"></div>
            </div>
            <div class="modulo-tablero">
                <div class="header-tablero ">Flota Enemiga</div>
                <div class="cuerpo-tablero" id="contenedor-ia"></div>
            </div>
        </div>
    </main>
    <footer class="seccion-inferior">
        <div class="barra-acciones">
            <button class="boton-accion" onclick="location.href='../Backend/logout.php'">Rendirse</button>
            <button class="boton-config">⚙️</button>
        </div>
    </footer>

</div>
<script>
    window.CONFIG_BATALLA = {
        filas: <?php echo $_SESSION['config_partida']['filas']; ?>,
        columnas: <?php echo $_SESSION['config_partida']['columnas']; ?>,
        tamanio: <?php echo $_SESSION['config_partida']['tamanio']; ?>,
        historialFlota: <?php echo json_encode($_SESSION['config_partida']['historial_jugador']); ?>
    };
</script>
<script type="module" src="../Assets/JavaScript/JuegoJS/batalla.js"></script>
</body>
</html>