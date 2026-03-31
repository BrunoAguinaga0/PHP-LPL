export function crearTablero(filas,columnas, tamanio){
    const incluidos1 = [11,22,33,44,55,66,77,88,99,110,121,132,143,154,165,176,187,198,209,220];
    const abc1 = {11:"A",22: "B",33:"C",44: "D",55: "E",66: "F",77: "G",88: "H",99: "I",110: "J", 121:"K",132:"L",143:"M",154: "N",165:"O",176:"P",187:"Q",198:"R",209:"S",220:"T"};
    const incluidos2 = [16,32, 48, 64, 80, 96, 112, 128, 144, 160, 176, 192, 208, 224, 240];
    const abc2 = {16:"A",32: "B",48: "C",64: "D",80: "E",96: "F",112: "G",128: "H",144: "I",160: "J", 176:"K",192:"L",208:"M",224: "N",240:"O"};
    let incluidos;
    let abc;
    if(tamanio == 1 || tamanio == 4){
        abc = abc1;
        incluidos = incluidos1;
    }else{
        abc = abc2;
        incluidos = incluidos2;
    }
    let tcolumnas;
    let tfilas;
    if(tamanio == 4){
        tcolumnas = "1fr";
        tfilas = "1.42rem";
    }else{
        tcolumnas = "1fr";
        tfilas = "1fr";
    }
    const elemento5 = document.querySelector(".elemento5");
    elemento5.style.boxShadow = "#26c3be 0 0 17px";
    const container = document.querySelector(".elemento5");
    container.innerHTML = "";
    const grilla = document.createElement("div");
    grilla.style.display = "grid";
    grilla.style.gridTemplateColumns = `0.5fr repeat(${columnas-1}, ${tcolumnas})`;
    grilla.style.gridTemplateRows = `0.5fr repeat(${filas-1} , ${tfilas})`;
    grilla.style.width = "100%";
    grilla.style.height = "100%";
    let i = 0;
    for (i=0; i<(filas*columnas); i++){
        let filaPos = Math.floor(i/columnas);
        let columnaPos = i % columnas;
        if (i>=0 && i<columnas){
            const numero = document.createElement("div");
            const contenido = document.createElement("p");
            numero.classList.add("div-posTablero");
            numero.dataset.fila = filaPos;
            numero.dataset.columna = columnaPos;
            numero.appendChild(contenido);
            grilla.appendChild(numero);
            if(i==0){
                contenido.textContent = "";
            }
            else{
                contenido.textContent = i;
            }
        }else if(incluidos.includes(i)){
            const letra = document.createElement("div");
            letra.classList.add("div-posTablero");
            letra.dataset.fila = filaPos;
            letra.dataset.columna = columnaPos;
            const linea = document.createElement("p");
            linea.textContent = abc[i];
            letra.appendChild(linea);
            grilla.appendChild(letra);
        }
        else{
            const celda = document.createElement("div");
            celda.dataset.fila = filaPos;
            celda.dataset.columna = columnaPos;
            celda.classList.add("celda-previsualizacion");
            grilla.appendChild(celda);
        }
    }
    container.appendChild(grilla);
}

export function pintarFlota(fila,columna, tipoFlota, orientacion){
    const celda = document.querySelector(`[data-fila="${fila}"][data-columna="${columna}"]`);
    if (celda){
        celda.classList.add("barco-colocado");
        celda.classList.add(tipoFlota);
        celda.dataset.orientacion = orientacion;
    }

}


