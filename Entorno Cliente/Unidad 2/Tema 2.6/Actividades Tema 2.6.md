### 1. El Bug Silencioso

El código del enunciado es este:

```js
const numeros = [2, 4, 6, 8, 9];

for (let i = 0; i < numeros.length; i++) {
  if (numeros[i] % 2 === 0) {
    numeros.splice(i, 1);
  }
}
console.log(numeros);
```

Traza paso a paso:

- `i = 0`: `numeros[0]` es 2, que es par, así que `splice(0, 1)` lo borra. El array queda `[4, 6, 8, 9]` y `i` pasa a 1.
- `i = 1`: `numeros[1]` es 6, par, así que `splice(1, 1)` lo borra. Queda `[4, 8, 9]` y `i` pasa a 2.
- `i = 2`: `numeros[2]` es 9, impar, no se borra nada.
- `i = 3`: la condición `3 < 3` es falsa y el bucle termina.

El resultado real es `[4, 8, 9]`. El comentario del enunciado dice `[4, 6, 9]`, pero no es correcto: al usar `splice()` el array se desplaza a la izquierda y el `i++` se salta el elemento que acaba de ocupar la posición borrada, en este caso el 4 y el 8.

La versión corregida recorre el array de atrás hacia delante:

```js
const numeros = [2, 4, 6, 8, 9];

for (let i = numeros.length - 1; i >= 0; i--) {
  if (numeros[i] % 2 === 0) {
    numeros.splice(i, 1);
  }
}
console.log(numeros);   // [9]
```

Así los elementos que se desplazan ya han sido visitados, no se salta ninguno y desaparecen todos los pares.

### 2. El Algoritmo del Rombo

El rombo se construye con dos bucles exteriores, uno para la mitad superior y otro para la inferior, y dentro de cada uno dos bucles anidados: uno pinta los espacios de la izquierda y otro los asteriscos de la fila.

```js
const filas = 4;

// Mitad superior, de la punta a la fila más ancha
for (let i = 1; i <= filas; i++) {
  let linea = "";

  for (let j = 1; j <= filas - i; j++) {
    linea += " ";
  }

  for (let j = 1; j <= 2 * i - 1; j++) {
    linea += "*";
  }

  console.log(linea);
}

// Mitad inferior, simétrica de la anterior
for (let i = filas - 1; i >= 1; i--) {
  let linea = "";

  for (let j = 1; j <= filas - i; j++) {
    linea += " ";
  }

  for (let j = 1; j <= 2 * i - 1; j++) {
    linea += "*";
  }

  console.log(linea);
}
```

La salida por consola es un rombo simétrico:

```text
   *
  ***
 *****
*******
 *****
  ***
   *
```

En la mitad superior los espacios bajan de uno en uno mientras que los asteriscos crecen de dos en dos, y la mitad inferior repite el mismo patrón al revés.

### 3. Validación de Entrada con do...while

```js
let codigo;

do {
  codigo = prompt("Introduce un código numérico de 4 dígitos:");

  if (codigo === null) break;

  codigo = codigo.trim();
} while (Number.isNaN(Number(codigo)) || codigo.length !== 4);

if (codigo !== null) {
  alert(`Código aceptado: ${codigo}`);
}
```

El `do...while` ejecuta el cuerpo al menos una vez y comprueba la condición al final, justo lo que hace falta aquí porque primero hay que pedir el dato y solo después se puede validar. La condición repite la petición mientras el valor no sea numérico (`Number.isNaN(Number(codigo))`) o no tenga exactamente cuatro caracteres (`codigo.length !== 4`).

El `break` cubre el caso de que el usuario cancele el diálogo: sin él, `null` no es numérico y el bucle volvería a pedir el código una y otra vez.
