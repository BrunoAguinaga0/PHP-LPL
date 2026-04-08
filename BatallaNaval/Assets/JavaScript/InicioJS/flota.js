export let historialFlota = {
    "portaviones" : [],
    "acorazados" : [],
    "destructores" : [],
    "submarinos" : []
}

export function registrarFlota(tipo,fila,columna,largo,orientacion, matriz){
    let flota = {
        fila: fila,
        columna: columna,
        largo: largo,
        orientacion: orientacion
    }
    historialFlota[tipo].push(flota); 
    for(let i = 0; i < largo; i++){
        if(orientacion == "horizontal"){
            matriz[fila][columna + i] = 1;
        }
        else{
            matriz[fila + i][columna] = 1;
        }
    }

}

export function borrarUltimaFlota(tipo, matriz){
    let borrarFlota = historialFlota[tipo].pop();
    if(borrarFlota){
        for(let i = 0; i < borrarFlota.largo; i++){
            if(borrarFlota.orientacion == "horizontal"){
                matriz[borrarFlota.fila][borrarFlota.columna + i] = 0;
            }
            else{
                matriz[borrarFlota.fila + i][borrarFlota.columna] = 0;
            }
        }
    }
    return borrarFlota;
}

export function sumresFlota(valor){
    let nro;
    let Elemento;
    let resultado = {
        exito: false,
        tipo: "",
        accion: "",
        largo: null
    }
        switch(valor){
            case 11: 
                Elemento = document.querySelector("#contador-acorazados");
                nro = parseInt(Elemento.textContent)
                if (nro > 1){
                    Elemento.textContent = nro - 1;
                    resultado.exito = true;
                    resultado.tipo = "acorazados";
                    resultado.accion = "restar";
                    resultado.largo = 3
                }
                break;
            case 12:
                Elemento = document.querySelector("#contador-acorazados");
                nro = parseInt(Elemento.textContent);
                if(nro < 3){
                    Elemento.textContent = nro + 1;
                    resultado.exito = true;
                    resultado.tipo = "acorazados";
                    resultado.accion = "sumar";
                    resultado.largo = 3
                }
                break;
            case 21:
                Elemento = document.querySelector("#contador-destructores");
                nro = parseInt(Elemento.textContent)
                if (nro > 2){
                    Elemento.textContent = nro - 1;
                    resultado.exito = true;
                    resultado.tipo = "destructores";
                    resultado.accion = "restar";
                    resultado.largo = 2
                }
                break;
            case 22:
                Elemento = document.querySelector("#contador-destructores");
                nro = parseInt(Elemento.textContent);
                if (nro < 4){
                    Elemento.textContent = nro + 1;
                    resultado.exito = true;
                    resultado.tipo = "destructores";
                    resultado.accion = "sumar";
                    resultado.largo = 2
                }
                break;  
            case 31:
                Elemento = document.querySelector("#contador-submarinos");
                nro = parseInt(Elemento.textContent)
                if (nro > 3){
                    Elemento.textContent = nro - 1;
                    resultado.exito = true;
                    resultado.tipo = "submarinos";
                    resultado.accion = "restar";
                    resultado.largo = 1
                }
                break;
            case 32:
                Elemento = document.querySelector("#contador-submarinos");
                nro = parseInt(Elemento.textContent);
                if (nro < 5){
                    Elemento.textContent = nro + 1;
                    resultado.exito = true;
                    resultado.tipo = "submarinos";
                    resultado.accion = "sumar"; 
                    resultado.largo = 1
                }
                break;
    }
    return resultado;
}

export function resertContadorFlota(){
    let acorazados = document.querySelector("#contador-acorazados");
    acorazados.textContent = 2;
    let destructores = document.querySelector("#contador-destructores");
    destructores.textContent = 3;
    let submarinos = document.querySelector("#contador-submarinos");
    submarinos.textContent = 4;
}

export function resetFlota(){
    historialFlota = {
        "portaviones" : [],
        "acorazados" : [],
        "destructores" : [],
        "submarinos" : []
    }
}

