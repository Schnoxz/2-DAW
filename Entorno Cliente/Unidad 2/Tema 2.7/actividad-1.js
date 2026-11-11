// @ts-check
// Actividad 1 - Creación de bloque JSDoc profesional (Tema 2.7)
//
// validarDNI() documentada con JSDoc y comprobada con una batería de pruebas.
// La documentación HTML se genera con:  npx jsdoc actividad-1.js
// y queda en la carpeta out/, en out/index.html.

/**
 * Comprueba si la letra de un DNI se corresponde con su número.
 *
 * @description Calcula la letra que le toca al número según la tabla oficial
 * (el número se divide entre 23 y se toma el resto) y la compara con la letra
 * que ha escrito el usuario, sin distinguir mayúsculas de minúsculas.
 *
 * @param {number|string} numeroDNI - Parte numérica del DNI, de 0 a 8 cifras.
 * @param {string} letra - Letra del DNI, en mayúscula o en minúscula.
 * @returns {boolean} `true` si la letra es la correcta; `false` si no lo es.
 *
 * @example
 * validarDNI(12345678, "Z");    // true
 * validarDNI("12345678", "z");  // true
 * validarDNI(12345678, "A");    // false
 */
function validarDNI(numeroDNI, letra) {
  const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
  return letras[numeroDNI % 23] === letra.toUpperCase();
}

/**
 * Versión endurecida de validarDNI(). Además de comprobar la letra, revisa
 * que los datos tengan el formato esperado antes de calcular nada.
 *
 * @param {number|string} numeroDNI - Parte numérica del DNI.
 * @param {string} letra - Letra del DNI.
 * @returns {boolean} `true` solo si el formato es correcto y la letra coincide.
 */
function validarDNICompleto(numeroDNI, letra) {
  // Si la letra no es un texto de una sola letra, no hay nada que comparar
  if (typeof letra !== "string" || letra.length !== 1) {
    return false;
  }

  // El número tiene que ser solo de cifras, entre 1 y 8
  const numero = String(numeroDNI);
  if (!/^\d{1,8}$/.test(numero)) {
    return false;
  }

  const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
  const letraCalculada = letras[Number(numero) % 23];

  return letraCalculada === letra.toUpperCase();
}

// --- Banco de pruebas ---
console.assert(validarDNI(12345678, "Z") === true, "Fallo 1: 12345678Z es válido");
console.assert(validarDNI("12345678", "z") === true, "Fallo 2: la minúscula también vale");
console.assert(validarDNI(12345678, "A") === false, "Fallo 3: 12345678A no es válido");
console.assert(validarDNI(99999999, "R") === true, "Fallo 4: 99999999R es válido");
console.assert(validarDNI(0, "T") === true, "Fallo 5: el 0 también tiene letra");

console.assert(validarDNICompleto("12345678", "Z") === true, "Fallo 6: formato correcto");
console.assert(validarDNICompleto("1234567", "Z") === false, "Fallo 7: faltan cifras");
console.assert(validarDNICompleto("123456789", "Z") === false, "Fallo 8: sobran cifras");
console.assert(validarDNICompleto("12A45678", "Z") === false, "Fallo 9: hay una letra suelta");
console.assert(validarDNICompleto("12345678", "ZZ") === false, "Fallo 10: dos letras");

console.log("¡Todas las pruebas unitarias se ejecutaron con éxito!");
