import {inventario, sumresFlota} from "./flota.js";
import{crearTablero, pintarFlota} from "./mostrarTablero.js";
crearTablero(11,11,1);
inicializarFlota();
const radioTamanio = document.querySelectorAll("input[name='radio']");
radioTamanio.forEach(radio => {
    radio.addEventListener("change",function(){
        let tamanio = this.value;
        let filas, columnas;
        switch(tamanio){
            case "1": filas = 10; columnas = 10; break;
            case "2": filas = 10; columnas = 15; break;
            case "3": filas = 15; columnas = 15; break;
            case "4": filas = 20; columnas = 10; break;
            default: filas = 10; columnas = 10; break;
        }
        crearTablero(filas+1, columnas+1,tamanio)
        inicializarFlota();
    })
})

const sumres = document.querySelectorAll(".boton-sumres");
sumres.forEach(boton => {
    boton.addEventListener("click",function(){
        let valor = parseInt(this.value);
        sumresFlota(valor);
    })
});


function inicializarFlota(){
    for(let i=1; i<=4; i++ ){
        pintarFlota(2,i,"portaviones");
    }
    for(let i=1; i<=3; i++ ){
        pintarFlota(i+1,7,"acorazados");
    }
    for(let i=1; i<=3; i++ ){
        pintarFlota(9,i+1,"acorazados");
    }
    for(let i=1; i<=2; i++ ){
        pintarFlota(7,i+1,"destructores");
    }
    for(let i=1; i<=2; i++ ){
        pintarFlota(i+3,9,"destructores");
    }
    for(let i=1; i<=2; i++ ){
        pintarFlota(4,i+3,"destructores");
    }
    pintarFlota(4,2,"submarino");
    pintarFlota(7,9,"submarino");
    pintarFlota(8,6,"submarino");
    pintarFlota(9,9,"submarino");

}

