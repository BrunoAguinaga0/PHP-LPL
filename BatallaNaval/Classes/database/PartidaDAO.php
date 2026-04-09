<?php 
class PartidaDAO{
    private $bd;
    public function __construct($baseDatos){
        $this->bd = $baseDatos;
    }

    public function traer_ultima_partida($id_jugador){
        $sql = "SELECT * FROM partidas WHERE id_jugador = ? ORDER BY fecha_partida DESC LIMIT 1";
        $partida = $this->bd->bd_consulta($sql,"i",[$id_jugador]);
        if(!empty($partida)){
            return $partida[0];
        }
        return NULL;
    }

    public function guardarPartida($id_jugador, $fecha_partida, $tiempo_segundos, $resultado){
        $this->bd->comenzar_transaccion();
        $sql = "INSERT into partidas (id_jugador,fecha_partida,tiempo_segundos,resultado) VALUES (?,?,?,?)";
        $partida = $this->bd->bd_ejecutar($sql,"isis",[$id_jugador,$fecha_partida,$tiempo_segundos,$resultado]);
        if($partida){
            $this->bd->confirmar_transaccion();
            return true;
        }
        $this->bd->cancelar_transaccion();
        return false;
        }
    
    public function rankingTop5(){
        $sql = "SELECT * FROM partidas WHERE resultado = 'victoria' ORDER BY tiempo_segundos ASC LIMIT 5";
        return $this->bd->bd_consulta($sql);
    }
}
?>