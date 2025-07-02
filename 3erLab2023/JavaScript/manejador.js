document.addEventListener("DOMContentLoaded", function() {
    var buscar = document.getElementById("buscar");
    buscar.addEventListener("click", function() {
        var ciudadOrigen = document.getElementById("ciudadOrigen").value;
        var ciudadDestino = document.getElementById("ciudadDestino").value;
        var mensaje = document.getElementById("mensaje");
        var principal = document.getElementById("principal");
        var peticion = new XMLHttpRequest();
        if (ciudadOrigen != "true" || ciudadDestino != "true") {    
            mensaje.innerHTML = "";
            peticion.open("GET", "../PHP/buscarEmpresas.php?origen=" + ciudadOrigen + "&destino=" + ciudadDestino);
            peticion.onreadystatechange = function() {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    try {
                        var respuesta = JSON.parse(peticion.responseText);
                        if (respuesta.length > 0) {
                            respuesta.forEach(element => {
                                var div = document.createElement("div");
                                div.className = "empresa";
                                var logo = document.createElement("img");
                                logo.src = element.LOGO;
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
})