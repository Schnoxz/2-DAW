<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios UT3_1 - Estructuras de control</title>
  <!-- CSS de Bootstrap 5 -->
  <!-- Esta linea enlaza la hoja de estilos de Bootstrap desde un CDN, igual que en los ejercicios de UT2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <header class="mb-4 text-center">
      <!-- mb-4 pone un margen debajo del encabezado y text-center centra todo su texto -->
      <h1 class="display-5">Desarrollo Web en Entorno Servidor</h1>
      <p class="text-muted mb-1">Javier Jimenez Alonso</p>
      <p class="text-muted mb-1">Curso: 2º DAW</p>
      <p class="text-muted mb-0">UT3_1 - Ejercicios de estructuras de control</p>
    </header>

    <!-- Pestañas: una por ejercicio -->
    <!-- El enunciado pide ver TODOS los ejercicios dentro de pestañas (tabs) en un mismo index.php.
         Ahora cada ejercicio tiene su codigo en un archivo aparte dentro de la subcarpeta
         "ejercicios/", y aqui solo se incluye con include. Asi el index queda limpio y cada
         ejercicio se puede leer por separado. -->
    <!-- El ul con las clases nav y nav-tabs es la barra de botones de arriba -->
    <ul class="nav nav-tabs mb-3">
      <!-- La primera pestaña lleva la clase active porque es la que se ve al abrir la pagina;
           las demas no la llevan -->
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#panelEjercicio1"
          type="button">Ejercicio 1</button>
      </li>
      <li class="nav-item">
        <!-- data-bs-toggle="tab" y data-bs-target="#panelEjercicio2" son los atributos que hacen
             que al pulsar el boton se muestre el panel con id="panelEjercicio2" -->
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
        <!-- Este lleva un texto distinto para marcar que es obligatorio -->
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio7"
          type="button">Ejercicio 7 *</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio8"
          type="button">Ejercicio 8 *</button>
      </li>
    </ul>

    <!-- El contenedor de los paneles. tab-content envuelve los div class="tab-pane",
         y cada uno lleva el id al que apunta su boton.
         Dentro de cada card-body se incluye el archivo del ejercicio correspondiente. -->
    <div class="tab-content">

      <!-- Ejercicio 1 -->
      <div class="tab-pane fade show active" id="panelEjercicio1">
        <div class="card shadow-sm">
          <div class="card-body">
            <!-- include trae el codigo del archivo como si estuviera escrito aqui -->
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

  <!-- JavaScript de Bootstrap (necesario para que funcionen las pestañas) -->
  <!-- Esta linea carga el JavaScript de Bootstrap. Es la que lee los atributos
       data-bs-toggle y data-bs-target y hace que las pestañas cambien al pulsarlas.
       Va al final del body, como en los ejercicios de UT2. -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('load', function () {
      document.querySelector('[data-bs-target="#panelEjercicio5"]').click();
      setTimeout(function () {
        var p5 = document.getElementById('panelEjercicio5');
        var p1 = document.getElementById('panelEjercicio1');
        document.title = 'P5=[' + (p5 ? p5.className : 'null') + '] P1=[' + (p1 ? p1.className : 'null') + ']';
      }, 3000);
    });
  </script>
</body>
</html>

