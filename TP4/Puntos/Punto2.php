<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        echo "<table><tr><th>D</th><th>L</th><th>M</th><th>M</th><th>J</th><th>V</th><th>S</th></tr>";
        $filaNueva = true;
        for($i = 1; $i<=31;$i++){
            if($i % 7 !== 0){
                if (!$filaNueva){
                        echo "<td>$i</td>";
                }else{
                    echo "<tr><td style='background-color: lightcoral;'>$i</td>";
                    $filaNueva = false;
                }
            }
            else{
                echo"<td style='background-color: lightgreen;'>$i</td>";
                echo"</tr>";
                $filaNueva = true;
            }
        }
        echo "</table>";
    ?>
</body>
</html>