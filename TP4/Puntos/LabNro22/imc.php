<?php
require_once('paciente.class.php');
session_start();

$imprimir = "";
$paciente = null; // Inicializar $paciente
$nombre = "";     // Inicializar $nombre
$peso = 0;        // Inicializar $peso
$altura = 0;      // Inicializar $altura

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    // Lógica para cerrar sesión
    if (isset($_POST["cerrar"])) {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
        exit(); // ¡Importante para detener la ejecución del script!
    }

    // Lógica para calcular IMC y guardar paciente
    // Solo si no se está intentando cerrar sesión
    if (!isset($_POST["cerrar"])) {
        $nombre = htmlspecialchars($_POST["paciente"]);
        $peso = $_POST["peso"];
        $altura = $_POST["altura"];

        if ($altura > 0 && $peso > 0 ) {
            $paciente = new Paciente($nombre, $peso, $altura); // Crear objeto Paciente solo si los datos son válidos
            $imprimir .= "<h4>Paciente: " . $paciente->getNombre() . "</h4>";
            $imprimir .= "<h4>Peso: " . number_format($paciente->getPeso(), 2) . " kg</h4>";
            $imprimir .= "<h4>Altura: " . number_format($paciente->getAltura(), 2) . " cm</h4>";
            $imprimir .= "<h4>Tu IMC es: " . number_format($paciente->getIMC(), 2) . "</h4>";
            $imprimir .= "<h4>Estado: " . $paciente->getResultado() . "</h4>";

            // Guardar paciente en la sesión
            $clave_sesion_pacientes = "PacientesDe-" . $_COOKIE["usuario"];
            if (!isset($_SESSION[$clave_sesion_pacientes])) {
                $_SESSION[$clave_sesion_pacientes] = [];
            }
            array_push($_SESSION[$clave_sesion_pacientes], $paciente);
        } else {
            $imprimir = "<p>Error: La altura y el peso deben ser mayores a 0.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <section>
        <article id="imc">
            <h1>Calculadora de IMC</h1>
            <form action="imc.php" method="post">
                <input type="text" name="paciente" placeholder="Nombre del Paciente" required>
                <input type="number" name="peso" placeholder="Peso (kg)" required min="0.01" step="0.01"> <input type="number" name="altura" placeholder="Altura (cm)" required min="0.01" step="0.01"> <input type="submit" value="Calcular IMC">
            </form>
        </article>
        <article id="resultado">
            <?php
            echo $imprimir;
            echo "<table><tr><th>Paciente</th><th>IMC</th><th>Resultado</th></tr>";
            // Solo mostrar si la clave existe Y es un array
            $clave = "PacientesDe-" . $_COOKIE["usuario"];
            if (isset($_SESSION[$clave]) && is_array($_SESSION[$clave])) {
                for ($i = 0; $i < count($_SESSION[$clave]); $i++) {
                    $paciente_en_lista = $_SESSION[$clave][$i]; // Usar un nombre de variable diferente
                    if ($paciente_en_lista instanceof Paciente) { // Verificar si es una instancia válida
                        echo "<tr>";
                        echo "<td>" . $paciente_en_lista->getNombre() . "</td>";
                        echo "<td>" . intVal($paciente_en_lista->getIMC()) . "</td>"; // intVal podría redondear demasiado, considera number_format
                        echo "<td>" . $paciente_en_lista->getResultado() . "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='3'>No hay pacientes registrados.</td></tr>";
            }

            echo "</table>";
            ?>
        </article>
        <form action="imc.php" method="post">
            <input type="submit" name="cerrar" value="Cerrar Sesión">
        </form>
    </section>
</body>
</html>