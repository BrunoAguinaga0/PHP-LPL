document.addEventListener("DOMContentLoaded", function() {
    const empresa = document.getElementById("empresa");
    const dias = document.getElementById("dias");
    const btnBuscar = document.getElementById("btnBuscar");
    const body = document.getElementById("cuerpo");
    const tabla = document.getElementById("tabla");
    const cerrarModal = document.getElementById("cerrarModal");
    btnBuscar.addEventListener("click", function() {
        if(empresa.value != "true" || dias.value != "true"){         
            var empresaSeleccionada = empresa.value;
            var diaSeleccionado = dias.value;
            var peticion = new XMLHttpRequest();
            peticion.open("GET", "../PHP/back.php?empresa=" + empresaSeleccionada + "&dia=" + diaSeleccionado, true);
            peticion.onreadystatechange = function() {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    tabla.style.display = "block";
                    body.innerHTML = "";
                    var respuesta = JSON.parse(peticion.responseText);
                    respuesta.forEach(element => {
                        var tr = document.createElement("tr");
                        var td1 = document.createElement("td");
                        var td2 = document.createElement("td");
                        var td3 = document.createElement("td");
                        var td4 = document.createElement("td");
                        var td5 = document.createElement("td");
                        var td6 = document.createElement("td");
                        var button = document.createElement("button");
                        button.innerHTML = "Detalles";
                        button.classList.add("abrirModal");
                        button.id = element.servicio;
                        td1.innerHTML = element.servicio;
                        td2.innerHTML = element.origen;
                        td3.innerHTML = element.destino;
                        td4.innerHTML = element.salida;
                        td5.innerHTML = element.llegada;
                        td6.appendChild(button);
                        tr.appendChild(td1);
                        tr.appendChild(td2);
                        tr.appendChild(td3);
                        tr.appendChild(td4);
                        tr.appendChild(td5);
                        tr.appendChild(td6);
                        body.appendChild(tr);
                    });
                }
            }
            peticion.send();
        }else{
            alert("Seleccione una empresa y un dia");
        }
        });
    body.addEventListener("click", function(event) {
        if (event.target.classList.contains("abrirModal")) {
            var miModal = document.getElementById("miModal");
            miModal.style.display = "block";
            var peticion = new XMLHttpRequest();
            peticion.open("GET", "../PHP/detallesServicios.php?servicio=" + event.target.id, true);
            peticion.onreadystatechange = function() {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    var dias = "";
                    var respuesta = JSON.parse(peticion.responseText);
                    respuesta.forEach(element => {
                        if (element.lu === "True"){
                            
                            dias += "Lunes, ";
                        }
                        if (element.ma === "True"){
                            
                            dias += "Martes, ";
                        }
                        if (element.mi === "True"){
                            
                            dias += "Miercoles, ";
                        }
                        if (element.ju === "True"){
                            
                            dias += "Jueves, ";
                        }
                        if (element.vi === "True"){
                            
                            dias += "Viernes, ";
                        }
                        if (element.sa === "True"){
                            
                            dias += "Sabado, ";
                        }
                        if (element.do === "True"){
                            dias += "Domingo, ";
                        }
                        var span1 = document.getElementById("semiCama");
                        var span2 = document.getElementById("cama");
                        var span3 = document.getElementById("precioSemiCama");
                        var span4 = document.getElementById("precioCama");
                        var span5 = document.getElementById("webEmpresa");
                        var span6 = document.getElementById("diasOperan");
                        span1.innerHTML = element.semi;
                        span2.innerHTML = element.cama;
                        span3.innerHTML = element.precioSemi;
                        span4.innerHTML = element.precioCama;
                        span5.innerHTML = element.web;
                        span6.innerHTML = dias;
                    })
                }
            }
            peticion.send();
        }
    })
    
    cerrarModal.addEventListener("click", function() {
        var miModal = document.getElementById("miModal");
        miModal.style.display = "none";
    })
});






