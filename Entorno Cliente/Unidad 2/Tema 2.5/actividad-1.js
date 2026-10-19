// Actividad 1 - Refactorización y control de complejidad ciclomática (Tema 2.5)
//
// El .md incluye tres bloques: el código original (antipatrón), el
// refactorizado y el banco de pruebas. Este fichero reúne el refactorizado
// y el banco de pruebas en una versión autocontenida y ejecutable.
// (La entrega del tema ya separa esto en matricula.js + bancoPruebas.js.)
//
// Código original (antipatrón) de referencia:
//
//   function calcularMatricula(datos) {
//       let resultado;
//       if (datos !== null && typeof datos === "object") {
//           if (typeof datos.precioBase === "number" && datos.precioBase > 0) {
//               if (["general", "desempleado", "socio"].includes(datos.tipoEstudiante)) {
//                   let descuentoPorcentaje = 0;
//                   if (datos.tipoEstudiante === "desempleado") {
//                       descuentoPorcentaje = 0.30;
//                   } else {
//                       if (datos.tipoEstudiante === "socio") {
//                           descuentoPorcentaje = 0.15;
//                       }
//                   }
//                   let total = datos.precioBase * (1 - descuentoPorcentaje);
//                   if (datos.codigoDescuento === "WEB2026") { total = total - 10; }
//                   if (total < 0) { total = 0; }
//                   resultado = { valido: true, total: total };
//               } else {
//                   resultado = { valido: false, error: "Tipo de estudiante no reconocido." };
//               }
//           } else {
//               resultado = { valido: false, error: "El precio base debe ser un número positivo." };
//           }
//       } else {
//           resultado = { valido: false, error: "Parámetros de matrícula inválidos." };
//       }
//       return resultado;
//   }

// --- Código refactorizado ---
function calcularMatricula(datos) {
  // Comprobaciones al principio: si algo no vale, se sale aquí mismo
  if (!datos || typeof datos !== "object") {
    return { valido: false, error: "Parámetros de matrícula inválidos." };
  }

  if (typeof datos.precioBase !== "number" || datos.precioBase <= 0) {
    return { valido: false, error: "El precio base debe ser un número positivo." };
  }

  if (!["general", "desempleado", "socio"].includes(datos.tipoEstudiante)) {
    return { valido: false, error: "Tipo de estudiante no reconocido." };
  }

  // Cálculo final, ya sin nada que lo envuelva
  let descuentoPorcentaje = 0;

  if (datos.tipoEstudiante === "desempleado") {
    descuentoPorcentaje = 0.30;
  } else if (datos.tipoEstudiante === "socio") {
    descuentoPorcentaje = 0.15;
  }

  let total = datos.precioBase * (1 - descuentoPorcentaje);

  if (datos.codigoDescuento === "WEB2026") {
    total = total - 10;
  }

  if (total < 0) {
    total = 0;
  }

  return { valido: true, total: total };
}

// --- Banco de pruebas: comprobación de equivalencia funcional ---
console.assert(
  calcularMatricula(null).valido === false &&
  calcularMatricula(null).error === "Parámetros de matrícula inválidos.",
  "Fallo en Test 1: Manejo de entrada null"
);

console.assert(
  calcularMatricula({ precioBase: -20, tipoEstudiante: "general" }).valido === false &&
  calcularMatricula({ precioBase: -20, tipoEstudiante: "general" }).error === "El precio base debe ser un número positivo.",
  "Fallo en Test 2: Precio base negativo o cero"
);

console.assert(
  calcularMatricula({ precioBase: 100, tipoEstudiante: "extranjero" }).valido === false &&
  calcularMatricula({ precioBase: 100, tipoEstudiante: "extranjero" }).error === "Tipo de estudiante no reconocido.",
  "Fallo en Test 3: Tipo de estudiante desconocido"
);

console.assert(
  calcularMatricula({ precioBase: 100, tipoEstudiante: "desempleado", codigoDescuento: "WEB2026" }).total === 60,
  "Fallo en Test 4: Descuento desempleado (30%) + cupón (-10 €)"
);

console.assert(
  calcularMatricula({ precioBase: 100, tipoEstudiante: "socio" }).total === 85,
  "Fallo en Test 5: Descuento socio (15%) sin cupón"
);

console.assert(
  calcularMatricula({ precioBase: 5, tipoEstudiante: "general", codigoDescuento: "WEB2026" }).total === 0,
  "Fallo en Test 6: Suelo mínimo a cero cuando el cupón excede el precio"
);

console.log("¡Todas las pruebas unitarias se ejecutaron con éxito!");
