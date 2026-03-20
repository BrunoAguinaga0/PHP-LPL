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
}
?>