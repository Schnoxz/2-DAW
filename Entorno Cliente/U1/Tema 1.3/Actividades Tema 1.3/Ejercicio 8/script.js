// Ejercicio 8 - El test del 1.2·8 con la lógica metida en una función

// Solución correcta de las 7 preguntas (en el mismo orden que el HTML).
const respuestas = [true, false, true, true, true, true, true];

// Evalúa la respuesta y colorea el bloque según el acierto.
function responder(numero, ganaBoton) {
  const esAcierto = (respuestas[numero - 1] === ganaBoton);
  const div = document.getElementById('pregunta' + numero);

  div.style.color = esAcierto ? 'green' : 'red';
  console.log('[Ej8] Pregunta ' + numero + ': ' + (esAcierto ? 'ACIERTO' : 'ERROR'));
}
