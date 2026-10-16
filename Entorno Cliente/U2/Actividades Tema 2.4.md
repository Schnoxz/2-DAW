### 1. El enigma de la igualdad con booleanos

Enunciado: explicar por qué `if ("0" == false)` entra al bloque y por qué, además, `if ("0")` también se considera verdadero.

```js
// Caso A
if ("0" == false) {
  console.log("A se cumple");
}

// Caso B
if ("0") {
  console.log("B se cumple");
}
```

Parece contradictorio que el mismo valor sea igual a `false` y a la vez se tome como verdadero, pero las dos instrucciones no hacen la misma pregunta.

Caso A, `"0" == false`. El operador `==` es igualdad abstracta: si los tipos no coinciden, intenta igualarlos antes de comparar. Al comparar un número con un booleano convierte el booleano a número, y al comparar un número con un texto convierte el texto a número. Los dos lados acaban siendo números: `Number(false)` es `0` y `Number("0")` es `0`. Como `0 == 0`, la condición es verdadera.

Caso B, `if ("0")`. Aquí no hay comparación, la condición se evalúa directamente como truthy o falsy. JavaScript maneja una lista cerrada de valores falsy:

```
false, 0, -0, 0n, "" (cadena vacía), null, undefined, NaN
```

La cadena `"0"` no está vacía (contiene el carácter `0`) y no pertenece a esa lista, así que es truthy y también entra al bloque.

La diferencia está en la pregunta. `"0" == false` comprueba si el valor numérico de `"0"` coincide con el de `false`, y responde que sí. `if ("0")` comprueba si `"0"` es un valor truthy, y también responde que sí. No hay contradicción porque una es una comparación con coerción y la otra es una evaluación de veracidad.

Queda un detalle que conviene recordar: `"0" == false` es verdadero, pero `"0" === false` es falso, porque la igualdad estricta exige el mismo tipo. Lo mismo ocurre con `"" == false`, verdadero por conversión a `0`. Es el motivo por el que conviene usar siempre `===`.

### 2. Práctica guiada: inspector de conversiones y tipado débil

Escenario: los campos de formulario devuelven siempre texto, y las respuestas JSON del backend pueden traer booleanos, números, nulos o matrices serializadas. Hay que programar desde cero `laboratorio_conversiones.js`, sin modificar el HTML ni el CSS entregados.

El HTML y el CSS ya vienen dados en el enunciado (`laboratorio_conversiones.html` y `estilos.css`), así que solo escribo el JavaScript. Puedo reutilizar código de prácticas anteriores.

Antes de empezar hay un punto que condiciona todo: para probar primitivos reales (números, `false`, `[]`, `null`...) hay que interpretar el texto del input. Si se escribe `false`, JavaScript lo recibe como el texto `"false"`; para obtener el booleano de verdad uso `JSON.parse`. Los literales que no son JSON válido, como `undefined` y `NaN`, se resuelven a mano.

#### Hito 1: captura de eventos y normalización del dato de entrada

```js
const btnAnalizar = document.getElementById("btnAnalizar");
const txtEntrada = document.getElementById("txtEntrada");
const pantallaSalida = document.getElementById("pantallaSalida");

btnAnalizar.addEventListener("click", analizarCoercion);

function analizarCoercion() {
  const textoEntrada = txtEntrada.value.trim();

  // Normalización del texto a un primitivo real
  let valorReal;
  try {
    valorReal = JSON.parse(textoEntrada);
  } catch (error) {
    // Casos que no son JSON válido pero representan primitivos en JS
    if (textoEntrada === "undefined") {
      valorReal = undefined;
    } else if (textoEntrada === "NaN") {
      valorReal = NaN;
    } else {
      valorReal = textoEntrada; // cadena alfanumérica pura
    }
  }
```

`JSON.parse` no admite `undefined` ni `NaN`, porque no son JSON válido; por eso el bloque `catch` los resuelve a mano. El resto de valores (`0`, `false`, `null`, `[]`, `"texto"` entre comillas) sí los interpreta correctamente.

#### Hito 2: conversión explícita y diagnóstico de tipos

```js
  const comoNumero   = Number(valorReal);
  const comoCadena   = String(valorReal);
  const comoBooleano = Boolean(valorReal);
  const tipoOriginal = typeof valorReal;
```

