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
    $num1 = 5;
    $num2 = 10;
    if ($num1 > $num2){
        $potencia = 1;
        for ($i=0; $i < $num2; $i++){
            $potencia = $potencia * $num1;
        }
        echo "$num1 elevado a $num2 es: " . $potencia . "<br>";
    }else{
        $i=$num2;
        $cociente=0;
        while($i >= $num1){
            $cociente++;
            $i -= $num1;
        }
        echo "$num2 dividido $num1 es: " . $cociente . " y su resto es: $i" . "<br>";
    }
    ?>
    
</body>
</html>