// js/pacientes.js
// Actividad 3.7.2 · La tabla de pacientes de la 3.5.1, ahora persistente.
// Se ha elegido localStorage porque las citas deben sobrevivir al cierre
// del navegador; sessionStorage las perdería al cerrar la pestaña.

var CLAVE_PACIENTES = "pacientes_clinica";

var dialogo = document.getElementById("modal-paciente");
var formulario = document.getElementById("form-paciente");
var cuerpoPacientes = document.getElementById("cuerpoPacientes");
var visorPacientes = document.getElementById("visorPacientes");

// leerPacientes()
// Devuelve el array guardado o uno vacío si no hay nada válido.
function leerPacientes() {
  var crudo = localStorage.getItem(CLAVE_PACIENTES);
  if (crudo === null) {
    return [];
  }

  try {
    var datos = JSON.parse(crudo);
    return Array.isArray(datos) ? datos : [];
  } catch (error) {
    console.error("Los pacientes guardados no son un JSON válido:", error);
    return [];
  }
}

// guardarPacientes($pacientes)
// Serializa el array completo. No devuelve nada.
function guardarPacientes(pacientes) {
  localStorage.setItem(CLAVE_PACIENTES, JSON.stringify(pacientes));
}

// formatearFecha($iso)
// Convierte 2026-12-01 en 01/12/2026 para la tabla.
function formatearFecha(iso) {
  if (!iso) {
    return "-";
  }
  var partes = iso.split("-");
  if (partes.length !== 3) {
    return iso;
  }
  return partes[2] + "/" + partes[1] + "/" + partes[0];
}

// siguienteId($pacientes)
// Devuelve el mayor ID + 1, para que no se repita al borrar filas.
function siguienteId(pacientes) {
  var maximo = 0;
  for (var i = 0; i < pacientes.length; i++) {
    if (pacientes[i].id > maximo) {
      maximo = pacientes[i].id;
    }
  }
  return maximo + 1;
}

// pintarPacientes()
// Reconstruye el tbody desde localStorage sin usar innerHTML.
// No devuelve nada.
function pintarPacientes() {
  var pacientes = leerPacientes();
  cuerpoPacientes.replaceChildren();

  if (pacientes.length === 0) {
    var filaVacia = document.createElement("tr");
    var celdaVacia = document.createElement("td");
    celdaVacia.colSpan = 4;
    celdaVacia.className = "vacio";
    celdaVacia.textContent = "Todavía no hay pacientes guardados.";
    filaVacia.appendChild(celdaVacia);
    cuerpoPacientes.appendChild(filaVacia);
    return;
  }

  for (var i = 0; i < pacientes.length; i++) {
    var paciente = pacientes[i];
    var fila = document.createElement("tr");

    var celdas = [
      paciente.id,
      paciente.nombre,
      paciente.especialidad,
      formatearFecha(paciente.fecha)
    ];

    for (var j = 0; j < celdas.length; j++) {
      var celda = document.createElement("td");
      celda.textContent = celdas[j];
      fila.appendChild(celda);
    }

    cuerpoPacientes.appendChild(fila);
  }
}

// notificar($texto)
// Usa la Notification API si hay permiso; si no, deja el aviso en el visor.
// No devuelve nada.
function notificar(texto) {
  visorPacientes.textContent = texto;

  if (!("Notification" in window)) {
    return;
  }

  if (Notification.permission === "granted") {
    new Notification("Cita guardada", { body: texto });
    return;
  }

  if (Notification.permission !== "denied") {
    Notification.requestPermission().then(function (permiso) {
      if (permiso === "granted") {
        new Notification("Cita guardada", { body: texto });
      }
    });
  }
}

// abrirModal()
// Abre el diálogo con showModal(), que bloquea el resto de la página.
// No devuelve nada.
function abrirModal() {
  visorPacientes.textContent = "";
  dialogo.showModal();
}

// cancelarModal()
// Cierra el diálogo y limpia el formulario. No devuelve nada.
function cancelarModal() {
  dialogo.close();
  formulario.reset();
}

// guardarPaciente($evento)
// Valida, crea el objeto, lo guarda y repinta la tabla.
// No devuelve nada.
function guardarPaciente(evento) {
  // method="dialog" cerraría el formulario solo; lo controlamos nosotros
  // para validar antes y no cerrar con datos vacíos.
  evento.preventDefault();

  var nombre = document.getElementById("pacienteNombre").value.trim();
  var especialidad = document.getElementById("pacienteEspecialidad").value;
  var fecha = document.getElementById("pacienteFecha").value;

  if (nombre === "") {
    visorPacientes.textContent = "El nombre no puede estar vacío.";
    return;
  }
  if (fecha === "") {
    visorPacientes.textContent = "La fecha de la cita es obligatoria.";
    return;
  }

  var pacientes = leerPacientes();
  pacientes.push({
    id: siguienteId(pacientes),
    nombre: nombre,
    especialidad: especialidad,
    fecha: fecha
  });
  guardarPacientes(pacientes);

  dialogo.close();
  formulario.reset();
  pintarPacientes();
  notificar('Cita guardada para "' + nombre + '".');
}

document.getElementById("btn-abrir-modal").addEventListener("click", abrirModal);
document.getElementById("btnCancelarPaciente").addEventListener("click", cancelarModal);
formulario.addEventListener("submit", guardarPaciente);

// Al cargar se reconstruye la tabla: esto es lo que se ve tras un F5
pintarPacientes();
