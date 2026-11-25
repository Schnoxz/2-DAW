<!-- Síntesis de estudio para el examen del lunes. Cada capítulo empieza en
     página nueva con el div class="pagebreak" (lo interpreta md2pdf.mjs). -->

# UT2 · Lenguaje PHP — Síntesis para el examen

**2º DAW · Desarrollo Web en Entorno Servidor · Examen teórico-práctico del tema 2**

Este documento sintetiza **toda la teoría del tema 2** a partir de los apuntes
oficiales (`UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf`, 59
páginas) y de la guía de repaso del profesor, y añade los ejercicios resueltos
de las tres entregas y el material trampa (reto de depuración y escape room).
El **capítulo 11** recoge las erratas de los apuntes: no copies esas líneas tal
cual, aunque estén en el PDF del profesor.

**Cómo estudiarlo**: capítulos 1 a 3 hoy; los ejercicios (cap. 4) mañana
tapando las salidas; los capítulos 5 y 6 como simulacro el domingo.

<div class="pagebreak"></div>

# Capítulo 1 · Qué entra exactamente

La guía de repaso del profesor define 4 bloques, con su enfoque de evaluación:

| Bloque | Contenidos críticos | Cómo se evalúa |
|---|---|---|
| 1. Sintaxis y ejecución | `<?php ?>`, omisión del cierre, comentarios, salida HTML | Test y detección de errores |
| 2. Variables y memoria | Identificadores, tipado débil, `E_NOTICE`, copia vs. referencia (`&`), ámbito | Predicción de salidas, preguntas en inglés |
| 3. Tipos y operadores | Escalares, conversión a boolean, casting, `==` vs `===`, `++$a` vs `$a++`, `??` | Test con penalización y prácticos |
| 4. Superglobales y funciones | `$_GET`, `$_POST`, `$_REQUEST`, `$_SERVER`; cadenas, matemáticas y fechas | Desarrollo de scripts y depuración |

Dos avisos de la propia guía: el examen incluye **preguntas en inglés** (hay
glosario al final), y el tipo test lleva **penalización** por fallo.

<div class="pagebreak"></div>

# Capítulo 2 · PHP y HTML: código incrustado

## 2.1 Cómo funciona realmente

PHP (Hypertext Preprocessor) es un lenguaje de **lado servidor**: el código se
ejecuta en el servidor, no en el navegador. Una página PHP es un fichero de
HTML normal con bloques de PHP incrustados entre las etiquetas `<?php` y `?>`,
que son las que permiten "entrar y salir del modo PHP".

Cuando el navegador pide la página, el servidor recorre el fichero: todo lo que
está fuera de los bloques se manda tal cual, y **cada bloque PHP se ejecuta y
se sustituye por su salida** (lo que escriben sus `echo`). Por eso:

- El navegador **nunca ve código PHP**. Si haces Ctrl+U (ver código fuente),
  solo ves HTML con los resultados ya sustituidos.
- Para que un `.php` se ejecute tiene que estar **dentro del servidor**: la
  carpeta `C:\xampp\htdocs\` con Apache de XAMPP arrancado, y se visita como
  `http://localhost/nombre.php`. Abrir el fichero con doble clic no ejecuta
  PHP: enseñaría el código sin interpretar.
- Si el proyecto está en una carpeta (`htdocs/proyecto1/`), la página inicial
  se llama **`index.php`** y se abre con solo poner
  `http://localhost/proyecto1/`; las demás páginas piden su nombre completo.

```php
<!-- hola_mundo.php -->
<html>
<body>
  <p>Mi primera página</p>
  <?php echo "Hola Mundo"; ?>
</body>
</html>
```

El navegador recibe `<p>Mi primera página</p><p>Hola Mundo</p>`: el bloque PHP
ha desaparecido y en su sitio queda su salida.

## 2.2 Sintaxis básica

- El elemento básico es el **bloque** `<?php ... ?>` con **sentencias separadas
  por punto y coma**.
- Si un fichero es **100% PHP**, se recomienda **omitir el `?>` final**: al
  incluir ese fichero en otros, un espacio o salto de línea sobrante después de
  la etiqueta se mandaría al navegador sin querer y rompería cabeceras.
- Comentarios: de línea con `//` o `#`, y de bloque entre `/*` y `*/`.
  Comentar es buena práctica y en los exámenes prácticos se valora.

