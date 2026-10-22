# Actividad 1: "El Bug Silencioso"

```javascript
const numeros = [2,4,6,8,9];
for (let i = 0; i < numeros.length; i++) {
  if (numeros[i] % 2 === 0) {
    numeros.splice(i, 1);
  }
}
console.log(numeros);
```

**Traza paso a paso (bucle ascendente):**

| `i` | Array al empezar | `numeros[i]` | ¿Par? | Qué se hace | Array al terminar |
|---|---|---|---|---|---|
| 0 | `[2,4,6,8,9]` | `2` | Sí | `splice(0,1)` | `[4,6,8,9]` |
| 1 | `[4,6,8,9]` | `6` | Sí | `splice(1,1)` | `[4,8,9]` |
| 2 | `[4,8,9]` | `9` | No | no se toca | `[4,8,9]` |
| 3 | `[4,8,9]` | — | — | `3 < 3` es `false` → se sale | `[4,8,9]` |

**Resultado real: `[4, 8, 9]`**, no `[4, 6, 9]` como dice el comentario del enunciado.

**Por qué pasa esto:** el bucle da cuatro vueltas, pero solo llega a mirar tres elementos de los cinco que había al principio. Cada vez que `splice()` quita algo, todo el bloque que venía detrás se corre un hueco a la izquierda para rellenar el espacio libre, mientras que `i` no se entera y sigue sumando uno. Al eliminar el `2` del índice `0`, el `4` se coloca en el `0` y el `6` en el `1`; la vuelta siguiente empieza ya en el `1`, así que al `4` no se le hace ni una comprobación. Con el `8` ocurre exactamente igual: pasa al índice `1` justo cuando el contador lo acaba de dejar atrás. Los dos son pares y deberían haber desaparecido, pero se quedan dentro del array.

Lo llaman bug silencioso porque no rompe nada ni muestra un error: el programa termina, imprime un array y parece que ha funcionado. El fallo solo se nota al mirar el resultado con calma y ver que quedan números que no deberían estar.

## Con bucle decreciente

```javascript
const numeros = [2,4,6,8,9];
for (let i = numeros.length - 1; i >= 0; i--) {
  if (numeros[i] % 2 === 0) {
    numeros.splice(i, 1);
  }
}
console.log(numeros);
```

**Resultado: `[9]`**, esta vez desaparecen todos los pares.

**Por qué así sí funciona:** el recorrido empieza por el último elemento y va retrocediendo (índices 4, 3, 2, 1, 0). Cuando `splice()` borra algo, lo que se desplaza está siempre a la derecha del índice en el que estamos, y esa parte del array ya está revisada; el hueco se cierra por detrás de nosotros. Ninguna posición pendiente cambia de sitio, así que no hay forma de saltarse un elemento. De ahí la costumbre de recorrer el array al revés cuando se va a modificar su longitud dentro del propio bucle (o directamente usar `filter()`, que construye otro array y no toca el original).
