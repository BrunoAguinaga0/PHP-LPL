document.addEventListener("DOMContentLoaded", function(){
    var criterio = document.getElementById("criterio");
    var filtro = document.getElementById("filtro")
    var busqueda = document.getElementById("busqueda")
    criterio.addEventListener("change", function(){
        localStorage.setItem("criterio", criterio.value);
    })
    filtro.addEventListener("change", function(){
        localStorage.setItem("filtro", filtro.value)
    })
    if(localStorage.getItem("criterio") != 1){
        
    }
    busqueda.addEventListener("keyup", function(){
        var ubicacion = document.getElementById("ubicacion")
        if(localStorage.getItem("criterio") === "1"){
            if (localStorage.getItem("filtro") === "1"){                
                var stringPeticion = "back.php?criterio=" + localStorage.getItem("criterio") + "&filtro=" + localStorage.getItem("filtro") + "&busqueda=" + busqueda.value
                escucharTeclas(stringPeticion);
            }else{
                var stringPeticion = "back.php?criterio=" + localStorage.getItem("criterio") + "&filtro=" + localStorage.getItem("filtro") + "&ubicacion=" + ubicacion.value
                escucharTeclas(stringPeticion);
            }
        }else {
            var stringPeticion = "back.php?criterio=" + localStorage.getItem("criterio") + "&busqueda=" + busqueda.value + "&ubicacion=" + ubicacion.value
            escucharTeclas(stringPeticion);
        }
        
        
    })

    function escucharTeclas(stringPeticion){        
            var peticion = new XMLHttpRequest();
            peticion.open("GET", stringPeticion, true);
            peticion.onreadystatechange = function(){
                if(peticion.readyState === 4 && peticion.status === 200){
                    var respuesta = JSON.parse(peticion.responseText);
                    $arregloPrecios = respuesta.precios;
                    $arregloUbicaciones = respuesta.ubicaciones;
                    $arregloSupermercados = respuesta.supermercados;
                    $longitud = $arregloPrecios.length;
                    for($i; $i < $longitud; $i++){
                        console.log($arregloPrecios[$i]);
                        console.log($arregloSupermercados[$i]);
                        console.log($arregloUbicaciones[$i]);
                    }
                }
            }
            peticion.send(null);
    }
})