// Ejercicio 5 - El saludo del 1.2·5 con funciones, solo por consola

// Tabla de saludos: texto y color CSS para cada idioma.
const saludos = {
  ru: { texto: 'Привет!', color: 'purple' },
  es: { texto: '¡Hola!', color: 'green' },
  en: { texto: 'Hello!', color: 'blue' }
}

// Esta versión no toca el DOM: solo escribe en la consola del desarrollador.
function saludar(idioma) {
  const s = saludos[idioma];
  console.log(s.texto + ' (color sugerido: ' + s.color + ')');
}
