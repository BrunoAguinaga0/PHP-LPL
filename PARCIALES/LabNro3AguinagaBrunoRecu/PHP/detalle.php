<?php
include_once('producto.class.php');
$nombre = $_GET['nombre'] ?? '';
$filtro = $_GET['filtro'] ?? '';
$ubicacion = $_GET['ubicacion'] ?? '';
$criterio = $_GET['criterio'] ?? '';
if ($criterio == "1"){
    if ($filtro == "1"){
        $producto = Producto::buscarProducto($nombre);
    }elseif ($filtro == "2"){
        $producto = Producto::buscoCombinado($nombre, $ubicacion);
    }
}else{
    $producto = Producto::buscoCombinado($nombre, $ubicacion);
}
$rta = buscoMinimo($producto);
$maximo = buscoMaximo($producto);
function buscoMinimo($producto) {
    if (is_null($producto)) {
        return false;
    } else {
        $minimo = $producto[0]->getPrecio();
        $ubicacion = $producto[0]->getUbicacion();
        $supermercado = $producto[0]->getSupermercado();
        foreach ($producto as $p) {
            if ($p->getPrecio() < $minimo) {
                $minimo = $p->getPrecio();
                $ubicacion = $p->getUbicacion();
                $supermercado = $p->getSupermercado();
            }
        }
        return array('precio' => $minimo, 'ubicacion' => $ubicacion, 'supermercado' => $supermercado);
    }
}
function buscoMaximo($producto) {
    if (is_null($producto)) {
        return false;
    } else {
        $maximo = $producto[0]->getPrecio();
        foreach ($producto as $p) {
            if ($p->getPrecio() > $maximo) {
                $maximo = $p->getPrecio();
            }
        }
        return $maximo;
    }
}
function encuentro($producto) {
    if (is_null($producto)) {
        return false;
    } else {
        return true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../HTML/styles.css">
</head>
<body>
    <section>
        <header>
            <input id="volver" type="button" value="Volver" onclick="location.href='../HTML/index.html'">
            <div>
                <h1>Detalle del Producto</h1>
                <h3><strong>Producto:</strong> <?php echo $nombre; ?></h3>
            </div>
        </header>
        <article>
            <table>
                <thead>
                <tr>
                    <th>Supermercado</th>
                    <th>Precio</th>
                    <th>Ubicación</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($producto as $p) {
                        echo "<tr>";
                        echo "<td>" . $p->getSupermercado() . "</td>";
                        echo "<td>" . $p->getPrecio() . "</td>";
                        echo "<td>" . $p->getUbicacion() . "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <p><strong>Precio mas bajo:</strong> supermercado con el precio mas economico es <strong><?php echo $rta['supermercado'] . " - " . $rta['ubicacion']; ?></strong></p>
            <p><strong>Diferencia entre el precio mas bajo y el mas alto:</strong> <?php echo $maximo . "-" . $rta['precio'] . "=" . ($maximo - $rta['precio']); ?></p>
        </article>
    </section>
</body>
</html>