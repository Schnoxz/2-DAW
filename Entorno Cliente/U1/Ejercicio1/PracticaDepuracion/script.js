// ============================================================
//  script.js  —  Ejercicio 1 (separado del HTML para depurar)
//  Ejercicio: consumos de CPU/RAM en el cliente (front-end).
//
//  CÓMO DEPURAR PASO A PASO:
//   1. Abre el HTML en el navegador y pulsa F12.
//   2. Ve a la pestaña "Sources" → selecciona "script.js" (arriba).
//   3. Haz clic en los NÚMEROS DE LÍNEA (115, 166, 207) para poner
//      un breakpoint visible (marcador azul) → no hace falta el
//      `debugger;` del código, pero se deja para forzar la pausa.
//   4. Pulsa el botón correspondiente en la página → el código se
//      DETIENE en la línea marcada.
//   5. Usa F10 (paso por encima), F11 (paso a paso), F8 (continuar).
// ============================================================

// ============================================================
// BLOQUE 2: ÁMBITO GLOBAL DEL CLIENTE
// Variable global que retiene la carga en la RAM del navegador.
// Mientras viva catalogoProductos, la memoria RAM queda ocupada.
// ============================================================
let catalogoProductos = [];

const categoriasDisponibles = ["Informática", "Telefonía", "Hogar", "Audio", "Oficina"];
const salida = document.getElementById("consolaVisual");

// ============================================================
// BLOQUE 3: GENERACIÓN DE DATOS (carga en RAM del cliente)
//
// MODIFICACIÓN GUIADA M3 (prueba de estrés):
//   TOTAL_REGISTROS pasa de 150.000 a 500.000 registros.
//   El navegador crea 500.000 objetos en su memoria → se detecta
//   el aumento de consumo de RAM y CPU local.
// ============================================================
document.getElementById("btnGenerar").addEventListener("click", () => {
  salida.textContent = "Generando 500.000 registros en la RAM del cliente...";

  // ============================================================
  // BREAKPOINT 1 (línea aprox. 115):
  //   Al pausar aquí puedes:
  //     - Ratón sobre `catalogoProductos` → está vacío [].
  //     - F10 → el bucle llena la RAM registro a registro.
  //     - F11 → ENTRAS dentro del push().
  // ============================================================
  debugger;

  console.time("Tiempo de generación en RAM");

  catalogoProductos = [];
  const TOTAL_REGISTROS = 500000;

  for (let i = 1; i <= TOTAL_REGISTROS; i++) {
    catalogoProductos.push({
      id: i,
      nombre: `Producto ${i}`,
      precio: parseFloat((Math.random() * 900 + 10).toFixed(2)),
      categoria: categoriasDisponibles[Math.floor(Math.random() * categoriasDisponibles.length)]
    });
  }

  console.timeEnd("Tiempo de generación en RAM");

  salida.textContent = `Generados ${TOTAL_REGISTROS.toLocaleString()} productos en memoria RAM local.\nRevisa la consola (F12) para ver el tiempo exacto.`;
});

// ============================================================
// BLOQUE 4: ORDENACIÓN EN CLIENTE (CPU local intensiva)
//
// MODIFICACIÓN GUIADA M1 (invertir criterio):
//   Antes: (a, b) => a.precio - b.precio  (ascendente)
//   Ahora: (a, b) => b.precio - a.precio  (DESCENDENTE)
// El mensaje muestra primero el MÁS CARO y después el MÁS BARATO.
// ============================================================
document.getElementById("btnOrdenar").addEventListener("click", () => {
  if (catalogoProductos.length === 0) {
    salida.textContent = "Primero genera los productos.";
    return;
  }

  salida.textContent = "Ordenando catálogo por precio mediante la CPU del navegador...";

  // ============================================================
  // BREAKPOINT 2 (línea aprox. 166):
  //   Pausa ANTES de ordenar. Comprueba que `catalogoProductos`
  //   tiene 500.000 objetos. F10 ejecuta el .sort() completo.
  // ============================================================
  debugger;

  console.time("Tiempo de ordenación (CPU Cliente)");

  // Algoritmo de ordenación con predicado (INVERTIDO: descendente)
  catalogoProductos.sort((a, b) => b.precio - a.precio);

  console.timeEnd("Tiempo de ordenación (CPU Cliente)");

  salida.textContent = `Ordenación completada.\n- Producto más caro: ${catalogoProductos[0].precio} €\n- Producto más barato: ${catalogoProductos[catalogoProductos.length - 1].precio} €\n(Consumo de cómputo transferido con éxito del servidor al cliente).`;
});

// ============================================================
// BLOQUE 5: FILTRADO DECLARATIVO (procesa y asigna nueva memoria)
//
// MODIFICACIÓN GUIADA M2 (cambiar categoría del filtro):
//   Antes: prod.categoria === "Informática"
//   Ahora: prod.categoria === "Telefonía"
// El servidor NO ejecuta consulta SQL: todo es memoria + CPU local.
// ============================================================
document.getElementById("btnFiltrar").addEventListener("click", () => {
  if (catalogoProductos.length === 0) {
    salida.textContent = "Primero genera los productos.";
    return;
  }

  salida.textContent = "Filtrando productos de la categoría 'Telefonía'...";

  // ============================================================
  // BREAKPOINT 3 (línea aprox. 207):
  //   Inspecciona `catalogoProductos` (500.000 objetos). Después de
  //   F8 escribe en la consola:
  //     productosFiltrados.length  → nº de registros "Telefonía"
  // ============================================================
  debugger;

  console.time("Tiempo de filtrado (.filter)");

  const productosFiltrados = catalogoProductos.filter(prod => prod.categoria === "Telefonía");

  console.timeEnd("Tiempo de filtrado (.filter)");

  salida.textContent = `Filtrado completado con éxito.\n- Registros encontrados: ${productosFiltrados.length.toLocaleString()}\nEl servidor no ha tenido que ejecutar ninguna consulta SQL ni consumir hilos de procesamiento.`;
});
