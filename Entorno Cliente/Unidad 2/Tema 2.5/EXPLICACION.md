# Tema 2.5 · Cómo está resuelto

## De qué va

El tema son los **mecanismos de decisión** (`if`, `switch`, operador ternario) y,
sobre todo, cómo escribir condiciones que no se conviertan en un laberinto. La
actividad es una refactorización: el analizador del proyecto rechaza una función
porque tiene demasiada complejidad.

## Qué pide el enunciado

Reescribir `calcularMatricula(datos)` corrigiendo tres avisos:

```
complexity: cyclomatic complexity of 8 (max allowed: 5)
max-depth: blocks nested 4 levels deep (max allowed: 2)
no-else-return: unnecessary 'else' after 'return'
```

Y con cinco condiciones: salir en cuanto haya error, no pasar de un nivel de
indentación, no poner `else` detrás de un `return`, dejar el cálculo final sin
envolver y que el resultado sea idéntico.

## Paso a paso

### 1 · La complejidad ciclomática

Es el número de caminos distintos que puede recorrer una función. Cada `if`,
`else if`, `case` o `&&` suma uno. Con 8 caminos hay que probar 8 casos para
cubrirla, y eso es demasiado para una función.

La forma de bajarla es **salir pronto**:

```js
function calcularMatricula(datos) {
  if (!datos || typeof datos !== "object") return null;
  if (typeof datos.precioBase !== "number" || datos.precioBase <= 0) return null;
  if (!["general", "desempleado", "socio"].includes(datos.tipoEstudiante)) return null;

  const descuentos = { general: 0, desempleado: 0.3, socio: 0.15 };
  const descuento = descuentos[datos.tipoEstudiante];
  return datos.precioBase * (1 - descuento);
}
```

Cada comprobación ocupa una línea y termina la función. Ya no hay `if` anidados.

### 2 · Sustituir los `if` encadenados por una tabla

El antipatrón original era:

```js
if (tipo === "desempleado") {
  descuento = 0.30;
} else {
  if (tipo === "socio") {
    descuento = 0.15;
  } else {
    descuento = 0;
  }
}
```

Eso es una tabla disfrazada de condicionales. Un objeto hace lo mismo y se lee de
un vistazo:

```js
const descuentos = { general: 0, desempleado: 0.3, socio: 0.15 };
const descuento = descuentos[datos.tipoEstudiante];
```

### 3 · El `else` después de `return`

```js
if (!datos) return null;
else { /* ... */ }     // el else sobra: si llega ahí, datos existe
```

Cuando una rama termina en `return`, el `else` es ruido. Quitarlo baja un nivel de
indentación y no cambia nada del comportamiento.

### 4 · Comprobar que no cambia el resultado

Antes de tocar nada se apuntan los resultados del código viejo para varios casos:
datos válidos de cada tipo, `null`, precio negativo, tipo desconocido, campos que
faltan. Después se repiten con la versión refactorizada y se comparan. Si algún
caso cambia, la refactorización está mal, aunque el código sea más bonito.

## El código, pieza a pieza

```
Tema 2.5/
├── actividad-1.js          versión refactorizada y banco de pruebas
├── Actividades Tema 2.5.md enunciado
└── Entrega Tema 2.5/       memoria y capturas
```

## Trampas y dudas

- **Refactorizar no es cambiar el comportamiento.** Si el resultado cambia, es un
  error, no una mejora.
- **`switch` no siempre reduce la complejidad.** Cada `case` cuenta como camino.
- **Los `&&` también suman.** `if (a && b && c)` son tres condiciones, no una.
- **Una función que devuelve `null` en cinco sitios es más legible** que cinco
  `if` anidados, aunque tenga cinco salidas.

## Si me preguntan

- **¿Qué es la complejidad ciclomática?** El número de caminos independientes del
  código; a más caminos, más casos que probar y más fácil equivocarse.
- **¿Por qué evitar los `else`?** Porque la mitad de las veces son innecesarios y
  esconden el flujo real.
- **¿Qué es un antipatrón?** Una solución que parece razonable pero que genera
  problemas de mantenimiento.
