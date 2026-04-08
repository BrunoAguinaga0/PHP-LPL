import {sumresFlota, registrarFlota, borrarUltimaFlota, resertContadorFlota, historialFlota, resetFlota} from "./flota.js";
import{crearTablero, despintarFlota, pintarFlota} from "./mostrarTablero.js";
let contenedor = document.querySelector("#elemento5");
let barcoEnMano = null;
let filas = 10, columnas = 10, tamanio = 1;
let orientaciones = ["horizontal", "vertical"];
crearTablero(filas,columnas,1, "elemento5");
let Tablero = crearMatriz(filas, columnas);
inicializarFlota();
const fantasma = document.createElement("div");
fantasma.id = "barco-fantasma";
document.body.appendChild(fantasma);

// Evento para seguir al mouse
document.addEventListener("mousemove", (e) => {
    if (barcoEnMano) {
        fantasma.style.display = "flex";
        // Si es vertical, los ponemos uno abajo del otro
        fantasma.style.flexDirection = barcoEnMano.orientacion === "horizontal" ? "row" : "column";
        
        // Posicionamos el div en las coordenadas del mouse
        fantasma.style.left = `${e.clientX + 10}px`;
        fantasma.style.top = `${e.clientY + 10}px`;
    }
});

// Cambiar el tamaño del tablero.
const radioTamanio = document.querySelectorAll("input[name='radio']");
radioTamanio.forEach(radio => {
    radio.addEventListener("change",function(){
        let tamanio = this.value;
        switch(tamanio){
            case "1": filas = 10; columnas = 10; break;
            case "2": filas = 10; columnas = 15; break;
            case "3": filas = 15; columnas = 15; break;
            case "4": filas = 20; columnas = 10; break;
            default: filas = 10; columnas = 10; break;
        }
        crearTablero(filas, columnas,tamanio, "elemento5");
        Tablero = crearMatriz(filas, columnas);
        resertContadorFlota();
        resetFlota();
        inicializarFlota();
    })
})

// Sumar-Restar una flota
const sumres = document.querySelectorAll(".boton-sumres");
sumres.forEach(boton => {
    boton.addEventListener("click",function(){
        let indice = Math.floor(Math.random() * 2)
        let orientacion = orientaciones[indice];
        let valor = parseInt(this.value);
        let resultado;
        resultado = sumresFlota(valor);
        if (resultado.exito && resultado){
            if (resultado.accion == "sumar"){
                let posicion = buscarEspacioDisponible(Tablero, resultado.largo, orientacion, contenedor);
                if(posicion){
                    pintarFlota(posicion.fila, posicion.columna, resultado.tipo,orientacion, resultado.largo, contenedor);
                    registrarFlota(resultado.tipo, posicion.fila, posicion.columna, resultado.largo, orientacion, Tablero);
                }else{
                    sumresFlota(valor - 1);
                }
            }
            else{
                let borrado = borrarUltimaFlota(resultado.tipo, Tablero);
                if(borrado){
                    despintarFlota(resultado.tipo, borrado.fila, borrado.columna, borrado.orientacion, borrado.largo)
                }
            }
        }
    })
});

// Clickear flota
const contenedorTablero = document.querySelector(".elemento5");
contenedorTablero.addEventListener("click", function(evento) {
    const celdaClickeada = evento.target.closest("div[data-fila]");
    if (!celdaClickeada) return; // Si se clickeo un borde o algo vacio no hacemos nada
    let filaClick = parseInt(celdaClickeada.dataset.fila);
    let columnaClick = parseInt(celdaClickeada.dataset.columna);
    if (barcoEnMano === null) {
        intentarAgarrarBarco(filaClick, columnaClick);
    } else {
        intentarSoltarBarco(filaClick, columnaClick);
    }
});

// Envia los datos al backend y va hacia la pantalla de juego
const formInicio = document.querySelector("#form-inicio");
formInicio.addEventListener("submit", function(e) {
    // 1. Convertimos los objetos y arrays a texto JSON
    const matrizTexto = JSON.stringify(Tablero); 
    const historialTexto = JSON.stringify(historialFlota);    // 2. Los metemos en los inputs ocultos
    const cantidades = {
        portaviones: historialFlota["portaviones"].length,
        acorazados: historialFlota["acorazados"].length,
        destructores: historialFlota["destructores"].length,
        submarinos: historialFlota["submarinos"].length
    };
    document.querySelector("#input-matriz").value = matrizTexto;
    document.querySelector("#input-historial").value = historialTexto;
    document.querySelector("#input-filas").value = filas;
    document.querySelector("#input-columnas").value = columnas;
    document.querySelector("#input-tamanio").value = tamanio;
    document.querySelector("#input-cantidades").value = JSON.stringify(cantidades);
    console.log(filas);
    console.log(columnas);
    console.log(tamanio);
});

function crearMatriz(filas, columnas) {
    let matriz = Array.from({ length: filas }, () => Array(columnas).fill(0));
    return matriz;
}

