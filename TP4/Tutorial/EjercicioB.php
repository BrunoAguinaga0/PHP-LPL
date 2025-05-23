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
    $frase = "ejercicio B en PHP";
    echo "frase: " . $frase . "<br>";
    echo "La longitud de la frase es: " . strlen($frase) . "<br>"; 
    echo "Mayusculas: " . strtoupper($frase) . "<br>";
    echo "Cantidad de e en la cadena: " . substr_count($frase, "e") . "<br>";
    echo "Frase invertida: " . strrev($frase);
    ?>
</body>
</html>