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
    for ($j=1;$j<11;$j++){
        echo "<div class='contenedor'>";
        $multiplicador = $j;
        echo "<h3>Tabla de multiplicar del $multiplicador</h3>";
        echo "<table>";
        echo "<tr>";
        for ($i=0;$i<11;$i++){
            if ($i == 0){
                echo "<th>*</th>";
            }else{
                echo "<th>$i</th>";
            }
        }
        echo "</tr>";
        echo "<tr>";
        for ($i=0;$i<11;$i++){
            if ($i == 0){
                echo "<th>$multiplicador</th>";
            }else{
                echo "<th>".$i*$multiplicador."</th>";
            }
        }
        echo "</tr>";
        echo "</table>";
        echo "</div>";
    }
    ?>

</body>
</html>