<!-- Codigo_118.php -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="iso-8859-1" />
	<title>AJAX Asincronico</title>
	<script>
		function buscoPrecio() {
			var idProducto = document.getElementById("cmbProductos").selectedIndex;
			var peticion = new XMLHttpRequest();
			peticion.open("GET", "Codigo_118a.php?idProducto=" + idProducto, true);
			peticion.onreadystatechange = cargoPrecio;
			peticion.send(null);

			function cargoPrecio() {
				if ((peticion.readyState == 4) && (peticion.status == 200)) { //Se proceso la peticion
					var myObj = JSON.parse(peticion.responseText);
					var identificador = document.getElementById("idProducto");
					identificador.innerHTML = myObj.idProducto;
					var descripcion = document.getElementById("descripcionProducto");
					descripcion.innerHTML = myObj.descripcion;
					var precio = document.getElementById("precioProducto");
					precio.innerHTML = '$ ' + myObj.precio;
				}
			}
		}
	</script>
	<link rel="stylesheet" href="Codigo_118.css" />
</head>

<body>
	<section>
		<article>
			Seleccione un producto:
			<select name="cmbProductos" id="cmbProductos" onChange="buscoPrecio();">
				<option value="0">-----</option>
				<?php
				include_once("Codigo_118.Producto.class.php");
				$lstProd = producto::getProductosBD();
				if (count($lstProd) > 0) {
					foreach ($lstProd as $unProd) {
						echo '<option value="' . $unProd->getIdProducto() . '">' . $unProd->getDescripcion() . '</option>';
					}
				}
				?>
			</select>
			<table class="borde">
				<tr>
					<td class="borde fondo">Id del Producto</td>
					<td class="borde">
						<div id="idProducto">Seleccione un producto</div>
					</td>
				</tr>
				<tr>
					<td class="borde fondo">Descripci�n</td>
					<td class="borde">
						<div id="descripcionProducto">Seleccione un producto</div>
					</td>
				</tr>
				<tr>
					<td class="borde fondo">Precio</td>
					<td class="borde">
						<div id="precioProducto">Seleccione un producto</div>
					</td>
				</tr>
			</table>
		</article>
	</section>
</body>

</html>