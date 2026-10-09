<?php
// ================= EJERCICIO 5 (opcional): tabla UNICODE =================
// Trozo de pagina que index.php incluye dentro de la pestaña del ejercicio 5.

echo "<h2 class='h4 text-primary'>Ejercicio 5: tabla UNICODE del 0 al 50000</h2>";
echo "<p>Cada simbolo se escribe con su codigo HTML en formato <code>&amp;#numero;</code>.</p>";
?>
<!-- Caja con scroll para no llenar toda la pagina con 50001 caracteres -->
<div style="max-height: 400px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: .5rem; padding: .5rem; font-size: 14px; line-height: 1.6; word-break: break-all;">
  <?php
    // Un bucle for que va del 0 al 50000 (por eso <= y no <)
    for ($i = 0; $i <= 50000; $i++) {
      // Escribo &# , luego el numero del bucle, y luego el punto y coma.
      // Al juntarse en el HTML queda por ejemplo &#241; que es la ñ.
      echo "&#$i; ";
    }
  ?>
</div>
<p class="text-secondary small mt-2">Hay muchos codigos que no tienen dibujo (espacios, símbolos de control, etc.), por eso aparecen huecos en blanco.</p>
