# 06 · Comprobar variables, tipos y depurar

> Guía de repaso §08 (pág. 7) · Apuntes §4.3 (págs. 48-54).

## 1. `isset()` y `empty()`: las dos preguntas distintas

| Función | Pregunta que responde | Devuelve `FALSE` cuando… |
|---|---|---|
| `isset($v)` | ¿existe y tiene valor? | la variable no existe **o** vale `NULL` |
| `empty($v)` | ¿está «vacía»? | el valor **no** equivale a `FALSE` |

```php
$x = null;
var_dump(isset($x));   // bool(false)
var_dump(empty($x));   // bool(true)

$y = '0';
var_dump(isset($y));   // bool(true)   <- existe
var_dump(empty($y));   // bool(true)   <- "0" cuenta como vacío
```

`empty()` considera vacío **lo mismo que evalúa a `FALSE`** (capítulo 03):
`0`, `"0"`, `""`, `null`, `false`, `[]` y las variables sin definir.

> `isset()` **no** es una función normal: es una construcción del lenguaje y
> admite varias variables a la vez (`isset($_GET['a'], $_GET['b'])`), que es
> justo lo que se hace para comprobar que llegan todos los parámetros.

## 2. La familia `is_*`: preguntan por el tipo exacto

| Función | Devuelve `TRUE` si… | Trampa |
|---|---|---|
| `is_int($v)` | es `integer` | `is_int("121212")` → `false` |
| `is_float($v)` | es `float` | `is_float("123.11")` → `false` (es string) |
| `is_string($v)` | es `string` | `is_string(121212)` → `false` |
| `is_bool($v)` | es `boolean` | `is_bool(111)` → `false` |
| `is_null($v)` | es `NULL` | se llama **`is_null`**, no `is_nulo` |
| `is_array($v)` | es `array` | |
| `is_object($v)` | es `object` | |
| `is_numeric($v)` | es número **o cadena numérica** | `is_numeric("123.45")` → `true` |

**La diferencia que cae en el test:** `is_numeric("123.45")` es `TRUE`, pero
`is_float("123.45")` es `FALSE`. `is_numeric` mira si el **contenido** se puede
usar como número; `is_float` mira el **tipo real** de la variable.

> En los apuntes, el ejemplo de `is_bool()` imprime «111 es false» cuando el
> valor es `111` (pág. 51). Es una **etiqueta engañosa**: `is_bool(111)` es
> `false` porque `111` es un entero, no porque valga `false`.

## 3. `gettype()`: el nombre del tipo

```php
$v = 3.5;
echo gettype($v);   // "double"
```

Devuelve el nombre en **inglés** y en minúsculas: `"integer"`, `"double"`
(para los float), `"string"`, `"boolean"`, `"array"`, `"object"`, `"NULL"`.

## 4. `var_dump()` y `print_r()`: ver el contenido

No se usan en la página final: son herramientas de **desarrollo**.

| Función | Qué muestra | Cuándo usarla |
|---|---|---|
| `var_dump($v)` | tipo, longitud y valor, con detalle | para depurar de verdad |
| `print_r($v)` | solo el valor, legible para humanos | para ver arrays rápido |

```php
$cadena = 'Manzana';
var_dump($cadena);   // string(7) "Manzana"
print_r($cadena);    // Manzana
```

Detalles de examen:

- `var_dump("Hola")` → `string(4) "Hola"`: el `4` es el número de **bytes**.
- `var_dump(true)` → `bool(true)`; `var_dump(3.0)` → `float(3)`.
- Los dos se envuelven en `<pre>` para que el navegador respete los saltos de
  línea y la indentación.
- `var_dump()` **no** devuelve nada: escribe directamente en la salida.

## 5. Funciones de conversión de tipo

Estas cambian el tipo del valor:

| Función | Devuelve | Ejemplo |
|---|---|---|
| `intval($v)` | entero (trunca) | `intval("323244.656")` → `323244` |
| `floatval($v)` | float | `floatval("323244.656")` → `323244.656` |
| `strval($v)` | string | `strval(121212)` → `"121212"` |
| `boolval($v)` | boolean | `boolval(0)` → `false` |
| `settype($v, "integer")` | **modifica la variable** y devuelve `true`/`false` | ver abajo |

**`settype()` es la excepción**: no devuelve el valor convertido, **cambia la
variable original** (se pasa por referencia) y devuelve si ha podido.

```php
$c = "6767";
settype($c, "integer");
echo $c;              // 6767 (ahora es un entero)
```

> En los apuntes (pág. 50) hay un `echo "<br> a es ".$a;` donde debería
> imprimir `$c`: es una errata de copiar y pegar.

## 6. Resumen

- `isset` → ¿existe y no es `NULL`? · `empty` → ¿equivale a `FALSE`?
- `is_*` miran el **tipo**; `is_numeric` mira si el **contenido** es numérico.
- `var_dump` da tipo y longitud; `print_r` da solo el valor.
- `intval`/`floatval`/`strval`/`boolval` **devuelven**; `settype` **modifica**.
