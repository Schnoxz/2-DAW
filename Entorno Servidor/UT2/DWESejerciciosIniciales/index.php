<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios de PHP - Entorno Servidor</title>
  <!-- CSS de Bootstrap 5 -->
  <!-- Esta línea enlaza la hoja de estilos de Bootstrap desde un CDN, me lo daban ya desde el ejemplo -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container my-5">
    <header class="mb-4 text-center">
      <!-- mb-4 pone un margen debajo del encabezado y text-center centra todo su text -->
      <h1 class="display-5">Desarrollo Web en Entorno Servidor</h1>
      <!-- display-5 es una de las clases de título grande de Bootstrap -->
      <p class="text-muted mb-1">Javier Jimenez Alonso</p>
      <p class="text-muted mb-1">Curso: 2º DAW</p>
      <p class="text-muted mb-0">Módulo: DWES - Desarrollo web en entorno servidor</p>
    </header>

    <!-- Pestañas una por ejercicio -->
    <!-- El enunciado pide ver los tres ejercicios en pestañas dentro de un mismo index.php
         Copié este HTML del ejemplo de "Navs and tabs" de la documentación de Bootstrap -->
    <!-- Esta línea abre la lista de pestañas. El ul es como la caja que agrupa los botones,
         y las clases nav y nav-tabs son las que le dan el aspecto de barra de pestañas -->
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <!-- La primera pestaña lleva la clase active porque es la que se ve al abrir la página; las otras se la quitan -->
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#panelEjercicio1"
          type="button">Ejercicio 1</button>
      </li>
      <li class="nav-item">
        <!-- data-bs-toggle="tab" y data-bs-target="#panelEjercicio2" son los atributos que hacen
             que al pulsar el botón se muestre el panel con id="panelEjercicio2" -->
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio2"
          type="button">Ejercicio 2</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio3"
          type="button">Ejercicio 3</button>
      </li>
    </ul>

    <!-- El contenedor de los paneles. Dentro van los tres div class="tab-pane": el que
         tenga el id al que apunta cada botón. -->
    <div class="tab-content">

      <!-- Ejercicio 1 -->
      <div class="tab-pane fade show active" id="panelEjercicio1">
        <!-- card shadow-sm es la caja blanca con una sombra pequeña que usa el enunciado -->
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // rand(min, max) devuelve un número aleatorio entre los dos valores
              // Lo uso, en lugar de inventarme la fórmula, porque es la función que aparece  en la teoría (apartado 4.1 de funciones numéricas) con el ejemplo rand(1, 9).
              $numero = rand(1, 1000);
              // El enunciado pide que el número se vea a un tamaño elegido al azar entre
              // el 200 % y el 800 %, así que genero también ese tamaño con otro rand()
              $tamano = rand(200, 800);
              // echo es la palabra reservada que muestra un texto o el valor de una variable
              // Uso comillas dobles porque, al estar en PHP, las variables como $numero se sustituyen solas por su valor. Dentro de esas comillas dobles, los atributos
              // HTML van con comillas simples para no romper la cadena
              echo "<h2 class='h4 text-primary'>Ejercicio 1: número aleatorio</h2>";
              // Aquí el tamaño va dentro de style='font-size: ...%'. Pongo la variable
              // $tamano seguida de % para que la letra cambie de tamaño en cada ejecución
              echo "<p style='font-size: $tamano%;'>$numero</p>";
              echo "<hr>";
              // text-secondary small pone el texto en gris y pequeño, para que se vea como un dato secundario y no como el resultado principal
              echo "<p class='text-secondary small'>Tamaño de la letra: $tamano%</p>";
            ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 2 -->
      <div class="tab-pane fade" id="panelEjercicio2">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // El enunciado pide un emoticono al azar entre los caracteres Unicode 128512 y 128586, así que uso rand() con esos dos números
              $emoticono = rand(128512, 128586);
              echo "<h2 class='h4 text-primary'>Ejercicio 2: emoticono Unicode</h2>";
              // Para mostrar un carácter Unicode del que no puedo escribir el símbolo directamente en el teclado uso su código numérico con el formato &#128512;.
              // Como el código lo genera rand(), escribo &# y el signo de punto y coma alrededor de la variable: &#$emoticono;
              echo "<p style='font-size: 100px;'>&#$emoticono;</p>";
              echo "<hr>";
              // Muestro también el código del emoticono, para que se vea qué carácter Unicode se ha elegido en esta ejecución
              echo "<p class='text-secondary small'>Código Unicode: $emoticono</p>";
            ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 3 -->
      <div class="tab-pane fade" id="panelEjercicio3">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // Guardo la frase en una variable para poder analizarla las veces que quiera
              $frase = "This is a test";
              // substr_count($texto, $subcadena) cuenta cuántas veces aparece la subcadena dentro del texto. Es la función que pide el enunciado y la que explica la teoría en el anexo de funciones de cadenas.
              $minusculas = substr_count($frase, "t");
              // Para el apartado 2 hay que contar también las "T" mayúsculas, y como substr_count() distingue mayúsculas de minúsculas, sumo las dos cuentas.
              $todas = $minusculas + substr_count($frase, "T");

              echo "<h2 class='h4 text-primary'>Ejercicio 3: contar la letra 't'</h2>";
              echo "<p>Frase analizada: <em>$frase</em></p>";

              // <strong> y <em> son etiquetas de HTML: la primera pone el resultado en negrita y la segunda en cursiva, para destacar el dato
              echo "<p>1) Número de 't' minúsculas: <strong>$minusculas</strong></p>";
              echo "<p>2) Número de todas las 't': <strong>$todas</strong></p>";
              echo "<hr>";

              // Muestro por escrito la respuesta al apartado 2, que es lo que pide el enunciado cuando pregunta qué habría que añadir.
              echo "<p class='text-secondary small'>Para contar todas hay que sumar también las mayúsculas.</p>";
            ?>
          </div>
        </div>
      </div>

    </div>

  </main>

  <!-- JavaScript de Bootstrap (necesario para la interactividad) -->
  <!-- Esta línea carga el JavaScript de Bootstrap. La puse porque es el que lee los atributos
       data-bs-toggle y data-bs-target de los botones y hace que las pestañas cambien al
       pulsarlas. Va al final del body, como en básico.php, para que el HTML se cargue antes. -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
