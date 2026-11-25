// Actividad 3.2.5 - Enrutador SPA con la API de historial.
// No se carga ninguna página nueva: solo cambia la URL y el contenido de <main>.

const vistas = {
  inicio: "<h3>Inicio</h3><p>Bienvenido al portal del ciclo DAW. Usa los botones de arriba para navegar sin recargar la página.</p>",
  modulos: {
    todos: "<h3>Módulos DAW</h3><p>Listado completo, sin filtrar por curso.</p><ul><li>Programación</li><li>Bases de Datos</li><li>Lenguajes de Marcas</li><li>Sistemas Informáticos</li><li>DWEC</li><li>DWES</li><li>DIW</li><li>Despliegue</li></ul>",
    primero: "<h3>Módulos DAW · 1º Curso <span class='filtro-activo'>filtro activo</span></h3><ul><li>Programación</li><li>Bases de Datos</li><li>Lenguajes de Marcas</li><li>Sistemas Informáticos</li></ul>",
    segundo: "<h3>Módulos DAW · 2º Curso <span class='filtro-activo'>filtro activo</span></h3><ul><li>DWEC</li><li>DWES</li><li>DIW</li><li>Despliegue</li></ul>"
  },
  contacto: "<h3>Contacto</h3><p>Departamento de Informática · I.E.S. Kursaal<br>Correo: informatica@ejemplo.es</p>"
};

// pintar(html)
// Mete el HTML recibido dentro del contenedor de vistas.
// No devuelve nada: sustituye el contenido anterior.
function pintar(html) {
  document.getElementById("contenedor-vista").innerHTML = html;
}

// actualizarVista(estado)
// Decide qué sección toca pintar a partir del objeto de estado.
// Si no hay estado o no trae sección, se queda en inicio.
function actualizarVista(estado) {
  if (!estado || !estado.seccion) {
    pintar(vistas.inicio);
    return;
  }

  if (estado.seccion === "modulos") {
    // El filtro es opcional: si no viene, se muestran todos los módulos
    if (estado.filtro === "primero") {
      pintar(vistas.modulos.primero);
    } else if (estado.filtro === "segundo") {
      pintar(vistas.modulos.segundo);
    } else {
      pintar(vistas.modulos.todos);
    }
    return;
  }

  if (estado.seccion === "contacto") {
    pintar(vistas.contacto);
    return;
  }

  // Cualquier sección desconocida cae en inicio en vez de dejar la vista vacía
  pintar(vistas.inicio);
}

// navegar(seccion, url)
// Crea una entrada nueva en el historial y pinta la sección pedida.
// El try/catch es por si el archivo se abre con file://, donde pushState
// no puede cambiar la ruta y lanza un error de seguridad.
function navegar(seccion, url) {
  const estado = { seccion: seccion };
  try {
    history.pushState(estado, "", url);
  } catch (e) {
    console.warn("No se pudo cambiar la URL (¿file://?):", e.message);
  }
  actualizarVista(estado);
}

document.getElementById("btn-inicio").addEventListener("click", function () {
  navegar("inicio", "/inicio");
});

document.getElementById("btn-modulos").addEventListener("click", function () {
  navegar("modulos", "/modulos");
});

document.getElementById("btn-contacto").addEventListener("click", function () {
  navegar("contacto", "/contacto");
});

// Los filtros no crean una entrada nueva: replaceState sobrescribe la actual.
// Así, varias pulsaciones seguidas no llenan el historial de pasos intermedios.
function filtrar(nombreFiltro, curso) {
  const estado = { seccion: "modulos", filtro: nombreFiltro };
  try {
    history.replaceState(estado, "", "/modulos?curso=" + curso);
  } catch (e) {
    console.warn("No se pudo cambiar la URL (¿file://?):", e.message);
  }
  actualizarVista(estado);
}

document.getElementById("btn-filtro-1").addEventListener("click", function () {
  filtrar("primero", 1);
});

document.getElementById("btn-filtro-2").addEventListener("click", function () {
  filtrar("segundo", 2);
});

// Al pulsar Atrás/Adelante el navegador devuelve el estado guardado
window.addEventListener("popstate", function (evento) {
  actualizarVista(evento.state);
});

// Al arrancar se respeta el estado del historial, si lo hay
actualizarVista(history.state);
