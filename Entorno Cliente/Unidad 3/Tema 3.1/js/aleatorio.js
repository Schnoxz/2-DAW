// Actividad 3.1.1: cada función usa Math.random() de una forma distinta.
// Math.random() devuelve un decimal al azar en [0, 1); Math.floor() lo
// trunca. El botón de la página mide el rango real con 20.000 tiradas.

// Entero al azar entre 10 y 20
function funcionA() {
  const amplitud = 10; // 20 - 10
  // El + 1 hace que el máximo también pueda salir
  const enteroBase = Math.floor(Math.random() * (amplitud + 1)) + 10;
  return enteroBase;
}

// Un decimal al azar entre 0.0 y 1.0
function funcionB() {
  const amplitud = 10;
  const enteroBase = Math.floor(Math.random() * (amplitud + 1));
  // toFixed(1) deja un decimal (devuelve texto); Number() lo vuelve a número
  return Number((enteroBase / 10).toFixed(1));
}

// Dos decimales al azar entre 5.00 y 15.00
function funcionC() {
  const minEscalado = 500;
  const maxEscalado = 1500;
  // 1001 valores posibles (500 a 1500) que luego se dividen entre 100
  const enteroBase = Math.floor(Math.random() * (maxEscalado - minEscalado + 1)) + minEscalado;
  return Number((enteroBase / 100).toFixed(2));
}

// Dado de 6 caras: entero entre 1 y 6
function funcionD() {
  const amplitud = 5;
  const enteroBase = Math.floor(Math.random() * (amplitud + 1)) + 1;
  return enteroBase;
}

// Tres decimales al azar entre -1.000 y 1.000
function funcionE() {
  const minEscalado = -1000;
  const maxEscalado = 1000;
  // 2001 valores posibles (-1000 a 1000) divididos entre 1000
  const enteroBase = Math.floor(Math.random() * (maxEscalado - minEscalado + 1)) + minEscalado;
  return Number((enteroBase / 1000).toFixed(3));
}

// Entero entre 0 y 100
const numeroA = () => Math.floor(Math.random() * 101);

// Lanza una moneda: 0 o 1
const numeroB = () => Math.floor(Math.random() * 2);

// Decimal entre 0 y 1 sin fijar los decimales
function F() {
  // 2^53 - 1 es el mayor entero exacto de JavaScript
  const maxGranEntero = 9007199254740991;
  const enteroAleatorio = Math.floor(Math.random() * (maxGranEntero + 1));
  return enteroAleatorio / maxGranEntero;
}

// generarAleatorio(min, max, decimales, seguro)
// Número al azar en [min, max], con los decimales pedidos
function generarAleatorio(min = 0, max = 100, decimales = 0, seguro = "normal") {
  // El rango no puede estar al revés
  if (min > max) {
    throw new Error(`El mínimo (${min}) no puede ser mayor que el máximo (${max}).`);
  }

  // Number.isInteger(): true si el valor es un número entero
  if (!Number.isInteger(decimales) || decimales < 0) {
    throw new Error("Los decimales tienen que ser un entero mayor o igual que 0.");
  }

  // Elige Math.random() o el generador seguro
  const aleatorio = seguro === "segura" ? cryptoRandomFloat() : Math.random();

  if (decimales === 0) {
    // Con enteros se suma 1 para que el máximo pueda salir
    return Math.floor(aleatorio * (max - min + 1)) + min;
  }

  // Con decimales el intervalo es continuo: no se suma 1
  const valor = min + aleatorio * (max - min);

  // toFixed() devuelve texto; Number() lo devuelve a número
  return Number(valor.toFixed(decimales));
}

// medirRango(funcion, veces)
// Devuelve el menor y el mayor valor vistos en N tiradas
function medirRango(funcion, veces = 20000) {
  // Infinity supera cualquier número: sirve de valor inicial
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

// getElementById(): busca en la página el elemento con ese id
const botonMedir = document.getElementById("btn-medir");

// addEventListener("click"): ejecuta el código al pulsar el botón
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
    // padEnd(12): rellena el nombre con espacios hasta 12 letras
    texto += `${nombre.padEnd(12)} observado [${minimo}, ${maximo}]   teórico ${teorico}\n`;
  }

  // textContent: escribe el texto dentro del elemento
  document.getElementById("salida-medir").textContent = texto;
});

const botonGenerar = document.getElementById("btn-generar");
const botonError = document.getElementById("btn-error");

// leerNumero(id)
// Lee un input y lo pasa a Number; si está vacío devuelve NaN
function leerNumero(id) {
  // value: texto escrito en el campo; trim(): le quita los espacios
  const texto = document.getElementById(id).value.trim();
  return texto === "" ? NaN : Number(texto);
}

// Genera un número con los valores del formulario
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
    // Si la función lanza un Error, se muestra en rojo
    salida.textContent = "";
    cajaError.textContent = `Error capturado: ${error.message}`;
  }
});

// Fuerza el caso de error a propósito: mínimo mayor que máximo
botonError.addEventListener("click", () => {
  const salida = document.getElementById("salida-generar");
  const cajaError = document.getElementById("error-generar");

  try {
    generarAleatorio(100, 0, 0);
    cajaError.textContent = "No ha lanzado el error, algo va mal.";
  } catch (error) {
    salida.textContent = "";
    cajaError.textContent = `Error capturado: ${error.message}`;
  }
});
