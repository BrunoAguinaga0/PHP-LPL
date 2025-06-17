<?php
require_once 'juego.class.php';
session_start();
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
    <?php
        if (!isset($_COOKIE["ultimoAcceso"])){
            setcookie("ultimoAcceso", date("d/m/Y"));
            $acceso = date("d/m/Y");
        }
        else {
            $acceso = $_COOKIE["ultimoAcceso"];
            setcookie("ultimoAcceso", date("d/m/Y"));
        }
        if (!isset($_COOKIE["partidasGanadas"])){
            setcookie("partidasGanadas", 0);
            $partidasGanadas = 0;
        }else {
            $partidasGanadas = $_COOKIE["partidasGanadas"];
        }

    ?>
    <header>Fecha ultimo acceso <?php echo $acceso; ?> | Partidas Ganadas <?php echo $partidasGanadas ?></header>
    <section>
        <article>
            <?php
                if (!isset($_COOKIE["contadorJuegos"])){
                    setcookie("contadorJuegos", 1);
                }
                if (!isset($_SESSION["juegoActual"])){
                    if (isset($_COOKIE["contadorJuegos"])){
                        $nroJuego = $_COOKIE["contadorJuegos"];
                    }
                    else {
                        $nroJuego = 1;
                    }
                    $nuevoJuego = new Juego($nroJuego);
                    $_SESSION["juegoActual"] = $nuevoJuego;
                }
            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                if (isset($_POST["abandonar"])){
                    $_SESSION = [];
                    session_destroy();
                    header("Location: index.php");
                    exit;
                }
                if (isset($_POST["nuevoJuego"])){
                    $nroJuego = $_COOKIE["contadorJuegos"];
                    $nroJuego++;
                    unset($_SESSION["juegoActual"]);
                    $nuevoJuego = new Juego($nroJuego);
                    setcookie("contadorJuegos", $nroJuego);
                }
                if (isset($_POST["tirar"])){
                    $nuevoJuego = $_SESSION["juegoActual"];
                    if ($nuevoJuego->getGanador() == 0){
                        $nuevoJuego->logicaJuego();
                        if ($nuevoJuego->getPuntosComputadora() <= 0 && $nuevoJuego->getPuntosJugador() > 0){
                            $nuevoJuego->setGanador(1);
                        }
                        if ($nuevoJuego->getPuntosJugador() <= 0 && $nuevoJuego->getPuntosComputadora() > 0){
                            $nuevoJuego->setGanador(2);
                        }
                    }
                    if ($nuevoJuego->getGanador() == 1){
                        $msj = "Ganaste el juego del dado!!";
                        $nuevoJuego->setMensajeGanador($msj);
                        $partidasGanadas = $_COOKIE["partidasGanadas"];
                        setcookie("partidasGanadas", intval($partidasGanadas) + 1);
                        header("Location: terminar.php");   
                        exit;
                    } 
                    if ($nuevoJuego->getGanador() == 2){
                        $msj = "Perdiste el juego del dado contra la maquina! :(";
                        $nuevoJuego->setMensajeGanador($msj);
                        header("Location: terminar.php");
                        exit;
                    }
                }
                header("Location: index.php");
                exit;
                } 
            ?>
            <div><h1> Juego de Dados</h1></div>
            <?php
                if (!isset($_COOKIE["contadorJuegos"])){
                    setcookie("contadorJuegos", 1);
                    $nroJuego = 1;
                }else {
                    $nroJuego = $_COOKIE["contadorJuegos"];
                }
            ?>
            <div><p>Nro. de juego: <?php echo $nroJuego; ?></p></div>
            <div id ="info">
                <p>Nro. Tirada: <?php echo $_SESSION["juegoActual"]->getTirada()?></p>
                <p style="color:green;font-weight: bold;">Bruno: <?php echo $_SESSION["juegoActual"]->getPuntosJugador() . " puntos" ?></p>
                <p style="color:red; font-weight: bold;">Maquina: <?php echo $_SESSION["juegoActual"]->getPuntosComputadora() . " puntos" ?></p>
                <?php
                if ($_SESSION["juegoActual"]->getTurno() == 1){
                    ?>
                    <p style="font-weight: bold;">Turno: Bruno</p>
                <?php
                }else{?>
                    <p style="font-weight: bold;">Turno: Maquina</p>
                <?php
                }
                ?>
            </div>
            <form action="index.php" method="post">
            <div class="noFondo"><input type="submit" name="tirar" value="Tirar Dado"></div>
            <div class="noFondo"><input type="submit" name="nuevoJuego" value="Nuevo Juego">
            <input type="submit" name="abandonar" value="Abandonar"></div>
            </form>
        </article>
        <article>
            <table>
                <tr>
                    <th>Tirada</th>
                    <th>Jugador</th>
                    <th>Valor de Dado</th>
                    <th>Bruno</th>
                    <th>Maquina</th>
                </tr>
                <?php
                $nuevoJuego = $_SESSION["juegoActual"];
                echo $nuevoJuego->getAgregarTabla()
                ?>
            </table>
        </article>
    </section>
</body>
</html>