<div class="pagebreak"></div>

# Capítulo 3 · Variables, memoria y tipos

## 3.1 Variables: no se declaran, se crean

PHP es **no fuertemente tipado** (tipado débil): no se indica el tipo al crear
una variable; se crea **la primera vez que se le asigna un valor**, y el tipo
depende de ese valor. `$entero = 4;` la crea de tipo `integer`. Y puede
cambiar: `$precio = 100;` después `$precio = "cien";` y pasa a ser string.

La agilidad tiene trampa: si no se presta atención, aparecen errores difíciles
de depurar. Por eso el examen insiste en las conversiones y en las comprobaciones.

Reglas de los identificadores:

- Empiezan siempre por `$`, y después por **letra o guion bajo `_`** (nunca
  número: `$5alumnos` es error de sintaxis).
- Después pueden llevar letras, números y `_`.

## 3.2 Copia vs. referencia (el `&`)

- **Copia**: `$b = $a;` crea una variable nueva con el valor de `$a`. Son
  **posiciones de memoria distintas** aunque el valor coincida. Cambiar una no
  toca la otra.
- **Referencia**: `$b = &$a;` hace que `$b` apunte a la **misma dirección de
  memoria** que `$a`: son **dos nombres para el mismo dato**. Lo que cambies en
  uno, se ve en el otro.

```php
$var1 = 100;
$var2 = &$var1; // referencia: comparten memoria
$var3 = $var1;  // copia: independiente
$var2 = 300;    // $var1 también pasa a 300
$var3 = 400;    // $var1 no se entera
echo $var1;     // imprime 300
```

## 3.3 Variables no inicializadas: E_NOTICE

Si se usa una variable antes de asignarle valor, PHP lanza un aviso **E_NOTICE**
(no interrumpe el script), toma el **valor por defecto del contexto** — `0` en
operaciones numéricas, `""` en cadenas, `FALSE` en booleanas — y sigue.

```php
$total = 50 + $noDefinida; // E_NOTICE, $noDefinida vale 0 -> $total = 50
```

## 3.4 Constantes

```php
define("LIMITE", 1000);
```

Con `define("NOMBRE", valor)`: el nombre **sin `$`** (se pasa entre comillas),
y por convención **en mayúsculas**. Su valor no puede modificarse después.
Existen también constantes predefinidas del lenguaje, como `PHP_VERSION`
(la versión de PHP instalada).

## 3.5 Los tipos de dato

**4 escalares**: `integer`, `float`, `string`, `boolean`.

- **integer**: enteros. Su tamaño depende de la plataforma; se consulta con las
  constantes `PHP_INT_SIZE`, `PHP_INT_MAX`, `PHP_INT_MIN`.
- **float**: números reales, con precisión de ~14 decimales. La conversión
  entre `integer` y `float` es automática; también se puede forzar con los
  operadores de casting `(int)` y `(float)`.
- **string**: cadenas. Comillas dobles ("comillas mágicas") sustituyen las
  variables por su valor; las simples no (todo literal). La concatenación se
  hace con el punto.
- **boolean**: solo `TRUE`/`FALSE`. Es lo que devuelven los operadores de
  comparación y lo que se usa en `if` y bucles.

**Compuestos y especiales**: `array` (colecciones), `object` (POO),
`callable` (funciones que se pasan a otras funciones), `null` (variable sin
valor: se le asigna `NULL` o no está inicializada), `resource` (recursos
externos, como una conexión a base de datos).

**Conversión a boolean (la tabla de examen)** — cuando se espera un booleano y
llega otra cosa:

| Tipo | FALSE | TRUE |
|---|---|---|
| integer | solo `0` | cualquier otro entero (incluso `-1`) |
| float | solo `0.0` | cualquier decimal ≠ 0 |
| string | `""` y `"0"` | todo lo demás, incluidos `" "`, `"0.0"`, `"false"` |
| array | sin elementos | con al menos uno |
| sin inicializar / null | siempre | nunca |

## 3.6 Ámbito de las variables

El **ámbito** es la parte del código donde la variable es visible:

- Una variable declarada en un fichero PHP está disponible en **ese fichero y
  en los ficheros que este incluya** (`include`/`require`).
- Cada **función crea un ámbito local cerrado**: dentro solo se ven las
  variables locales y los argumentos. Desde la función **no** se ve lo global.
