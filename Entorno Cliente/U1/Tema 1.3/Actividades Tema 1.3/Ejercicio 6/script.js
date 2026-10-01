// Ejercicio 6 - El document.write() del 1.2·6 dentro de una función

// Tabla de saludos: solo el texto, aquí no hace falta el color.
const saludos = {
  ru: 'Привет!',
  es: '¡Hola!',
  en: 'Hello!'
}

// document.write() tras la carga reabre el flujo y SUSTITUYE todo el contenido
// de la página. Por eso al pulsar, los botones desaparecen.
function saludar(idioma) {
  document.write('<h1>' + saludos[idioma] + '</h1>');
}
