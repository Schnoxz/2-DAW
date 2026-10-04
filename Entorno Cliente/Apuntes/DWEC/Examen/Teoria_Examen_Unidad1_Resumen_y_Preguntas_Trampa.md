# Unidad 1 · Entorno Cliente — Resumen teórico para examen y preguntas trampa

> Resumen de los apartados **1.1 a 1.6** (RA1 / CE 1.a a 1.f). Cada bloque explica **cómo
> funciona**, después **qué fallos puede dar**, y al final hay un **banco de preguntas
> trampa** con respuesta.

---

## 0. Mapa del tema y datos que hay que saberse de memoria

| Apartado | Contenido | CE | Ponderación |
|---|---|---|---|
| 1.1 | Modelos de ejecución en servidor y cliente | 1.a | 16,67% del RA1 |
| 1.2 | Capacidades y mecanismos de los navegadores | 1.b | 16,67% del RA1 |
| 1.3 | Lenguajes de programación de cliente | 1.c | 16,67% del RA1 |
| 1.4 | Particularidades de los guiones (scripts) | 1.d | 16,67% del RA1 |
| 1.5 | Mecanismos de integración HTML + JavaScript | 1.e | 16,67% del RA1 |
| 1.6 | Herramientas de programación y prueba | 1.f | 16,67% del RA1 |

Los seis pesan igual: **0,833% cada uno sobre la calificación final del módulo**.

**Historia mínima:** 1989 Tim Berners-Lee en el CERN crea la Web. El **W3C** define los
estándares (su delegación española es **w3c.es**). La nube (AWS) sustituye a los servidores
propios en dependencias.

---

## 1. Apartado 1.1 — Cliente / servidor

### Cómo funciona

Toda web usa el modelo **cliente/servidor**. El **cliente** es el equipo y el navegador del
usuario; el **servidor** guarda los datos y la lógica principal. Ambos se comunican por
internet con peticiones HTTP/HTTPS.

| Dimensión | Cliente (front-end) | Servidor (back-end) |
|---|---|---|
| Dónde se ejecuta | Navegador del usuario | Servidor remoto o nube |
| Visibilidad del código | **Público** (F12) | **Privado** |
| Tecnologías | HTML5, CSS3, JavaScript, React/Vue/Angular | PHP, Python, Java, Node.js, C# |
| Acceso a datos | Indirecto, por HTTP | Directo a SQL o NoSQL |
| Recursos | CPU, RAM y batería del usuario | Potencia del servidor |
| Latencia | Inmediata en lo visual | Sujeta a red y carga |
| Seguridad | Baja, modificable por el cliente | Alta: cobros, permisos, roles |

**Los tres pilares del front-end:** HTML (estructura), CSS (presentación), JavaScript
(lógica y eventos).

**Regla para decidir dónde va cada cosa:**

- **Cliente:** menús, modales, acordeones, cambios de estilo al hacer hover o clic, ordenar y
  filtrar datos **ya cargados en memoria**.
- **Servidor (nunca en el cliente):** cobros con pasarela de pago (el importe final se calcula
  en servidor), consultas sobre millones de registros, comprobación de roles y permisos.

**Web clásica vs SPA:** en la web clásica cada clic genera una petición síncrona y el servidor
devuelve un HTML nuevo entero (pantalla en blanco y parpadeo). En la **SPA** se descarga la
plantilla una vez y JavaScript pide solo datos en JSON y actualiza las partes del árbol visual
que cambian.

### Fallos que pueden ocurrir

- **Confiar una validación solo en el cliente.** El usuario puede saltarse el `if` desde la
  consola. Toda validación con efecto real (precio, permisos) se repite en el servidor.
- **Poner una clave de API, una contraseña o la base de datos en el JavaScript del cliente.**
  Es código público: se lee con F12. Solo van allí claves públicas y de anillo limitado.
- **Mover al cliente una operación masiva.** Si el catálogo tiene 8 millones de registros no
  se descargan todos a un array del navegador: la solución es **paginación** y filtrado en
  servidor.
- **Confundir "el servidor es invisible" con "el cliente es seguro".** El back-end nunca es
  accesible directamente, pero el front-end es auditable por cualquiera.

---

## 2. Apartado 1.2 — El navegador por dentro

### Cómo funciona: los 7 módulos

1. **Interfaz de usuario (UI).** La ventana: barra de direcciones, pestañas, botones.
2. **Motor del navegador (Browser Engine).** Intermediario entre la UI y los motores internos.
3. **Motor de renderizado (Rendering Engine).** Lee HTML y CSS, calcula tamaño y posición de
   cada elemento y lo dibuja.
4. **Motor de JavaScript (JavaScript Engine).** Interpreta el código. Usa **JIT**: detecta las
   funciones que se ejecutan muchas veces y las compila a código máquina nativo.
5. **Capa de red (Networking).** Envía y recibe datos, resuelve DNS, valida certificados HTTPS.
6. **UI Backend.** Conecta con el sistema operativo para dibujar ventanas con aspecto nativo.
7. **Almacenamiento de datos.** Cookies, caché y bases de datos locales.

> **Punto clave: el motor de renderizado y el motor de JavaScript están separados.** Cuando
> JS cambia un texto, el motor de JS avisa al de renderizado para que recalcule y repinte.

### Motores de los navegadores

| Navegador | Motor de renderizado | Motor de JavaScript |
|---|---|---|
| Chrome | Blink | V8 |
| Edge | Blink | V8 |
| Brave / Opera | Blink | V8 |
| Firefox | Gecko | SpiderMonkey |
| Safari | WebKit | JavaScriptCore |

