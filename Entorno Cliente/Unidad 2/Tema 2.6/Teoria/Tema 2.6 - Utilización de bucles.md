# Tema 2.6 — Utilización de bucles (Criterio 2.f)

> **RA2**: Escribe sentencias simples, aplicando la sintaxis del lenguaje y verificando su ejecución sobre navegadores Web.
> **CE 2.f**: Se han utilizado bucles y se ha verificado su funcionamiento.
> **Ponderación**: 20% del RA2 | 1% sobre la calificación final del módulo.

---

## 1. Qué es un bucle y por qué se necesita

Un **bucle** (o estructura repetitiva) es un mecanismo que ejecuta un mismo bloque de sentencias varias veces de forma automática **mientras se cumpla una condición**.

Sin bucles, procesar una lista de 50 facturas obligaría a repetir el mismo bloque de código 50 veces: código imposible de mantener. Los bucles parametrizan la repetición.

En desarrollo cliente los bucles son imprescindibles para:

- Recorrer colecciones de datos (arrays, respuestas JSON).
- Generar nodos del DOM dinámicamente.
- Procesar respuestas estructuradas de servicios externos (`fetch`).

**Partes comunes a todo bucle:**

| Parte | Función |
|---|---|
| Inicialización | Crea la variable de control (`let i = 0`) |
| Condición | Se evalúa cada vuelta; si es `false`, el bucle termina |
| Cuerpo | Bloque de instrucciones a repetir |
| Actualización | Modifica la variable de control (`i++`) para acercarse a la salida |

> ⚠️ Si falta la actualización, la condición nunca cambia → **bucle infinito** que congela la pestaña del navegador.

---

## 2. `while` — comprobación al inicio

Comprueba la condición **antes** de ejecutar nada. Si es falsa desde el principio, el cuerpo no se ejecuta ni una vez (**0 iteraciones**).

```js
while (condicion) {
  // Instrucciones que se repiten mientras la condición sea true
  // Instrucción de avance/actualización (OBLIGATORIA)
}
```

**Ejemplo guiado:**

```js
let pase = 0;                        // 1. Inicialización

while (pase < 5) {                   // 2. Condición de entrada
  console.log(`Pase número ${pase + 1}`);  // 3. Cuerpo
  pase++;                            // 4. Actualización (+1)
}

console.log("Fin del bucle while.");
```

**El peligro del bucle infinito:** si se olvida `pase++;`, la variable vale siempre 0, `0 < 5` es siempre `true` y la pestaña se congela.

**Cuándo usarlo:** cuando no se sabe de antemano cuántas vueltas harán falta (leer hasta que el usuario escriba "salir", procesar hasta agotar una cola...).

---

## 3. `do...while` — comprobación al final

La condición se evalúa **después** de ejecutar el bloque, así que el cuerpo se ejecuta **siempre al menos una vez**, aunque la condición sea falsa desde el primer instante.

```js
do {
  // Se ejecuta al menos una primera vez
} while (condicion);   // <- no olvidar el punto y coma
```

**Ejemplo guiado: buscar los primeros 5 números pares**

```js
let contadorPares = 0;
let numeroActual = 1;

do {
  if (numeroActual % 2 === 0) {
    console.log(`Número par detectado: ${numeroActual}`);
    contadorPares++;
  }
  numeroActual++;
} while (contadorPares < 5);

console.log("Se han encontrado los 5 primeros números pares.");
```

**Comparativa directa:**

```js
let llaveAcceso = false;

while (llaveAcceso === true) {
  console.log("NUNCA se imprime (0 vueltas)");
}

do {
  console.log("Se imprime EXACTAMENTE 1 VEZ, aunque la condición sea false");
} while (llaveAcceso === true);
```

| | `while` | `do...while` |
|---|---|---|
| Comprobación | Al inicio | Al final |
| Iteraciones mínimas | 0 | 1 |
| Caso típico | Recorrer mientras haya datos | Pedir y validar un dato (prompt, formularios) |

---

## 4. `for` — determinado por contador

Se usa cuando **se conoce el número de iteraciones** o se trabaja con contadores estructurados. Compacta en una línea inicialización, condición y actualización.

