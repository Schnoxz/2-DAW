# 09 · Ejercicios resueltos (tus entregas)

> Código real en `..\DWESejerciciosIniciales\`, `..\DWESejerciciosPracticar\` y
> `..\DWESejerciciosAvanzados\`. Aquí está lo que cada uno demuestra, que es lo
> que se pregunta en el examen.

## 1. Ejercicios iniciales

**Lo que se practica:** `rand()`, entidades Unicode, `substr_count()`.

| Ejercicio | Idea clave |
|---|---|
| 1. Número aleatorio | `rand(1, 1000)` y otro `rand(200, 800)` para el `font-size` |
| 2. Emoticono | el código Unicode se imprime como entidad: `&#$codigo;` |
| 3. Contar la letra `t` | `substr_count()` distingue mayúsculas: hay que sumar las dos cuentas |

```php
$numero = rand(1, 1000);
$tamano = rand(200, 800);
echo "<p style='font-size: $tamano%;'>$numero</p>";
```

```php
$emoticono = rand(128512, 128586);
echo "<p style='font-size: 100px;'>&#$emoticono;</p>";
```

```php
$frase = "This is a test";
$minusculas = substr_count($frase, "t");              // 2
$todas = $minusculas + substr_count($frase, "T");     // 3
```

En `"This is a test"` hay dos `t` minúsculas y una `T` mayúscula. La `T`
inicial no se cuenta con `substr_count($frase, "t")`.

## 2. Ejercicios para practicar

**Lo que se practica:** `date()`, operadores, `round()`, `str_replace()`,
constantes, `mb_strlen()` y el servidor propio de PHP.

### Ejercicio 1: fecha y hora

```php
echo date("l, F jS Y");   // Sunday, November 15th 2026
echo date("H:i:s");       // 19:50:02
```

`l` y `F` dan el nombre completo; `d-m-Y` daría `15-11-2026`.

### Ejercicio 2: operaciones

```php
$primerNumero = 8;
$segundoNumero = 5;

$resto     = $primerNumero % 5;                       // 3
$division  = $primerNumero / $segundoNumero;          // 1.6
$suma      = $primerNumero + $segundoNumero;          // 13
```

El detalle del ejercicio: PHP usa el **punto** como separador decimal, así que
para mostrarlo con coma se hace `str_replace(".", ",", round($division, 1))`.

### Ejercicio 3: quitar espacios

```php
$frase = "Ya decidí que esta noche se sale con todas mis motomami ";
$fraseSinEspacios = str_replace(" ", "", $frase);

echo mb_strlen($frase);              // 56
echo strlen($frase);                 // 57
echo mb_strlen($fraseSinEspacios);   // 45
```

La diferencia 56 / 57 es la `í` de «decidí»: **dos bytes** en UTF-8. Es la
demostración práctica de por qué se usa `mb_strlen()`.

### Ejercicio 4: constantes

```php
define("PI", 3.141592);
$radio = 2;

$area      = PI * $radio * $radio;      // 12.566368
$perimetro = 2 * PI * $radio;           // 12.566368 (con radio 2 coinciden)
echo PHP_INT_MAX;                       // 9223372036854775807
```

- `PI` va **sin `$`**: una constante no es una variable.
- `PHP_INT_MAX` es una constante que ya trae PHP.

### Ejercicio 5: tipos de dato

Se resuelve en un proyecto aparte y se arranca con el servidor propio:

```powershell
php -S localhost:8000
```

Es el mismo `php.exe` de XAMPP; la diferencia con Apache es que no hace falta
`htdocs`.

## 3. Ejercicio avanzado (UT2_3)

**Lo que se practica:** `$_GET`, `intval()`, medias, `mb_substr()` negativo y
`$_SERVER`.

### `matematicas.php`

```php
$num1 = intval($_GET['num1']);   // "8" -> 8
$num2 = intval($_GET['num2']);
$num3 = intval($_GET['num3']);

$suma     = $num1 + $num2 + $num3;
$producto = $num1 * $num2 * $num3;
$media    = round(($num1 + $num2 + $num3) / 3, 2);
```

Para el mayor y el menor se comparan con `if` / `elseif`: no hay función
«mayorDeTres». (Sí existe `max()` y `min()` con dos valores, que es una
alternativa más corta.)

### `cadena.php`

```php
$concatenada = $cadena1 . " " . $cadena2 . " del barrio";
$largo1      = mb_strlen($cadena1);        // 25
$ultimos10   = mb_substr($cadena2, -10);   // "e la calle"
$reemplazada = str_replace("Paco", "Maria", $cadena1);
```

- `.` concatena.
- `mb_substr($cadena, -10)` coge los **últimos** 10 caracteres.
- `str_replace()` cambia todas las apariciones.

### `infoServidor.php`

```php
echo $_SERVER['SERVER_NAME'];      // localhost
echo $_SERVER['SERVER_SOFTWARE'];  // Apache/2.4.x
echo PHP_VERSION;                  // 8.2.12
```

## 4. Lo que hay que saber defender

1. **Todo lo que llega por URL es texto**: se convierte con `intval()` antes de
   operar.
2. **Los parámetros pueden no llegar**: sin `isset()` o `??`, PHP 8 avisa.
3. **`$_SERVER['REQUEST_METHOD']`**, no `METHOD_REQUEST`.
4. **`mb_` cuando hay tildes**: `mb_strlen`, `mb_substr`.
5. **`. ` para unir, `+` para sumar**: no se mezclan.
6. **Los datos de una constante van sin `$`**.
