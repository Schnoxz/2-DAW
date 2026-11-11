<?php
/**
 * Acceso y registro.
 *
 * Una sola página con dos formularios. Si el usuario ya tiene sesión, se le
 * ofrece el enlace al panel en lugar de pedirle otra vez la contraseña.
 */

if (!defined('ABSPATH')) {
  exit;
}

$conectado = tachoaviso_puede_gestionar();
$estado = isset($_GET['tachoaviso_estado']) ? sanitize_key(wp_unslash($_GET['tachoaviso_estado'])) : '';
$mensaje = isset($_GET['tachoaviso_mensaje']) ? sanitize_text_field(wp_unslash($_GET['tachoaviso_mensaje'])) : '';
$url_panel = tachoaviso_url_pagina('panel');
$url_registro = tachoaviso_url_pagina('registro');
?>

<div class="ta-acceso">
  <a class="ta-salto" href="#ta-acceso-contenido">Saltar al contenido</a>

  <header class="ta-acceso__cabecera">
    <a class="ta-logo" href="<?php echo esc_url(home_url('/')); ?>">
      <span class="ta-logo__marca" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="30" height="30" role="img" aria-hidden="true" focusable="false">
          <circle cx="16" cy="16" r="15" fill="none" stroke="currentColor" stroke-width="2"></circle>
          <path d="M9 16.5l4.2 4.2L23 11" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </span>
      <span class="ta-logo__texto">TachoAviso</span>
    </a>
    <a class="ta-boton ta-boton--secundario" href="<?php echo esc_url(home_url('/')); ?>">Volver a la web</a>
  </header>

  <main class="ta-acceso__contenido" id="ta-acceso-contenido">
    <div class="ta-acceso__texto">
      <p class="ta-etiqueta">Área privada</p>
      <h1>Entra y mira qué vence esta semana</h1>
      <p>El panel te muestra los vencimientos ordenados por urgencia. Si algo está en rojo, todavía estás a tiempo de hacerlo.</p>
      <ul class="ta-lista-check">
        <li>Tacógrafo, ITV, seguro y tarjeta en un solo sitio</li>
        <li>Avisos por correo antes de que caduque</li>
        <li>Solo alias, matrícula y fechas</li>
      </ul>
    </div>

    <?php if ($conectado) : ?>
      <div class="ta-acceso__panel">
        <h2>Ya tienes la sesión iniciada</h2>
        <p>Puedes ir directamente a tus vencimientos.</p>
        <a class="ta-boton ta-boton--primario ta-boton--grande" href="<?php echo esc_url($url_panel); ?>">Abrir el panel</a>
      </div>
    <?php else : ?>
      <div class="ta-acceso__formularios">
        <?php if ($mensaje !== '') : ?>
          <div class="ta-aviso ta-aviso--<?php echo $estado === 'ok' ? 'ok' : 'error'; ?>" role="alert">
            <?php echo esc_html($mensaje); ?>
          </div>
        <?php endif; ?>

        <section class="ta-formulario" aria-labelledby="ta-titulo-login">
          <h2 id="ta-titulo-login">Entrar</h2>
          <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" novalidate>
            <input type="hidden" name="action" value="tachoaviso_accion">
            <input type="hidden" name="accion" value="login">
            <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">

            <div class="ta-campo">
              <label for="ta-login-email">Correo electrónico</label>
              <input type="email" id="ta-login-email" name="email" autocomplete="email" required data-validar="email">
              <p class="ta-campo__error" data-error-de="ta-login-email" aria-live="polite"></p>
            </div>

            <div class="ta-campo">
              <label for="ta-login-password">Contraseña</label>
              <input type="password" id="ta-login-password" name="password" autocomplete="current-password" required data-validar="password">
              <p class="ta-campo__error" data-error-de="ta-login-password" aria-live="polite"></p>
            </div>

            <button class="ta-boton ta-boton--primario ta-boton--ancho" type="submit">Entrar</button>
          </form>
        </section>

        <section class="ta-formulario" aria-labelledby="ta-titulo-registro">
          <h2 id="ta-titulo-registro">Crear cuenta</h2>
          <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" novalidate>
            <input type="hidden" name="action" value="tachoaviso_accion">
            <input type="hidden" name="accion" value="registro">
            <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">

            <div class="ta-campo">
              <label for="ta-registro-nombre">Tu nombre</label>
              <input type="text" id="ta-registro-nombre" name="nombre" autocomplete="name" required minlength="2" data-validar="texto">
              <p class="ta-campo__error" data-error-de="ta-registro-nombre" aria-live="polite"></p>
            </div>

            <div class="ta-campo">
              <label for="ta-registro-email">Correo electrónico</label>
              <input type="email" id="ta-registro-email" name="email" autocomplete="email" required data-validar="email">
              <p class="ta-campo__error" data-error-de="ta-registro-email" aria-live="polite"></p>
            </div>

            <div class="ta-campo">
              <label for="ta-registro-password">Contraseña</label>
              <input type="password" id="ta-registro-password" name="password" autocomplete="new-password" required minlength="8" data-validar="password">
              <p class="ta-campo__ayuda">Mínimo 8 caracteres.</p>
              <p class="ta-campo__error" data-error-de="ta-registro-password" aria-live="polite"></p>
            </div>

            <div class="ta-campo ta-campo--check">
              <input type="checkbox" id="ta-registro-privacidad" name="privacidad" required>
              <label for="ta-registro-privacidad">
                He leído la <a href="<?php echo esc_url(tachoaviso_url_pagina('privacidad')); ?>">política de privacidad</a>
                y acepto los <a href="<?php echo esc_url(tachoaviso_url_pagina('terminos')); ?>">términos</a>.
              </label>
              <p class="ta-campo__error" data-error-de="ta-registro-privacidad" aria-live="polite"></p>
            </div>

            <button class="ta-boton ta-boton--primario ta-boton--ancho" type="submit">Crear cuenta gratis</button>
          </form>
        </section>
      </div>
    <?php endif; ?>
  </main>

  <footer class="ta-acceso__pie">
    <p>© <?php echo esc_html(date_i18n('Y')); ?> TachoAviso · <a href="<?php echo esc_url($url_registro); ?>">Crear cuenta</a></p>
  </footer>
</div>
