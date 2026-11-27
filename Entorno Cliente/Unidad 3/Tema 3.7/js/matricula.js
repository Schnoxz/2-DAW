// js/matricula.js
// Actividad 3.7.6 · Asistente de matrícula en dos pasos con sessionStorage.
// Cada paso guarda un JSON y una clave "matricula_fase" dice por dónde iba.

var CLAVE_PASO1 = "matricula_paso1";
var CLAVE_PASO2 = "matricula_paso2";
var CLAVE_FASE = "matricula_fase";

var paso1 = document.getElementById("paso1");
var paso2 = document.getElementById("paso2");
var resumenFinal = document.getElementById("resumenFinal");
var visorMatricula = document.getElementById("visorMatricula");
var campoNombre = document.getElementById("campoNombre");
var campoDni = document.getElementById("campoDni");
var cuerpoResumen = document.getElementById("cuerpoResumen");

// leerJSON($clave)
// Devuelve el objeto guardado o null si no existe o no es JSON válido.
function leerJSON(clave) {
  var crudo = sessionStorage.getItem(clave);
  if (crudo === null) {
    return null;
  }

  try {
    return JSON.parse(crudo);
  } catch (error) {
    console.error("JSON inválido en " + clave, error);
    return null;
  }
}

// guardarJSON($clave, $valor)
// Serializa un objeto y lo guarda. No devuelve nada.
function guardarJSON(clave, valor) {
  sessionStorage.setItem(clave, JSON.stringify(valor));
}

// avisarMatricula($mensaje)
// Escribe un aviso en el visor del asistente. No devuelve nada.
function avisarMatricula(mensaje) {
  visorMatricula.textContent = mensaje;
}

// mostrarPaso($numero)
// Enseña un paso y esconde el otro y el resumen. No devuelve nada.
function mostrarPaso(numero) {
  paso1.hidden = numero !== 1;
  paso2.hidden = numero !== 2;
  resumenFinal.hidden = true;
  visorMatricula.textContent = "";
}

// rellenarPaso1($datos)
// Vuelca los datos guardados en los campos. No devuelve nada.
function rellenarPaso1(datos) {
  if (datos === null) {
    return;
  }
  campoNombre.value = datos.nombre || "";
  campoDni.value = datos.dni || "";
}

// modulosSeleccionados()
// Devuelve un array con los valores de los checkboxes marcados.
function modulosSeleccionados() {
  var marcados = document.querySelectorAll('input[name="modulo"]:checked');
  var lista = [];

  for (var i = 0; i < marcados.length; i++) {
    lista.push(marcados[i].value);
  }

  return lista;
}

// marcarModulos($lista)
// Marca los checkboxes que vengan en el array. No devuelve nada.
function marcarModulos(lista) {
  var casillas = document.querySelectorAll('input[name="modulo"]');

  for (var i = 0; i < casillas.length; i++) {
    casillas[i].checked = lista.indexOf(casillas[i].value) !== -1;
  }
}

// guardarPaso2()
// Guarda la selección actual de módulos. No devuelve nada.
function guardarPaso2() {
  guardarJSON(CLAVE_PASO2, { modulos: modulosSeleccionados() });
}

// irAlPaso2()
// Valida el paso 1, lo guarda y pasa a la selección de módulos.
// No devuelve nada.
function irAlPaso2() {
  var nombre = campoNombre.value.trim();
  var dni = campoDni.value.trim();

  if (nombre === "" || dni === "") {
    avisarMatricula("Nombre y DNI son obligatorios para continuar.");
    return;
  }

  guardarJSON(CLAVE_PASO1, { nombre: nombre, dni: dni });
  sessionStorage.setItem(CLAVE_FASE, "2");

  var guardado = leerJSON(CLAVE_PASO2);
  if (guardado !== null && Array.isArray(guardado.modulos)) {
    marcarModulos(guardado.modulos);
  }

  mostrarPaso(2);
}

// volverAlPaso1()
// Guarda la selección, vuelve atrás y recupera los datos personales.
// No devuelve nada.
function volverAlPaso1() {
  guardarPaso2();
  sessionStorage.setItem(CLAVE_FASE, "1");
  rellenarPaso1(leerJSON(CLAVE_PASO1));
  mostrarPaso(1);
}

// confirmarMatricula()
// Recupera los dos pasos, pinta el resumen y vacía el sessionStorage.
// No devuelve nada.
function confirmarMatricula() {
  guardarPaso2();

  var datos1 = leerJSON(CLAVE_PASO1);
  var datos2 = leerJSON(CLAVE_PASO2);
  var modulos = datos2 !== null && Array.isArray(datos2.modulos) ? datos2.modulos : [];

  if (datos1 === null) {
    avisarMatricula("Se han perdido los datos del primer paso. Vuelve a empezar.");
    return;
  }
  if (modulos.length === 0) {
    avisarMatricula("Marca al menos un módulo antes de confirmar.");
    return;
  }

  cuerpoResumen.replaceChildren();

  var lineas = [
    "Nombre: " + datos1.nombre,
    "DNI: " + datos1.dni,
    "Módulos: " + modulos.join(", ")
  ];

  for (var i = 0; i < lineas.length; i++) {
    var parrafo = document.createElement("p");
    parrafo.textContent = lineas[i];
    cuerpoResumen.appendChild(parrafo);
  }

  // Se borran las tres claves para que un F5 no restaure nada
  sessionStorage.removeItem(CLAVE_PASO1);
  sessionStorage.removeItem(CLAVE_PASO2);
  sessionStorage.removeItem(CLAVE_FASE);

  paso1.hidden = true;
  paso2.hidden = true;
  resumenFinal.hidden = false;
  visorMatricula.textContent = "";
}

document.getElementById("btnSiguiente").addEventListener("click", irAlPaso2);
document.getElementById("btnAtras").addEventListener("click", volverAlPaso1);
document.getElementById("btnConfirmar").addEventListener("click", confirmarMatricula);

// Cada cambio en las casillas se guarda para sobrevivir a un F5
var casillas = document.querySelectorAll('input[name="modulo"]');
for (var i = 0; i < casillas.length; i++) {
  casillas[i].addEventListener("change", guardarPaso2);
}

// Al cargar: si hay fase guardada, se restaura esa fase con sus datos
var fase = sessionStorage.getItem(CLAVE_FASE);
var datos1 = leerJSON(CLAVE_PASO1);

if (fase === "2" && datos1 !== null) {
  var datos2 = leerJSON(CLAVE_PASO2);
  rellenarPaso1(datos1);
  if (datos2 !== null && Array.isArray(datos2.modulos)) {
    marcarModulos(datos2.modulos);
  }
  mostrarPaso(2);
} else if (fase === "1" && datos1 !== null) {
  rellenarPaso1(datos1);
  mostrarPaso(1);
} else {
  mostrarPaso(1);
}

