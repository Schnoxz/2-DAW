# 03 · Tipos de datos y conversiones

> Apuntes §2.3.5 (págs. 16-20) · Guía de repaso §04 (pág. 4).

## 1. Los tipos de PHP

**Cuatro escalares** (un solo valor):

| Tipo | Qué guarda | Detalle |
|---|---|---|
| `integer` | números enteros | el tamaño depende de la plataforma: `PHP_INT_SIZE`, `PHP_INT_MAX`, `PHP_INT_MIN` |
| `float` (o `double`) | números reales | precisión de unas **14 cifras significativas** (no "14 decimales") |
| `string` | cadenas de texto | ver capítulo 07 |
| `boolean` | `TRUE` o `FALSE` | es lo que devuelven las comparaciones |

**Compuestos y especiales:**

| Tipo | Qué es |
|---|---|
| `array` | colección de elementos (se ve a fondo en la unidad siguiente) |
| `object` | instancia de una clase (POO, más adelante) |
| `callable` | una función que se pasa a otra función (callback) |
| `null` | variable sin valor: se le asigna `NULL` o no está inicializada |
| `resource` | recurso externo, como una conexión a base de datos |

La conversión entre `integer` y `float` es **automática**, y también se puede
forzar con los operadores de *casting* `(int)` y `(float)`.

## 2. Conversión a boolean (la tabla que cae seguro)

Cuando se espera un booleano y llega otro tipo:

| Tipo | Evalúa a **FALSE** | Evalúa a **TRUE** |
|---|---|---|
| `integer` | solo `0` | cualquier otro, **incluido `-1`** |
| `float` | solo `0.0` | cualquier decimal distinto de cero |
| `string` | `""` y **`"0"`** | todo lo demás: `" "`, `"0.0"`, `"false"`, `"no"`… |
| `array` | sin elementos (`[]`) | con al menos un elemento |
| `null` | siempre | nunca |
| variable sin inicializar | siempre | nunca |

Las tres trampas de test:

```php
var_dump((bool) "0");     // bool(false)  <- la cadena "0"
var_dump((bool) "0.0");   // bool(true)   <- no es "0"
var_dump((bool) " ");     // bool(true)   <- un espacio no es vacío
var_dump((bool) -1);      // bool(true)   <- solo el 0 es false
```

## 3. Casting y conversión explícita

```php
(int) $valor        (float) $valor
(string) $valor     (bool) $valor
```

```php
$num = "3.9";
echo (int) $num;        // 3   (trunca, no redondea)
echo (float) $num;      // 3.9
echo (int) "abc";       // 0   (no puede leer ningún número)
echo (int) "12abc";     // 12  (lee lo que puede del principio)
```

Funciones equivalentes (capítulo 08): `intval()`, `floatval()`, `strval()`,
`boolval()` y `settype($var, "integer")`.

## 4. Conversión automática: el `+` siempre suma

```php
$a = "10";
$b = $a + 2;    // 12: PHP convierte "10" a número para poder sumar
```

Esto es lo que hace que `"10" == 10` sea `TRUE` (capítulo 04) y lo que produce
sorpresas cuando una cadena no empieza por número (`"abc" + 1` es `1`, con
aviso en PHP 8).

## 5. Resumen

- 4 escalares: `integer`, `float`, `string`, `boolean`.
- `FALSE`: `0`, `0.0`, `""`, `"0"`, `[]`, `null`, sin inicializar.
- `TRUE`: todo lo demás (`-1`, `" "`, `"0.0"`, `[0]`…).
- `(int)` **trunca**; `round()` **redondea** (capítulo 08).
