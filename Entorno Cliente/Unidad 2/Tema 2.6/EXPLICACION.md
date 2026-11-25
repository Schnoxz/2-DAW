# Tema 2.6 · Cómo está resuelto

## De qué va

El tema son los **bucles**: `for`, `while`, `do...while`, `for...of` y sus
variantes. La parte interesante no es escribirlos, sino los errores que aparecen
cuando modificas la colección mientras la recorres.

## Qué pide el enunciado

1. **El bug silencioso:** explicar qué hace este código y por qué no borra todos
   los pares.

```js
const numeros = [2, 4, 6, 8, 9];
for (let i = 0; i < numeros.length; i++) {
  if (numeros[i] % 2 === 0) {
    numeros.splice(i, 1);
  }
}
```

2. **El rombo:** dibujar un rombo con bucles anidados.
3. **Validación de entrada:** pedir un dato hasta que sea válido con `do...while`.

## Paso a paso

### 1 · El bug

Al borrar con `splice(i, 1)`, todos los elementos siguientes se desplazan una
posición a la izquierda, y `i++` salta al que acaba de ocupar el hueco.

Traza:

| Vuelta | `i` | Valor de `numeros[i]` | Acción | Array |
|---|---|---|---|---|
| 1 | 0 | 2 (par) | borra | `[4, 6, 8, 9]` |
| 2 | 1 | 6 (par) | borra | `[4, 8, 9]` |
| 3 | 2 | 9 (impar) | nada | `[4, 8, 9]` |
| 4 | 3 | — | fin | `[4, 8, 9]` |

Resultado real: `[4, 8, 9]`. El 4 y el 8 se quedan porque nadie los miró.

Hay dos formas de arreglarlo. Recorrer **de atrás hacia delante**:

```js
for (let i = numeros.length - 1; i >= 0; i--) {
  if (numeros[i] % 2 === 0) numeros.splice(i, 1);
}
```

O **no modificar el original** y filtrar:

```js
const impares = numeros.filter((n) => n % 2 !== 0);
```

### 2 · El rombo

Se construye con dos mitades. Cada línea lleva espacios, luego asteriscos:

```js
const altura = 5;

for (let fila = 1; fila <= altura; fila++) {
  const espacios = " ".repeat(altura - fila);
  const estrellas = "*".repeat(fila * 2 - 1);
  console.log(espacios + estrellas);
}

for (let fila = altura - 1; fila >= 1; fila--) {
  const espacios = " ".repeat(altura - fila);
  const estrellas = "*".repeat(fila * 2 - 1);
  console.log(espacios + estrellas);
}
```

`repeat()` ahorra el bucle interno de espacios y estrellas.

### 3 · Validación con `do...while`

```js
let edad;
do {
  edad = Number(prompt("Edad (18-99):"));
} while (!Number.isInteger(edad) || edad < 18 || edad > 99);
```

`do...while` ejecuta el cuerpo **antes** de comprobar la condición, así que pide el
dato al menos una vez. Con `while` normal habría que pedirlo antes del bucle y
duplicar el código.

## El código, pieza a pieza

```
Tema 2.6/
├── actividad-1.js          el bug y las dos soluciones
├── actividad-2.js          el rombo
├── validacion.js           do...while
├── index.html              página de pruebas del rombo
└── Ejercicio 1 - El Bug Silencioso.md
```

## Trampas y dudas

- **No modifiques un array mientras lo recorres hacia delante** con `splice`.
  Recorre al revés o usa `filter`.
- **`for...of` no da el índice.** Para eso, `entries()` o `forEach`.
- **`while (true)` necesita un `break`** o el navegador se queda colgado.
- **`do...while` siempre ejecuta al menos una vez.** Si eso no encaja, `while`.

## Si me preguntan

- **¿Cuándo `for` y cuándo `while`?** `for` cuando sabes cuántas vueltas hay;
  `while` cuando depende de una condición.
- **¿Qué hace `splice`?** Quita (y opcionalmente inserta) elementos en una posición
  y devuelve los eliminados.
- **¿Por qué el bug no da error?** Porque no es un error de sintaxis: es lógica.
  El código hace algo, solo que no lo que esperabas.
