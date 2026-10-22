// Pinta una fila del rombo: los espacios de la izquierda y los asteriscos

//  Se define una funcion con los parámetros nivel y fila que nos servirán para los espacios y cantidad de veces que se dibujará 
function dibujarFila(nivel, filas) {
    let espacios = "";
    // En este bucle se dibujan los espacios de la izquierda, que van disminuyendo a medida que subimos en el rombo
    for (let e = 0; e < filas - nivel - 1; e++) {
        espacios += " ";
    }

    let figura = "";
    // En este bucle se dibujan los asteriscos, que van aumentando a medida que subimos en el rombo
    for (let a = 0; a < 2 * nivel + 1; a++) {
        figura += "o";
    }

    // Se imprimen los espacios y la figura en la misma línea
    console.log(espacios + figura);
}

function dibujarRombo(filas) {
    // Parte superior  con la fila del centro
    for (let i = 0; i < filas; i++) {
        dibujarFila(i, filas);
    }

    // Parte inferior lo mismo pero inversamente y desde la penultima fila hasta la primera
    for (let i = filas - 2; i >= 0; i--) {
        dibujarFila(i, filas);
    }
}

// Se llama a la función para dibujar un rombo y se le dice que son 5 filas
dibujarRombo(5);