- Para usar una global dentro de una función, dos opciones: la palabra
  `global $x;` o el array `$GLOBALS['x']`.

## 3.7 Variables predefinidas y superglobales

PHP trae variables predefinidas con información del servidor, del cliente y del
entorno. El grupo importante son las **superglobales**: disponibles **en
cualquier ámbito sin declarar `global`**.

| Superglobal | Contiene | Ejemplo de acceso |
|---|---|---|
| `$_GET` | parámetros enviados visibles en la URL (query string) | `calc.php?a=12` → `$_GET['a']` |
| `$_POST` | datos enviados ocultos en el cuerpo de la petición | formulario `method="post"` → `$_POST['usuario']` |
| `$_REQUEST` | `$_GET` + `$_POST` + `$_COOKIE` en un solo array | `$_REQUEST['dato']` |
| `$_SERVER` | servidor, cabeceras y rutas de ejecución | `PHP_SELF`, `SERVER_NAME`, `SERVER_SOFTWARE`, `REQUEST_METHOD` |
| `$_FILES` / `$_COOKIE` / `$_SESSION` | ficheros subidos / cookies / sesión | — |

<div class="pagebreak"></div>

# Capítulo 4 · Expresiones y operadores

Una **expresión** es "cualquier cosa que tiene un valor". `$a = 5` asigna el
valor 5; después, `$a` es también una expresión con valor 5, por eso
`$b = $a` se comporta como `$b = 5`.

## 4.1 Aritméticos y de asignación

- Aritméticos: `+ - * / % **` — `%` es el **resto** de la división entera
  (`12 % 5` es 2) y `**` la potencia (`2 ** 3` es 8).
- Asignación combinada (operación + asignación en un paso): `+=`, `-=`, `*=`,
  `/=`, `%=`, y **`.=` para concatenar y asignar**:
  `$cadena .= " más texto";`.

## 4.2 Comparación: el corazón del tipo test

| Operador | Significado |
|---|---|
| `==` | igual (**convierte tipos** antes de comparar) |
| `!=`, `<>` | distinto |
| `===` | idéntico: mismo valor **y mismo tipo** |
| `!==` | no idéntico: distinto valor o distinto tipo |
| `<`, `>`, `<=`, `>=` | relacionales (devuelven booleano) |
| `<=>` | comparador de orden: negativo / 0 / positivo según `$a` sea menor/igual/mayor que `$b` (PHP 7+) |
| `??` | fusión de null: el primer valor de izquierda a derecha que exista y no sea NULL; `NULL` si ninguno |

El `===` y el `!==` no están en todos los lenguajes y son los favoritos del
examen: `3 == "3"` es TRUE (convierte), `3 === "3"` es FALSE (tipos distintos).

## 4.3 Lógicos

`and`/`&&` (y), `or`/`||` (o), `xor` (uno sí pero no ambos), `!` (negación).
Se combinan con los de comparación en las condiciones. En expresiones escritas
se prefiere `&&`/`||` por su precedencia.

## 4.4 Incremento y decremento (pre vs post)

Hacen **dos cosas a la vez**: suman/restan 1 y **devuelven un valor** — y ahí
está la diferencia:

- `++$a` (pre): **primero** incrementa, **luego** devuelve el valor nuevo.
- `$a++` (post): **primero** devuelve el valor viejo, **luego** incrementa.

```php
$x = 5;
echo $x++;   // imprime 5 (el valor viejo); $x ya vale 6
echo $x;     // imprime 6
echo ++$x;   // imprime 7 (incrementa y devuelve el nuevo)
```

## 4.5 Cadena y arrays

- **`.`** concatena cadenas. El `+` nunca concatena: en PHP siempre es suma
  (con `"10" + 2` convierte y da 12).
- Operadores para arrays (se verán más con arrays, pero caen en test): `$a +
  $b` es la **unión** (ganan los elementos del array de la izquierda cuando la
  clave existe en ambos); `$a == $b` TRUE si tienen las mismas parejas
  clave/valor; `$a === $b` exige además mismo orden y mismos tipos.

## 4.6 Precedencia

Los operadores tienen orden de prioridad (como en mates). Consejo de los
apuntes, y es oro para el examen: **usa paréntesis** en expresiones largas; así
no hay interpretaciones distintas.

<div class="pagebreak"></div>

# Capítulo 5 · Funciones nativas

