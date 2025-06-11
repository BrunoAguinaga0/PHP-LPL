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
        <?php
        if (!isset($_COOKIE["usuario"])) {
            header("Location: index.php");
            exit();
        }else {
            $usuario = $_COOKIE["usuario"];
        }
        if (isset($_COOKIE[$usuario]))
        {
            $datos = json_decode($_COOKIE[$usuario], true);
            echo "<h2>Bienvenido de nuevo, $usuario</h2>";
            echo "<h3>Datos guardados:</h3>";
            echo "<p>Tu mascota es un: " . $datos['tipoMascota'] . "</p>";
            echo "<p>Se llama: " . $datos['mascota'] . "</p>";
            echo "<p>La cantidad de comida que consume en el mes es de " . $datos['cantidad'] . " kg.</p>";
            echo "<p>El tipo de bolsa elegido es de: " . $datos['tipo_bolsa'] . " Kg</p>";
            echo "<p>La cantidad de bolsas necesarias para cubrir el mes es de " . $datos['cantBolsas'] . ".</p>";
            ?>
            <form method="post" action="Punto5.php">
                <input type="submit" name="borrar" value="Ingresar Nuevos Datos">
            </form>
        <?php
            if (isset($_POST['borrar'])) {
                setcookie($usuario, "", time() - 3600); // Borrar la cookie
                header("Location: Punto5.php"); // Redirigir a la misma página para mostrar el formulario
                exit();
            }
    }else {
        ?>
        <h2>Calculadora de Comida</h2>
        <form name="formulario" method="post" action="Punto5.php">
            <div>
            <label>Nombre Mascota:</label>
            <input type="text" name="mascota" required>
            </div>
            <div>
            <label>Tipo de Mascota:</label>
            <select name="mascota1">
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="loro">Loro</option>
            </select>
            </div>
            <div>
            <label>Cantidad de comida (en gramos):</label>
            <input type="number" name="cantidad" required>
            </div>
            <div>
            <label>Tipo de bolsa</label>
            <select name="tipo_bolsa">
                <option value="0.5">1/2Kg</option>
                <option value="1">1Kg</option>
                <option value="3">3Kg</option>
            </select>
            </div>
            <input type="submit" name="calcular">
        </form>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calcular'])) {
            $mascota = $_POST['mascota'];
            $cantidad = ($_POST['cantidad'] * 31) / 1000; // Convertir gramos a kilogramos
            $tipo_bolsa = $_POST['tipo_bolsa'];
            $cantBolsas = ceil($cantidad / $tipo_bolsa);//Ceil redondea hacia arriba
            $tipoMascota = $_POST['mascota1'];
            echo "<h2>Bienvenido, $usuario</h2>";
            echo "<h3>Resultados:</h3>";
            echo "<p>Tu mascota es: $mascota</p>";
            echo "<p>El tipo de bolsa elegido es de: $tipo_bolsa Kg</p>";
            echo "<p>La cantidad de comida es de $cantidad kg.</p>";
            echo "<p>La cantidad de bolsas necesarias es de $cantBolsas.</p>";
            $datos = [
                'mascota' => $mascota,
                'cantidad' => $cantidad,
                'tipo_bolsa' => $tipo_bolsa,
                'cantBolsas' => $cantBolsas,
                'tipoMascota' => $tipoMascota
            ];
            setcookie($usuario, json_encode($datos), time() + 3600); // Guardar datos en cookie por 1 hora
        }}
        ?>
    </section>
</body>
</html>