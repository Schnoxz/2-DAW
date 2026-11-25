# UT3_1 · Estructuras de control

## De qué va

Ocho ejercicios de `if`, `switch`, `for` y `while` en PHP, todos en pestañas dentro
de un `index.php`. Los dos últimos son los obligatorios.

## Qué pide el enunciado

| # | Ejercicio | Qué practica |
|---|---|---|
| 1 | Lanzar una moneda | `rand()` y `if` |
| 2 | Nota a partir de un número aleatorio | rangos con `if/elseif` |
| 3 | Tres números iguales | comparaciones y `&&` |
| 4 | Sumar los pares de un formulario | `for` y `%` |
| 5 | Tabla UNICODE del 0 al 50000 | `for` y entidades |
| 6 | Tabla de multiplicar de un número al azar | `for` anidado |
| 7 | **Contar frutas** (obligatorio) | arrays y `foreach` |
| 8 | **Tabla 1–100 y emoticonos** (obligatorio) | bucles y maquetación |

## Paso a paso

### 1 y 2 · Azar y rangos

```php
$moneda = rand(0, 1);
echo $moneda === 0 ? "Cara" : "Cruz";
```

```php
$nota = rand(0, 10);
if ($nota < 5) {
  echo "Suspenso";
} elseif ($nota < 7) {
  echo "Aprobado";
} elseif ($nota < 9) {
  echo "Notable";
} else {
  echo "Sobresaliente";
}
```

En los rangos hay que empezar por el valor más bajo y usar `<`, o se solapan.

### 3 · Tres iguales

```php
if ($a === $b && $b === $c) {
  echo "Los tres son iguales";
} elseif ($a === $b || $b === $c || $a === $c) {
  echo "Hay dos iguales";
} else {
  echo "Los tres son distintos";
}
```

Se comparan de dos en dos; comparar `$a === $b === $c` no funciona porque el
primero devuelve un booleano.

### 4 · Sumar los pares

```php
$suma = 0;
for ($i = 0; $i <= $limite; $i++) {
  if ($i % 2 === 0) {
    $suma += $i;
  }
}
```

`$i % 2 === 0` es la forma de preguntar si es par. Se usa `===` para no depender de
la conversión.

### 5 · Tabla UNICODE

```php
for ($i = 0; $i <= 50000; $i += 100) {
  echo "&#$i; ";
}
```

Se salta de 100 en 100: 50.001 caracteres no caben en una página.

### 6 · Tabla de multiplicar

Dos bucles: uno para la tabla del número y otro para las filas, si se quiere en
formato de tabla HTML.

### 7 · Contar frutas (obligatorio)

```php
$frutas = ["manzana" => 3, "pera" => 5, "plátano" => 2];
$total = 0;

foreach ($frutas as $nombre => $cantidad) {
  echo "$nombre: $cantidad<br>";
  $total += $cantidad;
}
echo "Total: $total";
```

`foreach` con dos variables recorre clave y valor. Es lo que pide el ejercicio:
mostrar cada fruta y sumar el total.

### 8 · Tabla 1–100 y emoticonos (obligatorio)

Un `for` del 1 al 100 dentro de una tabla, con columnas fijas:

```php
echo "<table>";
for ($i = 1; $i <= 100; $i++) {
  if ($i % 10 === 1) echo "<tr>";
  echo "<td>$i</td>";
  if ($i % 10 === 0) echo "</tr>";
}
echo "</table>";
```

El truco es abrir y cerrar la fila cada diez celdas, no una tabla por número.

## El código, pieza a pieza

```
DWESEjerciciosUT3_1/
├── index.php            ocho pestañas (Bootstrap 5)
└── ejercicios/
    ├── ejercicio1.php … ejercicio8.php
    └── sumaPares.php    recoge el formulario del 4
```

## Trampas y dudas

- **`rand()` incluye los extremos**, así que `rand(1, 10)` puede dar 10.
- **Los rangos se escriben en orden.** Si se comprueba `> 9` primero, el resto
  nunca entra.
- **`%` con negativos** da resultados raros; no aplica aquí, pero conviene saberlo.
- **Tablas HTML dentro de un `for`**: hay que cerrar `</tr>` antes de abrir el
  siguiente.

## Si me preguntan

- **¿`for` o `foreach`?** `for` cuando sabes cuántas vueltas; `foreach` cuando
  recorres un array.
- **¿Por qué `===` en las comparaciones?** Porque `==` convierte tipos y `"0" == 0`
  es verdadero.
- **¿Qué es una entidad HTML?** La forma de escribir un carácter por su código:
  `&#128512;`.