## 5.1 Comprobar variables (los casos críticos del test)

| Función | TRUE cuando… | Trampa de examen |
|---|---|---|
| `isset($x)` | existe y su valor **no es NULL** | `$x = null;` → `isset($x)` es **FALSE** |
| `empty($x)` | no existe **o** equivale a FALSE (0, "0", "", [], null) | `$x = "0";` → `empty($x)` es **TRUE** |
| `is_null($x)` | es exactamente NULL | es `is_null()`, no `is_nulo()` |
| `is_int/is_float/is_string/is_bool` | tipo exacto, **sin convertir** | `is_float("123.45")` es **FALSE** (es string) |
| `is_numeric($x)` | número o string numérico válido | `is_numeric("123.45")` es **TRUE** |
| `is_array($x) / is_object($x)` | tipo array / objeto | — |
| `gettype($x)` / `settype($x, "integer")` | dice el tipo / cambia el tipo en la variable | — |
| `var_dump($x)` | tipo y longitud, para depurar | `string(4) "Hola"` |
| `print_r($x)` | información legible (ideal para arrays) | — |

Conversiones de tipo: `intval()`, `floatval()`, `strval()`, `boolval()` — y el
casting con `(int)`, `(float)`. Ojo: `intval("ANBB")` da 0 (lo que pueda
parsear del principio).

## 5.2 Cadenas

Ojo con el detalle de los apuntes: **el primer carácter de una cadena ocupa la
posición 0**. Y las funciones `mb_*` son las que respetan tildes y ñ.

| Función | Qué hace | Trampa / detalle |
|---|---|---|
| `strlen()` | longitud en **bytes** | `strlen("Martín")` da 7 (la í vale 2 bytes); para caracteres reales `mb_strlen()` da 6 |
| `mb_strlen()` | longitud en caracteres Unicode | la versión "buena" con acentos |
| `strtoupper()/strtolower()` | mayúsculas/minúsculas | con tildes se quedan a medias: para eso `mb_strtoupper()` / `mb_strtolower()` |
| `ucfirst()` | primera letra en mayúscula | si la primera letra lleva tilde, hay que arreglarla a mano con `mb_substr` |
| `ucwords()` | primera letra de cada palabra | "fernando gonzalo" → "Fernando Gonzalo" |
| `mb_convert_case($c, MB_CASE_TITLE)` | tipo título respetando Unicode | modos: MB_CASE_UPPER / LOWER / TITLE |
| `substr($c, inicio, largo)` | extrae una porción | inicio desde 0; **índice negativo cuenta desde el final** (`substr($c, -15)` = últimos 15) |
| `mb_substr()` | lo mismo respetando Unicode | con tildes, los índices de `substr` se descuadran |
| `trim($c)` | quita espacios al principio y al final | acepta un **segundo parámetro**: `trim($c, '/')` quita las barras; `ltrim()`/`rtrim()` solo por un lado |
| `substr_count($c, "e")` | cuenta apariciones | **sensible a mayúsculas**; útil para saber si algo está contenido |
| `str_replace(buscar, nuevo, $c, $contador)` | reemplaza todas las apariciones | el 4º parámetro (opcional) **cuenta cuántos reemplazos hizo** |
| `strtr($c, 'aet', 'AET')` | cambia carácter a carácter | la a por A, la e por E, la t por T |
| `strstr($c1, $c2)` | devuelve la parte de $c1 **desde la primera aparición de $c2 hasta el final** | sirve para comprobar si una cadena contiene otra |
| `strpos($c1, $c2) / stripos()` | posición de la primera ocurrencia (stripos ignora mayúsculas) | **comparar con `=== false`**: si está en la posición 0, un `== false` diría "no encontrada" |
| `str_contains($c, $sub)` | TRUE si contiene la subcadena | PHP 8; lo más legible para "¿contiene?" |

## 5.3 Numéricas

| Función | Qué hace | Ejemplo |
|---|---|---|
| `round($n, $dec)` | redondeo aritmético a N decimales | `round(2.456, 2)` → 2.46 |
| `floor($n)` | redondeo **siempre hacia abajo** | `floor(1.50)` → 1 |
| `ceil($n)` | redondeo **siempre hacia arriba** | `ceil(1.50)` → 2 |
| `rand($min, $max)` | entero al azar, **extremos incluidos** | `rand(1, 9)` puede dar 1 o 9 |
| `max(...)/min(...)` | mayor/menor sin `if` | `max(12, 5)` → 12 |

