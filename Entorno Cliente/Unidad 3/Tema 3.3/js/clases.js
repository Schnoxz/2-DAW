// Actividad 3.3.1 - Cambiar el aspecto de una caja con classList.
// La caja tiene siempre la clase "caja-inicial"; el cambio añade o quita
// la clase "caja-grande", que es la que lleva las medidas nuevas.

const caja = document.getElementById("caja");
const aviso = document.getElementById("estado");

// actualizarAviso(texto)
// Escribe en el visor qué clases tiene ahora mismo la caja.
// No devuelve nada: sirve para comprobar el estado a simple vista.
function actualizarAviso(texto) {
  aviso.textContent = texto + " · clases: " + caja.className;
}

document.getElementById("btn-cambiar").addEventListener("click", function () {
  // toggle añade la clase si no estaba y la quita si ya estaba: un solo botón
  // hace de interruptor, sin necesidad de llevar la cuenta por mi parte
  caja.classList.toggle("caja-grande");

  if (caja.classList.contains("caja-grande")) {
    actualizarAviso("Caja agrandada: 300 × 250 px y borde discontinuo verde");
  } else {
    actualizarAviso("Vuelta al tamaño inicial");
  }
});

document.getElementById("btn-restablecer").addEventListener("click", function () {
  // remove no falla si la clase no existe, así que no hace falta comprobar antes
  caja.classList.remove("caja-grande");
  actualizarAviso("Restablecida");
});
