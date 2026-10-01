// Ejercicio 9 - La secuencia de imágenes del 1.2·9 dentro de una función

// Imágenes en formato data: (SVG autocontenido, sin archivos externos).
const colores = ['red', 'green', 'blue', 'orange'];

const imagenes = colores.map(function (color, i) {
  return 'data:image/svg+xml;utf8,' + encodeURIComponent(
    '<svg xmlns="http://www.w3.org/2000/svg" width="240" height="150">' +
    '<rect width="240" height="150" fill="' + color + '"/>' +
    '<text x="120" y="85" font-size="40" fill="white" text-anchor="middle">' + (i + 1) + '</text>' +
    '</svg>'
  );
});

// El índice del fotograma actual.
let indice = 0;

const foto = document.getElementById('foto');
const pie = document.getElementById('pie');

// Primero de la cinta.
function primero() {
  foto.src = imagenes[0];
  pie.innerHTML = 'Fotograma ' + 1 + ' de ' + imagenes.length;
}

// Reasigna .src al siguiente fotograma; el % vuelve al inicio (bucle).
function siguiente() {
  indice = (indice + 1) % imagenes.length;
  foto.src = imagenes[indice];
  pie.innerHTML = 'Fotograma ' + (indice + 1) + ' de ' + imagenes.length;
  console.log('[Ej9] Fotograma ' + (indice + 1) + ' de ' + imagenes.length + ' · índice: ' + indice);
}

// El clic se registra desde el propio script, así el HTML queda limpio.
document.getElementById('foto').addEventListener('click', siguiente);

primero();
