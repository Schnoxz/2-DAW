# 08 · Funciones numéricas y de fechas

> Apuntes §4.1 (págs. 34-36) y §4.4 (págs. 54-59) · Guía de repaso §09 (pág. 7).

## 1. Redondear: `round()`, `floor()`, `ceil()`

| Función | Qué hace | `1.5` | `1.75` | `-1.5` |
|---|---|---|---|---|
| `round($n)` | redondea al más cercano | `2` | `2` | `-2` |
| `floor($n)` | **siempre abajo** | `1` | `1` | `-2` |
| `ceil($n)` | **siempre arriba** | `2` | `2` | `-1` |

```php
echo round(2.456, 2);   // 2.46 (segundo parámetro: decimales)
echo floor(4.9);        // 4
echo ceil(4.2);         // 5
```

- `round()` acepta un segundo parámetro con el número de decimales.
- Ojo con los negativos: `floor(-1.5)` es `-2` y `ceil(-1.5)` es `-1`.
- `round()` es lo que se usa para **precios** y **medias**.

> **Errata de los apuntes (págs. 35-36):** justo antes del ejemplo de
> `floor(1.50)` aparece un «2» que pertenece al ejemplo anterior,
> `round(1.75)`. El `floor(1.50)` da `1` y el documento lo dice bien; el `2`
> está fuera de sitio.

## 2. Números al azar: `rand()`

```php
$numero = rand(1, 9);      // entero entre 1 y 9, AMBOS incluidos
$dado   = rand(1, 6);
$color  = rand(0, 255);
```

- Los dos extremos **entran** en el sorteo: `rand(1, 9)` puede dar 1 y 9.
- Para un carácter Unicode, se genera el código y se imprime como entidad:
  `echo "&#$codigo;";`.
- Si se llama `rand()` sin argumentos, devuelve un número entre 0 y
  `getrandmax()`.
- Cada vez que se recarga la página sale otro número (no se guarda).

## 3. Mayor y menor: `max()` y `min()`

```php
echo max(12, 5);      // 12
echo min(12, 5);      // 5
```

Aceptan dos o más valores, o un array. Evitan escribir un `if` para comparar.

## 4. `date()`: formatear una fecha

```php
date($formato, $timestamp)
```

- `$formato` es una cadena con **letras que son órdenes**, no texto literal.
- `$timestamp` es **opcional**: si no se pasa, se usa el momento actual.

| Letra | Devuelve | Ejemplo |
|---|---|---|
| `d` | día con dos cifras | `05` |
| `j` | día sin ceros | `5` |
| `m` | mes con dos cifras | `09` |
| `n` | mes sin ceros | `9` |
| `Y` | año con 4 cifras | `2026` |
| `y` | año con 2 cifras | `26` |
| `H` | hora en formato 24 h | `19` |
| `h` | hora en formato 12 h | `07` |
| `i` | minutos | `50` |
| `s` | segundos | `02` |
| `D` | día de la semana **abreviado** | `Sun` |
| `l` | día de la semana completo | `Sunday` |
| `M` | mes **abreviado** | `Nov` |
| `F` | mes completo | `November` |

```php
echo date("d-m-Y");           // 15-11-2026
echo date("d-m-Y H:i:s");     // 15-11-2026 19:50:02
echo date("l, F jS Y");       // Sunday, November 15th 2026
```

Todo sale **en inglés** (`Sunday`, `November`): `date()` no traduce.

> **Imprecisión de los apuntes (pág. 56):** dicen que «si se pone en mayúscula
> el día y el mes sale el nombre». Eso es solo para `D` y `M`, y sale
> **abreviado** (`Sun`, `Nov`). Para el nombre completo son `l` (ele minúscula)
> y `F`.

## 5. Timestamps: `time()` y `mktime()`

Un **timestamp** es el número de **segundos** desde el 1 de enero de 1970 a las
00:00:00 (época Unix).

```php
echo time();    // el momento actual, p. ej. 1594210589
```

`mktime()` construye el timestamp de una fecha concreta. **El orden de los
parámetros no es el de una fecha normal:**

```php
mktime($hora, $minuto, $segundo, $mes, $dia, $anio)
```

```php
$t1 = mktime(19, 50, 02, 9, 7, 2020);
$t2 = mktime(18, 50, 02, 9, 7, 2020);
echo $t1 - $t2;   // 3600  (una hora de diferencia en segundos)
```

Restar dos timestamps da la diferencia **en segundos**: 3600 = una hora. Es la
forma de calcular plazos.

## 6. `strtotime()`: de texto a timestamp

Hace lo contrario: recibe una fecha escrita y devuelve su timestamp.

```php
$timestamp = strtotime("10-09-2020 20:09:33");
echo $timestamp;   // 1599761373
```

También acepta expresiones relativas: `strtotime("+1 day")`,
`strtotime("next monday")`.

Y el camino de vuelta es `date()` con el timestamp como segundo parámetro:

```php
echo date("d-m-Y H:i:s", 1599501002);   // 07-09-2020 19:50:02
```

> **Cuidado con el ejemplo de los apuntes (pág. 58):**
> `date('10-09-2020 20:09:33')` **no** está formateando una fecha: como esa
> cadena no tiene ninguna letra de formato, `date()` la devuelve tal cual, y
> funciona «de casualidad» porque luego `strtotime()` la entiende. Lo correcto
> es escribir la fecha directamente: `strtotime('10-09-2020 20:09:33')`.

## 7. `checkdate()`: validar una fecha

```php
checkdate($mes, $dia, $anio)
```

- Orden: **mes, día, año** (otra vez distinto de lo habitual).
- Devuelve `true` si la fecha existe y `false` si no.
- Tiene en cuenta los años bisiestos.

```php
var_dump(checkdate(11, 31, 1986));   // false: noviembre tiene 30 días
var_dump(checkdate(2, 29, 2024));    // true: 2024 es bisiesto
var_dump(checkdate(2, 29, 2023));    // false
```

## 8. Zona horaria

Los timestamps y `date()` dependen de la **zona horaria** configurada
(`date.timezone` en `php.ini`). En los apuntes y en XAMPP suele ser
`Europe/Madrid`. Si el resultado de una fecha no coincide con lo esperado,
lo primero que hay que mirar es eso.

## 9. Resumen

- `round` al más cercano · `floor` abajo · `ceil` arriba.
- `rand($min, $max)` incluye los dos extremos.
- `date($formato, $timestamp)`: `d m Y` numérico, `D M` abreviado, `l F`
  completo, `H i s` hora.
- `mktime(hora, min, seg, mes, día, año)`.
- `strtotime("...")` texto → número; `date("...", $n)` número → texto.
- `checkdate(mes, día, año)`.
