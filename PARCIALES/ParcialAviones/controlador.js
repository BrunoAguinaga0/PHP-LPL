document.addEventListener("DOMContentLoaded", function() {
    var escucharTeclas = document.getElementById("aeroNave");
    var rta = document.getElementById("rta");
    var bodyTable = document.getElementById("agregar");
    var infoAvion = document.getElementById("detalleAeronave");
    var titulo = document.createElement("h3");
    var encontrado = false;
    var parrafo = document.createElement("p");
    parrafo.style.fontWeight = "bold";
    var parrafo2 = document.createElement("p");
    var parrafo3 = document.createElement("p");
    escucharTeclas. addEventListener("keyup", function() {
        var peticion = new XMLHttpRequest();
        peticion.open("GET", "back.php?aeroNave=" + escucharTeclas.value + "&action=buscar", true);
        peticion.onreadystatechange =     function() {
        if (peticion.readyState === 4 && peticion.status === 200){
            var respuesta = JSON.parse(peticion.responseText);
            if (respuesta.length === 0){
                parrafo.innerHTML = "Aeronave no encontrada";
                parrafo.style.color = "red";
                rta.appendChild(parrafo);
                bodyTable.innerHTML = "";
                infoAvion.innerHTML = "";
                encontrado = false;
            }else{
                if(!encontrado){
                    encontrado = true;
                    parrafo.innerHTML = "Aeronave encontrada";
                    parrafo.style.color = "green";
                    rta.appendChild(parrafo);
                    respuesta.forEach(aviones => {
                        var tr = document.createElement("tr");
                        var tdMatricula = document.createElement("td");
                        var tdIngreso = document.createElement("td");
                        var tdCapacidad = document.createElement("td");
                        var tdDistribucion = document.createElement("td");
                        titulo.innerHTML = "Detalle de la Aeronave:";
                        infoAvion.appendChild(titulo);
                        parrafo2.innerHTML = "Fabricante: " + aviones.fabricante;
                        parrafo2.innerHTML = "Modelo: " + aviones.modelo;
                        parrafo3.innerHTML = "Fabricante: " + aviones.fabricante;
                        infoAvion.appendChild(parrafo2);
                        infoAvion.appendChild(parrafo3);
                        tdMatricula.innerHTML = aviones.matricula;
                        tdIngreso.innerHTML = aviones.fechaIngreso;
                        tdCapacidad.innerHTML = aviones.capacidad;
                        tdDistribucion.innerHTML = aviones.distribucion;
                        tr.appendChild(tdMatricula);
                        tr.appendChild(tdIngreso);
                        tr.appendChild(tdCapacidad);
                        tr.appendChild(tdDistribucion);
                        bodyTable.appendChild(tr);
                    });
                }
            }
        }
    };
        peticion.send(null);

    })
})