- Chrome usó **WebKit** (el de Apple) hasta 2013; en ese año Google copió el proyecto y nació
  **Blink**.
- **En iPhone e iPad cualquier navegador usa WebKit**, aunque se llame Chrome o Firefox: lo
  obliga la tienda de aplicaciones de Apple.

### Proceso de renderizado (código → píxeles)

1. **Creación del DOM y del CSSOM.** El HTML se lee y se construye el árbol DOM en memoria; el
   CSS genera el árbol CSSOM.
2. **Render Tree.** Se combinan DOM y CSSOM. **Solo entran los elementos visibles**: `<head>` y
   los elementos con `display: none` quedan fuera.
3. **Layout (disposición).** Se calculan ancho, alto y coordenadas de cada caja.
4. **Pintado (Paint).** Se dibujan píxeles a píxel.

> Un `<script>` **detiene la lectura** mientras se descarga y se ejecuta. Si es pesado, la
> pantalla se queda en blanco.

### Capacidades nativas (APIs web)

- **DOM:** modificar textos, colores, ocultar cajas, crear elementos.
- **Peticiones en segundo plano:** `fetch()`, sin recargar la página.
- **Almacenamiento:** cookies (hasta **4 KB**, van al servidor en cada petición),
  `sessionStorage` (mientras la pestaña esté abierta), `localStorage` (permanente, 5–10 MB),
  `IndexedDB` (base de datos en el navegador, para trabajar sin conexión).
- **Dispositivos, siempre con permiso:** geolocalización, cámara y micrófono, batería, red.

Antes de usar algo se comprueba si existe:

```javascript
if ('geolocation' in navigator) {
  // el navegador lo soporta
}
```

### DOM y BOM: el árbol de objetos

```
window (BOM / navegador)
└── document (DOM)
    └── <html>
        ├── <head>
        │   └── <title>
        └── <body>
            ├── <h1>
            └── <p>
```

- **DOM** = representación en árbol, en memoria RAM, de todos los elementos de la página.
- **BOM** = objetos del navegador. Su raíz es **`window`**.
- **`document` es una propiedad de `window`**, no un objeto paralelo.
- **Ámbito global:** lo declarado arriba con `var` pasa a formar parte de `window`, por eso
  `window.alert("x")` y `alert("x")` son idénticos.

JavaScript **no dibuja** en la tarjeta gráfica: busca nodos en el DOM, lee o cambia sus
propiedades, y el motor de renderizado recalcula y pinta.

### Los cuatro mecanismos de salida

| Mecanismo | Qué hace | Invisible al usuario |
|---|---|---|
| `console.log()` | Escribe en el panel Consola (F12) | Sí |
| `innerHTML` | Sustituye todo el marcado y texto del nodo | No |
| `document.write()` | Escribe en el flujo de la página | No |
| `window.alert()` | Abre un diálogo modal nativo | No |

### Manipulación dinámica

```javascript
// Contenido
document.getElementById('prueba').innerHTML = 'CAMBIANDO!';
document.getElementById('prueba').textContent = 'CAMBIANDO!'; // más seguro

// Atributos: cada atributo HTML es una propiedad accesible
img.src = 'otra.jpg';

// Estilos: regla camelCase
x.style.backgroundColor = 'red';
x.style.fontSize = '25px';
```

**camelCase:** el guion es el signo de resta en JavaScript, así que se elimina y se capitaliza
la siguiente letra. `background-color` → `backgroundColor`, `font-size` → `fontSize`,
`margin-top` → `marginTop`.

### Reflow y repaint

- **Reflow (re-layout):** el cambio altera dimensiones o posición (`fontSize`, `innerHTML`).
  El navegador recalcula el espacio y **desplaza todo lo que rodea**. Es lo caro.
- **Repaint:** el cambio es solo visual y no altera el espacio (`color`, `backgroundColor`).
  Solo se repintan los píxeles afectados.

> Cambios que provocan reflow dentro de un bucle ralentizan la web. Hay que **agrupar** las
> modificaciones para evitar parpadeos y caídas de FPS.

### Fallos que pueden ocurrir

- **Confundir la consola con la página.** `console.log()` no se ve en la web. Si el ejercicio
  pide que el usuario lo vea, hay que usar `innerHTML`, `textContent` o `document.write()`.
- **`document.write()` después de la carga.** Si se invoca al pulsar un botón, **borra de
  forma irreversible todo el documento** y solo queda lo escrito en esa llamada.
- **`window.alert()` bloquea el hilo principal.** Las animaciones se detienen y la página no
  atiende ningún otro evento hasta que se pulse Aceptar.
- **`innerHTML` con datos de un usuario desconocido → XSS.** Si el usuario escribe
  `<script>malicioso</script>`, se ejecutará en el navegador de los demás. Para texto plano,
  `textContent`.
- **`document.getElementById()` que devuelve `null`.** Si el `id` no existe o el elemento aún
  no está en el DOM, cualquier acceso a una propiedad lanza
  `TypeError: Cannot read properties of null`.
- **Escribir `style.font-size`.** El guion es una resta: error de sintaxis o el estilo no
  cambia. Hay que usar `style.fontSize`.
- **Asumir que todos los navegadores tienen lo mismo.** Se comprueba con `in navigator` y con
  caniuse.com.

---

## 3. Apartado 1.3 — Los lenguajes de cliente y los frameworks

### Cómo funciona: la tríada

