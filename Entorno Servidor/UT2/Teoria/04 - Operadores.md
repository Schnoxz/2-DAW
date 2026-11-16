# 04 · Expresiones y operadores

> Apuntes §2.5 (págs. 23-30) · Guía de repaso §06 (pág. 5).

## 1. Qué es una expresión

«Cualquier cosa que tiene un valor». `5` es una expresión (vale 5), `$a` es una
expresión (vale lo que tenga), `$a + 3` es una expresión (vale la suma).

Como `$a = 5` deja a `$a` valiendo 5, `$b = $a` se comporta igual que
`$b = 5`.

## 2. Asignación y aritméticos

| Operador | Qué hace | Ejemplo |
|---|---|---|
| `=` | asigna | `$a = 5;` |
| `+` `-` `*` `/` | suma, resta, multiplicación, división | `$a + $b` |
| `%` | **resto** de la división entera (módulo) | `12 % 5` → `2` |
| `**` | potencia | `2 ** 3` → `8` |

**Asignación combinada** (operación + asignación en un paso):

| Operador | Equivale a |
|---|---|
| `$a += 5;` | `$a = $a + 5;` |
| `$a -= 10;` | `$a = $a - 10;` |
| `$a *= 3;` | `$a = $a * 3;` |
| `$a /= 10;` | `$a = $a / 10;` |
| `$a %= 3;` | `$a = $a % 3;` |
| `$cadena .= " más";` | `$cadena = $cadena . " más";` |

## 3. Comparación

| Operador | Significado |
|---|---|
| `==` | igual: **convierte los tipos** antes de comparar |
| `!=` o `<>` | distinto |
| `===` | **idéntico**: mismo valor **y mismo tipo** |
| `!==` | no idéntico: distinto valor **o** distinto tipo |
| `<` `>` `<=` `>=` | relacionales; devuelven booleano |
| `<=>` | comparador de orden: negativo / 0 / positivo |
| `??` | fusión de `null`: primer valor que exista y no sea `NULL` |

```php
var_dump(3 == "3");    // bool(true)   <- convierte el string a número
var_dump(3 === "3");   // bool(false)  <- distinto tipo
var_dump(0 == false);  // bool(true)   <- ¡trampa clásica!
var_dump(0 === false); // bool(false)
```

`<=>` (PHP 7+):

```php
var_dump(3 <=> 5);   // int(-1)  $a < $b
var_dump(5 <=> 5);   // int(0)   iguales
var_dump(7 <=> 5);   // int(1)   $a > $b
```

`??` evita el aviso cuando algo puede no existir:

```php
$nombre = $_GET['nombre'] ?? "invitado";   // si no llega, "invitado"
```

## 4. Lógicos

| Operador | Nombre | Es verdadero cuando… |
|---|---|---|
| `and` / `&&` | y | **ambos** son verdaderos |
| `or` / `\|\|` | o | **uno** de los dos es verdadero |
| `xor` | o exclusivo | uno sí **y el otro no** |
| `!` | negación | el operando era falso |

`&&` y `||` tienen **más precedencia** que `and` y `or`; en condiciones se usan
siempre los primeros. Aun así, ante la duda: **paréntesis**.

## 5. Incremento y decremento (pre vs. post)

Hacen dos cosas: suman/restan 1 **y devuelven un valor**.

| Operador | Qué devuelve |
|---|---|
| `++$a` (pre) | primero incrementa y **devuelve el valor nuevo** |
| `$a++` (post) | **devuelve el valor viejo** y luego incrementa |
| `--$a` (pre) | primero resta y devuelve el nuevo |
| `$a--` (post) | devuelve el viejo y luego resta |

```php
$a = 3; $b = $a++;
echo "\$a vale $a y \$b vale $b";   // $a vale 4 y $b vale 3

$a = 3; $b = ++$a;
echo "\$a vale $a y \$b vale $b";   // $a vale 4 y $b vale 4
```

> En los apuntes (pág. 28) se dice «primero suma y luego **asigna**». Lo correcto
> es **devuelve**: el operador no asigna nada, devuelve un valor con el que tú
> haces lo que quieras.

## 6. Concatenación

El punto `.` une cadenas. **El `+` nunca concatena**: siempre suma.

```php
echo "Hola " . $nombre;
echo "10" + 2;      // 12 (suma, no "102")
```

## 7. Operadores de arrays (avanzado, solo para el test)

| Operador | Resultado |
|---|---|
| `$a + $b` | unión: añade `$b` a `$a`; si una clave está en los dos, **gana el de la izquierda** |
| `$a == $b` | `TRUE` si tienen las mismas parejas clave/valor (sin importar el orden) |
| `$a === $b` | `TRUE` si además están **en el mismo orden** y con los mismos tipos |
| `$a != $b`, `$a <> $b` | desigualdad |
| `$a !== $b` | no idénticos |

## 8. Precedencia

Los operadores se evalúan en un orden fijo (como en matemáticas). El consejo
del tema, y es el bueno: **usa paréntesis** en cuanto haya más de dos
operadores. No cuesta nada y evita interpretaciones.
