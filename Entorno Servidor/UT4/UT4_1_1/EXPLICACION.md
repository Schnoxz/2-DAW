# UT4_1_1 · Cómo está resuelto

## De qué va

La práctica es un aviso de cookies: el banner aparece si el usuario no ha decidido
nada y desaparece cuando acepta. La decisión se guarda en una cookie, así que la
página tiene que **escribir** la cookie al aceptar, **leerla** al cargar y
**borrarla** cuando se revoca.

Es el primer ejercicio de UT4 y junta tres cosas del tema: `setcookie()`,
`$_COOKIE` y el paso de datos por POST y GET.

## Qué pide el enunciado

Cuatro estados, en este orden:

| Estado | Qué tiene que pasar |
|---|---|
| Sin cookie | el banner se ve con el texto del aviso y el botón Aceptar |
| Aceptar (POST) | se crea `cookies_aceptadas` con valor `si`, 30 días, ruta `/`, y se redirige |
| Con cookie | el banner no aparece; sale «Has aceptado la política de cookies» y un enlace para revocar |
| Revocar (GET) | se fuerza la caducidad con `time() - 3600` y se redirige |

Como ampliación, un botón **Rechazar** que guarde `no` durante un día.

## Paso a paso

### 1. Las funciones, antes que el HTML

Todo el flujo va al principio del archivo, porque las cabeceras tienen que salir
**antes** de cualquier etiqueta. Si se imprime HTML y después se llama a
`header()`, PHP avisa de «headers already sent» y la redirección no funciona.

```php
function borrar_consentimiento()
{
  setcookie('cookies_aceptadas', '', time() - 3600, '/');
  header('Location: politica_cookies.php');
  exit;
}
```

`time() - 3600` es una hora antes de ahora. El navegador entiende que la cookie ha
caducado y la borra. El `exit` corta el script: sin él seguiría ejecutándose y
podría pintar la página antes de redirigir.

### 2. Guardar la decisión

```php
function guardar_consentimiento($valor)
{
  $duracion = ($valor === 'si') ? 30 * 24 * 60 * 60 : 24 * 60 * 60;
  setcookie('cookies_aceptadas', $valor, time() + $duracion, '/');
  header('Location: politica_cookies.php');
  exit;
}
```

Los 30 días se calculan en segundos: 30 × 24 × 60 × 60 = 2.592.000.

El cuarto parámetro es la **ruta**. Con `'/'` la cookie vale para todo el sitio;
sin él, solo para la carpeta del archivo, y al cambiar de carpeta se perdería.

### 3. Decidir qué se pinta

```php
$consentimiento = leer_consentimiento();
$aceptadas = ($consentimiento === 'si');
$rechazadas = ($consentimiento === 'no');
```

`leer_consentimiento()` devuelve el valor de `$_COOKIE` o una cadena vacía si no
existe. No hay sesión ni base de datos: la cookie es el único estado que hay.

En el HTML se usan esas tres variables:

```php
<?php if ($aceptadas): ?> ... mensaje verde ... <?php endif; ?>
<?php if ($rechazadas): ?> ... mensaje ámbar ... <?php endif; ?>
<?php if ($consentimiento === ''): ?> ... banner ... <?php endif; ?>
```

### 4. El formulario y el enlace

```php
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <button type="submit" name="aceptar" class="btn-aceptar">Aceptar</button>
  <button type="submit" name="rechazar" class="btn-rechazar">Rechazar</button>
</form>
```

El formulario se envía a sí mismo. Se distingue qué botón se ha pulsado porque
cada uno manda su `name` en `$_POST`: si llega `aceptar`, se guarda `si`.

El enlace de revocación es GET, no POST:

```php
<a href="politica_cookies.php?revocar=1">Revocar consentimiento</a>
```

### 5. Por qué redirigir después de cada cambio

Después de escribir la cookie se redirige a la misma página sin parámetros. Así,
si el usuario recarga, no vuelve a enviar el formulario (el navegador avisaría de
reenvío) y la URL queda limpia.

## El código, pieza a pieza

| Parte | Qué hace |
|---|---|
| `borrar_consentimiento()` | caduca la cookie y redirige |
| `guardar_consentimiento($valor)` | crea la cookie según el valor y redirige |
| `leer_consentimiento()` | devuelve `si`, `no` o vacío |
| Bloque `if (isset($_GET['revocar']))` | atiende la revocación |
| Bloque `if ($_SERVER['REQUEST_METHOD'] === 'POST')` | atiende aceptar y rechazar |
| HTML con `if` | pinta banner, mensaje verde o mensaje ámbar |

## Trampas y dudas

- **`setcookie()` no crea la cookie en `$_COOKIE` de esa misma petición.** La
  cookie viaja en la respuesta y vuelve en la siguiente petición; por eso se
  redirige, para que la página se cargue otra vez con la cookie ya puesta.
- **Las cabeceras van antes del HTML.** Cualquier `echo` previo rompe `header()`.
- **`time() - 3600`, no `time() + 0`.** Poner una fecha pasada es la forma
  estándar de borrar una cookie.
- **La ruta importa.** Sin `'/'`, la cookie se queda en la carpeta y el resto del
  sitio no la ve.
- **`$_COOKIE` se puede manipular.** El usuario puede editar la cookie desde el
  navegador; por eso solo se usa para preferencias, nunca para permisos.

## Si me preguntan

- **¿Cookie o sesión?** La cookie se guarda en el navegador y viaja en cada
  petición; la sesión se guarda en el servidor y el cliente solo tiene un
  identificador. Para «no volver a preguntar» vale la cookie; para un login, la
  sesión.
- **¿Por qué dos duraciones?** Porque el rechazo no debería durar tanto como la
  aceptación: en un día se vuelve a preguntar.
- **¿Qué pasa si el usuario borra las cookies?** Vuelve al estado inicial: banner
  otra vez. No se rompe nada.
