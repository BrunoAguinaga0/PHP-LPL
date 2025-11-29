<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script src="manejador.js" defer></script>
</head>
<body>
    <section>
        <article>
            <h1>Realizar Busqueda de Productos</h1>
            <div>
                <label for="criterio">Seleccione criterio de busqueda</label>
                <select name="criterio" id="criterio">
                    <option value="1" selected>Independiente</option>
                    <option value="2">Combinado</option>
                </select>
            </div>
            <div id="selector">
                <label for="filtro">Seleccione un filtro de busqueda</label>
                <select name="filtro" id="filtro">
                    <option value="1" selected>Producto</option>
                    <option value="2">Ubicación</option>
                </select>
            </div>
            <div>
                <label for="busqueda">Buscador</label>
                <input type="text" id="busqueda" name="busqueda" placeholder="Realiza una busqueda">
                <label for="ubicacion">Seleccione la ubicacion:</label>
                <select id="ubicacion" name="ubicacion">
                    <option value="Centro" selected>Centro</option>
                    <option value="Pueyrredon">Pueyrredon</option>
                    <option value="Roca">Roca</option>
                    <option value="13 de Diciembre">13 de Diciembre</option>
                </select>
            </div>
            <table>
                <thead>
                    <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Supermercado</th>
                    <th>Ubicacion</th>
                    </tr>
                </thead>
                <tbody id="cuerpo"></tbody>
            </table>
        </article>
    </section>
</body>
</html>