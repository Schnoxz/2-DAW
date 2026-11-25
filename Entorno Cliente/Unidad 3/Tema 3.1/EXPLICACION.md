# Tema 3.1 · Cómo está resuelto

## De qué va

El tema es el primer bloque de objetos predefinidos: `Math`, `crypto`, los
*wrappers* (`String`, `Number`), `Date` y `globalThis`. La entrega son cuatro
actividades que se resuelven con esos objetos, sin DOM complicado ni formularios
difíciles.

Todo está en un `index.html` con cuatro paneles, una hoja de estilos común y un
JavaScript por actividad:

```
index.html
css/estilos.css
js/aleatorio.js        3.1.1 y 3.1.2
js/crypto-aleatorio.js 3.1.2 (generador seguro)
js/facturacion.js      3.1.3
js/matriculas.js       3.1.4
```

## Qué pide el enunciado

1. **3.1.1** · Deducir el rango y los decimales de ocho funciones que usan
   `Math.random()` de formas distintas (A–F, más dos con flecha).
2. **3.1.2** · Escribir una función `generarAleatorio(min, max, decimales)` que
   devuelva un número, que controle los errores con `throw` y que admita un
   cuarto parámetro para usar un generador criptográfico.
3. **3.1.3** · Validador de facturación: recoger un precio «sucio»
   (`1.234,56 €`), limpiarlo, validarlo y calcular IVA y PVP con dos decimales.
4. **3.1.4** · Generador de matrículas de la DGT (4 dígitos + 3 consonantes) y,
   de propina, un identificador único.

## Paso a paso

### 3.1.1 · Los rangos

`Math.random()` devuelve un decimal en `[0, 1)`: el 0 puede salir, el 1 nunca.
Para pasar a enteros se usa `Math.floor()`, que trunca hacia abajo.

La fórmula general de un entero entre `min` y `max` es:

```js
Math.floor(Math.random() * (max - min + 1)) + min
```

El `+ 1` es lo que hace que el máximo pueda salir. Si el intervalo es de 10 a 20,
hay 11 valores posibles (10, 11, …, 20); sin el `+ 1` habría 10 y el 20 no saldría
nunca.

Cada función es esa fórmula con números distintos:

```js
// Entero entre 10 y 20
const enteroBase = Math.floor(Math.random() * (10 + 1)) + 10;
```

Para los decimales se hace al revés: se genera el entero, se divide para bajar de
escala y se fija el número de decimales con `toFixed()`.

```js
// Dos decimales entre 5.00 y 15.00
const enteroBase = Math.floor(Math.random() * (1500 - 500 + 1)) + 500;
return Number((enteroBase / 100).toFixed(2));
```

`toFixed()` devuelve **texto**, así que se envuelve en `Number()` para que la
función devuelva un número y no una cadena.

La comprobación se hace midiendo 20.000 tiradas de cada función y comparando el
mínimo y el máximo observados con el rango teórico.

### 3.1.2 · `generarAleatorio()`

La función tiene que servir para enteros y para decimales, así que se separan los
dos casos:

```js
function generarAleatorio(min = 0, max = 100, decimales = 0, seguro = "normal") {
  if (min > max) {
    throw new Error(`El mínimo (${min}) no puede ser mayor que el máximo (${max}).`);
  }
  if (!Number.isInteger(decimales) || decimales < 0) {
    throw new Error("Los decimales tienen que ser un entero mayor o igual que 0.");
  }

  const aleatorio = seguro === "segura" ? cryptoRandomFloat() : Math.random();

  if (decimales === 0) {
    return Math.floor(aleatorio * (max - min + 1)) + min;
  }

  const valor = min + aleatorio * (max - min);
  return Number(valor.toFixed(decimales));
}
```

Detalles que conviene saber:

- Con **enteros** se suma 1 a la amplitud, porque el intervalo es cerrado.
- Con **decimales** no se suma 1: el intervalo es continuo y sumar 1 desplazaría
  el resultado.
