<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <section>
        <article>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST["btnVolver"])){
                        header("Location: index.php");
                        exit();
                    }
                    if (isset($_POST["btnFormulario"])){
                        $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos.");
                        $idInmueble = $_SESSION['idInmueble'];
                        $tipoInmueble = $_POST["Inmueble"];
                        $domicilio = $_POST["domicilio"];
                        $dormitorios = $_POST["Dormitorios"];
                        $banios = $_POST["banios"];
                        $mejoras = $_POST["mejoras"];
                        $observaciones = $_POST["observacion"];
                        $query = "UPDATE inmobilaria.inmueble set tipoInmueble='$tipoInmueble',domicilio='$domicilio',cantidadDormitorios=$dormitorios,cantidadBanios=$banios,mejoras='$mejoras',observacion='$observaciones' where idInmueble=$idInmueble";
                        $resultado = $conexion->query($query) or die("No se pudo ejecutar la consulta.");
                        echo "<h1>Inmueble editado con exito</h1>";
                    }
                }
                if (isset($_SESSION['idInmueble'])) {
                    $idInmueble = $_SESSION['idInmueble'];
                    $conexion = new mysqli("localhost","root","", "inmobilaria") or die("No se pudo conectar a la Base de Datos.");
                    $query = "SELECT * FROM inmueble WHERE idInmueble = $idInmueble";
                    $resultado = $conexion->query($query) or die("No se pudo ejecutar la consulta.");
                    if ($resultado->num_rows>0){
                        $objeto = $resultado->fetch_object();
                        $tipoInmueble = $objeto->tipoInmueble;
                        $domicilio = $objeto->domicilio;
                        $dormitorios = $objeto->cantidadDormitorios;
                        $banios = $objeto->cantidadBanios;
                        $mejoras = $objeto->mejoras;
                        $observaciones = $objeto->observacion;
                        ?>
                        <div id="contenedor">
                        <div id="encabezado">
                            <h2>Editar Inmueble</h2>
                            <label>ID Inmueble: <?php echo $idInmueble; ?></label>
                        </div>
                        <form action="editar.php" method="post">
                            <label>Tipo de Inmueble</label>
                            <select name="Inmueble">
                                <option value="Casa" <?= $tipoInmueble === "Casa" ? "selected" : "" ?>>Casa</option>
                                <option value="Departamento" <?= $tipoInmueble === "Departamento" ? "selected" : "" ?>>Departamento</option>
                                <option value="Terreno" <?= $tipoInmueble === "Terreno" ? "selected" : "" ?>>Terreno</option>
                                <option value="Quinta" <?= $tipoInmueble === "Quinta" ? "selected" : "" ?>>Quinta</option>
                            </select>
                            <label>Domicilio</label>
                            <input required name="domicilio" placeholder="Domicilio" value="<?php echo $domicilio; ?>">
                            <label>Dormitorios</label>
                            <input required type="number" name="Dormitorios" placeholder="Dormitorios" value="<?php echo $dormitorios; ?>">
                            <label>Baños</label>
                            <input required type="number" name="banios" placeholder="Baños" value="<?php echo $banios; ?>">
                            <label>Mejoras</label>
                            <select name="mejoras">
                                <option value="Garage" <?= $mejoras === "Garage" ? "selected" : "" ?>>Garage</option>
                                <option value="Sin Cerco" <?= $mejoras === "Sin Cerco" ? "selected" : "" ?>>Sin Cerco</option>
                                <option value="Cercado" <?= $mejoras === "Cercado" ? "selected" : "" ?>>Cercado</option>
                                <option value="Jardin" <?= $mejoras === "Jardin" ? "selected" : "" ?>>Jardin</option>
                                <option value="Piscina" <?= $mejoras === "Piscina" ? "selected" : "" ?>>Piscina</option>
                            </select>
                            <label>Observaciones</label>
                            <input name="observacion" placeholder="Observaciones" value="<?php echo $observaciones; ?>">
                            <input type="submit" name="btnVolver" value="Volver a Inmuebles">
                            <input type="submit" name="btnFormulario" value="Enviar Formulario">
                            </form>
                            </div>
                        <?php
                    }
                }
                else{
                    echo "No se ha proporcionado un ID de inmueble.";
                }
            ?>
        </article>
    </section>
</body>
</html>