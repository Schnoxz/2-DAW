# Tema 2.3 · Cómo está resuelto

## De qué va

El tema es el **ámbito de las variables**: dónde existe cada una y qué pasa cuando
dos comparten nombre. Es la base para entender los errores más difíciles de
encontrar, porque el código no falla al escribirlo sino al ejecutarlo.

## Qué pide el enunciado

1. Un bucle con `var` y otro con `let` dentro de `setTimeout`.
2. Provocar la Zona Muerta Temporal (TDZ).
3. Sombreado de variables y `"use strict"`.

## Paso a paso

### 1 · `var` frente a `let` en un bucle

```js
for (var i = 0; i < 3; i++) {
  setTimeout(() => console.log("var:", i), 100);   // 3, 3, 3
}

for (let j = 0; j < 3; j++) {
  setTimeout(() => console.log("let:", j), 100);   // 0, 1, 2
}
```

La clave es **cuándo se ejecuta** el `console.log`: cien milisegundos después, no
en el momento de crear la función.

- `var` tiene ámbito de función: hay **una sola** `i` para las tres vueltas, y
  cuando las funciones se ejecutan ya vale 3.
- `let` tiene ámbito de bloque: cada vuelta crea su propia `j`, y cada función se
  queda con la suya.

### 2 · Zona Muerta Temporal

```js
let usuario = "Carlos";

function configurarPerfil() {
  console.log(usuario);   // ReferenceError
  let usuario = "Marta";
}

configurarPerfil();
```

Error: `Cannot access 'usuario' before initialization`.

El `let` de dentro crea una variable local que **ensombrece** a la global en toda
la función, pero no se inicializa hasta su línea. Entre el principio de la función
y esa línea está la TDZ, y leerla ahí lanza el error.

Se arregla cambiando el nombre:

```js
function configurarPerfil() {
  console.log(usuario);          // lee la global
  let usuarioInterno = "Marta";
}
```

### 3 · Sombreado y `"use strict"`

```js
"use strict";

const TASA = 0.21;

function calcularTarifa(precio) {
  const TASA = 0.10;   // sombrea la global solo aquí dentro
  return precio * TASA;
}

console.log(TASA);              // 0.21
console.log(calcularTarifa(100)); // 10
```

`sombreado` significa que la variable interna tapa a la externa mientras dura la
función. Al salir, la global sigue igual.

`"use strict"` activa el modo estricto: prohíbe crear variables sin declarar y
convierte en error varias prácticas peligrosas.

## El código, pieza a pieza

| Archivo | Contenido |
|---|---|
| `actividad-1.js` | bucle con `var` y con `let` + `setTimeout` |
| `actividad-2.js` | TDZ a propósito |
| `actividad-3.js` | sombreado y modo estricto |
| `capturas/` | salida de consola de cada uno |

## Trampas y dudas

- **`var` se declara en la función, no en el bloque.** Por eso se ve fuera de un
  `if` o de un `for`.
- **La TDZ no da `undefined`.** Da `ReferenceError`; es distinto de una variable
  declarada sin valor.
- **`"use strict"` va al principio del archivo o de la función.** Si se pone en
  medio, no hace nada.
- **Sombreado no es lo mismo que reasignar.** Sombear crea otra variable; reasignar
  cambia la misma.

## Si me preguntan

- **¿Por qué `let` en los bucles?** Porque cada iteración tiene su propia variable,
  y las funciones que se crean dentro se llevan la suya.
- **¿Qué es el *hoisting*?** Que las declaraciones se suben al principio de su
  ámbito. Con `var` la variable existe desde el principio (vale `undefined`); con
  `let` existe pero está en TDZ.
- **¿Para qué sirve `"use strict"`?** Para que errores silenciosos se conviertan en
  excepciones y se detecten antes.
