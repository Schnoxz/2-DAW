# 10 · Código trampa (simulacros de depuración)

> Guía de repaso §11 y §12 (págs. 9-10) · `..\escape_room.php`.
>
> Primero intenta encontrar los fallos **sin mirar la solución**. Los fallos
> están comentados con el número de la explicación.

## Parte A · El reto de la guía (3 fallos)

```php
<?php
$nombre = "Carlos";
echo 'Bienvenido $nombre<br>';
echo "Método de petición: " . $_SERVER['METHOD_REQUEST'] . "<br>";
if (is_empty($nombre)) {
  echo "Cadena vacía";
}
?>
```

| # | Fallo | Por qué |
|---|---|---|
| 1 | Comillas simples | `'...'` no interpola: imprimiría literalmente `Bienvenido $nombre`. Hay que usar `"..."`. |
| 2 | `METHOD_REQUEST` | La clave correcta es **`REQUEST_METHOD`**. |
| 3 | `is_empty()` | Esa función **no existe**; la nativa es `empty()`. |

```php
<?php
$nombre = "Carlos";
echo "Bienvenido $nombre<br>";                                  // 1
echo "Método de petición: " . $_SERVER['REQUEST_METHOD'] . "<br>"; // 2
if (empty($nombre)) {                                           // 3
  echo "Cadena vacía";
}
?>
```

**Moraleja:** los tres fallos son de *leer el código*, no de lógica. En un
examen, antes de ejecutar, se repasa: comillas, nombres de claves y nombres de
funciones.

## Parte B · `escape_room.php` (6 fallos)

El script procesa un pedido de comida: plato + extras, descuento y ticket.

### Código original (resumido)

```php
$plato_seleccionado = $_POST['plato'];
$extras_seleccionados = isset($_POST['extras']) ? $_POST['extras'] : [];

if (array_key_exists($plato_seleccionado, $menu)) {
  $precio_base = $menu[$plato_seleccionado];
}

foreach ($extras_precios as $extra) {
  if (in_array($extra, $extras_seleccionados)) {
    $total_extras += $extras_precios[$extra];
  }
}

$subtotal = $precio_base + $total_extras;

if ($subtotal > 12 AND $plato_seleccionado = "pizza") {
  $descuento = 2.0;
} else {
  $descuento = 0;
}

$ticket = [];
$ticket["Plato"] = $plato_seleccionado;
$ticket.push("Subtotal", $subtotal);
$ticket["Total"] = $subtotal - $descuento;

echo "<p>Detalles del ticket: " . $ticket . "</p>";
```

### Los 6 fallos

| # | Línea | Fallo | Consecuencia |
|---|---|---|---|
| 1 | `$_POST['plato']` | falta `isset()` o `??` | al abrir la página sin enviar, *Warning: Undefined array key* |
| 2 | `foreach ($extras_precios as $extra)` | recorre **valores** (precios), no claves | `$extra` vale `1.5`, `2.0`…, nunca `"queso"` |
| 3 | `in_array($extra, $extras_seleccionados)` | compara **precio con nombre** | nunca coincide: el extra nunca se cobra |
| 4 | `$plato_seleccionado = "pizza"` | `=` **asigna**, no compara | pisa el plato elegido **siempre** (la asignación se evalúa antes que `AND`) y, cuando el subtotal pasa de 12, el descuento se aplica aunque no sea pizza |
| 5 | `$ticket.push(...)` | sintaxis de **JavaScript** | en PHP `push()` no existe: *Call to undefined function* (error fatal) |
| 6 | `echo ... . $ticket` | un **array** no se imprime con `echo` | *Array to string conversion* y se ve `Array` |

Detalles que conviene saber:

- El archivo **compila**: `php -l escape_room.php` responde «No syntax errors
  detected». Los fallos 1 a 4 y el 6 son de **ejecución**, y el 5 salta en
  cuanto el script llega a esa línea. Es decir: el código «se ve bien» y falla
  al probarlo, que es justo lo que evalúa este tipo de ejercicio.
- El fallo 4 se arregla con `==`, pero además conviene cambiar `AND` por `&&`:
  `&&` tiene **más precedencia** que `AND`, y con `AND` la asignación se evalúa
  antes de lo que esperas.
- El fallo 5 en PHP se escribe **por clave**, no con `push`:
  `$ticket["Subtotal"] = $subtotal;`
- El fallo 6 se resuelve recorriendo el array con `foreach` o usando
  `print_r()` / `implode()`.
- `$extras_precios` es un array asociativo: `"queso" => 1.5`. Para recorrerlo
  con nombre y precio hace falta `foreach (... as $nombre => $precio)`.

### Código corregido

```php
<?php
$menu = ["pizza" => 10, "hamburguesa" => 8, "ensalada" => 6];
$extras_precios = ["queso" => 1.5, "bacon" => 2.0, "huevo" => 1.0];

// 1. ?? evita el aviso cuando la página se abre sin enviar el formulario.
$plato_seleccionado  = $_POST['plato'] ?? '';
$extras_seleccionados = $_POST['extras'] ?? [];

$precio_base  = 0;
$total_extras = 0;

if (array_key_exists($plato_seleccionado, $menu)) {
  $precio_base = $menu[$plato_seleccionado];
}

// 2. Recorro con clave => valor: $nombre es "queso" y $precio es 1.5.
foreach ($extras_precios as $nombre => $precio) {
  // 3. Comparo el NOMBRE del extra con lo que llegó del formulario.
  if (in_array($nombre, $extras_seleccionados)) {
    $total_extras += $precio;
  }
}

$subtotal = $precio_base + $total_extras;

// 4. == compara; = asignaba. Y && tiene más precedencia que AND.
if ($subtotal > 12 && $plato_seleccionado == "pizza") {
  $descuento = 2.0;
} else {
  $descuento = 0;
}

$ticket = [];
$ticket["Plato"]    = $plato_seleccionado;
// 5. En PHP el array no tiene push(): se asigna por clave.
$ticket["Subtotal"] = $subtotal;
$ticket["Total"]    = $subtotal - $descuento;

// 6. Un array no se imprime con echo: se recorre.
foreach ($ticket as $campo => $valor) {
  echo "<p>$campo: $valor €</p>";
}
?>
```

**Prueba:** con `pizza` + `queso` + `bacon` → subtotal `13.5`, descuento `2`,
total `11.5`.

## Parte C · Lista de comprobación para cualquier ejercicio

Antes de dar un script por bueno:

1. ¿Hay algún `=` dentro de un `if`? Debe ser `==` o `===`.
2. ¿Se lee `$_GET` / `$_POST` sin `isset()` ni `??`?
3. ¿Se usa `+` para unir texto? Debe ser `.`.
4. ¿Se imprime un array con `echo`?
5. ¿Se usan funciones que no existen (`is_empty`, `push`)?
6. ¿Los nombres de claves son los reales (`REQUEST_METHOD`, `SERVER_NAME`)?
7. ¿Se comparan posiciones de `strpos()` con `==`? Debe ser `===`.
8. ¿Hay tildes y se usa `strlen` / `substr` en vez de `mb_*`?
