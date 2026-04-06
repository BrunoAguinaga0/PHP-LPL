<?php
    require_once "../Classes/database/PartidaDao.php";
    require_once "../Classes/database/conexionBD.php";
    require_once "../Classes/database/JugadorDAO.php";
    session_start();
    $bd = new conexionBD();
    $partidaDao = new PartidaDAO($bd);
    if(!isset($_SESSION["id_usuario"]) && !isset($_COOKIE["recuerdame"])){
        header("Location: ../index.php");
        exit();
    }
    if(isset($_COOKIE["recuerdame"]) && !isset($_SESSION["id_usuario"])){
        $jugador = new JugadorDAO($bd);
        $datos = $jugador->get_datos_recuerdame($_COOKIE["recuerdame"]);
        if($datos){
            $_SESSION["id_usuario"] = $datos["id_jugador"];
            $_SESSION["nombre_usuario"] = $datos["nombre_jugador"];
        }else{
            header("Location: ../index.php");
            exit();
        }
    }
    $partida = $partidaDao->traer_ultima_partida($_SESSION["id_usuario"]);
    $nombre_jugador = $_SESSION["nombre_usuario"];
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
                <div class="elemento elemento2">
                    <h1 class="titulo">BATALLA NAVAL</h1>
                </div>
                <div class="elemento elemento3">
                </div>
                <div class="elemento elemento4">
                    <h3>Bienvenido a bordo <span class="nombre_resaltado">
                            <?php echo $nombre_jugador; ?></span></h3>
                    <div class="info_ultima_partida" style="gap: 5rem;">
                        <h3>Última partida</h3>
                        <p>Fecha: <span class="fecha_resaltada"> <?php echo $fecha ?> </span></p>
                        <p>Resultado: <span class="resultado_resaltado"> <?php echo $resultado; ?> </span></p>
                        <p>Duracion: <span class="duracion_resaltada"> <?php echo $minutos . ":". $segundos; ?> </span>
                        </p>
                    </div>
                    <p class="sin_partida"><span class="sin_partida_resaltada"> <?php echo $sinpartida; ?> </span></p>
                </div>
                <div class="elemento elemento5" id="elemento5">
                    
                </div>
                <div class="elemento elemento6">
                    <h1 class="titulo , titulo_flota">Flota</h1>
                    <div class="flota" id="flota">
                        <div class="flota-portaviones flota-comun">
                            <h3 class="h3-flota" style="color: white; text-shadow: 0 0 20px white;">portaviones</h3>
                            <div class="contador-flota">
                                <h1 id="cant-portaviones">1</h1>
                            </div>
                        </div>
                        <div class="flota-acorazados flota-comun">
                            <h3 class="h3-flota" style="color: red; text-shadow: 0 0 20px red; ">acorazados</h3>
                            <div class="contador-flota">
                                <button class="boton-sumres" value="11">-</button>
                                <h1 id="contador-acorazados">2</h1>
                                <button class="boton-sumres" value="12">+</button>
                            </div>
                        </div>
                        <div class="flota-destructores flota-comun">
                            <h3 class="h3-flota" style="color: green; text-shadow: 0 0 20px green; ">destructores</h3>
                            <div class="contador-flota">
                                <button class="boton-sumres" value="21">-</button>
                                <h1 id="contador-destructores">3</h1>
                                <button class="boton-sumres" value="22">+</button>
                            </div>
                        </div>
                        <div class="flota-submarinos flota-comun">
                            <h3 class="h3-flota" style="color: yellow; text-shadow: 0 0 20px yellow;">submarinos</h3>
                            <div class="contador-flota">
                                <button class="boton-sumres" value="31">-</button>
                                <h1 id="contador-submarinos">4</h1>
                                <button class="boton-sumres" value="32">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elemento elemento7"></div>
                <div class="elemento elemento8">
                    <div class="titulo-tablero">
                        <h3 class="h3-tablero">Seleccione el tamaño del tablero</h3>
                    </div>
                    <div class="radios-container">
                        <label class="radios" for="radio1">
                            <div class="radios-Interno radius1">
                                <input type="radio" name="radio" id="radio1" value="1" checked>
                                <img src="../Assets/IMG/grilla10x10.svg" alt="imagen" class="img-tablero img-chica">
                                <span>10x10</span>
                            </div>
                        </label>
                        <label class="radios" for="radio2">
                            <div class="radios-Interno">
                                <input type="radio" name="radio" id="radio2" value="2">
                                <img src="../Assets/IMG/grilla10x15.svg" alt="imagen" class="img-tablero">
                                <span>10x15</span>
                            </div>
                        </label>
                        <label class="radios" for="radio3">
                            <div class="radios-Interno">
                                <input type="radio" name="radio" id="radio3" value="3">
                                <img src="../Assets/IMG/grilla15x15.svg" alt="imagen" class="img-tablero">
                                <span>15x15</span>
                            </div>
                        </label>
                        <label class="radios" for="radio4">
                            <div class="radios-Interno">
                                <input type="radio" name="radio" id="radio4" value="4">
                                <img src="../Assets/IMG/grilla20x10.svg" alt="imagen" class="img-tablero">
                                <span>20x10</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="elemento elemento9">
                    <form style="display: contents" action="../Backend/partida.php" method="POST">
                    <button type="submit" name="comenzar_partida">Comenzar</button>
                </form>
                </div>
        </div>
    </section>
    <script type="module" src="../Assets/JavaScript/InicioJS/juego.js"></script>
</body>
</html>