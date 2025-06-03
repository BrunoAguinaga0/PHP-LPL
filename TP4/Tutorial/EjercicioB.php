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
    $num1 = 2;
    $num2 = 5;
    $j = 0;
    $frase = "ejercicio B en PHP";
    echo "frase: " . $frase . "<br>";
    echo "La longitud de la frase es: " . strlen($frase) . "<br>"; 
    echo "Mayusculas: " . strtoupper($frase) . "<br>";
    echo "Cantidad de e en la cadena: " . substr_count($frase, "e") . "<br>";
    echo "Frase invertida: " . strrev($frase);
    for ($i = 0; $i <= $num2; $i++){
        $potenicas[] = $num1 ** $i;
    }
    echo "<br> ------------------------------------------------";
    foreach ($potenicas as $valor) {
        echo "<br>";
        echo "$num1 Elevado a $j es: $valor";
        $j += 1;
    }
    ?>
</body>
</html>