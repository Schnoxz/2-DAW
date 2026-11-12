<?php
// Cabecera común. Recibe $tema desde index.php, que ya lo ha validado.

// ucfirst() pone la primera letra en mayúscula: "claro" -> "temaClaro.css"
$hojaTema = 'css/tema' . ucfirst($tema) . '.css';

// Marco con la clase "activo" el enlace del tema que se está viendo
$claseClaro = '';
$claseOscuro = '';
if ($tema == 'claro') {
  $claseClaro = ' class="activo"';
} else {
  $claseOscuro = ' class="activo"';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 8 - Tema <?= $tema ?></title>
  <!-- Primero la hoja común y después la del tema, para que el tema manda -->
  <link rel="stylesheet" href="css/estilosComunes.css">
  <link rel="stylesheet" href="<?= $hojaTema ?>">
</head>
<body>
  <header class="cabecera">
    <!-- Único h1 de la página: el del pie se ha dejado en un párrafo -->
    <h1 class="cabecera__titulo">Mi web con temas</h1>

    <!-- Los dos enlaces recargan esta misma página cambiando solo el parámetro -->
    <nav class="cabecera__nav">
      <a href="index.php?tema=claro"<?= $claseClaro ?>>Tema claro</a>
      <a href="index.php?tema=oscuro"<?= $claseOscuro ?>>Tema oscuro</a>
    </nav>
  </header>

  <main>
