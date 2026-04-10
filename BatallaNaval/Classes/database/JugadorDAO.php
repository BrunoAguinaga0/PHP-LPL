<?php 
class JugadorDAO{
    private $bd;
    public function __construct($baseDatos){
        $this->bd = $baseDatos;
    }
//Autentica al jugador
    public function autenticarJugador ($nombre, $contrasenia){
        $sql = "SELECT * FROM jugadores WHERE nombre_jugador = ? LIMIT 1";
        $resultado = $this->bd->bd_consulta($sql, "s", [$nombre]);
        if (!empty($resultado)) {
            $jugador = $resultado[0];
            if (password_verify($contrasenia, $jugador["password_jugador"])) {
                return $jugador;
            }
        }
        return null;
        }
//Registra al jugador
    public function registrarJugador($nombre, $contrasenia){
        $this->bd->comenzar_transaccion();
        $sql = "INSERT INTO jugadores (nombre_jugador, password_jugador) VALUES (?, ?)";
        $hash = password_hash($contrasenia, PASSWORD_DEFAULT);
        $resultado = $this->bd->bd_ejecutar($sql, "ss", [$nombre, $hash]);
        if($resultado){
            $id = $this->bd->insert_id();
            $this->bd->confirmar_transaccion();
            return $id;
            }
        $this->bd->cancelar_transaccion();
        return false;
    }
//Verifica si el jugador existe
    public function existeUsuario($nombre){
        $sql = "SELECT id_jugador FROM jugadores WHERE nombre_jugador = ? LIMIT 1";
        $resultado = $this->bd->bd_consulta($sql, "s", [$nombre]);
        return count($resultado) > 0;
    }
//Devuelve el token del jugador de la cookie recuerdame
    public function obtener_jugador_token($token){
        $sql = "SELECT id_jugador FROM jugadores WHERE token_recuerdame = ? LIMIT 1";
        $resultado = $this->bd->bd_consulta($sql, "s", [$token]);
        if (!empty($resultado)) {
            return $resultado[0];
        }
        return null;
    }

//Guarda el token de la cookie recuerdame
    public function guardarToken($id_jugador, $token){
        $sql = "UPDATE jugadores SET token_recuerdame = ? WHERE id_jugador = ?";
        return $this->bd->bd_ejecutar($sql, "si",[$token,$id_jugador]);
    }

//Devuelve los datos del jugador con el token
    public function get_datos_recuerdame($token){
        $sql = "SELECT nombre_jugador, id_jugador FROM jugadores WHERE token_recuerdame = ?";
        $resultado = $this->bd->bd_consulta($sql,"s",[$token]);
        return $resultado[0];
        }
//Devuelve las 5 mejores partidas del usuario
    public function recordsJugador($id_jugador){
        $sql = "SELECT * FROM partidas WHERE id_jugador = ? and resultado = 'victoria' ORDER BY tiempo_segundos ASC LIMIT 5";
        return $this->bd->bd_consulta($sql,"i",[$id_jugador]);
    }
}

?>