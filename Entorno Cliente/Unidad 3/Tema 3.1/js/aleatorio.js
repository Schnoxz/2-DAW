// Funciones del enunciado 3.1.1. Se dejan tal cual para poder medir su rango
// con el botón de comprobación; en la tabla de la página está la respuesta.

// funcionA()
// Entero al azar de 10 a 20. No recibe parámetros. Devuelve un Number entero.
function funcionA() {
  const amplitud = 10; // (20 - 10)
  const enteroBase = Math.floor(Math.random() * (amplitud + 1)) + 10;
  return enteroBase;
}

// funcionB()
// Entero de 0 a 10 dividido entre 10, con un decimal. Devuelve un Number.
function funcionB() {
  const amplitud = 10;
  const enteroBase = Math.floor(Math.random() * (amplitud + 1));
  return Number((enteroBase / 10).toFixed(1));
}

// funcionC()
// Entero de 500 a 1500 dividido entre 100, con dos decimales.
// Devuelve un Number entre 5 y 15.
function funcionC() {
  const minEscalado = 500;
  const maxEscalado = 1500;
  const enteroBase = Math.floor(Math.random() * (maxEscalado - minEscalado + 1)) + minEscalado;
  return Number((enteroBase / 100).toFixed(2));
}

// funcionD()
// Simula un dado de 6 caras. No recibe parámetros. Devuelve un entero de 1 a 6.
function funcionD() {
  const amplitud = 5;
  const enteroBase = Math.floor(Math.random() * (amplitud + 1)) + 1;
  return enteroBase;
}

// funcionE()
// Entero de -1000 a 1000 dividido entre 1000, con tres decimales.
// Devuelve un Number entre -1 y 1.
function funcionE() {
  const minEscalado = -1000;
  const maxEscalado = 1000;
  const enteroBase = Math.floor(Math.random() * (maxEscalado - minEscalado + 1)) + minEscalado;
  return Number((enteroBase / 1000).toFixed(3));
}

// numeroA()
// Entero al azar de 0 a 100, ambos incluidos. Devuelve un Number.
const numeroA = () => Math.floor(Math.random() * 101);

// numeroB()
// Lanza una moneda: 0 o 1. Devuelve un Number.
const numeroB = () => Math.floor(Math.random() * 2);

// F()
// Entero de 0 a 2^53 - 1 dividido entre ese mismo máximo.
// Devuelve un Number entre 0 y 1, con todos los decimales que quepan.
function F() {
  // 2^53 - 1 es el mayor entero que JavaScript representa sin perder precisión
  const maxGranEntero = 9007199254740991;
  const enteroAleatorio = Math.floor(Math.random() * (maxGranEntero + 1));
  return enteroAleatorio / maxGranEntero;
}

// generarAleatorio(min, max, decimales, seguro)
// Devuelve un número al azar dentro de [min, max]. Con decimales = 0 es un
// entero; con decimales > 0 redondea a esa cantidad de cifras. El cuarto
// parámetro, si vale "segura", cambia Math.random() por cryptoRandomFloat().
// Lanza un Error si min > max o si decimales no es un entero válido.
function generarAleatorio(min = 0, max = 100, decimales = 0, seguro = "normal") {
  if (min > max) {
    throw new Error(`El mínimo (${min}) no puede ser mayor que el máximo (${max}).`);
  }

  if (!Number.isInteger(decimales) || decimales < 0) {
    throw new Error("Los decimales tienen que ser un entero mayor o igual que 0.");
  }

  // Elijo el generador una sola vez y el resto de la función es igual para los dos
  const aleatorio = seguro === "segura" ? cryptoRandomFloat() : Math.random();

  if (decimales === 0) {
    // Al sumar 1 a la amplitud, el máximo también puede salir
    return Math.floor(aleatorio * (max - min + 1)) + min;
  }

  // En un intervalo continuo no se suma 1: el máximo solo saldría con r = 1,
  // y Math.random() nunca llega a 1
  const valor = min + aleatorio * (max - min);

  // Number() es imprescindible porque toFixed() devuelve un String
  return Number(valor.toFixed(decimales));
}

// medirRango(funcion, veces)
// Ejecuta la función muchas veces y devuelve el menor y el mayor valor vistos.
// Se usa solo para comprobar la tabla de la actividad 3.1.1.
function medirRango(funcion, veces = 20000) {
  let minimo = Infinity;
  let maximo = -Infinity;

  for (let i = 0; i < veces; i++) {
    const valor = funcion();
    if (valor < minimo) {
      minimo = valor;
    }
    if (valor > maximo) {
      maximo = valor;
    }
  }

  return { minimo, maximo };
}

// --- Enlace con la página ---

const botonMedir = document.getElementById("btn-medir");

botonMedir.addEventListener("click", () => {
  const funciones = [
    ["funcionA()", funcionA, "[10, 20]"],
    ["funcionB()", funcionB, "[0.0, 1.0]"],
    ["funcionC()", funcionC, "[5.00, 15.00]"],
    ["funcionD()", funcionD, "[1, 6]"],
    ["funcionE()", funcionE, "[-1.000, 1.000]"],
    ["numeroA()", numeroA, "[0, 100]"],
    ["numeroB()", numeroB, "[0, 1]"],
    ["F()", F, "[0, 1]"],
  ];

  let texto = "Rango observado en 20.000 tiradas (el mínimo y el máximo pueden\n";
  texto += "no salir por puro azar, pero nunca se saldrán del intervalo):\n\n";

  for (const [nombre, funcion, teorico] of funciones) {
    const { minimo, maximo } = medirRango(funcion);
    texto += `${nombre.padEnd(12)} observado [${minimo}, ${maximo}]   teórico ${teorico}\n`;
  }

  document.getElementById("salida-medir").textContent = texto;
});

const botonGenerar = document.getElementById("btn-generar");
const botonError = document.getElementById("btn-error");

// leerNumero(id)
// Lee el valor de un input y lo convierte a Number. Devuelve NaN si está vacío.
function leerNumero(id) {
  const texto = document.getElementById(id).value.trim();
  return texto === "" ? NaN : Number(texto);
}

botonGenerar.addEventListener("click", () => {
  const min = leerNumero("min");
  const max = leerNumero("max");
  const decimales = leerNumero("decimales");
  const seguro = document.getElementById("seguro").value;
  const salida = document.getElementById("salida-generar");
  const cajaError = document.getElementById("error-generar");

  try {
    const valor = generarAleatorio(min, max, decimales, seguro);
    cajaError.textContent = "";
    salida.textContent =
      `generarAleatorio(${min}, ${max}, ${decimales}, "${seguro}")` +
      `\n  -> ${valor}   (tipo: ${typeof valor})`;
  } catch (error) {
    salida.textContent = "";
    cajaError.textContent = `Error capturado: ${error.message}`;
  }
});

botonError.addEventListener("click", () => {
  const salida = document.getElementById("salida-generar");
  const cajaError = document.getElementById("error-generar");

  try {
    // Caso de error a propósito: el mínimo es mayor que el máximo
    generarAleatorio(100, 0, 0);
    cajaError.textContent = "No ha lanzado el error, algo va mal.";
  } catch (error) {
    salida.textContent = "";
    cajaError.textContent = `Error capturado: ${error.message}`;
  }
});
