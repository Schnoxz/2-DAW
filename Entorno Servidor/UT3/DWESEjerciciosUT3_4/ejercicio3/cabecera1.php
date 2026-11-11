<?php
// Cabecera 1: se carga cuando la hora actual es par.
// Recibe $titulo y $activa desde la página que la incluye.
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
  <header class="cabecera-1 text-white py-3 mb-4">
    <div class="container d-flex flex-wrap align-items-center justify-content-between gap-2">
      <a href="index.php" class="d-flex align-items-center gap-2 text-white text-decoration-none">
        <img src="img/logo.svg" alt="Logotipo de Alquila Fácil" class="logo">
        <span class="fs-4 fw-bold">Alquila Fácil</span>
      </a>
      <nav>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-white <?= (isset($activa) && $activa == 'formulario') ? 'fw-bold text-decoration-underline' : '' ?>"
              href="index.php">Nueva vivienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white <?= (isset($activa) && $activa == 'fotos') ? 'fw-bold text-decoration-underline' : '' ?>"
              href="fotos.php">Fotos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white <?= (isset($activa) && $activa == 'gestionar') ? 'fw-bold text-decoration-underline' : '' ?>"
              href="gestionarViviendas.php">Gestionar</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <main class="container mb-5">
