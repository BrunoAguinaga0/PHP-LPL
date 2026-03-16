<?php 
class JugadorDAO{
    private $bd;
    public function __construct($baseDatos){
        $this->bd = $baseDatos->getConexion();
    }
    public function autenticarJugador ($nombre, $contrasenia){
        $sql = "SELECT * FROM jugadores WHERE nombre = ?";
        $stmt = $this->bd->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($jugador = $resultado->fetch_object()) {
            if (password_verify($contrasenia, $jugador->password_jugador)) {
                return $jugador;
            }
        }
        return null;
        }
    public function registrarJugador($nombre, $contrasenia){
        $this->bd->begin_transaction();
        $hash = password_hash($contrasenia, PASSWORD_DEFAULT);
        $sql = "INSERT INTO jugadores (nombre, password_jugador) VALUES (?, ?)";
        $stmt = $this->bd->prepare($sql);
        $stmt->bind_param("ss", $nombre, $hash);
        if($stmt->execute()){
            $this->bd->commit();
            return $this->bd->insert_id;
        }else{
            $this->bd->rollback();
            return false;
        }
    }
    public function existeUsuario($nombre){
        $sql = "SELECT * FROM jugadores WHERE nombre = ?";
        $stmt = $this->bd->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows > 0;
    }
        }
?>