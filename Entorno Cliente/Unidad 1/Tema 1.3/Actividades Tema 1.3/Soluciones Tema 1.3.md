# Ejercicios Tema 1.3 — Principales lenguajes de programación de clientes Web

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Fecha: 29/09/2026
> Base: Actividades Prácticas y de Consolidación del tema 1.3 (apartado G del temario)

---

## Estructura de archivos

```
Actividades Tema 1.3\
├── Ejercicio 1\          La tríada HTML / CSS / JS  (index.html + estilos.css + script.js)
├── Ejercicio 2\          Formas de declarar funciones y hoisting
├── Ejercicio 3\          Los ejercicios del 1.2 rehacidos con funciones
├── Ejercicio 4\          Programación reactiva: la hoja de cálculo
├── Ejercicio 5\          DOM Virtual y reconciliación
├── Ejercicio 6\          Programación orientada a componentes
├── Ejercicio 7\          Cronología de JavaScript y ECMAScript
├── Ejercicio 8\          Comparativa de frameworks
└── Ejercicio 9\          Test de vocabulario técnico
```

Todos los ejercicios se abren directamente en el navegador (doble clic sobre el `index.html`; el ejercicio 1 tiene tres ficheros que deben **mantenerse juntos** en la misma carpeta). Para ver las trazas hay que abrir **F12 → Console**.

---

## Índice

