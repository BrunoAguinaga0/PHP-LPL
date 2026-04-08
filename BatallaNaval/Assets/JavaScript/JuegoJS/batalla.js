import { crearTablero, pintarFlota } from "../InicioJS/mostrarTablero.js";
const config = window.CONFIG_BATALLA;
crearTablero(config.filas, config.columnas, config.tamanio, 'contenedor-jugador');
crearTablero(config.filas, config.columnas, config.tamanio, 'contenedor-ia');
const contenedorJugador = document.getElementById('contenedor-jugador');
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

let turno = 0;
const contenedorIA = document.getElementById('contenedor-ia');
contenedorIA.addEventListener('click', (e) => {
    const celdaClickeada = e.target;
    if(!celdaClickeada.classList.contains('celda-previsualizacion')) return;
    if(celdaClickeada.classList.contains("agua") || celdaClickeada.classList.contains("tocado")) return;
    if(turno == 0){
        const fila = celdaClickeada.dataset.fila;
        const columna = celdaClickeada.dataset.columna;
        const datos = new FormData();
        datos.append('fila', fila);
        datos.append('columna', columna);
        turno = 1;
    }
})

