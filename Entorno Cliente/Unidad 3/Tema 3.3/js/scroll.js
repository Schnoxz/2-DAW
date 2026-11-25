// Actividad 3.3.2 - Volver al principio de la página con desplazamiento suave.

const salida = document.getElementById("salida-scroll");

document.getElementById("btn-arriba").addEventListener("click", function () {
  // Se guarda la posición antes de mover para poder mostrarla después
  const desde = Math.round(window.scrollY);

  // smooth hace que el navegador interpole la posición en vez de saltar
  window.scrollTo({ top: 0, left: 0, behavior: "smooth" });

  salida.textContent = "Desplazamiento desde " + desde + " px hasta arriba.";
});
