# Examen lunes: PHP (tema 2 — UT2) — Plan de estudio y chuleta

Examen **teórico-práctico del tema 2** (lenguaje PHP e inserción en HTML). El
profesor ha subido esta semana la guía oficial de repaso: `2-DAW\Entorno
Servidor\UT2\Presentación de Repaso - UT2 Lenguaje PHP.pdf` — es literalmente
el temario del examen por bloques: sintaxis, variables y memoria, tipos y
operadores, superglobales y funciones nativas. UT3 **no entra**; lo de las
entregas te sirve solo como práctica de escritura si sobra tiempo.

---

## Plan del fin de semana

### Sábado tarde (hoy) — UT2: sintaxis, variables, tipos y operadores

1. Lee la chuleta de abajo (sección 3) entera una vez, sin apuntar nada.
2. Abre el PDF de repaso y léelo de verdad (10 páginas, 45 min): cada bloque
   tiene sus ejemplos; **tapa la salida y predice qué va a imprimir** antes de
   leerla. Eso es exactamente lo que pregunta el examen.
3. Ve a Moodle y haz la **AUTOEVALUACIÓN UT2** (cuestionario del curso DWES).
   Es de tipo test: lo que falles es tu lista de repaso.
4. Cierra el día releyendo solo lo que fallaste en la autoevaluación.

### Domingo mañana — UT2: superglobales y funciones nativas + escribir código

1. Chuleta, secciones 4 y 5 (superglobales + funciones nativas). Aprende las
   trampas: `strlen()` vs `mb_strlen()`, `checkdate(mes, día, año)`,
   `empty("")` es TRUE, `isset(NULL)` es FALSE.
2. **Escribe a mano** (o en el editor sin copiar) los dos ejemplos de la
   página 8 del PDF de repaso: el de `$_GET` con `isset()` y el de
   `trim()`/`substr_count()`/`substr()`. Si los escribes tú de memoria y
   funcionan a la primera, ese bloque lo llevas.
3. Prueba los dos en `C:\xampp\php\php.exe -S 127.0.0.1:8131 -t .` mirando que
   no salga ningún Warning.

### Domingo mediodía — escribir UT2 de memoria

Repetición activa de todo lo del sábado y la mañana, pero escribiendo:

1. **Predicción de salidas**: coge cualquier trozo del PDF de repaso, tapa el
   resultado y escribe tú qué imprime. Sobre todo de: `==` vs `===`,
   `$a++` vs `++$a`, comillas simples vs dobles, copia vs `&`, `isset`/`empty`,
   y las conversiones a número (`"10" + 2`).
2. Reescribe de cero, sin mirar, los dos ejemplos de la página 8 (el de `$_GET`
   con `isset()` y el de cadenas). Hazlos pasar por
   `C:\xampp\php\php.exe -S 127.0.0.1:8131 -t .` sin ningún Warning.
3. Si sobra tiempo (y solo si sobra): repasa el formato de formularios de la
   chuleta UT3 o relee una entrega tuya — no es temario del examen, pero la
   práctica de escribir no se pierde.

### Domingo tarde — simulacro

1. **Escape room** (`2-DAW\Entorno Servidor\UT2\escape_room.php`, cronometrado,
   20 min): el script tiene varios errores escondidos y pide encontrarlos.
   Intenta solos, sin mirar nada. Cuando termines, me dices qué has visto y lo
   corregimos juntos — no te paso las soluciones hasta que lo intentes.
2. Si aún te queda cabeza: la **Práctica guiada UT3**
   (`UT3\Práctica guiada UT3.pdf`) es otro simulacro perfecto (arrays
   comparados, funciones con `&`, try/catch/finally, formulario con
   `filter_input`).

### Domingo noche

- Relee la chuleta una última vez y **vete a dormir a una hora humana**. El
  examen es de predicción de salidas y escritura de scripts: eso se lleva
  mejor descansado que a las 3 de la madrugada.

---

## 3. CHULETA — UT2: lo crítico

### Sintaxis

- Todo bloque PHP va entre `<?php ... ?>`; si el fichero es **solo PHP**, se
  recomienda **omitir el `?>` final** (evita mandar espacios/saltos por error).
