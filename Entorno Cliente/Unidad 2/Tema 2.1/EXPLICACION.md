# Tema 2.1 · Cómo está resuelto

## De qué va

El tema trata los **lenguajes de programación del cliente**: cuáles existen, cuál
se usa hoy y por qué. También entra en detalles del lenguaje que se ven en los
errores del día a día: sensibilidad a mayúsculas, reglas de nombres y el punto y
coma automático.

## Qué pide el enunciado

Nueve apartados, mezcla de teoría y práctica:

1. Clasificar las tecnologías front-end (históricas, actuales y dialectos).
2. Justificar por qué ejecutar lógica en el cliente ahorra recursos.
3. Matriz de selección de dialectos.
4. ECMAScript y transpilación.
5. Validar identificadores.
6. Detectar errores por mayúsculas/minúsculas.
7. Aplicar convenciones profesionales.
8. Analizar el ASI (el punto y coma automático).
9. Comprobar en consola el ámbito.

## Paso a paso

### 1 · Tecnologías front-end

| Categoría | Ejemplos | Qué pasó |
|---|---|---|
| Históricas | Flash, Java Applets, VBScript | exigían plugin o solo funcionaban en un navegador |
| Estándar | JavaScript (ECMAScript) | lo entienden todos los motores sin instalar nada |
| Dialectos | TypeScript, JSX | no sustituyen a JavaScript: se **transpilan** antes |

El concepto que resume el apartado es **Zero Plugins**: el navegador ejecuta el
código de serie, sin descargar nada aparte.

### 2 · Lógica en el cliente

Dos ventajas concretas:

- Las validaciones, ordenaciones y cálculos se hacen en la máquina del usuario, así
  que el servidor gasta menos CPU.
- Solo viajan los datos (JSON), no la página entera montada.

### 3 y 4 · Dialectos y transpilación

TypeScript añade tipos y JSX permite escribir etiquetas dentro del JavaScript,
pero **el navegador no los entiende**. Antes de publicar se convierten a JavaScript
con una herramienta de compilación (Babel, esbuild, el compilador de TypeScript).

### 5 · Identificadores válidos

Un nombre de variable:

- Empieza por letra, `_` o `$`.
- No puede empezar por número.
- No puede ser una palabra reservada (`class`, `return`, `let`…).
- Distingue mayúsculas: `edad` y `Edad` son variables distintas.

```js
const nombreValido = /^[A-Za-z_$][A-Za-z0-9_$]*$/;
nombreValido.test("miVariable");   // true
nombreValido.test("2variable");    // false
```

### 6 · Mayúsculas

```js
let usuario = "Ana";
console.log(Usuarios);   // ReferenceError: Usuarios is not defined
```

No es un fallo del lenguaje: son dos identificadores distintos.

### 7 · Convenciones

- `camelCase` para variables y funciones: `calcularTotal`.
- `PascalCase` para clases: `Factura`.
- `MAYÚSCULAS` para constantes que no cambian: `IVA_GENERAL`.
- Nombres que digan qué guardan: `precioFinal`, no `x`.

### 8 · ASI (inserción automática de punto y coma)

JavaScript pone el `;` solo en algunos saltos de línea. El caso clásico:

```js
function obtener() {
  return
    { precio: 10 };   // devuelve undefined, no el objeto
}
```

El `return` termina en la línea y el objeto queda como código muerto. Se arregla
subiendo la llave:

```js
function obtener() {
  return { precio: 10 };
}
```

Por eso conviene escribir los puntos y coma a mano.

### 9 · Comprobar en consola

Se abre la consola y se prueba el ámbito: una variable declarada con `var` dentro
de un bloque se ve fuera; con `let`, no.

## El código, pieza a pieza

| Archivo | Contenido |
|---|---|
| `actividad-6.js` | errores por mayúsculas |
| `actividad-8.js` | ejemplos de ASI |
| `actividad-9.js` | ámbito en consola |

## Trampas y dudas

- **`NaN` es un número.** `typeof NaN` da `"number"`; para comprobarlo se usa
  `Number.isNaN()`.
- **El ASI no arregla todo.** Solo inserta `;` cuando no puede continuar la
  sentencia; en el `return` no lo hace.
- **TypeScript no es un lenguaje del navegador.** Es un paso previo de compilación.

## Si me preguntan

- **¿Por qué JavaScript y no otro?** Porque es el único que entienden todos los
  navegadores sin instalar nada.
- **¿Qué es transpilar?** Convertir código de una versión o de un dialecto a otro
  JavaScript que el navegador sí entiende.
- **¿Qué es ECMAScript?** El estándar del lenguaje; JavaScript es su implementación
  más conocida. Las versiones se numeran por año: ES2015, ES2020…