| Lenguaje | Naturaleza | Responsabilidad |
|---|---|---|
| **HTML** | **No es un lenguaje de programación**, es de marcado por etiquetas | Semántica y estructura |
| **CSS** | Declarativo de diseño | Aspecto, maquetación, responsive |
| **JavaScript** | Programación **dinámico, débilmente tipado y orientado a eventos** | Dinamismo, eventos, validación, alterar el documento en caliente |

### Historia de JavaScript (datos de examen)

- **1995:** Brendan Eich lo crea en **10 días** para Netscape. Nació como Mocha, luego
  LiveScript, y acabó llamándose JavaScript.
- **1996:** Microsoft lanza **JScript** con Internet Explorer 3.0 por ingeniería inversa.
  Empieza la primera guerra de navegadores.
- **1997:** Netscape entrega la especificación a Ecma International. Nace **ECMAScript**
  (norma **ECMA-262**), que es el estándar; JavaScript es una implementación.
- **1998 (ES2) y 1999 (ES3):** ES3 consolida el lenguaje una década: expresiones regulares,
  `try/catch`.
- **ES4:** se propuso y **se abandonó** por complejidad y falta de consenso.
- **2005:** Jesse James Garrett acuña **AJAX**. `XMLHttpRequest` permite actualizar páginas sin
  recargarlas (Google Maps, Gmail).
- **2006:** jQuery, Prototype y MooTools unifican las APIs del DOM entre navegadores.
- **2008–2009:** Google lanza Chrome con el motor **V8** (JIT); **Ryan Dahl crea Node.js** sobre
  V8 y lleva JavaScript al back-end. **ES5 (2009)**: `"use strict"`, `forEach/map/filter/
  reduce/some/every`, `JSON.parse/stringify`, getters y setters, `Object.freeze`, `Object.keys`.
- **2015: ES6 / ECMAScript 2015**, la mayor refundición desde 1995.
- **Desde ES6:** el TC39 aprueba con 4 fases (Stages 0 a 4) y **publicaciones anuales**.

### Frameworks

Nacen como librerías para unificar navegadores y hoy son plataformas completas con
compilación previa, tipado o extensiones como **TypeScript** y **JSX**. Ventajas: coste
económico nulo, fiabilidad, velocidad de entrega y estandarización de equipos.

| Framework | Autor | Datos clave |
|---|---|---|
| **ReactJS** | Meta (Facebook) | Componentes con estado propio, **DOM virtual**, sintaxis **JSX** |
| **Angular** | Google | Se programa en **TypeScript**, **RxJS**, inyección de dependencias, curva muy pronunciada |
| **Vue.js** | Evan You | Toma lo mejor de React y Angular, DOM virtual, curva progresiva, habitual con Laravel |
| EmberJS | — | Convención sobre configuración, grandes apps empresariales |
| BackboneJS | — | Primer intento de estructurar modelos y vistas ligeras |
| MeteorJS | — | Plataforma tiempo real que unifica cliente y servidor |

**DOM virtual:** copia ligera del DOM en RAM; el framework calcula las diferencias mínimas
(reconciliación) y actualiza solo los nodos necesarios.

### Funciones

```javascript
// 1. Declaración tradicional: tiene hoisting (se puede llamar antes de escribirla)
function saludar(nombre) { return `Hola, ${nombre}`; }

// 2. Expresión de función: NO se puede usar antes de definirla
const duplicar = function(n) { return n * 2; };

// 3. Flecha (ES6): retorno y llaves implícitos si el cuerpo es una línea
const sumar = (a, b) => a + b;
const cuadrado = x => x * x;
```

### Fallos que pueden ocurrir

- **Creencia popular equivocada:** JSX es un lenguaje separado. No: es una **extensión de
  JavaScript** que se compila a JavaScript.
- **Creer que React sustituye al DOM.** Usa el DOM; lo que hace es optimizar cuándo y cómo se
  modifica (DOM virtual).
- **Confundir `==` con `===`.** `=` asigna; `===` compara. Con `==` hay coerción de tipos
  inesperada (`0 == "0"` es `true`).
- **Llamar a una expresión de función antes de declararla.** Solo la declaración tradicional
  tiene hoisting.
- **Elegir Angular para un proyecto pequeño.** Su curva de aprendizaje y su rigidez en
  tipado no compensan.

---

## 4. Apartado 1.4 — Scripts y programación tradicional

### Cómo funciona

Un **script** nació como una secuencia de comandos para automatizar tareas rutinarias, y hoy
es un programa completo. **Siempre lo ejecuta un intérprete**, nunca el usuario.

**Las 5 diferencias fundamentales:**

| | Tradicionales | Script |
|---|---|---|
| 1. Compilación | Se compila a código máquina binario; sin compilar no hay ejecutable | Se interpreta línea a línea en tiempo de ejecución, sin compilación previa del programador |
| 2. Ejecución | **Standalone** (`.exe`: C++, Go, Rust) o gestionado por máquina virtual (JVM, .NET) | Se integra en un **sistema anfitrión**: el DOM y el motor del navegador en JS, el sistema operativo en Python |
| 3. Origen del código | Construye sus propias estructuras desde la base | **Reutiliza componentes preexistentes** del anfitrión (DOM, motor gráfico, red) |
| 4. Detección de errores | En **compilación**: si hay fallo, no se genera el binario | En **tiempo de ejecución**: línea a línea, al ejecutarse |
| 5. Clasificación | C, C++, Java, Swift, Pascal | JavaScript, Shell, Perl, **PHP**, Python, Ruby |

