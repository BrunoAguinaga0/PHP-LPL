<?php 
class PartidaDAO{
    private $bd;
    public function __construct($baseDatos){
        $this->bd = $baseDatos;
    }
//devuelve la partida mas reciente
    public function traer_ultima_partida($id_jugador){
        $sql = "SELECT * FROM partidas WHERE id_jugador = ? ORDER BY fecha_partida DESC LIMIT 1";
        $partida = $this->bd->bd_consulta($sql,"i",[$id_jugador]);
        if(!empty($partida)){
            return $partida[0];
        }
        return NULL;
    }
//Guarda una partida
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
    //Devuelve el top 5 mejores jugadores
    public function rankingTop5(){
        $sql = "SELECT u.nombre_jugador, p.tiempo_segundos FROM partidas p
        INNER JOIN jugadores u ON p.id_jugador = u.id_jugador WHERE p.resultado = 'victoria' ORDER BY p.tiempo_segundos ASC LIMIT 5";
        return $this->bd->bd_consulta($sql);

    }
}
?>