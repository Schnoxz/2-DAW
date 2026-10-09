# Actividades Prácticas — Tema 2.3

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Enunciado: apartado **G. ACTIVIDADES** del tema «2.3. Identificación de los ámbitos de utilización de las variables».
> Criterio **CE 2.c** · RA2 · 20 % del RA2 (1 % de la nota final).
> Todas las predicciones de este documento están comprobadas ejecutándolas con Node v24 (motor V8, el mismo de Chrome).

## Índice

1. [El dilema del bucle asíncrono con `var` frente a `let`](#1--el-dilema-del-bucle-asíncrono-con-var-frente-a-let)
2. [Identificación de la Zona Muerta Temporal (TDZ)](#2--identificación-de-la-zona-muerta-temporal-tdz)
3. [Simulador visual de ámbitos](#3--simulador-visual-de-ámbitos)

---

## 1 · El dilema del bucle asíncrono con `var` frente a `let`

```js
for (var i = 0; i < 3; i++) {
  setTimeout(function() {
    console.log("Valor con var:", i);
  }, 100);
}

for (let j = 0; j < 3; j++) {
  setTimeout(function() {
    console.log("Valor con let:", j);
  }, 100);
}
```

**Salida (tras los 100 ms):**

```
Valor con var: 3
Valor con var: 3
Valor con var: 3
Valor con let: 0
Valor con let: 1
Valor con let: 2
```

**¿Por qué con `var` sale el 3 tres veces?** `var` es de ámbito de función/global y el bucle crea **una sola** variable `i` compartida por las tres funciones. Los `setTimeout` no se ejecutan hasta que termina el bucle, y para entonces `i` ya vale 3: las tres llamadas leen el mismo valor.

**¿Por qué con `let` sale 0, 1 y 2?** `let` tiene ámbito de bloque, y **cada iteración del `for` crea su propia copia** de `j` (una *captura* distinta por vuelta). Cada callback ve el valor de su iteración y el bucle no lo pisa.

Sí, se acierta: la predicción es exactamente esa.

---

## 2 · Identificación de la Zona Muerta Temporal (TDZ)

```js
let usuario = "Carlos";
function configurarPerfil() {
  console.log("El usuario actual es:", usuario);
  let usuario = "Marta";
}
configurarPerfil();
```

**Salida:**

```
Uncaught ReferenceError: Cannot access 'usuario' before initialization
```

No se imprime nada. El `let usuario` de dentro de la función **ensombrece** al global desde el primer byte de la función, no desde la línea de su declaración: al llegar al `console.log`, la variable interna ya existe, pero está en su **Zona Muerta Temporal** (TDZ), el tramo de código comprendido entre la entrada en el ámbito y la declaración física. El motor prohíbe leerla en ese estado y lanza `ReferenceError`.

Para que imprimiera, hay que usar un nombre distinto (`let usuarioInterno = "Marta"`) o leer al usuario global con otro identificador.

Sí, se acierta.

---

## 3 · Simulador visual de ámbitos

### Modificación 1 — Simulación de sombreado (shadowing)

Declaración de la constante global, por encima del `addEventListener`:

```js
const TASA = 0.21;
```

Dentro del manejador del botón, antes de finalizar la auditoría:

```js
function calcularTarifa(precio) {
  const TASA = 0.10;          // sombrea a la global solo dentro de esta función
  return precio * TASA;
}

registrar("TASA global: " + TASA);               // 0.21 (la original no cambia)
registrar("TASA local (dentro de la función): 0.10");
registrar("Tarifa de 200 €: " + calcularTarifa(200));   // 20
```

La constante interna **no altera** la externa: son dos posiciones de memoria distintas y, al salir de la función, la local desaparece y la global sigue valiendo `0.21`.

**Comprobación:**

```
TASA global: 0.21
TASA local (dentro de la función): 0.10
Tarifa de 200 €: 20
```

### Modificación 2 — Activación de `"use strict"`

Primera línea del fichero `laboratorio_ambitos.js`:

```js
"use strict";
```

Y dentro del manejador del botón, intento de fuga capturado:

```js
try {
  saldoSinDeclarar = 500;   // ni var, ni let, ni const
  registrar("⚠ Se creó una variable global oculta.", "resaltado-ok");
} catch (e) {
  registrar("✗ " + e.constructor.name + ": " + e.message, "resaltado-error");
}
```

**Salida real en la pantalla del laboratorio:**

```
ReferenceError: saldoSinDeclarar is not defined
```

Sin `"use strict"` esa misma línea no daría ningún error: crearía una variable global oculta en `window` (comprobado: `window.saldoSinDeclarar === 500`). Con la directiva activa, el motor lanza `ReferenceError` en cuanto se intenta la asignación, que es justo lo que captura el `try/catch` y pintan `.resaltado-error`.

---

## Resumen de comprobaciones

| Ejercicio | Resultado |
|---|---|
| 1 · bucle con `var` | `Valor con var: 3` tres veces |
| 1 · bucle con `let` | `0`, `1`, `2` |
| 2 · TDZ | `ReferenceError: Cannot access 'usuario' before initialization` |
| 3 · sombreado de `TASA` | global `0.21`, local `0.1`, tarifa de 200 € → `20` |
| 3 · `"use strict"` | `ReferenceError: saldoSinDeclarar is not defined` (sin `use strict` crearía una global con `500`) |
