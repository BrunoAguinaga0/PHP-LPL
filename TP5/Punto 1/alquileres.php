<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <article>
            <?php 
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                if (isset($_POST["btnInmuebles"])){
                    header("Location: index.php");
                    exit;
                }
                if (isset($_POST["btnFormulario"])){
                    header("Location: formulario.php");
                    exit;
                }
            }?>
            <h1 id="h1Alquiler">Alquileres Disponibles</h1>
            <?php
            $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos.");
            $sql = "SELECT i.tipoInmueble, i.domicilio, o.FechaInicio , o.importe FROM inmueble i INNER JOIN operacion o ON i.idInmueble = o.idInmueble WHERE o.tipoOperacion like 'Alquiler' LIMIT 0, 30 ";
            ?>
            <table><tr>
                <th>Tipo de Inmueble</th>
                <th>Domicilio</th>
                <th>Fecha de Inicio</th>
                <th>Importe</th>
            </tr>
            <?php
            $resultado = $conexion->query($sql) or die("No se pudo ejecutar la consulta.");
            while($fila = $resultado->fetch_object()){
                echo "<tr>";
                echo "<td>" . $fila->tipoInmueble . "</td>";
                echo "<td>" . $fila->domicilio . "</td>";
                echo "<td>" . $fila->FechaInicio . "</td>";
                echo "<td>" . $fila->importe . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            $conexion->close();
            ?>
            <form id="formAlquiler" method="post" action="alquileres.php">
                <input type="submit" name="btnInmuebles" value="Volver a Inmuebles">
                <input type="submit" name="btnFormulario" value="Volver al Formulario">
            </form>
        </article>
    </section>
</body>
</html>