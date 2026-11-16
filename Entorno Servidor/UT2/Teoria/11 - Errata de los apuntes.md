# 11 · Errata e imprecisiones de los apuntes

> Revisión de `..\UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf`
> (59 págs.) y de la guía de repaso. **Todo lo de esta página está comprobado
> ejecutando el código con PHP 8.2.12.**
>
> Los apuntes se hicieron con PHP 7.4, así que algunas diferencias son de
> versión, no errores de quien los escribió.

## 1. Errores reales (el documento dice algo que no es)

| # | Pág. | Dice | Es | Qué hacer en el examen |
|---|---|---|---|---|
| 1 | 21 | `$_GLOBALS` | **`$GLOBALS`** (sin guion bajo) | escribir `$GLOBALS`; la tabla de la pág. 22 ya lo pone bien |
| 2 | 44 | «para búsquedas sin importar mayúsculas, usar `strstr()`» | **`stristr()`** | si te preguntan la función que ignora mayúsculas, es `stristr` |
| 3 | 40 | `strlen()` da «la cantidad de caracteres» | da **bytes**; para caracteres, `mb_strlen()` | `strlen("Martín")` = 7, `mb_strlen` = 6 |
| 4 | 44 | salida de `strtr`: `... León` | `... LEón` | la `e` sí se cambia; la `L` ya era mayúscula |
| 5 | 13 | variable sin inicializar → `Notice` (`E_NOTICE`) | en **PHP 8** es `Warning: Undefined variable` | contestar `E_NOTICE` (es lo que dice el tema) y añadir «en PHP 8 es Warning» |
| 6 | 50 | `settype($c, "integer"); echo "... " . $a;` | debería imprimir **`$c`** | es un copiar y pegar; el valor de `$c` sí cambia |
| 7 | 43 y 58 | `;?` + `>` partido / `?>` duplicado | un solo `?>` | esas dos páginas **no compilan** tal cual |
| 8 | 49 | `floatval()` enlaza a `function.intval.php` | debe ser `function.floatval.php` | detalle del enlace, no del código |
| 9 | 47 | comillas tipográficas `“Manzana”` | comillas rectas `"Manzana"` | las tipográficas dan **Parse error** |
| 10 | 44 | código imprime `Resujtado:` y la captura `Resutado:` | es una errata de tecleo | irrelevante para el examen, pero no te fíes de las capturas |

## 2. Imprecisiones (no es falso, pero está mal explicado)

| # | Pág. | Dice | Matiz |
|---|---|---|---|
| 1 | 56 | «si se pone en mayúscula el día y el mes sale el nombre» | `D` y `M` dan la **abreviatura** (`Sun`, `Nov`); el nombre completo es `l` y `F` |
| 2 | 45 | «la posición de `a` está en el 1° (primer) carácter» | la posición es **0**; es el primer carácter, pero su índice es 0 |
| 3 | 28 | «pre-incremento: primero suma y luego **asigna**» | no asigna: **devuelve** el valor nuevo |
| 4 | 16-18 | «float con 14 decimales» | son **14 cifras significativas**, no decimales |
| 5 | guía, 4 | «comillas mágicas» para las dobles | *magic quotes* era otra cosa (una función retirada); aquí es **interpolación** |
| 6 | 58 | `date('10-09-2020 20:09:33')` | no formatea nada: no hay letras de formato, devuelve el texto tal cual. Funciona porque `strtotime()` lo entiende después |
| 7 | 56 | timestamps «desde el 1-1-1970» | cierto, pero **en la zona horaria configurada** (`Europe/Madrid` en los apuntes) |
| 8 | 51 | `is_bool(111)` imprime «111 es false» | es `false` porque `111` **no es booleano**, no porque valga `false`. La etiqueta engaña |
| 9 | 35 | un `2` junto a `floor(1.50)` | ese `2` es de `round(1.75)`; `floor(1.50)` da `1` y el texto lo dice bien |
| 10 | 22 | captura con PHP 7.4.29 | tu XAMPP tiene **8.2.12**: los mensajes de error cambian |

## 3. Lo que sí está bien (no lo «corrijas»)

Comprobado ejecutándolo, sale exactamente lo que dice el documento:

- `strlen($cancion)` = **64** con la letra de «Música ligera».
- `strlen("Martín Martín León")` = 21 y `mb_strlen` = 18.
- `substr($cancion, 0, 11)` = `De aquel am`.
- `trim(" Hola ")`: de 6 a 4 caracteres; `trim("///Hola///", "/")` = `Hola`.
- `substr_count("This is a test", "is")` = 2.
- `str_replace("_", "-", ...)` con `Cambios 6`.
- `ucfirst`, `ucwords`, `mb_convert_case` con los resultados que muestra.
- `intval("ANBB")` = 0; `intval("323244.656")` = 323244.
- `round(1.75)` = 2; `round(2.456, 2)` = 2.46; `ceil(1.50)` = 2.
- `rand(1, 9)` incluye el 1 y el 9.
- `checkdate(11, 31, 1986)` = `false` (noviembre tiene 30 días).
- `is_float("123.11")` = `false` (es un string).
- Las capturas de `==` / `===`, del pre/post incremento, de copia/referencia y
  de `var_dump` son correctas.

## 4. Cómo usar esta página

1. **Estudia por los capítulos 01-08**, que ya traen el dato bueno.
2. Usa esta página como **lista de trampas**: si en el examen te suena haber
   leído lo contrario, casi seguro que estás recordando una errata.
3. Si el profesor pregunta «según los apuntes…», contesta lo que dicen los
   apuntes y añade el matiz. Así no pierdes el punto ni discutes el material.
