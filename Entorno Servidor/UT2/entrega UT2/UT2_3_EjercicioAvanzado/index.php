<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio avanzado - Entorno Servidor</title>
  <!-- CSS de Bootstrap 5 -->
  <!-- Esta línea enlaza la hoja de estilos de Bootstrap desde un CDN, me lo daban ya desde el ejemplo -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <header class="mb-4 text-center">
      <!-- mb-4 pone un margen debajo del encabezado y text-center centra todo su texto -->
      <h1 class="display-5">Desarrollo Web en Entorno Servidor</h1>
      <!-- display-5 es una de las clases de título grande de Bootstrap -->
      <p class="text-muted mb-1">Javier Jimenez Alonso</p>
      <p class="text-muted mb-1">Curso: 2º DAW</p>
      <p class="text-muted mb-0">Módulo: DWES - Desarrollo web en entorno servidor</p>
    </header>

    <!-- El enunciado pide una página principal con enlaces a las otras tres páginas,
         así que aquí no hay pestañas como en DWESejerciciosIniciales, sino botones -->
    <div class="card shadow-sm">
      <div class="card-body">
        <h2 class="h4 text-primary">Ejercicio avanzado UT2_3</h2>
        <p class="text-secondary">Pulsa un botón para abrir cada apartado:</p>

        <!-- Operaciones Matemáticas: num1, num2 y num3 van por GET -->
        <!-- El &amp; en vez de & es para que el HTML sea válido, si no el validador del W3C da error -->
        <div class="d-grid gap-2 mb-3">
          <a class="btn btn-primary btn-lg"
             href="matematicas.php?num1=8&amp;num2=15&amp;num3=3">Operaciones Matemáticas</a>
        </div>

        <!-- Operaciones con Cadenas: la primera cadena es la frase y la segunda lo que sigue -->
        <!-- Los espacios y las tildes se pueden escribir tal cual, el navegador ya los pone bien -->
        <div class="d-grid gap-2 mb-3">
          <a class="btn btn-success btn-lg"
             href="cadena.php?cadena1=Paco tiene una carniceria&amp;cadena2=en la esquina de la calle">Operaciones con Cadenas</a>
        </div>

        <!-- Información del servidor: esta página no necesita ningún parámetro -->
        <div class="d-grid gap-2">
          <a class="btn btn-outline-primary btn-lg" href="infoServidor.php">Información del servidor</a>
        </div>
      </div>
    </div>

  </main>

  <!-- JavaScript de Bootstrap -->
  <!-- Aquí no hace falta porque no hay pestañas ni desplegables, pero lo dejo por si
       más adelante quiero añadir algo que sí lo necesite -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
