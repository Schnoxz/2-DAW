# 12 · Examen final UT2 (prompt completo para NotebookLM)

**Prompt para NotebookLM · Examen final del Tema 2 (PHP)**

**Cómo usarlo**

1. Crea el notebook y sube como fuentes: los PDF de `Teoria\fuentes\` (apuntes
   oficiales y guía de repaso), los capítulos `01` a `11` de esta carpeta (ya
   llevan las erratas corregidas), `00 - Sintesis del tema (PDF).pdf`, tus tres
   entregas resueltas (`DWESejerciciosIniciales`, `DWESejerciciosPracticar`,
   `DWESejerciciosAvanzados`), `escape_room.php` y `Examen lunes - plan y chuleta.md`.
2. Pega el prompt **en el chat** del notebook. No uses el botón «Cuestionario»:
   genera preguntas superficiales y no respeta el formato que se pide abajo.
3. Si se corta a medias, escribe `sigue`. Para un segundo examen, pide
   «genera otro examen completo con los mismos bloques, sin repetir ninguna
   pregunta, cambiando los fragmentos de código y los enunciados prácticos».

---

Actúa como profesor de «Desarrollo Web en Entorno Servidor» (2º DAW) preparando
**un examen final completo del TEMA 2**: *Lenguaje PHP. Inserción de código en
páginas web*.

**FUENTES:** usa EXCLUSIVAMENTE los documentos cargados en este notebook
(apuntes del tema 2, guía de repaso, los ejercicios resueltos del alumno
—iniciales, practicar y avanzado— y el escape room). No uses conocimiento
externo salvo para comprobar que el código es correcto. Queda fuera del temario:
POO, bases de datos, sesiones, formularios complejos, expresiones regulares
avanzadas y funciones que no aparezcan en los apuntes del tema 2.

**ESTRUCTURA DEL EXAMEN:**

---
## PARTE I · TEST (40 preguntas, 4 opciones, una correcta)

Reparto por bloques:

- **Bloque A · Teoría (10):** sintaxis (`<?php ?>`, omisión del cierre),
  comentarios (`//`, `/* */`, `#`), tipado débil, identificadores (`$` + letra
  o `_`), constantes (`define`), copia vs referencia (`&`), ámbito (`global`,
  `$GLOBALS`), superglobales (`$_GET`, `$_POST`, `$_REQUEST`, `$_SERVER`),
  operadores (`==` vs `===`, `++$a` vs `$a++`, `??`, `%`, `**`, `.`), funciones
  nativas más comunes y sus trampas.
- **Bloque B · Predicción de salida (10):** fragmentos de código PHP; las cuatro
  opciones son **salidas posibles** (texto exacto que aparecería en el
  navegador), no explicaciones.
- **Bloque C · Código trampa (8):** fragmentos con exactamente un error. La
  pregunta es «¿qué falla o qué provoca?» y las opciones son diagnósticos
  (p. ej.: «comillas simples que no interpolan», «falta `isset()` antes de
  leer `$_GET`», «`=` en vez de `==` en un `if`», «clave mal escrita en
  `$_SERVER`», «función que no existe (`is_empty`...)», «`strpos()` comparado
  con `== false` en vez de `=== false`», «`echo` de un array sin `print_r`»).
- **Bloque D · Rellenar huecos (7):** código con un hueco `____`; las opciones
  son el fragmento que lo completa (un operador, una función o una clave de
  array superglobal), no una explicación.
- **Bloque E · Verdadero/falso razonado (5):** afirmaciones del tema. Hay que
  elegir Verdadero o Falso y justificarlo en una línea.

**REGLAS DE CALIDAD PARA EL TEST**

1. Una sola respuesta correcta. Los tres distractores deben ser **errores reales
   y típicos del alumno**, no relleno absurdo.
2. Nada de «todas las anteriores» ni «ninguna de las anteriores» (máximo una
   vez en todo el test, y solo si hay 4 opciones concretas).
