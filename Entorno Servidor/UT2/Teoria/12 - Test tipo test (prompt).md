# 12 · Test tipo test (prompt para NotebookLM)

**Prompt para NotebookLM · Test tipo test del Tema 2 (PHP)**

**Cómo usarlo**

1. Crea el notebook y sube como fuentes: los PDF de `Teoria\fuentes\`, los
   capítulos `01` a `11` de esta carpeta (ya llevan las erratas corregidas),
   `00 - Sintesis del tema (PDF).pdf`, tus tres entregas resueltas y
   `escape_room.php`.
2. Pega el prompt **en el chat** del notebook. No uses el botón «Cuestionario»:
   genera preguntas superficiales y no respeta el formato.
3. Si se corta a medias, escribe `sigue`. Para un segundo examen, pide
   «genera otras 40 con los mismos bloques, sin repetir ninguna pregunta».

---

Actúa como profesor de «Desarrollo Web en Entorno Servidor» (2º DAW) preparando
un examen tipo test del TEMA 2: *Lenguaje PHP. Inserción de código en páginas
web*.

**FUENTES:** usa EXCLUSIVAMENTE los documentos cargados en este notebook
(apuntes del tema, guía de repaso, mis ejercicios resueltos y el escape room).
No uses conocimiento externo salvo para comprobar que el código es correcto.
Queda fuera del temario: POO, bases de datos, sesiones, formularios complejos y
funciones que no aparezcan en los apuntes.

**OBJETIVO:** un test de **40 preguntas tipo test**, con **4 opciones y una sola
correcta**, repartido así:

- **Bloque A · Teoría (10):** sintaxis y etiquetas, omisión del `?>`,
  comentarios, tipado débil, identificadores, constantes, copia vs referencia,
  ámbito, superglobales, operadores (`==` vs `===`, `++`/`--`, `??`, `%`),
  funciones nativas y sus trampas.
- **Bloque B · Predicción de salida (10):** fragmentos de código PHP; las cuatro
  opciones son **salidas posibles**, no explicaciones.
- **Bloque C · Código trampa (8):** fragmentos con un solo error (comillas
  simples que no interpolan, `$_GET`/`$_POST` sin `isset`, `=` en vez de `==`,
  `.push()` de JavaScript, `echo` de un array, clave mal escrita en
  `$_SERVER`, función inventada, `foreach` que recorre valores en vez de
  claves, comparar `strpos()` con `== false`). La pregunta es **qué falla o qué
  provoca**, y las opciones son diagnósticos.
- **Bloque D · Rellenar huecos (7):** código con un hueco marcado `____`; las
  opciones son **el fragmento que lo completa** (un operador, una función o una
  clave), no la explicación.
- **Bloque E · Verdadero/falso razonado (5):** afirmaciones del tema con
  opciones *Verdadero* / *Falso*; la explicación debe justificar el porqué.

**REGLAS DE CALIDAD**

1. Una sola respuesta correcta. Los tres distractores deben ser **errores
   reales y típicos** del alumno, no relleno absurdo.
2. Nada de «todas las anteriores» ni «ninguna de las anteriores» (como mucho,
   una vez en todo el test).
3. Prohibido el código cuyo resultado dependa de `rand()`, `time()`, la fecha
   actual, la zona horaria o la configuración del servidor. Si preguntas por
   `date()` o `mktime()`, pregunta por el **formato** o por el **orden de los
   parámetros**.
4. Todo el código en bloques ```` ```php ```` y con la salida **exacta**: `echo`
   de `true` imprime `1`, de `false`/`null` no imprime nada, y los avisos
   (`Warning`, `Notice`, `Fatal error`) forman parte de la respuesta cuando
   corresponda.
5. Dificultad mezclada: 60 % asequible, 30 % de trampa fina, 10 % difícil.
6. Español de España, nivel 2º DAW, sin funciones que no aparezcan en el tema.
7. Entre paréntesis, la sección o página del tema de donde sale cada pregunta
   (por ejemplo: «pág. 40, `strlen`»).
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
  **`MArTín áé MArTín úí LEón`**.
- En `date()`: `d` = día con ceros, `D` = abreviatura del día de la semana
  (`Sun`), `l` = nombre del día (`Sunday`), `m` = mes numérico, `M` =
  abreviatura del mes (`Nov`), `F` = nombre del mes (`November`).
- `strpos()` devuelve **`0`** si la subcadena está al principio; por eso se
  compara con `=== false`.
- `checkdate()` y `mktime()` llevan el **mes antes que el día**.

**FORMATO DE SALIDA** (respétalo al pie de la letra):

```
## Bloque A · Teoría

### A1. (pág. 10, declaración de variables)
Enunciado de la pregunta.
a) ...
b) ...
c) ...
d) ...
```

Y así con las 40. Al final, una sección **SOLUCIONARIO** con:

1. Una tabla detallada: `| # | Resp. | Por qué es correcta | Por qué fallan las otras |`.
2. Una tabla compacta solo con el número y la letra, para autocorregirme rápido.
3. Una lista final con **los 10 conceptos imprescindibles** que cubre el test.

**IMPORTANTE:** si no puedes generar las 40 preguntas de una vez, genera
primero los bloques A y B (20 preguntas) y termina con
«Continuará: escribe "sigue" para los bloques C, D y E». No resumas ni omitas
preguntas.
