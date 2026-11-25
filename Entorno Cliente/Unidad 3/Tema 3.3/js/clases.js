// Actividad 3.3.1 - Cambiar el aspecto de una caja con classList.
// La caja lleva siempre la clase "caja-inicial" y el cambio añade o quita
// "caja-grande", que es la clase que trae las medidas y el borde nuevos.

const caja = document.getElementById("caja");

document.getElementById("btn-cambiar").addEventListener("click", function () {
  // toggle añade la clase si no estaba y la quita si ya estaba, así que el
  // mismo botón sirve para agrandar y para volver al tamaño de antes
  caja.classList.toggle("caja-grande");
});

document.getElementById("btn-restablecer").addEventListener("click", function () {
  // remove no falla si la clase no está puesta: no hace falta comprobarlo antes
  caja.classList.remove("caja-grande");
});
