document.addEventListener("DOMContentLoaded", () => {
    const producto = document.getElementById("producto");
    const ubicacion = document.getElementById("ubicacion");
    const contenedorDatos = document.getElementById("contenedorDatos");
    const cuerpoDatos = document.getElementById("cuerpoDatos");
    const contenedorDetalles = document.getElementById("contenedorDetalles");
    const cuerpoDetalles = document.getElementById("cuerpoDetalles");
    const precioBajo = document.getElementById("precioBajo");
    const diferenciaPrecio = document.getElementById("diferenciaPrecio");
    const btnBuscarProducto = document.getElementById("btnBuscarProducto");
    const btnBuscarUbicacion = document.getElementById("btnBuscarUbicacion");
    const btnBuscarAmbos = document.getElementById("btnBuscarAmbos");
    const xhr = new XMLHttpRequest();

    btnBuscarProducto.addEventListener("click", buscoProducto);

    btnBuscarUbicacion.addEventListener("click", buscoSupermercados);

    btnBuscarAmbos.addEventListener("click", buscoAmbos);

    function peticionBuscar(producto, ubicacion) {
        xhr.open("GET", "procesar.php?producto=" + producto + "&ubicacion=" + ubicacion, true);
        xhr.onreadystatechange = cargoDatos;
        xhr.send(null);
    }

    function buscoProducto() {
        ubicacion.value = "";
        if (producto.value != "" && ubicacion.value == "") {
            contenedorDetalles.style.display = "none";
            peticionBuscar(producto.value, "");
        }
    }

    function buscoSupermercados() {
        producto.value = "";
        if (producto.value == "" && ubicacion.value != "") {
            contenedorDetalles.style.display = "none";
            peticionBuscar("", ubicacion.value);
        }
    }

    function buscoAmbos() {
        if (producto.value != "" && ubicacion.value != "") {
            contenedorDetalles.style.display = "none";
            peticionBuscar(producto.value, ubicacion.value);
        }
    }

    function cargoDatos() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const respuesta = JSON.parse(xhr.responseText);
            cuerpoDatos.innerHTML = "";
            respuesta.forEach(element => {
                const fila = document.createElement("tr");
                fila.innerHTML = "<td>" + element.nombre_producto + "</td><td>$" + element.precio + "</td><td>" + element.nombre_supermercado + "</td><td>" + element.ubicacion + "</td><td><button <button class='btnDetalle' name='" + element.nombre_producto + "'>Ver Detalle</button></td>";
                cuerpoDatos.appendChild(fila);
            });
            let botones = document.querySelectorAll("button[class='btnDetalle']");
            botones.forEach(boton => {
                boton.addEventListener("click", () => {
                    console.log(boton.name);
                    peticionDetalles(boton.name);
                    contenedorDetalles.style.display = "block";
                });
            })
        }
    }

    function peticionDetalles(producto) {
        xhr.open("GET", "procesar.php?detalleProducto=" + producto, true);
        xhr.onreadystatechange = cargoDetalles;
        xhr.send(null);
    }

    function cargoDetalles() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const respuesta = JSON.parse(xhr.responseText);
            cuerpoDetalles.innerHTML = "";
            let pbajo = 0;
            let palto = 0;
            respuesta.forEach(element => {
                let precio = parseFloat(element.precio);
                if (palto <= precio)
                {
                    palto = precio
                }
                if (pbajo == 0)
                {
                    pbajo = precio;
                }
                if (precio < pbajo)
                {
                    pbajo = precio;
                }
                precioBajo.innerHTML = " $" + pbajo;
                diferenciaPrecio.innerHTML = " $" + palto + " - $" + pbajo + " = $" + (palto - pbajo);
                const fila = document.createElement("tr");
                fila.innerHTML = "<td>" + element.nombre_supermercado + "</td><td>$" + element.precio + "</td><td>" + element.ubicacion + "</td>";
                cuerpoDetalles.appendChild(fila);
            });
        }
    }
})
