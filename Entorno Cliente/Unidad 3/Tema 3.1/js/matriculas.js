// Letras válidas en una matrícula española: las 20 consonantes del abecedario
// sin la Ñ y sin la Q (que se confunden con la O y con la Ñ al leerlas).
const CONSONANTES_DGT = "BCDFGHJKLMNPRSTVWXYZ";

// generarMatricula()
// Crea una matrícula del formato "1234 BCD": cuatro dígitos con ceros a la
// izquierda y tres consonantes al azar. No recibe parámetros. Devuelve un String.
function generarMatricula() {
  // El número va de 0 a 9999; padStart() completa con ceros hasta 4 cifras
  const numero = String(generarAleatorio(0, 9999)).padStart(4, "0");

  let letras = "";

  // Tres letras: cada una es una posición al azar de la cadena de consonantes
  for (let i = 0; i < 3; i++) {
    const posicion = Math.floor(Math.random() * CONSONANTES_DGT.length);
    letras += CONSONANTES_DGT.charAt(posicion);
  }

  return numero + " " + letras;
}

// generarIdentificador()
// Devuelve un UUID v4 generado con crypto.randomUUID(). Si el navegador no lo
// tiene (contexto no seguro), arma uno equivalente con 16 bytes aleatorios.
function generarIdentificador() {
  if (typeof crypto.randomUUID === "function") {
    return crypto.randomUUID();
  }

  // Reserva: 16 bytes y cada uno en hexadecimal de dos cifras
  const bytes = new Uint8Array(16);
  crypto.getRandomValues(bytes);

  let identificador = "";
  for (const byte of bytes) {
    identificador += byte.toString(16).padStart(2, "0");
  }

  return identificador;
}

// --- Enlace con la página ---

const botonMatricula = document.getElementById("btn-matricula");
const botonUuid = document.getElementById("btn-uuid");
const salidaMatricula = document.getElementById("salida-matricula");
const errorMatricula = document.getElementById("error-matricula");

// Últimas matrículas generadas, solo para ver que el formato se repite
const historial = [];

botonMatricula.addEventListener("click", () => {
  const matricula = generarMatricula();

  historial.unshift(matricula);
  // Solo se guardan las cinco últimas, para no llenar la página
  if (historial.length > 5) {
    historial.pop();
  }

  errorMatricula.textContent = "";
  salidaMatricula.innerHTML =
    `<div class="resultado"><span>Matrícula</span><span>${matricula}</span></div>` +
    `<ul class="lista-matriculas">${historial.map((m) => `<li>${m}</li>`).join("")}</ul>`;
});

botonUuid.addEventListener("click", () => {
  try {
    const identificador = generarIdentificador();
    errorMatricula.textContent = "";
    salidaMatricula.innerHTML =
      `<div class="resultado"><span>Identificador seguro</span><span>${identificador}</span></div>`;
  } catch (error) {
    // crypto.getRandomValues puede fallar en contextos no seguros
    salidaMatricula.textContent = "";
    errorMatricula.textContent = `No se pudo generar: ${error.message}`;
  }
});