1. [Ejercicio 1 — La tríada fundamental: HTML, CSS y JavaScript](#ejercicio-1--la-tríada-fundamental-html-css-y-javascript)
2. [Ejercicio 2 — Formas de declarar funciones y hoisting](#ejercicio-2--formas-de-declarar-funciones-y-hoisting)
3. [Ejercicio 3 — Los ejercicios del 1.2 rehacidos con funciones](#ejercicio-3--los-ejercicios-del-12-rehechos-con-funciones)
4. [Ejercicio 4 — Programación reactiva: la hoja de cálculo](#ejercicio-4--programación-reactiva-la-hoja-de-cálculo)
5. [Ejercicio 5 — DOM Virtual y reconciliación](#ejercicio-5--dom-virtual-y-reconciliación)
6. [Ejercicio 6 — Programación orientada a componentes](#ejercicio-6--programación-orientada-a-componentes)
7. [Ejercicio 7 — Cronología de JavaScript y ECMAScript](#ejercicio-7--cronología-de-javascript-y-ecmascript)
8. [Ejercicio 8 — Comparativa de frameworks](#ejercicio-8--comparativa-de-frameworks)
9. [Ejercicio 9 — Test de vocabulario técnico](#ejercicio-9--test-de-vocabulario-técnico)

---

## Ejercicio 1 — La tríada fundamental: HTML, CSS y JavaScript

**Enunciado:** separar los tres lenguajes estándar en tres ficheros con responsabilidad independiente.

**Solución** (`Ejercicio 1\`, tres ficheros):

- `index.html` solo aporta la **estructura** y enlaza CSS y JS con `<link>` y `<script src>`.
- `estilos.css` solo aporta **presentación**, incluidos los dos temas (claro y oscuro) mediante la clase `.tema-oscuro`.
- `script.js` solo aporta **lógica**: el contador y la conmutación de clase.

```html
<!-- index.html: los tres ficheros enlazados, cada uno en su capa -->
<link rel="stylesheet" href="estilos.css">
...
<script src="script.js"></script>
```

```js
// script.js: JavaScript no conoce el color, solo alterna la clase que CSS define.
document.getElementById('modo').addEventListener('click', function () {
  document.body.classList.toggle('tema-oscuro');
});
```

```css
/* estilos.css: la presentación se define aquí, no desde JavaScript */
body.tema-oscuro { background-color: #1e1e1e; color: #e8e8e8; }
```

**Concepto clave:** CSS **no interviene en la lógica ni en los datos**; JS **no debería** llevar los colores escritos a mano, sino alternar clases. Esa separación es la base de los frameworks del apartado D.

---

## Ejercicio 2 — Formas de declarar funciones y hoisting

**Enunciado:** una función es un bloque de código reutilizable; se definen tres formas y solo una admite hoisting.

**Solución** (`Ejercicio 2\index.html`): un botón por forma y una traza emitida **delante de la definición** para demostrar el *hoisting*:

```js
// La traza se emite ANTES de definir nada: solo sobrevive por el hoisting.
console.log('[Ej2] Hoisting: ' + saludarTemprano('Ana'));

// A. Declaración tradicional: el motor la eleva al inicio del ámbito.
function saludar(nombre) { return 'Hola, ' + nombre; }
function saludarTemprano(nombre) { return saludar(nombre); }

// B. Expresión de función: asignada a una const, no se eleva.
const duplicar = function (numero) { return numero * 2; };

// C. Arrow functions: retorno implícito y un parámetro sin paréntesis.
const sumar = (a, b) => a + b;
const cuadrado = x => x * x;
```

**Concepto clave:** con `const duplicar = function ...` la llamada anterior a su definición lanzaría un `ReferenceError`, porque solo las **declaraciones** de función se izolan. Las flechas son la forma moderna y compacta, pero **no tienen `this` propio**, por lo que no pueden usarse como métodos.

---

## Ejercicio 3 — Los ejercicios del 1.2 rehacidos con funciones

**Enunciado:** «Realiza los ejercicios del apartado anterior haciendo uso de funciones».

**Solución** (`Ejercicio 3\index.html`): los tres ejercicios más representativos del 1.2, cada uno con una forma distinta de función:

| Del 1.2 | Enunciado | Forma de función usada |
|---|---|---|
| 1.2·4 | Saludos multidioma con color | Declaración tradicional |
| 1.2·1 | Modificar el `<p>` con `innerHTML` | Expresión de función |
| 1.2·7 | Consola / Estilo / Alerta | Funciones flecha |

```js
// A. Declaración tradicional: saludos multidioma.
function saludar(idioma) {
  const p = document.getElementById('saludo');
  p.innerHTML = saludos[idioma].texto;
  p.style.color = saludos[idioma].color;
}

// B. Expresión de función: el contenido del 1.2·1 dentro de una función.
const cambiarTexto = function () {
  document.getElementById('prueba').innerHTML = 'CAMBIANDO el contenido!';
};

// C. Flechas: los tres botones del 1.2·7, con retorno implícito.
const aConsola = () => console.log('[Ej3] Hora del sistema: ' + new Date().toLocaleTimeString());
const aEstilo  = () => { estado.innerHTML = 'Sistema Activo'; estado.style.backgroundColor = 'green'; };
const aAlerta  = () => window.alert('El proceso ha concluido.');
```

**Concepto clave:** la diferencia con el 1.2 es que el comportamiento **sale del atributo `onclick`**. El `onclick="saludar('ru')"` del 1.2·4 pasa a ser una simple llamada a la función `saludar`, que ya contiene la lógica.

---

## Ejercicio 4 — Programación reactiva: la hoja de cálculo

**Enunciado (Actividad Propuesta 1.1):** averiguar qué es la programación reactiva, investigando cómo se comporta una hoja de cálculo cuando modificas una celda y las celdas dependientes se recalculan de inmediato.

**Solución** (`Ejercicio 4\index.html`): un grafo de dependencias mínimo, con el mismo modelo que usa una hoja de cálculo:

```js
function crearDato(nombre, valor) {
  celdas[nombre] = { valor: valor, formula: null, suscriptores: [] };
}

function crearFormula(nombre, dependencias, calcular) {
  celdas[nombre] = { valor: 0, formula: calcular, suscriptores: [] };
  // Suscribe la celda a cada dependencia: así será notificada al cambiar.
  dependencias.forEach(function (dep) {
    celdas[dep].suscriptores.push(nombre);
  });
}

function notificar(nombre) {
  celdas[nombre].suscriptores.forEach(recalcular);   // propagación en cascada
}
```

La cadena montada es `A, B → C → D` y `A, B, C → Ctotal, Dtotal`. Al escribir en cualquier `input` de la fila A o B, el registro muestra el orden exacto de los recálculos.

Para el cálculo inicial se ordenan las celdas por su **nivel de dependencia** y se recalculan de abajo arriba, porque una fórmula necesita que sus dependencias ya tengan el valor definitivo:

```js
function nivel(nombre) {
  const celda = celdas[nombre];
  if (!celda.formula) { return 0; }               // los datos son nivel 0
  return 1 + Math.max.apply(null, celda.formula.args.map(nivel));
}

function recalcularTodo() {
  Object.keys(celdas)
    .sort(function (a, b) { return nivel(a) - nivel(b); })
    .forEach(recalcular);
}
```

**Comprobación:** con `A = 10, 20, 30` y `B = 4, 6, 8` la hoja muestra `C = 14, 26, 38`, `D = 7, 13, 19`, `Ctotal = 78` y `Dtotal = 13`. Al pasar `A1` a 100, solo se recalculan `C1 → 104`, `D1 → 52`, `Ctotal → 168` y `Dtotal → 28`, sin tocar el resto.

**Concepto clave:** una celda **no se recalcula porque alguien la avise**, sino porque está **suscrita** a las celdas de las que depende. Ese es el patrón reactivo: *flujos de datos que reaccionan de forma automática propagando los cambios en la interfaz cuando el estado varía*.

---

## Ejercicio 5 — DOM Virtual y reconciliación

**Enunciado:** simular la estrategia del DOM virtual: copia en RAM, diferencias mínimas y actualización solo de los nodos necesarios.

**Solución** (`Ejercicio 5\index.html`): la función `reconciliar()` compara el estado nuevo con el DOM real y clasifica cada nodo como `creado`, `cambiado` o `eliminado`:

```js
function reconciliar(nuevoEstado) {
  const anterior = Object.assign({}, domReal);
  const repintadosAhora = [];

  nuevoEstado.forEach(function (p) {
    const previo = anterior[p.id];
    if (!previo) {
      repintadosAhora.push({ id: p.id, tipo: 'creado', texto: p.nombre });
    } else if (previo.nombre !== p.nombre || previo.precio !== p.precio || previo.stock !== p.stock) {
      repintadosAhora.push({ id: p.id, tipo: 'cambiado', texto: p.nombre });
    }
    domReal[p.id] = { nombre: p.nombre, precio: p.precio, stock: p.stock };
  });

  actualizaciones++;
  repintados += repintadosAhora.length;
  pintarContadores(nuevoEstado.length, repintadosAhora.length);
}
```

**Comprobación:** al pulsar «Renombrar el producto 2» los contadores muestran *4 nodos comparados · 1 nodo realmente repintado*. Ese es el ahorro que describe el tema.

**Concepto clave:** la reconciliación es un **diff** entre dos árboles. React lo usa porque tocar el DOM nativo obliga al motor a recalcular geometrías y repintar píxeles, y esa operación es cara.

---

## Ejercicio 6 — Programación orientada a componentes

**Enunciado:** dividir la interfaz en componentes reutilizables, cada uno con su propio estado interno.

**Solución** (`Ejercicio 6\index.html`): cada componente es una función que recibe `props`, guarda su `state` en un objeto propio y devuelve su nodo ya pintado:

```js
function Contador(props) {
  const state = { valor: props.inicial };   // estado propio de este componente
  const nodo = document.createElement('div');

  function pintar() {
    nodo.innerHTML = '<output>' + state.valor + '</output>' +
                     '<div class="estado">state = { valor: ' + state.valor + ' }</div>';
  }

  nodo.addEventListener('click', function (e) {
    if (e.target.dataset.accion === 'sumar') { state.valor++; }
    if (e.target.dataset.accion === 'restar') { state.valor--; }
    pintar();
  });

  pintar();
  return { nodo: nodo, estado: state, nombre: props.titulo };
}
```

Se montan `Navegacion()`, dos `Contador()` y dos `Tarjeta()`, y la tira de texto inferior vuelca el `state` de cada uno, que es **independiente**: cambiar el carrito no altera los favoritos.

**Concepto clave:** un componente encapsulatesa estado y comportamiento, y se reutiliza con distintas `props`. La página compara la sintaxis **JSX** con su equivalente en `document.createElement()`: JSX es una extensión de JavaScript, no un lenguaje de plantillas sin ejecución de JavaScript.

---

## Ejercicio 7 — Cronología de JavaScript y ECMAScript

**Enunciado:** ordenar y recorrer los hitos de la evolución histórica del lenguaje.

**Solución** (`Ejercicio 7\index.html`): un array de hitos en orden cronológico, cada uno etiquetado con su fase, y botones para avanzar de uno en uno o ver la línea completa:

```js
const hitos = [
  { anio: '1995',    que: 'Brendan Eich crea JavaScript en 10 días para Netscape...', fase: 0 },
  { anio: '1996',    que: 'Microsoft lanza JScript con Internet Explorer 3.0...',      fase: 1 },
  { anio: '1997',    que: 'Nace ECMAScript 1 (ECMA-262)...',                            fase: 1 },
  { anio: '1998-99', que: 'ES2 y ES3: expresiones regulares, try/catch...',              fase: 1 },
  { anio: '2005',    que: 'Jesse James Garrett acuña AJAX...',                          fase: 2 },
  { anio: '2006',    que: 'jQuery, Prototype y MooTools unifican las APIs del DOM...',  fase: 2 },
  { anio: '2009',    que: 'ECMAScript 5: "use strict", forEach/map/filter, JSON...',   fase: 3 },
  { anio: '2009',    que: 'Ryan Dahl crea Node.js sobre el motor V8...',                fase: 3 },
  { anio: '2015',    que: 'ECMAScript 2015 (ES6), la mayor refundición...',               fase: 4 },
  { anio: '2016+',   que: 'Proceso de 4 fases (Stages 0 a 4) y publicaciones anuales.',  fase: 4 }
];
```

**Concepto clave:** la línea de tiempo resume el apartado B: un lenguaje de 10 días pasó de jugar animaciones y validar formularios a ser el motor universal de la web, del servidor (Node.js) y del escritorio.

---

## Ejercicio 8 — Comparativa de frameworks

**Enunciado (Actividad de Análisis Comparativo):** tabla que justifique qué framework elegirías para tres escenarios.

**Solución** (`Ejercicio 8\index.html`): tabla de características (origen, lenguaje base, modelo de componentes, DOM virtual, curva de aprendizaje, reactividad, legado) más los tres casos con su justificación desplegable:

| Caso | Framework | Motivo |
|---|---|---|
| 1. Tienda de barrio, presupuesto reducido, despliegue rápido | **Vue.js** | Curva progresiva: el equipo entrega antes sin formación larga. Ligereza y velocidad de ejecución; se combina con back-ends como Laravel. |
| 2. Portal bancario, cientos de programadores, tipado robusto | **Angular** | Se programa en **TypeScript** (superconjunto tipado de Microsoft) y su arquitectura estructurada estandariza al equipo: un programador nuevo se incorpora rápido al proyecto. |
| 3. Miles de productos con renderizado ultra rápido | **ReactJS** | Su **DOM virtual** solo repinta los nodos distintos; los componentes encapsulan estado y se reutilizan, y es el más adoptado del mercado. |

**Concepto clave:** la elección se guía por el escenario, no por la moda. Angular aporta rigidez y tipado, Vue ligereza y accesibilidad, React rendimiento y ecosistema; EmberJS, BackboneJS, MeteorJS, Aurelia, Polymer y Mithril son alternativas según los requisitos de soporte, popularidad y rapidez.

---

## Ejercicio 9 — Test de vocabulario técnico

**Enunciado:** test interactivo de Verdadero/Falso sobre el vocabulario del apartado E y los conceptos del criterio.

**Solución** (`Ejercicio 9\index.html`): 12 preguntas evaluadas en el cliente, con marcador de aciertos:

```js
const respuestas = [true, false, true, true, true, false, true, true, true, true, true, false];

function responder(numero, ganaBoton) {
  const esAcierto = (respuestas[numero - 1] === ganaBoton);
  document.getElementById('pregunta' + numero).style.color = esAcierto ? 'green' : 'red';
  contestadas[numero] = esAcierto;
  actualizarMarcador();
}
```

**Concepto clave:** cubre HTML como lenguaje de marcado, CSS sin lógica, características de JavaScript, DOM virtual, TypeScript como superconjunto tipado, JSX como extensión ejecutable, patrón reactivo, flechas de ES6, hoisting, los orígenes de React y Angular, y el carácter open source de los frameworks.

---

## Resumen de recursos utilizados

| Tema | Concepto / API | Dónde se usa |
|---|---|---|
| Separación de capas | `<link>`, `<script src>`, clases CSS | Ej. 1 |
| Funciones | declaración, expresión, flecha, hoisting | Ej. 2, 3 |
| Eventos | `addEventListener('click', ...)` | Ej. 1, 2, 3, 5, 6 |
| DOM | `createElement`, `textContent`, `classList` | Ej. 1, 5, 6 |
| Patrón reactivo | suscripciones y propagación en cascada | Ej. 4 |
| DOM Virtual | diff y reconciliación mínima | Ej. 5 |
| Componentes | `props`, `state` propio por componente | Ej. 6 |
| Cronología ES | hitos y fases del TC39 | Ej. 7 |
| Frameworks | tabla comparativa y elección razonada | Ej. 8 |
| Vocabulario | V/F y marcador de aciertos | Ej. 9 |
