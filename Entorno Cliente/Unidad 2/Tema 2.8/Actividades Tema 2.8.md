### 1. Los tres fallos del laboratorio

El laboratorio reparte tres errores en `depurador_lab.js`. Ninguno de los tres
es un `SyntaxError`: el script arranca y el botón responde, así que solo se ven
depurando. Son **errores de lógica** y de **ámbito**.

| # | Fallo en el código | Qué provoca | Cómo se detecta | Corrección |
|---|---|---|---|---|
| 1 | `const unidades = document.getElementById("campoUnidades").value;` | `unidades` es el texto `"5"`, no el número `5`. El `*` de la fórmula lo convierte solo, así que con un valor limpio la cuenta sale bien; el problema aparece cuando el campo lleva algo que no es un número, porque el resultado se vuelve `NaN` sin avisar. | En el panel **Scope**, dentro de `procesarLote`, `unidades` aparece entre comillas: `"5"`. | `Number(...)` al leer el campo. |
| 2 | `acumuladoTotal = 0;` | La variable no está declarada, así que se crea en el objeto global `window`. Es una **fuga de ámbito**: cualquier otro script de la página puede leerla o pisarla. Además, con `"use strict"` habría dado un `ReferenceError` en vez de colarse. | En **Scope → Global** aparece `acumuladoTotal`, y la propia página lo confirma al final: «¿Se contaminó window?: SÍ (Fuga)». | `"use strict";` al principio del archivo y `let acumuladoTotal` dentro de la función. |
| 3 | `for (let i = 0; i <= lotes.length; i++)` | El array tiene 5 elementos (índices 0 a 4). Con `<=` el bucle llega a `i = 5`, `lotes[5]` es `undefined` y `sumaLotes` pasa a `NaN`. El total final también sale `NaN`. | Añadiendo `lotes[i]` a **Watch** y avanzando con F10: en la vuelta `i = 5` el valor es `undefined` y la suma se rompe. | Cambiar `<=` por `<`. |

Los dos primeros no dan ningún mensaje rojo en la consola: son errores silenciosos.
El tercero tampoco avisa, solo deja un `NaN` en pantalla. Ese es justo el motivo
de usar puntos de interrupción en lugar de fiarse de mirar la consola.

### 2. Qué hay en la carpeta y cómo se abre

| Fichero | Para qué sirve |
|---|---|
| `index.html` | La página del laboratorio: dos campos, dos botones, el visor de salida y la zona que se modifica. |
| `estilos.css` | Los estilos del panel. Van aparte para no mezclar CSS con el HTML, como en el resto de temas. |
| `depurador_lab.js` | El código **defectuoso a propósito**, tal como lo da el enunciado. Es el que se abre en el vídeo. |
| `depurador_lab_corregido.js` | El mismo código ya arreglado, con los tres cambios marcados como `// FIX:`. Sirve para el antes y el después. |

No hace falta servidor: se abre `index.html` con doble clic y funciona, porque
todo es local. Los `debugger` y los breakpoints funcionan igual con `file://`.

Para usar la versión corregida, se cambia la última línea del `index.html`:

```html
<script src="depurador_lab_corregido.js"></script>
```

### 3. Guion del vídeo (4 fases)

La entrega de este criterio es un **vídeo individual de 5 minutos como máximo,
continuo y con audio**. Este apartado es el guion de lo que hay que grabar y
explicar; el vídeo hay que grabarlo y subirlo a Moodle.

Antes de empezar: abrir `index.html`, pulsar F12, dejar abiertas las pestañas
**Sources** y **Elements** y comprobar que en **Sources** está cargado
`depurador_lab.js`.

#### Fase 1 — Ámbitos y control paso a paso (F10 / F11)

1. Pulsar «1. Ejecutar y Depurar Algoritmo». La ejecución se para sola en
   `debugger`.
2. Abrir el panel **Scope** y explicar dos cosas: `unidades` es el texto `"5"`
   (con comillas) y `acumuladoTotal` no está declarada, se está yendo a
   `window`.
3. Corregir en directo: envolver la lectura en `Number(...)` y poner
   `"use strict";` arriba con `let acumuladoTotal` dentro de la función.
4. Con **F10** (Step Over) avanzar hasta la llamada a `calcularRecargo`, entrar
   con **F11** (Step Into), ver `FACTOR_AJUSTE` y salir con **Shift + F11**
   (Step Out).

#### Fase 2 — Watch y punto de interrupción condicional

1. Añadir `lotes[i]` a la pestaña **Watch**. Avanzar con F10 hasta `i = 5` y
   enseñar que vale `undefined`, que la suma pasa a `NaN` y que el total también.
2. Parar, corregir `<=` por `<` y volver a ejecutar para comprobar que
   `sumaLotes` vale 150.
3. En la línea `contadorAuditoria += 1;`, clic derecho en el número de línea →
   **Add conditional breakpoint…** → escribir `k === 7420`.
4. Pulsar **F8** (Resume): el navegador no se queda colgado en las 10.000
   vueltas, se para exactamente cuando `k` vale 7420.

#### Fase 3 — Depuración por mutaciones del DOM

1. Ir a **Elements**, localizar `<div id="zonaMonitorizada">`, clic derecho →
   **Break on** y activar las tres opciones: *Subtree modifications*,
   *Attribute modifications* y *Node removal*.
2. Volver a la página y pulsar «2. Provocar Mutación DOM».
3. Enseñar cómo el depurador congela el hilo justo en la línea que hace
   `setAttribute`, la que añade el párrafo y la que elimina el nodo.

#### Fase 4 — Event Listener Breakpoints

1. Desactivar los breakpoints anteriores.
2. En **Sources**, desplegar **Event Listener Breakpoints** → **Mouse** y marcar
   **click**.
3. Hacer clic en cualquiera de los dos botones y comprobar que el depurador se
   para en la primera línea del manejador sin haber puesto un breakpoint a mano.

### 4. Rúbrica de autoevaluación

Se marca después de grabar, viendo el vídeo: si un indicador no aparece, no
cuenta. Cada bloque vale 10 puntos (cuatro indicadores de 2,5).

**Bloque 1 — Control de flujo y ámbitos**

- [ ] Se ve la parada en `debugger` y se explica el panel **Scope**.
- [ ] Se identifica que `unidades` es un `String` y se corrige con `Number()`.
- [ ] Se activa `"use strict";` y se declara `acumuladoTotal` con `let`.
- [ ] Se usan F10, F11 y Shift + F11 explicando qué hace cada uno.

**Bloque 2 — Watch y breakpoint condicional**

- [ ] Se sigue `lotes[i]` en **Watch** y se ve el `undefined` con `i = 5`.
- [ ] Se corrige el bucle de `<=` a `<` y desaparece el `NaN`.
- [ ] Se configura el breakpoint condicional `k === 7420`.
- [ ] Con F8 se comprueba que solo se para en esa vuelta.

**Bloque 3 — Breakpoints avanzados**

- [ ] Se activan las tres opciones de **Break on** en `#zonaMonitorizada`.
- [ ] Se captura la mutación del DOM en la línea exacta de JavaScript.
- [ ] Se activa **Event Listener Breakpoints → Mouse → click**.
- [ ] Se explica cómo se captura el clic sin breakpoint manual.

**Calificación final:** media de los tres subtotales.
