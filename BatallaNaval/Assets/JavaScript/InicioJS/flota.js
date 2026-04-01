export let inventario = {
    "portaviones": {largo: 4, cantidad: 1},
    "acorazados": {largo: 3, cantidad: 2},
    "destructores": {largo: 2, cantidad: 3},
    "submarino": {largo: 1, cantidad: 4}
}

export function sumresFlota(valor){
    let nro;
    let Elemento;
        switch(valor){
            case 11: 
                Elemento = document.querySelector("#contador-acorazados");
                nro = parseInt(Elemento.textContent)
                if (nro > 1){
                    Elemento.textContent = nro - 1;
                }
                break;
            case 12:
                Elemento = document.querySelector("#contador-acorazados");
                nro = parseInt(Elemento.textContent);
                if(nro < 3){
                    Elemento.textContent = nro + 1;
                }
                break;
            case 21:
                Elemento = document.querySelector("#contador-destructores");
                nro = parseInt(Elemento.textContent)
                if (nro > 2){
                    Elemento.textContent = nro - 1;
                }
                break;
            case 22:
                Elemento = document.querySelector("#contador-destructores");
                nro = parseInt(Elemento.textContent);
                if (nro < 4){
                    Elemento.textContent = nro + 1;
                }
                break;  
            case 31:
                Elemento = document.querySelector("#contador-submarinos");
                nro = parseInt(Elemento.textContent)
                if (nro > 3){
                    Elemento.textContent = nro - 1;
                }
                break;
            case 32:
                Elemento = document.querySelector("#contador-submarinos");
                nro = parseInt(Elemento.textContent);
                if (nro < 5){
                    Elemento.textContent = nro + 1;
                }
                break;
    }
}
