// Actividad 3.3.4 - Abrir y manipular una ventana secundaria.

// La referencia se guarda fuera del evento porque los demás botones la necesitan
let ventanaAuxiliar = null;

const salida = document.getElementById("salida-ventana");

// avisar(texto)
// Escribe el mensaje en el visor de la página principal.
// No devuelve nada.
function avisar(texto) {
  salida.textContent = texto;
}

// abierta()
// Comprueba que la ventana existe y que el usuario no la ha cerrado a mano.
// Devuelve true si se puede manipular y false si ya no vale.
function abierta() {
  if (ventanaAuxiliar === null || ventanaAuxiliar.closed) {
    avisar("Primero abre la ventana auxiliar.");
    return false;
  }
  return true;
}

document.getElementById("btn-abrir").addEventListener("click", function () {
  // 500 por 400 son las medidas que pide el enunciado
  ventanaAuxiliar = window.open("3.3.4-auxiliar.html", "ventanaAuxiliar", "width=500,height=400");

  // Un bloqueador de ventanas emergentes no lanza error: devuelve null
  if (ventanaAuxiliar === null) {
    avisar("El navegador ha bloqueado la ventana emergente. Permite las ventanas para esta página y vuelve a intentarlo.");
    return;
  }

  avisar("Ventana auxiliar abierta a 500 × 400 px.");
});

document.getElementById("btn-grande").addEventListener("click", function () {
  if (!abierta()) {
    return;
  }
  // resizeBy suma píxeles al tamaño actual, no lo fija
  ventanaAuxiliar.resizeBy(40, 40);
  avisar("Ventana ampliada 40 px de ancho y 40 px de alto.");
});

document.getElementById("btn-mover").addEventListener("click", function () {
  if (!abierta()) {
    return;
  }
  // moveBy desplaza respecto a la posición actual: solo se mueve en vertical
  ventanaAuxiliar.moveBy(0, 30);
  avisar("Ventana bajada 30 px.");
});

document.getElementById("btn-foco").addEventListener("click", function () {
  if (!abierta()) {
    return;
  }
  ventanaAuxiliar.focus();
  avisar("Foco enviado a la ventana auxiliar.");
});

document.getElementById("btn-cerrar").addEventListener("click", function () {
  if (!abierta()) {
    return;
  }
  ventanaAuxiliar.close();
  avisar("Ventana auxiliar cerrada.");
});
