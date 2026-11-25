// Actividad 3.2.4 - Corrección del test de autoevaluación.
// Las respuestas correctas van en un objeto fuera de la función para que
// sea fácil revisarlas o cambiarlas sin tocar la lógica.

const RESPUESTAS = { p1: "b", p2: "b", p3: "c", p4: "b" };

// corregirTest(evento)
// Recibe el evento del formulario, compara las casillas marcadas con
// RESPUESTAS y muestra cuántas están bien y cuáles fallan.
// No devuelve nada: escribe el resultado en el visor.
function corregirTest(evento) {
  // Sin esto el navegador recarga la página al enviar el formulario
  evento.preventDefault();

  const visor = document.getElementById("salida-test");
  visor.innerHTML = "";

  let aciertos = 0;
  let fallos = 0;

  Object.keys(RESPUESTAS).forEach(function (pregunta) {
    const marcada = document.querySelector('input[name="' + pregunta + '"]:checked');
    const elegida = marcada ? marcada.value : null;

    const fila = document.createElement("div");
    fila.className = "resultado";
    fila.textContent = pregunta.toUpperCase() + ": ";

    if (elegida === RESPUESTAS[pregunta]) {
      fila.textContent += "correcta (" + elegida + ")";
      aciertos++;
    } else if (elegida === null) {
      fila.textContent += "sin contestar (era " + RESPUESTAS[pregunta] + ")";
      fallos++;
    } else {
      fila.textContent += "incorrecta, elegiste " + elegida + " y era " + RESPUESTAS[pregunta];
      fallos++;
    }

    visor.appendChild(fila);
  });

  const nota = document.createElement("div");
  nota.className = "resultado";
  nota.textContent = "Aciertos: " + aciertos + " de 4 · Fallos: " + fallos;
  visor.appendChild(nota);
}

document.getElementById("form-test").addEventListener("submit", corregirTest);
