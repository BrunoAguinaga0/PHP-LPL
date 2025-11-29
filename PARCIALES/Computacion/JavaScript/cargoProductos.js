document.addEventListener("DOMContentLoaded", function() {
    var producto = document.getElementById("producto");
    var peticion = new XMLHttpRequest();
    peticion.open("GET", "../PHP/traerProductos.php", true);
    peticion.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var productos = JSON.parse(this.responseText);
            if (productos.length > 0) {
                productos.forEach(element => {
                    var option = document.createElement("option");
                    option.value = element.nombre;
                    option.innerHTML = element.nombre;
                    producto.appendChild(option);
                });
            }else{
                var option = document.createElement("option");
                option.value = 0;
                option.innerHTML = "No hay productos";
                producto.appendChild(option);
                }
        }
    };
    peticion.send(null);
});