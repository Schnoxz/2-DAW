// Letras válidas de la DGT: sin vocales, sin Ñ y sin Q
const CONSONANTES_DGT = "BCDFGHJKLMNPRSTVWXYZ";

// generarMatricula()
// Devuelve una matrícula del tipo "1234 BCD"
function generarMatricula() {
  // String(): pasa el número a texto; padStart(4, "0"): ceros a la izquierda
  const numero = String(generarAleatorio(0, 9999)).padStart(4, "0");

  let letras = "";

  // Tres consonantes al azar
  for (let i = 0; i < 3; i++) {
    // charAt(): carácter de esa posición; length: número de caracteres
    const posicion = Math.floor(Math.random() * CONSONANTES_DGT.length);
    letras += CONSONANTES_DGT.charAt(posicion);
  }

  return numero + " " + letras;
}

// generarIdentificador()
// Devuelve un UUID v4; si el navegador no lo tiene, lo arma a mano
function generarIdentificador() {
  // typeof comprueba que la función existe; randomUUID(): UUID aleatorio
  if (typeof crypto.randomUUID === "function") {
    return crypto.randomUUID();
  }

  // Uint8Array(16): 16 bytes; getRandomValues(): los rellena al azar
  const bytes = new Uint8Array(16);
  crypto.getRandomValues(bytes);

  // Bits de versión (4) y de variante RFC 4122: los exige un UUID v4
  bytes[6] = (bytes[6] & 0x0f) | 0x40;
  bytes[8] = (bytes[8] & 0x3f) | 0x80;

  // toString(16): byte en hexadecimal; padStart(2, "0"): dos cifras por byte
  const hex = [...bytes].map((byte) => byte.toString(16).padStart(2, "0"));

  // Formato 8-4-4-4-12
  return `${hex.slice(0, 4).join("")}-${hex.slice(4, 6).join("")}-` +
         `${hex.slice(6, 8).join("")}-${hex.slice(8, 10).join("")}-` +
         `${hex.slice(10).join("")}`;
}

// --- Enlace con la página ---

// getElementById(): busca en la página el elemento con ese id
const botonMatricula = document.getElementById("btn-matricula");
const botonUuid = document.getElementById("btn-uuid");
const salidaMatricula = document.getElementById("salida-matricula");
const errorMatricula = document.getElementById("error-matricula");

// Últimas matrículas generadas, para ver que el formato se repite
const historial = [];

// addEventListener("click"): ejecuta el código al pulsar el botón
botonMatricula.addEventListener("click", () => {
  const matricula = generarMatricula();

  // unshift(): añade el elemento al principio del array
  historial.unshift(matricula);
  // pop(): quita el último elemento del array
  if (historial.length > 5) {
    historial.pop();
  }

  // textContent: escribe el texto dentro del elemento
  errorMatricula.textContent = "";
  // innerHTML: escribe HTML; map(): recorre el array y crea una lista;
  // join(""): une los trozos en un solo texto
  salidaMatricula.innerHTML =
    `<div class="resultado"><span>Matrícula</span><span>${matricula}</span></div>` +
    `<ul class="lista-matriculas">${historial.map((m) => `<li>${m}</li>`).join("")}</ul>`;
});

// Botón: genera un identificador seguro
botonUuid.addEventListener("click", () => {
  // try/catch: si falla la generación, se recoge el error
  try {
    const identificador = generarIdentificador();
    errorMatricula.textContent = "";
    salidaMatricula.innerHTML =
      `<div class="resultado"><span>Identificador seguro</span><span>${identificador}</span></div>`;
  } catch (error) {
    // crypto.getRandomValues puede fallar en un contexto no seguro
    salidaMatricula.textContent = "";
    errorMatricula.textContent = `No se pudo generar: ${error.message}`;
  }
});
