// Actividad 3 - Validador de tipos (Tema 2.2)
//
// En el .md estas modificaciones se añaden a "laboratorio_operadores.js"
// (versión de navegador). Aquí se recrea una versión de consola con valores
// de prueba para poder ejecutar las dos modificaciones de forma individual.

// Valores de prueba (equivalen a valA y valB del laboratorio)
const valA = 0;
const valB = "texto";

// --- Modificación 1: operador AND y doble negación ---
const operacionAnd = valA && valB;
const negacionA = !!valA;
console.log("Cortocircuito AND (A && B):", String(operacionAnd)); // 0 (primer operando falsy)
console.log("Doble negación (!!A):", negacionA);                 // false

// --- Modificación 2: aviso de precisión con BigInt ---
let aviso = "";
if (typeof valA === "number" && Math.abs(valA) > Number.MAX_SAFE_INTEGER) {
  aviso = "Aviso: Precisión comprometida. Utiliza BigInt (sufijo n) para operar en este rango";
}
console.log(aviso || "(sin aviso)");
