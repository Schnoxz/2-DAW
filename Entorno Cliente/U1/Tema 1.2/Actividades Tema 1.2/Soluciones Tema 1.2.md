# Ejercicios Tema 1.2 — Navegadores Web: capacidades y mecanismos de ejecución

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Autor: Javier Jiménez Alonso — I.E.S. Kursaal
> Fecha: 22/09/2026
> Base: Actividades Prácticas y de Consolidación del tema 1.2 (sección J del temario)

---

## Estructura de archivos

```
Actividades Tema 1.2\
├── Ejercicio 1\index.html     Segundo botón que modifica el <h1>
├── Ejercicio 2\index.html     Evento clic con console.log()
├── Ejercicio 3\index.html     Modal con window.alert()
├── Ejercicio 4\index.html     Saludo multidioma con color
├── Ejercicio 5\index.html     Saludo multidioma solo por consola
├── Ejercicio 6\index.html     Salida directa con document.write()
├── Ejercicio 7\index.html     Interfaz con tres botones (Consola / Estilo / Alerta)
├── Ejercicio 8\index.html     Test interactivo de Verdadero/Falso
└── Ejercicio 9\index.html     Secuencia cíclica de imágenes
```

Todos los ejercicios se abren directamente en el navegador (doble clic sobre el `index.html`). Para ver las trazas de consola (Ejercicios 2 y 5) hay que abrir **F12 → Console**.

---

## Índice