- `Number.isInteger()` valida los decimales sin aceptar `2.5` ni `-1`.
- El `throw` se captura en la página con `try/catch` y se muestra en rojo.

El generador seguro está en su propio archivo:

```js
function cryptoRandomFloat() {
  const buffer = new Uint32Array(1);
  crypto.getRandomValues(buffer);
  return buffer[0] / 4294967296;
}
```

`getRandomValues()` rellena el array con bytes del sistema operativo. Se divide
entre `2^32` para que el resultado caiga en `[0, 1)`, igual que `Math.random()`.

### 3.1.3 · Facturación

El trabajo real es limpiar el texto. Un importe puede venir como `1.234,56 €`,
`12,50` o `12.50`, y `Number()` no entiende ni el euro ni la coma decimal.

```js
let limpio = texto.trim().replace(/€/g, "").replace(/\s/g, "");
if (limpio.includes(",") && limpio.includes(".")) {
  limpio = limpio.replace(/\./g, "").replace(",", ".");
} else {
  limpio = limpio.replace(",", ".");
}
```

Si aparecen los dos signos, el punto es de miles y la coma es decimal: se quitan
los puntos y se cambia la coma. Si solo hay coma, es el decimal.

Después se valida con `Number.isNaN()` y `Number.isFinite()`. Las dos hacen falta:
`isNaN()` detecta el texto que no es número, e `isFinite()` descarta `Infinity`,
que sí pasaría la primera.

Y se calcula:

```js
const cuota = base * iva / 100;
const pvp = base + cuota;
```

### 3.1.4 · Matrículas y UUID

Los cuatro dígitos se generan con la función del ejercicio 2 y se rellenan con
ceros a la izquierda:

```js
const numero = String(generarAleatorio(0, 9999)).padStart(4, "0");
```

`padStart(4, "0")` convierte `7` en `0007`. Sin eso saldría `7 BCD`.

Las letras salen de una cadena sin vocales, sin Ñ y sin Q, que son las que la DGT
no usa:

```js
const CONSONANTES_DGT = "BCDFGHJKLMNPRSTVWXYZ";
```

Para el identificador se usa `crypto.randomUUID()` si existe. Si no, se arma a
mano con 16 bytes aleatorios, forzando los bits de versión y variante:

```js
bytes[6] = (bytes[6] & 0x0f) | 0x40;  // versión 4
bytes[8] = (bytes[8] & 0x3f) | 0x80;  // variante RFC 4122
```

## Trampas y dudas

- **`toFixed()` devuelve texto.** Si no se envuelve en `Number()`, la función
  devuelve `"5.00"` y al sumar concatenaría.
- **`Number("")` vale 0.** Por eso el campo vacío se descarta antes de convertir,
  o el validador aceptaría una base de 0 €.
- **`isNaN()` global convierte el valor.** `Number.isNaN("abc")` es `false`
  (porque no es un número, es texto); el `isNaN()` antiguo diría `true`. Se usa la
  versión de `Number`.
- **El máximo en `Math.random()`.** Con `* 10` nunca sale el 10. Hay que multiplicar
  por la cantidad de valores, no por la diferencia.

## Si me preguntan

- **¿Por qué `Math.floor` y no `Math.round`?** Porque `floor` reparte los valores
  por igual; `round` daría el doble de probabilidad a los extremos.
- **¿Para qué sirve `crypto` aquí?** `Math.random()` es predecible si se conoce el
  estado interno. Para contraseñas, tokens o identificadores hace falta
  `crypto.getRandomValues()`, que usa la entropía del sistema.
- **¿Qué diferencia hay entre primitivo y objeto?** `typeof 25` es `"number"` y
  `typeof new Number(25)` es `"object"`. El motor envuelve el primitivo un instante
  para poder llamar a `.toFixed()`, pero `25 === new Number(25)` es `false`.
