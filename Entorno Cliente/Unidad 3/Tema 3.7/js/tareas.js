// js/tareas.js
// Actividad 3.7.3 · Lista de tareas de clase con localStorage.
// La clave guarda un array de cadenas serializado con JSON.stringify().

var CLAVE_TAREAS = "tareas_clase";
var listaTareas = document.getElementById("listaTareasClase");
var contadorTareas = document.getElementById("contadorTareas");
var visorTareas = document.getElementById("visorTareas");

// leerTareas()
// Recupera la cadena de localStorage y la convierte en array.
// Devuelve un array (vacío si no hay nada o si el JSON está corrupto).
function leerTareas() {
  var crudo = localStorage.getItem(CLAVE_TAREAS);

  // getItem devuelve null cuando la clave no existe
  if (crudo === null) {
    return [];
  }

  try {
    var datos = JSON.parse(crudo);
    // Si alguien ha guardado otra cosa, se trata como lista vacía
    if (Array.isArray(datos)) {
      return datos;
    }
    return [];
  } catch (error) {
    console.error("El JSON guardado no es válido:", error);
    return [];
  }
}

// guardarTareas($tareas)
// Serializa el array completo y lo deja en localStorage.
// No devuelve nada.
function guardarTareas(tareas) {
  localStorage.setItem(CLAVE_TAREAS, JSON.stringify(tareas));
}

// pintarTareas()
// Reconstruye la lista del DOM desde localStorage, sin innerHTML.
// No devuelve nada.
function pintarTareas() {
  var tareas = leerTareas();

  // replaceChildren() vacía el contenedor en una sola llamada
  listaTareas.replaceChildren();

  if (tareas.length === 0) {
    var vacia = document.createElement("li");
    vacia.className = "vacia";
    vacia.textContent = "Todavía no hay tareas guardadas.";
    listaTareas.appendChild(vacia);
  } else {
    for (var i = 0; i < tareas.length; i++) {
      var elemento = document.createElement("li");

      // textContent evita que una tarea con etiquetas se interprete como HTML
      var texto = document.createElement("span");
      texto.textContent = tareas[i];

      // Número de orden para que se vea que se conserva el orden del array
      var numero = document.createElement("span");
      numero.className = "nota";
      numero.textContent = i + 1 + ".";

      elemento.appendChild(numero);
      elemento.appendChild(texto);
      listaTareas.appendChild(elemento);
    }
  }

  contadorTareas.textContent = tareas.length + " tarea(s) guardada(s) en localStorage.";
}

// anadirTarea()
// Valida el campo, añade la cadena al array y vuelve a pintar.
// No devuelve nada.
function anadirTarea() {
  var campo = document.getElementById("nuevaTarea");
  var texto = campo.value.trim();

  if (texto === "") {
    visorTareas.textContent = "Escribe algo antes de añadir.";
    visorTareas.classList.add("error");
    return;
  }

  var tareas = leerTareas();
  tareas.push(texto);
  guardarTareas(tareas);

  campo.value = "";
  campo.focus();
  visorTareas.textContent = 'Tarea añadida: "' + texto + '".';
  visorTareas.classList.remove("error");
  pintarTareas();
}

// limpiarTareas()
// Borra la clave de localStorage y deja el contenedor vacío.
// No devuelve nada.
function limpiarTareas() {
  localStorage.removeItem(CLAVE_TAREAS);
  listaTareas.replaceChildren();
  visorTareas.textContent = "Lista borrada de localStorage.";
  visorTareas.classList.remove("error");
  pintarTareas();
}

document.getElementById("btnAnadirTarea").addEventListener("click", anadirTarea);
document.getElementById("btnLimpiarTareas").addEventListener("click", limpiarTareas);

// Enter en el campo equivale a pulsar Añadir
document.getElementById("nuevaTarea").addEventListener("keydown", function (evento) {
  if (evento.key === "Enter") {
    anadirTarea();
  }
});

// Al cargar se reconstruye la lista: esto es lo que se ve tras un F5
pintarTareas();
