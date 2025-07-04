document.addEventListener("DOMContentLoaded", function() {
    var secundario = document.getElementById("secundario");
    var buscar = document.getElementById("buscar");
    buscar.addEventListener("click", function() {
        secundario.innerHTML = "";
        var peticion = new XMLHttpRequest();
        var ciudadOrigen = document.getElementById("ciudadOrigen").value;
        var ciudadDestino = document.getElementById("ciudadDestino").value;
        localStorage.setItem("ciudadOrigen", ciudadOrigen);
        localStorage.setItem("ciudadDestino", ciudadDestino);
        var mensaje = document.getElementById("mensaje");
        var principal = document.getElementById("principal");
        if (ciudadOrigen != "true" || ciudadDestino != "true") {    
            mensaje.innerHTML = "";
            peticion.open("GET","../PHP/buscarEmpresas.php?origen=" + ciudadOrigen + "&destino=" + ciudadDestino, true);
            peticion.onreadystatechange = function() {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    try {
                        principal.innerHTML = "";
                        var respuesta = JSON.parse(peticion.responseText);
                        if (respuesta.length > 0) {
                            respuesta.forEach(element => {
                                var div = document.createElement("div");
                                div.className = "empresa";
                                var logo = document.createElement("img");
                                logo.src = "../" + element.LOGO;
                                logo.id = element.NOMBRE;
                                logo.className = "logo";
                                logo.style.cursor = "pointer";
                                var p = document.createElement("p");
                                p.innerHTML = element.NOMBRE;
                                var p2 = document.createElement("p");
                                p2.innerHTML = "Pais: " + element.PAIS;
                                var p3 = document.createElement("p");
                                p3.innerHTML = "Nro de Servicios: " + element.SERVICIOS;
                                var a = document.createElement("a");
                                a.href = element.WEB;
                                a.innerHTML = "Web";
                                div.appendChild(logo);
                                div.appendChild(p);
                                div.appendChild(p2);
                                div.appendChild(p3);
                                div.appendChild(a);
                                principal.appendChild(div);
                            });
                        }else{
                            var h2 = document.createElement("h2");
                            h2.innerHTML = "No se encontraron empresas";
                            principal.appendChild(h2);
                        }
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON:", error);
                    }
                }
            }
            peticion.send(null);
        }else{
            mensaje.style.color = "red";
            mensaje.style.textAlign = "center";
            mensaje.style.fontWeight = "bold";
            mensaje.innerHTML = "Seleccione al menos un filtro!";
        }
    })
    principal.addEventListener("click", function(event){
        if (event.target.classList.contains("logo")) {
            var peticion = new XMLHttpRequest();
            peticion.open("GET", "../PHP/buscarServicios.php?empresa=" + event.target.id + "&origen=" + localStorage.getItem("ciudadOrigen") + "&destino=" + localStorage.getItem("ciudadDestino"), true);
            peticion.onreadystatechange = function() {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    try {
                        secundario.innerHTML = "";
                        var respuesta = JSON.parse(peticion.responseText);
                        if (respuesta.length > 0) {
                            var table = document.createElement("table");
                            var thead = document.createElement("thead");
                            var tr = document.createElement("tr");
                            var th1 = document.createElement("th");
                            var th2 = document.createElement("th");
                            var th3 = document.createElement("th");
                            var th4 = document.createElement("th");
                            var th5 = document.createElement("th");
                            var th6 = document.createElement("th");
                            var th7 = document.createElement("th");
                            th1.innerHTML = "Nro de Servicio";
                            th2.innerHTML = "Origen";
                            th3.innerHTML = "Destino";
                            th4.innerHTML = "Hora Salida";
                            th5.innerHTML = "Hora Llegada";
                            th6.innerHTML = "Frecuencia";
                            th7.innerHTML = "Precio";
                            tr.appendChild(th1);
                            tr.appendChild(th2);
                            tr.appendChild(th3);
                            tr.appendChild(th4);
                            tr.appendChild(th5);
                            tr.appendChild(th6);
                            tr.appendChild(th7);
                            thead.appendChild(tr);
                            table.appendChild(thead);
                            var tbody = document.createElement("tbody");
                            respuesta.forEach(element => {
                                var tr = document.createElement("tr");
                                var td1 = document.createElement("td");
                                var td2 = document.createElement("td");
                                var td3 = document.createElement("td");
                                var td4 = document.createElement("td");
                                var td5 = document.createElement("td");
                                var td6 = document.createElement("td");
                                var td7 = document.createElement("td");
                                td1.innerHTML = element.SERVICIO;
                                td2.innerHTML = element.ORIGEN;
                                td3.innerHTML = element.DESTINO;
                                td4.innerHTML = element.SALIDA;
                                td5.innerHTML = element.LLEGADA;
                                td6.innerHTML = element.FRECUENCIA;
                                td7.innerHTML = element.PRECIO;
                                tr.appendChild(td1);
                                tr.appendChild(td2);
                                tr.appendChild(td3);
                                tr.appendChild(td4);
                                tr.appendChild(td5);
                                tr.appendChild(td6);
                                tr.appendChild(td7);
                                tbody.appendChild(tr);
                            });
                            table.appendChild(tbody);
                            secundario.appendChild(table);
                        }
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON:", error);
                    }
                }
            }
            peticion.send(null);
        }
    })
})