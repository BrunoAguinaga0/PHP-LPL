document.addEventListener("DOMContentLoaded", function () {
    const tabla = document.getElementById("agregar");
    const datosGuardados = localStorage.getItem("tabla");
    if (datosGuardados) {
        tabla.innerHTML = datosGuardados;
    }else {
        tabla.innerHTML = "";
    }
    var btnBuscar = document.getElementById("btnBuscar");
    btnBuscar.addEventListener("click", function () {
        var dni = document.getElementById("txtBuscar").value;
        var parametro = "txtBuscar=" + encodeURIComponent(dni);
        var peticion = new XMLHttpRequest();
        peticion.open("POST", "back.php", true); // true para asincrono", true);
        peticion.onreadystatechange = buscarPersona;
        peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        peticion.send(parametro);
        function buscarPersona() {
            if (peticion.readyState === 4 && peticion.status === 200) {
                var respuesta = JSON.parse(peticion.responseText);
                var trNuevo = document.createElement("tr");
                var dni = respuesta.dni;
                var nombre = respuesta.nombre;
                var apellido = respuesta.apellido;
                var fechaNacimiento = respuesta.fechaNacimiento;
                var domicilio = respuesta.domicilio;
                var productosComprados = respuesta.productosComprados;
                var productos = productosComprados.join(", ");
                trNuevo.innerHTML = `<td>${dni}</td><td>${nombre}</td><td>${apellido}</td><td>${fechaNacimiento}</td><td>${domicilio}</td><td>${productos}</td>`;
                tabla.appendChild(trNuevo);
                guardarTabla();

            }
        }
        function guardarTabla() {
            const tabla = document.getElementById("agregar");
            localStorage.setItem("tabla", tabla.innerHTML);
        }

    })
})