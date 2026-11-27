// js/cookies.js
// Actividad 3.7.1 · Comprobar la biblioteca utilidades-cookies.js.
// Las tres funciones se cargan antes que este archivo desde el HTML.

var visorCookies = document.getElementById("visorCookies");
var todasLasCookies = document.getElementById("todasLasCookies");

// mostrarTodas()
// Pinta document.cookie tal cual. Así se ve que el navegador devuelve solo
// los pares clave=valor, sin path, max-age ni SameSite.
// No devuelve nada: escribe en la página.
function mostrarTodas() {
  if (document.cookie === "") {
    todasLasCookies.textContent = "No hay ninguna cookie visible.";
    return;
  }
  todasLasCookies.textContent = document.cookie;
}

// avisar($mensaje, $esError)
// Sustituye el texto del visor y cambia el color si es un aviso de error.
// No devuelve nada.
function avisar(mensaje, esError) {
  visorCookies.textContent = mensaje;
  if (esError) {
    visorCookies.classList.add("error");
  } else {
    visorCookies.classList.remove("error");
  }
}

// guardarDesdeFormulario()
// Lee los campos, valida lo mínimo y crea la cookie con setCookie().
// No devuelve nada: actualiza el visor.
function guardarDesdeFormulario() {
  var nombre = document.getElementById("nombreCookie").value.trim();
  var valor = document.getElementById("valorCookie").value;
  var dias = parseInt(document.getElementById("diasCookie").value, 10);

  if (nombre === "") {
    avisar("El nombre no puede estar vacío.", true);
    return;
  }
  if (isNaN(dias) || dias <= 0) {
    avisar("Los días tienen que ser un número mayor que cero.", true);
    return;
  }

  setCookie(nombre, valor, dias, "/");
  avisar('Cookie "' + nombre + '" guardada durante ' + dias + " días.");
  mostrarTodas();
}

// leerDesdeFormulario()
// Busca la cookie por su nombre y muestra el valor o el literal null.
// No devuelve nada.
function leerDesdeFormulario() {
  var nombre = document.getElementById("nombreCookie").value.trim();

  if (nombre === "") {
    avisar("Escribe un nombre para poder buscarlo.", true);
    return;
  }

  var valor = getCookie(nombre);
  if (valor === null) {
    avisar('La cookie "' + nombre + '" no existe: getCookie() devuelve null.');
  } else {
    avisar('Valor de "' + nombre + '": ' + valor);
  }

  // Refresca la caja inferior para que no se quede con el valor de la carga
  mostrarTodas();
}

// borrarDesdeFormulario()
// Anula la cookie con max-age=0 usando el mismo path de creación.
// No devuelve nada.
function borrarDesdeFormulario() {
  var nombre = document.getElementById("nombreCookie").value.trim();

  if (nombre === "") {
    avisar("Escribe un nombre para poder borrarlo.", true);
    return;
  }

  deleteCookie(nombre, "/");
  avisar('Cookie "' + nombre + '" borrada con max-age=0.');
  mostrarTodas();
}

document.getElementById("btnGuardarCookie").addEventListener("click", guardarDesdeFormulario);
document.getElementById("btnLeerCookie").addEventListener("click", leerDesdeFormulario);
document.getElementById("btnBorrarCookie").addEventListener("click", borrarDesdeFormulario);

// Al cargar la página se enseña lo que ya haya guardado
mostrarTodas();
