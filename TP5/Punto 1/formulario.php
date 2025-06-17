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
                if (isset($_POST["btnTablas"])){
                    header("Location: index.php");
                    exit;
                }
                if (isset($_POST["btnFormulario"])){
                    $inmueble = $_POST["Inmueble"];
                    $domicilio = $_POST["domicilio"];
                    $dormitorios = $_POST["Dormitorios"];
                    $mejoras = $_POST["mejoras"];
                    $banios = $_POST["banios"];
                    $observacion = $_POST["observacion"];
                    $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos");
                    $query = "INSERT INTO inmueble (tipoInmueble, domicilio, cantidadDormitorios, mejoras, cantidadBanios,observacion) VALUES ('$inmueble','$domicilio',$dormitorios,'$mejoras',$banios,'$observacion')";
                    $resu = $conexion->query($query);
                    if($resu){
                        $conexion->commit();
                        echo "Datos Agregados";
                    }else{
                        $conexion->rollback();
                        echo "Fallo.";
                    }
                    $conexion->close();
                }
            }
            ?>
            <form action="formulario.php" method="post">
                <h2>Formulario Inmueble</h2>
                <label>Tipo de Inmueble</label>
                <input required name="Inmueble" placeholder="Tipo de Inmueble">
                <label>Domicilio</label>
                <input required name="domicilio" placeholder="Domicilio">
                <label>Cantidad de Dormitorios</label>
                <input required type="number" name="Dormitorios" placeholder="Dormitorios">
                <label>Baños</label>
                <input required type="number" name="banios" placeholder="Baños">
                <label>Mejoras</label>
                <input required name="mejoras" placeholder="Mejoras">
                <label>Observaciones</label>
                <input name="observacion" placeholder="Observaciones">
                <input type="submit" name="btnFormulario" value="Enviar Formulario">
                <button type="button" onclick="window.location.href='index.php'">Ver Inmuebles</button>
            </form>
        </article>
    </section>
</body>
</html>