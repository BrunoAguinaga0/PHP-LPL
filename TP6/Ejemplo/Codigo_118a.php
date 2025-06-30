<?php
/* Codigo_118a.php */
/* El objeto JSON a enviarse al script JavaScript utilizando AJAX 
puede generarse a traves de un objeto o a trav�s de un arreglo 
asociativo de PHP */
include_once("Codigo_118.Producto.class.php");
$unProdu = producto::getPrecioBD($_GET['idProducto']);
if (is_null($unProdu))
{	$objTemp = new StdClass();
	$objTemp->idProducto = 'Producto no encontrado';
	$objTemp->descripcion = '---';
	$objTemp->precio = '---';
	$myJSON = json_encode($objTemp);
}
else
{	$arregloTemp = array('idProducto' => $unProdu->getIdProducto(),
					'descripcion' => $unProdu->getDescripcion(),
					'precio' => $unProdu->getPrecio());
	$myJSON = json_encode($arregloTemp);
}
echo $myJSON;
?>



