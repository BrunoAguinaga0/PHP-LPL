<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idInmueble']) && isset($_POST['Editar'])) {
        $idInmueble = $_POST['idInmueble'];
        $_SESSION['idInmueble'] = $idInmueble;
        header("Location: editar.php");
        exit();
    }
    if (isset($_POST['Eliminar']) && isset($_POST['idInmueble'])) {
        $idInmueble = $_POST['idInmueble'];
        $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos.");
        $query = "DELETE FROM inmueble WHERE idInmueble = $idInmueble";
        $resultado = $conexion->query($query) or die("No se pudo ejecutar la consulta.");
        $conexion->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=-, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <article>
            <button type="button" onclick="window.location.href='formulario.php'">Volver al Formulario</button>
            <button type="button" onclick="window.location.href='alquileres.php'">Inmuebles en Alquiler</button>
            <?php
                $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos.");
                $query = "SELECT * FROM inmueble ORDER BY idInmueble DESC LIMIT 10";
                $resultado = $conexion->query($query) or die("No se pudo ejecutar la consulta.");
                if ($resultado->num_rows>0){
                    ?>
                    <table>
                        <tr><th>ID Inmueble</th><th>Tipo de Inmueble</th><th>Domicilio</th><th>Dormitorios</th><th>Mejoras</th><th>Baños</th><th>Observacion</th><th>Editar</th><th>Eliminar</th></tr>
                    <?php
                    while($fila = $resultado->fetch_object()){
                        $idInmueble = $fila->idInmueble;
                        echo "<tr><td>$idInmueble</td>";
                        echo "<td>" . $fila->tipoInmueble . "</td>";
                        echo "<td>" . $fila->domicilio . "</td>";
                        echo "<td>" . $fila->cantidadDormitorios . "</td>";
                        echo "<td>" . $fila->mejoras . "</td>";
                        echo "<td>" . $fila->cantidadBanios . "</td>";
                        echo "<td>" . $fila->observacion . "</td>";
                        echo "<td>";?>
                        <form class='formulario1' method='post' action='index.php'>
                            <input type='hidden' name='idInmueble' value="<?php echo $idInmueble;?>">
                            <input type='submit' name='Editar' value='Editar'>
                        </form></td>
                        <td>
                        <form class='formulario1' method='post' action='index.php'>
                            <input type='hidden' name='idInmueble' value="<?php echo $idInmueble;?>">
                            <input type='submit' name='Eliminar' value='Eliminar'>
                        </form></td></tr>
                        <?php
                    }
                    echo "</table>";
                }else {
                    echo "No se encontraron resultados.";
                }
                $conexion->close();
            ?>
        </article>
    </section>
    </body>
</html>