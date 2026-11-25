// Actividad 3.3.4 - Abrir y manipular una ventana secundaria.

// La referencia se guarda fuera del evento para poder usarla en los demás botones
let ventanaAuxiliar = null;

const salida = document.getElementById("salida-ventana");

// avisar(texto)
// Muestra el mensaje en el visor de la página principal.
// No devuelve nada.
function avisar(texto) {
  salida.textContent = texto;
}

document.getElementById("btn-abrir").addEventListener("click", function () {
  // Las medidas van en la cadena de opciones; 500x400 son de área de contenido
  ventanaAuxiliar = window.open(
    "3.3.4-auxiliar.html",
    "ventanaAuxiliar",
    "width=500,height=400,resizable=yes,scrollbars=yes"
  );

  // Un bloqueador de pop-ups devuelve null en lugar de lanzar un error
  if (ventanaAuxiliar === null) {
    avisar("El navegador ha bloqueado la ventana emergente. Permite las ventanas para esta página y vuelve a intentarlo.");
    return;
  }

  avisar("Ventana auxiliar abierta a 500 × 400 px.");
});

document.getElementById("btn-grande").addEventListener("click", function () {
  if (ventanaAuxiliar === null || ventanaAuxiliar.closed) {
    avisar("Primero abre la ventana auxiliar.");
    return;
  }
  // resizeBy suma píxeles al tamaño actual, no lo fija
  ventanaAuxiliar.resizeBy(40, 40);
  avisar("Ventana ampliada 40 px de ancho y 40 px de alto.");
});

document.getElementById("btn-mover").addEventListener("click", function () {
  if (ventanaAuxiliar === null || ventanaAuxiliar.closed) {
    avisar("Primero abre la ventana auxiliar.");
    return;
  }
  // moveBy desplaza respecto a la posición actual: solo se mueve en vertical
  ventanaAuxiliar.moveBy(0, 30);
  avisar("Ventana bajada 30 px.");
});

document.getElementById("btn-foco").addEventListener("click", function () {
  if (ventanaAuxiliar === null || ventanaAuxiliar.closed) {
    avisar("Primero abre la ventana auxiliar.");
    return;
  }
  ventanaAuxiliar.focus();
  avisar("Foco enviado a la ventana auxiliar.");
});

document.getElementById("btn-cerrar").addEventListener("click", function () {
  if (ventanaAuxiliar === null || ventanaAuxiliar.closed) {
    avisar("La ventana auxiliar ya está cerrada.");
    return;
  }
  ventanaAuxiliar.close();
  avisar("Ventana auxiliar cerrada.");
});
