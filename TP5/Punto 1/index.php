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
            <?php
                $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos.");
                $query = "SELECT * FROM inmueble ORDER BY idInmueble DESC LIMIT 10";
                $resultado = $conexion->query($query) or die("No se pudo ejecutar la consulta.");
                if ($resultado->num_rows>0){
                    ?>
                    <table>
                        <tr><th>ID Inmueble</th><th>Tipo de Inmueble</th><th>Domicilio</th><th>Dormitorios</th><th>Mejoras</th><th>Baños</th><th>Observacion</th></tr>
                    <?php
                    while($fila = $resultado->fetch_object()){
                        echo "<tr><td>" . $fila->idInmueble . "</td>";
                        echo "<td>" . $fila->tipoInmueble . "</td>";
                        echo "<td>" . $fila->domicilio . "</td>";
                        echo "<td>" . $fila->cantidadDormitorios . "</td>";
                        echo "<td>" . $fila->mejoras . "</td>";
                        echo "<td>" . $fila->cantidadBanios . "</td>";
                        echo "<td>" . $fila->observacion . "</td></tr>";
                    }
                }else {
                    echo "No se encontraron resultados.";
                }
                $conexion->close();
            ?>
        </article>
    </section>
    </body>
</html>