<?php
/**
 * Vista global de vencimientos para el administrador.
 *
 * No sustituye al panel del transportista: sirve para ver de un vistazo cómo
 * está el servicio y detectar usuarios con varios avisos en rojo.
 */

if (!defined('ABSPATH')) {
  exit;
}
?>

<div class="wrap">
  <h1>TachoAviso</h1>
  <p>Resumen de todos los vencimientos activos. Los datos personales de los conductores no se guardan: solo su alias.</p>

  <div class="tachoaviso-admin-resumen">
    <div class="tachoaviso-admin-dato">
      <span class="tachoaviso-admin-numero"><?php echo (int) $resumen['total']; ?></span>
      <span>Total</span>
    </div>
    <div class="tachoaviso-admin-dato tachoaviso-admin-dato--rojo">
      <span class="tachoaviso-admin-numero"><?php echo (int) $resumen['rojo']; ?></span>
      <span>En rojo</span>
    </div>
    <div class="tachoaviso-admin-dato tachoaviso-admin-dato--ambar">
      <span class="tachoaviso-admin-numero"><?php echo (int) $resumen['ambar']; ?></span>
      <span>En ámbar</span>
    </div>
    <div class="tachoaviso-admin-dato tachoaviso-admin-dato--verde">
      <span class="tachoaviso-admin-numero"><?php echo (int) $resumen['verde']; ?></span>
      <span>En verde</span>
    </div>
  </div>

  <table class="widefat striped">
    <thead>
      <tr>
        <th>Estado</th>
        <th>Usuario</th>
        <th>Vehículo</th>
        <th>Conductor</th>
        <th>Trámite</th>
        <th>Vence</th>
        <th>Días</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($filas) === 0) : ?>
        <tr>
          <td colspan="7">Todavía no hay vencimientos registrados.</td>
        </tr>
      <?php else : ?>
        <?php foreach ($filas as $fila) : ?>
          <?php $plazo = tachoaviso_plazo($fila['tipo']); ?>
          <tr>
            <td>
              <span class="tachoaviso-punto tachoaviso-punto--<?php echo esc_attr($fila['estado']); ?>"></span>
              <?php echo esc_html($fila['estado_texto']); ?>
            </td>
            <td><?php echo esc_html($fila['user_email']); ?></td>
            <td><?php echo esc_html($fila['vehiculo_alias'] ? $fila['vehiculo_alias'] : '—'); ?></td>
            <td><?php echo esc_html($fila['conductor_alias'] ? $fila['conductor_alias'] : '—'); ?></td>
            <td><?php echo esc_html($plazo ? $plazo['etiqueta'] : $fila['tipo']); ?></td>
            <td><?php echo esc_html(tachoaviso_fecha($fila['fecha_vencimiento'])->format('d/m/Y')); ?></td>
            <td><?php echo (int) $fila['dias']; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <p>
    <a class="button button-primary" href="<?php echo esc_url(admin_url('admin.php?page=tachoaviso-ajustes')); ?>">Configurar avisos</a>
  </p>
</div>
