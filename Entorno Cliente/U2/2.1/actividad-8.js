// Actividad 8 - Análisis del comportamiento del ASI (Tema 2.1)
//
// Este archivo ejecuta la VERSIÓN CORREGIDA. La versión original (la que
// provoca el error) se deja comentada justo debajo, porque un fichero con
// ese código no llega a ejecutarse: el error es de análisis sintáctico.
//
// Versión original (falla con "Uncaught SyntaxError: Unexpected token ':'"):
//
//   function crearConfiguracion() {
//     return
//     { modo: "oscuro", puerto: 8080 };
//   }
//
// El ASI inserta un ";" tras el return, y el bloque que sobra deja de ser un
// literal de objeto para convertirse en un bloque de código, donde "modo:"
// se lee como una etiqueta. Eso aborta el análisis y no se imprime nada.
//
// Versión corregida: la llave de apertura va en la misma línea que el return.

function crearConfiguracion() {
  return {
    modo: "oscuro",
    puerto: 8080
  };
}

const config = crearConfiguracion();
console.log(config); // { modo: 'oscuro', puerto: 8080 }
