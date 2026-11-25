<?php
// Práctica UT4_1_1 - Gestión del consentimiento de cookies.
// Todo el flujo se resuelve en este mismo archivo: por GET se revoca la
// decisión, por POST se guarda y con $_COOKIE se decide qué se muestra.

// borrar_consentimiento()
// Fuerza la caducidad de la cookie poniendo una fecha ya pasada.
// No devuelve nada: envía la cabecera de redirección y termina el script.
function borrar_consentimiento()
{
  // time() - 3600 es una hora antes de ahora: el navegador la borra al recibirla
  setcookie('cookies_aceptadas', '', time() - 3600, '/');
  header('Location: politica_cookies.php');
  exit;
}

// guardar_consentimiento($valor)
// Crea la cookie con el valor recibido ('si' o 'no') y su duración.
// No devuelve nada: envía la cabecera de redirección y termina el script.
function guardar_consentimiento($valor)
{
  // 30 días si acepta; 1 día si rechaza, como pide la ampliación opcional
  $duracion = ($valor === 'si') ? 30 * 24 * 60 * 60 : 24 * 60 * 60;

  // La ruta '/' hace que la cookie valga para todo el dominio y no solo para esta carpeta
  setcookie('cookies_aceptadas', $valor, time() + $duracion, '/');
  header('Location: politica_cookies.php');
  exit;
}

// leer_consentimiento()
// Mira si el navegador ya ha enviado la cookie de consentimiento.
// Devuelve 'si', 'no' o una cadena vacía si todavía no hay decisión.
function leer_consentimiento()
{
  if (isset($_COOKIE['cookies_aceptadas'])) {
    return $_COOKIE['cookies_aceptadas'];
  }
  return '';
}

// TODO 1: revocar el consentimiento (método GET, ?revocar=1)
if (isset($_GET['revocar'])) {
  borrar_consentimiento();
}

// TODO 2: guardar la decisión del usuario (método POST del propio formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['aceptar'])) {
    guardar_consentimiento('si');
  }
  if (isset($_POST['rechazar'])) {
    guardar_consentimiento('no');
  }
}

// TODO 3: decidir qué se pinta según la cookie
$consentimiento = leer_consentimiento();
$aceptadas = ($consentimiento === 'si');
$rechazadas = ($consentimiento === 'no');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de consentimiento de cookies</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2016%2016'%3E%3Ccircle%20cx='8'%20cy='8'%20r='7'%20fill='%230284c7'/%3E%3C/svg%3E">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            line-height: 1.6;
            padding: 40px 20px 120px 20px;
        }
        .contenedor {
            max-width: 720px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 32px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        h1 {
            color: #0f4c81;
            margin-bottom: 12px;
            font-size: 1.6rem;
        }
        p {
            margin-bottom: 16px;
        }
        .estado-consentimiento {
            margin-top: 24px;
            padding: 14px 18px;
            background-color: #ecfdf5;
            border-left: 4px solid #10b981;
            color: #065f46;
            font-size: 0.95rem;
        }
        .estado-consentimiento a {
            color: #047857;
            font-weight: 600;
            margin-left: 8px;
        }
        /* Variante para el rechazo: mismo bloque, en tono ámbar */
        .estado-rechazado {
            background-color: #fffbeb;
            border-left-color: #f59e0b;
            color: #78350f;
        }
        .estado-rechazado a {
            color: #b45309;
        }
        /* Banner fijo en la parte inferior */
        .banner-cookies {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #0f172a;
            color: #f8fafc;
            padding: 18px 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            border-top: 3px solid #38bdf8;
        }
        .banner-cookies p {
            margin: 0;
            font-size: 0.95rem;
        }
        .banner-cookies form {
            display: flex;
            gap: 10px;
        }
        .btn-aceptar {
            background-color: #0284c7;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-aceptar:hover {
            background-color: #0369a1;
        }
        .btn-rechazar {
            background-color: transparent;
            color: #cbd5e1;
            border: 1px solid #64748b;
            padding: 10px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-rechazar:hover {
            background-color: #1e293b;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <main class="contenedor">
        <h1>Bienvenido a nuestro portal web</h1>
        <p>Este es el contenido principal de la página. Si es tu primera visita, verás un aviso en la parte inferior solicitando tu consentimiento para el uso de cookies.</p>

        <?php if ($aceptadas): ?>
            <div class="estado-consentimiento">
                Has aceptado la política de cookies.
                <a href="politica_cookies.php?revocar=1">Revocar consentimiento</a>
            </div>
        <?php endif; ?>

        <?php if ($rechazadas): ?>
            <div class="estado-consentimiento estado-rechazado">
                Has rechazado las cookies opcionales. Solo se usarán las técnicas.
                <a href="politica_cookies.php?revocar=1">Cambiar mi decisión</a>
            </div>
        <?php endif; ?>
    </main>

    <?php if ($consentimiento === ''): ?>
        <aside class="banner-cookies">
            <p>Esta web utiliza cookies propias para mejorar tu experiencia de navegación.</p>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <button type="submit" name="aceptar" class="btn-aceptar">Aceptar</button>
                <button type="submit" name="rechazar" class="btn-rechazar">Rechazar</button>
            </form>
        </aside>
    <?php endif; ?>

</body>
</html>
