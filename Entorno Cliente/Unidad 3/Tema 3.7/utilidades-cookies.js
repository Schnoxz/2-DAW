// utilidades-cookies.js
// Las tres funciones canónicas de la actividad 3.7.1.
// Todo se hace con document.cookie, así que son cookies visibles desde el
// cliente: sirven para preferencias, nunca para guardar un token de sesión.

// setCookie(nombre, valor, diasExpiracion, ruta)
// Escribe una cookie codificando el valor y con max-age calculado en segundos.
// No devuelve nada: modifica document.cookie.
function setCookie(nombre, valor, diasExpiracion, ruta) {
  // Sin codificar, un ";" o un "=" dentro del valor cortarían la cookie
  var valorCodificado = encodeURIComponent(valor);

  // max-age va en segundos: días * 24 horas * 60 minutos * 60 segundos
  var segundos = diasExpiracion * 24 * 60 * 60;

  // Sin path=/ la cookie solo valdría para la carpeta del documento
  var rutaFinal = ruta || "/";

  document.cookie = nombre + "=" + valorCodificado +
    "; max-age=" + segundos + "; path=" + rutaFinal;
}

// getCookie(nombre)
// Recorre document.cookie, que llega como una sola cadena con pares separados
// por ";". Devuelve el valor decodificado o null si la cookie no existe.
function getCookie(nombre) {
  var buscado = encodeURIComponent(nombre) + "=";
  var trozos = document.cookie.split(";");

  for (var i = 0; i < trozos.length; i++) {
    var trozo = trozos[i].trim();

    // indexOf === 0 evita confundir "alumnoActual" con "otroAlumnoActual"
    if (trozo.indexOf(buscado) === 0) {
      return decodeURIComponent(trozo.substring(buscado.length));
    }
  }

  return null;
}

// deleteCookie(nombre, ruta)
// Anula la cookie con max-age=0. El path tiene que coincidir con el de
// creación o el navegador borra otra cookie distinta.
// No devuelve nada: el navegador la purga al recibir la orden.
function deleteCookie(nombre, ruta) {
  var rutaFinal = ruta || "/";
  document.cookie = encodeURIComponent(nombre) + "=; max-age=0; path=" + rutaFinal;
}