**Los scripts ya no están ataados al anfitrión:** Python y JavaScript (con Node.js) corren en
consola, y ambos se pueden empaquetar con herramientas externas (PyInstaller, pkg, Electron)
para convertirlos en standalone.

**Ventajas:** curva de aprendizaje rápida, agilidad (sin esperar compilación: se recarga y se prueba),
integración natural en otros documentos, portabilidad a cualquier dispositivo con navegador.
**Desventajas:** más errores en tiempo de ejecución (una rama poco transitada puede fallar sin
que nadie lo note), menor rendimiento bruto y consumo de memoria, y **exposición del código
fuente** (viaja al cliente como texto plano).

> Hoy los motores aplican **JIT**, así que decir "JavaScript no se compila nunca" es **FALSO**.

**Java vs JavaScript** (nombres parecidos, filosofías opuestas):

| | Java | JavaScript |
|---|---|---|
| Tipo | Tradicional | Script |
| Tipado | **Fuerte** | **Débil** |
| Ejecución | Compilado a bytecode, sobre JVM | Interpretado en el navegador |
| Paradigma | Orientado a objetos rígidamente | **Orientado a eventos** |

### El objeto `Date`

Las fechas **no son un tipo primitivo**: son instancias del objeto nativo `Date`, y
representan una **instantánea congelada** (no un reloj que avanza).

Internamente guarda **milisegundos desde la época Unix**: 1 de enero de 1970 00:00:00 UTC.
Positivo = después; negativo = antes. Un día = 24 × 60 × 60 × 1000 = **86 400 000 ms**.

```javascript
Date.now();                    // timestamp actual en ms, sin instanciar
new Date();                    // fecha y hora actual del reloj local
new Date("2026-09-28");        // cadena ISO 8601 (recomendado)
new Date(2026, 11, 25, 10, 30); // numérico: new Date(año, mesIndex, día, hora, min, seg, ms)
new Date(86400000);            // un solo número SIEMPRE son milisegundos desde 1970
```

**Reglas que hay que saberse:**

1. **Los meses son de base cero:** `0` enero … `11` diciembre. Los **días van de 1** a 31.
2. **Desbordamiento automático:** lo que excede avanza a la siguiente unidad.
   `new Date(2026, 15, 20)` → abril de 2027. `new Date(2026, 5, 35)` → 5 de julio.
3. **Un único número NUNCA es el año:** `new Date(2026)` son 2026 **milisegundos** después de
   1970.
4. **Años de 0 a 99** se interpretan como **siglo XX**: `new Date(95, 5, 15)` → 15 de junio de
   1995.
5. **La zona horaria afecta a la cadena.** Para intercambiar datos se usa `toISOString()` (UTC).

| Método | Devuelve |
|---|---|
| `toString()` | Texto completo con zona local |
| `toDateString()` | Solo fecha legible |
| `toTimeString()` | Solo hora con huso |
| `toISOString()` | ISO 8601 en UTC (para APIs y BD) |
| `toUTCString()` | Formato HTTP (cabeceras, cookies) |
| `toLocaleDateString()` | Según la localización del usuario |

`getFullYear()`, `getMonth()` (**0-11**), `getDate()`, `getDay()` (**0 = domingo**),
`getHours()`, `getMinutes()`, `getSeconds()`, `getTime()`. Los setters son los mismos sin el
`get`.

**Truco para el último día de un mes:** el día **0** del mes siguiente es el último día del
mes pedido.

### Fallos que pueden ocurrir

- **`getMonth()` devuelto directamente a un usuario.** Un select que pinte "9" esperando
  septiembre está enseñando octubre.
- **`getDay()` mal interpretado.** Devuelve día **de la semana**, no del mes, y el 0 es domingo.
- **Comparar fechas con `===`.** Son **objetos distintos**: hay que comparar `getTime()`.
- **`new Date("2026/02/28")` frente a `new Date("2026-02-28")`.** La forma con barras no es
  ISO y el análisis puede variar. Usar siempre ISO con guiones.
- **Confundir el timestamp en segundos con el de milisegundos.** `getTime()` devuelve
  milisegundos.

---

## 5. Apartado 1.5 — Integrar JavaScript en HTML (el apartado clave)

### Cómo funciona: la etiqueta `<script>`

Es el contenedor que el W3C define para insertar o enlazar código ejecutable.

- **HTML5:** `<script>` y `</script>`. El navegador asume **JavaScript** por defecto.
- **Legado:** `<script type="text/javascript">`. Los navegadores actuales lo aceptan por
  compatibilidad, pero **ya no hace falta escribirlo**.
- **Nunca se cierra de forma abreviada.** `<script src="script.js" />` **no funciona** en
  HTML (HTML no es XML): el resto de la página no se muestra. Siempre `</script>`.

### Dos formas de incluir el código

| | Embebido | Ficheros externos (recomendado) |
|---|---|---|
| Dónde | Dentro del propio HTML, entre `<script>` y `</script>` | `.js` aparte, enlazado con `src` |
| Resultado visual | Idéntico | Idéntico |
| Caché | No se aprovecha | **Se descarga una vez y se reutiliza** en todas las páginas |
| Mantenimiento | Difícil: bloques `<script>` dispersos | Se toca **un** archivo y cambia en todas las páginas |
| Trabajo en equipo | Diseñadores y programadores se pisan | HTML y JS quedan separados |
| Uso justo | Solo unas pocas líneas para una página que no cambia | Proyectos profesionales |

Organización profesional recomendada:

```
mi_proyecto/
├── css/
│   └── estilos.css
├── js/
│   └── logica.js
└── index.html
```

