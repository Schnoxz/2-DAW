// Ejercicio 1 - Los dos botones del 1.2·1, cada uno en su función

// Cambia el contenido del párrafo.
function cambiarParrafo() {
  document.getElementById('prueba').innerHTML = 'CAMBIANDO el contenido!';
  console.log('[Ej1] Párrafo actualizado');
}

// Cambia el texto del encabezado h1.
function cambiarTitulo() {
  document.getElementById('titulo').innerHTML = '¡TÍTULO cambiado!';
  console.log('[Ej1] Encabezado actualizado');
}
