<?php
    require_once "../Classes/database/PartidaDao.php";
    require_once "../Classes/database/conexionBD.php";
    session_start();
    if(!isset($_SESSION["id_usuario"]) && !isset($_COOKIE["recuerdame"])){
        header("Location: ../index.php");
        exit();
    }
    $bd = new conexionBD();
    $partidaDao = new PartidaDAO($bd);
    $partida = $partidaDao->traer_ultima_partida($_SESSION["id_usuario"]);
    if ($partida) {
        $resultado = $partida["resultado"];
        $minutos = intdiv($partida["tiempo_segundos"],60);
        $segundos = $partida["tiempo_segundos"] % 60;
        $anio = substr($partida["fecha_partida"],0,4);
        $mes = substr($partida["fecha_partida"],5,2);
        $dia = substr($partida["fecha_partida"],8,2);
        $fecha = $dia . "/" . $mes . "/" . $anio;
        $sinpartida = "";
    }
    else{
        $resultado = "----";
        $minutos = 0;
        $segundos = "00";
        $fecha = "----";
        $sinpartida = "Sin partida";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/CSS/index.css">
    <link rel="stylesheet" href="../Assets/CSS/inicio.css?v=<?php echo time(); ?>">
</head>

<body class="inicio">
    <section class="inicio-section">
        <div class="container">
            <div class="elemento elemento1">
                <form action="../Backend/logout.php" method="POST">
                    <button type="submit" name="cerrar-sesion">Cerrar Sesión</button>
                </form>
            </div>
            <form style="display: contents" action="../Backend/partida.php" method="POST">
                <div class="elemento elemento2">
                    <h1 class="titulo">BATALLA NAVAL</h1>
                </div>
                <div class="elemento elemento3">
                </div>
                <div class="elemento elemento4">
                    <h3>Bienvenido a bordo <span class="nombre_resaltado">
                            <?php echo $_SESSION["nombre_usuario"]; ?></span></h3>
                    <div class="info_ultima_partida">
                        <h3>Última partida</h3>
                        <p>Fecha: <span class="fecha_resaltada"> <?php echo $fecha ?> </span></p>
                        <p>Resultado: <span class="resultado_resaltado"> <?php echo $resultado; ?> </span></p>
                        <p>Duracion: <span class="duracion_resaltada"> <?php echo $minutos . ":". $segundos; ?> </span>
                        </p>
                    </div>
                    <p class="sin_partida"><span class="sin_partida_resaltada"> <?php echo $sinpartida; ?> </span></p>
                </div>
                <div class="elemento elemento5"></div>
                <div class="elemento elemento6"></div>
                <div class="elemento elemento7"></div>
                <div class="elemento elemento8">
                    <div class=".radios">
                        <
                </div>
                <div class="elemento elemento9">
                    <button type="submit" name="comenzar_partida">Comenzar</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>