# 07 · Funciones de cadenas

> Apuntes §4.2 (págs. 36-48) · Guía de repaso §05 y §09 (págs. 4 y 7).

## 1. Comillas dobles y comillas simples

| Comillas | Qué hace | Ejemplo | Salida |
|---|---|---|---|
| Dobles `"..."` | **interpola**: sustituye `$variable` por su valor | `"Hola $nombre"` | `Hola Ana` |
| Simples `'...'` | **literal**: no toca nada | `'Hola $nombre'` | `Hola $nombre` |

```php
$nombre = "Ana";
echo "Hola $nombre";      // Hola Ana
echo 'Hola $nombre';      // Hola $nombre
echo 'Hola ' . $nombre;   // Hola Ana (concatenando)
```

La guía llama a las dobles «comillas mágicas». El nombre histórico *magic
quotes* era otra cosa (una función de PHP ya retirada): aquí significa solo
**interpolación**.

## 2. Concatenar: el punto `.`

- `.` une cadenas.
- `.=` añade al final: `$cadena .= " más";`
- **`+` nunca concatena**: siempre suma. `"10" + 2` es `12`, no `"102"`.

```php
echo "Hola " . $nombre;
echo "<p style='font-size: 30px;'>$numero</p>";  // atributos con comillas simples
```

## 3. Mayúsculas y minúsculas

| Función | Qué hace | Con tildes |
|---|---|---|
| `strtoupper($c)` | todo a mayúsculas | **no** las convierte (`í` sigue en minúscula) |
| `strtolower($c)` | todo a minúsculas | **no** las convierte |
| `mb_strtoupper($c)` | todo a mayúsculas | sí |
| `mb_strtolower($c)` | todo a minúsculas | sí |
| `ucfirst($c)` | primera letra de la cadena en mayúscula | solo si es ASCII |
| `ucwords($c)` | primera letra de **cada palabra** | solo si es ASCII |
| `mb_convert_case($c, MB_CASE_TITLE)` | tipo título, con Unicode | sí |

```php
$palabra = "Martín Martínez León";
echo strtoupper($palabra);     // MARTíN MARTíNEZ LEóN
echo mb_strtoupper($palabra);  // MARTÍN MARTÍNEZ LEÓN
```

Los modos de `mb_convert_case()` son `MB_CASE_UPPER`, `MB_CASE_LOWER` y
`MB_CASE_TITLE` (este último pone en mayúscula la primera letra de cada palabra
y el resto en minúscula).

**El truco para una primera letra acentuada** (porque `ucfirst('área')` no
cambia nada):

```php
$n = "área del círculo";
echo mb_strtoupper(mb_substr($n, 0, 1)) . mb_substr($n, 1);
// Área del círculo
```

Se corta la primera letra, se pasa a mayúscula con `mb_` y se concatena el
resto desde la posición 1.

## 4. Longitud: `strlen()` cuenta **bytes**, no letras

| Función | Cuenta | `"Martín"` |
|---|---|---|
| `strlen($c)` | **bytes** | `7` |
| `mb_strlen($c)` | **caracteres** | `6` |

La `í` en UTF-8 ocupa **dos bytes**. Por eso `strlen("Martín")` da 7 y
`mb_strlen("Martín")` da 6.

> En los apuntes (pág. 40) se dice que `strlen()` da «la cantidad de
> caracteres». Es **impreciso**: da bytes. Con texto sin tildes coincide, con
> tildes no.

## 5. Cortar: `substr()` y `mb_substr()`

```php
substr($cadena, $inicio, $longitud)
```

- `$inicio` empieza en **0** (el primer carácter está en la posición 0).
- `$longitud` es **cuántos** caracteres coger, no dónde termina.
- Si `$inicio` es **negativo**, cuenta desde el final.
- Si se omite `$longitud`, coge hasta el final.

```php
$cancion = "De aquel amor de música ligera...";
echo substr($cancion, 0, 11);   // De aquel am

$texto = "Programación Web en PHP";   // 23 caracteres
echo substr($texto, -15);      // corta 15 bytes: empieza con media "ó"
echo mb_substr($texto, -15);   // ción Web en PHP
```

Con `substr()` el resultado empieza por un byte suelto de la `ó` y se ve un
carácter roto. Con `mb_substr()` sale limpio, porque cuenta caracteres.

> Con tildes hay que usar **`mb_substr()`**. Los apuntes lo demuestran con
> `"Martín áé Martín úí León"`: con `substr()` sale un `�` y con `mb_substr()`
> sale bien.

## 6. Quitar espacios: `trim()`, `ltrim()`, `rtrim()`

| Función | Quita |
|---|---|
| `trim($c)` | al principio **y** al final |
| `ltrim($c)` | solo a la izquierda |
| `rtrim($c)` | solo a la derecha |

Por defecto quita espacios, tabuladores, saltos de línea y `\0`. Con un segundo
parámetro se le dice **qué** quitar:

