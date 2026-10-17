// Actividad 5 - Comparativa de cortocircuitos con valores falsy críticos (Tema 2.2)

function fijarDescuento(descuento) {
  let tasaFinalA = descuento || 15;
  let tasaFinalB = descuento ?? 15;
  console.log(`Tasa A: ${tasaFinalA} | Tasa B: ${tasaFinalB}`);
}

fijarDescuento(0); // Tasa A: 15 | Tasa B: 0  → la forma correcta es "??"