function buscarEspacioDisponible(matriz, largo, orientacion) {
    // 1. Creamos una lista para guardar todas las posiciones donde el barco entra
    let opcionesValidas = [];

    for (let f = 0; f < matriz.length; f++) {
        for (let c = 0; c < matriz[f].length; c++) {
            let lugar = false;
            
            if (matriz[f][c] == 0) {
                lugar = true;
                
                if (orientacion == "horizontal") {
                    if ((c + largo) <= matriz[f].length) {
                        for (let i = 1; i < largo; i++) {
                            if (matriz[f][c + i] !== 0) {
                                lugar = false;
                                break; 
                            }
                        }
                        if (lugar) {
                            opcionesValidas.push({ fila: f, columna: c });
                        }
                    }
                } else {
                    if ((f + largo) <= matriz.length) {
                        for (let i = 1; i < largo; i++) {
                            if (matriz[f + i][c] !== 0) {
                                lugar = false;
                                break; 
                            }
                        }
                        if (lugar) {
                            opcionesValidas.push({ fila: f, columna: c });
                        }
                    }
                }
            }
        }
    }

    if (opcionesValidas.length > 0) {
        let indiceAleatorio = Math.floor(Math.random() * opcionesValidas.length);
        return opcionesValidas[indiceAleatorio];
    }
    return null; 
}

function inicializarFlota() {
    const barcosAponer = [
        { tipo: "portaviones", largo: 4, cantidad: 1 },
        { tipo: "acorazados",  largo: 3, cantidad: 2 },
        { tipo: "destructores", largo: 2, cantidad: 3 },
        { tipo: "submarinos",  largo: 1, cantidad: 4 }
    ];
    barcosAponer.forEach(barco => {
        for (let i = 0; i < barco.cantidad; i++) {
            let indice = Math.floor(Math.random() * 2);
            let orientacion = orientaciones[indice];
            let posicion = buscarEspacioDisponible(Tablero, barco.largo, orientacion);
            if (!posicion) {
                orientacion = (orientacion === "horizontal") ? "vertical" : "horizontal";
                posicion = buscarEspacioDisponible(Tablero, barco.largo, orientacion);
            }
            if (posicion) {
                registrarFlota(barco.tipo, posicion.fila, posicion.columna, barco.largo, orientacion, Tablero);
                pintarFlota(posicion.fila, posicion.columna, barco.tipo, orientacion, barco.largo, contenedor);
        }    
    }
    });
}

function intentarAgarrarBarco(fClick, cClick) {
    if (Tablero[fClick][cClick] !== 1) return;
    for (let tipo in historialFlota) {
        let listaBarcos = historialFlota[tipo];
        
        for (let i = 0; i < listaBarcos.length; i++) {
            let barco = listaBarcos[i];
            let pertenece = false;
            if (barco.orientacion === "horizontal" && fClick === barco.fila && cClick >= barco.columna && cClick < barco.columna + barco.largo) {
                pertenece = true;
            } else if (barco.orientacion === "vertical" && cClick === barco.columna && fClick >= barco.fila && fClick < barco.fila + barco.largo) {
                pertenece = true;
            }
            if (pertenece) {
                barcoEnMano = {
                    tipo: tipo,
                    fila: barco.fila,
                    columna: barco.columna,
                    largo: barco.largo,
                    orientacion: barco.orientacion
                };
                listaBarcos.splice(i, 1);
                for (let j = 0; j < barco.largo; j++) {
                    if (barco.orientacion === "horizontal") Tablero[barco.fila][barco.columna + j] = 0;
                    else Tablero[barco.fila + j][barco.columna] = 0;
                }
                despintarFlota(tipo, barco.fila, barco.columna, barco.orientacion, barco.largo);
                fantasma.innerHTML = "";
                fantasma.style.display = "flex";
                fantasma.style.flexDirection = barcoEnMano.orientacion === "horizontal" ? "row" : "column";
                for (let k = 0; k < barcoEnMano.largo; k++) {
                    const bloque = document.createElement("div");
                    bloque.classList.add("fantasma-celda", barcoEnMano.tipo);
                    fantasma.appendChild(bloque);
                }
                return;
            }
        }
    }
}

function intentarSoltarBarco(fClick, cClick) {
    let esValido = validarLugarExacto(Tablero, fClick, cClick, barcoEnMano.largo, barcoEnMano.orientacion);
    if (esValido) {
        pintarFlota(fClick, cClick, barcoEnMano.tipo, barcoEnMano.orientacion, barcoEnMano.largo, contenedor);
        registrarFlota(barcoEnMano.tipo, fClick, cClick, barcoEnMano.largo, barcoEnMano.orientacion, Tablero);
        
        barcoEnMano = null;
        fantasma.style.display = "none";
        document.body.style.cursor = "default";
    } else {
        console.log("Posición inválida");
    }
}


export function validarLugarExacto(matriz, fila, columna, largo, orientacion) {
    if (matriz[fila][columna] !== 0) {
        return false;
    }
    if (orientacion === "horizontal") {
        if (columna + largo > matriz[fila].length) {
            return false; 
        }
        for (let i = 1; i < largo; i++) {
            if (matriz[fila][columna + i] !== 0) {
                return false; // Chocó con otro barco
            }
        }
    } else { 
        if (fila + largo > matriz.length) {
            return false; 
        }
        for (let i = 1; i < largo; i++) {
            if (matriz[fila + i][columna] !== 0) {
                return false; // Chocó con otro barco
            }
        }
    }
    return true; 
}