```js
for (expresionInicial; expresionCondicional; expresionDeActualizacion) {
  // Bloque de instrucciones
}
```

1. **`expresionInicial`** — se ejecuta **una sola vez** al arrancar (normalmente `let i = ...`, aislando el ámbito para que la variable desaparezca al terminar).
2. **`expresionCondicional`** — se evalúa **antes de cada vuelta**; `true` entra al cuerpo, `false` termina.
3. **`expresionDeActualizacion`** — se ejecuta **al final de cada iteración** (`i++`, `i--`, `i += 5`...).

**Ejemplo guiado: tabla de multiplicar**

```js
const FACTOR = 9;

for (let i = 1; i <= 10; i++) {
  console.log(`${FACTOR} x ${i} = ${FACTOR * i}`);
}
```

**Otros patrones:**

```js
// Decreciente: cuenta del 10 al 0
for (let i = 10; i >= 0; i--) {
  console.log(i);
}

// Recorrer un array al revés
const herramientas = ["Martillo", "Destornillador", "Alicates"];
for (let i = herramientas.length - 1; i >= 0; i--) {
  console.log(`Índice ${i}: ${herramientas[i]}`);
}

// Paso de 5 en 5
for (let i = 20; i >= 0; i -= 5) {
  console.log(i);   // 20, 15, 10, 5, 0
}
```

### Las tres piezas se pueden omitir

```js
// Sin inicialización: la variable ya existe fuera
const coches = ["Toyota", "Kia", "Citroen", "Ford"];
let i = 2;
for (; i < coches.length; i++) {
  console.log(coches[i]);
}

// Sin condición: asume true → exige un break para no ser infinito
for (let k = 0; ; k++) {
  if (k > 10) break;    // salida controlada
  console.log(k);
}

// Sin incremento: se gestiona dentro del cuerpo
let j = 0;
for (; j < 5; ) {
  console.log("Valor:", j);
  j++;
}
```

---

## 5. Bucles modernos de colección

### 5.1 `for...of` — recorrido de **valores** (arrays y cadenas)

Recomendado desde ES6: no necesita contadores manuales.

```js
const lenguajes = ["JavaScript", "TypeScript", "Python"];

for (const elemento of lenguajes) {
  console.log("Lenguaje en catálogo:", elemento);
}
// JavaScript, TypeScript, Python
```

- Devuelve el **valor**, no el índice.
- Sí permite `break` y `continue`.
- Respeta el orden y no ve propiedades heredadas del prototipo.

### 5.2 `for...in` — recorrido de **claves** (objetos)

```js
const configuracion = { servidor: "localhost", puerto: 8080, ssl: true };

for (const propiedad in configuracion) {
  console.log(`Clave: ${propiedad} | Valor: ${configuracion[propiedad]}`);
}
```

**No debe usarse para arrays.** Los 3 problemas:

1. **Tipado incorrecto** — los índices llegan como cadenas (`"0"`, `"1"`), así que `indice + 1` da `"01"` en vez de `1`.
2. **Contaminación del prototipo** — si alguien añade `Array.prototype.nuevoMetodo`, `for...in` lo lista como si fuera un elemento más.
3. **Sin orden garantizado** — no asegura el orden numérico/cronológico de las claves.

```js
Array.prototype.nuevoMetodo = "¡Soy un nuevo método!";
const colores = ["rojo", "azul"];

for (const indice in colores) {
  console.log(`Índice: ${indice} (Tipo: ${typeof indice}) -> ${colores[indice]}`);
}
// Índice: 0 (Tipo: string) -> rojo
// Índice: 1 (Tipo: string) -> azul
// Índice: nuevoMetodo (Tipo: string) -> ¡Soy un nuevo método!   ← basura
```

### 5.3 `forEach` — alternativa funcional

Índice **numérico**, orden correcto e ignora las propiedades del prototipo:

```js
const colores = ["rojo", "azul", "verde"];
colores.forEach((color, index) => {
  console.log(`Índice: ${index} (Tipo: ${typeof index}) -> ${color}`);
});
```

