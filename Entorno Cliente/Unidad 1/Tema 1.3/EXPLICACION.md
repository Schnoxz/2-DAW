# Tema 1.3 · Cómo está resuelto

## De qué va

El tema repasa los lenguajes de la parte cliente (HTML, CSS, JavaScript) y cómo se
integran. Las actividades son **las mismas nueve del tema 1.2**, pero ahora cada
ejercicio va con el código dentro de funciones y con el HTML, el CSS y el
JavaScript separados en archivos.

## Qué pide el enunciado

1. Repetir los ejercicios del 1.2 sacando el código de los atributos `onclick` y
   metiéndolo en funciones.
2. Clasificar los lenguajes de marcas y de programación del lado cliente.
3. Explicar qué aporta cada uno y cómo se combinan.

## Paso a paso

### Cómo cambia respecto al 1.2

Antes, el código iba dentro del HTML:

```html
<button onclick="document.getElementById('prueba').innerHTML = '¡Cambiado!'">
```

Ahora se llama a una función:

```html
<button type="button" onclick="cambiarParrafo()">¡Dale!</button>
```

```js
function cambiarParrafo() {
  document.getElementById("prueba").innerHTML = "CAMBIANDO el contenido!";
  console.log("[Ej1] Párrafo actualizado");
}
```

La ventaja es que el HTML queda limpio y la lógica se puede leer, reutilizar y
probar por separado.

### Los tres archivos

Cada ejercicio tiene su carpeta con esta estructura:

```
Ejercicio N/
├── index.html    estructura
├── estilos.css   presentación
└── script.js     comportamiento
```

Se enlazan así:

```html
<link rel="stylesheet" href="estilos.css">
<script src="script.js"></script>
```

El `<script>` va al final del `<body>` para que los elementos existan cuando el
código los busca con `getElementById()`.

### Los nueve ejercicios

| # | Qué hace | Qué se practica |
|---|---|---|
| 1 | Dos botones que cambian párrafo y título | funciones y `innerHTML` |
| 2 | Traza en consola | `console.log()` |
| 3 | Aviso modal | `window.alert()` |
| 4 | Saludo en tres idiomas con colores | objetos, `style` |
| 5 | Los tres saludos por consola | `for...in` |
| 6 | Texto insertado en la página | `document.write()` |
| 7 | Tres botones con tres salidas | combinar mecanismos |
| 8 | Test de verdadero/falso | condicionales y contador |
| 9 | Imágenes en secuencia | `setInterval` y módulo `%` |

### La parte de lenguajes

| Lenguaje | Qué aporta | Dónde se ejecuta |
|---|---|---|
| **HTML** | estructura y significado (títulos, párrafos, listas) | navegador |
| **CSS** | presentación: colores, tamaños, disposición | navegador |
| **JavaScript** | comportamiento: leer datos, cambiar el DOM, responder a eventos | navegador |

Los tres son lenguajes de cliente, pero solo JavaScript es de programación: HTML y
CSS son de marcas y de estilos, y no tienen variables ni bucles.

## El código, pieza a pieza

```
Actividades Tema 1.3/
├── Ejercicio 1..9/   index.html + estilos.css + script.js
├── Capturas/         imágenes de cada estado (incluida la consola)
├── Entrega Tema 1.3.md/.pdf
└── Soluciones Tema 1.3.md
```

## Trampas y dudas

- **El `id` tiene que coincidir.** Si en el HTML es `titulo` y en el script se
  busca `tituloPrincipal`, `getElementById()` devuelve `null` y el `innerHTML`
  falla con un `TypeError`.
- **El orden de carga importa.** Si el `<script>` va en `<head>` sin `defer`, se
  ejecuta antes de que exista el HTML y no encuentra los elementos.
- **`onclick` dentro del HTML no está mal**, pero mezcla estructura y lógica. En
  cuanto hay varias líneas, conviene pasarlo a una función.
- **Los tres lenguajes son públicos.** Todo lo que llega al navegador se puede leer.

## Si me preguntan

- **¿Por qué separar HTML, CSS y JS?** Porque cada uno cambia por motivos
  distintos y así se puede tocar el diseño sin romper la lógica.
- **¿JavaScript es lo mismo que Java?** No. Son lenguajes distintos, de empresas
  distintas y con modelos diferentes. Solo comparten parte del nombre.
- **¿HTML es un lenguaje de programación?** No: es de marcas. Describe estructura,
  no ejecuta cálculos.
