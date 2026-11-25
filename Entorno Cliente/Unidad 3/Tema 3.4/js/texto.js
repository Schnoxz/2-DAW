// Actividad 3.4.3 - La misma cadena insertada como texto y como HTML.
// Se usan dos contenedores distintos para poder ver los dos resultados a la vez.

const campoTexto = document.getElementById("texto-html");
const resultadoTexto = document.getElementById("resultado-texto");
const resultadoHtml = document.getElementById("resultado-html");
const salidaTexto = document.getElementById("salida-texto");

document.getElementById("btn-seguro").addEventListener("click", function () {
  // textContent convierte cualquier etiqueta en texto literal: el navegador
  // no crea nodos nuevos ni ejecuta nada
  resultadoTexto.textContent = campoTexto.value;
  salidaTexto.textContent =
    "Con textContent el contenido se ha guardado como texto: " +
    resultadoTexto.childNodes.length +
    " nodo de texto, 0 elementos dentro de la caja.";
});

document.getElementById("btn-html").addEventListener("click", function () {
  // innerHTML hace que el navegador analice la cadena y construya el marcado.
  // Es cómodo, pero si la cadena viene del usuario abre la puerta a XSS.
  resultadoHtml.innerHTML = campoTexto.value;

  // childElementCount cuenta solo etiquetas, no nodos de texto: aquí ya hay 2
  salidaTexto.textContent =
    "Con innerHTML el navegador ha creado " +
    resultadoHtml.childElementCount +
    " elementos dentro de la caja (el <strong> y el <span>).";
});

document.getElementById("btn-vaciar").addEventListener("click", function () {
  // Vaciar con textContent deja los dos contenedores limpios sin tocar el HTML
  resultadoTexto.textContent = "";
  resultadoHtml.textContent = "";
  salidaTexto.textContent = "Las dos cajas están vacías otra vez.";
});
