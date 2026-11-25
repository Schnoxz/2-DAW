// Actividad 3.4.3 - La misma cadena insertada como texto y como HTML.
// Se usan dos contenedores para poder ver los dos resultados a la vez.

const campoTexto = document.getElementById("texto-html");
const resultadoTexto = document.getElementById("resultado-texto");
const resultadoHtml = document.getElementById("resultado-html");

document.getElementById("btn-seguro").addEventListener("click", function () {
  // textContent guarda la cadena como texto: las etiquetas se ven escritas
  // y el navegador no crea ningún elemento nuevo
  resultadoTexto.textContent = campoTexto.value;
});

document.getElementById("btn-html").addEventListener("click", function () {
  // innerHTML hace que el navegador analice la cadena y construya el marcado.
  // Es cómodo, pero con datos del usuario abre la puerta a XSS.
  resultadoHtml.innerHTML = campoTexto.value;
});
