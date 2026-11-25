<?php
// Práctica guiada UT3 - Ejercicio 1
// Conductor: Javier Jiménez Alonso | Navegante: pendiente de confirmar compañero/a
// El enunciado pide trabajo por parejas: cuando se sepa el nombre del
// compañero hay que completar la cabecera y renombrar la carpeta.

// Dos almacenes con claves que son códigos de producto.
// P01 y P02 están en los dos, pero P01 con distinta cantidad.
// P03 y P04 solo están en el primero; P05 solo en el segundo.
$almacen1 = ["P01" => 10, "P02" => 4, "P03" => 0, "P04" => 20];
$almacen2 = ["P01" => 6, "P02" => 4, "P05" => 12];

// == compara claves y valores sin importar el orden.
// === compara además el orden y el tipo de los valores.
// Los dos dan false porque hay claves distintas y P01 tiene otra cantidad.
$sonIguales = ($almacen1 == $almacen2);
$sonIdenticos = ($almacen1 === $almacen2);

// El operador + une los arrays, pero si una clave está repetida se queda
// con la del primero. Por eso P01 vale 10 y P02 vale 4 en el total.
$stockTotal = $almacen1 + $almacen2;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UT3 · Ejercicio 1</title>
  <style>
    body { font-family: Segoe UI, Arial, sans-serif; max-width: 720px; margin: 2rem auto; padding: 0 1rem; color: #0f172a; }
    table { border-collapse: collapse; width: 100%; margin: 1rem 0; }
    th, td { border: 1px solid #cbd5e1; padding: .45rem .7rem; text-align: left; }
    th { background: #f1f5f9; }
    .critico { color: #b91c1c; font-weight: bold; }
    .normal { color: #166534; }
    .exceso { color: #92400e; }
    pre { background: #f8fafc; border: 1px solid #cbd5e1; padding: 1rem; overflow-x: auto; }
  </style>
</head>
<body>

<h1>Ejercicio 1: condicionales, bucles y operadores de arrays</h1>

<h2>1. Almacenes de partida</h2>
<?php
// Muestro los dos arrays para que se vea qué se está comparando.
echo "<p><strong>Almacén 1:</strong></p>";
echo "<pre>";
print_r($almacen1);
echo "</pre>";

echo "<p><strong>Almacén 2:</strong></p>";
echo "<pre>";
print_r($almacen2);
echo "</pre>";
?>

<h2>2. ¿Son iguales o idénticos?</h2>
<p>
  Con <code>==</code> el resultado es
  <strong><?= $sonIguales ? "true" : "false" ?></strong>.
  Con <code>===</code> el resultado es
  <strong><?= $sonIdenticos ? "true" : "false" ?></strong>.
</p>
<p>No son iguales porque no tienen las mismas claves y, además, P01 tiene
distinta cantidad en cada uno. Si fueran iguales, <code>===</code> también
podría dar false si el orden de las claves fuese distinto.</p>

<h2>3. Stock total (operador +)</h2>
<?php
// print_r sirve para ver la estructura completa del array, claves incluidas.
echo "<pre>";
print_r($stockTotal);
echo "</pre>";
?>
<p>Los códigos que están en los dos almacenes conservan la cantidad del primero,
porque el operador <code>+</code> no suma los valores de claves repetidas.</p>

<h2>4. Estado del stock</h2>
<table>
  <thead>
    <tr><th>Código</th><th>Unidades</th><th>Estado</th></tr>
  </thead>
  <tbody>
    <?php
    // Recorro el total sacando clave y valor de cada producto.
    foreach ($stockTotal as $codigo => $unidades) {
      // Si no queda stock, este producto no se muestra: paso a la siguiente vuelta.
      if ($unidades == 0) {
        continue;
      }

      // Tres tramos: menos de 5, de 5 a 15 y más de 15.
      if ($unidades < 5) {
        $estado = "Stock crítico (reponer urgente)";
        $clase = "critico";
      } elseif ($unidades <= 15) {
        $estado = "Stock normal";
        $clase = "normal";
      } else {
        $estado = "Exceso de stock";
        $clase = "exceso";
      }

      echo "<tr>";
      echo "<td>$codigo</td>";
      echo "<td>$unidades</td>";
      echo "<td class='$clase'>$estado</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>
