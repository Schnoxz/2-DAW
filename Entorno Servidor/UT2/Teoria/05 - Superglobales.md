# 05 · Variables superglobales

> Apuntes §2.3.7 (págs. 21-22) · Guía de repaso §07 (págs. 5-6).

## 1. Qué son

Son **arrays asociativos que PHP crea solo**, antes de ejecutar tu script, y que
están disponibles **en cualquier ámbito**: dentro de una función también se ven,
sin necesidad de `global`.

| Superglobal | Qué guarda | Cómo se lee |
|---|---|---|
| `$_GET` | parámetros que llegan **en la URL** | `calc.php?a=12` → `$_GET['a']` |
| `$_POST` | datos que llegan **en el cuerpo** de una petición POST (formularios con `method="post"`) | `$_POST['usuario']` |
| `$_REQUEST` | **mezcla** de `$_GET`, `$_POST` y `$_COOKIE` | `$_REQUEST['dato']` |
| `$_SERVER` | datos del servidor, cabeceras y rutas | `$_SERVER['SERVER_NAME']` |
| `$_FILES` | ficheros subidos | `$_FILES['foto']` |
| `$_COOKIE` | cookies del cliente | `$_COOKIE['idioma']` |
| `$_SESSION` | variables de sesión (el servidor recuerda al usuario) | `$_SESSION['usuario']` |
| `$GLOBALS` | **todas** las variables globales del script | `$GLOBALS['contador']` |

`$_GET`, `$_POST` y `$_COOKIE` se ven en la guía; `$_FILES` y `$_SESSION` se
nombran pero se trabajan más adelante en el curso.

## 2. `$_GET`: lo que va en la URL

```
http://localhost/producto.php?precio=45&unidades=3
```

- La parte después de `?` es la **query string**: parejas `clave=valor`
  separadas por `&`.
- Llega todo como **texto** (string), aunque sean números.
- Se usa para enlaces, filtros y búsquedas: se puede guardar en favoritos y
  compartir.
- **Nunca** para contraseñas: la URL se queda en el historial y en los logs.

## 3. `$_POST`: lo que va en el cuerpo

```html
<form method="post" action="procesar.php">
  <input type="text" name="usuario">
  <button type="submit">Enviar</button>
</form>
```

```php
<?php
  $usuario = $_POST['usuario'];
?>
```

- El `name` del campo es la **clave** en `$_POST`.
- No se ve en la URL, pero **tampoco va cifrado**: para eso hace falta HTTPS.
- Si el formulario tiene un `checkbox` múltiple (`name="extras[]"`), PHP lo
  entrega como **array**: `$_POST['extras']` es `['queso', 'bacon']`.

## 4. `$_REQUEST`: la mezcla

Contiene `$_GET` + `$_POST` + `$_COOKIE` en un solo array. Es cómodo, pero
**ambiguo**: si el mismo nombre llega por dos sitios, no queda claro cuál gana
(depende de `request_order` en `php.ini`). En los ejercicios se usan `$_GET` o
`$_POST` directamente.

## 5. `$_SERVER`: el servidor

Claves que aparecen en los ejercicios y en el examen:

| Clave | Qué devuelve |
|---|---|
| `$_SERVER['SERVER_NAME']` | nombre del servidor (`localhost`) |
| `$_SERVER['SERVER_SOFTWARE']` | software (`Apache/2.4.x`) |
| `$_SERVER['REQUEST_METHOD']` | `GET` o `POST` |
| `$_SERVER['PHP_SELF']` | ruta del script actual |
| `$_SERVER['HTTP_USER_AGENT']` | navegador del cliente |
| `$_SERVER['REMOTE_ADDR']` | IP del cliente |

> **Ojo con el orden:** es `REQUEST_METHOD`, no `METHOD_REQUEST`.

## 6. `$GLOBALS`: la alternativa a `global`

```php
$contador = 0;

function sumar() {
  $GLOBALS['contador']++;   // accede a la global sin la palabra global
}
```

Es un array donde la **clave es el nombre de la variable sin `$`**. En los
apuntes aparece como `$_GLOBALS` en la pág. 21: **está mal**, la propia tabla de
la pág. 22 lo escribe bien.

## 7. Leerlas sin romper la página

El error más típico: abrir la página **sin enviar el formulario**. En ese
momento `$_POST` existe, pero **la clave no**, y PHP 8 lanza
`Warning: Undefined array key`. Tres formas de evitarlo:

```php
// 1. isset(): comprueba que existe y no es NULL
if (isset($_GET['precio'])) {
  $precio = $_GET['precio'];
}

// 2. Operador ?? (el más corto)
$precio = $_GET['precio'] ?? 0;

// 3. Comprobar el método antes de leer $_POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
}
```

Y si el dato se va a usar en una operación, **conviértelo**: lo que llega por
URL es texto.

```php
$precio = intval($_GET['precio'] ?? 0);
$total  = $precio * 3;
```

## 8. Resumen para el test

- Son arrays, no variables sueltas: se leen con `['clave']`.
- Están disponibles en **cualquier ámbito** (esa es la gracia).
- `$_GET` → URL; `$_POST` → cuerpo; `$_REQUEST` → los dos más cookies.
- `$GLOBALS` **no** lleva guion bajo.
- Leer una clave que no existe → *Warning* en PHP 8 (`Notice` en PHP 7).
