# Tema 2.7 · Cómo está resuelto

## De qué va

El tema son los **comentarios**: para qué sirven, cuáles sobran y cómo se escribe
documentación de la que se pueda generar un manual. El ejercicio es documentar una
función con JSDoc y generar la documentación con una herramienta.

## Qué pide el enunciado

Documentar esta función con JSDoc, explicando parámetros, valor de retorno y
ejemplos, y generar la documentación:

```js
function validarDNI(numeroDNI, letra) {
  const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
  return letras[numeroDNI % 23] === letra.toUpperCase();
}
```

## Paso a paso

### 1 · El bloque JSDoc

```js
/**
 * Comprueba si la letra de un DNI se corresponde con su número.
 *
 * @description Calcula la letra que le toca al número según la tabla oficial
 * (el número se divide entre 23 y se toma el resto) y la compara con la letra
 * que ha escrito el usuario, sin distinguir mayúsculas de minúsculas.
 *
 * @param {number|string} numeroDNI - Parte numérica del DNI, de 0 a 8 cifras.
 * @param {string} letra - Letra del DNI, en mayúscula o en minúscula.
 * @returns {boolean} true si la letra es la correcta; false si no lo es.
 *
 * @example
 * validarDNI(12345678, "Z");    // true
 * validarDNI("12345678", "z");  // true
 * validarDNI(12345678, "A");    // false
 */
```

| Etiqueta | Para qué sirve |
|---|---|
| `@description` | explica el algoritmo, no lo repite |
| `@param {tipo}` | nombre, tipo y significado de cada parámetro |
| `@returns {tipo}` | qué devuelve y cuándo |
| `@example` | un caso de uso real, que se puede copiar |

### 2 · Generar la documentación

```bash
npx jsdoc validacion.js -d docs
```

JSDoc lee los comentarios y genera una web con la lista de funciones, sus
parámetros y los ejemplos. No hace falta escribir el manual a mano: el manual sale
del código.

### 3 · La versión endurecida

La función original falla con datos raros (`null`, letras de dos caracteres, texto
en el número). La versión completa comprueba antes de calcular:

```js
function validarDNI(numeroDNI, letra) {
  const numero = Number(numeroDNI);
  if (!Number.isInteger(numero) || numero < 0 || numero > 99999999) return false;
  if (typeof letra !== "string" || letra.length !== 1) return false;

  const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
  return letras[numero % 23] === letra.toUpperCase();
}
```

### 4 · El banco de pruebas

Se prueban los casos límite: DNI correcto, letra en minúscula, letra incorrecta,
número como texto, `null`, cadena vacía y número fuera de rango. Cada uno con el
resultado esperado.

## El código, pieza a pieza

```
Tema 2.7/
├── actividad-1.js    función documentada + pruebas
├── capturas/         documentación generada
└── Actividades Tema 2.7.md
```

## Trampas y dudas

- **Un comentario que repite el código no sirve.** `// suma 1` sobre `i++` sobra.
- **JSDoc no valida nada.** Si el `@param` dice `number` y le pasas texto, no
  protesta: es documentación, no un tipo.
- **Los comentarios se quedan viejos.** Si cambias la función y no el comentario,
  el comentario miente, y eso es peor que no tenerlo.

## Si me preguntan

- **¿Qué comentarios merecen la pena?** Los que explican **por qué** se hace algo,
  no **qué** hace (eso ya se ve en el código).
- **¿Para qué JSDoc y no comentarios normales?** Porque sigue un formato que las
  herramientas entienden y convierten en documentación navegable.
- **¿Documentar todo?** Las funciones públicas y las que tienen lógica no obvia. Un
  `getElementById` no necesita presentación.
