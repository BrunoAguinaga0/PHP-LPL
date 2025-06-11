<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"   ){
            $num = $_POST["num"];
            $encontradoFinal = false;
            $mitad = ($num / 2);
            echo "mitad: $mitad <br>";
            $encontrado = false;
            $j = 1;
            $k= 2;
            while (!$encontrado && $j <= $num) {
                $j += $k;
                
                if ($j == $mitad){
                    echo "encontrado true j: $j <br>";
                    $encontrado = true;
                    $numeroPosible= $k+1;
                    echo "$k + 1 = $numeroPosible <br>";
                }
                $k = $k+1;
                
            }
            $k+=1;
            $y = $k+1;
            echo "antes del segundo bucle k: $k <br>";
            while ($encontrado && $k <= $num){
                echo "a ver: $y <br>";
                $k += $y;
                if($k==$mitad){
                    $encontradoFinal = true;
                    $encontrado = false;
                }
                $y = $y + 1;
            }
        }
        if ($encontradoFinal == true){
            echo "El primer numero encontrado entre el 1 y el numero elegido es $numeroPosible";
        }else {
            echo "No se encontro ningun numero"; 
        }
    ?>
    <form action="prueba.php" method="post">
        <input type="number" name="num" id="numero" required placeholder="Ingrese un número">
    </form>
</body>
</html>