# Guion y paso a paso del vídeo — Tema 2.8

Documento de preparación para grabar la entrega del Tema 2.8: un **vídeo
individual de 5 minutos como máximo, continuo y con audio**, que se sube a la
tarea de Moodle. Este documento complementa `Actividades Tema 2.8.md` (donde
está el análisis de los tres fallos y la rúbrica); aquí está el paso a paso
técnico, la explicación de cada línea de código y el guion palabra por palabra
con sus tiempos.

---

## 1. Lo que se va a demostrar (y por qué)

La entrega pide demostrar que sabes usar las herramientas de depuración del
navegador para localizar errores que **no avisan en la consola**. El
laboratorio reparte tres fallos en `depurador_lab.js`:

1. `unidades` se lee como **texto** y no como número.
2. `acumuladoTotal` se usa **sin declarar** y se fuga al objeto global `window`.
3. El bucle de `lotes` usa `<=` y llega a `lotes[5]`, que no existe → `NaN`.

Ninguno de los tres es un `SyntaxError`: el script arranca, el botón responde
y la página se ve normal. Solo con puntos de interrupción, el panel Scope,
Watch y los breakpoints avanzados se descubren. Esa es la tesis del vídeo: *«la
consola no siempre avisa; hay que depurar de verdad»*.

---

## 2. Preparación antes de grabar (15 minutos)

### 2.1 Puesta a punto de la carpeta

- [ ] La carpeta del laboratorio es `2-DAW\Entorno Cliente\Unidad 2\Tema 2.8\`.
      Tiene que quedar así para grabar:

| Fichero | Estado para la grabación |
|---|---|
| `index.html` | Cargando `depurador_lab.js` (el **defectuoso**). Comprueba la última línea del `<body>`: `<script src="depurador_lab.js"></script>` |
| `depurador_lab.js` | El original a propósito. **No tocarlo.** Las correcciones se hacen en directo delante de la cámara |
| `depurador_lab_corregido.js` | Abierto al lado en el editor, para consultarlo pero **sin** cargarlo en la página |
| `index.html` / `estilos.css` | Tal cual, sin cambios |

> Si durante el ensayo corriges algo a mano, **recupera el original antes de
> grabar**: el vídeo tiene que enseñar el proceso de corrección en directo.

### 2.2 Ventanas y grabación

- [ ] **Editor** (VS Code o similar) a la izquierda con la carpeta abierta;
      **navegador (Edge o Chrome)** a la derecha, pantalla completa o media.
- [ ] Zoom del navegador al **125–150%** (`Ctrl + ++`): en el vídeo todo tiene
      que leerse sin apretar los ojos.
- [ ] **Modo concentración / no molestar**: sin notificaciones de correo ni de
      Windows durante los 5 minutos.
- [ ] Grabadora: **Win + G** (Xbox Game Bar) graba la ventana que tú elijas, o
      el grabador que prefieras. Grabación a 1080p. Haz una prueba de 10
      segundos y comprueba que se oye tu voz y se ve el cursor.
- [ ] Micrófono cerca; habla un poco más alto de lo normal.

### 2.3 DevTools preparadas

- [ ] Abre `index.html` con doble clic (funciona con `file://`, no hace falta
      servidor) y pulsa **F12**.
- [ ] Desacopla las DevTools si hace falta para que ocupen media pantalla.
- [ ] Deja abiertas las pestañas **Sources** (con `depurador_lab.js` cargado y
      visible) y **Elements** (con `#zonaMonitorizada` localizado).
- [ ] En **Sources**, abre los paneles laterales **Scope** y **Watch** y
      **Event Listener Breakpoints** (están en el lateral derecho; si no se
      ven, clic derecho en la barra → activarlos).

### 2.4 Ensayo

- [ ] Recorre el guion completo una vez sin grabar, con cronómetro. Si te pasas
      de 5 minutos, el recorte fácil es la Fase 4 (es la más corta de explicar).
- [ ] Ten a mano la rúbrica de `Actividades Tema 2.8.md`: cada indicador tiene
      que verse en el vídeo.

---

## 3. Entender el código (lo que tienes que poder explicar)

Antes de grabar, esto es lo que hace cada trozo de `depurador_lab.js`. Si
entiendes esto, cualquier pregunta del profesor te la defiendes.

### 3.1 `calcularRecargo(base)` — la función "trampa fácil"

```js
function calcularRecargo(base) {
  const FACTOR_AJUSTE = 1.05;
  return base * FACTOR_AJUSTE;
}
```

