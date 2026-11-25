<style>
.ex {
  --tinta: #1b1714; --teja: #b4401f; --verdemar: #0f6f5c; --linea: #e0d5c7;
  --verde: #0f6f5c;
  --ambar: #c98a3f;
  --rojo: #b4401f;
  
  --fondo-codigo: #14110f;
}
.ex h1 { border-bottom: 3px solid var(--teja); padding-bottom: 6px; }
.ex h2 {
  margin-top: 2.4em;
  padding: 6px 10px;
  border-left: 6px solid var(--teja);
  background: #faf5ef;
  border-radius: 4px;
}
.ex h3 { margin-top: 1.4em; color: var(--verdemar); }
.ex pre {
  background: #f7f2ea;
  border-left: 3px solid #b4401f;
  border-radius: 0;
  padding: 12px 14px !important;
  overflow-x: auto;
  font-size: 0.88em;
  line-height: 1.55;
}
.ex pre code {
  background: transparent !important;
  color: #1e293b;
  font-family: "Cascadia Code", "JetBrains Mono", Consolas, monospace;
  padding: 0 !important;
}
/* El fondo del código sigue al tema de Obsidian para que los colores del
   resaltado se lean siempre */
.theme-dark .ex pre { background: #14110f !important; }
.theme-dark .ex pre code { color: #f3ece4; }
.theme-light .ex pre { background: #f7f2ea !important; border-left-color: #2563eb; }
.theme-light .ex pre code { color: #1e293b; }
.ex code {
  background: rgba(100, 116, 139, 0.18);
  border-radius: 3px;
  padding: 1px 5px;
  font-family: "Cascadia Code", Consolas, monospace;
  font-size: 0.9em;
}
.ex p.que-hace {
  margin: -4px 0 18px;
  padding-left: 14px;
  border-left: 2px solid rgba(100, 116, 139, 0.45);
  color: inherit; font-style: italic;
  font-size: 0.93em;
}
.ex table { width: 100%; border-collapse: collapse; margin: 14px 0 20px; font-size: 0.93em; }
.ex th { background: #f3e7db; text-align: left; }
.ex th, .ex td { border: 1px solid rgba(100, 116, 139, 0.35); padding: 6px 9px; vertical-align: top; }
.ex tbody tr:nth-child(even) td { background: rgba(100, 116, 139, 0.05); }
.ex .clave, .ex .ojo, .ex .nota {
  border-radius: 0;
  padding: 8px 12px;
  margin: 12px 0;
  border-left: 5px solid;
  font-size: 0.95em;
}
.ex .clave { background: #eef5f1; border-color: var(--verde); }
.ex .ojo { background: #fbf0ec; border-color: var(--rojo); }
.ex .nota { background: #f7f2ea; border-color: var(--ambar); }
</style>

<div class="ex">

# Guía de examen · UT3 y UT4

PHP del bloque de control de flujo al estado de la sesión.

## UT3 · Condicionales

`if / elseif / else` evalúa de arriba abajo y se queda con la primera condición
que sea verdadera. La condición va entre paréntesis y el bloque entre llaves; si
solo hay una instrucción, las llaves se pueden omitir, pero es mejor ponerlas.

```php
$nota = 7;

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

<p class="que-hace">Los rangos se comprueban de menor a mayor. Si se pusiera primero <code>$nota &lt; 9</code>, un 4 entraría ahí y el suspenso no saldría nunca.</p>

El operador ternario es un `if` de una línea:

```php
$estado = ($nota >= 5) ? "Aprobado" : "Suspenso";
```

<p class="que-hace">Devuelve el valor de la izquierda si la condición es cierta y el de la derecha si no. Para dos o tres opciones se lee bien; anidado, no.</p>

`switch` compara **un valor** con varios casos y usa `break` para salir:

```php
switch ($dia) {
  case "sabado":
  case "domingo":
    echo "Fin de semana";
    break;
  default:
    echo "Laborable";
}
```

<p class="que-hace">Los dos <code>case</code> seguidos comparten el mismo bloque: el sábado cae en el <code>case</code> del domingo y sale con el mismo mensaje. Si falta un <code>break</code>, la ejecución continúa en el caso siguiente.</p>

## UT3 · Bucles

`for` se usa cuando sabes cuántas vueltas hay: inicialización, condición e
incremento en la misma línea.

```php
for ($i = 1; $i <= 10; $i++) {
  echo "$i ";
}
```

<p class="que-hace">Imprime del 1 al 10. La condición se evalúa antes de cada vuelta; en cuanto <code>$i</code> vale 11, el bucle termina.</p>

`while` comprueba antes de entrar y `do...while` después, así que este último se
ejecuta siempre al menos una vez.

```php
$intentos = 0;
do {
  $numero = rand(1, 10);
  $intentos++;
} while ($numero !== 5);

echo "Han hecho falta $intentos intentos.";
```

<p class="que-hace">Sirve para repetir hasta que salga un valor concreto. El contador se incrementa dentro, porque si no se quedaría siempre en 0.</p>

`foreach` es el bucle de los arrays:

```php
$frutas = ["manzana" => 3, "pera" => 5];

foreach ($frutas as $nombre => $cantidad) {
  echo "$nombre: $cantidad<br>";
}
```

<p class="que-hace">Con una variable recorre los valores; con dos, primero la clave y después el valor. No hace falta saber cuántos elementos hay.</p>

`break` corta el bucle y `continue` salta a la siguiente vuelta:

```php
for ($i = 1; $i <= 10; $i++) {
  if ($i === 6) break;       // se para en el 6
  if ($i % 2 !== 0) continue; // se salta los impares
  echo $i;
}
```

<p class="que-hace">Imprime 2, 4 y luego para. <code>continue</code> no termina el bucle: solo deja esa vuelta sin ejecutar el resto del cuerpo.</p>

## UT3 · Arrays

Tres formas de crearlos: indexado, asociativo y multidimensional.

```php
$numeros = [10, 20, 30];                       // índices 0, 1, 2
$capitales = ["España" => "Madrid", "Francia" => "París"];
$ciudades = [
  "España" => ["Madrid", "Sevilla"],
  "Francia" => ["París", "Lyon"],
];

echo $numeros[1];          // 20
echo $capitales["España"]; // Madrid
echo $ciudades["España"][1]; // Sevilla
```

<p class="que-hace">En el indexado el primer elemento es el 0. En el asociativo la clave es el texto que se puso. En el multidimensional hay que encadenar corchetes, uno por nivel.</p>

Estas son las funciones que más caen:

| Función | Qué hace |
|---|---|
| `count($a)` | número de elementos |
| `array_sum($a)` | suma de los valores numéricos |
| `sort($a)` | ordena por valor y **renumera** |
| `asort($a)` | ordena por valor y **conserva claves** |
| `ksort($a)` | ordena por clave |
| `in_array($v, $a)` | true si el valor está |
| `array_keys($a)` | devuelve las claves |
| `implode(", ", $a)` | une en una cadena |
| `explode(",", $t)` | parte una cadena en array |
| `unset($a[1])` | borra esa posición (deja hueco) |
| `array_values($a)` | renumera y quita los huecos |

```php
$precios = [30, 10, 20];
sort($precios);
echo implode(" - ", $precios);   // 10 - 20 - 30
```

<p class="que-hace"><code>sort()</code> modifica el array original y no devuelve una copia. Si hay que conservar el orden de partida, se copia antes: <code>$copia = $precios;</code>.</p>

Dos arrays se comparan con `==` (mismos pares clave-valor, sin importar el orden)
o con `===` (mismo orden y mismo tipo):

```php
$a = [1 => "uno", 2 => "dos"];
$b = [2 => "dos", 1 => "uno"];

var_dump($a == $b);   // true
var_dump($a === $b);  // false
```

<p class="que-hace">El <code>==</code> solo mira si tienen lo mismo; el <code>===</code> exige además el mismo orden. El operador <code>+</code> une dos arrays, pero si repiten clave se queda con la del primero.</p>

## UT3 · Funciones

```php
function calcularMedia(array $numeros): float {
  if (count($numeros) === 0) {
    return 0;
  }
  return array_sum($numeros) / count($numeros);
}

echo calcularMedia([5, 7, 9]);   // 7
```

<p class="que-hace">El <code>return</code> termina la función y devuelve el valor. La comprobación de array vacío evita la división entre cero, que en PHP 8 lanza una excepción.</p>

Por defecto los argumentos se pasan **por copia**: lo que se cambie dentro no
afecta fuera. Con `&` se pasan por referencia y sí cambia el original.

```php
function doblar(array $datos) {
  foreach ($datos as $i => $valor) {
    $datos[$i] = $valor * 2;
  }
}

function doblarRef(array &$datos) {
  foreach ($datos as $i => $valor) {
    $datos[$i] = $valor * 2;
  }
}

$lista = [1, 2, 3];
doblar($lista);      // $lista sigue siendo [1, 2, 3]
doblarRef($lista);   // ahora es [2, 4, 6]
```

<p class="que-hace">El <code>&amp;</code> delante del parámetro hace que la función trabaje con la variable real y no con una copia, igual que el <code>&amp;</code> del <code>foreach</code> cuando se quiere modificar el array mientras se recorre.</p>

Una función puede recibir otra función como argumento:

```php
function aplicar(array $datos, callable $funcion) {
  $resultado = [];
  foreach ($datos as $valor) {
    $resultado[] = $funcion($valor);
  }
  return $resultado;
}

$cuadrados = aplicar([1, 2, 3], fn($n) => $n * $n);
```

<p class="que-hace">Es lo mismo que hace <code>array_map()</code> por dentro: recorre el array aplicando la función que le pasan. <code>fn()</code> es una función flecha, disponible desde PHP 7.4.</p>

Los archivos se enlazan con `include` o `require`. La diferencia es qué pasa si no
lo encuentra.

```php
require_once "funciones.php";   // si falta, el script se detiene
include "footer.php";           // si falta, solo avisa
```

<p class="que-hace"><code>require</code> se usa para lo imprescindible (librerías, configuración) y <code>include</code> para partes opcionales. <code>_once</code> evita cargar dos veces el mismo archivo.</p>

## UT3 · Excepciones

```php
function dividir($a, $b) {
  if ($b === 0) {
    throw new Exception("No se puede dividir entre cero.");
  }
  return $a / $b;
}

try {
  echo dividir(10, 0);
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
} finally {
  echo "Fin de la operación.";
}
```

<p class="que-hace"><code>throw</code> lanza la excepción y corta el flujo normal. <code>catch</code> la recoge y decide qué hacer. <code>finally</code> se ejecuta siempre, haya error o no, y se usa para cerrar recursos.</p>

<div class="ojo">
<b>Error no es Exception.</b> <code>DivisionByZeroError</code>, <code>TypeError</code> y <code>ParseError</code> heredan de <code>Error</code>, no de <code>Exception</code>. Para recoger los dos hay que capturar <code>Throwable</code> o poner dos <code>catch</code>.
</div>

```php
try {
  $resultado = 10 % 0;
} catch (DivisionByZeroError $e) {
  echo "División por cero";
} catch (Throwable $e) {
  echo "Otro error: " . $e->getMessage();
}
```

<p class="que-hace">El primer <code>catch</code> atrapa el caso concreto y el segundo hace de red de seguridad. El orden importa: del más específico al más general.</p>

## UT3 · Formularios

Un formulario envía sus campos con `method` y `action`. Cada campo necesita
`name`, porque es la clave con la que llega al servidor.

```php
<form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
  <input type="text" name="nombre" required>
  <input type="email" name="correo" required>
  <button type="submit">Enviar</button>
</form>
```

<p class="que-hace">Con <code>POST</code> los datos no se ven en la URL. <code>$_SERVER["PHP_SELF"]</code> hace que el formulario se envíe a sí mismo; <code>htmlspecialchars()</code> evita que la URL se interprete como HTML.</p>

```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = trim($_POST["nombre"] ?? "");
  $correo = filter_input(INPUT_POST, "correo", FILTER_VALIDATE_EMAIL);

  if ($nombre === "" || $correo === false) {
    $error = "Revisa los datos.";
  } else {
    echo "Hola, " . htmlspecialchars($nombre);
  }
}
```

<p class="que-hace"><code>?? ""</code> evita el aviso cuando el campo no llega. <code>filter_input()</code> devuelve <code>false</code> si el correo no es válido y <code>null</code> si el campo no existe. Y todo lo que se imprime y viene del usuario pasa por <code>htmlspecialchars()</code>.</p>

Después de guardar algo se redirige, para que al recargar no se reenvíe el
formulario:

```php
header("Location: listado.php");
exit;
```

<p class="que-hace"><code>header()</code> tiene que ejecutarse antes de cualquier salida HTML. El <code>exit</code> es obligatorio: sin él el script sigue ejecutándose y la redirección no sirve de nada.</p>

## UT4 · Cookies

Una cookie es un fichero pequeño que el servidor deja en el navegador y que este
devuelve en cada petición a ese dominio. Sirve para recordar cosas entre visitas.

```php
setcookie("visitas", "1", time() + 3600 * 24, "/");
```

<p class="que-hace">Nombre, valor, caducidad y ruta. La caducidad va en segundos desde 1970, por eso se calcula con <code>time()</code> más el periodo. Con <code>"/"</code> la cookie vale para todo el sitio; sin ese cuarto argumento solo vale para la carpeta actual.</p>

```php
$visitas = isset($_COOKIE["visitas"]) ? (int) $_COOKIE["visitas"] + 1 : 1;
setcookie("visitas", (string) $visitas, time() + 3600 * 24, "/");
echo "Es tu visita número $visitas";
```

<p class="que-hace">Los valores de <code>$_COOKIE</code> llegan como texto, así que se convierten con <code>(int)</code>. La cookie recién creada no aparece en <code>$_COOKIE</code> hasta la siguiente petición.</p>

Para borrarla se pone una fecha ya pasada:

```php
setcookie("visitas", "", time() - 3600, "/");
```

<p class="que-hace">El navegador la elimina al ver que ha caducado. La ruta tiene que ser la misma con la que se creó, o se quedan dos cookies distintas.</p>

<div class="ojo">
La cookie se guarda en el ordenador del usuario y se puede editar desde el navegador. Nunca se pone ahí un permiso, un precio ni una contraseña.
</div>

## UT4 · Sesiones

Una sesión guarda los datos en el servidor y al cliente solo le da un
identificador. Es lo que se usa para el login.

```php
session_start();

$_SESSION["usuario"] = "javier";
$_SESSION["carrito"] = ["teclado", "ratón"];

echo $_SESSION["usuario"];
```

<p class="que-hace"><code>session_start()</code> crea la sesión si no existe o se une a la que ya hay, y tiene que ser lo primero del script. A partir de ahí <code>$_SESSION</code> funciona como un array que dura mientras dure la visita.</p>

Por dentro, PHP genera un id, deja una cookie con ese id (`PHPSESSID`) y guarda los
datos en un fichero de disco:

```php
echo session_id();          // o0j332o65letreqsfe24bcd41v
echo session_save_path();   // C:\xampp\tmp
```

<p class="que-hace">El fichero se llama <code>sess_&lt;id&gt;</code> y dentro guarda líneas del tipo <code>usuario|s:6:"javier";</code>: nombre, tipo, tamaño y valor. Por eso la sesión caduca al cerrar el navegador: se borra la cookie que llevaba el id.</p>

Proteger una página y cerrar sesión:

```php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("Location: login.php");
  exit;
}

// logout
$_SESSION = [];
setcookie(session_name(), "", time() - 42000, "/");
session_destroy();
```

<p class="que-hace">Para salir no basta con <code>session_destroy()</code>: hay que vaciar <code>$_SESSION</code>, borrar la cookie del id y destruir la sesión. Si solo se destruye, la cookie sigue en el navegador y el fichero puede reutilizarse.</p>

## UT4 · Cookies y sesiones

| | Cookie | Sesión |
|---|---|---|
| Dónde está el dato | navegador | servidor |
| Se puede modificar | sí, desde el navegador | no, solo se puede robar el id |
| Duración | la que se configure | hasta cerrar el navegador |
| Uso típico | idioma, aviso de cookies, «recordarme» | login, carrito, datos del usuario |

Un **token** (JWT) es la alternativa moderna: el servidor entrega una cadena
firmada y el cliente la envía en cada petición. Se usa en APIs, donde no hay
cookies de por medio.

```php
$token = base64_encode(hash_hmac("sha256", $datos, $clave, true));
```

<p class="que-hace">La firma permite comprobar que el token no se ha modificado. Si alguien cambia un dato, la firma deja de coincidir y el servidor lo rechaza.</p>

## Chuleta

| Necesito | Se hace con |
|---|---|
| Comprobar si un campo llegó | `isset($_POST["x"])` o `$_POST["x"] ?? ""` |
| Validar un correo | `filter_input(INPUT_POST, "correo", FILTER_VALIDATE_EMAIL)` |
| Imprimir algo del usuario | `htmlspecialchars($texto)` |
| Evitar reenvío al recargar | `header("Location: ...")` + `exit` |
| Ordenar conservando claves | `asort()` / `ksort()` |
| Borrar un elemento y reindexar | `unset($a[$i]); $a = array_values($a);` |
| Recorrer con clave y valor | `foreach ($a as $k => $v)` |
| Guardar algo entre páginas | `$_SESSION` (servidor) o `setcookie()` (cliente) |
| Cerrar sesión de verdad | `$_SESSION = []; setcookie(...); session_destroy();` |

</div>
