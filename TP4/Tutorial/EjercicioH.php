<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $sumatoria = 0;
        for ($i=0; $i < 10; $i++){
            srand((double)microtime() * 10000000);
            $num = rand(0,9);
            $vector[$i] = $num;
            $sumatoria += $num;
            $promedio = $sumatoria / 10;
        }
        echo "Arreglo aleatorio: " . implode(" - ", $vector) . "<br> Cantidad de elementos: " . count($vector);
        echo "<br>";
        echo "La sumatoria del vector es: $sumatoria";
        echo "<br>Primer elemento: " . array_shift($vector) . "<br> Ultimo Elemento: " . array_pop($vector);
        if (in_array(5,$vector)) {
            echo "<br>El numero 5 esta en el arreglo";
        }else{
            echo "<br>El numero 5 no esta en el arreglo";
        }
        echo "<br>El promedio de los numeros del vector es: $promedio";
        sort($vector);
        echo "<br>Arreglo ordenado: " . implode(" - ", $vector);
    ?>
</body>
</html>