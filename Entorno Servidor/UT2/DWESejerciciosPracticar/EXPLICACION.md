# UT2_2 · Ejercicios para practicar

## De qué va

Cinco ejercicios sobre las funciones básicas de PHP: fechas, números con coma,
cadenas y constantes. Sirven para ver cómo trata PHP los tipos, que es donde
aparecen las sopresas.

## Qué pide el enunciado

1. La fecha y la hora actuales con un formato concreto.
2. Explicar por qué una operación da `1,6` y no `1.6`.
3. Quitar espacios y medir la longitud de una cadena.
4. Usar constantes.
5. Dos archivos que muestran los tipos de dato.

## Paso a paso

### 1 · Fecha y hora

```php
echo date("l, F jS Y");    // Friday, September 15th 2023
echo "Son las " . date("H:i:s");
```

Cada letra del formato significa una cosa: `l` día de la semana, `F` mes en
letras, `j` día sin cero, `S` sufijo ordinal (`th`, `st`), `Y` año de cuatro
cifras, `H` hora en 24 h.

La hora que sale es la del **servidor**, no la del visitante. Por eso hay que
configurar la zona horaria:

```php
date_default_timezone_set("Europe/Madrid");
```

### 2 · Por qué sale `1,6`

En PHP, al convertir un número a texto se usa el separador decimal configurado en
el *locale*, y en español es la coma:

```php
echo 1.6;          // 1,6
echo 1.6 + 0.4;    // 2
```

No es un error: es la configuración regional. Si se necesita el punto siempre, se
usa `number_format($valor, 1, ".", "")` o `printf("%.1f", $valor)`.

Es importante porque al revés, al **leer** un número con coma desde un formulario,
`floatval("1,6")` devuelve 1 y se pierde el decimal.

### 3 · Espacios y longitud

```php
$texto = "  Hola mundo  ";
echo strlen($texto);          // 15 (con espacios)
echo strlen(trim($texto));    // 10
```

`trim()` quita los espacios de los extremos, no los del medio. Y `strlen()` cuenta
bytes: si la cadena tiene acentos, el resultado no coincide con el número de
letras. Para eso, `mb_strlen($texto, "UTF-8")`.

### 4 · Constantes

```php
define("IVA", 0.21);
const DESCUENTO = 0.10;

echo IVA;   // 0.21, sin el $
```

Una constante no lleva `$` y no se puede reasignar. `define()` se usa en tiempo de
ejecución; `const` en tiempo de compilación (dentro de clases, por ejemplo).

### 5 · Los dos archivos de tipos

El ejercicio 5 se abre con el servidor propio de PHP, no con XAMPP:

```bash
php -S localhost:8000
```

Y luego `tiposDeDato.php` y `tiposDeDato2.php`. El motivo es que el enunciado lo
pide así: el servidor embebido arranca en un comando y no necesita configurar
Apache.

Los dos archivos muestran lo mismo con `var_dump()`: el tipo y el valor de cada
variable.

```php
var_dump(5);        // int(5)
var_dump("5");      // string(1) "5"
var_dump(5.0);      // float(5)
var_dump(true);     // bool(true)
var_dump(null);     // NULL
```

## El código, pieza a pieza

```
DWESejerciciosPracticar/
├── index.php    pestañas 1 a 4
└── Ejercicio5/
    ├── tiposDeDato.php
    └── tiposDeDato2.php
```

## Trampas y dudas

- **La coma decimal rompe las cuentas.** Si llega `1,6` de un formulario,
  `floatval()` devuelve 1.
- **`date()` sin zona horaria** usa la del servidor; en un hosting puede estar en
  UTC.
- **`strlen` no es `mb_strlen`.** Con acentos, el primero miente.
- **Una constante no se interpola igual.** `"$IVA"` no funciona; hay que concatenar.

## Si me preguntan

- **¿`define` o `const`?** `const` para valores fijos del código; `define()` cuando
  el nombre se calcula o se define dentro de una condición.
- **¿Qué es el *locale*?** La configuración regional que decide el formato de
  números, fechas y monedas.
- **¿Por qué `php -S` y no XAMPP?** Porque es más rápido de arrancar y el enunciado
  lo pide; XAMPP es Apache completo y para esto sobra.