- Es la excusa del laboratorio para practicar **F11 (Step Into)**: al llegar a
  la llamada, entra dentro y enseñas que `FACTOR_AJUSTE` es una constante
  **local** (vive y muere dentro de la función, por eso va en mayúsculas y con
  `const`).
- `base * 1.05` = sube un 5%. No tiene ningún fallo; es la función "amiga".

### 3.2 `procesarLote()` — aquí viven los tres fallos

```js
const unidades = document.getElementById("campoUnidades").value;
const precioBase = Number(document.getElementById("campoPrecio").value);
```

- **Fallo 1** está en la primera línea. `.value` de un `<input>` devuelve
  **siempre un string**, aunque el usuario haya escrito un número. En el HTML
  el campo viene con `value="5"`, así que `unidades` vale `"5"` **con
  comillas**. Fíjate en el contraste: la línea de abajo sí envuelve con
  `Number(...)`, y esa no falla. El enunciado hace esto a propósito para que se
  compare línea a línea.
- ¿Por qué da igual… de momento? Porque `"5" * 1.05` convierte el texto solo
  (JavaScript hace coerción en las multiplicaciones). El error sale cuando
  alguien escribe otra cosa en el campo: entonces el resultado se vuelve `NaN`
  **sin ningún aviso rojo en la consola**. En el vídeo se enseña con el panel
  Scope: se ve `unidades: "5"` entre comillas.

```js
acumuladoTotal = 0;
```

- **Fallo 2.** No hay `let`, `const` ni `var`. En JavaScript eso crea una
  variable **global de facto**: se cuelga de `window`. Se llama **fuga de
  ámbito**: cualquier otro script de la página puede leerla o pisarla. La
  propia página lo confirma al final: «¿Se contaminó window?: SÍ (Fuga)».
- Bonus para el vídeo: con `"use strict";` arriba del archivo, esa misma línea
  deja de colarse y lanza un `ReferenceError`. Se ve en directo (se explica en
  la fase 1).

```js
debugger;
```

- Es una sentencia, no un breakpoint de ratón: cuando las DevTools están
  abiertas, la ejecución **se para justo aquí** al llegar. Es lo que hace que
  el botón 1 paré solo y puedas empezar a explicar el Scope.

```js
const lotes = [10, 20, 30, 40, 50];
let sumaLotes = 0;
for (let i = 0; i <= lotes.length; i++) {
  sumaLotes += lotes[i];
}
```

- **Fallo 3.** El array tiene 5 elementos: índices **0 a 4**. Con `<=` el bucle
  da una vuelta de más y llega a `i = 5`, donde `lotes[5]` es `undefined`.
  `sumaLotes += undefined` convierte la suma entera en `NaN`, y el `NaN` se
  arrastra al total final. Es el clásico **off-by-one**. En el vídeo se sigue
  con Watch: `lotes[i]` vale `undefined` en la vuelta 5, y después de corregir
  a `<`, `sumaLotes` vale 150 (10+20+30+40+50).

```js
let contadorAuditoria = 0;
for (let k = 0; k < 10000; k++) {
  contadorAuditoria += 1;
}
```

- Este bucle **no tiene ningún fallo**: 10.000 vueltas para practicar el
  **breakpoint condicional**. Si pones un breakpoint normal en esa línea, se
  para 10.000 veces. Con la condición `k === 7420` y **F8** (Resume), solo para
  exactamente en esa vuelta. Es la demo de "cómo depurar un bucle enorme sin
  volverte loco".

```js
acumuladoTotal = (precioConRecargo * unidades) + sumaLotes;
visor.innerHTML = `...`;
```

- La fórmula final mezcla todo: el precio con recargo por las **unidades**
  (aquí es donde el fallo 1 contamina si el campo no es numérico) más la suma
  de lotes (contaminada por el fallo 3).
- El visor se rellena con un **template literal** (comillas invertidas, con
  `${...}`) y `toFixed(2)` para los decimales. La última línea del visor,
  `typeof window.acumuladoTotal !== "undefined"`, es el detector de la fuga:
  si la variable está en `window`, es que se ha colado como global.

### 3.3 `alterarEstructuraDOM()` — la función del botón 2

```js
contenedor.setAttribute("data-estado", "actualizado");   // modifica un ATRIBUTO
const nuevoElemento = document.createElement("p");
contenedor.appendChild(nuevoElemento);                    // modifica el SUBÁRBOL
if (nodo) { nodo.remove(); }                              // elimina un NODO
```

