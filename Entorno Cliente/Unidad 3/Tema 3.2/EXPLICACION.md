# Tema 3.2 · Cómo está resuelto

## De qué va

El tema es el **BOM** (*Browser Object Model*): el conjunto de objetos que el
navegador pone a disposición del script. `window` manda sobre todo lo demás, y de
él cuelgan `navigator`, `location`, `history`, `screen` y `document`.

Son cinco actividades que se resuelven leyendo esos objetos, salvo la última, que
usa la API de historial.

## Qué pide el enunciado

1. **3.2.1** · Recoger información del entorno (idioma, conexión, ventana,
   pantalla) y mostrarla.
2. **3.2.2** · Analizar la URL de la propia página y separar sus partes.
3. **3.2.3** · Un monitor que detecte si hay conexión y lo anote con la hora.
4. **3.2.4** · Un test de cuatro preguntas sobre el BOM.
5. **3.2.5** · Un enrutador SPA con `pushState`, `replaceState` y `popstate`.

## Paso a paso

### 3.2.1 · Auditar el entorno

Se leen cuatro cosas al pulsar el botón:

| Dato | Propiedad |
|---|---|
| Idioma | `navigator.language` |
| Conexión | `navigator.onLine` |
| Tamaño de la ventana | `window.innerWidth` / `innerHeight` |
| Pantalla | `screen.width`, `screen.height`, `screen.availWidth`, `colorDepth` |

La diferencia que importa es `innerWidth` frente a `screen.width`: el primero es
el hueco donde se dibuja la página (sin barras del navegador), el segundo es el
monitor entero. `availWidth` es el ancho útil, ya descontada la barra de tareas.

Las filas se construyen así, sin `innerHTML`:

```js
const fila = document.createElement("tr");
const celda = document.createElement("td");
celda.textContent = valor;
fila.appendChild(celda);
```

### 3.2.2 · Analizar la URL

`location` ya trae la dirección troceada, así que no hay que partir cadenas:

```js
location.protocol   // "http:"
location.hostname   // "127.0.0.1"
location.port       // "8131"
location.pathname   // "/index.html"
location.search     // "?curso=2&modulo=dwec"
location.hash       // "#actividad-2"
```

Para los parámetros se usa `URLSearchParams`, que recorre las parejas sin
expresiones regulares:

```js
const parametros = new URLSearchParams(location.search);
parametros.forEach((valor, clave) => { /* ... */ });
```

El segundo botón llama a `location.reload()`, que vuelve a pedir el documento sin
tocar el historial.

### 3.2.3 · Monitor de conectividad

Los dos eventos que hacen falta son `online` y `offline`:

```js
window.addEventListener("online", registrar);
window.addEventListener("offline", registrar);
```

Cada vez que llega uno, se cambia el color del indicador y se apunta una fila con
la hora. Para la hora se usa lo que pide el enunciado:

```js
const ahora = Temporal.Now.zonedDateTimeISO();
```

Como `Temporal` no está en todos los navegadores, se comprueba antes y, si no
existe, se tira de `Date`:

```js
const ahora = typeof Temporal !== "undefined"
  ? Temporal.Now.zonedDateTimeISO().toString()
  : new Date().toLocaleString("es-ES");
```

El botón de emergencia:

```js
location.replace("soporte.html");
```

`replace()` sustituye la entrada actual del historial en lugar de añadir una. Por
eso «Atrás» no vuelve a la página anterior: esa entrada ya no existe.

### 3.2.4 · Autoevaluación

No tiene código especial: se compara la opción marcada con la correcta y se
explica el fallo en vez de dar solo la nota. Las respuestas son **b, b, c, b**.

### 3.2.5 · Enrutador SPA

Una SPA no recarga el documento: cambia la URL y repinta una zona.

```js
history.pushState({ vista: "modulos" }, "", "/modulos");
```

- **`pushState`** añade una entrada al historial (se puede volver con «Atrás»).
- **`replaceState`** sobrescribe la actual (no deja rastro).

Para los filtros se usa `replaceState`, porque cambiar de curso no debería crear
un paso nuevo en el historial:

```js
history.replaceState({ vista: "modulos", curso: 1 }, "", "/modulos?curso=1");
```

Y para volver atrás hay que escuchar el evento:

```js
window.onpopstate = (evento) => actualizarVista(evento.state);
```

Todo va dentro de `try/catch` porque con `file://` el navegador lanza un error de
seguridad al cambiar la URL.

## El código, pieza a pieza

```
index.html               las cinco secciones en una página
soporte.html             página de emergencia de la 3.2.3
css/estilos.css
js/auditoria.js          3.2.1
js/url.js                3.2.2
js/conectividad.js       3.2.3
js/autoevaluacion.js     3.2.4
js/spa.js                3.2.5
```

## Trampas y dudas

- **`location.href` es la URL entera.** Para leer solo una parte están las
  propiedades sueltas.
- **`history.length` no dice dónde estás**, solo cuántas entradas hay.
- **`pushState` no recarga**, así que si el script no repinta la zona, la URL
  cambia y la página no.
- **`replace` frente a `assign`:** `assign` añade una entrada, `replace` la
  sustituye. Es la pregunta 2 del test.
- **`document` cuelga de `window`**, no al revés. El BOM tiene una sola raíz.

## Si me preguntan

- **¿Qué es el BOM?** Todo lo que el navegador da además del documento: ventana,
  historial, pantalla, navegador. No es un estándar formal como el DOM, por eso
  cada navegador añade cosas propias.
- **¿Para qué sirve una SPA?** Para navegar sin recargar: la página no se vuelve a
  descargar y el cambio es inmediato.
- **¿Por qué `Temporal` y no `Date`?** Porque `Date` mezcla fecha, hora y zona en
  un objeto mutable, y aquí solo se quería la hora del evento.
