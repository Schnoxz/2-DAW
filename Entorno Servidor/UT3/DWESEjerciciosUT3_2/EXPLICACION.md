# UT3_2 · Arrays

## De qué va

Ocho ejercicios sobre arrays en PHP: crearlos con `array()`, recorrerlos, ordenarlos
por clave y por valor, convertirlos a JSON y trabajar con arrays
multidimensionales. Los dos últimos son los obligatorios.

## Qué pide el enunciado

| # | Ejercicio |
|---|---|
| 1 | Diez números aleatorios entre 1 y 30 |
| 2 | Media, tres máximos, tres mínimos, copia ordenada y borrar el segundo |
| 3 | Array multidimensional de países con sus ciudades |
| 4 | `asort`, `ksort`, `arsort`, `krsort` sobre el mismo array |
| 5 | Capitales ordenadas por clave y pasadas a mayúsculas |
| 6 | El array anterior en JSON con `json_encode()` |
| 7 | **50 aleatorios y sustituir los menores de 5 por «suspenso»** |
| 8 | **Suma de pares e impares en una tabla** |

## Paso a paso

### 1 y 2 · Generar y analizar

```php
$numeros = [];
for ($i = 0; $i < 10; $i++) {
  $numeros[] = rand(1, 30);
}

$media = array_sum($numeros) / count($numeros);
sort($numeros);                       // ordena el original
$tresMaximos = array_slice($numeros, -3);
$tresMinimos = array_slice($numeros, 0, 3);
```

Para la copia ordenada sin tocar el original:

```php
$copia = $numeros;   // en PHP los arrays se copian al asignar
sort($copia);
```

Y para borrar el segundo elemento:

```php
unset($numeros[1]);
$numeros = array_values($numeros);   // renumera las claves
```

`unset()` deja un hueco en los índices; `array_values()` los vuelve a numerar.

### 3 · Multidimensional

```php
$paises = [
  "España" => ["Madrid", "Barcelona", "Sevilla"],
  "Francia" => ["París", "Lyon"],
];

foreach ($paises as $pais => $ciudades) {
  echo "<h3>$pais</h3>";
  foreach ($ciudades as $ciudad) {
    echo "<li>$ciudad</li>";
  }
}
```

Un `foreach` por cada nivel.

### 4 · Las cuatro ordenaciones

```php
asort($capitales);    // por valor, manteniendo claves
ksort($capitales);    // por clave
arsort($capitales);   // por valor, al revés
krsort($capitales);   // por clave, al revés
```

La diferencia entre `sort()` y `asort()` es que `sort()` **tira las claves** y
numera de nuevo; `asort()` las conserva. Si el array es asociativo, casi siempre
quieres `asort`.

### 5 · Claves y mayúsculas

```php
ksort($capitales);
$mayusculas = array_map("mb_strtoupper", $capitales);
```

`array_map` aplica una función a cada elemento. Aquí, `mb_strtoupper` para que las
tildes no se rompan.

### 6 · JSON

```php
echo json_encode($capitales, JSON_UNESCAPED_UNICODE);
```

Sin `JSON_UNESCAPED_UNICODE`, las tildes salen como `\u00e9`. Es el formato que se
usa para enviar datos a JavaScript.

### 7 · Sustituir valores (obligatorio)

```php
for ($i = 0; $i < 50; $i++) {
  $valor = rand(1, 10);
  $notas[] = $valor < 5 ? "suspenso" : $valor;
}
```

Se decide al generar, así el array ya queda con el texto donde toca.

### 8 · Pares e impares en tabla (obligatorio)

```php
$pares = 0;
$impares = 0;

foreach ($numeros as $n) {
  if ($n % 2 === 0) $pares += $n; else $impares += $n;
}
```

Y se pinta cada número en una celda, con la suma al final.

## El código, pieza a pieza

```
DWESEjerciciosUT3_2/
├── index.php               ocho pestañas
└── ejercicios/
    ├── auxiliar.php        funciones propias para pintar arrays
    └── ejercicio1.php … ejercicio8.php
```

## Trampas y dudas

- **`unset()` no renumera.** El array queda con un hueco; `array_values()` lo
  arregla.
- **`sort()` modifica el array.** Para conservar el original, copia antes.
- **`array_slice` con índice negativo** cuenta desde el final.
- **Los arrays se copian al asignar**, al contrario que los objetos, que se pasan
  por referencia.

## Si me preguntan

- **¿`sort` o `asort`?** `sort` para listas; `asort`/`ksort` para arrays con clave.
- **¿Qué hace `json_encode`?** Convierte el array en una cadena JSON para enviarla
  o guardarla.
- **¿Cómo se recorre un array asociativo?** `foreach ($array as $clave => $valor)`.