```html
<script src="./js/logica.js"></script>
```

### ⚠️ La pregunta que siempre cae: ¿qué pasa si pongo el `<script>` dentro del `<head>`?

**Respuesta corta: depende de qué haga el script, porque en el `<head>` el elemento del
`<body>` todavía no existe.**

**El por qué.** El navegador lee el HTML **de arriba abajo**. Si encuentra un `<script>`,
**detiene el análisis del documento** hasta que el script se descarga y se ejecuta por
completo. Como el `<body>` está más abajo, **no se ha leído ni construido todavía en el DOM**.
La pantalla puede quedarse en blanco mientras tanto.

**Caso 1 — Declarar una función en el head: FUNCIONA.**

```html
<head>
  <script>
    function diAlgo() { alert("hola"); }   // aquí solo se DEFINE, no se ejecuta
  </script>
</head>
<body>
  <script> diAlgo(); </script>              <!-- aquí se LLAMA, y el body ya existe -->
</body>
```

Declarar una función no la ejecuta: solo crea el nombre en memoria. La llamada sí ocurre
después, cuando el `body` ya está construido.

**Caso 2 — Tocar el DOM desde el head: FALLA.**

```html
<head>
  <script>
    // FALLA: el elemento <p id="prueba"> todavía no existe en el DOM
    document.getElementById('prueba').textContent = 'CAMBIANDO!';
  </script>
</head>
<body>
  <p id="prueba">Modificando el contenido.</p>
</body>
```

`getElementById()` devuelve **`null`** y la siguiente línea lanza:

```
Uncaught TypeError: Cannot read properties of null (reading 'textContent')
```

**Las cuatro soluciones correctas**, de la más recomendada a la menos:

1. **Al final del `<body>`, antes de `</body>`.** Es la recomendación tradicional más eficaz:
   todo el marcado ya está en el DOM cuando empieza la lógica.
2. **`defer`**, para scripts **externos** en el `<head>`.
3. **Escuchar el evento `DOMContentLoaded`.**
4. Mover el `<script>` al final del `<head>`… no sirve: el problema es que el `body` está
   después, no que quede poco margen.

### `defer` frente a `async` (solo en scripts externos)

| | `defer` | `async` |
|---|---|---|
| Descarga | En segundo plano mientras se construye el HTML | En segundo plano |
| Ejecución | **Al terminar de parsearse todo el HTML** | **En cuanto termina la descarga**, sin esperar al HTML |
| Orden entre varios scripts | **Se respeta** el orden del HTML | **No se respeta**: puede ejecutarse el segundo antes que el primero |
| Uso típico | Scripts que necesitan el DOM | Analítica, contadores, herramientas externas |

> **Trampa clásica:** `defer` y `async` **solo funcionan con scripts externos** (los que
> tienen `src`). En un `<script>` embebido **no hacen nada**.

### Fallos que pueden ocurrir

- **`getElementById` con un `id` que no coincide** con el del HTML → `null` → TypeError. Es
  sensible a mayúsculas.
- **`addEventListener('click', cambiar())`** con paréntesis: la función se **ejecuta al
  cargar** y el clic no hace nada. Hay que pasar la **referencia**: `addEventListener('click',
  cambiar)`.
- En el atributo HTML es al revés: **`onclick="cambiar()"`** sí necesita paréntesis.
- **404 en el panel Red** si la ruta del `src` no incluye la carpeta: debe ser
  `./js/logica.js`, no `logica.js`.
- **Abrir el archivo con doble clic** (`file://`) y esperar que `fetch()` funcione: la política
  de origen único del navegador lo bloquea. Hay que usar un servidor local (por ejemplo Live
  Server).

---

## 6. Apartado 1.6 — Herramientas de programación y prueba

### Cómo funciona

Para JavaScript basta un editor de texto plano, pero en un entorno profesional es inviable por
la falta de verificación de sintaxis y de gestión de proyectos.

**Editores más usados para JS/TS** (Stack Overflow Developer Survey):

| | Editor | % | Nota |
|---|---|---|---|
| 1 | **Visual Studio Code** | 75,9% | Estándar de la industria. TS nativo (está escrito en TS), ESLint, Prettier, Snippets |
| 2 | **Notepad++** | 27,4% | Scripts sueltos, `.json` gigantes, tareas ligeras |
| 3 | **Vim / Neovim** | 38,3% (24,3 + 14) | Autocompletado y tipado de TS en la terminal |
| 4 | **Cursor** | 17,9% | Clon de VS Code con IA nativa |
| 5 | **JetBrains / WebStorm** | 15,1% (WS 7,6%) | El mejor motor de refactorización |

**VS Code frente a VSCodium:** se ven y actúan igual; la diferencia es la licencia y la
telemetría. VS Code es de Microsoft, su instalador incluye licencia comercial y **telemetría**
(rastreadores que envían datos de uso) y restringe ciertas extensiones oficiales. **VSCodium**
toma el mismo código fuente libre (Code - OSS) y lo compila limpio: **cero telemetría**.

**Editores con IA propia:** **Windsurf** (de Codeium, fork de VS Code, modo agente *Cascade*),
**Void** (abierto, tú pones tu API Key de OpenAI/Anthropic/Gemini) y **Zed** (Rust, mínimo
consumo de RAM, usa GPU, con IA integrada).

**Git** es un sistema de control de versiones **distribuido** que rastrea cada cambio.
**GitHub** es la plataforma en la nube que aloja repositorios, con *pull requests*, *issues* e
integración continua. VS Code integra paneles nativos de Git: commits, cambio de rama y
resolución de conflictos sin salir del editor.

