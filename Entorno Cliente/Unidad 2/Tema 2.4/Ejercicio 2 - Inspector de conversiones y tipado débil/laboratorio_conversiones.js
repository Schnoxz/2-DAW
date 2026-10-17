// Laboratorio CE 2.d - Inspector de coerción (Tema 2.4)
// Lógica completa programada desde cero según los hitos del enunciado.

// Hito 1: captura de los elementos del DOM y del evento click
const btnAnalizar = document.getElementById("btnAnalizar");
const txtEntrada = document.getElementById("txtEntrada");
const pantallaSalida = document.getElementById("pantallaSalida");

btnAnalizar.addEventListener("click", analizarCoercion);

function analizarCoercion() {
  const textoEntrada = txtEntrada.value.trim();

  // Hito 1: normalización de la entrada literal a un primitivo real
  let valorReal;
  try {
    valorReal = JSON.parse(textoEntrada);
  } catch (error) {
    // Casos especiales que no son JSON válido pero representan primitivos en JS
    if (textoEntrada === "undefined") {
      valorReal = undefined;
    } else if (textoEntrada === "NaN") {
      valorReal = NaN;
    } else {
      valorReal = textoEntrada;   // cadena alfanumérica pura
    }
  }

  // Hito 2: conversiones explícitas y diagnóstico del tipo original
  const comoNumero   = Number(valorReal);
  const comoCadena   = String(valorReal);
  const comoBooleano = Boolean(valorReal);
  const tipoOriginal = typeof valorReal;

  // Hito 4: prueba en vivo de suma frente a resta
  const suma  = valorReal + 10;
  const resta = valorReal - 10;

  // Hito 3: detección de anomalías de coerción
  let alertaCero = "";
  if (valorReal === "0" && comoBooleano === true) {
    alertaCero = '<strong class="alerta">Aviso: la cadena "0" no está vacía, por tanto es TRUTHY (aunque Number("0") sea 0).</strong><br>';
  }

  let alertaMatriz = "";
  if (Array.isArray(valorReal) && valorReal.length === 0 && comoNumero === 0) {
    alertaMatriz = '<strong class="alerta">Aviso: una matriz vacía [] se coerciona al número 0.</strong><br>';
  }

  // Hito 5: control estricto con Number.isNaN()
  let alertaNaN = "";
  if (Number.isNaN(comoNumero)) {
    alertaNaN = '<strong class="alerta">Conversión numérica fallida: No es un número válido</strong><br>';
  }

  // Hito 6: inyección estructurada en el DOM
  pantallaSalida.innerHTML =
    `<strong>Valor analizado:</strong> <span class="valor-resaltado">${comoCadena}</span> (typeof: ${tipoOriginal})<br>` +
    `<strong>Como Número [Number(x)]:</strong> <span class="valor-resaltado">${comoNumero}</span> (typeof: ${typeof comoNumero})<br>` +
    `<strong>Como Cadena [String(x)]:</strong> <span class="valor-resaltado">${comoCadena}</span> (typeof: ${typeof comoCadena})<br>` +
    `<strong>Como Booleano [Boolean(x)]:</strong> <span class="valor-resaltado">${comoBooleano}</span> (typeof: ${typeof comoBooleano})<br>` +
    "<hr>" +
    `<strong>${comoCadena} + 10 →</strong> <span class="valor-resaltado">${suma}</span> (typeof: ${typeof suma})<br>` +
    `<strong>${comoCadena} - 10 →</strong> <span class="valor-resaltado">${resta}</span> (typeof: ${typeof resta})<br>` +
    alertaCero + alertaMatriz + alertaNaN;
}
