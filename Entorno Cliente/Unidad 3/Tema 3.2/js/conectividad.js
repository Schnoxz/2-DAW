// Actividad 3.2.3 - Monitor de conectividad con window.online y window.offline.

let numeroCortes = 0;

// fechaHoraActual()
// Devuelve la fecha y hora en formato corto español.
// Usa Temporal.Now, que es lo que pide el enunciado para este apartado.
function fechaHoraActual() {
  const ahora = Temporal.Now.zonedDateTimeISO();
  return ahora.toLocaleString("es-ES", { dateStyle: "short", timeStyle: "medium" });
}

// pintarEstado(conectado)
// Cambia el color y el texto del indicador según si hay red o no.
// No devuelve nada: modifica el div de estado.
function pintarEstado(conectado) {
  const caja = document.getElementById("estado-conexion");
  if (conectado) {
    caja.textContent = "Conexión estable";
    caja.className = "estado estado-online";
  } else {
    caja.textContent = "Sin conexión";
    caja.className = "estado estado-offline";
  }
}

// anotarCambio(tipo)
// Añade una fila a la tabla con el tipo de evento y el momento exacto.
// No devuelve nada: escribe en el tbody.
function anotarCambio(tipo) {
  const tabla = document.getElementById("tabla-cortes");

  // La primera vez hay que quitar el aviso de "todavía no hay nada"
  if (numeroCortes === 0) {
    tabla.innerHTML = "";
  }
  numeroCortes++;

  const fila = document.createElement("tr");

  const numero = document.createElement("td");
  numero.textContent = numeroCortes;

  const evento = document.createElement("td");
  evento.textContent = tipo;

  const momento = document.createElement("td");
  momento.textContent = fechaHoraActual();

  fila.appendChild(numero);
  fila.appendChild(evento);
  fila.appendChild(momento);
  tabla.appendChild(fila);
}

// Los dos eventos se disparan solos desde window cuando cambia la red
window.addEventListener("online", function () {
  pintarEstado(true);
  anotarCambio("Vuelve la conexión");
});

window.addEventListener("offline", function () {
  pintarEstado(false);
  anotarCambio("Corte de red");
});

// Al cargar puede que ya estemos sin conexión: se refleja sin esperar al evento
pintarEstado(navigator.onLine);

// replace() sustituye la entrada actual del historial: no se puede volver atrás
document.getElementById("btn-soporte").addEventListener("click", function () {
  location.replace("soporte.html");
});
