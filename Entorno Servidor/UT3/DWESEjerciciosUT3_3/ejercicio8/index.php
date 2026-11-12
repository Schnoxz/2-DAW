<?php
// Ejercicio 8: una web con tema claro y tema oscuro.
//
// El tema no se guarda en ningún sitio: viaja en la URL. Si se pide
// index.php?tema=oscuro se carga la hoja oscura; en cualquier otro caso se
// queda la clara.

// Valor por defecto: tema claro
$tema = 'claro';

// Solo acepto exactamente "oscuro". Así, si alguien escribe otra cosa en la
// URL, no se rompe nada y sigue viendo la web con el tema claro
if (isset($_GET['tema']) && $_GET['tema'] == 'oscuro') {
  $tema = 'oscuro';
}

// header.php usa $tema para elegir la hoja de estilo: se lo pasamos incluido
require 'header.php';
?>

<section class="contenido">
  <h2>Una web con dos temas</h2>
  <p>
    Estás viendo el <strong>tema <?= $tema ?></strong>. El HTML es el mismo en los
    dos casos: lo único que cambia es la hoja de estilo que se carga.
  </p>
  <p>
    Para saber qué tema está activo, el enlace de la cabecera añade
    <code>?tema=oscuro</code> o <code>?tema=claro</code> a la dirección. PHP lo
    recoge con <code>$_GET</code> y comprueba que sea un valor permitido antes de
    usarlo para construir el nombre del archivo CSS.
  </p>

  <h2>Qué archivos forman la web</h2>
  <ul>
    <li><code>index.php</code>: decide el tema y pinta el contenido.</li>
    <li><code>header.php</code>: cabecera con los dos enlaces de cambio de tema.</li>
    <li><code>footer.php</code>: pie de página, separado del resto como pide el enunciado.</li>
    <li><code>css/temaClaro.css</code> y <code>css/temaOscuro.css</code>: los colores de cada tema.</li>
    <li><code>css/estilosComunes.css</code>: la cabecera, que se ve igual en los dos temas.</li>
  </ul>
</section>

<?php require 'footer.php'; ?>
