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
            $ganado = false;
            if ($_SERVER["REQUEST_METHOD"] === "POST" ){
                if (isset($_POST["terminado"])){
                    setcookie("juegoEmpezado");
                    setcookie("numeroEncontrado");
                    setcookie("intentos");
                    header("Location: index.php");
                }
                if (!isset($_COOKIE["juegoEmpezado"])){
                    $Intentos = 10;
                    setcookie("intentos",$Intentos,time() + (86400 * 30), "/" );
                    $encontradoFinal = false;
                    while (!$encontradoFinal){
                        srand((double)microtime() * 10000000);
                        $num = rand(1, 2000);
                        $mitad = ($num / 2);
                        $encontrado = false;
                        $j = 1;
                        $k= 2;
                        while (!$encontrado && $j <= $num) {
                            $j += $k;
                            
                            if ($j == $mitad){
                                $encontrado = true;
                                $numeroPosible= $k+1;
                            }
                            $k = $k+1;
                            
                        }
                        $k+=1;
                        $y = $k+1;
                        while ($encontrado && $k <= $num){
                            $k += $y;
                            if($k==$mitad){
                                $encontradoFinal = true;
                                $encontrado = false;
                            }
                            $y = $y + 1;
                        }
                    }
                    $juegoEmpezado = $_POST["empezado"];
                    setcookie("juegoEmpezado", $juegoEmpezado, time() + (86400 * 30), "/");
                
                if ($encontradoFinal == true){
                    $centro = $numeroPosible;
                    setcookie("numeroEncontrado", $centro, time()+ (86400 * 30), "/");
                }}else{
                    $centroJuego =  $_COOKIE["numeroEncontrado"];
                    $numero = $_POST["numero"];
                        if ($numero == $centroJuego){
                            echo "<h1>GANASTE!!!!!!!!</h1>";
                            echo "<h1>El numero ingresado es el centro: $centroJuego</h1>";
                            $ganado = true;
                            $mensaje = "<button type='submit' name='terminado'>Volver a Jugar</button>";
                        } elseif ($numero < $centroJuego) {
                            if ($centroJuego - $numero <= 5) {
                                echo "<h1>El numero ingresado es cercano al centro</h1>";
                            }else{
                                echo "<h1>El numero ingresado es lejano al centro</h1>";
                                $Intentos = $_COOKIE["intentos"];
                                $Intentos -= 1;
                                setcookie("intentos",$Intentos,time() + (86400 * 30), "/" );
                            }
                        } elseif ($numero > $centroJuego){
                            if(($numero - $centroJuego) <= 5){
                                echo "<h1>El numero ingresado es cercano al centro</h1>";
                            }else{
                                $Intentos = $_COOKIE["intentos"];
                                $Intentos -= 1;
                                setcookie("intentos",$Intentos,time() + (86400 * 30), "/" );
                                echo "<h1>El numero ingresado es lejano al centro</h1>";
                                
                        }}}
                }
                ?>
            <form action="index.php" method="post">
                <label for="numero">Ingrese un numero positivo:</label>
                <input type="number" name="numero" id="numero" required min="1">
                <button type="submit" name="empezado" value="1">Enviar</button>	
                <?php
                    if (isset($_COOKIE["intentos"])){
                        $intentosJuego = $_COOKIE["intentos"];
                        echo "Intentos disponibles: $intentosJuego";
                    }else{
                        $intentosJuego = 10;
                        echo "Intentos disponibles: $intentosJuego";
                    }
                ?>
            </form>
            <form action="index.php" method="post">
                <?php
                    if ($ganado){
                        echo "$mensaje";
                    }
                ?>
            </form>
        </article>
    </section>
</body>
</html>