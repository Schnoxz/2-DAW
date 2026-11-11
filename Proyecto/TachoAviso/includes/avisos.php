<?php
/**
 * Avisos por correo y tarea programada.
 *
 * La tarea se ejecuta una vez al día. Para cada vencimiento se busca la
 * antelación más urgente que ya toca y solo se envía esa: si el servicio ha
 * estado parado y quedan 6 días, no tiene sentido mandar tres correos seguidos
 * diciendo que quedaban 30, 15 y 7.
 */

if (!defined('ABSPATH')) {
  exit;
}

// tachoaviso_revisar_avisos()
// Recorre los vencimientos activos y envía el aviso que corresponda a cada uno.
// No devuelve nada: se ejecuta desde la tarea programada de WordPress.
function tachoaviso_revisar_avisos()
{
  $filas = tachoaviso_vencimientos_todos();
  $hoy = tachoaviso_hoy();

  foreach ($filas as $fila) {
    $dias = tachoaviso_dias_restantes($fila['fecha_vencimiento'], $hoy);

    // Un vencimiento ya pasado no genera aviso: aparece en rojo en el panel.
    if ($dias === null || $dias < 0) {
      continue;
    }

    $ajustes = tachoaviso_ajustes_usuario($fila['usuario_id']);

    if (empty($ajustes['recibir_avisos'])) {
      continue;
    }

    foreach (tachoaviso_antelaciones_usuario($fila['usuario_id']) as $antelacion) {
      // Se recorren de menor a mayor: la primera que ya toca es la que se envía.
      if ($dias > $antelacion) {
        continue;
      }

      if (tachoaviso_aviso_enviado($fila['id'], $antelacion)) {
        continue;
      }

      $enviado = tachoaviso_enviar_aviso($fila, $antelacion, $ajustes);

      // Solo se anota si el correo ha salido, para reintentarlo al día siguiente.
      if ($enviado) {
        tachoaviso_crear_aviso($fila['id'], $antelacion, 'enviado');
      }

      break;
    }
  }
}

// tachoaviso_enviar_aviso($fila, $antelacion, $ajustes)
// Prepara y envía el correo de un vencimiento concreto.
// Devuelve true si wp_mail lo acepta y false si falla.
function tachoaviso_enviar_aviso($fila, $antelacion, $ajustes)
{
  $plazo = tachoaviso_plazo($fila['tipo']);
  $etiqueta = $plazo ? $plazo['etiqueta'] : $fila['tipo'];
  $fecha = tachoaviso_fecha($fila['fecha_vencimiento']);
  $fecha_texto = $fecha ? $fecha->format('d/m/Y') : $fila['fecha_vencimiento'];

  $destinatario = !empty($ajustes['email_avisos']) && tachoaviso_email_valido($ajustes['email_avisos'])
    ? $ajustes['email_avisos']
    : $fila['user_email'];

  if (!tachoaviso_email_valido($destinatario)) {
    return false;
  }

  $avisos = tachoaviso_config('avisos');
  $asunto = sprintf($avisos['asunto'], $etiqueta, $fecha_texto);
  $panel = tachoaviso_url_pagina('panel');

  $vehiculo = $fila['vehiculo_alias'] ? $fila['vehiculo_alias'] : $fila['matricula'];
  $conductor = $fila['conductor_alias'] ? $fila['conductor_alias'] : '—';

  $cuerpo = '<div style="font-family:Arial,Helvetica,sans-serif;color:#14212e;line-height:1.5">';
  $cuerpo .= '<h2 style="color:#123a5c;margin:0 0 16px">TachoAviso</h2>';
  $cuerpo .= '<p>Hola ' . esc_html($fila['display_name']) . ':</p>';
  $cuerpo .= '<p>Te quedan <strong>' . (int) $antelacion . ' días</strong> para este vencimiento:</p>';
  $cuerpo .= '<table style="border-collapse:collapse;width:100%;max-width:520px">';
  $cuerpo .= '<tr><td style="padding:6px 0;color:#56677a">Trámite</td><td style="padding:6px 0"><strong>' . esc_html($etiqueta) . '</strong></td></tr>';
  $cuerpo .= '<tr><td style="padding:6px 0;color:#56677a">Vehículo</td><td style="padding:6px 0">' . esc_html($vehiculo) . '</td></tr>';
  $cuerpo .= '<tr><td style="padding:6px 0;color:#56677a">Conductor</td><td style="padding:6px 0">' . esc_html($conductor) . '</td></tr>';
  $cuerpo .= '<tr><td style="padding:6px 0;color:#56677a">Fecha</td><td style="padding:6px 0"><strong>' . esc_html($fecha_texto) . '</strong></td></tr>';
  $cuerpo .= '</table>';
  $cuerpo .= '<p style="margin-top:20px"><a href="' . esc_url($panel) . '" style="background:#123a5c;color:#ffffff;padding:10px 18px;border-radius:8px;text-decoration:none">Abrir el panel</a></p>';
  $cuerpo .= '<p style="font-size:13px;color:#56677a">Si ya has hecho el trámite, márcalo en el panel para cerrar el ciclo y no recibir más avisos de esta fecha.</p>';
  $cuerpo .= '<p style="font-size:12px;color:#56677a">TachoAviso te ayuda a recordar fechas. No sustituye al asesoramiento legal ni garantiza el cumplimiento normativo.</p>';
  $cuerpo .= '</div>';

  $cabeceras = [
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . $avisos['nombre_remitente'] . ' <' . $avisos['remitente'] . '>',
  ];

  return (bool) wp_mail($destinatario, $asunto, $cuerpo, $cabeceras);
}

// tachoaviso_programar_avisos()
// Programa la tarea diaria si no existe, por si se perdió al migrar el sitio.
// No devuelve nada.
function tachoaviso_programar_avisos()
{
  $avisos = tachoaviso_config('avisos');

  if (wp_next_scheduled($avisos['cron'])) {
    return;
  }

  $zona = new DateTimeZone(tachoaviso_config('zona_horaria'));
  $primera = new DateTimeImmutable('tomorrow ' . $avisos['hora'] . ':00', $zona);
  wp_schedule_event($primera->getTimestamp(), $avisos['frecuencia'], $avisos['cron']);
}
