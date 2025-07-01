document.addEventListener("DOMContentLoaded", function() {
    var buscar = document.getElementById("buscar");
    buscar.addEventListener("click", function() {
        var ciudadOrigen = document.getElementById("ciudadOrigen").value;
        var ciudadDestino = document.getElementById("ciudadDestino").value;
        var mensaje = document.getElementById("mensaje");
        var peticion = new XMLHttpRequest();
        if (ciudadOrigen != "true" || ciudadDestino != "true") {    
            mensaje.innerHTML = "";
            peticion.open("GET", "../PHP/buscar.php?origen=" + ciudadOrigen + "&destino=" + ciudadDestino);
            peticion.onreadystatechange = function() {
                
            }
        }else{
            mensaje.style.color = "red";
            mensaje.style.textAlign = "center";
            mensaje.style.fontWeight = "bold";
            mensaje.innerHTML = "Seleccione al menos un filtro!";
        }
    })

})