3. Prohibido el código cuyo resultado dependa de `rand()`, `time()`, la fecha
   actual, la zona horaria o la configuración del servidor. Si preguntas por
   `date()` o `mktime()`, pregunta por el formato o por el orden de los parámetros.
4. Todo el código en bloques ```` ```php ```` y la salida exacta: `echo` de
   `true` imprime `1`, de `false`/`null` no imprime nada, y los avisos
   (`Warning`, `Notice`, `Fatal error`) forman parte de la respuesta cuando
   corresponda.
5. Dificultad mezclada: 60 % asequible (nivel UT2_1), 30 % de trampa fina
   (nivel UT2_2), 10 % difícil (nivel UT2_3).
6. Español de España, nivel 2º DAW, solo funciones que aparezcan en el tema 2.
7. Entre paréntesis, la sección o página del tema de donde sale cada pregunta.
8. Baraja la letra correcta: que no sea casi siempre la b.

**CORRECCIONES OBLIGATORIAS** (los apuntes tienen estas erratas; NO las
reproduzcas al generar preguntas):

- La superglobal es **`$GLOBALS`**, sin guion bajo (`$_GLOBALS` no existe).
- Para buscar sin distinguir mayúsculas se usa **`stristr()`**, no `strstr()`.
- **`strlen()` cuenta bytes**; para caracteres, `mb_strlen()`. `"Martín"` da
  `7` con `strlen` y `6` con `mb_strlen`.
- En **PHP 8**, usar una variable sin inicializar produce
  `Warning: Undefined variable` (en PHP 7.4 era `E_NOTICE`). Si preguntas por
  el nivel de error, admite `E_NOTICE` como respuesta del temario pero
  explícalo en el solucionario.
- `strtr("Martín áé Martín úí León", 'aet', 'AET')` devuelve
  **`MArTín áé MArTín úí LEón`**. (la `e` con acento NO se cambia, solo la
  `e` sin acento; la salida de los apuntes es errónea).
- En `date()`: `d` = día con ceros, `D` = abreviatura (`Sun`), `l` = nombre
  completo (`Sunday`), `m` = mes numérico, `M` = abreviatura (`Nov`), `F` =
  nombre completo (`November`).
- `strpos()` devuelve **`0`** si la subcadena está al principio; por eso se
  compara con `=== false`, no con `== false`.
- `checkdate()` y `mktime()` llevan el **mes antes que el día** (mes, día, año).

---
## PARTE II · EJERCICIOS PRÁCTICOS (3 ejercicios, para desarrollar en PHP)

Inspírate en los ejercicios que el alumno ya ha resuelto (UT2_1 iniciales,
UT2_2 practicar y UT2_3 avanzado) para plantear variantes que demuestren
comprensión, no solo memoria. Cada ejercicio vale 2 puntos.

### Ejercicio 1 (nivel UT2_1 — asequible)
Diseña un ejercicio similar a los **iniciales** que combine:
- Generación de un valor aleatorio con `rand()` o con `floor()` + `Math.random()`
  (versión PHP).
- Una operación sobre una cadena: `trim()`, `strlen()` o `substr()`.
- Mostrar el resultado con `echo` dentro de HTML.

Elige un escenario concreto (p. ej.: un eslogan publicitario, una tirada de
dado con mensaje personalizado, un contador de caracteres de un nombre) y
describe el enunciado como lo haría el profesor.

### Ejercicio 2 (nivel UT2_2 — intermedio)
Diseña un ejercicio similar a los de **practicar** que combine:
- Una variable de tipo `float` o `string`.
- Una comprobación de tipo con `is_float()`, `is_numeric()`, `is_null()` o
  `isset()`.
- Un `if`/`else` que muestre un mensaje u otro según el resultado.
- Uso de `trim()` o `str_replace()` para limpiar el dato.

Escenario: procesar un dato que llega «sucio» (con espacios, símbolos o en
formato incorrecto) y decidir si es válido.

### Ejercicio 3 (nivel UT2_3 — avanzado)
Diseña un ejercicio similar al **avanzado** que combine:
- Lectura de parámetros por `$_GET` (al menos 2 parámetros).
- Una operación matemática (suma, producto, media, máximo o mínimo con
  `max()`/`min()`).
- Una operación con cadenas (`strlen()`, `substr()`, `str_replace()`,
  `strtolower()`, concatenación).
- Mostrar resultados en una tabla HTML con Bootstrap o con CSS básico.
- Enlace de vuelta a la página principal (`index.php`).

Usa un escenario distinto al del enunciado original (p. ej.: calculadora de
notas, generador de presupuestos, comparador de productos).

---
## PARTE III · DEPURACIÓN (1 ejercicio, tipo «escape room»)

Inspírate en los fallos de `escape_room.php` y en el reto de depuración de la
guía de repaso (3 fallos). Plantea un fragmento de PHP de entre 10 y 20 líneas
que contenga **de 3 a 5 errores** reales (no inventados). Tipos de errores
permitidos:

- Comillas simples donde hacen falta dobles (no interpola la variable).
- `$_GET['clave']` sin comprobar con `isset()` — genera `Warning`.
- Clave de `$_SERVER` mal escrita (p. ej. `'REQUEST_METHOD'` escrito como
  `'METHOD_REQUEST'`).
- Función que no existe: `is_empty()` en vez de `empty()`.
- `strlen()` con acentos contando bytes en vez de caracteres.
- `=` dentro de un `if` en vez de `==`.
- `echo` de un array sin `print_r()` ni `var_dump()`.
- Comparar `strpos()` con `== false` en vez de `=== false`.
- `checkdate()` o `mktime()` con el orden de parámetros cambiado.
- Variable sin inicializar (genera `Warning` en PHP 8).

El fragmento debe tener sentido como programa (p. ej.: un conversor, un
validador, un generador). Incluye la **solución comentada** al final.

---
## FORMATO DE SALIDA

Estructura obligatoria:

```
# EXAMEN FINAL UT2 · LENGUAJE PHP

