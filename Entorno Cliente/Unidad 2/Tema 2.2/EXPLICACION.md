# Tema 2.2 · Cómo está resuelto

## De qué va

El tema son las **variables y los operadores**: tipos, ámbito, precedencia y las
conversiones raras de JavaScript. Es donde se entiende por qué `0 == false` y por
qué `5 + "5"` da `"55"`.

## Qué pide el enunciado

1. Evaluar cuatro expresiones de cortocircuito y precedencia.
2. Verificar variables y operadores de todo tipo con `typeof`.
3. Un validador de tipos.
4. Analizar operadores unarios combinados.
5. Comparar cortocircuitos con valores *falsy*.
6. Un test.

## Paso a paso

### 1 · Las cuatro expresiones

```js
console.log(0 || "Fallback");   // "Fallback"
console.log(0 ?? "Fallback");   // 0
console.log(5 + "5");           // "55"
let i = 2;
console.log(i++ * ++i);         // 8
```

- `||` devuelve el primer valor **truthy**. Como `0` es falsy, salta al siguiente.
- `??` solo salta con `null` o `undefined`; el `0` es un valor válido y se queda.
- `+` con un texto concatena: convierte el número a texto.
- `i++` devuelve 2 y deja `i` en 3; `++i` sube a 4 y devuelve 4. El producto, 8.

### 2 · `typeof` de todo

```js
typeof 50n          // "bigint"
typeof Symbol()     // "symbol"
typeof null         // "object"   ← anomalía histórica
typeof NaN          // "number"
typeof []           // "object"
typeof function(){} // "function"
```

`typeof null === "object"` es un error que se arrastra desde 1995 y ya no se puede
corregir sin romper la web.

### 3 · Validador de tipos

```js
function validarTipo(valor) {
  if (typeof valor === "string") return "texto";
  if (typeof valor === "number") {
    return Number.isInteger(valor) ? "entero" : "decimal";
  }
  if (Array.isArray(valor)) return "array";
  return typeof valor;
}
```

`Array.isArray()` es la forma correcta de detectar un array: `typeof []` devuelve
`"object"` como cualquier objeto.

### 4 · Operadores unarios

```js
let a = "5";
console.log(+a);      // 5     (número)
console.log(-a);      // -5
console.log(!!a);     // true  (doble negación = booleano)
console.log(typeof +a); // "number"
```

El `+` delante es una conversión a número, no una suma. El `-` hace lo mismo y
además cambia el signo.

### 5 · Valores *falsy*

Solo hay seis valores que cuentan como falsos:

```js
false, 0, "", null, undefined, NaN
```

Todo lo demás es verdadero, incluidos `"0"`, `"false"`, `[]` y `{}`. Es la fuente
de la mitad de los errores de lógica.

### 6 · El test

Repasa lo anterior: precedencia (`*` antes que `+`), diferencia entre `==` y
`===`, y qué devuelve cada operador lógico.

## El código, pieza a pieza

| Archivo | Contenido |
|---|---|
| `actividad-1.js` | cortocircuito y precedencia |
| `actividad-2.js` | `typeof` y ámbito |
| `actividad-3.js` | validador de tipos |
| `actividad-4.js` | operadores unarios |
| `actividad-5.js` | valores falsy |

## Trampas y dudas

- **`==` convierte y `===` no.** `"0" == false` es `true`; `"0" === false` es
  `false`.
- **`NaN !== NaN`.** Es el único valor que no es igual a sí mismo; para eso existe
  `Number.isNaN()`.
- **`const` no congela objetos.** `const c = {}` impide reasignar `c`, pero deja
  cambiar `c.propiedad`.
- **La precedencia se evita con paréntesis.** `a + b * c` se lee mal; `a + (b * c)`
  no.

## Si me preguntan

- **¿Por qué usar `===` siempre?** Porque evita las conversiones invisibles que
  provocan resultados sorprendentes.
- **¿Qué es el cortocircuito?** Que `&&` y `||` dejan de evaluar en cuanto saben el
  resultado.
- **¿`let` o `const`?** `const` por defecto; `let` solo cuando el valor cambia.
