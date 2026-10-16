<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios UT3_1 - Estructuras de control</title>
  <!-- Bootstrap 5 desde el CDN, como en los ejercicios de UT2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <header class="mb-4 text-center">
      <h1 class="display-5">Desarrollo Web en Entorno Servidor</h1>
      <p class="text-muted mb-1">Javier Jimenez Alonso</p>
      <p class="text-muted mb-1">Curso: 2º DAW</p>
      <p class="text-muted mb-0">UT3_1 - Ejercicios de estructuras de control</p>
    </header>

    <!-- El enunciado pide los ejercicios en pestañas, todos dentro de este index.php.
         Cada uno esta en su archivo de "ejercicios/" y aqui solo se incluye. -->
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#panelEjercicio1"
          type="button">Ejercicio 1</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio2"
          type="button">Ejercicio 2</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio3"
          type="button">Ejercicio 3</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio4"
          type="button">Ejercicio 4</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio5"
          type="button">Ejercicio 5</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio6"
          type="button">Ejercicio 6</button>
      </li>
      <li class="nav-item">
        <!-- el 7 y el 8 son obligatorios, de ahi el asterisco -->
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio7"
          type="button">Ejercicio 7 *</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio8"
          type="button">Ejercicio 8 *</button>
      </li>
    </ul>

    <!-- Un panel por ejercicio: cada uno lleva el id al que apunta su boton y dentro
         se incluye el archivo correspondiente. -->
    <div class="tab-content">

      <!-- Ejercicio 1 -->
      <div class="tab-pane fade show active" id="panelEjercicio1">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio1.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 2 -->
      <div class="tab-pane fade" id="panelEjercicio2">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio2.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 3 -->
      <div class="tab-pane fade" id="panelEjercicio3">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio3.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 4 -->
      <div class="tab-pane fade" id="panelEjercicio4">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio4.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 5 -->
      <div class="tab-pane fade" id="panelEjercicio5">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio5.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 6 -->
      <div class="tab-pane fade" id="panelEjercicio6">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio6.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 7 (obligatorio) -->
      <div class="tab-pane fade" id="panelEjercicio7">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio7.php'; ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 8 (obligatorio) -->
      <div class="tab-pane fade" id="panelEjercicio8">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio8.php'; ?>
          </div>
        </div>
      </div>

    </div>

  </main>

  <!-- Bootstrap JS: es lo que hace que las pestañas cambien al pulsarlas -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
