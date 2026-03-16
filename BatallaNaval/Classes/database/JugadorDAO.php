<?php 
class JugadorDAO{
    private $bd;
    public function __construct($baseDatos){
        $this->bd = $baseDatos;
    }
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
    public function registrarJugador($nombre, $contrasenia){
        $this->bd->comenzar_transaccion();
        $sql = "INSERT INTO jugadores (nombre_jugador, password_jugador) VALUES (?, ?)";
        $hash = password_hash($contrasenia, PASSWORD_DEFAULT);
        $resultado = $this->bd->bd_insertar($sql, "ss", [$nombre, $hash]);
        if($resultado){
            $id = $this->bd->insert_id();
            $this->bd->confirmar_transaccion();
            return $id;
            }
        $this->bd->cancelar_transaccion();
        return false;
    }
    public function existeUsuario($nombre){
        $sql = "SELECT id_jugador FROM jugadores WHERE nombre_jugador = ? LIMIT 1";
        $resultado = $this->bd->bd_consulta($sql, "s", [$nombre]);
        return count($resultado) > 0;
    }
        }
?>