**Entornos online:** **Coding Ground** (Tutorialspoint) da editor con resaltado, *Preview* y
consola simultáneas, y permite descargar el código al equipo. **CodeSandbox**, **StackBlitz** y
**JSFiddle** arrancan proyectos de React, Angular o Vue desde el navegador en segundos.

**DevTools (F12 o Ctrl + Shift + I):**

| Panel | Para qué sirve |
|---|---|
| **Consola** | Interactuar con el motor JS en vivo. Muestra `console.log()` y **resalta en rojo las excepciones** |
| **Fuentes** (Debugger) | Examinar los `.js`, poner **breakpoints**, congelar la ejecución y ver variables paso a paso y el **Call Stack** |
| **Red** (Network) | Vigilar las peticiones HTTP y ver el código de respuesta (**200 OK**, **404**, **500**), el tiempo y el tamaño |

**Las tres extensiones de la actividad:**

- **Live Server** — levanta un servidor local con un clic y **recarga el navegador al guardar**.
- **Quokka.js** — **ejecuta el JavaScript dentro del editor** y muestra el resultado flotando
  junto a la línea de código.
- **Error Lens** — convierte la pequeña línea ondulada roja **en el mensaje de error completo**
  con fondo rojo al final de la línea, sin pasar el ratón por encima.

**Criterios de selección:**

| Parámetro | Editor ligero / online | IDE completo |
|---|---|---|
| Escenario | Pruebas rápidas, corrección puntual, hardware limitado | Proyectos medianos o grandes, frameworks |
| Recursos | Mínimo, corre en el navegador | Medio-alto, RAM y disco para indexar |
| Control de versiones | Solo exportar o descargar archivos | **Git** integrado, ramas, diferencias |
| Personalización | Escasa o nula | Elevada, con gestores de paquetes y extensiones |

### Fallos que pueden ocurrir

- **Guardar sin guardar de verdad.** Live Server y Error Lens vigilan el disco: si el editor
  tiene cambios pendientes, el navegador recarga la versión anterior y parece que el cambio no
  se aplica.
- **Un `breakpoint` en una línea que nunca se ejecuta** (por ejemplo dentro de un `if` que no
  se cumple): el punto de interrupción nunca se alcanza.
- **Confiar en una plataforma online para una base de datos o una clave de API.** Es cliente,
  es público: se lee con F12.
- **Usar un editor ligero para un proyecto con React o Angular:** no indexa el proyecto ni
  gestiona dependencias.

---

## 7. Banco de preguntas trampa

### Cliente / servidor (1.1)

**1.** ¿En qué entorno se ejecuta JavaScript en el navegador? →
**En el del cliente**, con la CPU y la RAM del equipo del usuario. El servidor no ejecuta el
JS del front-end.

**2.** ¿Es público el código del cliente? → **Sí.** Con F12 cualquiera ve, audita y modifica el
HTML y el JS. Por eso las contraseñas y las claves **nunca** van solo en el cliente.

**3.** ¿Dónde se calcula el importe final de un pago? → **En el servidor.** Si se calcula en el
navegador, el usuario lo altera.

**4.** En la web clásica, ¿qué pasa al pulsar un enlace? → Una petición síncrona, el servidor
ensambla un HTML nuevo entero y la página **se queda en blanco y parpadea**.

**5.** ¿Qué es una SPA? → Descarga la plantilla y los recursos **una vez**; después pide solo
datos en JSON y **actualiza selectivamente** el árbol visual, sin recargar la página.

---

### Navegador (1.2)

**6.** ¿Cuántos módulos tiene un navegador y cuáles son? → **Siete:** interfaz de usuario, motor
del navegador, motor de renderizado, motor de JavaScript, capa de red, UI backend y
almacenamiento de datos.

**7.** ¿El motor de renderizado y el de JavaScript son el mismo? → **No, están separados.**
Cuando JS cambia algo, avisa al de renderizado para que recalcule y pinte.

**8.** ¿Qué motor usa Chrome, Edge, Firefox y Safari? → Chrome, Edge, Brave y Opera usan
**Blink + V8**; Firefox, **Gecko + SpiderMonkey**; Safari, **WebKit + JavaScriptCore**.

**9.** ¿Qué navegador usa Chrome en iPhone? → **WebKit**, el de Safari, aunque se llame Chrome.
Lo obliga la tienda de Apple.

**10.** ¿Por qué Blink? → Chrome usó **WebKit** hasta **2013**, cuando Google copió el proyecto
y lo desarrolló aparte como **Blink**.

**11.** ¿Cuáles son los cuatro pasos del renderizado? → **DOM y CSSOM → Render Tree → Layout →
Paint.**

**12.** ¿Qué queda fuera del Render Tree? → Lo que no ocupa espacio visual: el propio
**`<head>`** y los elementos con **`display: none`**.

**13.** ¿Qué pasa si un script es muy pesado? → El navegador **detiene el análisis del HTML**
mientras lo descarga y ejecuta, y la pantalla **se queda en blanco** un instante.

**14.** ¿Qué muestra el panel de Consola y qué más hace? → Las salidas de `console.log()` **y
resalta en rojo las excepciones y errores no capturados**.

**15.** ¿Qué significa DOM y BOM? → **DOM** es el árbol en memoria RAM de los elementos de la
página; **BOM** son los objetos del navegador, cuya raíz es **`window`**.

