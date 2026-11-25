<?php
// Práctica guiada UT3 - Ejercicio 2
// Conductor: Javier Jiménez Alonso | Navegante: pendiente de confirmar compañero/a
// Ficheros: libreria.php (funciones) y este, que las usa.

// require_once carga la librería una sola vez, aunque se llame dos veces.
require_once "libreria.php";

// Cinco precios de partida, en un array indexado normal (claves 0 a 4).
$precios = [100, 250, 50, 80, 120];

// Copio el array antes de tocarlo para poder enseñar el antes y el después.
$preciosOriginales = $precios;

// Solo paso el array, así que se aplica el porcentaje por defecto (10).
aplicarDescuento($precios);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UT3 · Ejercicio 2</title>
  <style>
    body { font-family: Segoe UI, Arial, sans-serif; max-width: 720px; margin: 2rem auto; padding: 0 1rem; color: #0f172a; }
    table { border-collapse: collapse; width: 100%; margin: 1rem 0; }
    th, td { border: 1px solid #cbd5e1; padding: .45rem .7rem; text-align: left; }
    th { background: #f1f5f9; }
  </style>
</head>
<body>

<h1>Ejercicio 2: librería, referencia y callbacks</h1>

<h2>1. Descuento del 10 %</h2>
<table>
  <thead>
    <tr><th>Producto</th><th>Antes</th><th>Después</th></tr>
  </thead>
  <tbody>
    <?php
    // Recorro los dos arrays a la vez: tienen los mismos índices.
    for ($i = 0; $i < count($precios); $i++) {
      $antes = number_format($preciosOriginales[$i], 2, ",", ".");
      $despues = number_format($precios[$i], 2, ",", ".");
      echo "<tr>";
      echo "<td>Producto " . ($i + 1) . "</td>";
      echo "<td>$antes €</td>";
      echo "<td>$despues €</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
<p>El array original ha cambiado porque la función lo recibe por referencia
(<code>&amp;</code>). Por eso la copia conserva los precios de antes.</p>

<h2>2. Factura con IVA, usando callbacks</h2>
<?php
// Al pasar el nombre de la función como texto, procesarFactura decide cuál usar.
$conIvaGeneral = procesarFactura("calcularIvaGeneral", 200);
$conIvaReducido = procesarFactura("calcularIvaReducido", 200);

echo "<p>200 € con IVA general (21 %): <strong>" . number_format($conIvaGeneral, 2, ",", ".") . " €</strong></p>";
echo "<p>200 € con IVA reducido (10 %): <strong>" . number_format($conIvaReducido, 2, ",", ".") . " €</strong></p>";
?>

</body>
</html>
