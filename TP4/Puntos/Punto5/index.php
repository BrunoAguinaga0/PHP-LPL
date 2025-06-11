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
    <h1>Bienvenido a la Calculadora de Comida para Mascotas</h1>
        <form id="formulario1" name="formulario" method="post" action="index.php">
            <div>
                <label>Usuario:</label>
                <input type="text" name="usuario" required placeholder="Usuario">
            </div>
            <input type="submit" name="ingresar" value="Ingresar">
        </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ingresar'])) {
        $usuario = $_POST['usuario'];
        setcookie("usuario", $usuario, time() + 3600); // Guardar usuario en cookie por 1 hora
        header("Location: Punto5.php"); 
        exit();
    }?>
    </section>
    
</body>
</html>