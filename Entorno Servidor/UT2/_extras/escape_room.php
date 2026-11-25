<?php
// BÚSQUEDA DE ERRORES: "ESCAPE ROOM PHP"
// Objetivos del script: Procesar un pedido, calcular el total con arrays y condicionales.

$menu = [
    "pizza" => 10,
    "hamburguesa" => 8,
    "ensalada" => 6
];

$extras_precios = [
    "queso" => 1.5,
    "bacon" => 2.0,
    "huevo" => 1.0
];

$plato_seleccionado = $_POST['plato']; 
$extras_seleccionados = isset($_POST['extras']) ? $_POST['extras'] : [];

$precio_base = 0;
$total_extras = 0;

// Procesamiento de la selección
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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bug Hunt Escape Room</title>
</head>
<body>
    <h2>Realizar Pedido</h2>
    <form method="POST" action="">
        <label>Elige tu plato:</label><br>
        <select name="plato">
            <option value="pizza">Pizza (10€)</option>
            <option value="hamburguesa">Hamburguesa (8€)</option>
            <option value="ensalada">Ensalada (6€)</option>
        </select><br><br>

        <label>Extras:</label><br>
        <input type="checkbox" name="extras[]" value="queso"> Queso (+1.5€)<br>
        <input type="checkbox" name="extras[]" value="bacon"> Bacon (+2.0€)<br>
        <input type="checkbox" name="extras[]" value="huevo"> Huevo (+1.0€)<br><br>

        <button type="submit">Calcular Total</button>
    </form>
</body>
</html>