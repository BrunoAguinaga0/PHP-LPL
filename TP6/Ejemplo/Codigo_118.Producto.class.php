<?php
class producto
{
	private $idProducto;
	private $descripcion;
	private $precio;
	
	public function __construct()
	{								}
	
	public function getIdProducto()
	{	return $this->idProducto;	}
	
	public function setIdProducto($newId)
	{	$this->idProducto = $newId;	}
	
	public function getDescripcion()
	{	return $this->descripcion;	}
	
	public function setDescripcion($newDescripcion)
	{	$this->descripcion = $newDescripcion;	}
	
	public function getPrecio()
	{ return $this->precio;		}
	
	public function setPrecio($newPrecio)
	{ $this->precio = $newPrecio;	}
	
	public static function getProductosBD()
	{
		$listaProductos = array();
		$con = new mysqli("localhost", "root", "", "chocolates") or die("No es posible conectarse al motor de BD");
		$consulta = "SELECT * FROM productos ORDER BY idProducto";
		$listado = $con->query($consulta) or die("No se pudo realizar la consulta");
		while ($registro = $listado->fetch_object())
		{
			$unProducto = new producto();
			$unProducto->setIdProducto($registro->idProducto);
			$unProducto->setDescripcion($registro->descripcion);
			$unProducto->setPrecio($registro->precio);
			$listaProductos[]=$unProducto;
		}
		$listado->free();
		$con->close();
		return $listaProductos;
	}
	
	public static function getPrecioBD($idProd)
	{
		$unProducto = NULL;
		$con = new mysqli("localhost", "root", "", "chocolates") or die("No es posible conectarse al motor de BD");
		$consulta = "SELECT * FROM productos WHERE idProducto = ".$idProd." LIMIT 1";
		$listado = $con->query($consulta) or die("No se pudo realizar la consulta");
		while ($registro = $listado->fetch_object())
		{
			$unProducto = new producto();
			$unProducto->setIdProducto($registro->idProducto);
			$unProducto->setDescripcion($registro->descripcion);
			$unProducto->setPrecio($registro->precio);
		}
		$listado->free();
		$con->close();
		return $unProducto;
	}
}
?>



