<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        srand((double)microtime() * 10000000);
        $num = rand(2,15);
        for (i=5; i<=100, i++){
            
        }
        $numAux = 0;
        echo "<table>";
        for ($i = 0; $numAux < $num; $i++){
            echo "<tr>";
            for ($j = 0; $j < $numAux; $j++){
                echo "<td>$numAux</td>";
            }
            $numAux+= 1;
            echo "</tr>";
        }

        echo "</table>";
    ?>
</body>
</html>