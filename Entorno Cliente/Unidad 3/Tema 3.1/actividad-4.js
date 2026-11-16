// Actividad 3.1.4 - Matrículas y cripto-identificadores (Tema 3.1)

"use strict";

// Consonantes de la DGT: sin vocales, sin Ñ y sin Q.
const CONSONANTES = "BCDFGHJKLMNPRSTVWXYZ";

function generarMatricula() {
  const numero = Math.floor(Math.random() * 10000).toString().padStart(4, "0");

  let letras = "";
  for (let i = 0; i < 3; i++) {
    letras += CONSONANTES.charAt(Math.floor(Math.random() * CONSONANTES.length));
  }

  return numero + " " + letras;
}

// 16 bytes = 128 bits; cada byte se escribe con dos cifras hexadecimales.
function generarToken() {
  const bytes = crypto.getRandomValues(new Uint8Array(16));
  return Array.from(bytes, (byte) => byte.toString(16).padStart(2, "0")).join("");
}

document.getElementById("btnMatricula").addEventListener("click", () => {
  document.getElementById("matricula").textContent = generarMatricula();
});

document.getElementById("btnCripto").addEventListener("click", () => {
  document.getElementById("cripto").innerHTML =
    "UUID: " + crypto.randomUUID() + "<br>" +
    "Token: " + generarToken();
});
