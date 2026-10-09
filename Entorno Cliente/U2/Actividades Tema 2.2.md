# Actividades Prácticas — Tema 2.2

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Enunciado: apartado **F. Actividades Prácticas y Ejercicios del Criterio 2.2** del tema «2.2. Utilización de los distintos tipos de variables y operadores disponibles en el lenguaje».
> Criterio **CE 2.b** · RA2 · 10 % del RA2 (0,5 % de la nota final).
> Todas las predicciones de este documento están comprobadas ejecutándolas con Node v24 (motor V8, el mismo de Chrome).

## Índice

1. [Evaluación de cortocircuito y precedencia](#1--evaluación-de-cortocircuito-y-precedencia)
2. [Verificación exhaustiva de variables y operadores](#2--verificación-exhaustiva-de-variables-y-operadores)
3. [Validador de tipos](#3--validador-de-tipos)
4. [Análisis de precedencia y operadores unarios combinados](#4--análisis-de-precedencia-y-operadores-unarios-combinados)
5. [Comparativa de cortocircuitos con valores falsy críticos](#5--comparativa-de-cortocircuitos-con-valores-falsy-críticos)
6. [Ejercicio tipo test](#6--ejercicio-tipo-test)

---

## 1 · Evaluación de cortocircuito y precedencia

```js
console.log(0 || "Fallback");   // "Fallback"
console.log(0 ?? "Fallback");   // 0
console.log(5 + "5");           // "55"
let i = 2;
console.log(i++ * ++i);         // 8
```

- **`0 || "Fallback"` → `"Fallback"`:** el `||` devuelve el primer *truthy*; `0` es *falsy* así que sigue y devuelve `"Fallback"`.
- **`0 ?? "Fallback"` → `0`:** la coalescencia nula solo salta si el operando es `null` o `undefined`. El `0` es un valor legítimo y se respeta.
- **`5 + "5"` → `"55"`:** con `+`, si alguno de los dos operandos es texto, JavaScript convierte el otro a texto y concatena.
- **`i++ * ++i` → `8`** con `i = 2`: `i++` devuelve `2` (y deja `i = 3`), después `++i` sube a `4` y devuelve `4`. `2 * 4 = 8`. Al acabar, `i` vale `4`.

---

## 2 · Verificación exhaustiva de variables y operadores

`verificacion_tipos.js` completo:

```js
// 1. Demostración de ámbito de bloque e inmutabilidad
var variableGlobal = "Accesible fuera";
{
  let variableLocal = "Aislada en bloque";
  const CONFIG_APP = { version: "1.0.0", entorno: "test" };

  // Mutabilidad de propiedad en objeto declarado con const
  CONFIG_APP.entorno = "produccion";
  console.log("Objeto modificado:", CONFIG_APP);
}

// 2. Comprobaciones con el operador typeof
console.log("typeof 50n:", typeof 50n);             // "bigint"
console.log("typeof Symbol():", typeof Symbol());   // "symbol"
console.log("typeof null:", typeof null);           // "object" (anomalía de 1995)
console.log("typeof NaN:", typeof NaN);             // "number"

// 3. Coerción y comparaciones
console.log("5 == '5':", 5 == "5");                 // true
console.log("5 === '5':", 5 === "5");               // false
console.log("5 + '5':", 5 + "5");                   // "55"
console.log("5 - '5':", 5 - "5");                   // 0

// 4. Operadores especiales in, delete e instanceof
const alumno = { id: 1001, curso: "2 DAW", activo: true };
console.log("¿Tiene propiedad 'curso'?:", "curso" in alumno);  // true
delete alumno.activo;
console.log("Objeto tras borrado:", alumno);                   // { id: 1001, curso: '2 DAW' }
console.log("alumno es instancia de Object:", alumno instanceof Object); // true
```

**Salida real por consola:**

```
Objeto modificado: { version: '1.0.0', entorno: 'produccion' }
typeof 50n: bigint
typeof Symbol(): symbol
typeof null: object
typeof NaN: number
5 == '5': true
5 === '5': false
5 + '5': 55
5 - '5': 0
¿Tiene propiedad 'curso'?: true
Objeto tras borrado: { id: 1001, curso: '2 DAW' }
alumno es instancia de Object: true
```

Claves: el objeto declarado con `const` no se puede *reasignar*, pero sus propiedades sí se modifican; `typeof null` devuelve `"object"` (error histórico) y `typeof NaN` devuelve `"number"` aunque signifique *Not-a-Number*.

---

## 3 · Validador de tipos

### Modificación 1 — operador AND y doble negación

Añadido en `laboratorio_operadores.js`:

```js
const operacionAnd = valA && valB;
const negacionA = !!valA;
```

Y dentro del `visor.innerHTML`:

```js
    <strong>Cortocircuito AND (A && B):</strong> ${String(operacionAnd)}<br>
    <strong>Doble negación (!!A):</strong> ${negacionA}
```

`&&` devuelve el primer operando *falsy* o, si todo es verdad, el último; `!!valA` convierte cualquier valor a su booleano primitivo (`""`, `0`, `null`, `undefined`, `NaN` → `false`).

### Modificación 2 — aviso de precisión con BigInt

Añadido justo antes de pintar el visor:

```js
let aviso = "";
if (typeof valA === "number" && Math.abs(valA) > Number.MAX_SAFE_INTEGER) {
  aviso = "Aviso: Precisión comprometida. Utiliza BigInt (sufijo n) para operar en este rango";
}
```

Y en la salida:

```js
    ${aviso ? `<strong style="color:#f44747">${aviso}</strong><br>` : ""}
```

La comprobación exige `typeof valA === "number"` para no intentar comparar textos u objetos, y `Number.MAX_SAFE_INTEGER` vale `9007199254740991`: a partir de ahí `number` pierde dígitos y hay que usar `123n`.

---

## 4 · Análisis de precedencia y operadores unarios combinados

```js
let x = 3;
let y = 4;
let resultado = x++ * ++y + (x & 1);
```

| Paso | Qué ocurre | Estado |
|---|---|---|
| 1 | `x++` devuelve `3` y después incrementa `x` | `x = 4` |
| 2 | `++y` incrementa `y` y devuelve `5` | `y = 5` |
| 3 | `x & 1` → `4 & 1` = `0100 & 0001` = `0` | `x = 4` |
| 4 | `3 * 5 + (0)` → `15 + 0` | — |

**Resultado: `resultado = 15`, `x = 4`, `y = 5`.**

---

## 5 · Comparativa de cortocircuitos con valores falsy críticos

```js
function fijarDescuento(descuento) {
  let tasaFinalA = descuento || 15;
  let tasaFinalB = descuento ?? 15;
  console.log(`Tasa A: ${tasaFinalA} | Tasa B: ${tasaFinalB}`);
}

fijarDescuento(0);
```

**Imprime:** `Tasa A: 15 | Tasa B: 0`

- El `0` es un valor **legítimo**: significa «0 % de descuento». El `||` solo mira si el operando es *truthy* y, al ser `0`, lo descarta y devuelve `15`: informa de un descuento que no existe.
- El `??` solo salta ante `null`/`undefined`, así que respeta el `0`.

**La correcta es `tasaFinalB = descuento ?? 15`.** La opción `||` solo estaría bien si el parámetro fuese opcional y el `0` no pudiera distinguirse de «sin valor».

---

## 6 · Ejercicio tipo test

1. **b)** `undefined` — `var micoche;` reserva la variable y el motor le asigna `undefined` hasta que se le ponga un valor; no es `null`.
2. **c)** `"125"` — con `+` y un operando texto, se concatena en lugar de sumar.
3. **c)** `===` — exige igualdad de valor **y** de tipo, sin conversiones ocultas.
4. **c)** `"object"` — anomalía histórica de 1995 que se conserva por compatibilidad.
5. **c)** `??=` — solo asigna si la variable es `null`/`undefined`, dejando intactos `0` y `false`.
6. **b)** `notas.push(7)` — `const` impide reasignar la referencia (a, d) y redeclarar (c), pero permite mutar el contenido del array.