- Hace exactamente **las tres clases de mutación** que pide el enunciado
  capturar con *Break on*: atributo, subárbol y eliminación de nodo. Por eso
  hay que marcar las tres opciones en `#zonaMonitorizada`: el depurador se
  congelará una vez por cada una, y en cada parada la pila te lleva a la línea
  de JavaScript que lo provocó.
- `if (nodo)` es porque `remove()` sobre algo que ya se eliminó daría error: la
  primera vez borra el nodo, y si vuelves a pulsar el botón ya no existe.

### 3.4 Las dos últimas líneas

```js
document.getElementById("btnEjecutar").addEventListener("click", procesarLote);
document.getElementById("btnModificarDOM").addEventListener("click", alterarEstructuraDOM);
```

- Conectan los botones con sus funciones. Para la **Fase 4** son clave: con
  **Event Listener Breakpoints → Mouse → click**, el depurador se para en la
  primera línea del manejador **sin haber puesto ningún breakpoint a mano** —
  es como decir "para me en cualquier función que se ejecute por un clic".

---

## 4. Guion del vídeo, fase a fase (con tiempos y qué decir)

> Entre paréntesis va lo que puedes decir casi literal. Los tiempos suman ~4:50
> de los 5 minutos: en el ensayo, recorta donde se te trabe la lengua, no
> improvises frases nuevas.

### Apertura — 0:00 a 0:25

En pantalla: `index.html` cargado, F12 abierto en Sources.

> «Soy Javier, de 2º DAW. Esta es la entrega de depuración del Tema 2.8. Tengo
> cargado el laboratorio con su código defectuoso a propósito y las DevTools
> abiertas en Sources, donde ya está `depurador_lab.js`. Voy a enseñar tres
> errores que no avisan en la consola y a corregirlos en directo con las
> herramientas del navegador.»

### Fase 1 — Ámbitos y control paso a paso — 0:25 a 1:45

1. Pulsa el botón **«1. Ejecutar y Depurar Algoritmo»**. La ejecución se para
   sola en la línea del `debugger;`.
2. Enseña el panel **Scope** y señala dos cosas (0:35):
   > «Mira el panel Scope: `unidades` vale `"5"` **entre comillas**, es un
   > string. El `.value` de un input devuelve texto, no número. Y aquí abajo,
   > `acumuladoTotal` no está en el ámbito local: está colgado de window, es
   > una variable global que no he declarado.»
3. Corrige en directo en el editor (0:55): envuelve la lectura con `Number(...)`
   y guarda el archivo.
4. (Opcional, muy rentable, 20 s): añade **solo** `"use strict";` arriba del
   archivo, guarda, recarga con F5 y vuelve a pulsar el botón:
   > «Con modo estricto, la misma línea ya no se cuela: mira el error
   > ReferenceError en la consola. Ahora la declaro bien con `let` dentro de la
   > función… y ya funciona.» (quita el ReferenceError añadiendo
   > `let acumuladoTotal = 0;`)
5. Sigue con **F10** (Step Over) hasta la línea de `calcularRecargo(precioBase)`
   y explica (1:25):
   > «F10 avanza sin entrar en las funciones. Aquí quiero ver dentro: **F11**,
   > Step Into.»
6. Dentro de `calcularRecargo` enseña `FACTOR_AJUSTE` y sale con
   **Shift + F11** (Step Out):
   > «La constante vive solo dentro de la función. Con Shift+F11 salgo y vuelvo
   > a mi función principal.»

### Fase 2 — Watch y breakpoint condicional — 1:45 a 3:05

1. Continúa con F10 hasta la línea `sumaLotes += lotes[i];` (si la ejecución ya
   terminó, pulsa el botón otra vez; se para en el `debugger`).
2. Selecciona `lotes[i]` en el código, clic derecho → **Add to Watch** (1:55):
   > «He puesto `lotes[i]` en el Watch. Voy avanzando con F10 y miro cómo
   > cambia.»
3. En la vuelta `i = 5` paras un momento:
   > «El array tiene 5 elementos, del índice 0 al 4. El bucle dice `i <=
   > lotes.length`, es decir, llega hasta 5. En la vuelta 5, `lotes[i]` vale
   > `undefined`… y la suma entera se ha convertido en `NaN`. Sin ningún error
   > en la consola.»
4. Corrige en el editor `<=` por `<`, guarda, recarga (F5) y repite la
   ejecución (2:25):
   > «Con `<` en vez de `<=` la última vuelta es la 4. Ahora `sumaLotes` vale
   > 150, que son los cinco lotes. Y el total final ya no sale NaN.»
