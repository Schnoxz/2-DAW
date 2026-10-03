# Tarea 4 - Formulario con `foreach`, `for` y `while`

## Enunciado

1. Crea un `select` para pedir el día de nacimiento: 1 al 31. Usa un `foreach`.
2. A su otro lado, un `select` para pedir el mes de nacimiento: 1 al 12. Usa un `for`.
3. Y a continuación otro `select` para pedir el año de nacimiento: 1900 al año
   actual. Usa un `while`.

## Resolución

Fichero: `solucion.php`

### Cómo está hecho

Los tres `select` se construyen **en el propio HTML**, escribiendo `<option>`
desde PHP. No hay arrays de datos aparte: los límites van en el bucle.

**Día con `foreach`** — necesita un array, así que se genera con `range()`:

```php
$dias = range(1, 31);
foreach ($dias as $dia) {
    echo "<option value=\"$dia\">$dia</option>";
}
```

**Mes con `for`** — no hace falta array:

```php
for ($mes = 1; $mes <= 12; $mes++) {
    echo "<option value=\"$mes\">$mes</option>";
}
```

**Año con `while`** — el límite superior es dinámico, `(int) date('Y')`, y
como no sabemos de antemano cuántos años hay, `while` es el encaje natural:

```php
$anio = 1900;
while ($anio <= $anioActual) {
    echo "<option value=\"$anio\">$anio</option>";
    $anio++;
}
```

### Mostrar lo elegido

Los tres `select` deben ir dentro de un mismo `<form>` para que el navegador
los envíe juntos. Después, con `$_POST`, se lee la elección:

```php
if ($_POST) {
    $dia  = $_POST['dia']  ?? '';
    $mes  = $_POST['mes']  ?? '';
    $anio = $_POST['anio'] ?? '';

    if ($dia !== '' && $mes !== '' && $anio !== '') {
        $fecha = checkdate((int) $mes, (int) $dia, (int) $anio);
        echo $fecha
            ? "Has nacido el $dia/$mes/$anio"
            : "Esa fecha no existe";
    }
}
```

### Puntos que conviene mirar

- `name` es obligatorio en cada `select`: es lo que PHP recibe en `$_POST`.
- `checkdate()` está en el núcleo precisamente porque con un `select` se puede
  elegir 31 de febrero.
- En PHP 8.1+ avisará que `$_POST['dia']` puede no existir; por eso el `??`.
- Las comillas dobles son necesarias para interpolar `$dia` dentro del
  atributo. Con comillas simples habría que concatenar.