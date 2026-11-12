<?php
/**
 * Landing pública.
 *
 * Se inserta con el shortcode [tachoaviso_landing]. La página de WordPress debe
 * usar una plantilla a ancho completo para que la cabecera del tema no se
 * duplique con la de la landing.
 */

if (!defined('ABSPATH')) {
  exit;
}

$url_acceso = tachoaviso_url_pagina('acceso');
$url_registro = tachoaviso_url_pagina('registro');
$url_panel = tachoaviso_url_pagina('panel');
$precios = tachoaviso_config('precios');
?>

<div class="ta-landing">
  <a class="ta-salto" href="#ta-contenido">Saltar al contenido</a>

  <header class="ta-cabecera">
    <div class="ta-contenedor ta-cabecera__fila">
      <a class="ta-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="TachoAviso, inicio">
        <span class="ta-logo__marca" aria-hidden="true">
          <svg viewBox="0 0 32 32" width="32" height="32" role="img" aria-hidden="true" focusable="false">
            <circle cx="16" cy="16" r="15" fill="none" stroke="currentColor" stroke-width="2"></circle>
            <path d="M9 16.5l4.2 4.2L23 11" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </span>
        <span class="ta-logo__texto">TachoAviso</span>
      </a>

      <button class="ta-menu-boton" type="button" aria-expanded="false" aria-controls="ta-nav">
        Menú
      </button>

      <nav class="ta-nav" id="ta-nav" aria-label="Navegación principal">
        <a href="#ta-problema">El problema</a>
        <a href="#ta-como-funciona">Cómo funciona</a>
        <a href="#ta-funciones">Funciones</a>
        <a href="#ta-precios">Precios</a>
        <a class="ta-boton ta-boton--fantasma" href="<?php echo esc_url($url_acceso); ?>">Entrar</a>
        <a class="ta-boton ta-boton--primario" href="<?php echo esc_url($url_registro); ?>">Crear cuenta</a>
      </nav>
    </div>
  </header>

  <main id="ta-contenido">
    <section class="ta-hero">
      <div class="ta-contenedor ta-hero__rejilla">
        <div class="ta-hero__texto">
          <p class="ta-etiqueta">Vencimientos legales · Transporte por carretera</p>
          <h1>Los plazos del camión, <span class="ta-subrayado">bajo control</span>.</h1>
          <p class="ta-entradilla">
            TachoAviso calcula cuándo toca la próxima descarga del tacógrafo, la ITV, el seguro
            y la tarjeta del conductor. Te avisa por correo antes de que caduquen, sin subir
            ficheros y sin pedir datos personales de tus conductores.
          </p>
          <div class="ta-acciones">
            <a class="ta-boton ta-boton--primario ta-boton--grande" href="<?php echo esc_url($url_registro); ?>">Crear cuenta gratis</a>
            <a class="ta-boton ta-boton--secundario ta-boton--grande" href="<?php echo esc_url($url_panel); ?>">Ver el panel</a>
          </div>
          <ul class="ta-lista-confianza">
            <li>Sin instalar nada en el camión</li>
            <li>Sin permanencia</li>
            <li>Desde <?php echo (int) $precios['autonomo']; ?> €/mes</li>
          </ul>
        </div>

        <div class="ta-hero__visual" role="group" aria-label="Ejemplo del panel de TachoAviso">
          <div class="ta-panel-demo">
            <div class="ta-panel-demo__barra">
              <span class="ta-panel-demo__punto"></span>
              <span class="ta-panel-demo__punto"></span>
              <span class="ta-panel-demo__punto"></span>
              <span class="ta-panel-demo__titulo">Vencimientos</span>
            </div>
            <div class="ta-panel-demo__cuerpo">
              <div class="ta-panel-demo__fila">
                <span class="ta-semaforo ta-semaforo--rojo" aria-hidden="true"></span>
                <div>
                  <strong>1234 ABC</strong>
                  <span>Tarjeta del conductor</span>
                </div>
                <span class="ta-panel-demo__dias">4 días</span>
              </div>
              <div class="ta-panel-demo__fila">
                <span class="ta-semaforo ta-semaforo--ambar" aria-hidden="true"></span>
                <div>
                  <strong>4567 DEF</strong>
                  <span>Unidad del vehículo</span>
                </div>
                <span class="ta-panel-demo__dias">12 días</span>
              </div>
              <div class="ta-panel-demo__fila">
                <span class="ta-semaforo ta-semaforo--verde" aria-hidden="true"></span>
                <div>
                  <strong>7890 GHI</strong>
                  <span>ITV</span>
                </div>
                <span class="ta-panel-demo__dias">48 días</span>
              </div>
            </div>
            <div class="ta-panel-demo__pie">
              <span class="ta-punto ta-punto--rojo"></span> 1 urgente
              <span class="ta-punto ta-punto--ambar"></span> 1 próximo
              <span class="ta-punto ta-punto--verde"></span> 1 al día
            </div>
          </div>
          <p class="ta-hero__nota">El semáforo ordena por urgencia: rojo, ámbar y verde.</p>
        </div>
      </div>
    </section>

    <section class="ta-cifras" aria-label="Datos del sector">
      <div class="ta-contenedor ta-cifras__rejilla">
        <div>
          <strong>+200.000</strong>
          <span>camiones al año entre Algeciras y Tánger Med</span>
        </div>
        <div>
          <strong>28 / 56 / 90</strong>
          <span>días para las descargas del tacógrafo</span>
        </div>
        <div>
          <strong>1 multa</strong>
          <span>puede borrar el margen de varios meses</span>
        </div>
      </div>
    </section>

    <section class="ta-seccion" id="ta-problema">
      <div class="ta-contenedor">
        <p class="ta-etiqueta">El problema</p>
        <h2>Tres fechas que no perdonan</h2>
        <p class="ta-seccion__intro">
          El trabajo no es digitalizar la flota. Es no perder una fecha. Y las fechas del
          transporte no caen en días redondos: se mezclan en la guantera, en la póliza y en
          la cabeza.
        </p>

        <div class="ta-rejilla-3">
          <article class="ta-tarjeta">
            <span class="ta-tarjeta__numero">01</span>
            <h3>La tarjeta del conductor</h3>
            <p>Cada 28 días, o 56 si el tacógrafo es G2V2. Si se pasa, la inspección lo ve y la sanción es grave.</p>
          </article>
          <article class="ta-tarjeta">
            <span class="ta-tarjeta__numero">02</span>
            <h3>La unidad del vehículo</h3>
            <p>Cada 90 días hay que descargar los datos del tacógrafo. No coincide con ninguna fecha del calendario.</p>
          </article>
          <article class="ta-tarjeta">
            <span class="ta-tarjeta__numero">03</span>
            <h3>ITV, seguro y tarjeta</h3>
            <p>Cada documento vive en un sitio distinto. Cuando falla la persona que los controla, se pierde el control.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="ta-seccion ta-seccion--alterna" id="ta-como-funciona">
      <div class="ta-contenedor">
        <p class="ta-etiqueta">Cómo funciona</p>
        <h2>Tres pasos y no vuelves a mirar el calendario</h2>

        <ol class="ta-pasos">
          <li>
            <span class="ta-pasos__numero">1</span>
            <div>
              <h3>Da de alta el vehículo y el trámite</h3>
              <p>Matrícula, alias del conductor y la fecha de la última revisión. Sin ficheros del tacógrafo y sin nombres reales.</p>
            </div>
          </li>
          <li>
            <span class="ta-pasos__numero">2</span>
            <div>
              <h3>Nosotros calculamos la fecha</h3>
              <p>La aplicación suma el plazo legal (28, 56, 90 o 365 días) y coloca el vencimiento en el panel con su color.</p>
            </div>
          </li>
          <li>
            <span class="ta-pasos__numero">3</span>
            <div>
              <h3>Te avisamos antes</h3>
              <p>Un correo a 30, 15 y 7 días, configurable. Cuando haces el trámite, lo marcas y se calcula el siguiente ciclo.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="ta-seccion" id="ta-funciones">
      <div class="ta-contenedor">
        <p class="ta-etiqueta">Funciones</p>
        <h2>Lo justo para no perder un plazo</h2>
        <p class="ta-seccion__intro">
          Sin GPS, sin telemetría y sin descarga automática del tacógrafo. Solo lo que un
          autónomo o una microflota necesita de verdad.
        </p>

        <div class="ta-rejilla-3">
          <article class="ta-funcion">
            <h3>Plazos que se ajustan a la norma</h3>
            <p>28, 56 y 90 días para el tacógrafo; ITV y seguro según la fecha real del contrato.</p>
          </article>
          <article class="ta-funcion">
            <h3>Semáforo por urgencia</h3>
            <p>Rojo si vence en 7 días o ya pasó, ámbar hasta 30 y verde cuando hay margen.</p>
          </article>
          <article class="ta-funcion">
            <h3>Avisos sin duplicados</h3>
            <p>Cada vencimiento avisa una sola vez por antelación. Si cambia la fecha, el ciclo se reinicia.</p>
          </article>
          <article class="ta-funcion">
            <h3>Conductores por alias</h3>
            <p>No se guardan nombres, DNI ni teléfonos. Solo el alias que tú elijas.</p>
          </article>
          <article class="ta-funcion">
            <h3>Exportación a CSV</h3>
            <p>Te llevas tus vencimientos a Excel cuando quieras, sin pedir permiso ni depender de la nube.</p>
          </article>
          <article class="ta-funcion">
            <h3>Accesible desde la cabina</h3>
            <p>Botones grandes, lenguaje claro y WCAG 2.1 AA. Funciona en el móvil sin instalar una app.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="ta-seccion ta-seccion--alterna" id="ta-precios">
      <div class="ta-contenedor">
        <p class="ta-etiqueta">Precios</p>
        <h2>Menos que una multa. Sin permanencia.</h2>

        <div class="ta-precios">
          <article class="ta-precio">
            <h3>Autónomo</h3>
            <p class="ta-precio__cifra"><strong><?php echo (int) $precios['autonomo']; ?> €</strong> / mes</p>
            <p class="ta-precio__detalle">Hasta 3 vehículos y 3 conductores.</p>
            <ul>
              <li>Tacógrafo, ITV, seguro y tarjeta</li>
              <li>Avisos a 30, 15 y 7 días</li>
              <li>Exportación a CSV</li>
            </ul>
            <a class="ta-boton ta-boton--primario" href="<?php echo esc_url($url_registro); ?>">Empezar</a>
          </article>

          <article class="ta-precio ta-precio--destacado">
            <p class="ta-precio__insignia">Para microflotas</p>
            <h3>Microflota</h3>
            <p class="ta-precio__cifra"><strong><?php echo (int) $precios['microflota']; ?> €</strong> / mes</p>
            <p class="ta-precio__detalle">Hasta 10 vehículos y 10 conductores.</p>
            <ul>
              <li>Todo lo del plan Autónomo</li>
              <li>Panel único para toda la flota</li>
              <li>Correo de avisos compartido</li>
            </ul>
            <a class="ta-boton ta-boton--primario" href="<?php echo esc_url($url_registro); ?>">Empezar</a>
          </article>
        </div>

        <p class="ta-precios__nota">Precios sin IVA. Sin tarjeta para probar. Puedes borrar tu cuenta y tus datos cuando quieras.</p>
      </div>
    </section>

    <section class="ta-seccion" id="ta-preguntas">
      <div class="ta-contenedor ta-contenedor--estrecho">
        <p class="ta-etiqueta">Preguntas frecuentes</p>
        <h2>Lo que suele preguntar un transportista</h2>

        <details class="ta-pregunta">
          <summary>¿Tengo que subir el fichero del tacógrafo?</summary>
          <p>No. TachoAviso solo guarda la fecha de la última descarga y calcula la siguiente. No analiza ficheros ni necesita conectarse al tacógrafo.</p>
        </details>
        <details class="ta-pregunta">
          <summary>¿Qué datos personales se guardan?</summary>
          <p>El correo de la cuenta, la matrícula del vehículo, un alias para cada conductor y las fechas. No se piden nombres reales, DNI ni teléfonos de los conductores.</p>
        </details>
        <details class="ta-pregunta">
          <summary>¿Sustituye a mi gestoría?</summary>
          <p>No. Es un recordatorio. La gestoría sigue llevando el papeleo y el asesoramiento legal; TachoAviso solo evita que una fecha se pase por alto.</p>
        </details>
        <details class="ta-pregunta">
          <summary>¿Y si cambia la normativa?</summary>
          <p>Los plazos están en la configuración del plugin, no repartidos por el código. Cuando cambia una regla se actualiza el plazo y los vencimientos nuevos se calculan con el valor correcto.</p>
        </details>
        <details class="ta-pregunta">
          <summary>¿Puedo irme cuando quiera?</summary>
          <p>Sí. No hay permanencia. Desde el panel puedes descargar tus datos en CSV y pedir la supresión de la cuenta.</p>
        </details>
      </div>
    </section>

    <section class="ta-cierre">
      <div class="ta-contenedor ta-cierre__caja">
        <div>
          <h2>Que la próxima multa no sea por una fecha olvidada</h2>
          <p>Crea la cuenta, da de alta el primer vehículo y deja que el panel te avise.</p>
        </div>
        <a class="ta-boton ta-boton--primario ta-boton--grande" href="<?php echo esc_url($url_registro); ?>">Crear cuenta gratis</a>
      </div>
    </section>
  </main>

  <footer class="ta-pie">
    <div class="ta-contenedor ta-pie__rejilla">
      <div>
        <a class="ta-logo ta-logo--pie" href="<?php echo esc_url(home_url('/')); ?>">
          <span class="ta-logo__marca" aria-hidden="true">
            <svg viewBox="0 0 32 32" width="28" height="28" role="img" aria-hidden="true" focusable="false">
              <circle cx="16" cy="16" r="15" fill="none" stroke="currentColor" stroke-width="2"></circle>
              <path d="M9 16.5l4.2 4.2L23 11" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </span>
          <span class="ta-logo__texto">TachoAviso</span>
        </a>
        <p class="ta-pie__aviso">
          TachoAviso ayuda a recordar fechas. No sustituye al asesoramiento legal ni garantiza
          el cumplimiento normativo.
        </p>
      </div>

      <nav aria-label="Enlaces legales">
        <h2 class="ta-pie__titulo">Legal</h2>
        <a href="<?php echo esc_url(tachoaviso_url_pagina('privacidad')); ?>">Privacidad</a>
        <a href="<?php echo esc_url(tachoaviso_url_pagina('cookies')); ?>">Cookies</a>
        <a href="<?php echo esc_url(tachoaviso_url_pagina('terminos')); ?>">Términos</a>
      </nav>

      <div>
        <h2 class="ta-pie__titulo">Contacto</h2>
        <a href="mailto:hola@tachoaviso.es">hola@tachoaviso.es</a>
        <p class="ta-pie__aviso">Bahía de Algeciras · Campo de Gibraltar</p>
      </div>
    </div>
    <div class="ta-contenedor ta-pie__base">
      <p>© <?php echo esc_html(date_i18n('Y')); ?> TachoAviso. Proyecto de Javier Jiménez Alonso.</p>
    </div>
  </footer>
</div>
