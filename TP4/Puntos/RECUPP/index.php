<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Ingresar</h1>
    </header>
    <section>
        <article>
            <form action="index.php" method="post">
                <input type="text" required name="usuario" placeholder="Usuario" />
                <button type="submit" name="ingresar">Ingresar</button>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ingresar"])) {
                    $usuario = $_POST["usuario"];
                    setcookie("usuario", $usuario, time() + 3600);
                    header("Location: gestor.php"); 
                    exit();
                }
            ?>
        </article>
    </section>
    <footer>
        <p>&copy; 2025</p>
    </footer>
</body>
</html>