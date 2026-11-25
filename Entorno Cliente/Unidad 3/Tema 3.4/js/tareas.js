// Actividad 3.4.2 - Insertar tareas al principio o al final y reiniciar la lista.

const listaTareas = document.getElementById("listaTareas");
const campo = document.getElementById("texto-tarea");
const salida = document.getElementById("salida");

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
// Devuelve el texto, o una cadena vacía si no hay nada escrito.
function leerTexto() {
  return campo.value.trim();
}

document.getElementById("btn-final").addEventListener("click", function () {
  const texto = leerTexto();

  // Si el campo está vacío no se añade nada: un <li> en blanco ocupa sitio
  // y no se ve
  if (texto === "") {
    salida.textContent = "El campo está vacío: no se ha añadido nada.";
    return;
  }

  listaTareas.append(crearItem(texto));
  campo.value = "";
  salida.textContent = "«" + texto + "» añadido al final.";
});

document.getElementById("btn-principio").addEventListener("click", function () {
  const texto = leerTexto();

  if (texto === "") {
    salida.textContent = "El campo está vacío: no se ha añadido nada.";
    return;
  }

  // prepend inserta antes del primer hijo, sin tener que buscarlo
  listaTareas.prepend(crearItem(texto));
  campo.value = "";
  salida.textContent = "«" + texto + "» añadido al principio.";
});

document.getElementById("btn-reiniciar").addEventListener("click", function () {
  // replaceChildren sustituye todos los hijos por los que se le pasan,
  // así que la lista vuelve a tener un solo elemento en una sola llamada
  listaTareas.replaceChildren(crearItem("Lista reiniciada"));
  salida.textContent = "Lista reiniciada con un único elemento.";
});
