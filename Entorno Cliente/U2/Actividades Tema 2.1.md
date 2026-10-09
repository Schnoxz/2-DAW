# Actividades Prácticas — Tema 2.1

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Enunciado: apartado **F. Actividades Prácticas y Ejercicios del Criterio 2.1** del tema «2.1. Selección de un lenguaje de programación de clientes Web».
> Criterio **CE 2.a** · RA2 · 10 % del RA2 (0,5 % de la nota final).
> Todas las predicciones de este documento están comprobadas ejecutándolas con Node v24 (motor V8, el mismo de Chrome).

## Índice

1. [Clasificación de tecnologías front-end](#1--clasificación-de-tecnologías-front-end)
2. [Justificación de arquitectura](#2--justificación-de-arquitectura)
3. [Matriz de selección de dialectos](#3--matriz-de-selección-de-dialectos)
4. [ECMAScript y transpilación](#4--ecmascript-y-transpilación)
5. [Validación sintáctica de identificadores](#5--validación-sintáctica-de-identificadores)
6. [Detección de errores por sensibilidad a mayúsculas](#6--detección-de-errores-por-sensibilidad-a-mayúsculas)
7. [Aplicación de convenciones profesionales](#7--aplicación-de-convenciones-profesionales)
8. [Análisis del comportamiento del ASI](#8--análisis-del-comportamiento-del-asi)
9. [Verificación en consola y ámbito](#9--verificación-en-consola-y-ámbito)

---

## 1 · Clasificación de tecnologías front-end

| Categoría | Elementos |
|---|---|
| **Alternativas históricas obsoletas** | Adobe Flash (ActionScript), Java Applets, VBScript |
| **Estándar nativo universal** | JavaScript (ECMAScript) |
| **Dialectos / superconjuntos con transpilación** | TypeScript, JSX |

Flash y los Applets exigían instalar un plugin en el navegador y VBScript solo funcionaba en Internet Explorer; los tres fracasaron al buscar un estándar común. TypeScript y JSX no son alternativas a JavaScript: se transpilan a JavaScript antes de que el navegador lo ejecute.

---

## 2 · Justificación de arquitectura

**Dos ventajas técnicas de JavaScript nativo en el cliente para reducir recursos de servidor:**

1. **La lógica inmediata se ejecuta en la máquina del usuario.** Validaciones de formularios, cálculos de interfaz y ordenaciones visuales se resuelven en el navegador, así que el servidor gasta menos CPU y memoria: ya no tiene que generar esas comprobaciones.
2. **Solo viajan datos, no páginas enteras.** Al validar en cliente, el servidor se limita a devolver datos puros (JSON) en lugar de documentos HTML completos, lo que reduce el ancho de banda y el trabajo de renderizado.

**Concepto Zero Plugins:** JavaScript es interpretado de forma nativa por todos los motores modernos (V8 en Chrome/Edge, SpiderMonkey en Firefox, JavaScriptCore en Safari) sin pedir ninguna instalación al usuario. Soluciona el problema histórico de los Java Applets y de Flash, que requerían plugins pesados, lentos y con agujeros de seguridad.

---

## 3 · Matriz de selección de dialectos

| Proyecto | Tecnología | Justificación |
|---|---|---|
| **A · Plataforma bancaria, 30 desarrolladores** | **TypeScript** | Requiere validación estática de datos *en tiempo de desarrollo*: el tipado fuerte y estático corta el error antes de subir a producción, y el compilador (`tsc`) verifica parámetros y retornos entre los 30 desarrolladores. |
| **B · Script de 50 líneas para manipular el DOM** | **Vanilla JS** | No justifica una fase de compilación añadida: se descarga y ejecuta directo en el navegador, sin dependencias ni paso previo de build. |
| **C · Interfaz con componentes reutilizables en ReactJS** | **JSX** | JSX es la sintaxis de componentes de React: mezcla HTML dentro de JavaScript y es transformado (Babel) en llamadas JS convencionales al compilar el árbol de componentes. |

---

## 4 · ECMAScript y transpilación

**Relación ECMAScript ↔ JavaScript:** ECMAScript es la especificación formal (norma internacional **ECMA-262**, de ECMA International) que define sintaxis, tipos y comportamientos; JavaScript es la implementación real de esa norma. Es decir, ECMAScript es el *qué* y JavaScript es el *cómo* lo ejecuta cada navegador.

**Papel del transpilador (Babel):** el equipo escribe con sintaxis moderna de ES6/ES2015 (`let`, `const`, clases, funciones flecha) y Babel traduce ese código a JavaScript ES5 equivalente, compatible con navegadores antiguos. El código fuente se mantiene legible y moderno, y lo que llega al usuario final es una versión antigua que cualquier motor entiende. Es un traductor *de código a código*, no de código a binario.

---

## 5 · Validación sintáctica de identificadores

| Nombre | ¿Válido? | Motivo |
|---|---|---|
| `1erUsuario` | ❌ Inválido | Empieza por dígito: un identificador solo puede comenzar por letra, `$` o `_`. |
| `_totalFactura` | ✅ Válido | Empieza por guion bajo, permitido. |
| `$elementoDOM` | ✅ Válido | Empieza por `$`, permitido. |
| `precio-final` | ❌ Inválido | El guion `-` es el operador de resta: se leería como `precio - final`. |
| `class` | ❌ Inválido | Palabra reservada del lenguaje. |
| `montoTotal2` | ✅ Válido | Empieza por letra; los dígitos solo están prohibidos al principio. |
| `nombre usuario` | ❌ Inválido | No puede llevar espacios (y hay que usar `nombreUsuario`). |
| `function` | ❌ Inválido | Palabra reservada del lenguaje. |

---

## 6 · Detección de errores por sensibilidad a mayúsculas

JavaScript distingue mayúsculas de minúsculas también en las palabras reservadas (`function`, `if`, `return`, `const`) y en las funciones nativas (`alert`, `console.log`).

En el código del enunciado aparecen **seis** palabras escritas con mayúscula inicial (el enunciado habla de 4, pero se corrigen las seis):

| Erróneo | Correcto |
|---|---|
| `Function` | `function` |
| `Const` | `const` |
| `If` | `if` |
| `Alert` | `alert` |
| `Return` | `return` |
| `Console.log` | `console.log` |

Código corregido:

```js
function calcularDescuento(PrecioBase) {
  const porcentaje = 0.15;
  if (PrecioBase > 100) {
    alert("Descuento aplicado");
    return PrecioBase * porcentaje;
  }
  return 0;
}

console.log(calcularDescuento(150));
```

Salida: se abre el modal «Descuento aplicado» y la consola imprime `22.5` (150 × 0,15).

---

## 7 · Aplicación de convenciones profesionales

| Entidad | Nombre propuesto | Convención |
|---|---|---|
| Variable con el nombre del cliente actual | `nombreCliente` | camelCase |
| Constante global de reintentos de conexión | `MAX_REINTENTOS` | UPPER_SNAKE_CASE |
| Clase de usuario registrado | `UsuarioRegistrado` | PascalCase |
| Referencia a un botón del DOM | `$botonEnviar` | Prefijo `$` |
| Propiedad privada del token de sesión | `_tokenSesion` | Prefijo `_` |

---

## 8 · Análisis del comportamiento del ASI

Código del enunciado:

```js
function crearConfiguracion() {
  return
  { modo: "oscuro", puerto: 8080 };
}

const config = crearConfiguracion();
console.log(config);
```

**a) Salida real en consola**

**No se imprime nada: el script entero falla al analizarse y el navegador muestra**

```
Uncaught SyntaxError: Unexpected token ':'
```

No es `undefined` (que es lo que ocurre con la versión clásica de un solo atributo): al llevar dos propiedades, el bloque que sobra tras el `return` no se puede leer como sentencia y el error es sintáctico, de modo que ni siquiera llega a ejecutarse el `console.log`. *Comprobado con Node v24; Chrome/Edge dan el mismo error por usar V8.*

**b) Intervención del ASI, paso a paso**

1. El motor ve `return` seguido de un salto de línea. La regla del ASI establece que hay que insertar **automáticamente un punto y coma** justo después de `return`: la sentencia pasa a ser `return;` y la función devuelve `undefined`.
2. A partir de ahí, `{ modo: "oscuro", puerto: 8080 };` ya no es un literal de objeto (eso es lo que quería el programador), sino un **bloque de código**.
3. Dentro de un bloque, `modo:` se interpreta como una etiqueta y después vendría la expresión `"oscuro", puerto`. Ahí aparece un `:` que no puede estar: el analizador sintáctico aborta con `SyntaxError`.
4. Como el error ocurre al analizar el fichero completo, ninguna línea llega a ejecutarse.

*Si el objeto tuviera una sola propiedad, el paso 3 daría lugar a una etiqueta válida y sí se imprimiría `undefined`.*

**c) Código corregido**

```js
function crearConfiguracion() {
  return {
    modo: "oscuro",
    puerto: 8080
  };
}

const config = crearConfiguracion();
console.log(config);   // { modo: 'oscuro', puerto: 8080 }
```

La llave se pone **en la misma línea que el `return`** (o la sentencia completa en una línea). Otra opción válida es construir el objeto en una variable y devolver esa variable, así el salto de línea no rompe nada.

---

## 9 · Verificación en consola y ámbito

```js
let totalVentas = 500;
let TotalVentas = 1200;

console.log(totalVentas);   // 500
console.log(TotalVentas);   // 1200
```

**Salida:**

```
500
1200
```

JavaScript es *case-sensitive*: `totalVentas` y `TotalVentas` son **dos identificadores distintos**, dos posiciones de memoria independientes. Se crean dos variables sin que la segunda sobrescriba a la primera, y cada `console.log` lee la suya. Si estuvieran escritas igual el motor daría error por redeclaración; al diferir en la mayúscula de la `T`, simplemente conviven.