1. [Ejercicio 1 — Segundo botón que modifica el `<h1>`](#ejercicio-1--segundo-botón-que-modifica-el-h1)
2. [Ejercicio 2 — Evento clic con `console.log()`](#ejercicio-2--evento-clic-con-consolelog)
3. [Ejercicio 3 — Modal con `window.alert()`](#ejercicio-3--modal-con-windowalert)
4. [Ejercicio 4 — Saludo multidioma con color](#ejercicio-4--saludo-multidioma-con-color)
5. [Ejercicio 5 — Saludo multidioma solo por consola](#ejercicio-5--saludo-multidioma-solo-por-consola)
6. [Ejercicio 6 — Salida directa con `document.write()`](#ejercicio-6--salida-directa-con-documentwrite)
7. [Ejercicio 7 — Interfaz con tres botones (Consola / Estilo / Alerta)](#ejercicio-7--interfaz-con-tres-botones-consola--estilo--alerta)
8. [Ejercicio 8 — Test interactivo de Verdadero/Falso](#ejercicio-8--test-interactivo-de-verdadero-falso)
9. [Ejercicio 9 — Secuencia cíclica de imágenes](#ejercicio-9--secuencia-cíclica-de-imágenes)

---

## Ejercicio 1 — Segundo botón que modifica el `<h1>`

**Enunciado:** añadir un segundo botón al ejemplo de los apuntes que, al pulsarlo, no solo altere el párrafo sino que cambie también el texto del encabezado `<h1>` mediante `document.getElementById()` e `innerHTML`.

**Solución** (`Ejercicio 1\index.html`): se mantiene el botón original que modifica `<p id="prueba">` y se añade un segundo botón que modifica `<h1 id="titulo">`. A ambos elementos se les da un `id` para poder localizarlos:

```js
onclick="document.getElementById('prueba').innerHTML = 'CAMBIANDO el contenido!'"
onclick="document.getElementById('titulo').innerHTML = '¡TÍTULO cambiado!'"
```

**Concepto clave:** `document.getElementById()` obtiene el nodo del DOM por su `id` y la propiedad `innerHTML` sustituye su contenido HTML.

---

## Ejercicio 2 — Evento clic con `console.log()`

**Enunciado:** implementar una página que capture el evento `clic` de un botón para emitir una traza informativa mediante `console.log()`.

**Solución** (`Ejercicio 2\index.html`): se usa `addEventListener('click', ...)` en vez de atributo `onclick`, que es la forma recomendada para capturar eventos desacoplada del HTML:

```js
document.getElementById('btn').addEventListener('click', function () {
  console.log('Se ha capturado el evento clic del botón.');
});
```

**Concepto clave:** la traza solo se ve en las devtools (F12 → Console); aporta depuración sin alterar la interfaz.

---

## Ejercicio 3 — Modal con `window.alert()`

**Enunciado:** modificar el ejercicio anterior sustituyendo la salida por ventanas de aviso emergentes **modales** mediante `window.alert()` / `alert()`.

**Solución** (`Ejercicio 3\index.html`):

```js
document.getElementById('btn').addEventListener('click', function () {
  window.alert('Clic capturado: se muestra una ventana emergente modal.');
});
```

**Concepto clave:** `alert()` es un cuadro **modal** — bloquea la interacción con la página hasta que el usuario lo cierra.

---

## Ejercicio 4 — Saludo multidioma con color

**Enunciado:** web con tres botones ("Ruso", "Español", "Inglés") que alteren un `<p>` mostrando un saludo en el idioma elegido y aplicando un color de fuente CSS distinto con `.style.color`.

**Solución** (`Ejercicio 4\index.html`): un objeto asocia cada idioma con su texto y color, y la función `saludar(idioma)` actualiza `innerHTML` y `style.color`:

```js
const saludos = {
  ru: { texto: 'Привет!',    color: 'purple' },
  es: { texto: '¡Hola!',     color: 'green'  },
  en: { texto: 'Hello!',     color: 'blue'   }
};

function saludar(idioma) {
  const p = document.getElementById('saludo');
  p.innerHTML = saludos[idioma].texto;
  p.style.color = saludos[idioma].color;
}
```

**Concepto clave:** `.style.propiedad` permite aplicar estilos CSS en línea desde JavaScript; las propiedades con guion se escriben en camelCase (p. ej. `backgroundColor`).

---

## Ejercicio 5 — Saludo multidioma solo por consola

**Enunciado:** adaptar el ejercicio 4 para que las salidas en los tres idiomas se impriman **únicamente** a través de la consola del desarrollador.

**Solución** (`Ejercicio 5\index.html`): misma estructura que el ejercicio 4, pero `saludar()` solo hace `console.log()`; la página no se modifica:

```js
function saludar(idioma) {
  const s = saludos[idioma];
  console.log(s.texto + ' (color sugerido: ' + s.color + ')');
}
```

**Concepto clave:** separación entre salida a interfaz (DOM) y salida de depuración (consola).

---

## Ejercicio 6 — Salida directa con `document.write()`

**Enunciado:** transformar el código para generar los textos **directamente en el flujo de la página** mediante `document.write()`.

**Solución** (`Ejercicio 6\index.html`): se transforma el ejercicio de los saludos (4→5→6). Los botones de idioma ya no escriben en el párrafo ni en la consola, sino que `document.write()` genera el saludo directamente en el documento:

```js
const saludos = {
  ru: 'Привет!',
  es: '¡Hola!',
  en: 'Hello!'
};

function saludar(idioma) {
  document.write('<h1>' + saludos[idioma] + '</h1>');
}
```

**Concepto clave:** `document.write()` escribe HTML directamente en el documento; si se ejecuta después de cargar la página, **reemplaza todo el contenido** del documento (por eso el botón desaparece tras el primer uso). Es un método obsoleto, solo admisible en scripts inline.

---

## Ejercicio 7 — Interfaz con tres botones (Consola / Estilo / Alerta)

**Enunciado:** diseñar una interfaz con un `<h1>`, un `<p id="estado">Sistema en espera</p>` y tres botones:
1. **Botón 1 (Consola):** `console.log()` con la hora del sistema.
2. **Botón 2 (Estilo):** cambia el fondo del párrafo a verde y su texto a "Sistema Activo" con `innerHTML` y `.style.backgroundColor`.
3. **Botón 3 (Alerta):** `window.alert()` avisando de que el proceso ha concluido.

**Solución** (`Ejercicio 7\index.html`):

```js
function consola() {
  console.log('Hora del sistema: ' + new Date().toLocaleTimeString());
}

function estilo() {
  estado.innerHTML = 'Sistema Activo';
  estado.style.backgroundColor = 'green';
}

function alerta() {
  window.alert('El proceso ha concluido.');
}
```

**Concepto clave:** combina los tres mecanismos vistos (consola, estilo directo, modal) en una única interfaz; demuestra que el navegador permite manipular DOM y emitir avisos sin recargar la página.

---

## Ejercicio 8 — Test interactivo de Verdadero/Falso

**Enunciado:** desarrollar un **test de siete preguntas** con botones "Verdadero" y "Falso". Al hacer clic, el script evalúa el acierto y modifica `.style.color` a `green` (acierto) o `red` (error).

**Solución** (`Ejercicio 8\index.html`): array `respuestas` con los 7 valores correctos; cada botón llama a `responder(numero, ganaBoton)`:

```js
const respuestas = [true, false, true, true, true, true, true];

function responder(numero, ganaBoton) {
  const esAcierto = (respuestas[numero - 1] === ganaBoton);
  const div = document.getElementById('pregunta' + numero);
  div.style.color = esAcierto ? 'green' : 'red';
}
```

**Concepto clave:** la evaluación se hace **en el cliente** sin ninguna petición al servidor; el color se aplica a todo el bloque de la pregunta mediante su `id`.

---

## Ejercicio 9 — Secuencia cíclica de imágenes

**Enunciado:** crear una secuencia **cíclica de al menos 4 imágenes, fotograma a fotograma**. Al hacer clic, el script comprueba cuál se muestra (condición o contador de un array) y reasigna `.src` para mostrar la siguiente.

**Solución** (`Ejercicio 9\index.html`): el array `imagenes` contiene 4 imágenes SVG en formato `data:` (autocontenidas, sin archivos externos). Un contador `indice` avanza en la secuencia y vuelve al inicio con el módulo `%`:

```js
let indice = 0;

function siguiente() {
  indice = (indice + 1) % imagenes.length;  // 0→1→2→3→0
  foto.src = imagenes[indice];
  pie.innerHTML = 'Fotograma ' + (indice + 1) + ' de ' + imagenes.length;
}

foto.addEventListener('click', siguiente);
```

**Concepto clave:** la alternancia de imágenes se logra únicamente reasignando el atributo `src` del elemento `<img>`; el operador módulo mantiene el índice dentro del array (bucle infinito).

---

## Resumen de recursos utilizados

| Tema | API del navegador | Dónde se usa |
|---|---|---|
| Localizar nodos | `document.getElementById()` | Ej. 1, 2, 3, 4, 7, 8 |
| Modificar contenido | `innerHTML` | Ej. 1, 4, 7 |
| Estilos en línea | `style.color` / `style.backgroundColor` | Ej. 4, 7, 8 |
| Trazas | `console.log()` | Ej. 2, 5, 7 |
| Modales | `window.alert()` | Ej. 3, 7 |
| Escritura directa | `document.write()` | Ej. 6 |
| Eventos | `addEventListener('click', ...)` | Ej. 2, 3, 9 |
| Imagen/vídeo estático | atributo `.src` | Ej. 9 |
| Hora del sistema | `new Date().toLocaleTimeString()` | Ej. 7 |