// Actividad 3.3.2 - Volver al principio de la página con desplazamiento suave.

document.getElementById("btn-arriba").addEventListener("click", function () {
  // smooth hace que el navegador interpole la posición en vez de saltar de golpe
  window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
});
