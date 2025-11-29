document.addEventListener("DOMContentLoaded", function () {
    fetch("../PHP/obtenerOrigenes.php")
    .then(response => response.json())
    .then(data => {
        var ciudadOrigen = document.getElementById("ciudadOrigen");
        data.forEach(element => {
            var option = document.createElement("option");
            option.value = element.origen;
            option.innerHTML = element.origen;
            ciudadOrigen.appendChild(option);
        });
    })
    fetch("../PHP/obtenerDestinos.php")
    .then(response => response.json())
    .then(data => {
        var ciudadDestino = document.getElementById("ciudadDestino");
        data.forEach(element => {
            var option2 = document.createElement("option");
            option2.value = element.destino;
            option2.innerHTML = element.destino;
            ciudadDestino.appendChild(option2);
        });
    })
})