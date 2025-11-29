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
    <section>
        <article>
            <?php
            $nuevoJuego = $_SESSION["juegoActual"];
            if ($nuevoJuego->getGanador() == 1){
                $mensaje = $nuevoJuego->getMensajeGanador();
                $mensaje1 = "Bruno ganaste " . $nuevoJuego->getPuntosJugador() . " puntos en " . intval($nuevoJuego->getTirada()) - 1 . " tiradas";
            }
            else{
                $mensaje = $nuevoJuego->getMensajeGanador();
                $mensaje1 = "Queres volver a jugar?";
            }
            ?>
            <h2><?php echo $mensaje;?></h2>
            <p> <?php echo $mensaje1;?>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                $_SESSION = [];
                session_destroy();
                header("Location: index.php");
                exit;
            } 
            ?>
            <form action="terminar.php" method="post">
                <input type="submit" name="nuevoJuego" value="Nuevo Juego">
            </form>
        </article>
    </section>
</body>
</html>