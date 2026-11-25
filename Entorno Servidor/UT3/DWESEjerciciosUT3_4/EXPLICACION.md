# UT3_4 · Formularios

## De qué va

El bloque más largo de la UT3: enviar datos con formularios, guardarlos entre
peticiones (sin base de datos, con un archivo o con sesión) y generar una interfaz
que cambia según la hora. El ejercicio 3 es el reto.

## Qué pide el enunciado

1. **Ejercicio 1** · Formulario de salario: subida según tramo y edad.
2. **Ejercicio 2** · Alta de viviendas con validación y resumen.
3. **Ejercicio 3 (reto)** · Alquiler de viviendas: alta, galería de fotos, listado,
   modificar, borrar, ordenar y filtrar.

## Paso a paso

### 1 · Salario

```php
$salario = $_POST["salario"] ?? "";
if (!is_numeric($salario) || $salario <= 0) {
  header("Location: index.php?error=1");
  exit;
}
```

La validación se hace **antes** de calcular, y si falla se vuelve al formulario con
el error por GET. Así el usuario no ve el resultado con datos malos.

La subida se decide con rangos, comprobando primero el salario y después la edad.

### 2 · Viviendas

Un formulario con varios campos y un resumen al enviar. Lo importante es no fiarse
de nada:

```php
$precio = filter_input(INPUT_POST, "precio", FILTER_VALIDATE_FLOAT);
if ($precio === false || $precio <= 0) {
  $errores[] = "El precio no es válido.";
}
```

`filter_input()` devuelve `false` si no valida, y `null` si el campo no existe. Es
distinto de `0`, que sí es un valor válido.

### 3 · El reto

Se guardan las viviendas en un array de PHP dentro de un archivo o en `$_SESSION`,
para que no se pierdan entre peticiones:

```php
session_start();
$_SESSION["viviendas"] ??= [];
$_SESSION["viviendas"][] = $nuevaVivienda;
```

Cada acción es una petición distinta: `index.php` (formulario), `fotos.php`
(galería), `gestionarViviendas.php` (listado y acciones). Después de cada cambio se
redirige para no reenviar el formulario al recargar.

Para borrar y modificar se usa el índice del array:

```php
if (isset($_GET["borrar"])) {
  unset($_SESSION["viviendas"][$_GET["borrar"]]);
  header("Location: gestionarViviendas.php");
  exit;
}
```

### 4 · Cabeceras según la hora

Dos includes distintos, uno para la hora par y otro para la impar:

```php
$hora = (int) date("H");
include ($hora % 2 === 0) ? "cabecera1.php" : "cabecera2.php";
```

Así una misma página se ve de una forma u otra según cuándo se visite. Es una forma
sencilla de demostrar que el HTML se genera en el servidor.

## El código, pieza a pieza

```
DWESEjerciciosUT3_4/
├── index.php              tres pestañas
├── ejercicio1/
│   ├── index.php          formulario
│   └── salario.php        cálculo
├── ejercicio2/
│   ├── index.php          alta de vivienda
│   └── insertarVivienda.php
└── ejercicio3/
    ├── index.php          formulario
    ├── fotos.php          galería de imágenes
    ├── gestionarViviendas.php   listado, orden, filtro, modificar, borrar
    ├── funciones.php      datos y utilidades comunes
    ├── cabecera1.php / cabecera2.php
    └── footer1.php / footer2.php
```

## Trampas y dudas

- **Recargar después de un POST** reenvía el formulario. Por eso se redirige
  siempre después de guardar.
- **`$_POST` puede llegar vacío** si el formulario no tiene `method="post"` o el
  `name` no coincide.
- **`filter_input` devuelve `false` y `null`, que no son lo mismo.** Hay que
  comprobar con `===`.
- **`unset` deja huecos en los índices.** Si se listan con `for`, hay que recorrer
  con `foreach` o reindexar.

## Si me preguntan

- **¿GET o POST?** POST para enviar datos que cambian algo; GET para filtrar y
  navegar.
- **¿Para qué sirve `htmlspecialchars()`?** Para que lo que escribe el usuario no se
  interprete como HTML (XSS).
- **¿Dónde se guardan los datos sin base de datos?** En sesión (mientras dure la
  visita) o en un archivo JSON (si tienen que durar más).
