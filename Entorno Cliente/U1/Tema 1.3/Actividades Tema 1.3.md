# Actividades Prácticas y de Consolidación — Tema 1.3

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Fuente: apartado **G. Actividades Prácticas y de Consolidación** del tema «Identificación y caracterización de los principales lenguajes relacionados con la programación de clientes Web» (Criterio 1.3).
> Enunciado base: los apartados **A** (tríada HTML/CSS/JS), **B** (evolución de JavaScript), **C-D** (frameworks), **E** (vocabulario) y **F** (funciones en JavaScript).

## Índice de ejercicios

1. [Ejercicio 1 — La tríada fundamental: HTML, CSS y JavaScript](#ejercicio-1--la-tríada-fundamental-html-css-y-javascript)
2. [Ejercicio 2 — Formas de declarar funciones y *hoisting*](#ejercicio-2--formas-de-declarar-funciones-y-hoisting)
3. [Ejercicio 3 — Los ejercicios del 1.2 rehacidos con funciones](#ejercicio-3--los-ejercicios-del-12-rehechos-con-funciones)
4. [Ejercicio 4 — Programación reactiva: la hoja de cálculo](#ejercicio-4--programación-reactiva-la-hoja-de-cálculo)
5. [Ejercicio 5 — DOM Virtual y reconciliación](#ejercicio-5--dom-virtual-y-reconciliación)
6. [Ejercicio 6 — Programación orientada a componentes](#ejercicio-6--programación-orientada-a-componentes)
7. [Ejercicio 7 — Cronología de JavaScript y ECMAScript](#ejercicio-7--cronología-de-javascript-y-ecmascript)
8. [Ejercicio 8 — Comparativa de frameworks](#ejercicio-8--comparativa-de-frameworks)
9. [Ejercicio 9 — Test de vocabulario técnico](#ejercicio-9--test-de-vocabulario-técnico)

---

## Ejercicio 1 — La tríada fundamental: HTML, CSS y JavaScript

Cualquier página web se apoya sobre **tres lenguajes estándar**, cada uno con una responsabilidad independiente. Separarlos en **tres ficheros distintos**:

- `index.html` → estructura y semántica (**HTML**, lenguaje de marcado, no de programación).
- `estilos.css` → presentación y maquetación (**CSS**, lenguaje declarativo, sin lógica ni datos).
- `script.js` → lógica y reactividad (**JavaScript**, dinámico, débilmente tipado y orientado a eventos).

La página debe incluir un contador que demuestre que **JavaScript altera el documento sin recargar** y un botón que aplique una clase de **CSS** (por ejemplo, tema oscuro).

---

## Ejercicio 2 — Formas de declarar funciones y *hoisting*

El apartado F del tema distingue **tres formas** de declarar funciones. Construir una página con un botón por forma que muestre su resultado, y comprobar el comportamiento del *hoisting*:

```js
// A. Declaración tradicional — admite hoisting
function saludar(nombre) { return `Hola, ${nombre}`; }

// B. Expresión de función — sin hoisting
const duplicar = function (numero) { return numero * 2; };

// C. Funciones flecha (ES6) — retorno implícito
const sumar = (a, b) => a + b;
const cuadrado = x => x * x;
```

Invocar una función **antes** de la línea donde se define, para demostrar que solo la forma A sobrevive a esa situación.

---

## Ejercicio 3 — Los ejercicios del 1.2 rehacidos con funciones

> «Realiza los ejercicios del apartado anterior haciendo uso de funciones.»

Recuperar los ejercicios más representativos del tema 1.2 y reescribirlos **extrayendo el comportamiento a funciones**, de modo que cada uno aplique una forma distinta de declararlas:

- **1.2·4** Saludos multidioma → **declaración tradicional**.
- **1.2·1** Modificar el contenido → **expresión de función**.
- **1.2·7** Interfaz Consola / Estilo / Alerta → **funciones flecha**.

---

## Ejercicio 4 — Programación reactiva: la hoja de cálculo

> **Actividad Propuesta 1.1.** Averigua qué es la programación reactiva. Investiga cómo se comporta una hoja de cálculo cuando modificas una celda y las celdas dependientes se recalculan de inmediato.

Simular una hoja de cálculo donde las celdas de **fórmula** están **suscritas** a los datos de los que dependen:

- Columnas con datos editables (`input[type=number]`).
- Fórmulas que se recalculan **solas**, en cascada, sin pulsar ningún botón.
- Un registro que muestra el orden exacto de los recálculos.

---

## Ejercicio 5 — DOM Virtual y reconciliación

Manipular el DOM nativo es lento porque obliga al motor a recalcular geometrías y repintar píxeles. React mantiene una **copia ligera del DOM en memoria RAM** y, cuando cambian los datos, calcula las **diferencias mínimas** entre el DOM virtual y el real, actualizando solo los nodos necesarios.

Construir una simulación con una lista de productos que permita:

- **Renombrar** un producto y comprobar que se repinta **un solo nodo**.
- Añadir y quitar productos.
- Mostrar, en todo momento, cuántos nodos se han comparado frente a cuántos se han **realmente repintado**.

---

## Ejercicio 6 — Programación orientada a componentes

La interfaz no se diseña en un bloque monolítico, sino en piezas independientes y reutilizables (**componentes**), cada una con su **propio estado (state)** interno. Implementar al menos:

- Un **contador** con state propio.
- Una **tarjeta de producto** con state de favorito.
- Una **barra de navegación** con state de sección activa.

Comparar además **JSX** (escritura similar a HTML dentro del código) frente al JavaScript plano equivalente con `createElement()`.

---

## Ejercicio 7 — Cronología de JavaScript y ECMAScript

Ordenar cronológicamente los hitos del apartado B y recorrerlos interactivamente, siguiendo las cuatro fases del tema:

1. **Origen y estandarización temprana (1995-1999):** Mocha/JavaScript, JScript, ECMAScript 1, ES3.
2. **El estancamiento y la era AJAX (2000-2008):** fracaso de ES4, auge de AJAX, librerías de abstracción (jQuery).
3. **La madurez (2009):** ES5, motor V8 y Node.js.
4. **El punto de inflexión y la era moderna (2015+):** ES6 y publicaciones anuales con el proceso de 4 fases.

---

## Ejercicio 8 — Comparativa de frameworks

> **Actividad de análisis comparativo.** Elabora una tabla justificando qué framework (ReactJS, Angular o Vue.js) elegirías para cada caso.

Construir una tabla de características (origen y soporte, lenguaje base, DOM virtual, curva de aprendizaje, legado) y responder con justificación razonada:

1. Una **pequeña tienda de barrio** con presupuesto reducido y despliegue rápido.
2. El **portal bancario** de una entidad financiera con cientos de programadores y exigencias estrictas de tipado robusto.
3. Una **aplicación interactiva** con renderizado ultra rápido de miles de productos con cambios constantes en pantalla.

---

## Ejercicio 9 — Test de vocabulario técnico

Test interactivo de **Verdadero/Falso** sobre el vocabulario del apartado E y los conceptos clave del criterio (DOM Virtual, JSX, TypeScript, patrón reactivo, tríada, hoisting, ES6, frameworks open source).
