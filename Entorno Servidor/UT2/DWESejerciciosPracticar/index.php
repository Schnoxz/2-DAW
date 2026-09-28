<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios para practicar - Entorno Servidor</title>
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

    <!-- Pestañas una por ejercicio -->
    <!-- El enunciado pide ver los cinco ejercicios en pestañas dentro de un mismo index.php
         Copié este HTML del ejemplo de "Navs and tabs" de la documentación de Bootstrap -->
    <!-- Esta línea abre la lista de pestañas. El ul es como la caja que agrupa los botones,
         y las clases nav y nav-tabs son las que le dan el aspecto de barra de pestañas -->
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <!-- La primera pestaña lleva la clase active porque es la que se ve al abrir la
             página; las otras se la quitan -->
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
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio4"
          type="button">Ejercicio 4</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#panelEjercicio5"
          type="button">Ejercicio 5</button>
      </li>
    </ul>

    <!-- El contenedor de los paneles. tab-content es la caja que guarda los cinco
         div class="tab-pane", y cada uno lleva el id al que apunta su botón -->
    <div class="tab-content">

      <!-- Ejercicio 1 -->
      <div class="tab-pane fade show active" id="panelEjercicio1">
        <!-- card shadow-sm es la caja blanca con una sombra pequeña que usa el enunciado -->
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // El enunciado pide la fecha y la hora del día actual
              // date() es la función que devuelve la fecha y la hora en el formato que le pida
              // Cada parte de la fecha va con sus propias letras, como una plantilla:
              //   l = nombre del día en texto   (Monday)
              //   F = nombre del mes en texto  (September)
              //   j = día del mes sin ceros    (15)
              //   S = sufijo del día en texto  (th en 15th)
              //   Y = año con 4 cifras         (2023)
              echo "<h2 class='h4 text-primary'>Ejercicio 1: fecha y hora</h2>";
              echo "<p>La fecha de hoy es: <strong>" . date("l, F jS Y") . "</strong></p>";
              // Para la hora los formatos son otros:
              //   H = hora con 2 cifras (00-23)  i = minutos  s = segundos
              echo "<p>Y la hora es: <strong>" . date("H:i:s") . "</strong></p>";
              echo "<hr>";
              // text-secondary small pone el texto en gris y pequeño, para que se vea como un
              // dato secundario y no como el resultado principal
              echo "<p class='text-secondary small'>La hora cambia cada vez que recargo la página, porque date() la lee en el momento en que se ejecuta.</p>";
            ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 2 -->
      <div class="tab-pane fade" id="panelEjercicio2">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // El enunciado pide crear dos variables con estos nombres y estos valores
              $primerNumero = 8;
              $segundoNumero = 5;

              // El signo % es el operador del resto de una división
              $resto = $primerNumero % 5;
              // El signo / es el de la división
              $division = $primerNumero / $segundoNumero;
              // El signo + es el de la suma
              $suma = $primerNumero + $segundoNumero;

              echo "<h2 class='h4 text-primary'>Ejercicio 2: operaciones con dos números</h2>";
              echo "<p>Primer número: <strong>$primerNumero</strong></p>";
              echo "<p>Segundo número: <strong>$segundoNumero</strong></p>";

              // En PHP el separador de decimales es el punto, pero en español se usa la coma.
              // round() redondea al número de decimales que le indique, en este caso uno, para
              // que 8 / 5 salga como 1.6 y no como 1.6 con Many decimales
              $divisionRedondeada = round($division, 1);
              // Y con str_replace() cambio ese punto por una coma, para que se vea como 1,6
              $divisionBonita = str_replace(".", ",", $divisionRedondeada);

              // <strong> y <em> son etiquetas de HTML: la primera pone el resultado en negrita
              // y la segunda en cursiva, para destacar el dato
              echo "<p>a) El resto de dividir el primer número entre 5 --> <strong>$resto</strong></p>";
              echo "<p>b) El resultado de dividir el primer número entre el segundo --> <strong>$divisionBonita</strong></p>";
              echo "<p>c) El resultado de sumar los dos números --> <strong>$suma</strong></p>";
            ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 3 -->
      <div class="tab-pane fade" id="panelEjercicio3">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // Guardo la frase en una variable, con un espacio al final como en el enunciado
              $frase = "Ya decidí que esta noche se sale con todas mis motomami ";

              // str_replace() cambia un trozo de texto por otro. Si le digo que cambie un espacio
              // por nada (una cadena vacía "") lo que hace es quitar todos los espacios
              $fraseSinEspacios = str_replace(" ", "", $frase);

              // mb_strlen() cuenta los caracteres. Se usa mb_ en vez de strlen() porque la frase
              // lleva la í de "decidí", y strlen() contaría los bytes de esa letra y daría un
              // número más grande
              $longitudOriginal = mb_strlen($frase);
              $longitudFinal = mb_strlen($fraseSinEspacios);
              // Con strlen() la original daría 57 en vez de 56, por ese byte de más de la í
              $longitudConStrlen = strlen($frase);

              echo "<h2 class='h4 text-primary'>Ejercicio 3: quitar espacios de una frase</h2>";
              echo "<p>La frase original es: <em>$frase</em></p>";
              echo "<p>La frase resultante es: <em>$fraseSinEspacios</em></p>";
              echo "<p>La longitud de la cadena original es: <strong>$longitudOriginal</strong></p>";
              echo "<p>La longitud de la cadena final es: <strong>$longitudFinal</strong></p>";
              echo "<hr>";
              // Con esta línea se ve por qué uso mb_strlen() y no strlen(): los dos cuentan
              // igual, pero strlen() da un número más alto porque la í ocupa dos bytes
              echo "<p class='text-secondary small'>Con strlen() la frase original daría <strong>$longitudConStrlen</strong> en lugar de <strong>$longitudOriginal</strong>, por el byte extra de la í de decidí.</p>";
            ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 4 -->
      <div class="tab-pane fade" id="panelEjercicio4">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // define() crea una constante. La primera vez se le pone el nombre y el valor,
              // y a partir de ahí el nombre ya vale por sí solo, sin el signo del dollar
              define("PI", 3.141592);

              // La constante PI se puede usar en operaciones como si fuera un número normal
              $radio = 2;
              $area = PI * $radio * $radio;
              $perimetro = 2 * PI * $radio;

              // PHP_INT_MAX es una constante ya creada por PHP que guarda el número entero
              // más grande que puede tener según el tamaño de la máquina
              $maximoEntero = PHP_INT_MAX;

              echo "<h2 class='h4 text-primary'>Ejercicio 4: constantes</h2>";
              // round() redondea a las cifras decimales que le indique, y después cambio el
              // punto por una coma igual que en el ejercicio 2
              $areaBonita = str_replace(".", ",", round($area, 6));
              $perimetroBonito = str_replace(".", ",", round($perimetro, 6));
              echo "<p>Mi constante es <strong>PI</strong> y su valor aproximado es <strong>" . PI . "</strong></p>";
              // El <sup> de cm<sup>2</sup> es la forma de escribir el 2 en pequeño y arriba,
              // que es como se escribe el cuadrado en las unidades de superficie
              echo "<p>Área de un círculo de radio = " . $radio . " cm --> <strong>" . $areaBonita . "</strong> cm<sup>2</sup></p>";
              echo "<p>Perímetro de ese círculo --> <strong>" . $perimetroBonito . "</strong> cm</p>";
              echo "<hr>";
              echo "<p>El valor máximo que puede tomar un entero en PHP es <strong>$maximoEntero</strong></p>";
            ?>
          </div>
        </div>
      </div>

      <!-- Ejercicio 5 -->
      <div class="tab-pane fade" id="panelEjercicio5">
        <div class="card shadow-sm">
          <div class="card-body">
            <?php
              // El enunciado pide este ejercicio en un proyecto aparte, ejecutado con el
              // servidor propio de PHP, así que aquí solo dejo la explicación y los enlaces
              echo "<h2 class='h4 text-primary'>Ejercicio 5: tipos de dato</h2>";
            ?>
            <p>Este ejercicio va en la carpeta <code>Ejercicio5</code>, que está al lado de esta
              página. La nota del enunciado pide abrirlo con el servidor propio de PHP en vez de
              con XAMPP.</p>
            <p>Para verlo hay que situarse en la carpeta <code>Ejercicio5</code> y escribir en la
              terminal:</p>
            <pre class="bg-light p-3 rounded">php -S localhost:8000</pre>
            <p>Y abrir en el navegador:</p>
            <ul>
              <li><a href="Ejercicio5/tiposDeDato.php">Salida 1: los valores que da el enunciado</a></li>
              <li><a href="Ejercicio5/tiposDeDato2.php">Salida 2: con los valores ya cambiados</a></li>
            </ul>
            <p class="text-secondary small">Los dos archivos son el mismo código. Lo único que
              cambia entre ellos es el valor de las dos variables, como pide la nota del enunciado.</p>
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
