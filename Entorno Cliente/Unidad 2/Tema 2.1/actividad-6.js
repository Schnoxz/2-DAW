// Actividad 6 - Detección de errores por sensibilidad a mayúsculas (Tema 2.1)
// Código corregido: las palabras reservadas y las funciones nativas van en minúscula.
// Resultado esperado: se muestra "Descuento aplicado" y la consola imprime 22.5 (150 x 0,15).

function calcularDescuento(PrecioBase) {
  const porcentaje = 0.15;
  if (PrecioBase > 100) {
    alert("Descuento aplicado");
    return PrecioBase * porcentaje;
  }
  return 0;
}

console.log(calcularDescuento(150)); // 22.5
