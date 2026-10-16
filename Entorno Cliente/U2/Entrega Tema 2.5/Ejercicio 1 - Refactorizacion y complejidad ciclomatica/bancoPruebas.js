// Banco de pruebas del Ejercicio 1 (Tema 2.5)
// Comprueba que la funcion refactorizada da los mismos resultados que la original.
//
// Las comprobaciones van agrupadas por funcionalidad de la funcion:
//   1) Validacion de los datos de entrada.
//   2) Calculo del importe (descuentos, cupon y suelo).

const calcularMatricula = require("./matricula");

// console.assert avisa solo cuando una prueba falla, asi que ademas se imprime
// el resultado de cada una para poder ir viendo las pruebas una a una.
function comprobar(numero, descripcion, condicion) {
    console.assert(condicion, "Fallo en Test " + numero + ": " + descripcion);
    console.log("Test " + numero + ": " + (condicion ? "OK" : "FALLO") + "  (" + descripcion + ")");
}

// --- 1) Validacion de los datos de entrada ---
comprobar(1, "Rechaza una entrada nula",
    calcularMatricula(null).valido === false &&
    calcularMatricula(null).error === "Parámetros de matrícula inválidos.");

comprobar(2, "Rechaza un precio base negativo o cero",
    calcularMatricula({ precioBase: -20, tipoEstudiante: "general" }).valido === false &&
    calcularMatricula({ precioBase: -20, tipoEstudiante: "general" }).error === "El precio base debe ser un número positivo.");

comprobar(3, "Rechaza un tipo de estudiante desconocido",
    calcularMatricula({ precioBase: 100, tipoEstudiante: "extranjero" }).valido === false &&
    calcularMatricula({ precioBase: 100, tipoEstudiante: "extranjero" }).error === "Tipo de estudiante no reconocido.");

// --- 2) Calculo del importe ---
comprobar(4, "Aplica el 30% de desempleado y despues el cupon de 10 euros",
    calcularMatricula({ precioBase: 100, tipoEstudiante: "desempleado", codigoDescuento: "WEB2026" }).total === 60);

comprobar(5, "Aplica el 15% de socio sin cupon",
    calcularMatricula({ precioBase: 100, tipoEstudiante: "socio" }).total === 85);

comprobar(6, "Deja el total en cero cuando el cupon supera el precio",
    calcularMatricula({ precioBase: 5, tipoEstudiante: "general", codigoDescuento: "WEB2026" }).total === 0);

console.log("¡Todas las pruebas unitarias se ejecutaron con éxito!");
