// Actividad 3.1.1 - Rangos de Math.random() (Tema 3.1)
//
// Math.random() devuelve un decimal en [0, 1). Para enteros se usa:
// Math.floor(Math.random() * (max - min + 1)) + min

function funcionA() {
  const amplitud = 10; // 20 - 10
  const enteroBase = Math.floor(Math.random() * (amplitud + 1)) + 10;
  return enteroBase; // [10, 20], 0 decimales
}

function funcionB() {
  const amplitud = 10;
  const enteroBase = Math.floor(Math.random() * (amplitud + 1));
  return Number((enteroBase / 10).toFixed(1)); // [0, 1], 1 decimal
}

function funcionC() {
  const minEscalado = 500;
  const maxEscalado = 1500;
  const enteroBase = Math.floor(Math.random() * (maxEscalado - minEscalado + 1)) + minEscalado;
  return Number((enteroBase / 100).toFixed(2)); // [5, 15], 2 decimales
}

function funcionD() {
  const amplitud = 5;
  const enteroBase = Math.floor(Math.random() * (amplitud + 1)) + 1;
  return enteroBase; // [1, 6], 0 decimales
}

function funcionE() {
  const minEscalado = -1000;
  const maxEscalado = 1000;
  const enteroBase = Math.floor(Math.random() * (maxEscalado - minEscalado + 1)) + minEscalado;
  return Number((enteroBase / 1000).toFixed(3)); // [-1, 1], 3 decimales
}

// Funciones auxiliares del mismo bloque
const numeroA = () => Math.floor(Math.random() * 101); // [0, 100], 0 decimales
const numeroB = () => Math.floor(Math.random() * 2);   // [0, 1], 0 decimales

function funcionF() {
  const maxGranEntero = 9007199254740991; // 2^53 - 1
  const enteroAleatorio = Math.floor(Math.random() * (maxGranEntero + 1));
  return enteroAleatorio / maxGranEntero; // [0, 1], decimales variables
}

console.log("funcionA:", funcionA(), "| [10, 20], 0 decimales");
console.log("funcionB:", funcionB(), "| [0, 1], 1 decimal");
console.log("funcionC:", funcionC(), "| [5, 15], 2 decimales");
console.log("funcionD:", funcionD(), "| [1, 6], 0 decimales");
console.log("funcionE:", funcionE(), "| [-1, 1], 3 decimales");
console.log("numeroA:", numeroA(), "| [0, 100], 0 decimales");
console.log("numeroB:", numeroB(), "| [0, 1], 0 decimales");
console.log("funcionF:", funcionF(), "| [0, 1], decimales variables");
