export function crearTablero(filas, columnas, tamanio, idContenedor) {
    const container = document.getElementById(idContenedor);
    if (!container) return;
    container.innerHTML = "";
    const grilla = document.createElement("div");
    grilla.style.display = "grid";
    grilla.style.gridTemplateColumns = `repeat(${columnas}, 1fr)`;
    grilla.style.gridTemplateRows = `repeat(${filas}, 1fr)`;
    grilla.style.gap = "2px";
    grilla.style.width = "100%";
    grilla.style.height = "100%";

    for (let f = 0; f < filas; f++) {
        for (let c = 0; c < columnas; c++) {
            const celda = document.createElement("div");
            celda.dataset.fila = f;
            celda.dataset.columna = c;
            celda.classList.add("celda-previsualizacion");
            grilla.appendChild(celda);
        }
    }

    container.appendChild(grilla);
}

export function pintarFlota(fila,columna, tipoFlota, orientacion, largo, contenedor){
    for(let i = 0; i < largo; i++){
        let celda;
        if(orientacion == "horizontal"){
            celda = contenedor.querySelector(`[data-fila="${fila}"][data-columna="${columna + i}"]`);
        }
        else{
            celda = contenedor.querySelector(`[data-fila="${fila + i}"][data-columna="${columna}"]`);
        }
        if (celda){
            celda.classList.add("barco-colocado");
            celda.classList.add(tipoFlota);
        }
    }
}

export function despintarFlota(tipoFlota, fila, columna, orientacion, largo){
    for (let i = 0; i < largo; i++){
        let celda;
        if(orientacion == "horizontal"){
            celda = document.querySelector(`[data-fila="${fila}"][data-columna="${columna + i}"]`);
        }
        else{
            celda = document.querySelector(`[data-fila="${fila + i}"][data-columna="${columna}"]`);
        }
        if(celda){
            celda.classList.remove("barco-colocado", tipoFlota); 
        }
    }
}


