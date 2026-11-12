<?php
// Página de entrega: reúne los tres ejercicios en pestañas.
// Cada ejercicio es una aplicación completa, con su propio formulario y su
// página de respuesta, así que dentro de la pestaña se muestra con un iframe.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios UT3_4 - Formularios</title>
  <!-- Bootstrap 5 por CDN: estilos y funcionamiento de las pestañas -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">

    <header class="mb-4 text-center">
      <h1 class="display-5">Desarrollo Web en Entorno Servidor</h1>
      <p class="text-muted mb-1">Curso: 2º DAW</p>
      <p class="text-muted mb-0">UT3_4 - Ejercicios de formularios</p>
    </header>

    <!-- Cada pestaña apunta con data-bs-target al panel que quiere mostrar.
         Los roles y el aria-controls los pide la propia documentación de
         Bootstrap: así el lector de pantalla sabe qué panel abre cada botón. -->
    <ul class="nav nav-tabs mb-3" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="tabEjercicio1" data-bs-toggle="tab"
          data-bs-target="#panelEjercicio1" type="button" role="tab"
          aria-controls="panelEjercicio1" aria-selected="true">Ejercicio 1 (opcional)</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="tabEjercicio2" data-bs-toggle="tab"
          data-bs-target="#panelEjercicio2" type="button" role="tab"
          aria-controls="panelEjercicio2" aria-selected="false">Ejercicio 2 *</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="tabEjercicio3" data-bs-toggle="tab"
          data-bs-target="#panelEjercicio3" type="button" role="tab"
          aria-controls="panelEjercicio3" aria-selected="false">Ejercicio 3 (reto)</button>
      </li>
    </ul>

    <div class="tab-content">

      <div class="tab-pane fade show active" id="panelEjercicio1" role="tabpanel"
        aria-labelledby="tabEjercicio1" tabindex="0">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h4 text-primary">Ejercicio 1 (opcional): cálculo del salario</h2>
            <p>
              El formulario recoge nombre, apellidos, salario y edad, y envía los datos
              por POST a <code>salario.php</code>, que aplica la subida correspondiente.
            </p>
            <p>
              Si falta algún dato, <code>salario.php</code> vuelve a <code>index.php</code>
              con el error por GET y allí se muestra <strong>FALTAN DATOS</strong>.
            </p>
            <a class="btn btn-primary" href="ejercicio1/index.php" target="_blank" rel="noopener">
              Abrir en otra pestaña
            </a>
            <iframe src="ejercicio1/index.php" title="Ejercicio 1: cálculo del salario"
              class="w-100 border rounded mt-3" height="620"></iframe>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="panelEjercicio2" role="tabpanel"
        aria-labelledby="tabEjercicio2" tabindex="0">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h4 text-primary">Ejercicio 2 (obligatorio): viviendas</h2>
            <p>
              Formulario de alta de una vivienda. El precio y el tipo de vivienda son
              obligatorios; el resto de campos se pueden dejar vacíos.
            </p>
            <p>
              Los datos se envían por POST a <code>insertarVivienda.php</code>, que
              valida y muestra un resumen de lo que se guardaría.
            </p>
            <a class="btn btn-primary" href="ejercicio2/index.php" target="_blank" rel="noopener">
              Abrir en otra pestaña
            </a>
            <iframe src="ejercicio2/index.php" title="Ejercicio 2: alta de viviendas"
              class="w-100 border rounded mt-3" height="720"></iframe>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="panelEjercicio3" role="tabpanel"
        aria-labelledby="tabEjercicio3" tabindex="0">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h4 text-primary">Ejercicio 3 (reto): alquiler de viviendas</h2>
            <p>
              Aplicación con cuatro páginas: alta de vivienda, galería para elegir foto
              y gestión del listado (ordenar por zona, filtrar, modificar y borrar).
            </p>
            <p>
              Las viviendas se guardan en la sesión de PHP, porque el enunciado todavía
              no permite usar una base de datos. La cabecera y el pie cambian según la
              hora sea par o impar.
            </p>
            <a class="btn btn-primary" href="ejercicio3/index.php" target="_blank" rel="noopener">
              Abrir en otra pestaña
            </a>
            <iframe src="ejercicio3/index.php" title="Ejercicio 3: alquiler de viviendas"
              class="w-100 border rounded mt-3" height="820"></iframe>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- El JS de Bootstrap es el que cambia de pestaña; los ejercicios no usan JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
