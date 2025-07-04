const formularioBusqueda = document.getElementById("formularioBusqueda");
const inputProducto = document.getElementById("nombre");
const cmbUbicacion = document.getElementById("cmbUbicacion");
const miTabla = document.getElementById("miTabla");
const cuerpoTabla = document.getElementById("cuerpoTabla");
const btnFiltrar = document.getElementById("btnFiltrar");
const btnDetalles = document.getElementById("btnDetalles");
const tablaDetalle = document.getElementById("tablaDetalle");
const cuerpoTablaDetalle = document.getElementById("cuerpoTablaDetalle");
const superPrecioMasBajo = document.getElementById("superPrecioMasBajo");
const diferenciaPrecio = document.getElementById("diferenciaPrecio");
const contenedorDetalle = document.getElementById("contenedorDetalle");
const xhr = new XMLHttpRequest();

formularioBusqueda.addEventListener("submit", function(event) {
    event.preventDefault();
})

inputProducto.addEventListener("keyup", buscarProducto);

cmbUbicacion.addEventListener("change", buscarProductoPorUbicacion);

btnFiltrar.addEventListener("click", buscarProductoFiltrado);

btnDetalles.addEventListener("click", buscarDetallesProducto);


function buscarProducto()
{
    let nombre = inputProducto.value;
    if (nombre != "")
    {
        xhr.open("GET","obtengoProductos.php?nombre="+nombre,true);
        xhr.onreadystatechange = cargoProductos;
        xhr.send(null);
        btnDetalles.disabled = false;
    }
    if (nombre == "")
    {
        miTabla.style.display = "none"
        cuerpoTabla.innerHTML = "";
        contenedorDetalle.style.display = "none"    
    }
}

function cargoProductos()
{
    if (xhr.readyState === 4 && xhr.status === 200)
    {
        let respuesta = JSON.parse(xhr.responseText);
        if (respuesta.length != 0 || respuesta == "")
        {
            cuerpoTabla.innerHTML = "";
            respuesta.forEach(element => {
                const fila = document.createElement("tr");
                fila.innerHTML = "<td>"+element.nombreProducto+"</td><td>"+element.precio+"</td><td>"+element.nombreSupermercado+"</td><td>"+element.ubicacion+"</td>";
                cuerpoTabla.appendChild(fila);
            });
        }
        miTabla.style.display = "block"
    }
}

function buscarProductoPorUbicacion()
{
    let nombreSupermercado = cmbUbicacion.value;
    if (nombreSupermercado != "")
    {
        xhr.open("GET","obtengoSupermercados.php?nombreSupermercado="+nombreSupermercado,true);
        xhr.onreadystatechange = cargoSupermercados;
        xhr.send(null);
    }
    if (nombreSupermercado == 0 && inputProducto.value == "")
    {
        miTabla.style.display = "none"
        cuerpoTabla.innerHTML = "";
    }
}

function cargoSupermercados()
{
    if (xhr.readyState === 4 && xhr.status === 200)
    {
        let respuesta = JSON.parse(xhr.responseText);
        if (respuesta.length != 0 || respuesta == "")
        {
            cuerpoTabla.innerHTML = "";
            respuesta.forEach(element => {
                const fila = document.createElement("tr");
                fila.innerHTML = "<td>"+element.nombreProducto+"</td><td>"+element.precio+"</td><td>"+element.nombreSupermercado+"</td><td>"+element.ubicacion+"</td>";
                cuerpoTabla.appendChild(fila);
            });
        }
        miTabla.style.display = "block"
    }
}

function buscarProductoFiltrado()
{
    if (cmbUbicacion.value != 0 && inputProducto != "")
    {
        let nombreProducto = inputProducto.value;
        let ubicacion = cmbUbicacion.value;
        xhr.open("GET", "obtengoProductoFiltrado.php?nombreProducto="+nombreProducto+"&ubicacion="+ubicacion, true);
        xhr.onreadystatechange = cargoProductosFiltrados;
        xhr.send(null);
    }
}

function cargoProductosFiltrados()
{
    if (xhr.readyState === 4 && xhr.status === 200)
    {
        let respuesta = JSON.parse(xhr.responseText);
        if (respuesta.length != 0 || respuesta == "")
        {
            cuerpoTabla.innerHTML = "";
            respuesta.forEach(element => {
                const fila = document.createElement("tr");
                fila.innerHTML = "<td>"+element.nombreProducto+"</td><td>"+element.precio+"</td><td>"+element.nombreSupermercado+"</td><td>"+element.ubicacion+"</td>";
                cuerpoTabla.appendChild(fila);
            });
        }
        miTabla.style.display = "block"
    }
}

function buscarDetallesProducto()
{
    if (inputProducto != "")
    {
        let nombreProducto = inputProducto.value;
        xhr.open("GET","obtengoDetallesProducto.php?nombreProducto="+nombreProducto,true);
        xhr.onreadystatechange = cargoDetallesProducto;
        xhr.send(null);
    }
    if (inputProducto == "")
    {
        contenedorDetalle.style.display = "none"
        superPrecioMasBajo.innerHTML = "";
        diferenciaPrecio.innerHTML = "";
    }
}

function cargoDetallesProducto()
{
    if (xhr.readyState === 4 && xhr.status === 200)
    {
        let respuesta = JSON.parse(xhr.responseText);
        if (respuesta.length != 0 || respuesta == "")
        {
            cuerpoTablaDetalle.innerHTML = "";
            superPrecioMasBajo.innerHTML = "";
            diferenciaPrecio.innerHTML = "";
            respuesta.forEach(element => {
                const fila = document.createElement("tr");
                fila.innerHTML = "<td>"+element.nombreSupermercado+"</td><td>"+element.precio+"</td><td>"+element.ubicacion+"</td>";
                cuerpoTablaDetalle.appendChild(fila);
                console.log("aver: " +element.precio)
                superPrecioMasBajo.innerHTML = element.nombreSupermercado + " - " + element.ubicacion;
                diferenciaPrecio.innerHTML = "$" + respuesta[0].precio + " - $" + element.precio + " = " + "<b>$" + (parseFloat(respuesta[0].precio) - parseFloat(element.precio)) + "</b>" 
            });
        }
        contenedorDetalle.style.display = "block"
    }
}