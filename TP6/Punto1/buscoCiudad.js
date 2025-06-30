document.addEventListener("DOMContentLoaded", function () {
    const selectPais = document.getElementById("cmbPaises");
    selectPais.addEventListener("change", function () {
        var contenedor = document.getElementById("ciudades");
        var peticion = new XMLHttpRequest();
        peticion.open("GET", "controlador.php?idPais=" + selectPais.value, true); // true para asincrono", true);
        peticion.onreadystatechange = buscarCiudades;
        peticion.send(null);
        function buscarCiudades() {
            if (peticion.readyState === 4 && peticion.status === 200) {
                var respuesta = JSON.parse(peticion.responseText);
                ciudades = respuesta.ciudades;
                if (Array.isArray(ciudades)) {
                    contenedor.innerHTML = ciudades.join(", ");
                } else {
                    contenedor.innerHTML = ciudades; // mostrar el mensaje de error
                }
            }
        }
    });
})
