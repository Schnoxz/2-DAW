"use strict";

// Actividad 3 (Tema 2.3) - sombreado de variables y "use strict"

const TASA = 0.21;

function calcularTarifa(precio) {
  const TASA = 0.10;      // sombrea a la global solo dentro de esta función
  return precio * TASA;
}

console.log("TASA global:", TASA);                  // 0.21
console.log("Tarifa de 200:", calcularTarifa(200)); // 20

try {
  saldoSinDeclarar = 500;   // asignación sin declarar
} catch (e) {
  console.log(e.name + ": " + e.message);           // ReferenceError
}
