document.addEventListener("DOMContentLoaded", function(){
    var criterio = document.getElementById("criterio");
    var filtro = document.getElementById("filtro")
    var busqueda = document.getElementById("busqueda")
    var ubicacion = document.getElementById("ubicacion")
    var tabla = document.getElementById("cuerpo")
    var peticion = new XMLHttpRequest();
    var encontrado = false;
    localStorage.setItem("criterio", criterio.value);
    localStorage.setItem("filtro", filtro.value);
    localStorage.setItem("ubicacion", ubicacion.value);
    ubicacion.disabled = true;
    busqueda.disabled = false;
    criterio.addEventListener("change", function(){
        localStorage.setItem("criterio", criterio.value);
        if (criterio.value === "2"){
            busqueda.disabled = false;
            ubicacion.disabled = false;
            tabla.innerHTML = "";
        }
    })
    filtro.addEventListener("change", function(){
        localStorage.setItem("filtro", filtro.value)
        if (filtro.value === "1"){
            ubicacion.disabled = true;
            busqueda.disabled = false;
            tabla.innerHTML = "";
        }else{
            busqueda.disabled = true;
            ubicacion.disabled = false;
            tabla.innerHTML = "";
        }
    })
    ubicacion.addEventListener("change", function(){
        localStorage.setItem("ubicacion", ubicacion.value)
        buscar();
    })

    busqueda.addEventListener("keyup", function(){
        if (busqueda.value === "") {
            tabla.innerHTML = "";
            encontrado = false;
        }
        var error = document.getElementById("error")
        error.innerHTML = "";
        buscar();
    })

    function buscar(){
        peticion.open("GET", "back.php?criterio=" + localStorage.getItem("criterio") + "&filtro=" + localStorage.getItem("filtro") + "&busqueda=" + busqueda.value + "&ubicacion=" + localStorage.getItem("ubicacion"), true);
        peticion.onreadystatechange = function(){
        if (peticion.readyState == 4 && peticion.status == 200){
            var resultado = JSON.parse(peticion.responseText);
            if (resultado.length === 0){
                error.innerHTML = "No se encontraron resultados";
                tabla.innerHTML = "";
            }else{                
                if (!encontrado){
                    encontrado = true;
                    resultado.forEach(element => {
                        var tr = document.createElement("tr");
                        var td = document.createElement("td");
                        var td2 = document.createElement("td");
                        var td3 = document.createElement("td");
                        var td4 = document.createElement("td");
                        td.innerHTML = element.producto;
                        td2.innerHTML = element.precio;
                        td3.innerHTML = element.supermercado;
                        td4.innerHTML = element.ubicacion;
                        tr.appendChild(td);
                        tr.appendChild(td2);
                        tr.appendChild(td3);
                        tr.appendChild(td4);
                        tabla.appendChild(tr);
                    });
                }
            }
            }
        }
        peticion.send();
    }
})