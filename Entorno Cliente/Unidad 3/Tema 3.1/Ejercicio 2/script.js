// Actividad 3.1.2 - Generador criptográfico y función genérica

// cryptoRandomFloat()
// Decimal seguro entre 0 y 1 usando la entropía del sistema
function cryptoRandomFloat() {
  const buffer = new Uint32Array(1); // array tipado con un entero de 32 bits
  crypto.getRandomValues(buffer);    // lo rellena con valores aleatorios
  return buffer[0] / 4294967296;     // buffer[0] ya es el número (el array daría NaN)
}

// Las mismas funciones A-E, pero con el generador seguro
const funcionAsegura = () => Math.floor(cryptoRandomFloat() * 11) + 10;
const funcionBsegura = () => Number((Math.floor(cryptoRandomFloat() * 11) / 10).toFixed(1));
const funcionCsegura = () => Number(((Math.floor(cryptoRandomFloat() * 1001) + 500) / 100).toFixed(2));
const funcionDsegura = () => Math.floor(cryptoRandomFloat() * 6) + 1;
const funcionEsegura = () => Number(((Math.floor(cryptoRandomFloat() * 2001) - 1000) / 1000).toFixed(3));

// generarAleatorio(min, max, decimales, seguro)
// Número al azar en [min, max], con los decimales pedidos
// El cuarto parámetro, si es verdadero, usa cryptoRandomFloat()
function generarAleatorio(min = 0, max = 100, decimales = 0, seguro = false) {
  // throw new Error(): crea y lanza un error con mensaje
  if (min > max) {
    throw new Error("El mínimo no puede ser mayor que el máximo.");
  }

  // Elige Math.random() o el generador seguro
  const aleatorio = seguro ? cryptoRandomFloat() : Math.random();

  // toFixed(): redondea a los decimales pedidos; Number(): devuelve un número
  return Number((min + aleatorio * (max - min)).toFixed(decimales));
}

// Casos de uso
console.log("Entero [0, 100]:", generarAleatorio(0, 100));
console.log("Coordenada GPS [0.125, 0.875] de 3 cifras:", generarAleatorio(0.125, 0.875, 3));
console.log("Coordenada GPS [0.125, 0.875] de 3 cifras (Segura):", generarAleatorio(0.125, 0.875, 3, "segura"));

// try/catch: intenta el error a propósito y recoge el mensaje
try {
  generarAleatorio(10, 1);
} catch (error) {
  console.log("Error esperado:", error.message);
}
