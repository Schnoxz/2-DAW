<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios UT3_1 - Estructuras de control</title>
  <!-- Bootstrap 5 por CDN: nos da los estilos y el funcionamiento de las pestañas -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- container: centra la página y le deja márgenes; my-5: espacio arriba y abajo -->
  <main class="container my-5">

    <!-- Cabecera común a todos los ejercicios -->
    <header class="mb-4 text-center">
      <h1 class="display-5">Desarrollo Web en Entorno Servidor</h1>
      <p class="text-muted mb-1">Curso: 2º DAW</p>
      <p class="text-muted mb-0">UT3_1 - Ejercicios de estructuras de control</p>
    </header>

    <!-- nav-tabs: la barra de pestañas. Cada <li> es una pestaña y su <button>
         lleva data-bs-target con el id del panel que debe mostrarse. -->
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
        <!-- Los ejercicios 7 y 8 son obligatorios, de ahí el asterisco -->
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio7"
          type="button">Ejercicio 7 *</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio8"
          type="button">Ejercicio 8 *</button>
      </li>
    </ul>

    <!-- tab-content: aquí van todos los paneles. Bootstrap muestra uno y oculta el resto.
         Cada panel tiene el id que hemos puesto en el data-bs-target de su pestaña. -->
    <div class="tab-content">

      <!-- Panel 1: una tarjeta (card) con el contenido del ejercicio dentro -->
      <div class="tab-pane fade show active" id="panelEjercicio1">
        <div class="card shadow-sm">
          <div class="card-body">
            <!-- include pega aquí el código PHP del archivo del ejercicio -->
            <?php include 'ejercicios/ejercicio1.php'; ?>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="panelEjercicio2">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio2.php'; ?>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="panelEjercicio3">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio3.php'; ?>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="panelEjercicio4">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio4.php'; ?>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="panelEjercicio5">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php include 'ejercicios/ejercicio5.php'; ?>
          </div>
        </div>
      </div>

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

  <!-- El JS de Bootstrap es el que hace cambiar de pestaña al pulsar -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