5. Breakpoint condicional (2:40): clic derecho en el número de la línea
   `contadorAuditoria += 1;` → **Add conditional breakpoint…** → escribe
   `k === 7420` y Enter.
6. Pulsa el botón y, al parar en el `debugger`, dale a **F8** (Resume):
   > «Este bucle da 10.000 vueltas. Un breakpoint normal me pararía en todas.
   > He puesto la condición `k === 7420`, así que con F8 el navegador solo se
   > para exactamente en esa vuelta. Míralo: k vale 7420.»

### Fase 3 — Depuración por mutaciones del DOM — 3:05 a 4:05

1. Ve a **Elements**, localiza `<div id="zonaMonitorizada">`, clic derecho →
   **Break on** y activa las **tres** opciones: *Subtree modifications*,
   *Attribute modifications* y *Node removal* (3:10).
   > «He pedido que el depurador se pare cada vez que esta zona del DOM
   > cambie: si se modifica un atributo, si entra o sale un nodo del subárbol,
   > o si se elimina un nodo.»
2. Desactiva los breakpoints de Sources anteriores (clic en el símbolo de
   desactivar breakpoints o quita el condicional).
3. Vuelve a la página y pulsa **«2. Provocar Mutación DOM»** (3:30). El
   depurador congela el hilo en cada una de las tres mutaciones; en cada parada
   dale a F8 para la siguiente y señala:
   > «Primera parada: estoy en el `setAttribute`, que modifica un atributo.
   > Segunda: el `appendChild`, que inyecta el párrafo nuevo. Tercera: el
   > `remove()`, que elimina el nodo. El depurador me ha llevado a la línea
   > exacta de JavaScript que ha tocado el DOM, sin buscarla a mano.»

### Fase 4 — Event Listener Breakpoints — 4:05 a 4:40

1. Quita los breakpoints de DOM (menú **Break on** → dejas las opciones sin
   marcar).
2. En **Sources**, en el panel derecho, despliega **Event Listener
   Breakpoints → Mouse** y marca **click** (4:10):
   > «Ahora pido que se pare en cualquier código que se ejecute por un clic,
   > aunque no tenga ni un solo breakpoint puesto a mano.»
3. Haz clic en cualquiera de los dos botones de la página (4:20):
   > «Y ahí está: el depurador se ha parado en la primera línea del manejador,
   > la función `procesarLote`, solo porque marqué el evento click. Esto sirve
   > para averiguar quién está escuchando un evento cuando el código es de otra
   > persona.»

### Cierre — 4:40 a 4:55

> «Resumen: los tres fallos del laboratorio no daban ningún error en la
> consola. Los saqué con el panel Scope, con Watch, con breakpoints
> condicionales y con los breakpoints de DOM y de eventos, y las correcciones
> quedan en `depurador_lab_corregido.js`, marcadas con FIX. Fin de la
> entrega.»

---

## 5. Rúbrica → dónde queda cubierta en el vídeo

| Bloque | Indicador | Minuto aproximado |
|---|---|---|
| 1 | Parada en `debugger` + panel Scope | 0:25–0:55 |
| 1 | `unidades` string corregido con `Number()` | 0:50–0:55 |
| 1 | `"use strict";` + `let acumuladoTotal` | 1:05–1:25 |
| 1 | F10 / F11 / Shift+F11 explicados | 1:25–1:45 |
| 2 | `lotes[i]` en Watch, `undefined` con `i=5` | 1:55–2:25 |
| 2 | `<=` → `<`, desaparece el `NaN` (150) | 2:25–2:40 |
| 2 | Breakpoint condicional `k === 7420` | 2:40–3:05 |
| 3 | Break on con las tres opciones | 3:05–3:30 |
| 3 | Mutación capturada en la línea exacta | 3:30–4:05 |
| 4 | Event Listener Breakpoints → click | 4:05–4:40 |

Después de grabar, mira tu propio vídeo marcando esta tabla: si un indicador
no aparece o no se oye la explicación, regraba. **El vídeo es continuo**: si
falla algo a mitad, se regraba entero, no se edita.

## 6. Entrega

1. Revisa el vídeo con la rúbrica (sección 5).
2. Súbelo a la tarea **«2.8. Herramientas y entornos…»** de Moodle. Si el
   fichero de vídeo pesa demasiado, comprime la resolución a 720p antes que
   recortar contenido.
3. Confirma en Moodle que aparece como *Enviado para calificar* (la tarea ya
   estaba vencida: cuanto antes, mejor).
