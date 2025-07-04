<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <section>
        <article>
            <h1>Consumidores Unidos</h1>
            <div id="entradas">
                <div id="entradaProducto">
                    <label for="producto">Buscar por Producto</label>
                    <input id="producto" type="text">
                    <button id="btnBuscarProducto">Buscar</button>
                </div>
                <div id="entradaUbicacion">
                    <label for="ubicacion">Buscar por Ubicacion</label>
                    <select name="ubicacion" id="ubicacion">
                        <option value="">Seleccione una Ubicacion</option>
                        <?php
                        include_once("Supermercado.class.php");
                        $lista = Supermercado::getUbicacionesBD();
                        if (count($lista) > 0)
                        {
                            foreach($lista as $u)
                            {
                                echo "<option value='".$u->ubicacion."'>".$u->ubicacion."</option>";
                            }
                        }
                        ?>
                    </select>
                    <button id="btnBuscarUbicacion">Buscar</button>
                </div>
                <button id="btnBuscarAmbos">Buscar por Ambos</button>
            </div>
            <div id="contenedorDatos">
                <table id="tablaDatos">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Supermercado</th>
                            <th>Ubicacion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoDatos">

                    </tbody>
                </table>
            </div>
            <div id="contenedorDetalles" style="display: none;">
                <table id="tablaDetalles">
                    <thead>
                        <tr>
                            <th>Supermercado</th>
                            <th>Precio</th>
                            <th>Ubicacion</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoDetalles">

                    </tbody>
                </table>
                <p><b>Precio mas bajo:</b><span id="precioBajo"></span></p>
                <p><b>Diferencia entre el más bajo y el más alto:</b><span id="diferenciaPrecio"></span></p>
            </div>
        </article>
    </section>
</body>

</html>