**Tres reglas estrictas:**

1. **No admite `break` ni `continue`** → si hay que cortar, usa `for...of`.
2. **Ignora los huecos** de los arrays dispersos (`[1, , 3]`): un bucle clásico o `for...of` devolvería `undefined` en esa posición, `forEach` la salta.
3. No se puede detener ni pausar desde dentro.

### Resumen de elección

| Situación | Bucle |
|---|---|
| Número de vueltas conocido / contador | `for` |
| Recorrer valores de un array o cadena | `for...of` |
| Recorrer claves de un objeto | `for...in` |
| Acción por elemento + índice, sin cortes | `forEach` |
| Sin saber cuántas vueltas, condición al inicio | `while` |
| Pedir dato y validarlo (al menos 1 vuelta) | `do...while` |

---

## 6. Estructuras de salto y control

### `break` — interrupción inmediata

Aborta el bucle y salta a la línea siguiente a su llave de cierre:

```js
for (let i = 1; i <= 10; i++) {
  if (i === 6) {
    console.log("Corte de emergencia en i = 6");
    break;
  }
  console.log(`Vuelta actual: ${i}`);
}
// Imprime solo del 1 al 5
```

### `continue` — salto a la siguiente vuelta

Descarta lo que quede en la iteración actual y pasa a la siguiente evaluación (y actualización, en `for`):

```js
for (let n = 1; n <= 6; n++) {
  if (n % 2 === 0) continue;   // pares: salta
  console.log(`Impar: ${n}`);  // 1, 3, 5
}
```

### Declaraciones etiquetadas (`labels`)

Asocian un identificador a un bucle (o bloque) externo para que un `break`/`continue` interno rompa el nivel exterior, sin banderas intermedias:

```js
bucleMatriz: for (let fila = 1; fila <= 3; fila++) {
  for (let columna = 1; columna <= 3; columna++) {
    if (fila === 2 && columna === 2) {
      console.log("Coincidencia. Abortando matriz completa.");
      break bucleMatriz;   // rompe el for exterior
    }
  }
}
```

También sirve para romper un **bloque etiquetado** cualquiera:

```js
const coches = ["BMW", "Volvo", "Saab", "Ford"];
let texto = "";

list: {
  texto += coches[0] + " ";
  texto += coches[1] + " ";
  break list;               // sale del bloque aquí
  texto += coches[2] + " ";
  texto += coches[3] + " ";
}

console.log(texto);   // "BMW Volvo "
```

---

## 7. Errores frecuentes y cómo verificarlos

1. **Bucle infinito** → olvidar la actualización o escribir `=` en vez de `==`/`===` en la condición. Síntoma: la pestaña se queda en blanco y el navegador no responde.
2. **Modificar un array mientras se lo recorre** (`splice` dentro de un `for` creciente): al borrar, los elementos siguientes se desplazan y el `i++` se salta uno. Solución: recorrer **de atrás hacia delante** o usar `filter()`. *(Es exactamente lo que ocurre en la Actividad 1.)*
3. **`for...in` sobre arrays** → índices como texto y propiedades basura del prototipo.
4. **`forEach` con `break`/`continue`** → error de sintaxis; usar `for...of`.
5. **Olvidar el `;` final** del `do...while`.

**Verificación en el navegador (requisito del criterio 2.f):** abrir DevTools con `F12` → pestaña **Console**, ejecutar el script y comprobar la salida impresa; o crear un archivo `.js`, enlazarlo con `<script src="..."></script>` y recargar la página.

---

## 8. Mapa del tema

```
Bucles
├── while        → comprobación al inicio   (0..n vueltas)
├── do...while   → comprobación al final     (1..n vueltas)
├── for          → contador conocido         (init; cond; actualización)
├── for...of     → valores de arrays/cadenas
├── for...in     → claves de objetos (⚠️ no para arrays)
├── forEach      → acción por elemento, sin break/continue
└── Control      → break, continue, etiquetas (labels)
```

**Archivos de la práctica:** `../Actividades Tema 2.6.md`, `../actividad-1.js`, `../actividad-2.js`, `../actividad-3.js`.
