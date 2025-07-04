document.addEventListener("DOMContentLoaded", function() {
    const empresa = document.getElementById("empresa");
    var peticion = new XMLHttpRequest();
    peticion.open("GET", "../PHP/buscarEmpresas.php", true); // true para asincrono", true);
    peticion.onreadystatechange = function() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) { //Se proceso la peticion
            var resultado = JSON.parse(peticion.responseText);
            resultado.forEach(element => {
                var option = document.createElement("option");
                option.value = element.Empresa;
                option.innerHTML = element.Empresa;
                empresa.appendChild(option); 
            });
        }
    };
    peticion.send(null);
})