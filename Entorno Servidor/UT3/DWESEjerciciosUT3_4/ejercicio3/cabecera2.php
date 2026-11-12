<?php
// Cabecera 2: se carga cuando la hora actual es impar.
// Es la misma navegación que la cabecera 1, pero con otro color y otro diseño.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($titulo) ?> - Alquila Fácil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">
  <header class="cabecera-2 text-white mb-4">
    <div class="franja py-1">
      <div class="container text-center small">
        Alquila Fácil · <?= date('d/m/Y') ?>
      </div>
    </div>
    <div class="container py-3 text-center">
      <img src="img/logo.svg" alt="Logotipo de Alquila Fácil" class="logo mb-2">
      <p class="fs-4 fw-bold mb-2">Alquila Fácil</p>
      <nav>
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link text-white px-3 <?= (isset($activa) && $activa == 'formulario') ? 'fw-bold text-decoration-underline' : '' ?>"
              href="index.php">Nueva vivienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white px-3 <?= (isset($activa) && $activa == 'fotos') ? 'fw-bold text-decoration-underline' : '' ?>"
              href="fotos.php">Fotos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white px-3 <?= (isset($activa) && $activa == 'gestionar') ? 'fw-bold text-decoration-underline' : '' ?>"
              href="gestionarViviendas.php">Gestionar</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <main class="container mb-5">