- Cada sentencia acaba en `;`. Comentarios: `//`, `#` y `/* ... */`.
- El navegador **nunca** recibe código PHP: recibe solo lo que sale por `echo`.

### Variables y memoria

- `$nombre` empieza por `$` + letra o `_`; **nunca por número**.
- Tipado débil y dinámico: el tipo depende del valor y puede cambiar
  (`gettype($var)` lo dice).
- Usar una variable sin inicializar: **E_NOTICE** (aviso, no error) + valor por
  defecto del contexto (0 en sumas, "" en cadenas, FALSE en booleanos).
- **Copia vs referencia**: `$b = $a` copia (independientes); `$b = &$a` es un
  alias (mismo dato, lo que cambies en uno se ve en el otro). Truco para el
  examen: el `&` va *en el que recibe*, y ambos nombres apuntan a la misma caja.
- Ámbito: dentro de una función no se ve lo global. Para usarlo: `global $x;`
  o `$GLOBALS['x']`. **Las superglobales no necesitan `global`**.
- Constantes: `define("IVA", 0.21);` — sin `$`, con comillas, inmutables.

### Comillas y cadenas

- `"Dobles"`: **interpolan** variables → `"Hola $nombre"` imprime el valor.
- `'Simples'`: **todo literal** → `'Hola $nombre'` imprime el dólar tal cual.
- Concatenar es con **punto**: `'Hola ' . $nombre`. El `+` es siempre suma
  (`"10" + 2` es 12).
- `strlen()` cuenta **bytes** (las tildes valen 2); para caracteres reales,
  `mb_strlen()`.

### Operadores (las trampas de tipo test)

| Comparación | Resultado | Por qué |
|---|---|---|
| `3 == "3"` | TRUE | `==` convierte tipos antes de comparar |
| `3 === "3"` | FALSE | `===` exige mismo valor **y** mismo tipo |
| `0 == false` | TRUE | coerción |
| `0 === false` | FALSE | tipos distintos |

- `++$a` (pre): incrementa **y luego** devuelve el valor nuevo.
- `$a++` (post): devuelve el valor **viejo** y luego incrementa.
- `$a ?? $b`: primer valor que **existe y no es NULL** (sin lanzar E_NOTICE).
- `%` es el resto: `12 % 5` es 2. `**` es potencia: `2 ** 3` es 8.

### Conversión a FALSE (apréndete esta lista)

`0`, `0.0`, `""`, `"0"`, `[]` (array vacío), `null` y `false` → todo lo demás
es TRUE (incluidos `"0.0"`, `"false"` y `" "`).

### Comprobaciones de variables

| Función | TRUE cuando… | Trampa de examen |
|---|---|---|
| `isset($x)` | existe y **no es NULL** | `$x = null;` → isset es FALSE |
| `empty($x)` | no existe **o** vale como FALSE (0, "", "0", [], null) | `$x = "0";` → empty es TRUE |
| `is_null($x)` | es exactamente NULL | se escribe `is_null()`, no `is_nulo()` |
| `is_numeric($x)` | es número **o** string numérico | `is_numeric("123.45")` es TRUE |
| `is_int/is_float/is_string/is_bool` | tipo exacto, sin convertir | `is_float("123.45")` es FALSE |
| `var_dump($x)` | imprime tipo y longitud (depuración) | `string(4) "Hola"` |

### Superglobales (disponibles en cualquier ámbito, sin `global`)

| Variable | Qué lleva | Acceso típico |
|---|---|---|
| `$_GET` | parámetros de la URL | `calc.php?a=12` → `$_GET['a']` |
| `$_POST` | datos ocultos del formulario | `method="post"` → `$_POST['usuario']` |
| `$_REQUEST` | `$_GET` + `$_POST` + `$_COOKIE` juntos | `$_REQUEST['dato']` |
| `$_SERVER` | servidor y petición | `PHP_SELF`, `REQUEST_METHOD` |
| `$_FILES` / `$_COOKIE` / `$_SESSION` | subidas / cookies / sesión | — |

