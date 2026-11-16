# 13 · Glosario

> Apuntes §3 (pág. 33) · Guía de repaso §11 (pág. 9).

## 1. Términos del tema

| Término | Definición |
|---|---|
| **Array** | Tipo de dato **compuesto**: una colección ordenada de elementos, cada uno con su clave. Se ve a fondo en la unidad siguiente. |
| **Bucle** | Estructura que **repite** instrucciones (`for`, `while`, `foreach`). |
| **Estructura condicional** | Permite **ejecutar o no** una instrucción según se cumpla una condición (`if`, `else`). |
| **Función** | Conjunto de instrucciones que realiza una tarea concreta y se puede llamar por su nombre. |
| **Librería** | Conjunto de funciones relacionadas entre sí, agrupadas para reutilizarlas. |
| **POO** | Programación orientada a objetos: paradigma basado en **objetos**, que agrupan variables (propiedades) y funciones (métodos). |
| **Script** | Programa sencillo, normalmente **interpretado** en lugar de compilado. Un `.php` es un script. |
| **Variable** | Posición de memoria identificada por un nombre, que almacena un dato (su **valor**). |
| **Constante** | Nombre con un valor fijo que **no cambia** durante la ejecución. |
| **Superglobal** | Array que PHP crea automáticamente y que está disponible en **cualquier ámbito**. |
| **Ámbito** | Parte del código donde una variable es visible. |
| **Timestamp** | Número de **segundos** desde el 1-1-1970 a las 00:00:00. |
| **Interpolación** | Sustituir una variable por su valor dentro de una cadena con comillas dobles. |

## 2. Términos en inglés (los usa la guía)

| Inglés | Español | Dato de examen |
|---|---|---|
| **semicolon** | punto y coma | `;` cierra cada sentencia; si falta, `Parse error` |
| **single-line comment** | comentario de una línea | `//` o `#` |
| **block comment** | comentario de bloque | `/* ... */` |
| **uninitialized variable** | variable sin inicializar | genera `E_NOTICE` (en PHP 8, `Warning`) y vale `0`, `""` o `FALSE` |
| **type conversion** | conversión de tipos | la hace `==`; `===` la evita |
| **pre-increment** | pre-incremento | `++$a` suma **antes** de devolver |
| **post-increment** | post-incremento | `$a++` devuelve **antes** de sumar |
| **assignment** | asignación | `=` |
| **reference** | referencia | `&`, dos nombres para la misma memoria |
| **copy** | copia | `$b = $a`, memorias independientes |
| **scope** | ámbito | local dentro de la función; global fuera |
| **constant** | constante | `define()`, sin `$` |
| **superglobal** | superglobal | `$_GET`, `$_POST`, `$_SERVER`… |
| **operator** | operador | `+`, `==`, `.`, `??`… |
| **comparison** | comparación | `==`, `===`, `<`, `>`… |
| **identity** | identidad | `===` (mismo valor **y** tipo) |
| **string** | cadena | texto entre comillas |
| **integer** | entero | número sin decimales |
| **float** / **double** | real | número con decimales |
| **boolean** | booleano | `TRUE` o `FALSE` |
| **null** | nulo | ausencia de valor |
| **concatenation** | concatenación | `.` (el `+` **suma**) |
| **single quotes** | comillas simples | no interpolan |
| **double quotes** | comillas dobles | interpolan |
| **uppercase** / **lowercase** | mayúsculas / minúsculas | `strtoupper` / `strtolower` |
| **substring** | subcadena | trozo de una cadena |
| **length** | longitud | `strlen` (bytes) / `mb_strlen` (caracteres) |
| **trim** | recortar | quita espacios de los extremos |
| **rounding** | redondeo | `round`, `floor`, `ceil` |
| **timestamp** | marca de tiempo | `time`, `mktime` |
| **warning** / **notice** / **error** | aviso / aviso / error | niveles de error de PHP |

## 3. Las tres frases que hay que saber decir en inglés

- «A missing semicolon produces a **parse error**.»
- «`==` performs **type conversion**; `===` compares value **and** type.»
- «An **uninitialized variable** raises `E_NOTICE` and evaluates to `0`, `""`
  or `FALSE` depending on the context.»
