<?php
// Ejercicio 5: tabla con los caracteres UNICODE del 0 al 50000.
// Cada carácter se escribe en HTML como &#código; (por ejemplo &#241; es la ñ).

echo "<h2 class='h4 text-primary'>Ejercicio 5: tabla UNICODE del 0 al 50000</h2>";
echo "<p>Cada símbolo se escribe con su código HTML en formato <code>&amp;#número;</code>.</p>";
?>
<!-- Caja con scroll (overflow-auto). Solo se fija la altura máxima, que Bootstrap no tiene
     como clase -->
<div class="border rounded p-2 overflow-auto small" style="max-height: 400px;">
  <?php
    // Recorro todos los códigos del 0 al 50000 y escribo cada entidad
    for ($i = 0; $i <= 50000; $i++) {
      // Los códigos 0-31 y 127-159 son caracteres de control (invisibles)
      // Si los escribo como entidad real, el navegador mete un carácter que no se ve y el validador del W3C lo marca como error. En esos casos los escribo como texto, para que la tabla esté completa y el HTML valide.
      $esControl = ($i < 32) || ($i >= 127 && $i <= 159);

      if ($esControl) {
        echo '<code class="text-muted">' . htmlspecialchars("&#$i;") . '</code> ';
      } else {
        echo "&#$i; ";
      }
    }
  ?>
</div>
<p class="text-secondary small mt-2">Muchos códigos no tienen dibujo (espacios, símbolos de control, etc.), por eso aparecen huecos en blanco.</p>
