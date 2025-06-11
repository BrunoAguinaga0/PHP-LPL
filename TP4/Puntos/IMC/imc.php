<?php
include_once('Paciente.class.php');
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora IMC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Calculadora de IMC</h1>
    </header>
    <section>
        <article>
            <form action="imc.php" method="post">
                <label for="paciente">Paciente:</label>
                <input type="text" id="paciente" name="paciente" required>

                <label for="peso">Peso (kg):</label>
                <input type="number" id="peso" name="peso" min="0" required>
                <label for="altura">Altura (m):</label>
                <input type="number" step="0.01" id="altura" name="altura" min="0" required>

                <button type="submit">Calcular IMC</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $paciente = htmlspecialchars($_POST["paciente"]);
                $peso = $_POST["peso"];
                $altura = $_POST["altura"];
                $resultado = "";

                if (isset($_POST["cerrar"])) {
                    $_SESSION = array();
                    session_destroy();
                    header("Location: index.php");
                }
                
                if ($altura > 0) {
                    $imc = $peso / ($altura * $altura);
                    echo "<h2>Paciente: " . $paciente . "</h2>";
                    echo "<h2>Peso: " . number_format($peso, 2) . " kg</h2>";
                    echo "<h2>Altura: " . number_format($altura, 2) . " m</h2>";
                    echo "<h2>Tu IMC es: " . number_format($imc, 2) . "</h2>";
                    
                    if ($imc < 18.5) {
                        echo "<h2>Estado: Bajo peso</h2>";
                        $resultado = "Bajo peso";
                    } elseif ($imc >= 18.5 && $imc < 24.9) {
                        echo "<h2>Estado: Peso normal</h2>";
                        $resultado = "Peso normal";
                    } elseif ($imc >= 25 && $imc < 29.9) {
                        echo "<h2>Estado: Sobrepeso</h2>";
                        $resultado = "Sobrepeso";       
                    } else {
                        echo "<h2>Estado: Obesidad</h2>";
                        $resultado = "Obesidad";    
                    }
                    $miPaciente = new Paciente($paciente, $peso, $altura, $imc, $resultado); 
                    // print_r($miPaciente);   
                } else {
                    echo "<h2>Error: La altura debe ser mayor que cero.</h2>";
                }
                if (!isset($_SESSION["pacientes-".$_COOKIE["usuario-actual"]])) {
                    $_SESSION["pacientes-".$_COOKIE["usuario-actual"]] = array();
                }
                array_push($_SESSION["pacientes-".$_COOKIE["usuario-actual"]],$miPaciente);
            }
            ?>
            <div id="contenedor-calculos">
                <?php
            if (isset($_SESSION["pacientes-".$_COOKIE["usuario-actual"]])) {
                echo "<h2>Calculos realizados hasta el momento por ".$_COOKIE["usuario-actual"].":</h2>";
                echo "<table>";
                echo "<tr><th>Paciente</th><th>IMC</th><th>Resultado</th></tr>";
                for ($i = 0; $i<count($_SESSION["pacientes-".$_COOKIE["usuario-actual"]]); $i++) {
                    echo "<tr><td>".$_SESSION["pacientes-".$_COOKIE["usuario-actual"]][$i]->getNombre()."</td><td>".number_format($_SESSION["pacientes-".$_COOKIE["usuario-actual"]][$i]->getImc(), 2)."</td><td>".$_SESSION["pacientes-".$_COOKIE["usuario-actual"]][$i]->getResultado()."</td></tr>";
                }
                echo "</table>";
            }
            ?>
            </div>
            <div id="contenedor-botones">
                <form action="imc.php" method="post">
                    <button name="cerrar">Cerrar Sesión</button>
                </form>
                <button><a href="login.php" style="text-decoration: none; color: inherit">Volver al Inicio</a></button>
            </div>
        </article>
    </section>
    <footer>
        <p>&copy; 2025</p>
    </footer>
</body>
</html>