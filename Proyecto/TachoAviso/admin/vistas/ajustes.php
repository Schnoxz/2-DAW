<?php
/**
 * Ajustes globales de los avisos.
 *
 * Estos valores son los que hereda un usuario que todavía no ha configurado
 * los suyos. El correo del remitente debe existir en el dominio.
 */

if (!defined('ABSPATH')) {
  exit;
}
?>

<div class="wrap">
  <h1>Ajustes de TachoAviso</h1>

  <?php if (isset($_GET['tachoaviso_ok'])) : ?>
    <div class="notice notice-success is-dismissible">
      <p>Ajustes guardados.</p>
    </div>
  <?php endif; ?>

  <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="tachoaviso_admin_ajustes">
    <?php wp_nonce_field('tachoaviso_admin_ajustes'); ?>

    <table class="form-table" role="presentation">
      <tr>
        <th scope="row">Antelaciones</th>
        <td>
          <?php foreach ([30, 15, 7] as $dia) : ?>
            <label>
              <input type="checkbox" name="antelacion_<?php echo (int) $dia; ?>" value="<?php echo (int) $dia; ?>" <?php checked(in_array($dia, (array) $antelaciones, true)); ?>>
              <?php echo (int) $dia; ?> días
            </label><br>
          <?php endforeach; ?>
          <p class="description">Se envía solo el aviso más urgente que ya toca, no los tres a la vez.</p>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="remitente">Correo del remitente</label></th>
        <td>
          <input type="email" id="remitente" name="remitente" class="regular-text" value="<?php echo esc_attr($remitente); ?>" required>
          <p class="description">Debe ser un buzón del dominio y estar autorizado por el hosting.</p>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="hora">Hora del envío</label></th>
        <td>
          <input type="number" id="hora" name="hora" min="0" max="23" value="<?php echo (int) $hora; ?>" class="small-text">
          <p class="description">Hora local de España. La tarea se ejecuta una vez al día.</p>
        </td>
      </tr>
    </table>

    <?php submit_button('Guardar ajustes'); ?>
  </form>
</div>
