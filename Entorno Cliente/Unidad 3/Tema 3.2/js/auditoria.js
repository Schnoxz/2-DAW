// Actividad 3.2.1 - Auditoría del entorno del cliente.
// Todos los datos salen del BOM: window, navigator y screen.

// crearFila(etiqueta, valor)
// Devuelve un div con la etiqueta y el valor ya separados por CSS.
// No escribe en la página: quien llama decide dónde meterlo.
function crearFila(etiqueta, valor) {
  const fila = document.createElement("div");
  fila.className = "resultado";

  const nombre = document.createElement("span");
  nombre.textContent = etiqueta;

  const dato = document.createElement("span");
  dato.textContent = valor;

  fila.appendChild(nombre);
  fila.appendChild(dato);
  return fila;
}

// auditarEntorno()
// Lee idioma, conexión, tamaño del viewport y resolución del monitor.
// No devuelve nada: pinta las filas dentro del visor.
function auditarEntorno() {
  const visor = document.getElementById("salida-auditoria");
  visor.innerHTML = "";

  // navigator.language da el idioma configurado, no el del documento
  visor.appendChild(crearFila("Idioma del navegador", navigator.language));

  // onLine indica si hay red, aunque no garantiza que haya internet real
  const conexion = navigator.onLine ? "Sí, conectado" : "No, sin conexión";
  visor.appendChild(crearFila("Conectado a internet", conexion));

  // innerWidth/innerHeight miden la zona útil donde se dibuja la web
  visor.appendChild(crearFila("Ventana interior", window.innerWidth + " x " + window.innerHeight + " px"));

  // screen.width/height son del monitor, no del navegador
  visor.appendChild(crearFila("Resolución del monitor", screen.width + " x " + screen.height + " px"));

  // availWidth descuenta la barra de tareas del sistema operativo
  visor.appendChild(crearFila("Espacio disponible en pantalla", screen.availWidth + " x " + screen.availHeight + " px"));

  // Los dos valores casi nunca coinciden: uno es el navegador y otro el monitor
  visor.appendChild(crearFila("Profundidad de color", screen.colorDepth + " bits"));

  // transition:orientation no existe en todos los navegadores, de ahí el ?.
  visor.appendChild(crearFila("Orientación de pantalla", screen.orientation ? screen.orientation.type : "No disponible"));
}

document.getElementById("btn-auditar").addEventListener("click", auditarEntorno);
