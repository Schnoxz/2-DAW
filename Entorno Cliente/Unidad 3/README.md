# Unidad 3 — Objetos predefinidos del lenguaje

Material de la unidad nueva de DWEC. Los enunciados son **documentos de Google
Docs** (enlaces oficiales de la asignatura), descargados aquí en PDF:

| Tarea de Moodle | Vence | Enunciado | Enlace Google Docs |
|---|---|---|---|
| 3.1. OBJETOS PREDEFINIDOS DEL LENGUAJE (assign) | 18/11/26, 0:00 | `Tema 3.1\3.1. OBJETOS PREDEFINIDOS DEL LENGUAJE.pdf` | https://docs.google.com/document/d/1_lZXDQvWVRTh85jLGc_v6nL_1vCa53FwgVD9OVIp1U0/edit?usp=sharing |
| 3.1.1 El Objeto Global Temporal (assign) | 19/11/26, 0:00 | `Tema 3.1.1\3.1.1 El Objeto Global Temporal.pdf` | https://docs.google.com/document/d/1NXxd_H8725rGF3C11LJznncD6QbttjN0TUuEmUoAE8g/edit?tab=t.0#heading=h.o0vy6l7dp657 |
| 3.2. ARQUITECTURA Y JERARQUÍA DEL BOM (url, teoría) | — | `Tema 3.2\3.2. Arquitectura y jerarquia del BOM.pdf` | https://docs.google.com/document/d/1kqh4RebQSIRTnNVa2h2lr2ZqDyk1yDpsMS1vIIJa060/edit?usp=sharing |

## Qué pide cada una

**3.1 (RA3, CE 3.a)** — Teoría de `Math`, `crypto`, `Date`, wrappers
(`String`, `Number`) y `globalThis`. Cuatro actividades:

1. **Actividad 3.1.1** — Descifrar el rango y los decimales de 5 funciones con
   `Math.random()` (A–E, más las flechas `numeroA`/`numeroB` y la `F` de enteros
   grandes).
2. **Actividad 3.1.2** — Función única `generarAleatorio(min, max, decimales)`
   con control de errores (`throw new Error` si `min > max`), devolviendo
   `Number`, y un cuarto parámetro `seguro` que use `cryptoRandomFloat()`.
3. **Actividad 3.1.3** — Validador de facturación: formulario que recoge un
   precio «sucio» (comas, €, espacios), lo limpia con `trim()` + reemplazo de
   comas, valida con `Number.isNaN()` y `Number.isFinite()`, calcula IVA y PVP
   con `toFixed(2)`.
4. **Actividad 3.1.4** — Generador de matrículas DGT: 4 dígitos con
   `padStart(4, "0")` + 3 letras consonantes aleatorias (sin vocales ni Ñ ni Q).

**3.1.1 (Temporal)** — Teoría de la API `Temporal` (ES2026, sustituta de
`Date`): `PlainDate`, `PlainTime`, `ZonedDateTime`, `Duration`, `Now`,
inmutabilidad, DST y carga condicional del polyfill. Una actividad:

- **Actividad 3.1.8** — «Gestor de Plazos de Matrícula y Convocatorias»:
  fechas base con `Temporal.PlainDate`, plazos con `.add()` demostrando que
  la fecha original no muta, cuenta atrás con `Temporal.Now.plainDateISO()` +
  `.until()`, y proyección Madrid→Tokio con `.withTimeZone()`.

**3.2 (BOM)** — Teoría de la arquitectura y jerarquía del Browser Object Model
(`window`, `navigator`, `location`, `history`, `screen`, `document`). Es un
recurso tipo enlace, no una entrega: el PDF de `Tema 3.2\` es la exportación del
Google Doc del profesor.

## Pendiente de decidir

- Qué archivos de entrega pide exactamente cada tarea (el `assign` de Moodle
  tiene descripción corta: mirar los Docs o preguntar al profesor).
- La librería `cryptoRandomFloat()` está explicada en el PDF de 3.1 (usa
  `window.crypto.getRandomValues` sobre un `Uint32Array`).

## Estado

| Tarea | Estado | Dónde |
|---|---|---|
| 3.1 | Resuelta y verificada en navegador; pendiente de subir | `Tema 3.1\` |
| 3.1.1 | Resuelta y verificada con Temporal nativo y con polyfill; pendiente de subir | `Tema 3.1.1\` |
| 3.2 | Teoría descargada; no es entregable | `Tema 3.2\` |

`Tema 3.1\` contiene `index.html` con las cuatro actividades, `css/`,
`js/` (una librería por actividad), la memoria `Entrega Tema 3.1.pdf`
(11 págs.) y una carpeta por actividad con su código y sus capturas:

| Carpeta | Actividad | Contenido |
|---|---|---|
| `Ejercicio 1\` | 3.1.1 · Rangos de `Math.random()` | `script.js`, `capturas/31-1-rangos.png` |
| `Ejercicio 2\` | 3.1.2 · `generarAleatorio()` | `script.js`, `capturas/31-2-generar.png` |
| `Ejercicio 3\` | 3.1.3 · Facturación | `index.html`, `script.js`, `capturas/` |
| `Ejercicio 4\` | 3.1.4 · Matrículas y UUID | `index.html`, `script.js`, `capturas/` |

`Tema 3.1.1\` contiene `index.html`, `js/plazos.js` (carga condicional del
polyfill incluida), `css/`, `vendor/temporal-polyfill.global.min.js` (copia
local del polyfill, MIT, para que funcione sin conexión), `capturas/` y la
memoria `Entrega Tema 3.1.1.pdf` (9 págs.). Solo tiene una actividad (3.1.8),
así que la entrega entera hace de «Ejercicio 1».

## Teoría

Cada tema guarda su PDF de teoría en su propia carpeta:

| Tema | PDF de teoría |
|---|---|
| 3.1 | `Tema 3.1\3.1. OBJETOS PREDEFINIDOS DEL LENGUAJE.pdf` |
| 3.1.1 | `Tema 3.1.1\3.1.1 El Objeto Global Temporal.pdf` |
| 3.2 | `Tema 3.2\3.2. Arquitectura y jerarquia del BOM.pdf` |

> Se eliminó la copia duplicada de los PDFs 3.1 y 3.1.1 que estaba suelta en la
> raíz de `Unidad 3\`.

> El PDF del profesor trae una errata en `cryptoRandomFloat()`: escribe
> `return buffer / 4294967296;`, que divide el array y devuelve `NaN`. Lo
> correcto es `buffer[0] / 4294967296`. En la entrega está corregido y
> comentado.
