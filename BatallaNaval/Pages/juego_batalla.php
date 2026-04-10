<?php
require_once "../Classes/entities/tablero.class.php";
require_once "../Classes/database/conexionBD.php";
require_once "../Classes/database/JugadorDAO.php";
session_start();
if(!isset($_SESSION["id_usuario"]) && !isset($_COOKIE["recuerdame"])){
    header("Location: ../index.php");
    exit();
}
if (!isset($_SESSION['config_partida'])) {
    header("Location: inicio.php");
    exit();
}
$tableroIA = $_SESSION['tablero_ia'];
$tableroJugador = $_SESSION['tablero_jugador'];
$disparosAlEnemigo = $tableroIA->obtenerDisparos();
$disparosDeIA = $tableroJugador->obtenerDisparos();
$bd = new conexionBD();
$jugador = new JugadorDAO($bd);
$misRecords = $jugador->recordsJugador($_SESSION['id_usuario']);
if (!isset($_SESSION['config_partida']['tiempo_inicio'])) {
    $_SESSION['config_partida']['tiempo_inicio'] = time();
}
if ($_SESSION['config_partida']['estado'] === 'jugando') {
    $segundosJugados = time() - $_SESSION['config_partida']['tiempo_inicio'];
} else {
    $segundosJugados = $_SESSION['config_partida']['tiempo_final'] ?? 0;
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
            <span class="reloj" id="timer">00:00</span>
        </div>
    </header>
    <main class="seccion-central">
        <div class="zona-tableros">
            <div class="modulo-tablero">
                <div class="header-tablero">Tus Flota</div>
                <div class="cuerpo-tablero" id="contenedor-jugador"></div>
            </div>
            <div class="modulo-tablero">
                <div class="header-tablero ataque" id="header-ia">¡Tu Turno!</div>
                <div class="cuerpo-tablero" id="contenedor-ia"></div>
            </div>
        </div>
    </main>
    <footer class="seccion-inferior">
        <div class="barra-acciones">
            <button id="rendirse" class="boton-accion">Rendirse</button>
            <button id="pista" class="boton-accion pista">💣</button>
            <button id="records" class="boton-accion">Records</button
        </div>
    </footer>
</div>

<div id="modal-rendirse" class="modal-overlay">
    <div class="modal-contenido">
        <h3>Alerta de Combate</h3>
        <p>¿Estás seguro de que queres abandonar la batalla? Esto contará como una derrota en tu historial.</p>
        <div class="modal-botones">
            <button id="btn-cancelar-rendicion" class="boton-secundario">Cancelar</button>
            <button id="btn-confirmar-rendicion" class="boton-peligro">Sí, rendirme</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="records-modal">
<div class="panel-records-personales">
    <h3 class="titulo-records">Mis Récords</h3>
    
    <?php if (empty($misRecords)): ?>
        <p class="sin-records">Aún no tienes victorias registradas. ¡Gana esta partida para entrar al podio!</p>
    <?php else: ?>
        <table class="tabla-records">
            <thead>
                <tr>
                    <th>Top</th>
                    <th>Fecha</th>
                    <th>Tiempo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($misRecords as $index => $record): ?>
                    <tr>
                        <td>#<?php echo $index + 1; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($record['fecha_partida'])); ?></td>
                        <td class="tiempo-resaltado"><?php echo $record['tiempo_segundos']; ?>s</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</div>
<div id="modal-final" class="modal-overlay">
    <div class="modal-contenido final-game">
        <header class="modal-header-resultado">
            <h2 id="resultado-titulo">RESULTADO</h2>
            <div class="divisor-neon"></div>
        </header>
        <section class="seccion-ranking">
            <h4>RANKING TOP 5 TRIPULANTES</h4>
            <table class="tabla-ranking">
                <thead>
                    <tr>
                        <th>Rango</th>
                        <th>Usuario</th>
                        <th>Tiempo</th>
                    </tr>
                </thead>
                <tbody id="ranking-cuerpo">
                    </tbody>
            </table>
        </section>
        <footer class="modal-footer-final">
            <button onclick="window.location.href='inicio.php'" class="boton-inicio">
                <i class="fas fa-home"></i> VOLVER AL INICIO
            </button>
        </footer>
    </div>
</div>
<script>
    window.CONFIG_BATALLA = {
        filas: <?php echo $_SESSION['config_partida']['filas']; ?>,
        columnas: <?php echo $_SESSION['config_partida']['columnas']; ?>,
        tamanio: <?php echo $_SESSION['config_partida']['tamanio']; ?>,
        estado: "<?php echo $_SESSION['config_partida']['estado']; ?>",
        historialFlota: <?php echo json_encode($_SESSION['config_partida']['historial_jugador']); ?>,
        disparosAlEnemigo: <?php echo json_encode($disparosAlEnemigo); ?>,
        disparosDeIA: <?php echo json_encode($disparosDeIA); ?>,
        segundosJugados: <?php echo $segundosJugados; ?>
    };
</script>
<script type="module" src="../Assets/JavaScript/JuegoJS/batalla.js"></script>

</body>
</html>