## 5.4 Fechas y tiempo

| Función | Qué hace | Detalle clave |
|---|---|---|
| `date($formato)` | fecha actual formateada | `d` día, `m` mes, `Y` año, `H:i:s` hora:min:seg. Ej.: `date('d-m-Y H:i:s')`. Acepta un **2º parámetro**: el timestamp a formatear |
| `time()` | timestamp actual (segundos desde el 1-1-1970 00:00:00 UTC) | **no admite formato**; devuelve el número tal cual |
| `mktime(h, m, s, mes, día, año)` | timestamp de una fecha dada | **orden de los 6 parámetros: hora, minuto, segundo, MES, DÍA, año** (¡mes antes que día!) |
| `strtotime($cadenaFecha)` | lo contrario: de fecha en texto a timestamp | `strtotime('10-09-2020 20:09:33')` → segundos |
| `checkdate($mes, $dia, $anio)` | ¿la fecha existe? | **orden: MES, DÍA, AÑO**; `checkdate(2, 30, 2026)` es FALSE porque el 30 de febrero no existe |

El timestamp es útil para medir tiempos: restar dos `mktime()`/`time()` da los
**segundos** entre medias (1 hora = 3600).

<div class="pagebreak"></div>

# Capítulo 6 · Ejercicios resueltos

**Estúdialos tapando la salida y preguntándote qué imprime cada línea** — son
el nivel del examen.

## 6.1 Número aleatorio con tamaño aleatorio (iniciales, ej. 1)

```php
$numero = rand(1, 1000);      // entero al azar entre 1 y 1000, ambos incluidos
$tamano = rand(200, 800);     // el tamaño de letra también al azar
echo "<p style='font-size: $tamano%;'>$numero</p>";
```

**Qué demuestra**: `rand($min, $max)` con extremos incluidos, comillas dobles
que interpolan variables dentro del HTML, y atributos HTML con comillas
simples para no romper la cadena.

## 6.2 Emoticono Unicode al azar (iniciales, ej. 2)

```php
$emoticono = rand(128512, 128586);
echo "<p style='font-size: 100px;'>&#$emoticono;</p>";
```

**Qué demuestra**: los códigos Unicode se escriben como `&#codigo;`, y como el
código lo genera PHP, la variable se interpola en medio: `&#$emoticono;`.

## 6.3 Contar letras con substr_count (iniciales, ej. 3)

```php
$frase = "This is a test";
$minusculas = substr_count($frase, "t");
$todas = $minusculas + substr_count($frase, "T");
```

**Qué demuestra**: `substr_count()` **distingue mayúsculas de minúsculas**;
para contarlas todas hay que sumar las dos cuentas.

## 6.4 Tipos de dato: is_float e is_null (para practicar, ej. 5)

```php
$numFloat = 5.7;
if (is_float($numFloat)) { /* sí es float */ }

$variableSinValor = null;
if (is_null($variableSinValor)) { /* sí es NULL */ }
```

**Qué demuestra**: `is_float()` comprueba el tipo exacto (con `"5.7"` entre
comillas daría FALSE), y `is_null()` solo da TRUE con el valor NULL. En tu
propia entrega está el porqué: se asigna `null` a mano para que `is_null()` no
avise de que la variable no existe.

## 6.5 Cadenas que llegan por GET (avanzado, cadena.php)

```php
$cadena1 = $_GET['cadena1'];
$concatenada = $cadena1 . " " . $cadena2 . " del barrio";  // el punto pega cadenas
$largo1 = mb_strlen($cadena1);          // mb_ porque strlen() contaría bytes con tildes
$ultimos10 = mb_substr($cadena2, -10);  // índice negativo: desde el final
$reemplazada = str_replace("Paco", "Maria", $cadena1);
```

**Qué demuestra**: concatenación con `.`, `mb_strlen` vs `strlen`,
`substr` con índice negativo y `str_replace(buscado, sustituto, cadena)`.

## 6.6 Matemáticas con parámetros de la URL (avanzado, matematicas.php)

```php
$num1 = intval($_GET['num1']);   // el parámetro de la URL llega como texto
$media = round(($num1 + $num2 + $num3) / 3, 2);  // redondeo a 2 decimales

if ($num1 > $num2 && $num1 > $num3) { $mayor = $num1; }
elseif ($num2 > $num3) { $mayor = $num2; }
else { $mayor = $num3; }
```