Uso las funciones constructoras `Number()`, `String()` y `Boolean()` para forzar las tres representaciones, y `typeof` para informar del tipo del dato original.

#### Hito 3: detección de anomalías de coerción

```js
  // Anomalía 1: la cadena "0" es truthy
  let alertaCero = "";
  if (valorReal === "0" && comoBooleano === true) {
    alertaCero = '<strong class="alerta">Aviso: "0" es una cadena NO vacía, por tanto es TRUTHY (aunque Number("0") sea 0)</strong><br>';
  }

  // Anomalía 2: la matriz vacía se coerciona a 0
  let alertaMatriz = "";
  if (Array.isArray(valorReal) && valorReal.length === 0 && comoNumero === 0) {
    alertaMatriz = '<strong class="alerta">Aviso: una matriz vacía [] se coerciona al número 0</strong><br>';
  }
```

La primera comprobación se hace sobre el valor ya normalizado (`valorReal === "0"`), que es más fiable que comparar contra el texto del input. La segunda usa `Array.isArray` porque `typeof []` devuelve `"object"` y no distinguiría una matriz.

#### Hito 4: prueba en vivo de suma frente a resta

```js
  const suma  = valorReal + 10;
  const resta = valorReal - 10;
```

Guardo los dos resultados y sus tipos para contrastarlos en pantalla. El operador `+` concatena cuando hay texto, mientras que `-` fuerza siempre la resta numérica.

#### Hito 5: control estricto con `Number.isNaN()`

```js
  let alertaNaN = "";
  if (Number.isNaN(comoNumero)) {
    alertaNaN = '<strong class="alerta">Conversión numérica fallida: No es un número válido</strong><br>';
  }
```

Uso `Number.isNaN()` y no `valor === NaN`, porque una comparación con `NaN` es siempre falsa, incluso `NaN === NaN`. El método estricto sí detecta el valor.

#### Hito 6: inyección estructurada en el DOM

```js
  pantallaSalida.innerHTML =
    `<strong>Valor analizado:</strong> <span class="valor-resaltado">${comoCadena}</span> (typeof: ${tipoOriginal})<br>` +
    `<strong>Como Número [Number(x)]:</strong> <span class="valor-resaltado">${comoNumero}</span> (typeof: ${typeof comoNumero})<br>` +
    `<strong>Como Cadena [String(x)]:</strong> <span class="valor-resaltado">${comoCadena}</span> (typeof: ${typeof comoCadena})<br>` +
    `<strong>Como Booleano [Boolean(x)]:</strong> <span class="valor-resaltado">${comoBooleano}</span> (typeof: ${typeof comoBooleano})<br>` +
    `<hr>` +
    `<strong>${comoCadena} + 10 →</strong> <span class="valor-resaltado">${suma}</span> (typeof: ${typeof suma})<br>` +
    `<strong>${comoCadena} - 10 →</strong> <span class="valor-resaltado">${resta}</span> (typeof: ${typeof resta})<br>` +
    alertaCero + alertaMatriz + alertaNaN;
}
```

Se emplean las etiquetas `<strong>` y `<span>` con la clase `.valor-resaltado` que ya define el CSS, y saltos `<br>` para separar líneas.

#### Archivo completo `laboratorio_conversiones.js`

