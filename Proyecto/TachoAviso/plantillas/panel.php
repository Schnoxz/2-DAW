<?php
/**
 * Panel privado del transportista.
 *
 * Los datos llegan calculados desde shortcodes.php. La tabla se pinta en el
 * servidor y panel.js se encarga de filtrar, ordenar y abrir los formularios.
 */

if (!defined('ABSPATH')) {
  exit;
}

$estado = isset($_GET['tachoaviso_estado']) ? sanitize_key(wp_unslash($_GET['tachoaviso_estado'])) : '';
$mensaje = isset($_GET['tachoaviso_mensaje']) ? sanitize_text_field(wp_unslash($_GET['tachoaviso_mensaje'])) : '';
$usuario = wp_get_current_user();
$hoy = tachoaviso_hoy();
$url_exportar = wp_nonce_url(admin_url('admin-post.php?action=tachoaviso_exportar'), 'tachoaviso_exportar');
$url_salir = wp_logout_url(home_url('/'));
?>

<div class="ta-panel">
  <a class="ta-salto" href="#ta-panel-contenido">Saltar al contenido</a>

  <header class="ta-barra">
    <div class="ta-barra__fila">
      <a class="ta-logo ta-logo--claro" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="ta-logo__marca" aria-hidden="true">
          <svg viewBox="0 0 32 32" width="30" height="30" role="img" aria-hidden="true" focusable="false">
            <circle cx="16" cy="16" r="15" fill="none" stroke="currentColor" stroke-width="2"></circle>
            <path d="M9 16.5l4.2 4.2L23 11" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </span>
        <span class="ta-logo__texto">TachoAviso</span>
      </a>

      <nav class="ta-barra__nav" aria-label="Navegación del panel">
        <a class="ta-barra__enlace ta-barra__enlace--activo" href="<?php echo esc_url(tachoaviso_url_pagina('panel')); ?>" aria-current="page">Vencimientos</a>
        <button class="ta-barra__enlace" type="button" data-abrir-dialogo="ta-dialogo-vehiculo">Vehículos</button>
        <button class="ta-barra__enlace" type="button" data-abrir-dialogo="ta-dialogo-conductor">Conductores</button>
      </nav>

      <div class="ta-barra__usuario">
        <span class="ta-barra__nombre"><?php echo esc_html($usuario->display_name); ?></span>
        <a class="ta-barra__salir" href="<?php echo esc_url($url_salir); ?>">Salir</a>
      </div>
    </div>
  </header>

  <main class="ta-panel__contenido" id="ta-panel-contenido">
    <div class="ta-panel__cabecera">
      <div>
        <p class="ta-etiqueta">Panel de vencimientos</p>
        <h1>Hola, <?php echo esc_html($usuario->display_name); ?></h1>
        <p class="ta-panel__fecha">Hoy es <?php echo esc_html($hoy->format('d/m/Y')); ?>. Esto es lo que tienes que vigilar.</p>
      </div>
      <div class="ta-panel__acciones">
        <a class="ta-boton ta-boton--secundario" href="<?php echo esc_url($url_exportar); ?>">Exportar CSV</a>
        <button class="ta-boton ta-boton--primario" type="button" data-abrir-dialogo="ta-dialogo-vencimiento">Nuevo vencimiento</button>
      </div>
    </div>

    <?php if ($mensaje !== '') : ?>
      <div class="ta-aviso ta-aviso--<?php echo $estado === 'ok' ? 'ok' : 'error'; ?>" role="alert">
        <?php echo esc_html($mensaje); ?>
      </div>
    <?php endif; ?>

    <section class="ta-resumen" aria-label="Resumen de vencimientos">
      <div class="ta-resumen__dato">
        <span class="ta-resumen__numero" data-resumen="total"><?php echo (int) $resumen['total']; ?></span>
        <span class="ta-resumen__texto">Vencimientos activos</span>
      </div>
      <div class="ta-resumen__dato ta-resumen__dato--rojo">
        <span class="ta-resumen__numero" data-resumen="rojo"><?php echo (int) $resumen['rojo']; ?></span>
        <span class="ta-resumen__texto">Urgentes o vencidos</span>
      </div>
      <div class="ta-resumen__dato ta-resumen__dato--ambar">
        <span class="ta-resumen__numero" data-resumen="ambar"><?php echo (int) $resumen['ambar']; ?></span>
        <span class="ta-resumen__texto">Próximos (8-30 días)</span>
      </div>
      <div class="ta-resumen__dato ta-resumen__dato--verde">
        <span class="ta-resumen__numero" data-resumen="verde"><?php echo (int) $resumen['verde']; ?></span>
        <span class="ta-resumen__texto">Con margen</span>
      </div>
    </section>

    <section class="ta-tabla-caja" aria-labelledby="ta-titulo-tabla">
      <div class="ta-tabla-cabecera">
        <h2 id="ta-titulo-tabla">Todos los vencimientos</h2>
        <div class="ta-filtros">
          <div class="ta-filtros__grupo" role="group" aria-label="Filtrar por estado">
            <button class="ta-chip ta-chip--activo" type="button" data-filtro="todos" aria-pressed="true">Todos</button>
            <button class="ta-chip" type="button" data-filtro="rojo" aria-pressed="false">Urgentes</button>
            <button class="ta-chip" type="button" data-filtro="ambar" aria-pressed="false">Próximos</button>
            <button class="ta-chip" type="button" data-filtro="verde" aria-pressed="false">Con margen</button>
          </div>

          <div class="ta-filtros__busqueda">
            <label class="ta-visually-hidden" for="ta-buscar">Buscar por matrícula, alias o trámite</label>
            <input type="search" id="ta-buscar" placeholder="Buscar matrícula, alias o trámite" data-buscar>
          </div>

          <div class="ta-filtros__tipo">
            <label class="ta-visually-hidden" for="ta-tipo">Filtrar por trámite</label>
            <select id="ta-tipo" data-filtro-tipo>
              <option value="">Todos los trámites</option>
              <?php foreach (tachoaviso_config('plazos') as $clave => $plazo) : ?>
                <option value="<?php echo esc_attr($clave); ?>"><?php echo esc_html($plazo['etiqueta']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="ta-tabla-scroll">
        <table class="ta-tabla">
          <thead>
            <tr>
              <th scope="col">Estado</th>
              <th scope="col">Vehículo</th>
              <th scope="col">Conductor</th>
              <th scope="col">Trámite</th>
              <th scope="col">Vence</th>
              <th scope="col">Días</th>
              <th scope="col"><span class="ta-visually-hidden">Acciones</span></th>
            </tr>
          </thead>
          <tbody data-tabla-vencimientos>
            <?php if (count($vencimientos) === 0) : ?>
              <tr class="ta-tabla__vacia">
                <td colspan="7">
                  <strong>Todavía no hay vencimientos.</strong>
                  Da de alta un vehículo y su primer trámite para empezar.
                </td>
              </tr>
            <?php else : ?>
              <?php foreach ($vencimientos as $fila) : ?>
                <?php
                $plazo = tachoaviso_plazo($fila['tipo']);
                $etiqueta = $plazo ? $plazo['etiqueta'] : $fila['tipo'];
                $fecha = tachoaviso_fecha($fila['fecha_vencimiento']);
                $texto_buscar = strtolower($fila['matricula'] . ' ' . $fila['vehiculo_alias'] . ' ' . $fila['conductor_alias'] . ' ' . $etiqueta);
                ?>
                <tr data-fila data-estado="<?php echo esc_attr($fila['estado']); ?>" data-tipo="<?php echo esc_attr($fila['tipo']); ?>" data-buscar="<?php echo esc_attr($texto_buscar); ?>" data-dias="<?php echo (int) $fila['dias']; ?>">
                  <td data-etiqueta="Estado">
                    <span class="ta-badge ta-badge--<?php echo esc_attr($fila['estado']); ?>">
                      <span class="ta-badge__punto" aria-hidden="true"></span>
                      <?php echo esc_html($fila['estado_texto']); ?>
                    </span>
                  </td>
                  <td data-etiqueta="Vehículo">
                    <strong><?php echo esc_html($fila['vehiculo_alias'] ? $fila['vehiculo_alias'] : $fila['matricula']); ?></strong>
                    <span class="ta-tabla__secundario"><?php echo esc_html($fila['matricula']); ?></span>
                  </td>
                  <td data-etiqueta="Conductor"><?php echo esc_html($fila['conductor_alias'] ? $fila['conductor_alias'] : '—'); ?></td>
                  <td data-etiqueta="Trámite"><?php echo esc_html($etiqueta); ?></td>
                  <td data-etiqueta="Vence"><?php echo esc_html($fecha ? $fecha->format('d/m/Y') : '—'); ?></td>
                  <td data-etiqueta="Días"><strong><?php echo (int) $fila['dias']; ?></strong></td>
                  <td data-etiqueta="Acciones">
                    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" data-confirmar="¿Marcar este trámite como hecho? Se calculará la siguiente fecha.">
                      <input type="hidden" name="action" value="tachoaviso_accion">
                      <input type="hidden" name="accion" value="marcar_hecho">
                      <input type="hidden" name="vencimiento_id" value="<?php echo (int) $fila['id']; ?>">
                      <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">
                      <button class="ta-boton ta-boton--pequeno" type="submit">Marcar hecho</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <p class="ta-tabla__leyenda">
        <span class="ta-punto ta-punto--rojo"></span> Rojo: 7 días o menos, o vencido.
        <span class="ta-punto ta-punto--ambar"></span> Ámbar: de 8 a 30 días.
        <span class="ta-punto ta-punto--verde"></span> Verde: más de 30 días.
      </p>
      <p class="ta-tabla__vacia-mensaje" data-sin-resultados hidden>No hay vencimientos que coincidan con el filtro.</p>
    </section>

    <details class="ta-ajustes">
      <summary>Ajustes de los avisos</summary>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="tachoaviso_accion">
        <input type="hidden" name="accion" value="guardar_ajustes">
        <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">

        <fieldset>
          <legend>Avísame con esta antelación</legend>
          <?php foreach ([30, 15, 7] as $dia) : ?>
            <label class="ta-campo--check">
              <input type="checkbox" name="antelacion_<?php echo (int) $dia; ?>" value="<?php echo (int) $dia; ?>" <?php checked(in_array($dia, (array) $ajustes['antelaciones'], true)); ?>>
              <?php echo (int) $dia; ?> días antes
            </label>
          <?php endforeach; ?>
        </fieldset>

        <div class="ta-campo">
          <label for="ta-email-avisos">Correo para los avisos</label>
          <input type="email" id="ta-email-avisos" name="email_avisos" value="<?php echo esc_attr($ajustes['email_avisos']); ?>" placeholder="<?php echo esc_attr($usuario->user_email); ?>" data-validar="email">
          <p class="ta-campo__ayuda">Si lo dejas vacío, se usa el correo de la cuenta.</p>
          <p class="ta-campo__error" data-error-de="ta-email-avisos" aria-live="polite"></p>
        </div>

        <label class="ta-campo--check">
          <input type="checkbox" name="recibir_avisos" value="1" <?php checked((int) $ajustes['recibir_avisos'], 1); ?>>
          Quiero recibir los avisos por correo
        </label>

        <button class="ta-boton ta-boton--primario" type="submit">Guardar ajustes</button>
      </form>
    </details>
  </main>

  <dialog class="ta-dialogo" id="ta-dialogo-vencimiento" aria-labelledby="ta-titulo-dialogo-vencimiento">
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="tachoaviso_accion">
      <input type="hidden" name="accion" value="guardar_vencimiento">
      <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">

      <div class="ta-dialogo__cabecera">
        <h2 id="ta-titulo-dialogo-vencimiento">Nuevo vencimiento</h2>
        <button class="ta-dialogo__cerrar" type="button" data-cerrar-dialogo aria-label="Cerrar">&times;</button>
      </div>

      <p class="ta-dialogo__intro">Indica la fecha de la última revisión. Nosotros sumamos el plazo legal.</p>

      <div class="ta-campo">
        <label for="ta-tipo-nuevo">Trámite</label>
        <select id="ta-tipo-nuevo" name="tipo" data-tipo-vencimiento>
          <?php foreach (tachoaviso_config('plazos') as $clave => $plazo) : ?>
            <option value="<?php echo esc_attr($clave); ?>" data-dias="<?php echo (int) $plazo['dias']; ?>"><?php echo esc_html($plazo['etiqueta']); ?> (<?php echo (int) $plazo['dias']; ?> días)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="ta-campo">
        <label for="ta-vehiculo-nuevo">Vehículo</label>
        <select id="ta-vehiculo-nuevo" name="vehiculo_id">
          <option value="0">Sin vehículo (solo tarjeta)</option>
          <?php foreach ($vehiculos as $vehiculo) : ?>
            <option value="<?php echo (int) $vehiculo['id']; ?>"><?php echo esc_html($vehiculo['alias'] . ' · ' . $vehiculo['matricula']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="ta-campo">
        <label for="ta-conductor-nuevo">Conductor</label>
        <select id="ta-conductor-nuevo" name="conductor_id">
          <option value="0">Sin conductor</option>
          <?php foreach ($conductores as $conductor) : ?>
            <option value="<?php echo (int) $conductor['id']; ?>"><?php echo esc_html($conductor['alias']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="ta-campo">
        <label for="ta-fecha-nuevo">Fecha de la última revisión</label>
        <input type="date" id="ta-fecha-nuevo" name="fecha_referencia" value="<?php echo esc_attr($hoy->format('Y-m-d')); ?>" required data-validar="fecha">
        <p class="ta-campo__error" data-error-de="ta-fecha-nuevo" aria-live="polite"></p>
      </div>

      <div class="ta-campo">
        <label for="ta-intervalo-nuevo">Intervalo en días</label>
        <input type="number" id="ta-intervalo-nuevo" name="intervalo_dias" min="1" max="1095" value="28" required data-validar="numero">
        <p class="ta-campo__ayuda">Se rellena solo al elegir el trámite, pero puedes cambiarlo.</p>
        <p class="ta-campo__error" data-error-de="ta-intervalo-nuevo" aria-live="polite"></p>
      </div>

      <p class="ta-campo__ayuda" data-previsualizacion aria-live="polite"></p>

      <div class="ta-campo">
        <label for="ta-notas-nuevo">Notas (opcional)</label>
        <input type="text" id="ta-notas-nuevo" name="notas" maxlength="255" placeholder="Ej.: descarga hecha en el taller">
      </div>

      <div class="ta-dialogo__acciones">
        <button class="ta-boton ta-boton--secundario" type="button" data-cerrar-dialogo>Cancelar</button>
        <button class="ta-boton ta-boton--primario" type="submit">Calcular y guardar</button>
      </div>
    </form>
  </dialog>

  <dialog class="ta-dialogo" id="ta-dialogo-vehiculo" aria-labelledby="ta-titulo-dialogo-vehiculo">
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="tachoaviso_accion">
      <input type="hidden" name="accion" value="guardar_vehiculo">
      <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">

      <div class="ta-dialogo__cabecera">
        <h2 id="ta-titulo-dialogo-vehiculo">Nuevo vehículo</h2>
        <button class="ta-dialogo__cerrar" type="button" data-cerrar-dialogo aria-label="Cerrar">&times;</button>
      </div>

      <div class="ta-campo">
        <label for="ta-matricula">Matrícula</label>
        <input type="text" id="ta-matricula" name="matricula" placeholder="1234 ABC" required data-validar="matricula">
        <p class="ta-campo__error" data-error-de="ta-matricula" aria-live="polite"></p>
      </div>

      <div class="ta-campo">
        <label for="ta-alias-vehiculo">Alias del vehículo</label>
        <input type="text" id="ta-alias-vehiculo" name="alias" placeholder="Camión 1" data-validar="texto">
        <p class="ta-campo__ayuda">Si lo dejas vacío, se usa la matrícula.</p>
      </div>

      <div class="ta-campo">
        <label for="ta-marca">Marca (opcional)</label>
        <input type="text" id="ta-marca" name="marca" maxlength="60" placeholder="Mercedes Actros">
      </div>

      <div class="ta-dialogo__acciones">
        <button class="ta-boton ta-boton--secundario" type="button" data-cerrar-dialogo>Cancelar</button>
        <button class="ta-boton ta-boton--primario" type="submit">Guardar vehículo</button>
      </div>
    </form>
  </dialog>

  <dialog class="ta-dialogo" id="ta-dialogo-conductor" aria-labelledby="ta-titulo-dialogo-conductor">
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="tachoaviso_accion">
      <input type="hidden" name="accion" value="guardar_conductor">
      <input type="hidden" name="tachoaviso_nonce" value="<?php echo esc_attr(tachoaviso_nonce('accion')); ?>">

      <div class="ta-dialogo__cabecera">
        <h2 id="ta-titulo-dialogo-conductor">Nuevo conductor</h2>
        <button class="ta-dialogo__cerrar" type="button" data-cerrar-dialogo aria-label="Cerrar">&times;</button>
      </div>

      <p class="ta-dialogo__intro">Solo se guarda un alias. No pongas el nombre real: no hace falta para avisar de un plazo.</p>

      <div class="ta-campo">
        <label for="ta-alias-conductor">Alias</label>
        <input type="text" id="ta-alias-conductor" name="alias" placeholder="Conductor A" required data-validar="texto">
        <p class="ta-campo__error" data-error-de="ta-alias-conductor" aria-live="polite"></p>
      </div>

      <div class="ta-campo">
        <label for="ta-vehiculo-conductor">Vehículo habitual (opcional)</label>
        <select id="ta-vehiculo-conductor" name="vehiculo_id">
          <option value="0">Sin vehículo asignado</option>
          <?php foreach ($vehiculos as $vehiculo) : ?>
            <option value="<?php echo (int) $vehiculo['id']; ?>"><?php echo esc_html($vehiculo['alias'] . ' · ' . $vehiculo['matricula']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="ta-dialogo__acciones">
        <button class="ta-boton ta-boton--secundario" type="button" data-cerrar-dialogo>Cancelar</button>
        <button class="ta-boton ta-boton--primario" type="submit">Guardar conductor</button>
      </div>
    </form>
  </dialog>
</div>
