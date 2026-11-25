<?php
// TODO 1: Comprobar si llega ?revocar=1 por GET -> eliminar cookie (time() - 3600) y redirigir


// TODO 2: Comprobar si se envía el formulario por POST -> crear cookie 'cookies_aceptadas' (30 días) y redirigir


// TODO 3: Comprobar si existe $_COOKIE['cookies_aceptadas'] en una variable booleana (ej. $aceptadas)
$aceptadas = false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de consentimiento de cookies</title>
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
    </main>

    <?php if (!$aceptadas): ?>
        <aside class="banner-cookies">
            <p>Esta web utiliza cookies propias para mejorar tu experiencia de navegación.</p>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button type="submit" name="aceptar" class="btn-aceptar">Aceptar</button>
            </form>
        </aside>
    <?php endif; ?>

</body>
</html>