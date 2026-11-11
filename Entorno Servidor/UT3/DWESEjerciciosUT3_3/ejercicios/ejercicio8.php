<?php
// Ejercicio 8 (OBLIGATORIO): web que cambia entre tema claro y tema oscuro.
//
// Este ejercicio no se puede pegar dentro de la pestaña como los demás: es una
// página entera, con su propio head, su header, su footer y sus hojas de
// estilo. Por eso vive en la carpeta ejercicio8/ y aquí solo la mostramos.
?>

<h2 class="h4 text-primary">Ejercicio 8: tema claro y tema oscuro (obligatorio)</h2>

<p>La web está en la carpeta <code>ejercicio8/</code>, con esta organización:</p>

<ul>
  <li><code>index.php</code>: decide qué tema se carga y pinta el contenido.</li>
  <li><code>header.php</code>: cabecera con los dos enlaces de cambio de tema.</li>
  <li><code>footer.php</code>: pie de página, en su propio archivo como pide el enunciado.</li>
  <li><code>css/temaClaro.css</code> y <code>css/temaOscuro.css</code>: los dos temas.</li>
  <li><code>css/estilosComunes.css</code>: lo que no cambia con el tema (la cabecera).</li>
</ul>

<p>Por defecto se carga el tema claro. Al pulsar un enlace se recarga la misma
página con <code>index.php?tema=oscuro</code> o <code>?tema=claro</code> y se
cambia solo la hoja de estilo: el HTML es el mismo.</p>

<p>
  <a class="btn btn-primary" href="ejercicio8/index.php" target="_blank" rel="noopener">
    Abrir la web en otra pestaña
  </a>
</p>

<!-- iframe: así se ve la web de verdad desde la pestaña, con su propio CSS -->
<iframe src="ejercicio8/index.php" title="Ejercicio 8: web con cambio de tema claro y oscuro"
  class="w-100 border rounded" height="520"></iframe>
