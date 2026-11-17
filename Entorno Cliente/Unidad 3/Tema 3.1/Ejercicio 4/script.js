// Actividad 3.1.4 - Matrículas y cripto-identificadores

"use strict";

// Consonantes válidas: sin vocales, sin Ñ y sin Q
const CONSONANTES = "BCDFGHJKLMNPRSTVWXYZ";

// Crea una matrícula del tipo "1234 BCD"
function generarMatricula() {
  // Math.floor(Math.random() * 10000): entero de 0 a 9999
  // toString(): lo pasa a texto; padStart(4, "0"): rellena con ceros a la izquierda
  const numero = Math.floor(Math.random() * 10000).toString().padStart(4, "0");

  let letras = "";
  // Tres consonantes al azar
  for (let i = 0; i < 3; i++) {
    // charAt(): carácter de esa posición; length: número de caracteres
    letras += CONSONANTES.charAt(Math.floor(Math.random() * CONSONANTES.length));
  }

  return numero + " " + letras;
}

// Token de 16 bytes (128 bits) en hexadecimal
function generarToken() {
  // Uint8Array(16): 16 bytes; getRandomValues(): los rellena al azar
  const bytes = crypto.getRandomValues(new Uint8Array(16));
  // Array.from(): recorre el array; toString(16): cada byte en hexadecimal
  // padStart(2, "0"): dos cifras por byte; join(""): lo une todo en un texto
  return Array.from(bytes, (byte) => byte.toString(16).padStart(2, "0")).join("");
}

// getElementById(): busca en la página el elemento con ese id
// addEventListener("click"): ejecuta el código al pulsar el botón
document.getElementById("btnMatricula").addEventListener("click", () => {
  // textContent: escribe el texto dentro del elemento
  document.getElementById("matricula").textContent = generarMatricula();
});

// Botón: UUID del navegador y token propio
document.getElementById("btnCripto").addEventListener("click", () => {
  // randomUUID(): UUID aleatorio del navegador
  // innerHTML: escribe HTML dentro del elemento
  document.getElementById("cripto").innerHTML =
    "UUID: " + crypto.randomUUID() + "<br>" +
    "Token: " + generarToken();
});