**Qué demuestra**: `$_GET` llega siempre como string (hay que convertir con
`intval()` o `(int)`), `round()` para decimales, y el `&&` en condiciones
compuestas. Nota de tu entrega: PHP separa los decimales con punto.

## 6.7 Los dos ejemplos de la guía de repaso (página 8)

**Ejemplo A — lectura segura de `$_GET`** (el patrón de "desarrollo de
scripts" del examen):

```php
// URL: producto.php?precio=45&unidades=3
if (isset($_GET['precio']) && isset($_GET['unidades'])) {
  $total = $_GET['precio'] * $_GET['unidades'];
  echo "<p>Importe total: " . round($total, 2) . " €</p>";
} else {
  echo "<p>Faltan parámetros en la URL.</p>";
}
```

**Ejemplo B — limpieza y extracción de subcadenas:**

```php
$curso = " Programación Web en PHP ";
$limpio = trim($curso);
echo "Caracteres: " . mb_strlen($limpio) . "<br>";
echo "Apariciones de 'o': " . substr_count(strtolower($limpio), "o") . "<br>";
echo "Final: " . substr($limpio, -6);
```

Estos dos **hay que saberlos escribir de memoria**.

<div class="pagebreak"></div>

# Capítulo 7 · Código trampa 1: el reto de la guía

La guía de repaso (página 9) propone localizar 3 errores en este fragmento:

```php
$nombre = "Carlos";
echo 'Bienvenido $nombre<br>';
echo "Método de petición: " . $_SERVER['METHOD_REQUEST'] . "<br>";
if (is_empty($nombre)) {
  echo "Cadena vacía";
}
```

## Solución comentada

1. **Comillas simples**: `'Bienvenido $nombre'` no interpola la variable;
   imprimiría el `$nombre` tal cual. Solución: comillas dobles.
2. **Clave inexistente**: en `$_SERVER` la clave correcta es `REQUEST_METHOD`
   (el método de la petición). `METHOD_REQUEST` no existe: aviso de índice
   indefinido.
3. **Función inexistente**: `is_empty()` no existe en PHP; la nativa es
   `empty()`. Con una función inexistente el script muere con error fatal.

> Estas tres trampas son las "favoritas" del examen: comillas que no
> interpolan, claves mal escritas en `$_SERVER` y nombres de función inventados.

<div class="pagebreak"></div>

# Capítulo 8 · Código trampa 2: el escape room

**AVISO: este capítulo tiene las soluciones. Si vas a usar el
`escape_room.php` como simulacro, no lo leas hasta haberlo intentado.**

El fichero `2-DAW\Entorno Servidor\UT2\escape_room.php` procesa un pedido de
restaurante (plato + extras) y calcula el total. El código tiene **seis
fallos** escondidos. Primero el código, luego los fallos.

## 8.1 El código (resumido)

```php
$menu = ["pizza" => 10, "hamburguesa" => 8, "ensalada" => 6];
$extras_precios = ["queso" => 1.5, "bacon" => 2.0, "huevo" => 1.0];

$plato_seleccionado = $_POST['plato'];
$extras_seleccionados = isset($_POST['extras']) ? $_POST['extras'] : [];

$precio_base = 0;
$total_extras = 0;

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

echo "<h3>Resumen de tu pedido:</h3>";
echo "<p>Detalles del ticket: " . $ticket . "</p>";
```

## 8.2 Los seis fallos, explicados

1. **`$_POST['plato']` sin comprobar antes.** La primera vez que se abre la
   página nadie ha enviado el formulario: el índice no existe y salta el aviso
   de *Undefined index*. Es la trampa del Ejemplo A: **primero `isset()`,
   después usar**.

2. **`foreach ($extras_precios as $extra)` recorre los valores, no los
   nombres.** `$extra` va tomando los precios (1.5, 2.0, 1.0), no las claves
   ("queso", "bacon", "huevo"). El `in_array($extra, ...)` compara precios
   contra nombres: nunca coincide y los extras **siempre cuestan 0**.
   Solución: `foreach ($extras_precios as $nombre => $precio)` y buscar
   `in_array($nombre, $extras_seleccionados)`.

3. **`=` en vez de `==` dentro de la condición**:
   `if ($subtotal > 12 AND $plato_seleccionado = "pizza")`. La asignación
   convierte el plato en "pizza" **y devuelve "pizza"** (valor no vacío, o sea
   TRUE), así que esa parte del `if` siempre se cumple. Solución: `==`.

4. **`$ticket.push(...)` no es PHP.** `push()` es de JavaScript. En PHP la
   forma correcta es `$ticket["Subtotal"] = $subtotal;`.

5. **`echo $ticket` con un array.** PHP no convierte un array en texto: aviso
   de *Array to string conversion* y por pantalla se ve `Array`. Solución:
   `print_r($ticket)` (o `var_dump`, que enseña además los tipos).

6. **El ticket real habría que recorrerlo.** El resumen de verdad sale
   recorriendo el array con `foreach`: el detalle que distingue un "funciona"
   de un "está bien".

## 8.3 Qué bloque comprueba cada fallo

| Fallo | Bloque del examen |
|---|---|
| `$_POST` sin `isset` | Superglobales + lectura segura (bloque 4) |
| `as $extra` sin clave | Recorridos de arrays (bloque 4) |
| `=` en un `if` | Operadores relacionales (bloque 3) |
| `.push()` de JS en PHP | Sintaxis (bloque 1) |
| `echo $array` | Tipos + depuración con `print_r`/`var_dump` (bloques 2 y 4) |

<div class="pagebreak"></div>

# Capítulo 9 · Mini-test de predicción de salidas

Tapa el capítulo 10 y escribe qué imprime cada uno.

1. `$a = "10"; $b = $a + 2; echo $b;`
2. `$nombre = "Ana"; echo 'Hola $nombre';`
3. `$a = 10; $b = &$a; $a = 6; echo $b;`
4. `var_dump(3 == "3"); var_dump(3 === "3");`
5. `$x = null; var_dump(isset($x));`
6. `var_dump(empty("0"));`
7. `$n = 5; echo $n++; echo $n;`
8. `echo 12 % 5;`
9. `var_dump(is_numeric("123.45")); var_dump(is_float("123.45"));`
10. `echo strlen("Martín") . " / " . mb_strlen("Martín");`
11. `var_dump(checkdate(2, 30, 2026));`
12. `echo ceil(4.2) . " y " . floor(4.9);`
13. `$pos = strpos("abc", "a"); if ($pos == false) { echo "no está"; } else { echo "está"; }`
14. `$c = "Una manzana"; str_replace("manzana", "naranja", $c, $n); echo $n;`

<div class="pagebreak"></div>

# Capítulo 10 · Respuestas del mini-test

1. `12` — el `+` convierte `"10"` a número.
2. `Hola $nombre` — comillas simples: literal.
3. `6` — referencia: son el mismo dato.
4. `bool(true)` y `bool(false)` — `==` convierte, `===` no.
5. `bool(false)` — isset es FALSE con NULL.
6. `bool(true)` — `"0"` vale como FALSE.
7. `56` — primero imprime el 5 viejo; después la variable ya vale 6.
8. `2` — resto de la división entera.
9. `bool(true)` y `bool(false)` — numeric acepta strings numéricos; is_float
   exige tipo exacto.
10. `7 / 6` — strlen cuenta bytes (la í vale 2 en UTF-8); mb_strlen caracteres.
11. `bool(false)` — el 30 de febrero no existe (orden: mes, día, año).
12. `5 y 4` — ceil siempre arriba, floor siempre abajo.
13. `no está` — ¡trampa! `strpos("abc","a")` devuelve **0**, y `0 == false` es
    TRUE. Por eso hay que comparar con `=== false`. (Es el fallo clásico de los
    apuntes.)
14. `1` — str_replace reemplaza una vez y el 4º parámetro cuenta los cambios.

## Glosario para las preguntas en inglés

| Término | Qué es |
|---|---|
| semicolon | el `;` que cierra cada sentencia |
| single-line comment | comentario de una línea (`//` o `#`) |
| uninitialized variable | genera `E_NOTICE` y vale 0 / "" / FALSE |
| type conversion | la hace `==` implícitamente; `===` la evita |
| pre-increment | `++$a` suma antes de asignar el valor |
| assignment vs. comparison | `=` asigna, `==` compara (trampa clásica en un `if`) |

## Dónde está cada fuente

| Material | Ruta |
|---|---|
| Apuntes oficiales del tema (59 págs.) | `Entorno Servidor\UT2\UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf` |
| Guía oficial de repaso del profesor | `Entorno Servidor\UT2\Presentación de Repaso - UT2 Lenguaje PHP.pdf` |
| Entrega resuelta (iniciales) | `Entorno Servidor\UT2\DWESejerciciosIniciales\` |
| Entrega resuelta (practicar) | `Entorno Servidor\UT2\DWESejerciciosPracticar\` |
| Entrega resuelta (avanzado) | `Entorno Servidor\UT2\DWESejerciciosAvanzados\` |
| Simulacro de errores | `Entorno Servidor\UT2\escape_room.php` |
| Plan de estudio y chuleta | `Entorno Servidor\UT2\Examen lunes - plan y chuleta.md` |

<div class="pagebreak"></div>

# Capítulo 11 · Errata de los apuntes

Los apuntes tienen 10 fallos reales y 10 explicaciones imprecisas. Todo está
comprobado ejecutando el código con **PHP 8.2.12**; el detalle completo, con
página y justificación, está en `Teoria\11 - Errata de los apuntes.md`.

## 11.1 Errores reales

| # | Pág. | Dice | Es |
|---|---|---|---|
| 1 | 21 | `$_GLOBALS` | **`$GLOBALS`**, sin guion bajo |
| 2 | 44 | «sin mayúsculas, usa `strstr()`» | **`stristr()`** |
| 3 | 40 | `strlen()` da «caracteres» | da **bytes**; para letras, `mb_strlen()` |
| 4 | 44 | salida `... León` | `... LEón` (la `e` sí cambia) |
| 5 | 13 | variable sin inicializar → `E_NOTICE` | en PHP 8 es `Warning: Undefined variable` |
| 6 | 50 | `settype($c, "integer"); echo $a;` | debe imprimir **`$c`** |
| 7 | 43 y 58 | `;?` + `>` partido; `?>` duplicado | un solo `?>`: así no compilan |
| 8 | 49 | `floatval()` enlaza a `intval.php` | el enlace correcto es `floatval.php` |
| 9 | 47 | comillas tipográficas `“Manzana”` | comillas rectas: las curvas dan Parse error |
| 10 | 44 | `Resujtado:` en el código, `Resutado:` en la captura | errata de tecleo; no te fíes de la captura |

## 11.2 Imprecisiones (no es falso, está mal explicado)

| # | Pág. | Dice | Matiz |
|---|---|---|---|
| 1 | 56 | «mayúscula en día y mes saca el nombre» | `D` y `M` dan **abreviatura** (`Sun`, `Nov`); nombre completo: `l` y `F` |
| 2 | 45 | «la `a` está en el 1.º carácter» | es el primer carácter, pero su **índice es 0** |
| 3 | 28 | «pre-incremento suma y luego asigna» | no asigna: **devuelve** el valor nuevo |
| 4 | 16-18 | «float con 14 decimales» | **14 cifras significativas** |
| 5 | guía, 4 | «comillas mágicas» | eso era *magic quotes*; aquí es **interpolación** |
| 6 | 58 | `date('10-09-2020 20:09:33')` | no formatea nada: sin letras de formato devuelve el texto |
| 7 | 56 | timestamps «desde 1-1-1970» | sí, pero **en la zona horaria configurada** (`Europe/Madrid`) |
| 8 | 51 | `is_bool(111)` «imprime 111 es false» | es `false` porque **no es booleano**, no porque valga `false` |
| 9 | 35 | un `2` junto a `floor(1.50)` | ese `2` es de `round(1.75)`; `floor(1.50)` = 1 |
| 10 | 22 | capturas con PHP 7.4.29 | tu XAMPP es **8.2.12**: cambian los mensajes de error |

## 11.3 Lo que sí está bien

`strlen($cancion)` = 64 · `21`/`18` para «Martín Martín León» · `trim` de 6 a 4 ·
`substr_count("This is a test", "is")` = 2 · `Cambios 6` · `intval("ANBB")` = 0 ·
`round(1.75)` = 2 · `checkdate(11, 31, 1986)` = `false` · `is_float("123.11")` =
`false` · y las capturas de `==`/`===`, pre/post incremento y `var_dump`.

**Regla práctica**: si el profesor pregunta «según los apuntes…», contesta lo
que dicen los apuntes y añade el matiz. Así no pierdes el punto.