```js
// Hito 1: referencia a los nodos del DOM
const btnAnalizar = document.getElementById("btnAnalizar");
const txtEntrada = document.getElementById("txtEntrada");
const pantallaSalida = document.getElementById("pantallaSalida");

btnAnalizar.addEventListener("click", analizarCoercion);

function analizarCoercion() {
  const textoEntrada = txtEntrada.value.trim();

  // Normalización del texto a un primitivo real
  let valorReal;
  try {
    valorReal = JSON.parse(textoEntrada);
  } catch (error) {
    if (textoEntrada === "undefined") {
      valorReal = undefined;
    } else if (textoEntrada === "NaN") {
      valorReal = NaN;
    } else {
      valorReal = textoEntrada;
    }
  }

  // Hito 2: conversiones explícitas y tipo original
  const comoNumero   = Number(valorReal);
  const comoCadena   = String(valorReal);
  const comoBooleano = Boolean(valorReal);
  const tipoOriginal = typeof valorReal;

  // Hito 4: prueba en vivo suma frente a resta
  const suma  = valorReal + 10;
  const resta = valorReal - 10;

  // Hito 3: detección de anomalías
  let alertaCero = "";
  if (valorReal === "0" && comoBooleano === true) {
    alertaCero = '<strong class="alerta">Aviso: "0" es una cadena NO vacía, por tanto es TRUTHY (aunque Number("0") sea 0)</strong><br>';
  }

  let alertaMatriz = "";
  if (Array.isArray(valorReal) && valorReal.length === 0 && comoNumero === 0) {
    alertaMatriz = '<strong class="alerta">Aviso: una matriz vacía [] se coerciona al número 0</strong><br>';
  }

  // Hito 5: validación estricta de NaN
  let alertaNaN = "";
  if (Number.isNaN(comoNumero)) {
    alertaNaN = '<strong class="alerta">Conversión numérica fallida: No es un número válido</strong><br>';
  }

  // Hito 6: volcado estructurado en el DOM
  pantallaSalida.innerHTML =
    `<strong>Valor analizado:</strong> <span class="valor-resaltado">${comoCadena}</span> (typeof: ${tipoOriginal})<br>` +
    `<strong>Como Número [Number(x)]:</strong> <span class="valor-resaltado">${comoNumero}</span> (typeof: ${typeof comoNumero})<br>` +
    `<strong>Como Cadena [String(x)]:</strong> <span class="valor-resaltado">${comoCadena}</span> (typeof: ${typeof comoCadena})<br>` +
    `<strong>Como Booleano [Boolean(x)]:</strong> <span class="valor-resaltado">${comoBooleano}</span> (typeof: ${typeof comoBooleano})<br>` +
    `<hr>` +
    `<strong>${comoCadena} + 10 →</strong> <span class="valor-resaltado">${suma}</span> (typeof: ${typeof suma})<br>` +
    `<strong>${comoCadena} - 10 →</strong> <span class="valor-resaltado">${resta}</span> (typeof: ${typeof resta})<br>` +
    alertaCero + alertaMatriz + alertaNaN;
}
```

#### Verificación con los casos de prueba

Resultados esperados al introducir cada valor del enunciado.

Entrada `0`: `Number` da `0`, `String` da `"0"`, `Boolean` da `false`. `0 + 10` da `10` (number) y `0 - 10` da `-10` (number). Sin alertas.

Entrada `"0"` (con comillas): `Number` da `0`, `String` da `"0"`, `Boolean` da `true`. `"0" + 10` da `"010"` (string, concatena) y `"0" - 10` da `-10` (number). Alerta: `"0"` es truthy.

Entrada `false`: `Number` da `0`, `String` da `"false"`, `Boolean` da `false`. `false + 10` da `10` y `false - 10` da `-10`, ambos number. Sin alertas.

Entrada `null`: `Number` da `0`, `String` da `"null"`, `Boolean` da `false`. `null + 10` da `10` y `null - 10` da `-10`, ambos number. Sin alertas.

Entrada `undefined`: `Number` da `NaN`, `String` da `"undefined"`, `Boolean` da `false`. `undefined + 10` y `undefined - 10` dan `NaN`. Salta la alerta de `Number.isNaN()`.

Entrada `[]`: `Number` da `0`, `String` da `""`, `Boolean` da `true`. `[] + 10` da `"10"` (string, concatena) y `[] - 10` da `-10` (number). Alerta: una matriz vacía coerciona a `0`.

Entrada `"texto"` (con comillas): `Number` da `NaN`, `String` da `"texto"`, `Boolean` da `true`. `"texto" + 10` da `"texto10"` (string) y `"texto" - 10` da `NaN`. Salta la alerta de `Number.isNaN()`.

Conclusiones de la prueba. El operador `+` es el que provoca la divergencia: `"0" + 10` da `"010"` como texto, mientras que `"0" - 10` da `-10` como número, con el mismo dato de partida. La matriz vacía es el caso más llamativo, ya que `Number([])` es `0`, `String([])` es `""` y `Boolean([])` es `true` a la vez. `null` y `false` se coercionan a `0` sin error, pero `undefined` y los textos no numéricos terminan en `NaN`. La validación de `NaN` se hace siempre con `Number.isNaN()`.

Con esto quedan cubiertos los seis hitos: normalización de la entrada con `try...catch`, las tres conversiones con su `typeof`, la detección de las anomalías de `"0"` y `[]`, el contraste entre `+` y `-`, la validación estricta de `NaN` y el volcado en el DOM con las clases del CSS.
