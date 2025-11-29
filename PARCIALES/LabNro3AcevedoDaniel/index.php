<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabNro3AcevedoDaniel</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js" defer></script>
</head>

<body>
    <header>
        <h1>Consumidores Unidos</h1>
    </header>
    <section>
        <article>
            <form action="" id="formularioBusqueda">
                <label for="nombre">Buscar Productos</label>
                <input list="listaProductos" type="text" placeholder="Buscar Producto" id="nombre" name="nombre">
                <datalist id="listaProductos">
                    <?php
                    include_once("Producto.class.php");
                    $productos = Producto::getProductoBD();
                    if (count($productos) > 0)
                    {
                        foreach ($productos as $p)
                        {
                            echo "<option value='".$p->getNombre()."'>".$p->getNombre()."</option>";
                        }
                    }
                    ?>
                </datalist>
                <label for="cmbUbicacion">Listar Supermercados por Ubicacion</label>
                <select name="cmbUbicacion" id="cmbUbicacion">
                    <option value="0" selected>Seleccionar Ubicacion</option>
                    <?php
                    include_once("Supermercado.class.php");
                    $supermercados = Supermercado::getSupermercadosBD();
                    if (count($supermercados) > 0) {
                        foreach ($supermercados as $s) {
                            echo "<option class='" . $s->getNombre() . "'>" . $s->getUbicacion() . "</option>";
                        }
                    }
                    ?>
                </select>
                <button id="btnFiltrar">Filtrar por ambos</button>
                <button id="btnDetalles" disabled>Ver Detalles del Producto</button>
            </form>
            <div id="contenedorTablas">
                <table id="miTabla" style="display: none;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Supermercado</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTabla">
                        
                        </tbody>
                    </table>
                    <div id="contenedorDetalle" style="display: none;">
                        <table id="tablaDetalle">
                            <thead>
                                <tr>
                                    <th>Supermercado</th>
                            <th>Precio</th>
                            <th>Ubicacion</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaDetalle">
                        
                    </tbody>
                </table>
                <p><b>Precio más bajo: </b>supermercado con el precio más económico es <b><span id="superPrecioMasBajo"></span></b></p>
                <p><b>Diferencia entre el más bajo y el más alto: </b><span id="diferenciaPrecio"></span></p>
            </div>
        </div>
        </article>
    </section>
</body>

</html>