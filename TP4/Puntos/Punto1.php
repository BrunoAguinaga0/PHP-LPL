<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Tutorial/style.css">
</head>
<body>
    <?php
        for ($i = 0; $i <= 1000;$i++){
            $contador = 0;
            for ($j = 2; $j <= $i; $j++){
                if ($i % $j == 0){
                    $contador++;
                }
            }
            $esPrimo = $contador == 1;
            if ($i % 2 == 0){
                $pares[] = $i;
            }else{
                $impares[] = $i;
            }
            if ($esPrimo){
                $primos[] = $i;
            }
        }
        echo "<div id='tablas'>";
        echo "<table><tr><th>Pares</th></tr>";
        foreach ($pares as $par){
            echo "<tr><td>$par</td></tr>";
        }
        echo "</table>";

        echo "<table><tr><th>Impares</th></tr>";
        foreach ($impares as $impar){
            echo "<tr><td>$impar</td></tr>";
        }
        echo "</table>";

        echo "<table><tr><th>Primos</th></tr>";
        foreach ($primos as $primo){
            echo "<tr><td>$primo</td></tr>";
        }
        echo "</table>";
        echo "</div>"

    ?>
</body>
</html>