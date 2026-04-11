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
                    if (isset($_SESSION['config_partida'])) {
                        header("Location: juego_batalla.php");
                        exit();
                        }
        $nombre_jugador = $_SESSION["nombre_usuario"];
        $partida = $partidaDao->traer_ultima_partida($_SESSION["id_usuario"]);
        if ($partida) {
            $resultado = $partida["resultado"];
            $minutos = intdiv($partida["tiempo_segundos"],60);
            if($minutos < 10){
                $minutos = "0" . $minutos;
            }
            $segundos = $partida["tiempo_segundos"] % 60;
            if($segundos < 10){
                $segundos = "0" . $segundos;
            }
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
                        <button type="button" id="btn-como-jugar"; cursor: pointer;">¿Cómo Jugar?</button>
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
                                    <button class="btn-rotar" data-tipo="portaviones"><svg class="icono-svg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                        <defs><linearGradient x1="24" y1="10" x2="14" y2="10" gradientUnits="userSpaceOnUse" id="color-1_m8gRP2AQ4AOX_gr1"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="3.924" y1="8.199" x2="17.001" y2="41.867" gradientUnits="userSpaceOnUse" id="color-2_m8gRP2AQ4AOX_gr2"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient><linearGradient x1="24" y1="38" x2="34" y2="38" gradientUnits="userSpaceOnUse" id="color-3_m8gRP2AQ4AOX_gr3"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="32.313" y1="7.663" x2="44" y2="40.775" gradientUnits="userSpaceOnUse" id="color-4_m8gRP2AQ4AOX_gr4"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient></defs><g transform=""><g fill-opacity="0" fill="#fa5252" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M14,13h9c0.552,0 1,-0.448 1,-1v-4c0,-0.552 -0.448,-1 -1,-1h-9z" fill="url(#color-1_m8gRP2AQ4AOX_gr1)"></path><path d="M18.19,32h-4.19v-25l-4.828,4.828c-0.751,0.751 -1.172,1.768 -1.172,2.829v17.343h-4.19c-0.72,0 -1.08,0.87 -0.571,1.379l6.701,6.701c0.586,0.586 1.536,0.586 2.121,0l6.701,-6.701c0.509,-0.509 0.148,-1.379 -0.572,-1.379z" fill="url(#color-2_m8gRP2AQ4AOX_gr2)"></path><path d="M34,35h-9c-0.552,0 -1,0.448 -1,1v4c0,0.552 0.448,1 1,1h9z" fill="url(#color-3_m8gRP2AQ4AOX_gr3)"></path><path d="M29.81,16h4.19v25l4.828,-4.828c0.75,-0.75 1.172,-1.768 1.172,-2.828v-17.344h4.19c0.72,0 1.08,-0.87 0.571,-1.379l-6.7,-6.701c-0.586,-0.586 -1.536,-0.586 -2.121,0l-6.701,6.701c-0.51,0.509 -0.149,1.379 0.571,1.379z" fill="url(#color-4_m8gRP2AQ4AOX_gr4)"></path></g></g></g>
                                        </svg></button>
                                </div>
                            </div>
                            <div class="flota-acorazados flota-comun">
                                <h3 class="h3-flota" style="color: red; text-shadow: 0 0 20px red; ">acorazados</h3>
                                <div class="contador-flota">    
                                    <button class="boton-sumres" value="11">-</button>
                                    <h1 id="contador-acorazados">2</h1>
                                    <button class="boton-sumres" value="12">+</button>
                                    <button class="btn-rotar" data-tipo="acorazados"><svg class="icono-svg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                        <defs><linearGradient x1="24" y1="10" x2="14" y2="10" gradientUnits="userSpaceOnUse" id="color-1_m8gRP2AQ4AOX_gr1"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="3.924" y1="8.199" x2="17.001" y2="41.867" gradientUnits="userSpaceOnUse" id="color-2_m8gRP2AQ4AOX_gr2"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient><linearGradient x1="24" y1="38" x2="34" y2="38" gradientUnits="userSpaceOnUse" id="color-3_m8gRP2AQ4AOX_gr3"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="32.313" y1="7.663" x2="44" y2="40.775" gradientUnits="userSpaceOnUse" id="color-4_m8gRP2AQ4AOX_gr4"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient></defs><g transform=""><g fill-opacity="0" fill="#fa5252" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M14,13h9c0.552,0 1,-0.448 1,-1v-4c0,-0.552 -0.448,-1 -1,-1h-9z" fill="url(#color-1_m8gRP2AQ4AOX_gr1)"></path><path d="M18.19,32h-4.19v-25l-4.828,4.828c-0.751,0.751 -1.172,1.768 -1.172,2.829v17.343h-4.19c-0.72,0 -1.08,0.87 -0.571,1.379l6.701,6.701c0.586,0.586 1.536,0.586 2.121,0l6.701,-6.701c0.509,-0.509 0.148,-1.379 -0.572,-1.379z" fill="url(#color-2_m8gRP2AQ4AOX_gr2)"></path><path d="M34,35h-9c-0.552,0 -1,0.448 -1,1v4c0,0.552 0.448,1 1,1h9z" fill="url(#color-3_m8gRP2AQ4AOX_gr3)"></path><path d="M29.81,16h4.19v25l4.828,-4.828c0.75,-0.75 1.172,-1.768 1.172,-2.828v-17.344h4.19c0.72,0 1.08,-0.87 0.571,-1.379l-6.7,-6.701c-0.586,-0.586 -1.536,-0.586 -2.121,0l-6.701,6.701c-0.51,0.509 -0.149,1.379 0.571,1.379z" fill="url(#color-4_m8gRP2AQ4AOX_gr4)"></path></g></g></g>
                                        </svg></button>
                                </div>
                            </div>
                            <div class="flota-destructores flota-comun">
                                <h3 class="h3-flota" style="color: green; text-shadow: 0 0 20px green; ">destructores</h3>
                                <div class="contador-flota">
                                    <button class="boton-sumres" value="21">-</button>
                                    <h1 id="contador-destructores">3</h1>
                                    <button class="boton-sumres" value="22">+</button>
                                    <button class="btn-rotar" data-tipo="destructores"><svg class="icono-svg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                        <defs><linearGradient x1="24" y1="10" x2="14" y2="10" gradientUnits="userSpaceOnUse" id="color-1_m8gRP2AQ4AOX_gr1"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="3.924" y1="8.199" x2="17.001" y2="41.867" gradientUnits="userSpaceOnUse" id="color-2_m8gRP2AQ4AOX_gr2"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient><linearGradient x1="24" y1="38" x2="34" y2="38" gradientUnits="userSpaceOnUse" id="color-3_m8gRP2AQ4AOX_gr3"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="32.313" y1="7.663" x2="44" y2="40.775" gradientUnits="userSpaceOnUse" id="color-4_m8gRP2AQ4AOX_gr4"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient></defs><g transform=""><g fill-opacity="0" fill="#fa5252" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M14,13h9c0.552,0 1,-0.448 1,-1v-4c0,-0.552 -0.448,-1 -1,-1h-9z" fill="url(#color-1_m8gRP2AQ4AOX_gr1)"></path><path d="M18.19,32h-4.19v-25l-4.828,4.828c-0.751,0.751 -1.172,1.768 -1.172,2.829v17.343h-4.19c-0.72,0 -1.08,0.87 -0.571,1.379l6.701,6.701c0.586,0.586 1.536,0.586 2.121,0l6.701,-6.701c0.509,-0.509 0.148,-1.379 -0.572,-1.379z" fill="url(#color-2_m8gRP2AQ4AOX_gr2)"></path><path d="M34,35h-9c-0.552,0 -1,0.448 -1,1v4c0,0.552 0.448,1 1,1h9z" fill="url(#color-3_m8gRP2AQ4AOX_gr3)"></path><path d="M29.81,16h4.19v25l4.828,-4.828c0.75,-0.75 1.172,-1.768 1.172,-2.828v-17.344h4.19c0.72,0 1.08,-0.87 0.571,-1.379l-6.7,-6.701c-0.586,-0.586 -1.536,-0.586 -2.121,0l-6.701,6.701c-0.51,0.509 -0.149,1.379 0.571,1.379z" fill="url(#color-4_m8gRP2AQ4AOX_gr4)"></path></g></g></g>
                                        </svg></button>
                                </div>
                            </div>
                            <div class="flota-submarinos flota-comun">
                                <h3 class="h3-flota" style="color: yellow; text-shadow: 0 0 20px yellow;">submarinos</h3>
                                <div class="contador-flota">
                                    <button class="boton-sumres" value="31">-</button>
                                    <h1 id="contador-submarinos">4</h1>
                                    <button class="boton-sumres" value="32">+</button>
                                    <button class="btn-rotar" data-tipo="submarinos">
                                        <svg class="icono-svg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                        <defs><linearGradient x1="24" y1="10" x2="14" y2="10" gradientUnits="userSpaceOnUse" id="color-1_m8gRP2AQ4AOX_gr1"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="3.924" y1="8.199" x2="17.001" y2="41.867" gradientUnits="userSpaceOnUse" id="color-2_m8gRP2AQ4AOX_gr2"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient><linearGradient x1="24" y1="38" x2="34" y2="38" gradientUnits="userSpaceOnUse" id="color-3_m8gRP2AQ4AOX_gr3"><stop offset="0.266" stop-color="#199ae0"></stop><stop offset="0.582" stop-color="#1898de"></stop><stop offset="0.745" stop-color="#1590d6"></stop><stop offset="0.873" stop-color="#1083c9"></stop><stop offset="0.982" stop-color="#0870b7"></stop><stop offset="1" stop-color="#076cb3"></stop></linearGradient><linearGradient x1="32.313" y1="7.663" x2="44" y2="40.775" gradientUnits="userSpaceOnUse" id="color-4_m8gRP2AQ4AOX_gr4"><stop offset="0" stop-color="#32bdef"></stop><stop offset="1" stop-color="#1ea2e4"></stop></linearGradient></defs><g transform=""><g fill-opacity="0" fill="#fa5252" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M14,13h9c0.552,0 1,-0.448 1,-1v-4c0,-0.552 -0.448,-1 -1,-1h-9z" fill="url(#color-1_m8gRP2AQ4AOX_gr1)"></path><path d="M18.19,32h-4.19v-25l-4.828,4.828c-0.751,0.751 -1.172,1.768 -1.172,2.829v17.343h-4.19c-0.72,0 -1.08,0.87 -0.571,1.379l6.701,6.701c0.586,0.586 1.536,0.586 2.121,0l6.701,-6.701c0.509,-0.509 0.148,-1.379 -0.572,-1.379z" fill="url(#color-2_m8gRP2AQ4AOX_gr2)"></path><path d="M34,35h-9c-0.552,0 -1,0.448 -1,1v4c0,0.552 0.448,1 1,1h9z" fill="url(#color-3_m8gRP2AQ4AOX_gr3)"></path><path d="M29.81,16h4.19v25l4.828,-4.828c0.75,-0.75 1.172,-1.768 1.172,-2.828v-17.344h4.19c0.72,0 1.08,-0.87 0.571,-1.379l-6.7,-6.701c-0.586,-0.586 -1.536,-0.586 -2.121,0l-6.701,6.701c-0.51,0.509 -0.149,1.379 0.571,1.379z" fill="url(#color-4_m8gRP2AQ4AOX_gr4)"></path></g></g></g>
                                        </svg>
                                    </button>
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
                        <form id="form-inicio" style="display: contents" action="../Backend/partida.php" method="POST">
                            <input type="hidden" name="matriz_jugador" id="input-matriz">
                            <input type="hidden" name="historial_jugador" id="input-historial">
                            <input type="hidden" name="filas_tablero" id="input-filas">
                            <input type="hidden" name="columnas_tablero" id="input-columnas">
                            <input type="hidden" name="tamanio-tablero" id="input-tamanio">
                            <input type="hidden" name="cantidades_flota" id="input-cantidades">
                            <button id="boton-comenzar" type="submit" name="comenzar_partida">Comenzar</button>
                        </form>
                    </div>
            </div>
        </section>
        <div id="modal-instrucciones" class="modal-overlay">
            <div class="modal-content">
                <h2>Manual de Combate</h2>
                <div class="texto-instrucciones">
                    <p><strong>1. Preparacion:</strong> Eligi el tamaño del mapa y configura tu flota. Recorda elegir primero el tamaño del tablero y la orientacion de los barcos ya que se genera una nueva flota en cada cambio.</p>
                    <p><strong>2. Despliegue:</strong> Hace clic en el tablero para tomar un barco y volve a hacer clic para soltarlo en una posición válida.</p>
                    <p><strong>3. Reglas de Fuego:</strong> Vos atacas primero. Si acertas a un barco, volves a disparar. Si disparas al agua, el turno pasa a la computadora.</p>
                    <p><strong>4. La CPU Cazadora:</strong> Si la computadora acierta a uno de tus barcos, dejará de tirar al azar y buscará en las casillas aledañas hasta hundirlo.</p>
                    <p><strong>5. Explosion de Ayuda:</strong> Podes usarlo <strong>una sola vez</strong> por partida. Va a revelar un barco enemigo por 15 segundos, pero como castigo, le revelará a la computadora la posición exacta de uno de tus barcos!</p>
                    <p><strong>Configuracion -</strong> Tablero: Podes elegir el tamaño en la parte inferior de la pantalla, Flota: A la derecha de la pantalla tenes botones para sumar, restar y rotar los barcos.</p>
                </div>
            </div>
        </div>
        <script type="module" src="../Assets/JavaScript/InicioJS/juego.js"></script>
    </body>
    </html>