**2º DAW · Desarrollo Web en Entorno Servidor**

---

## PARTE I · TEST

### Bloque A · Teoría

**A1.** (pág. 10, declaración de variables)
Enunciado...
a) ...
b) ...
c) ...
d) ...

... (hasta A10)

### Bloque B · Predicción de salida

... (B1 a B10)

### Bloque C · Código trampa

... (C1 a C8)

### Bloque D · Rellenar huecos

... (D1 a D7)

### Bloque E · Verdadero/falso razonado

... (E1 a E5)

---

## PARTE II · EJERCICIOS PRÁCTICOS

### Ejercicio 1 · [Título]
Enunciado completo como lo escribiría el profesor.

### Ejercicio 2 · [Título]
...

### Ejercicio 3 · [Título]
...

---

## PARTE III · DEPURACIÓN

### Ejercicio de depuración · [Título]
Fragmento de PHP con errores.

**Solución comentada:**
...
```

Al final, una sección **SOLUCIONARIO** que contenga:

1. **Test:** tabla detallada: `| # | Resp. | Por qué es correcta | Por qué fallan las otras |`.
2. **Test:** tabla compacta solo con número y letra, para autocorregirse rápido.
3. **Prácticos:** una solución de referencia para cada ejercicio (código PHP
   completo y comentado, que se pueda copiar y ejecutar).
4. **Depuración:** el código corregido, con cada error señalado y explicado.
5. **Lista final:** los **15 conceptos imprescindibles** que cubre el examen.

**IMPORTANTE:** si no puedes generar todo de una vez, empieza por la Parte I
(40 test) y termina con «Continuará: escribe "sigue" para las Partes II y III».
Después genera las Partes II y III con otra tanda. No resumas ni omitas nada.