### Funciones nativas que caen seguro

- Cadenas: `trim()` (espacios a los dos lados), `strtolower()/strtoupper()`,
  `substr_count($cad, "e")` (cuenta, sensible a mayúsculas),
  `str_replace()`, `substr($cad, -15)` (índice negativo = desde el final).
- Matemáticas: `round(2.456, 2) → 2.46`, `ceil(4.2) → 5` (siempre arriba),
  `floor(4.9) → 4` (siempre abajo), `rand(10, 100)` (ambos incluidos),
  `max()/min()` sin necesitar `if`.
- Fechas: `date('Y-m-d')`, `time()` (timestamp actual),
  `checkdate($mes, $dia, $anio)` — **orden: mes, día, año**.

### Los 3 errores "clásicos" del reto de depuración (los repetirán)

1. `echo 'Bienvenido $nombre';` — comillas simples no interpolan.
2. `$_SERVER['METHOD_REQUEST']` — la clave es `REQUEST_METHOD`.
3. `is_empty($x)` — no existe; es `empty($x)`.

---

## 4. CHULETA — UT3 (NO ENTRA en el examen del lunes: solo si sobra tiempo)

### Estructuras de control

- `if / elseif / else`, `switch ($x) { case 'a': ... break; default: ... }`
  (sin `break` se "cae" al siguiente caso).
- Bucles: `for ($i = 0; $i < N; $i++)`, `while`, `do...while`, y
  `foreach ($array as $valor)` / `foreach ($array as $clave => $valor)`.
- `break` sale del bucle; `continue` salta a la siguiente vuelta.
- Trampa off-by-one: un array de 5 elementos va del índice **0 al 4**; `<=`
  count() se pasa de la rueda y da `undefined`/error.

### Arrays

- Indexado: `[10, 20, 30]` → posiciones 0,1,2. Asociativo:
  `["pizza" => 10, ...]` → acceso por clave.
- `count($a)` cuenta elementos; `array_sum($a)` suma; `sort()/rsort()`
  ordenan (¡modifican el original! copia antes si lo necesitas).
- `in_array($valor, $a)` busca **valores**; `array_key_exists($clave, $a)`
  busca **claves**. No es lo mismo y el escape room juega con eso.
- Recorrer un asociativo y querer clave **y** valor:
  `foreach ($a as $clave => $valor)` — no `as $valor` a secas.
- Añadir: `$a[] = $nuevo;`. Borrar: `unset($a[$clave]);`.

### Funciones

```php
// nombre($param1, $param2)
// Qué hace con los parámetros.
// Qué devuelve (o "no devuelve nada: escribe en la página").
function nombre($param1, $param2 = 10) {   // valor por defecto
  ...
  return $resultado;
}
```

- Parámetro por referencia: `function aplicar(&$array)` — el `&` hace que
  modifique el array **real**, no una copia.
- Excepciones: `throw new Exception("mensaje")` y en quien llama:
  `try { ... } catch (Exception $e) { $e->getMessage(); }`.

### Formularios (lo que hiciste en UT3_4, que te sirve tal cual)

- El formulario se envía a sí mismo: `action="<?php echo
  htmlspecialchars($_SERVER['PHP_SELF']); ?>"` y se detecta con
  `$_SERVER['REQUEST_METHOD'] == 'POST'`.
- Leer con protección: `isset($_POST['campo']) ? trim($_POST['campo']) : ''`.
- Validar números: `is_numeric($x)` y rangos (`$x > 0`, `$x >= 0 && $x <= 10`).
- Checkbox múltiples: `name="extras[]"` llega como **array** en `$_POST`.
- Mensaje de error por GET: `header('Location: index.php?error=1'); exit;`
- Imprimir datos del usuario SIEMPRE con `htmlspecialchars()`.

---

## 5. Glosario en inglés (el examen pregunta en inglés)

- **semicolon** → el `;`
- **single-line comment** → `//`
- **uninitialized variable** → E_NOTICE, vale 0/""/FALSE
- **type conversion** → lo hace `==`, lo evita `===`
- **pre-increment** → `++$a` suma antes de asignar
