<?php
require_once "../Classes/entities/tablero.class.php";
require_once "../Classes/database/conexionBD.php"; 
require_once "../Classes/database/PartidaDAO.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['tablero_jugador'])) {
    echo json_encode(["error" => "Acceso denegado"]);
    exit();
}

$tableroJugador = $_SESSION['tablero_jugador'];
$filas = $_SESSION['config_partida']['filas'];
$columnas = $_SESSION['config_partida']['columnas'];

if (!isset($_SESSION['ia_memoria']) || !isset($_SESSION['ia_memoria']['modo_caza'])) {
    
    $trampa_f = isset($_SESSION['ia_memoria']['trampa_f']) ? $_SESSION['ia_memoria']['trampa_f'] : -1;
    $trampa_c = isset($_SESSION['ia_memoria']['trampa_c']) ? $_SESSION['ia_memoria']['trampa_c'] : -1;
    $_SESSION['ia_memoria'] = [
        'modo_caza' => false,
        'origen_f' => -1,          
        'origen_c' => -1,          
        'cursor_f' => -1,          
        'cursor_c' => -1,
        'direcciones' => [],       
        'direccion_actual' => '',
        'trampa_f' => $trampa_f,  
        'trampa_c' => $trampa_c
    ];
}

$memoria = &$_SESSION['ia_memoria']; 
$disparoValido = false;
$f_final = -1;
$c_final = -1;
$resultado_final = "";

// --- 2. BUCLE DE DISPARO ---
while (!$disparoValido) {

    $f = -1;
    $c = -1;
    $resultado = ""; 

    if (isset($memoria['trampa_f']) && $memoria['trampa_f'] !== -1) {
        $f = $memoria['trampa_f'];
        $c = $memoria['trampa_c'];
        
        // Vaciamos la trampa para que no siga disparando ahí eternamente
        $memoria['trampa_f'] = -1;
        $memoria['trampa_c'] = -1;

    } 
    // 2. ESTAMOS CAZANDO?
    else if ($memoria['modo_caza']) {
        
        if (empty($memoria['direcciones']) && $memoria['direccion_actual'] === '') {
                $memoria['direcciones'] = ['arriba', 'abajo', 'izq', 'der'];
                shuffle($memoria['direcciones']); 
                $memoria['cursor_f'] = $memoria['origen_f'];
                $memoria['cursor_c'] = $memoria['origen_c'];
        }

        if ($memoria['direccion_actual'] === '') {
                $memoria['direccion_actual'] = array_pop($memoria['direcciones']);
                $memoria['cursor_f'] = $memoria['origen_f'];
                $memoria['cursor_c'] = $memoria['origen_c'];
        }

        $f_temp = $memoria['cursor_f'];
        $c_temp = $memoria['cursor_c'];

        switch ($memoria['direccion_actual']) {
            case 'arriba': $f_temp--; break;
            case 'abajo':  $f_temp++; break;
            case 'izq':    $c_temp--; break;
            case 'der':    $c_temp++; break;
        }

        if ($f_temp < 0 || $f_temp >= $filas || $c_temp < 0 || $c_temp >= $columnas) {
            $resultado = "borde";
        } else {
            $f = $f_temp;
            $c = $c_temp;
        }

    } 
    // 3. SINO, MODO AZAR
    else {
        $f = rand(0, $filas - 1);
        $c = rand(0, $columnas - 1);
    }

    // --- 3. DISPARO ---
    if ($resultado !== "borde") { 
        $resultado = $tableroJugador->recibirDisparo($f, $c);
    }

    // --- 4. EVALUAR QUÉ PASÓ ---
    if ($resultado !== "repetido" && $resultado !== "borde") {
        
        $disparoValido = true; 
        $f_final = $f;
        $c_final = $c;
        $resultado_final = $resultado;
        
        if ($resultado === "tocado") {
            if (!$memoria['modo_caza']) {
                $memoria['modo_caza'] = true;
                $memoria['origen_f'] = $f;
                $memoria['origen_c'] = $c;
                $memoria['direcciones'] = []; 
                $memoria['direccion_actual'] = '';
            } else {
                $memoria['cursor_f'] = $f;
                $memoria['cursor_c'] = $c;
            }
        } else if ($resultado === "agua") {
            if ($memoria['modo_caza']) {
                $memoria['direccion_actual'] = '';
                
                if (empty($memoria['direcciones'])) {
                    $memoria['modo_caza'] = false;
                }
            }
        }
    } else {
        if ($memoria['modo_caza']) {
                $memoria['direccion_actual'] = ''; 
            
            if (empty($memoria['direcciones'])) {
                $memoria['modo_caza'] = false;
            }
        }
    }
    }

    // --- 5. PREPARAR RESPUESTA ---
    $respuesta = [
    "fila" => $f_final,
    "columna" => $c_final,
    "resultado" => $resultado_final,
    "victoria_ia" => false
    ];

    if ($resultado_final === "tocado") {
    if (!$tableroJugador->quedanBarcos()) {
        $respuesta["victoria_ia"] = true;
        $_SESSION['config_partida']['estado'] = 'derrota'; 
        
        $bd = new ConexionBD();
        $partida = new PartidaDAO($bd);
        
        $segundosJugados = time() - $_SESSION['config_partida']['tiempo_inicio'];
        $fecha = isset($_SESSION['config_partida']['fecha_partida']) ? $_SESSION['config_partida']['fecha_partida'] : date('Y-m-d H:i:s');
        
        $partida->guardarPartida($_SESSION["id_usuario"], $fecha, $segundosJugados, 'derrota');
    }
    }

    $_SESSION['tablero_jugador'] = $tableroJugador;
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
    ?>