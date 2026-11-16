// Actividad 3.1.2 - cryptoRandomFloat y función genérica (Tema 3.1)

// El PDF divide el array completo; hay que usar buffer[0].
function cryptoRandomFloat() {
  const buffer = new Uint32Array(1);
  crypto.getRandomValues(buffer);
  return buffer[0] / 4294967296; // 2^32
}

// Versiones seguras de las funciones A-E
const funcionAsegura = () => Math.floor(cryptoRandomFloat() * 11) + 10;
const funcionBsegura = () => Number((Math.floor(cryptoRandomFloat() * 11) / 10).toFixed(1));
const funcionCsegura = () => Number(((Math.floor(cryptoRandomFloat() * 1001) + 500) / 100).toFixed(2));
const funcionDsegura = () => Math.floor(cryptoRandomFloat() * 6) + 1;
const funcionEsegura = () => Number(((Math.floor(cryptoRandomFloat() * 2001) - 1000) / 1000).toFixed(3));

/**
 * Genera un número aleatorio dentro de [min, max].
 * @param {number} [min=0] - Límite inferior.
 * @param {number} [max=100] - Límite superior.
 * @param {number} [decimales=0] - Cifras decimales del resultado.
 * @param {boolean|string} [seguro=false] - Si es true, usa cryptoRandomFloat().
 * @returns {number}
 * @throws {Error} Si min es mayor que max.
 */
function generarAleatorio(min = 0, max = 100, decimales = 0, seguro = false) {
  if (min > max) {
    throw new Error("El mínimo no puede ser mayor que el máximo.");
  }

  const aleatorio = seguro ? cryptoRandomFloat() : Math.random();
  return Number((min + aleatorio * (max - min)).toFixed(decimales));
}

console.log("Entero [0, 100]:", generarAleatorio(0, 100));
console.log("Coordenada GPS [0.125, 0.875] de 3 cifras:", generarAleatorio(0.125, 0.875, 3));
console.log("Coordenada GPS [0.125, 0.875] de 3 cifras (Segura):", generarAleatorio(0.125, 0.875, 3, "segura"));

try {
  generarAleatorio(10, 1);
} catch (error) {
  console.log("Error esperado:", error.message);
}
