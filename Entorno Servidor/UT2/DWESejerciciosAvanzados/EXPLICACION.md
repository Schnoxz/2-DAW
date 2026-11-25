# UT2_3 · Ejercicio avanzado

## De qué va

Es el ejercicio obligatorio de la UT2 y el primero con **varias páginas**. Hay una
página principal con tres botones y cada botón abre una página PHP distinta que
recibe sus datos por la URL (GET).

## Qué pide el enunciado

1. `index.php` con tres botones.
2. `matematicas.php`: tres números y operaciones con ellos.
3. `cadena.php`: reemplazar una cadena dentro de otra.
4. `infoServidor.php`: datos del servidor y versión de PHP.

## Paso a paso

### 1 · Los datos viajan en el `href`

```html
<a class="btn btn-primary btn-lg"
   href="matematicas.php?num1=8&amp;num2=15&amp;num3=3">Operaciones Matemáticas</a>
```

Todo lo que va detrás del `?` llega a PHP en `$_GET`. Cada pareja es
`nombre=valor` y se separan con `&`.

El `&amp;` del HTML es obligatorio en un enlace: un `&` suelto no es HTML válido y
el validador da error. El navegador lo convierte a `&` al enviar.

### 2 · Las operaciones

```php
$num1 = (int) ($_GET["num1"] ?? 0);
$num2 = (int) ($_GET["num2"] ?? 0);
$num3 = (int) ($_GET["num3"] ?? 0);

echo "Suma: " . ($num1 + $num2 + $num3);
echo "Media: " . (($num1 + $num2 + $num3) / 3);
```

Dos detalles:

- Los datos llegan **como texto**, así que hay que convertirlos con `(int)` o
  `intval()`.
- `?? 0` evita el aviso cuando falta un parámetro. Sin eso, PHP 8 lanza un
  *Warning* por cada índice que no existe.

Para la media conviene redondear:

```php
echo round(($num1 + $num2 + $num3) / 3, 2);
```

### 3 · Reemplazar una cadena

```php
$cadena1 = $_GET["cadena1"] ?? "";
$cadena2 = $_GET["cadena2"] ?? "";
echo str_replace("carne", "pesca", $cadena1);
```

`str_replace(busca, sustituye, texto)` cambia **todas** las apariciones. El
enunciado juega con «carniceria»: al cambiar «carne» por «pesca» queda
«pescaderia», no «pescadería».

### 4 · Información del servidor

```php
echo phpversion();
echo $_SERVER["SERVER_SOFTWARE"];
echo $_SERVER["HTTP_USER_AGENT"];
```

`$_SERVER` es un array con datos de la petición y del servidor: IP, software,
ruta del script, cabeceras. `phpinfo()` lo enseña todo, pero es demasiado y no se
debe dejar en producción.

## El código, pieza a pieza

```
DWESejerciciosAvanzados/
├── index.php           los tres botones con sus parámetros
├── matematicas.php     suma, media y operaciones
├── cadena.php          str_replace sobre los textos recibidos
└── infoServidor.php    versión de PHP y datos del servidor
```

## Trampas y dudas

- **Todo lo que llega por GET es texto y es del usuario.** Hay que convertir y
  validar; nunca meterlo en una consulta SQL sin escapar.
- **`??` no es `?:`.** `??` comprueba si existe y no es `null`; `?:` comprueba si
  es falso.
- **El `&amp;` es obligatorio en el HTML**, aunque el navegador sea tolerante.
- **`phpinfo()` en producción es un regalo** para quien busque vulnerabilidades.

## Si me preguntan

- **¿GET o POST?** GET para consultas y enlaces (los datos se ven en la URL); POST
  para enviar formularios con datos sensibles.
- **¿Qué diferencia hay entre `$_GET` y `$_REQUEST`?** `$_REQUEST` mezcla GET, POST
  y cookies; se desaconseja porque no sabes de dónde viene el dato.
- **¿Cómo se evita un aviso por parámetro ausente?** Con `isset()`, `empty()` o el
  operador `??`.
