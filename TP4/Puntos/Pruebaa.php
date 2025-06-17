<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function calculoCentroNumerico($numero) {
    $sumatoria = 0;
    $sumatoria2 = 0;
    for ($i = 1; $i < $numero; $i++) {
        $sumatoria += $i;
    }
    for ($i = $numero + 1; $sumatoria2 < $sumatoria; $i++) {
        $sumatoria2 += $i;
    }
    return $sumatoria2 == $sumatoria;
}

for ($n = 1; $n < 50; $n++) {
    if (calculoCentroNumerico($n)) {
        echo "Centro numérico: $n\n";
    }
}
?>
</body>
</html>