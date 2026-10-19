// Ejercicio 4 - El saludo multidioma del 1.2·4 usando una función

// Tabla de saludos: texto y color CSS para cada idioma.
const saludos = {
  ru: { texto: 'Привет!', color: 'purple' },
  es: { texto: '¡Hola!', color: 'green' },
  en: { texto: 'Hello!', color: 'blue' }
};

// El idioma llega como parámetro, así que la misma función sirve para los tres botones.
function saludar(idioma) {
  const p = document.getElementById('saludo');
  p.innerHTML = saludos[idioma].texto;   // contenido del párrafo
  p.style.color = saludos[idioma].color; // color de fuente en línea
  console.log('[Ej4] Idioma: ' + idioma + ' · saludo: ' + saludos[idioma].texto);
}
