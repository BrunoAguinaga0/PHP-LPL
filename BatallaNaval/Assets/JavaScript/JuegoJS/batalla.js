let segundosTranscurridos = 0;
let intervaloCronometro;
const elementoCronometro = document.getElementById('timer');
intervaloCronometro = setInterval(actualizarCronometro, 1000);


import { crearTablero, pintarFlota } from "../InicioJS/mostrarTablero.js";
const config = window.CONFIG_BATALLA;
crearTablero(config.filas, config.columnas, config.tamanio, 'contenedor-jugador');
crearTablero(config.filas, config.columnas, config.tamanio, 'contenedor-ia');
const contenedorIA = document.getElementById('contenedor-ia');
const contenedorJugador = document.getElementById('contenedor-jugador');
const tituloIA = document.getElementById('header-ia');
Object.entries(config.historialFlota).forEach(([tipoBarco, barcosGuardados]) => {
    barcosGuardados.forEach(barco => {
        pintarFlota(
            parseInt(barco.fila), 
            parseInt(barco.columna), 
            tipoBarco, 
            barco.orientacion, 
            parseInt(barco.largo), 
            contenedorJugador
        );
    });
});

let turno = true;

contenedorIA.addEventListener('click', (e) => {
    if(!turno) return;
    const celdaClickeada = e.target;
    if(!celdaClickeada.classList.contains('celda-previsualizacion')) return;
    if(celdaClickeada.classList.contains("agua") || celdaClickeada.classList.contains("tocado")) return;
    const fila = celdaClickeada.dataset.fila;
    const columna = celdaClickeada.dataset.columna;
    const datos = new FormData();
    datos.append('fila', fila);
    datos.append('columna', columna);
    fetch("../Backend/ataque.php", {
        method: "POST",
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        if(data.resultado == "agua"){
            celdaClickeada.classList.add("agua");
            tituloIA.style.backgroundColor = "rgba(15, 23, 42, 0.6)";
            tituloIA.style.color = "#94a3b8";
            contenedorIA.style.backgroundColor = "rgba(15, 23, 42, 0.6)";
            turno = false;
            llamarAtaqueIA();
        }
        else if(data.resultado == "tocado"){
            celdaClickeada.classList.add("tocado");
        }
        if(data.victoria){
        clearInterval(intervaloCronometro);
        console.log("Victoria");}
    })
    .catch(error => {console.log(error), turno = true;});
})

// --- FUNCIÓN DEL CONTRAATAQUE DE LA IA ---
function llamarAtaqueIA() {
    setTimeout(() => {
        tituloIA.innerHTML = "Flota Enemiga";
        tituloIA.style.backgroundColor = "#22d3ee";
        tituloIA.style.color = "#0f172a";
        contenedorIA.style.backgroundColor = "rgba(30, 41, 59, 0.7)";
        fetch('../Backend/ataque_ia.php', { method: 'POST' })
        .then(respuesta => respuesta.json())
        .then(data => {
            const miCeldaAtacada = contenedorJugador.querySelector(`.celda-previsualizacion[data-fila='${data.fila}'][data-columna='${data.columna}']`);
            if(data.resultado == "agua"){
                miCeldaAtacada.classList.add("agua");
                turno = true;
            }
            else if(data.resultado == "tocado"){
                miCeldaAtacada.classList.add("tocado");
                llamarAtaqueIA();
            }
            if (data.victoria_ia) {
                clearInterval(intervaloCronometro);
                setTimeout(() => {
                    alert("¡DERROTA! La computadora ha destruido tu flota.");
                }, 300);
                return;
            }
        });
    }, 1200); 
}

function actualizarCronometro() {
    segundosTranscurridos++;
    let minutos = Math.floor(segundosTranscurridos / 60);
    let segundos = segundosTranscurridos % 60;
    let minutosFormateados = minutos < 10 ? "0" + minutos : minutos;
    let segundosFormateados = segundos < 10 ? "0" + segundos : segundos;
    if (elementoCronometro) {
        elementoCronometro.textContent = `${minutosFormateados}:${segundosFormateados}`;
    }
}