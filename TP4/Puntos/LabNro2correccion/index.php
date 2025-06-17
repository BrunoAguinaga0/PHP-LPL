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
    <header>
        <h1>CALCULADORA CENTRO NUMERICO</h1>
    </header>
    <section>
        <article> 
            <h3>INSTRUCCIONES</h3>
            <p>Ingrese un numero y se calculara si es centro numerico</p>
            <p>En caso de no serlo se calculara y se buscara en un rango de 5 numeros hacia arriba y hacia abajo</p>
        </article>
        <article id="juego">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                if (isset($_POST["terminado"])){
                    session_destroy();
                    unset($_SESSION["juegoActual"]);
                    header("Location: index.php"); // o mostrar un mensaje
                    exit;
                }
                if (!empty($_POST["numero"])){
                        if (!isset($_SESSION["juegoActual"])){
                            $nuevoJuego = new juego();
                            $numero = intval($_POST["numero"]);
                            if ($nuevoJuego->calculoCentroNumerico($numero)){
                                $nuevoJuego->setGanado(true);
                                $nuevoJuego->setMensajeJuego("El numero ingresado es centro numerico, GANASTE!!");
                                if(!isset($_COOKIE["ganadas"])){
                                    setcookie("ganadas", 1, time() + (86400 * 30), "/");
                                }else{
                                    $partidasGanadas = $_COOKIE["ganadas"];
                                    $partidasGanadas += 1;
                                    setcookie("ganadas", $partidasGanadas, time() + (86400 * 30), "/");
                                }
                            }else{
                                $nuevoJuego->restoIntentos();
                                if($nuevoJuego->rangoNumeros($numero)){
                                    $nuevoJuego->setMensajeJuego("El numero ingresado es cercano a un centro numerico");
                                }else{
                                    $nuevoJuego->setMensajeJuego("El numero ingresado es lejano a algun centro numerico");
                                };
                            }
                            $_SESSION["juegoActual"] = $nuevoJuego;
                        }
                        else{
                            $nuevoJuego = $_SESSION["juegoActual"];
                            $numero = intval($_POST["numero"]);
                            if ($nuevoJuego->calculoCentroNumerico($numero)){
                                $nuevoJuego->setGanado(true);
                                $nuevoJuego->setMensajeJuego("El numero ingresado es centro numerico, GANASTE!!");
                                if(!isset($_COOKIE["ganadas"])){
                                    setcookie("ganadas", 1, time() + (86400 * 30), "/");
                                }else{
                                    $partidasGanadas = $_COOKIE["ganadas"];
                                    $partidasGanadas += 1;
                                    setcookie("ganadas", $partidasGanadas, time() + (86400 * 30), "/");
                                }
                            }else{
                                $nuevoJuego->restoIntentos();
                                if($nuevoJuego->rangoNumeros($numero)){
                                    $nuevoJuego->setMensajeJuego("El numero ingresado es cercano a un centro numerico");
                                }else{
                                    $nuevoJuego->setMensajeJuego("El numero ingresado es lejano a algun centro numerico");
                                };
                            }
                            if ($nuevoJuego->getIntentos() == 0){
                                $nuevoJuego->setPerdido(true);
                                $nuevoJuego->setMensajeJuego("Perdiste, te quedaste sin intentos");
                                if(!isset($_COOKIE["perdidas"])){
                                    setcookie("perdidas", 1, time() + (86400 * 30), "/");
                                }else{
                                    $partidasPerdidas = $_COOKIE["perdidas"];
                                    $partidasPerdidas += 1;
                                    setcookie("perdidas", $partidasPerdidas, time() + (86400 * 30), "/");
                                }
                            }
                            $_SESSION["juegoActual"] = $nuevoJuego;
                        }
                        header("Location: index.php");
                        exit;
                }
                }
            if (!isset($_SESSION["juegoActual"])){
                ?>
            <form action="index.php" method="post">
                <div>
                    <p class="intentos">Intentos Disponibles: 10</p>
                </div>
                <div>
                    <label>Numero:</label>
                    <input type="number" name="numero" required min="1" placeholder="Ingrese un numero">
                    <input type="submit" name="btnIngreso" value="Enviar">
                </div>
            </form>
            <?php
            }
            else{
                $nuevoJuego = $_SESSION["juegoActual"];
                if (!$nuevoJuego->getGanado() && !$nuevoJuego->getPerdido()){
                    ?>
                <form action="index.php" method="post">
                    <div>
                    <p class="intentos">Intentos Disponibles: <?php echo $nuevoJuego->getIntentos(); ?></p>
                    </div>
                    <div>
                        <label>Numero:</label>
                        <input type="number" name="numero" min="1" placeholder="Ingrese un numero">
                        <input type="submit" name="btnIngreso" value="Enviar">
                        <input type="submit" name="terminado" value="Volver a jugar">
                    </div>
                </form>
                <p id="msj"><?php echo $nuevoJuego->getMensajeJuego(); ?></p>
            <?php
                }else {
                    echo "<p id=msjg>" . $nuevoJuego->getMensajeJuego() . "</p>";
                    echo "<p>Queres volver a jugar?</p>";
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='submit' name='terminado' value='Volver a Jugar'>";
                    echo "</form>";
                }
            }
            ?>
        </article>
            <?php
            if (!isset($_COOKIE["ganadas"]) && !isset($_COOKIE["perdidas"])){
                setcookie("ganadas", 0, time() + (86400 * 30), "/");
                setcookie("perdidas", 0, time() + (86400 * 30), "/");
            }else{
                $partidasGanadas = $_COOKIE["ganadas"];
                $partidasPerdidas = $_COOKIE["perdidas"];
            ?>
            <table>
                <tr>
                    <th>Partidas Ganadas</th>
                    <th>Partidas Perdidas</th>
                </tr>
                <tr>
                    <td><?php echo $partidasGanadas; ?></td>
                    <td><?php echo $partidasPerdidas; ?></td>
                </tr>
            </table>
            <?php
            }
            ?>
    </section>
</body>
</html>