**16.** ¿`document` es hermano de `window` o propiedad suya? → **Propiedad**: `document` es
`window.document`.

**17.** ¿Son iguales `alert("x")` y `window.alert("x")`? → **Sí, son idénticas**, por el
ámbito global: lo declarado con `var` arriba pasa a formar parte de `window`.

**18.** ¿Cuánto mide una cookie? → **Hasta 4 KB**, y se envían al servidor en cada petición.
`localStorage` guarda de 5 a 10 MB.

**19.** ¿Cuál es la diferencia entre `innerHTML` y `textContent`? → `innerHTML` interpreta
marcado (y por eso es vulnerable a **XSS**); `textContent` inserta **texto plano**, es más
rápido e inmune a inyecciones.

**20.** ¿Qué pasa si llamas a `document.write()` después de que la página ha cargado? → **Borra
de forma irreversible todo el documento** y solo queda lo escrito en esa llamada.

**21.** ¿Qué efecto tiene `alert()`? → Es **síncrono y bloqueante**: congela el hilo principal
de JavaScript, se detienen las animaciones y la página no atiende ningún otro evento.

**22.** ¿Por qué `style.font-size` no funciona? → El guion es la **resta** en JavaScript. Se
convierte a **camelCase**: `style.fontSize`, `style.backgroundColor`, `style.marginTop`.

**23.** ¿Qué diferencia hay entre reflow y repaint? → **Reflow** recalcula geometría y
desplaza lo que rodea (cambia tamaño o posición); **repaint** solo cambia píxeles sin mover nada
(`color`, `backgroundColor`). El reflow es el caro.

---

### Lenguajes y frameworks (1.3)

**24.** ¿HTML es un lenguaje de programación? → **No.** Es un lenguaje de marcado por etiquetas.

**25.** ¿Qué es ECMAScript? → La **especificación estándar (ECMA-262)** del lenguaje.
JavaScript es una implementación de ese estándar.

**26.** ¿Quién creó JavaScript y en cuánto tiempo? → **Brendan Eich, en 10 días**, en 1995
para Netscape. Nació como Mocha, luego LiveScript.

**27.** ¿Qué fue JScript? → La **implementación propia de Microsoft** para Internet Explorer 3.0
(1996), hecha por ingeniería inversa. Desató la primera guerra de navegadores.

**28.** ¿Qué pasó con ES4? → **Se abandonó**, por excesiva complejidad y falta de consenso. Su
sustituto fue **Harmony**, y de ahí salió **ES5**.

**29.** ¿Quién acuñó el término AJAX y en qué año? → **Jesse James Garrett, en 2005.** Usa
`XMLHttpRequest`.

**30.** ¿Qué trajo ES5 (2009)? → Modo estricto, métodos funcionales de array (`forEach`,
`map`, `filter`, `reduce`, `some`, `every`), `JSON.parse`/`stringify`, getters y setters,
`Object.freeze`, `Object.keys`.

**31.** ¿Qué es Node.js? → El entorno que **Ryan Dahl creó sobre el motor V8** (2009) para
llevar JavaScript al back-end.

**32.** ¿Qué es el DOM virtual? → Una **copia ligera del DOM en RAM**; el framework calcula
las diferencias mínimas (reconciliación) y actualiza solo los nodos necesarios.

**33.** ¿JSX es un lenguaje? → **No**, es una extensión de JavaScript que permite escribir
marcado parecido a HTML dentro del código.

**34.** ¿Quién mantiene Angular y en qué lenguaje se programa? → **Google**, en **TypeScript**,
con **RxJS** e inyección de dependencias.

---

### Scripts (1.4)

**35.** ¿JavaScript es compilado? → **Se interpreta**, pero los motores modernos aplican
**compilación JIT** a las funciones que se ejecutan muchas veces. Decir que nunca se compila
es **falso**.

**36.** ¿Cuál es la diferencia clave con los lenguajes tradicionales? → La traditional se
**compila antes** (si hay error, no se genera el binario); el script **se interpreta línea a
línea** y sus errores aparecen **en tiempo de ejecución**.

**37.** ¿PHP es un lenguaje tradicional o de script? → **De script**, aunque se ejecute en el
servidor.

**38.** ¿JavaScript se ejecuta solo en el navegador? → **No.** También en **Node.js** en
consola, y se puede empaquetar con **pkg** o **Electron** para hacerlo standalone. Python
también, con PyInstaller.

**39.** ¿Qué significa que un script reutiliza componentes preexistentes? → Que **se apoya en el
sistema anfitrión** (el DOM, el motor gráfico, las llamadas de red del navegador) en lugar de
construirlos desde cero.

**40.** ¿JavaScript es fuerte o débilmente tipado? → **Débilmente tipado y dinámico.**
**Java es fuertemente tipado.**

**41.** ¿Cuál es la desventaja de seguridad del código de cliente? → Viaja al cliente como **texto
plano**, así que **cualquier usuario puede leerlo**.

**42.** ¿Qué es la época Unix? → El **1 de enero de 1970 a las 00:00:00 UTC**. Un `Date` guarda
los **milisegundos** transcurridos desde ese instante. Un día son **86 400 000 ms**.

**43.** ¿Con qué número empieza `new Date(2026, 8, 28)`? → **Septiembre**, porque **los meses
van de 0 a 11** (enero = 0). Los días sí van de 1 a 31.

**44.** ¿Qué hace `new Date(2026)`? → **NO es el año 2026**: son **2026 milisegundos** después
de 1970. Para el año hay que escribir `new Date(2026, 0, 1)`.

