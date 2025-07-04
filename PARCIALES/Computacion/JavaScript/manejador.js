document.addEventListener("DOMContentLoaded", function() {
    var producto = document.getElementById("producto");
    var stock = document.getElementById("stock");
    var peticion = new XMLHttpRequest();
    peticion.open("GET", "traerDatosProductos.php?nombre=" + producto.value, true);
    peticion.onreadystatechange = function() {
        if (peticion.readyState === 4 && peticion.status === 200) {
            var productos = JSON.parse(peticion.responseText);
            productos.forEach(function(producto) {
            });
        }
    };
    peticion.send(null);
})