// --- Carga condicional del polyfill -------------------------------------

// cargarScript(src)
// Crea un <script> en el documento y espera a que termine de cargar.
// Devuelve una Promise con la ruta; se rechaza si el archivo falla.
function cargarScript(src) {
  return new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src = src;
    script.onload = () => resolve(src);
    script.onerror = () => reject(new Error("No se pudo cargar " + src));
    document.head.appendChild(script);
  });
}

// cargarTemporal()
// Comprueba si el navegador trae Temporal de serie. Si no lo trae, carga el
// polyfill local y, si tampoco está, el de la CDN.
// Devuelve un String con el origen que se ha usado.
async function cargarTemporal() {
  if ("Temporal" in globalThis) {
    return "nativo";
  }

  try {
    await cargarScript("vendor/temporal-polyfill.global.min.js");
    return "polyfill local";
  } catch (errorLocal) {
    await cargarScript("https://cdn.jsdelivr.net/npm/temporal-polyfill@1.0.8/full/global.min.js");
    return "polyfill desde la CDN";
  }
}

// --- Utilidades de formato ----------------------------------------------

// textoDuracion(duracion)
// Convierte un Temporal.Duration en "X meses y Y días". Si la duración es
// negativa, lo indica delante. Devuelve un String.
function textoDuracion(duracion) {
  const signo = duracion.sign < 0 ? "hace " : "";
  return `${signo}${Math.abs(duracion.months)} meses y ${Math.abs(duracion.days)} días`;
}

// fechaLarga(fecha)
// Pasa una Temporal.PlainDate a texto en español ("martes, 15 de junio de 2027").
// Devuelve un String.
function fechaLarga(fecha) {
  return fecha.toLocaleString("es-ES", {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  });
}

// --- Actividad ----------------------------------------------------------

// calcularPlazos()
// Crea las tres fechas del calendario de matrícula y comprueba que la fecha
// de publicación no ha cambiado. Devuelve un objeto con las fechas y la prueba.
function calcularPlazos() {
  // 1. Fecha base: PlainDate no tiene hora ni zona, que es lo que necesita un
  // calendario escolar. El mes de Temporal empieza en 1 (junio es 6)
  const publicacionNotas = Temporal.PlainDate.from("2027-06-15");

  // 2. Alegaciones: 3 días naturales. add() devuelve una fecha nueva
  const finAlegaciones = publicacionNotas.add({ days: 3 });

  // La resolución sale dos semanas después del cierre: 14 días
  const resolucionDefinitiva = finAlegaciones.add({ weeks: 2 });

  // La fecha de partida tiene que seguir siendo la misma
  const sigueIgual = publicacionNotas.toString() === "2027-06-15";

  return { publicacionNotas, finAlegaciones, resolucionDefinitiva, sigueIgual };
}

// pintarPlazos(plazos)
// Rellena la tabla de hitos y el bloque de la prueba de inmutabilidad.
// No devuelve nada: escribe en la página.
function pintarPlazos(plazos) {
  const filas = [
    ["Publicación de notas", "Temporal.PlainDate.from(\"2027-06-15\")", plazos.publicacionNotas],
    ["Fin de alegaciones", "publicacionNotas.add({ days: 3 })", plazos.finAlegaciones],
    ["Resolución definitiva", "finAlegaciones.add({ weeks: 2 })", plazos.resolucionDefinitiva],
  ];

  const cuerpo = document.getElementById("filas-plazos");
  cuerpo.textContent = "";

  for (const [hito, calculo, fecha] of filas) {
    const fila = document.createElement("tr");
    for (const texto of [hito, calculo, fecha.toString()]) {
      const celda = document.createElement("td");
      celda.textContent = texto;
      fila.appendChild(celda);
    }
    cuerpo.appendChild(fila);
  }

  const prueba = document.getElementById("prueba-inmutabilidad");
  prueba.textContent =
    `publicacionNotas.toString() = "${plazos.publicacionNotas.toString()}"\n` +
    `prueba === "2027-06-15"  ->  ${plazos.sigueIgual}\n` +
    `finAlegaciones = ${plazos.finAlegaciones.toString()} (${fechaLarga(plazos.finAlegaciones)})\n` +
    `resolucionDefinitiva = ${plazos.resolucionDefinitiva.toString()}\n`;
}