**45.** ¿Y `new Date(95, 5, 15)`? → **15 de junio de 1995**, porque un año entre 0 y 99 se
interpreta como **siglo XX**.

**46.** ¿Qué pasa con `new Date(2026, 15, 20)`? → **Desbordamiento automático**: 15 meses = un
año y 3 meses, así que **abril de 2027**. Igual con `new Date(2026, 5, 35)` → 5 de julio.

**47.** ¿Qué devuelve `getDay()`? → El **día de la semana**, con **0 = domingo** y 6 = sábado.
No es el día del mes: ese es `getDate()`.

**48.** Para guardar una fecha en una base de datos, ¿qué método se usa? → **`toISOString()`**,
porque devuelve **UTC**. `toString()` usa la zona horaria local.

---

### Integración (1.5) — **las más preguntadas**

**49.** ⚠️ **Si pongo un `<script>` dentro del `<head>`, ¿qué ocurre?** → El navegador **detiene
el análisis del HTML** hasta que el script se ejecute. Como el `<body>` está más abajo, **sus
elementos todavía no existen en el DOM**. Si el script llama a
`document.getElementById(...)`, devuelve **`null`** y salta
`TypeError: Cannot read properties of null`. **Solución:** al final del `<body>`, con
**`defer`**, o con `DOMContentLoaded`.

**50.** ⚠️ **Entonces, ¿es incorrecto poner siempre el script en el `<head>`?** → **No.** Si
eso es **una declaración de función** y la llamada está en el `<body>`, **funciona**. Declarar
no es ejecutar: en el `<head>` solo se crea el nombre en memoria.

**51.** ⚠️ **¿`defer` y `async` sirven en un `<script>` embebido?** → **No.** Solo afectan a
scripts **externos** (con `src`). En un `<script>` embebido **no hacen nada**.

**52.** ⚠️ **¿`defer` o `async`?** → `defer` espera a que **termine de parsearse el HTML** y
**respeta el orden** de los scripts. `async` se ejecuta **en cuanto termina la descarga** y
**no respeta el orden**. Para código que necesita el DOM, `defer`.

**53.** ¿Se puede cerrar el `<script>` como `<script src="x.js" />`? → **No.** HTML no es XML.
**El resto de la página no se mostraría.** Siempre `</script>`.

**54.** ¿Hay que escribir `type="text/javascript"`? → **No es necesario** en HTML5. Se acepta
por compatibilidad hacia atrás, pero es opcional.

**55.** ¿Código embebido o ficheros externos? → **Externos**, por **caché** (se descarga una
vez y se reutiliza), **mantenimiento** (se toca un archivo) y **separación de trabajo**. El
embebido solo para unas pocas líneas de una página que nunca cambia. El **efecto visual es
idéntico** en ambos casos.

**56.** `addEventListener('click', cambiar())`: ¿qué falla? → Los paréntesis hacen que la
función **se ejecute al cargar la página** y el clic no hará nada. Se pasa la **referencia**:
`addEventListener('click', cambiar)`. En el atributo HTML es al revés: `onclick="cambiar()"`.

**57.** El `.js` da **404** en el panel Red. ¿Por qué? → La **ruta** del `src` no incluye la
carpeta. En un proyecto bien organizado es `./js/logica.js`. El `.js` correcto debe devolver
**200 OK**.

---

### Herramientas (1.6)

**58.** ¿VS Code o VSCodium? → Se ven igual; la diferencia es la **licencia** y la
**telemetría**. VSCodium es el mismo código fuente compilado limpio, **sin telemetría**.

**59.** ¿Qué es un *breakpoint* y cuándo no funciona? → Un punto de **interrupción** en una
línea. Solo se activa si **la ejecución pasa por esa línea**: si está dentro de un `if` que no
se cumple, nunca se alcanza.

**60.** ¿Qué extension recarga el navegador al guardar? → **Live Server.**

**61.** ¿Qué extension ejecuta el JS dentro del editor y muestra el resultado junto a la línea?
→ **Quokka.js.**

**62.** ¿Qué extension muestra el mensaje de error completo con fondo rojo? → **Error Lens.**

**63.** ¿Qué diferencia hay entre Git y GitHub? → **Git** es el sistema de control de versiones
**distribuido** que registra el historial. **GitHub** es la **plataforma en la nube** que aloja
los repositorios, con *pull requests*, *issues* e integración continua.

**64.** ¿Qué significa "editor" y qué es un "IDE"? → Un **editor** solo escribe texto; un **IDE**
añade depurador, refactorización, indexación del proyecto y gestión de dependencias.

---

## 8. Chuletas de una línea

- **La luz se dibuja en el cliente, los datos viven en el servidor.**
- **El render engine y el JS engine son motores distintos.**
- **Cscript y CSSOM, DOM + CSSOM → Render Tree → Layout → Paint.**
- **Un `Date` es un objeto, y son milisegundos desde 1970.**
- **Los meses van de 0 a 11; los días de 1 a 31.**
- **Un solo número en `new Date()` son milisegundos, nunca el año.**
- **`defer` espera al HTML y respeta el orden; `async` va en cuanto llega y no respeta el orden.**
- **`defer` y `async` solo funcionan con scripts externos.**
- **En el `head` no existe el `body`: por eso falla `getElementById`.**
- **`-` en CSS es `+` en JS: `font-size` → `fontSize`.**
- **`console.log()` no lo ve el usuario final.**
- **`document.write()` después de cargar borra la página.**
- **El código del cliente es público: nunca claves ni validaciones críticas ahí.**