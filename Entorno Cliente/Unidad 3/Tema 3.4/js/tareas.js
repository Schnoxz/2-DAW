// Actividad 3.4.2 - Insertar tareas al principio o al final y reiniciar la lista.
// append() y prepend() aceptan texto directamente, pero aquí el <li> se crea
// aparte para poder explicar el proceso.

const listaTareas = document.getElementById("listaTareas");
const campo = document.getElementById("texto-tarea");
const salidaTareas = document.getElementById("salida-tareas");

// crearItem(texto)
// Devuelve un <li> nuevo con el texto recibido dentro.
// No toca el documento: solo lo prepara en memoria.
function crearItem(texto) {
  const item = document.createElement("li");
  item.textContent = texto;
  return item;
}

// leerTexto()
// Recoge el valor del campo quitando los espacios de los extremos.
// Devuelve el texto o una cadena vacía si no hay nada escrito.
function leerTexto() {
  return campo.value.trim();
}

// avisar(texto)
// Escribe el mensaje en el visor de la actividad.
// No devuelve nada.
function avisar(texto) {
  salidaTareas.textContent = texto;
}

document.getElementById("btn-final").addEventListener("click", function () {
  const texto = leerTexto();

  // Si el campo está vacío no se añade nada: un <li> en blanco no sirve
  if (texto === "") {
    avisar("El campo está vacío: no se ha añadido nada.");
    return;
  }

  listaTareas.append(crearItem(texto));
  campo.value = "";
  avisar("«" + texto + "» añadido al final.");
});

document.getElementById("btn-principio").addEventListener("click", function () {
  const texto = leerTexto();

  if (texto === "") {
    avisar("El campo está vacío: no se ha añadido nada.");
    return;
  }

  // prepend inserta antes del primer hijo, sin tener que buscarlo
  listaTareas.prepend(crearItem(texto));
  campo.value = "";
  avisar("«" + texto + "» añadido al principio.");
});

document.getElementById("btn-reiniciar").addEventListener("click", function () {
  // replaceChildren sustituye todos los hijos por los que se le pasan,
  // así que la lista vuelve a tener un solo elemento en una sola llamada
  listaTareas.replaceChildren(crearItem("Lista reiniciada"));
  avisar("Lista reiniciada con un único elemento.");
});
