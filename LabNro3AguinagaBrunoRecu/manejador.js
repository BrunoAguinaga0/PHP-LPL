document.addEventListener("DOMContentLoaded", function(){
    fetch("enviarProductos.php")
    .then(response => response.json())
    .then(data => {
        var datalist = document.getElementById("ListaProductos");
        data.forEach(element => {
            var option = document.createElement("option");
            option.value = element.nombre;
            datalist.appendChild(option);
        });
    })
    .catch(error => console.error('Error al cargar los productos:', error));
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
            filtro.disabled = true;
            tabla.innerHTML = "";
        }
        else if (criterio.value === "1"){
            busqueda.disabled = false;
            ubicacion.disabled = true;
            filtro.disabled = false;
            tabla.innerHTML = "";
        }
        encontrado = false;
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
        encontrado = false;
    })
    ubicacion.addEventListener("change", function(){
        encontrado = false;
        tabla.innerHTML = "";
        localStorage.setItem("ubicacion", ubicacion.value)
        buscar();
    })

    busqueda.addEventListener("keyup", function(){
        encontrado = false;
        tabla.innerHTML = "";
        buscar();
    })

    function buscar(){
        peticion.open("GET", "back.php?criterio=" + localStorage.getItem("criterio") + "&filtro=" + localStorage.getItem("filtro") + "&busqueda=" + busqueda.value + "&ubicacion=" + localStorage.getItem("ubicacion"), true);
        peticion.onreadystatechange = function(){
        if (peticion.readyState == 4 && peticion.status == 200){
            var resultado = JSON.parse(peticion.responseText);
            if (resultado.length === 0){
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
                        var td5 = document.createElement("td");
                        var a = document.createElement("a");
                        td.innerHTML = element.producto;
                        td2.innerHTML = element.precio;
                        td3.innerHTML = element.supermercado;
                        td4.innerHTML = element.ubicacion;
                        a.innerHTML = "Ver Detalles";
                        a.href = "detalle.php?nombre=" + element.producto + "&criterio=" + localStorage.getItem("criterio") + "&filtro=" + localStorage.getItem("filtro") + "&ubicacion=" + localStorage.getItem("ubicacion");
                        td5.appendChild(a);
                        tr.appendChild(td);
                        tr.appendChild(td2);
                        tr.appendChild(td3);
                        tr.appendChild(td4);
                        tr.appendChild(td5);
                        tabla.appendChild(tr);
                    });
                }
            }
            }
        }
        peticion.send();
    }
})