// pintarCuentaAtras(publicacionNotas)
// Mide el tiempo que queda desde hoy hasta la publicación de notas.
// No devuelve nada: escribe en la página.
function pintarCuentaAtras(publicacionNotas) {
  // Fecha del dispositivo, sin hora: el "hoy" del alumno
  const hoy = Temporal.Now.plainDateISO();

  // largestUnit "months" hace que la duración se desglose en meses y días,
  // en vez de darlo todo en días
  const restante = hoy.until(publicacionNotas, { largestUnit: "months" });

  const salida = document.getElementById("salida-cuenta-atras");
  salida.textContent =
    `Hoy: ${hoy.toString()} (${fechaLarga(hoy)})\n` +
    `Inicio de alegaciones: ${publicacionNotas.toString()}\n` +
    `Duración ISO: ${restante.toString()}\n` +
    `Quedan ${textoDuracion(restante)} (signo: ${restante.sign})`;
}

// pintarTokio()
// Proyecta la apertura de Madrid a Tokio conservando el instante.
// No devuelve nada: escribe en la página.
function pintarTokio() {
  // ZonedDateTime guarda fecha, hora y zona: 09:00 en Madrid es un instante fijo
  const aperturaMadrid = Temporal.ZonedDateTime.from({
    timeZone: "Europe/Madrid",
    year: 2027,
    month: 6,
    day: 15,
    hour: 9,
    minute: 0,
    second: 0,
  });

  // withTimeZone() cambia cómo se muestra ese mismo instante, no la hora
  const aperturaTokio = aperturaMadrid.withTimeZone("Asia/Tokyo");

  const salida = document.getElementById("salida-tokio");
  salida.textContent =
    `Madrid: ${aperturaMadrid.toString()}\n` +
    `Tokio:  ${aperturaTokio.toString()}\n` +
    `Desfase de Madrid: ${aperturaMadrid.offset}\n` +
    `Desfase de Tokio:  ${aperturaTokio.offset}`;
}

// pintarCambioDeHora()
// Suma dos minutos justo antes del cambio al horario de verano de 2027.
// No devuelve nada: escribe en la página.
function pintarCambioDeHora() {
  // El último domingo de marzo de 2027 es el día 28: a las 02:00 se pasa a las 03:00
  const antesDelCambio = Temporal.ZonedDateTime.from({
    timeZone: "Europe/Madrid",
    year: 2027,
    month: 3,
    day: 28,
    hour: 1,
    minute: 59,
  });

  const despuesDelCambio = antesDelCambio.add({ minutes: 2 });

  document.getElementById("salida-dst").textContent =
    `Antes:  ${antesDelCambio.toString()}\n` +
    `Después de sumar 2 minutos: ${despuesDelCambio.toString()}\n` +
    `El reloj salta de 01:59 a 03:01 y el desfase pasa de +01:00 a +02:00.`;
}

// pintarComparacionDate()
// Enseña la mutación de Date frente a la inmutabilidad de Temporal.
// No devuelve nada: escribe en la página.
function pintarComparacionDate() {
  // Con Date, setDate() modifica el propio objeto
  const fechaDate = new Date("2027-06-15T00:00:00");
  fechaDate.setDate(20);

  // Con Temporal, with() devuelve otra instancia y deja intacta la original
  const fechaTemporal = Temporal.PlainDate.from("2027-06-15");
  const nuevaFecha = fechaTemporal.with({ day: 20 });

  document.getElementById("salida-date").textContent =
    `Date: después de setDate(20) la variable vale día ${fechaDate.getDate()}\n` +
    `Temporal: fechaTemporal.day = ${fechaTemporal.day} y nuevaFecha.day = ${nuevaFecha.day}`;
}

// arrancar()
// Carga Temporal si hace falta y pinta todas las secciones.
// No devuelve nada: escribe en la página.
async function arrancar() {
  const origen = await cargarTemporal();

  document.getElementById("origen-temporal").textContent = origen;

  if (origen !== "nativo") {
    document.getElementById("aviso-polyfill").textContent =
      "Este navegador no trae Temporal de serie: se ha cargado el polyfill. " +
      "En Edge, Chrome y Firefox actuales no hace falta.";
  }

  const plazos = calcularPlazos();
  pintarPlazos(plazos);
  pintarCuentaAtras(plazos.publicacionNotas);
  pintarTokio();
  pintarCambioDeHora();
  pintarComparacionDate();
}

arrancar().catch((error) => {
  // Si ni el polyfill local ni la CDN responden, se avisa en pantalla
  document.getElementById("origen-temporal").textContent = "no disponible";
  document.getElementById("aviso-polyfill").textContent =
    "No se ha podido cargar Temporal: " + error.message;
});
