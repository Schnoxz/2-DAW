/*
 * TachoAviso · panel privado
 *
 * Filtra la tabla por estado, texto y trámite, mantiene el resumen arriba,
 * abre los diálogos y, en la demo estática, simula el alta y el cierre de un
 * vencimiento. En WordPress los formularios se envían a admin-post.php y el
 * servidor vuelve a calcularlo todo.
 */

(function () {
  'use strict';

  var T = window.TachoAviso || {};
  var config = T.config || {};
  var filas = [];
  var filtroEstado = 'todos';
  var filtroTexto = '';
  var filtroTipo = '';

  function buscar(selector, contexto) {
    return (contexto || document).querySelector(selector);
  }

  function buscarTodos(selector, contexto) {
    return Array.prototype.slice.call((contexto || document).querySelectorAll(selector));
  }

  function textoMinusculas(valor) {
    return String(valor || '').toLowerCase().replace(/\s+/g, ' ').trim();
  }

  /* ---------- Filtros y resumen ---------- */

  function aplicarFiltros() {
    var visibles = 0;

    for (var i = 0; i < filas.length; i++) {
      var fila = filas[i];
      var estado = fila.getAttribute('data-estado');
      var tipo = fila.getAttribute('data-tipo');
      var texto = fila.getAttribute('data-buscar') || '';
      var coincide = true;

      if (filtroEstado !== 'todos' && estado !== filtroEstado) {
        coincide = false;
      }

      if (filtroTipo !== '' && tipo !== filtroTipo) {
        coincide = false;
      }

      if (filtroTexto !== '' && texto.indexOf(filtroTexto) === -1) {
        coincide = false;
      }

      // El atributo hidden esconde la fila sin sacarla del documento, así no
      // se pierde el orden ni hay que volver a pintar la tabla entera.
      fila.hidden = !coincide;

      if (coincide) {
        visibles++;
      }
    }

    var sinResultados = buscar('[data-sin-resultados]');

    // Si la tabla está vacía de verdad, ya lo dice el mensaje de la propia
    // tabla; el aviso de filtro solo tiene sentido cuando hay filas ocultas.
    if (sinResultados) {
      sinResultados.hidden = filas.length === 0 || visibles > 0;
    }
  }

  function actualizarResumen() {
    var conteo = { total: 0, rojo: 0, ambar: 0, verde: 0 };

    for (var i = 0; i < filas.length; i++) {
      var dias = Number(filas[i].getAttribute('data-dias'));
      var estado = filas[i].getAttribute('data-estado');

      if (isNaN(dias)) {
        continue;
      }

      // Se vuelve a clasificar con la misma función que usa el servidor para
      // que el resumen no se desincronice al añadir una fila en la demo.
      if (T.estadoSemaforo) {
        estado = T.estadoSemaforo(dias);
      }

      conteo.total++;

      if (typeof conteo[estado] === 'number') {
        conteo[estado]++;
      }
    }

    for (var clave in conteo) {
      if (!Object.prototype.hasOwnProperty.call(conteo, clave)) {
        continue;
      }

      var salida = buscar('[data-resumen="' + clave + '"]');

      if (salida) {
        salida.textContent = conteo[clave];
      }
    }
  }

  function refrescar() {
    filas = buscarTodos('[data-tabla-vencimientos] [data-fila]');
    aplicarFiltros();
    actualizarResumen();
  }

  /* ---------- Avisos en pantalla ---------- */

  function avisar(mensaje, tipo) {
    var caja = buscar('[data-aviso-panel]') || buscar('.ta-panel__contenido > .ta-aviso');

    if (!caja) {
      caja = document.createElement('div');
      caja.setAttribute('data-aviso-panel', '');
      caja.setAttribute('role', 'status');

      var contenido = buscar('.ta-panel__contenido');
      var cabecera = buscar('.ta-panel__cabecera');

      if (contenido && cabecera && cabecera.nextSibling) {
        contenido.insertBefore(caja, cabecera.nextSibling);
      } else if (contenido) {
        contenido.appendChild(caja);
      }
    }

    caja.className = 'ta-aviso ta-aviso--' + (tipo === 'error' ? 'error' : 'ok');
    caja.textContent = mensaje;
    caja.hidden = false;
  }

  /* ---------- Diálogos ---------- */

  function abrirDialogo(id) {
    var dialogo = document.getElementById(id);

    if (!dialogo) {
      return;
    }

    if (typeof dialogo.showModal === 'function') {
      dialogo.showModal();
    } else {
      dialogo.setAttribute('open', 'open');
    }
  }

  function cerrarDialogo(dialogo) {
    if (!dialogo) {
      return;
    }

    if (typeof dialogo.close === 'function' && dialogo.open) {
      dialogo.close();
    } else {
      dialogo.removeAttribute('open');
    }
  }

  /* ---------- Previsualización del cálculo ---------- */

  function actualizarPrevisualizacion() {
    var tipo = buscar('[data-tipo-vencimiento]');
    var fecha = buscar('#ta-fecha-nuevo');
    var intervalo = buscar('#ta-intervalo-nuevo');
    var salida = buscar('[data-previsualizacion]');

    if (!tipo || !fecha || !intervalo || !salida || !T.sumarDias) {
      return;
    }

    var dias = Number(intervalo.value);
    var vence = T.sumarDias(fecha.value, dias);

    if (!vence) {
      salida.textContent = '';
      return;
    }

    var restantes = T.diasRestantes(vence);

    // La previsualización evita guardar una fecha sin haberla entendido.
    salida.textContent = 'Vencerá el ' + T.formatearFecha(vence) + ' (' + T.textoEstado(restantes).toLowerCase() + ').';
  }

  function rellenarIntervalo() {
    var tipo = buscar('[data-tipo-vencimiento]');
    var intervalo = buscar('#ta-intervalo-nuevo');

    if (!tipo || !intervalo || !T.intervaloPlazo) {
      return;
    }

    intervalo.value = T.intervaloPlazo(tipo.value);
    actualizarPrevisualizacion();
  }

  /* ---------- Crear una fila (solo demo) ---------- */

  function crearCelda(etiqueta) {
    var celda = document.createElement('td');
    celda.setAttribute('data-etiqueta', etiqueta);

    return celda;
  }

  function crearFila(datos) {
    var dias = T.diasRestantes(datos.fecha_vencimiento);
    var estado = T.estadoSemaforo(dias);
    var etiqueta = T.etiquetaPlazo(datos.tipo);
    var aliasVehiculo = datos.vehiculo_alias || datos.matricula || 'Sin vehículo';
    var conductor = datos.conductor_alias || '—';

    var fila = document.createElement('tr');
    fila.setAttribute('data-fila', '');
    fila.setAttribute('data-estado', estado);
    fila.setAttribute('data-tipo', datos.tipo);
    fila.setAttribute('data-dias', dias);
    fila.setAttribute('data-buscar', textoMinusculas(datos.matricula + ' ' + aliasVehiculo + ' ' + conductor + ' ' + etiqueta));

    var celdaEstado = crearCelda('Estado');
    var insignia = document.createElement('span');
    insignia.className = 'ta-badge ta-badge--' + estado;
    var punto = document.createElement('span');
    punto.className = 'ta-badge__punto';
    punto.setAttribute('aria-hidden', 'true');
    insignia.appendChild(punto);
    insignia.appendChild(document.createTextNode(T.textoEstado(dias)));
    celdaEstado.appendChild(insignia);

    var celdaVehiculo = crearCelda('Vehículo');
    var nombreVehiculo = document.createElement('strong');
    nombreVehiculo.textContent = aliasVehiculo;
    celdaVehiculo.appendChild(nombreVehiculo);

    if (datos.matricula) {
      var matricula = document.createElement('span');
      matricula.className = 'ta-tabla__secundario';
      matricula.textContent = datos.matricula;
      celdaVehiculo.appendChild(matricula);
    }

    var celdaConductor = crearCelda('Conductor');
    celdaConductor.textContent = conductor;

    var celdaTramite = crearCelda('Trámite');
    celdaTramite.textContent = etiqueta;

    var celdaVence = crearCelda('Vence');
    celdaVence.textContent = T.formatearFecha(datos.fecha_vencimiento);

    var celdaDias = crearCelda('Días');
    var numeroDias = document.createElement('strong');
    numeroDias.textContent = dias;
    celdaDias.appendChild(numeroDias);

    var celdaAcciones = crearCelda('Acciones');
    var formulario = document.createElement('form');
    formulario.setAttribute('data-confirmar', '¿Marcar este trámite como hecho? Se calculará la siguiente fecha.');
    formulario.setAttribute('method', 'post');
    formulario.setAttribute('action', config.urls ? config.urls.adminPost : '');

    var campos = {
      action: 'tachoaviso_accion',
      accion: 'marcar_hecho',
      vencimiento_id: String(datos.id || 'demo')
    };

    for (var nombre in campos) {
      if (!Object.prototype.hasOwnProperty.call(campos, nombre)) {
        continue;
      }

      var oculto = document.createElement('input');
      oculto.type = 'hidden';
      oculto.name = nombre;
      oculto.value = campos[nombre];
      formulario.appendChild(oculto);
    }

    var boton = document.createElement('button');
    boton.type = 'submit';
    boton.className = 'ta-boton ta-boton--pequeno';
    boton.textContent = 'Marcar hecho';
    formulario.appendChild(boton);
    celdaAcciones.appendChild(formulario);

    fila.appendChild(celdaEstado);
    fila.appendChild(celdaVehiculo);
    fila.appendChild(celdaConductor);
    fila.appendChild(celdaTramite);
    fila.appendChild(celdaVence);
    fila.appendChild(celdaDias);
    fila.appendChild(celdaAcciones);

    return fila;
  }

  function insertarFila(fila) {
    var cuerpo = buscar('[data-tabla-vencimientos]');

    if (!cuerpo) {
      return;
    }

    var vacia = cuerpo.querySelector('.ta-tabla__vacia');

    if (vacia) {
      cuerpo.removeChild(vacia);
    }

    var diasNuevos = Number(fila.getAttribute('data-dias'));
    var hermanas = buscarTodos('[data-fila]', cuerpo);
    var referencia = null;

    // La tabla va de lo más urgente a lo más lejano, igual que en el servidor.
    for (var i = 0; i < hermanas.length; i++) {
      if (Number(hermanas[i].getAttribute('data-dias')) > diasNuevos) {
        referencia = hermanas[i];
        break;
      }
    }

    cuerpo.insertBefore(fila, referencia);
  }

  function pintarDemo() {
    var datos = window.TachoAvisoDatos || {};
    var cuerpo = buscar('[data-tabla-vencimientos]');

    if (!config.demo || !cuerpo || !datos.vencimientos || buscarTodos('[data-fila]', cuerpo).length > 0) {
      return;
    }

    for (var i = 0; i < datos.vencimientos.length; i++) {
      insertarFila(crearFila(datos.vencimientos[i]));
    }
  }

  /* ---------- Envío de formularios ---------- */

  function crearVencimientoDesdeFormulario(formulario) {
    var tipo = formulario.querySelector('[name="tipo"]');
    var fecha = formulario.querySelector('[name="fecha_referencia"]');
    var intervalo = formulario.querySelector('[name="intervalo_dias"]');
    var vehiculo = formulario.querySelector('[name="vehiculo_id"]');
    var conductor = formulario.querySelector('[name="conductor_id"]');

    if (!tipo || !fecha || !intervalo) {
      return null;
    }

    var dias = Number(intervalo.value) || T.intervaloPlazo(tipo.value);
    var vencimiento = T.sumarDias(fecha.value, dias);
    var textoVehiculo = vehiculo && vehiculo.value !== '0'
      ? vehiculo.options[vehiculo.selectedIndex].textContent.split('·')
      : [];
    var aliasVehiculo = textoVehiculo.length > 0 ? textoVehiculo[0].trim() : '';
    var matricula = textoVehiculo.length > 1 ? textoVehiculo[1].trim() : '';

    return {
      id: 'demo-' + Date.now(),
      tipo: tipo.value,
      matricula: matricula,
      vehiculo_alias: aliasVehiculo,
      conductor_alias: conductor && conductor.value !== '0' ? conductor.options[conductor.selectedIndex].textContent.trim() : '',
      fecha_referencia: fecha.value,
      fecha_vencimiento: vencimiento,
      notas: ''
    };
  }

  function manejarEnvio(evento) {
    var formulario = evento.currentTarget;

    // validacion.js se ejecuta antes y ya ha bloqueado el envío si algo falla.
    if (evento.defaultPrevented) {
      return;
    }

    var confirmacion = formulario.getAttribute('data-confirmar');

    if (confirmacion && !window.confirm(confirmacion)) {
      evento.preventDefault();
      return;
    }

    if (!config.demo) {
      return;
    }

    // A partir de aquí todo es simulación: no hay servidor que reciba el POST.
    evento.preventDefault();

    var accion = formulario.querySelector('[name="accion"]');
    var nombreAccion = accion ? accion.value : '';

    if (nombreAccion === 'marcar_hecho') {
      var fila = formulario.parentNode ? formulario.parentNode.parentNode : null;

      if (fila && fila.hasAttribute('data-fila') && fila.parentNode) {
        fila.parentNode.removeChild(fila);
      }

      refrescar();
      avisar('Trámite marcado como hecho. En la versión real se calcularía la siguiente fecha.', 'ok');
      return;
    }

    if (nombreAccion === 'guardar_vencimiento') {
      var datos = crearVencimientoDesdeFormulario(formulario);

      if (datos && datos.fecha_vencimiento) {
        insertarFila(crearFila(datos));
        refrescar();
        avisar('Vencimiento calculado y guardado. En la demo desaparece al recargar.', 'ok');
      }

      cerrarDialogo(formulario.closest('dialog'));
      formulario.reset();
      rellenarIntervalo();
      return;
    }

    if (nombreAccion === 'guardar_vehiculo') {
      cerrarDialogo(formulario.closest('dialog'));
      avisar('Vehículo guardado. En la demo no se conserva porque no hay base de datos.', 'ok');
      return;
    }

    if (nombreAccion === 'guardar_conductor') {
      cerrarDialogo(formulario.closest('dialog'));
      avisar('Conductor guardado con alias. En la demo no se conserva.', 'ok');
      return;
    }

    avisar('Ajustes guardados. En la demo no se conservan al recargar.', 'ok');
  }

  /* ---------- Arranque ---------- */

  function iniciarFiltros() {
    var chips = buscarTodos('[data-filtro]');

    for (var i = 0; i < chips.length; i++) {
      chips[i].addEventListener('click', function () {
        filtroEstado = this.getAttribute('data-filtro') || 'todos';

        for (var j = 0; j < chips.length; j++) {
          var activo = chips[j] === this;
          chips[j].classList.toggle('ta-chip--activo', activo);
          chips[j].setAttribute('aria-pressed', activo ? 'true' : 'false');
        }

        aplicarFiltros();
      });
    }

    var campoBuscar = buscar('[data-buscar]');

    if (campoBuscar) {
      campoBuscar.addEventListener('input', function () {
        filtroTexto = textoMinusculas(this.value);
        aplicarFiltros();
      });
    }

    var campoTipo = buscar('[data-filtro-tipo]');

    if (campoTipo) {
      campoTipo.addEventListener('change', function () {
        filtroTipo = this.value;
        aplicarFiltros();
      });
    }
  }

  function iniciarDialogos() {
    var abridores = buscarTodos('[data-abrir-dialogo]');

    for (var i = 0; i < abridores.length; i++) {
      abridores[i].addEventListener('click', function () {
        abrirDialogo(this.getAttribute('data-abrir-dialogo'));
      });
    }

    var cerradores = buscarTodos('[data-cerrar-dialogo]');

    for (var j = 0; j < cerradores.length; j++) {
      cerradores[j].addEventListener('click', function () {
        cerrarDialogo(this.closest('dialog'));
      });
    }

    var dialogos = buscarTodos('dialog.ta-dialogo');

    for (var k = 0; k < dialogos.length; k++) {
      // Cerrar al pulsar el fondo, pero no al pulsar dentro del formulario.
      dialogos[k].addEventListener('click', function (evento) {
        if (evento.target === this) {
          cerrarDialogo(this);
        }
      });
    }
  }

  function iniciarFormularios() {
    var formularios = buscarTodos('.ta-panel form');

    for (var i = 0; i < formularios.length; i++) {
      formularios[i].addEventListener('submit', manejarEnvio);
    }
  }

  function iniciarCalculo() {
    var tipo = buscar('[data-tipo-vencimiento]');
    var fecha = buscar('#ta-fecha-nuevo');
    var intervalo = buscar('#ta-intervalo-nuevo');

    if (tipo) {
      tipo.addEventListener('change', rellenarIntervalo);
    }

    if (fecha) {
      fecha.addEventListener('change', actualizarPrevisualizacion);
    }

    if (intervalo) {
      intervalo.addEventListener('input', actualizarPrevisualizacion);
    }
  }

  function iniciar() {
    pintarDemo();
    refrescar();
    iniciarFiltros();
    iniciarDialogos();
    iniciarFormularios();
    iniciarCalculo();
    rellenarIntervalo();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', iniciar);
  } else {
    iniciar();
  }
})();
