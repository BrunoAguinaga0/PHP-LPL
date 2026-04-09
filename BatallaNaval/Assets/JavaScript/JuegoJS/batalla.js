const config = window.CONFIG_BATALLA;
const elementoCronometro = document.getElementById('timer');
let segundosTranscurridos = config.segundosJugados || 0;
actualizarCronometro();
let intervaloCronometro;
intervaloCronometro = setInterval(actualizarCronometro, 1000);
import { crearTablero, pintarFlota } from "../InicioJS/mostrarTablero.js";
crearTablero(config.filas, config.columnas, config.tamanio, 'contenedor-jugador');
crearTablero(config.filas, config.columnas, config.tamanio, 'contenedor-ia');
const contenedorIA = document.getElementById('contenedor-ia');
const contenedorJugador = document.getElementById('contenedor-jugador');
const tituloIA = document.getElementById('header-ia');
const rendirse = document.getElementById('rendirse');
const modalRendirse = document.getElementById('modal-rendirse');
const btnConfirmar = document.getElementById('btn-confirmar-rendicion');
const btnCancelar = document.getElementById('btn-cancelar-rendicion');
let turno = true;


//Si el usuario recarga la pagina no se pierda lo que hizo
config.disparosAlEnemigo.forEach(disparo => {
    const celdaEnemiga = contenedorIA.querySelector(`.celda-previsualizacion[data-fila='${disparo.f}'][data-columna='${disparo.c}']`);
    if (celdaEnemiga) {
        celdaEnemiga.classList.add(disparo.tipo);
    }
});

config.disparosDeIA.forEach(disparo => {
    const miCelda = contenedorJugador.querySelector(`.celda-previsualizacion[data-fila='${disparo.f}'][data-columna='${disparo.c}']`);
    if (miCelda) {
        miCelda.classList.add(disparo.tipo);
    }
});

if (config.estado === 'victoria' || config.estado === 'derrota' || config.estado === 'abandonada') {
    turno = false;
    contenedorIA.style.opacity = "0.7";
    clearInterval(intervaloCronometro); 
    alert("Esta partida ya ha concluido. ¡Ve al menú para iniciar otra!");
}

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



rendirse.addEventListener('click', () => {
        modalRendirse.style.display = 'flex'; 
    });
btnCancelar.addEventListener('click', () => {
        modalRendirse.style.display = 'none';
    });
if (btnConfirmar) {
    btnConfirmar.addEventListener('click', () => {
        modalRendirse.style.display = 'none';
        fetch('../Backend/rendirse.php', { method: 'POST' })
        .then(respuesta => respuesta.json())
        .then(data => {
            if (data.estado === "abandonada") {
                
                clearInterval(intervaloCronometro);
                turno = false;
            }
        })
        .catch(error => {
            console.error("Error al intentar rendirse:", error);
            alert("Hubo un problema de conexión.");
        });
    });
}


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