```php
$cadena = " Hola ";
echo strlen($cadena);          // 6
echo strlen(trim($cadena));    // 4

echo trim("///Hola///", "/");  // Hola
```

`trim()` es lo primero que se hace con lo que llega de un formulario.

## 7. Contar apariciones: `substr_count()`

```php
echo substr_count("This is a test", "is");   // 2
```

- Es **sensible a mayúsculas**: `substr_count($texto, "T")` no cuenta las `t`
  minúsculas.
- Por eso, para contar una letra sin importar el caso, se pasa el texto a
  minúsculas antes: `substr_count(strtolower($texto), "t")`.

## 8. Sustituir: `str_replace()`

```php
str_replace($buscar, $reemplazar, $cadena, $contador)
```

| Parámetro | Qué es |
|---|---|
| `$buscar` | lo que se busca |
| `$reemplazar` | por lo que se cambia |
| `$cadena` | el texto donde buscar |
| `$contador` | **opcional**: variable donde deja cuántas sustituciones hizo |

```php
$frase = "Marge_creo_que_odio_a_Mickael_Jackson.";
echo str_replace("_", "-", $frase, $c);   // Marge-creo-que-odio-a-Mickael-Jackson.
echo "Cambios: $c";                       // Cambios: 6
```

- Sustituye **todas** las apariciones, no solo la primera.
- Puede cambiar una palabra entera, no solo un carácter.
- Es sensible a mayúsculas.
- Para **quitar** algo, se reemplaza por la cadena vacía `""`:
  `str_replace(" ", "", $frase)`.

## 9. Cambiar carácter por carácter: `strtr()`

```php
strtr($cadena, "aet", "AET")
```

Va **posición a posición**: la `a` por la `A`, la `e` por la `E`, la `t` por la
`T`. **No** cambia las tildes (`á` no es `a`).

```php
echo strtr("Martín áé Martín úí León", "aet", "AET");
// MArTín áé MArTín úí LEón
```

> La salida de los apuntes (pág. 44) pone `León` sin tocar la `L`; la real es
> `LEón`. La `L` ya era mayúscula y no está en `"aet"`, así que no cambia; la
> `e` sí está y pasa a `E`, y la `ó` se queda igual. Comprobado con PHP 8.2.

## 10. Buscar dentro de una cadena

### `strstr()` / `stristr()`: devuelven el resto

```php
$cadena1 = "Probando a buscar una cadena en otra cadena";
echo strstr($cadena1, "en otra");
// en otra cadena
```

- Devuelve **desde la primera aparición hasta el final**.
- `strstr()` **distingue** mayúsculas.
- `stristr()` **no** las distingue.

> **Errata de los apuntes (pág. 44):** la nota dice «para búsquedas sin
> importar las mayúsculas, usar `strstr()`». Debe decir **`stristr()`**; si no,
> la nota se contradice con la frase anterior.

### `strpos()` / `stripos()`: devuelven la posición

```php
$pos = strpos("abc", "a");    // 0
```

- Devuelven un **número** (la posición, empezando en 0) o **`false`** si no
  está.
- `stripos()` ignora mayúsculas.

**La trampa clásica del examen:**

```php
if (strpos("abc", "a") == false) { ... }    // ¡ENTRA! porque 0 == false
if (strpos("abc", "a") === false) { ... }   // correcto: 0 no es false
```

Hay que comparar **siempre con `===`**, porque la posición `0` es un valor
válido y `==` la confunde con `false`.

> En los apuntes (pág. 45) el comentario dice «la posición de 'a' está en el 1°
> (primer) carácter», pero luego imprime `0`. La posición es **0**; lo que
> ocurre es que es el **primer** carácter. El comentario mezcla las dos cosas.

### `str_contains()`: solo sí o no (PHP 8)

```php
if (str_contains("The lazy fox", "lazy")) { ... }   // true
str_contains("The lazy fox", "Lazy");               // false (distingue)
```

Es la forma moderna de preguntar «¿está dentro?»: devuelve directamente
`true`/`false`, sin el problema del `0`.

## 11. Codificación

`mb_internal_encoding()` devuelve (o cambia) la codificación que usan las
funciones `mb_*`. Por defecto es **UTF-8**, que es lo que hay que usar para que
las tildes se cuenten y se corten bien.

## 12. Resumen

| Quiero… | Función |
|---|---|
| saber cuántos **bytes** | `strlen()` |
| saber cuántos **caracteres** | `mb_strlen()` |
| cortar un trozo | `substr()` / `mb_substr()` |
| quitar espacios | `trim()` / `ltrim()` / `rtrim()` |
| contar apariciones | `substr_count()` |
| sustituir texto | `str_replace()` |
| cambiar letras sueltas | `strtr()` |
| saber si está | `str_contains()` |
| saber **dónde** está | `strpos()` + `=== false` |
| quedarme con el resto | `strstr()` / `stristr()` |
