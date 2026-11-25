# Tema 3.1.1 · Cómo está resuelto

## De qué va

La actividad es sobre `Temporal`, la API que va a sustituir a `Date`. Se trata de
montar un «gestor de plazos de matrícula» y, de paso, demostrar tres cosas que
`Date` hace mal: mutabilidad, zonas horarias y cambios de hora.

## Qué pide el enunciado

Una única actividad, la **3.1.8**, con cuatro partes:

1. Crear fechas base con `Temporal.PlainDate`.
2. Calcular plazos con `.add()` y comprobar que la fecha original **no cambia**.
3. Hacer una cuenta atrás con `Temporal.Now.plainDateISO()` y `.until()`.
4. Proyectar la misma hora de Madrid a Tokio con `.withTimeZone()`.

Además hay que resolver el problema de que `Temporal` todavía no está en todos los
navegadores, sin romper la página en los que sí lo tienen.

## Paso a paso

### 1. Cargar `Temporal` solo si hace falta

`Temporal` es nuevo. Si el navegador lo trae, se usa; si no, hay que cargar un
*polyfill* (una librería que lo imita). Lo primero es comprobarlo:

```js
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
```

Y `cargarScript()` devuelve una promesa que se resuelve cuando el `<script>` ha
terminado de cargar:

```js
function cargarScript(src) {
  return new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src = src;
    script.onload = () => resolve(src);
    script.onerror = () => reject(new Error("No se pudo cargar " + src));
    document.head.appendChild(script);
  });
}
```

Sin la promesa no se sabría cuándo está listo el polyfill, y el resto del código
podría ejecutarse antes de que `Temporal` exista. La copia local va primero para
que funcione sin conexión; la CDN es el plan B.

### 2. Las fechas y los plazos

```js
const publicacionNotas = Temporal.PlainDate.from("2027-06-15");
const finAlegaciones = publicacionNotas.add({ days: 3 });
const resolucionDefinitiva = finAlegaciones.add({ weeks: 2 });
```

`PlainDate` es una fecha sin hora ni zona. El mes empieza en **1** (junio es 6),
al contrario que en `Date`, donde enero es 0.

La prueba de que no muta:

```js
const sigueIgual = publicacionNotas.toString() === "2027-06-15";
```

`.add()` devuelve una fecha **nueva**. `publicacionNotas` sigue siendo la del 15.

### 3. La cuenta atrás

```js
const hoy = Temporal.Now.plainDateISO();
const restante = hoy.until(publicacionNotas, { largestUnit: "months" });
```

`.until()` devuelve una `Duration`. Con `largestUnit: "months"` la expresa en
meses y días en vez de en un montón de días sueltos, que es como se lee un plazo
administrativo. `duracion.sign` dice si es futura (1) o pasada (-1).

### 4. Madrid y Tokio

```js
const aperturaMadrid = Temporal.ZonedDateTime.from({
  timeZone: "Europe/Madrid",
  year: 2027, month: 6, day: 15, hour: 9, minute: 0, second: 0,
});

const aperturaTokio = aperturaMadrid.withTimeZone("Asia/Tokyo");
```

`withTimeZone()` cambia la zona **sin cambiar el instante**: es la misma hora
universal, escrita en otro reloj. Por eso en Tokio salen las 16:00 del mismo día.

### 5. El cambio de hora

```js
const antesDelCambio = Temporal.ZonedDateTime.from({
  timeZone: "Europe/Madrid",
  year: 2027, month: 3, day: 28, hour: 1, minute: 59,
});

const despuesDelCambio = antesDelCambio.add({ minutes: 2 });
```

El último domingo de marzo de 2027 es el 28. A las 02:00 se pasa a las 03:00, así
que sumar dos minutos a las 01:59 da **03:01**, no 02:01. `Temporal` lo resuelve
solo; con `Date` habría que compensar el desfase a mano.

### 6. La comparación con `Date`

```js
const fechaDate = new Date("2027-06-15T00:00:00");
fechaDate.setDate(20);              // muta: la variable ya no vale 15

const fechaTemporal = Temporal.PlainDate.from("2027-06-15");
const nuevaFecha = fechaTemporal.with({ day: 20 });   // devuelve copia
```

Es el argumento principal del tema: `Date.setDate()` cambia el objeto que ya
tenías; `Temporal.with()` devuelve otro y deja el original intacto.

## El código, pieza a pieza

| Archivo | Qué hace |
|---|---|
| `index.html` | cuatro secciones: plazos, cuenta atrás, Tokio y cambio de hora |
| `js/plazos.js` | toda la lógica de `Temporal` y el pintado |
| `vendor/temporal-polyfill.global.min.js` | copia local del polyfill (MIT) |
| `estilos.css` | estilos de la página |

## Trampas y dudas

- **El mes empieza en 1.** En `Date` enero es 0; en `Temporal` es 1. Es el fallo
  más típico al pasar de uno a otro.
- **El polyfill es una librería grande.** Solo se carga si el navegador no trae
  `Temporal`, y se avisa en pantalla de que se está usando.
- **`add()` devuelve otro objeto.** Si se hace `fecha.add({days: 3})` sin guardar el
  resultado, no pasa nada: la fecha original no se modifica.
- **`withTimeZone` no es «hora local».** Cambia la zona del instante, no lo
  convierte a la hora del usuario.

## Si me preguntan

- **¿Por qué existe `Temporal` si ya está `Date`?** Porque `Date` mezcla fechas,
  horas y zonas en un solo objeto mutable, y no sabe representar «las 9:00 sin
  zona» ni «el 15 de junio sin hora». `Temporal` separa cada cosa en un tipo.
- **¿Qué es un polyfill?** Código que añade al navegador una función que aún no
  tiene, con el mismo nombre y el mismo comportamiento.
- **¿Sirve `withTimeZone` para calcular una reunión?** Sí: se guarda el instante y
  cada persona lo ve en su zona, sin hacer cuentas de diferencias horarias a mano.
