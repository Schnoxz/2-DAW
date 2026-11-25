# Tema 1.2 · Cómo está resuelto

## De qué va

El tema explica cómo ejecuta el código un navegador y qué mecanismos tiene para
mostrar resultados: la consola, un `alert()`, escribir en la propia página o
cambiar el DOM.

Son nueve ejercicios cortos, cada uno en su carpeta con su `index.html`.

## Qué pide el enunciado

| # | Ejercicio | Idea |
|---|---|---|
| 1 | Segundo botón que modifica el `<h1>` | dos botones, dos cambios |
| 2 | Traza por consola al pulsar | `console.log()` |
| 3 | Aviso modal | `window.alert()` |
| 4 | Saludo multidioma con color distinto | objetos y estilos |
| 5 | Saludos solo por consola | recorrer un array |
| 6 | Salida en el flujo de la página | `document.write()` |
| 7 | Tres botones: consola, estilo y alerta | combinar todo |
| 8 | Test de verdadero/falso | lógica y comparación |
| 9 | Secuencia de imágenes | temporizador y array |

## Paso a paso

### 1 · Dos botones

Cada botón cambia un elemento distinto por su `id`:

```html
<button onclick="document.getElementById('prueba').innerHTML = '¡Cambiado!'">
  Cambiar párrafo
</button>
```

`innerHTML` sustituye el contenido del elemento. En el ejercicio 1.3 el mismo
código se pasa a funciones, que se lee mejor.

### 2 · Consola

```js
function emitirTraza() {
  console.log("Se ha capturado el evento clic del botón.");
}
```

`console.log()` no toca la página: escribe en la consola (F12). Sirve para
comprobar que un evento se dispara.

### 3 · Aviso modal

```js
function mostrarAviso() {
  window.alert("Has pulsado el botón.");
}
```

`alert()` **bloquea** la página hasta que se acepta. Por eso no se usa en
producción: corta la interacción.

### 4 · Saludo con color

Se guardan las traducciones en un objeto y se aplica el color con `style`:

```js
const saludos = {
  es: { texto: "Hola", color: "#c0392b" },
  en: { texto: "Hello", color: "#1f4e79" },
  fr: { texto: "Bonjour", color: "#117a65" },
};
```

```js
const elegido = saludos[idioma];
salida.textContent = elegido.texto;
salida.style.color = elegido.color;
```

### 5 · Solo consola

Igual que el 4, pero recorriendo el objeto con `for...in` y escribiendo cada
saludo con `console.log()`.

### 6 · `document.write()`

```js
document.write("<p>Contenido escrito desde JavaScript.</p>");
```

Funciona si se ejecuta **mientras la página se está cargando**. Si se llama
después (al pulsar un botón), el navegador borra todo el documento y deja solo lo
nuevo. Es la razón de que hoy no se use.

### 7 · Tres botones

Junta los tres mecanismos anteriores en una sola página: un botón escribe en
consola, otro cambia un estilo (`elemento.style.color`) y otro lanza un `alert()`.

### 8 · Test de verdadero/falso

Cada pregunta se compara con la respuesta correcta y se suma un punto:

```js
let aciertos = 0;
if (respuesta1 === "V") aciertos++;
```

Al final se muestra el resultado. Todo ocurre en el cliente: no hay servidor que
corrija.

### 9 · Secuencia de imágenes

```js
let indice = 0;
const fotogramas = ["img1.png", "img2.png", "img3.png"];

setInterval(() => {
  indice = (indice + 1) % fotogramas.length;
  imagen.src = fotogramas[indice];
}, 1000);
```

El `% fotogramas.length` hace que al llegar al final vuelva al principio sin salirse
del array.

## El código, pieza a pieza

```
Actividades Tema 1.2/
├── Ejercicio 1..9/index.html    cada actividad, autocontenida
├── Capturas/                    imágenes de cada estado
├── Entrega Tema 1.2.md/.pdf     memoria
└── Soluciones Tema 1.2.md       correcciones
```

## Trampas y dudas

- **`innerHTML` contra `textContent`.** `innerHTML` interpreta etiquetas;
  `textContent` las muestra como texto. Para datos del usuario, `textContent`.
- **`alert()` detiene el script.** No se puede usar para depurar en bucle.
- **`document.write()` después de cargar** borra la página entera.
- **`setInterval` no para solo.** Hay que guardar el identificador y llamar a
  `clearInterval()` si se quiere detener.

## Si me preguntan

- **¿Dónde se ve la consola?** F12 → pestaña Console. También con Ctrl+Shift+J en
  algunos navegadores.
- **¿Por qué `console.log` y no `alert` para depurar?** Porque no interrumpe y deja
  seguir el flujo.
- **¿Qué es el DOM?** El árbol de elementos de la página que el navegador construye
  al leer el HTML. JavaScript lo modifica y el navegador repinta.
