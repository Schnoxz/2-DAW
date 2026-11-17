// --- Carga condicional del polyfill -------------------------------------

// cargarScript(src)
// Añade un <script> al documento y espera a que cargue
function cargarScript(src) {
  // Promise: objeto que avisa cuando termina una tarea asíncrona
  return new Promise((resolve, reject) => {
    // createElement(): crea un elemento nuevo
    const script = document.createElement("script");
    script.src = src;
    // onload: se ejecuta al cargar; onerror: si falla la carga
    script.onload = () => resolve(src);
    script.onerror = () => reject(new Error("No se pudo cargar " + src));
    // appendChild(): inserta el elemento dentro de <head>
    document.head.appendChild(script);
  });
}

// cargarTemporal()
// Usa el Temporal nativo o carga el polyfill; devuelve el origen usado
async function cargarTemporal() {
  // globalThis: el objeto global (window en el navegador)
  if ("Temporal" in globalThis) {
    return "nativo";
  }

  // await: espera a que termine la promesa antes de seguir
  try {
    // Primero el polyfill local (funciona sin conexión)
    await cargarScript("vendor/temporal-polyfill.global.min.js");
    return "polyfill local";
  } catch (errorLocal) {
    // Si falla el local, se prueba la CDN
    await cargarScript("https://cdn.jsdelivr.net/npm/temporal-polyfill@1.0.8/full/global.min.js");
    return "polyfill desde la CDN";
  }
}

// --- Utilidades de formato ----------------------------------------------

// textoDuracion(duracion)
// Pasa una Duration a texto: "X meses y Y días"
function textoDuracion(duracion) {
  // sign: -1 si la duración es negativa; Math.abs(): quita el signo
  const signo = duracion.sign < 0 ? "hace " : "";
  return `${signo}${Math.abs(duracion.months)} meses y ${Math.abs(duracion.days)} días`;
}

// fechaLarga(fecha)
// Fecha en español, por ejemplo "martes, 15 de junio de 2027"
function fechaLarga(fecha) {
  // toLocaleString("es-ES", opciones): fecha escrita en español
  return fecha.toLocaleString("es-ES", {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  });
}

// --- Actividad ----------------------------------------------------------

// calcularPlazos()
// Crea las fechas del calendario y comprueba que la original no cambia
function calcularPlazos() {
  // PlainDate.from(): fecha sin hora ni zona. El mes empieza en 1 (junio = 6)
  const publicacionNotas = Temporal.PlainDate.from("2027-06-15");

  // add(): suma una duración y devuelve una fecha nueva
  const finAlegaciones = publicacionNotas.add({ days: 3 });

  // Resolución: dos semanas después del cierre
  const resolucionDefinitiva = finAlegaciones.add({ weeks: 2 });

  // La fecha de partida tiene que seguir siendo la misma
  const sigueIgual = publicacionNotas.toString() === "2027-06-15";

  return { publicacionNotas, finAlegaciones, resolucionDefinitiva, sigueIgual };
}

// pintarPlazos(plazos)
// Rellena la tabla de hitos y la prueba de inmutabilidad
function pintarPlazos(plazos) {
  const filas = [
    ["Publicación de notas", "Temporal.PlainDate.from(\"2027-06-15\")", plazos.publicacionNotas],
    ["Fin de alegaciones", "publicacionNotas.add({ days: 3 })", plazos.finAlegaciones],
    ["Resolución definitiva", "finAlegaciones.add({ weeks: 2 })", plazos.resolucionDefinitiva],
  ];

  const cuerpo = document.getElementById("filas-plazos");
  // textContent = "": vacía el contenido anterior
  cuerpo.textContent = "";

  // Una fila por hito, con su cálculo y su fecha
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
// Mide lo que queda desde hoy hasta la publicación
function pintarCuentaAtras(publicacionNotas) {
  // Now.plainDateISO(): la fecha de hoy, sin hora
  const hoy = Temporal.Now.plainDateISO();

  // until(): diferencia entre dos fechas. largestUnit "months" la da en meses
  // y días en vez de solo en días
  const restante = hoy.until(publicacionNotas, { largestUnit: "months" });

  const salida = document.getElementById("salida-cuenta-atras");
  salida.textContent =
    `Hoy: ${hoy.toString()} (${fechaLarga(hoy)})\n` +
    `Inicio de alegaciones: ${publicacionNotas.toString()}\n` +
    `Duración ISO: ${restante.toString()}\n` +
    `Quedan ${textoDuracion(restante)} (signo: ${restante.sign})`;
}

// pintarTokio()
// Muestra la misma apertura en la zona horaria de Tokio
function pintarTokio() {
  // ZonedDateTime.from(): fecha, hora y zona horaria a la vez
  const aperturaMadrid = Temporal.ZonedDateTime.from({
    timeZone: "Europe/Madrid",
    year: 2027,
    month: 6,
    day: 15,
    hour: 9,
    minute: 0,
    second: 0,
  });

  // withTimeZone(): cambia la zona, no el instante
  const aperturaTokio = aperturaMadrid.withTimeZone("Asia/Tokyo");

  const salida = document.getElementById("salida-tokio");
  salida.textContent =
    `Madrid: ${aperturaMadrid.toString()}\n` +
    `Tokio:  ${aperturaTokio.toString()}\n` +
    `Desfase de Madrid: ${aperturaMadrid.offset}\n` +
    `Desfase de Tokio:  ${aperturaTokio.offset}`;
}

// pintarCambioDeHora()
// Suma dos minutos justo antes del cambio al horario de verano de 2027
function pintarCambioDeHora() {
  // El último domingo de marzo de 2027 es el 28: a las 02:00 pasan a las 03:00
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
// Compara la mutación de Date con la inmutabilidad de Temporal
function pintarComparacionDate() {
  // new Date(): objeto de fecha clásico; setDate(): cambia el día del propio objeto
  const fechaDate = new Date("2027-06-15T00:00:00");
  fechaDate.setDate(20);

  // with(): devuelve una copia con el día cambiado y deja intacta la original
  const fechaTemporal = Temporal.PlainDate.from("2027-06-15");
  const nuevaFecha = fechaTemporal.with({ day: 20 });

  // getDate(): devuelve el día del mes
  document.getElementById("salida-date").textContent =
    `Date: después de setDate(20) la variable vale día ${fechaDate.getDate()}\n` +
    `Temporal: fechaTemporal.day = ${fechaTemporal.day} y nuevaFecha.day = ${nuevaFecha.day}`;
}

// arrancar()
// Carga Temporal si hace falta y pinta todas las secciones
async function arrancar() {
  const origen = await cargarTemporal();

  document.getElementById("origen-temporal").textContent = origen;

  // Aviso solo si se ha tenido que usar el polyfill
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

// catch(): recoge el error si la promesa de arrancar() falla
arrancar().catch((error) => {
  document.getElementById("origen-temporal").textContent = "no disponible";
  document.getElementById("aviso-polyfill").textContent =
    "No se ha podido cargar Temporal: " + error.message;
});
