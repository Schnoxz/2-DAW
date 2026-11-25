// Actividad 3.3.3 - Panel de control con classList.
// Se parte del ejemplo del tema y se añaden dos cosas: el estado de error
// y el texto del botón de modo oscuro.

const tarjeta = document.querySelector("#tarjeta");
const btnOscuro = document.querySelector("#btn-oscuro");

// --- A) Modo oscuro con el texto del botón sincronizado ---
btnOscuro.addEventListener("click", function () {
  // toggle ya sabe si la clase estaba o no, así que después se comprueba
  // el resultado con contains para decidir qué texto toca
  document.body.classList.toggle("modo-oscuro");

  if (document.body.classList.contains("modo-oscuro")) {
    btnOscuro.textContent = "Modo Claro";
  } else {
    btnOscuro.textContent = "Modo Oscuro";
  }
});

// --- B) Ocultar y mostrar la tarjeta ---
document.querySelector("#btn-ocultar").addEventListener("click", function () {
  tarjeta.classList.toggle("oculto");
});

// --- C) Pasar a completado ---
document.querySelector("#btn-exito").addEventListener("click", function () {
  // replace cambia un estado por otro sin tocar .caja ni .resaltado
  tarjeta.classList.replace("estado-pendiente", "estado-completado");
  tarjeta.classList.remove("estado-error");
  tarjeta.textContent = "Estado actual: ¡tarea completada!";
});

// --- D) Estado de error, venga de donde venga ---
document.querySelector("#btn-error").addEventListener("click", function () {
  // Se quitan los dos estados posibles antes de poner el de error: si solo
  // se hiciera replace("estado-pendiente", ...), al estar completada no
  // cambiaría nada
  tarjeta.classList.remove("estado-pendiente", "estado-completado");
  tarjeta.classList.add("estado-error");
  tarjeta.textContent = "Estado actual: error, revisa la tarea.";
});

// --- E) Resaltar ---
document.querySelector("#btn-borde").addEventListener("click", function () {
  if (tarjeta.classList.contains("resaltado")) {
    tarjeta.classList.remove("resaltado");
  } else {
    tarjeta.classList.add("resaltado");
  }
});

// --- F) Reiniciar: deja solo las clases iniciales ---
document.querySelector("#btn-reset").addEventListener("click", function () {
  // className sobrescribe todas las clases de golpe, es lo más corto aquí
  tarjeta.className = "caja estado-pendiente";
  tarjeta.textContent = "Estado actual: tarea pendiente de revisión.";
});
