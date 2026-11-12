# TachoAviso

Prototipo del proyecto intermodular: una aplicación web para que un transportista
autónomo o una microflota no pierda los vencimientos legales del camión
(tacógrafo, ITV, seguro y tarjeta del conductor).

Está construido como **plugin de WordPress** (PHP + JavaScript + MySQL/MariaDB) y
lleva dentro una **demo estática** para enseñar la landing y el panel sin instalar
WordPress.

## Qué hay en esta carpeta

```
TachoAviso/
├── tachoaviso.php          Arranque del plugin: constantes, requires y hooks
├── uninstall.php           Borrado opcional de tablas y ajustes
├── includes/
│   ├── config.php          Todos los parámetros del negocio y de la aplicación
│   ├── vencimientos.php    Cálculo de fechas, días restantes y semáforo
│   ├── seguridad.php       Nonces, permisos y validación de datos
│   ├── base-datos.php      Consultas con $wpdb (vehículos, conductores, avisos)
│   ├── activacion.php      Tablas, rol y tarea programada al activar
│   ├── avisos.php          Envío de correos y tarea diaria
│   ├── acciones.php        Formularios de admin-post.php y exportación CSV
│   └── shortcodes.php      Shortcodes, assets y datos para JavaScript
├── admin/
│   ├── menu.php            Menú del escritorio de WordPress
│   └── vistas/             Vista global de vencimientos y ajustes de avisos
├── plantillas/
│   ├── landing.php         Página pública
│   ├── acceso.php          Entrar y crear cuenta
│   ├── panel.php           Panel privado con tabla, filtros y diálogos
│   └── legales/            Privacidad, cookies y términos
├── assets/
│   ├── css/                base.css, landing.css y panel.css
│   ├── js/                 config.js, validacion.js, panel.js y landing.js
│   └── img/                Favicon e imágenes
├── sql/
│   └── esquema.sql         Cuatro tablas con {prefix} y {charset}
├── prototipo/
│   ├── demo.js             Datos de ejemplo con fechas relativas a hoy
│   ├── index.html          Landing navegable
│   ├── acceso.html         Entrar / crear cuenta
│   ├── panel.html          Panel con las seis filas de ejemplo
│   └── legal.html          Los tres documentos legales
├── docs/
│   └── parametros.md       Correspondencia PHP ↔ JavaScript ↔ CSS
└── README.md
```

## Ver la demo sin WordPress

Desde esta carpeta:

```powershell
C:\xampp\php\php.exe -S 127.0.0.1:8131 -t .
```

Y abrir <http://127.0.0.1:8131/prototipo/>. También se puede abrir
`prototipo/index.html` haciendo doble clic: no hace ninguna petición al servidor.

La demo:

- genera las fechas respecto al día en que se abre, así que el semáforo siempre
  tiene un vencimiento rojo, uno ámbar y uno verde;
- filtra por estado, por texto y por trámite;
- abre los diálogos y calcula la fecha antes de guardar;
- simula el alta de un vencimiento y el botón «Marcar hecho»;
- **no guarda nada**: al recargar vuelven las seis filas de ejemplo.

## Instalar en WordPress

1. Copiar la carpeta `TachoAviso` dentro de `wp-content/plugins/`.
2. Activar el plugin en el escritorio. La activación crea las cuatro tablas, el
   rol `transportista`, el permiso `manage_tachoaviso` y la tarea diaria.
3. Crear estas páginas y ponerles el shortcode correspondiente:

   | Página      | Slug         | Shortcode              |
   |-------------|--------------|------------------------|
   | Inicio      | `inicio`     | `[tachoaviso_landing]` |
   | Acceso      | `acceso`     | `[tachoaviso_acceso]`  |
   | Panel       | `panel`      | `[tachoaviso_panel]`   |
   | Privacidad  | `privacidad` | Texto legal            |
   | Cookies     | `cookies`    | Texto legal            |
   | Términos    | `terminos`   | Texto legal            |

4. Usar una plantilla a ancho completo en Inicio y Panel, para que la cabecera
   del tema no se duplique con la de TachoAviso.
5. Ir a **TachoAviso → Ajustes** y revisar el correo del remitente y la hora del
   envío. El correo debe existir en el dominio y estar autorizado por el hosting.

Las plantillas legales están en `plantillas/legales/`; para publicarlas se puede
copiar su contenido en las páginas de WordPress o incluirlas desde una plantilla
del tema.

## Qué hace el plugin

- **Vehículos:** matrícula, alias y marca. Límite de 3 (plan Autónomo) o 10
  (Microflota).
- **Conductores:** solo un alias. No se guardan nombres reales, DNI ni teléfonos.
- **Vencimientos:** se guarda la fecha de la última revisión y el intervalo; el
  plugin calcula la fecha final. Un vencimiento se puede cerrar con «Marcar
  hecho», que desactiva la fila actual y crea la siguiente.
- **Panel:** tabla ordenada por urgencia, resumen por colores, filtros por estado,
  búsqueda, filtro por trámite y exportación a CSV.
- **Avisos:** tarea diaria que envía **solo el aviso más urgente que toca** (30,
  15 o 7 días, configurable) y anota el envío para no repetirlo.
- **Legal:** páginas de privacidad, cookies y términos coherentes con los datos
  que realmente se guardan.

## Reglas de cálculo

| Trámite                    | Días |
|----------------------------|------|
| Tarjeta del conductor      | 28   |
| Tarjeta G2V2               | 56   |
| Unidad del vehículo        | 90   |
| ITV                        | 365  |
| Seguro                     | 365  |

El semáforo se decide por los días que faltan:

| Color  | Días restantes        |
|--------|-----------------------|
| Rojo   | 7 o menos, o vencido  |
| Ámbar  | de 8 a 30             |
| Verde  | 31 o más              |

Todos estos valores están en `includes/config.php`. El JavaScript recibe una
copia en `TachoAvisoDatos` y el CSS tiene sus propios tokens; el detalle de la
correspondencia está en [`docs/parametros.md`](docs/parametros.md).

## Base de datos

Cuatro tablas con el prefijo de WordPress:

- `ta_vehiculos`: matrícula, alias, marca y estado.
- `ta_conductores`: alias y vehículo habitual.
- `ta_vencimientos`: tipo, fecha de referencia, intervalo, fecha calculada y notas.
- `ta_avisos`: vencimiento, antelación y fecha de envío.

Todas las consultas filtran por `usuario_id`, así que un transportista nunca ve
los datos de otro. El esquema está en `sql/esquema.sql`.

## Decisiones y límites

- El MVP **no** incluye GPS, telemetría, descarga automática del tacógrafo, pagos,
  facturación, multiempresa ni app móvil.
- La demo estática no persiste datos. Es una maqueta navegable, no el producto.
- Los textos legales son borradores de trabajo y hay que revisarlos antes de
  publicar.
- Los avisos dependen de que el hosting ejecute las tareas programadas de
  WordPress y de que el correo salga del dominio.
- El plan se controla por número de vehículos; no hay pasarela de pago en este
  prototipo.

## Verificación hecha

- `php -l` sobre todos los archivos PHP: sin errores de sintaxis.
- Demo servida con PHP y probada con un navegador headless: seis filas, resumen
  6/2/2/2, filtros, búsqueda, diálogos, alta simulada y «Marcar hecho» sin errores
  de JavaScript.
- Las cuatro páginas pasan el validador HTML del W3C (Nu) sin mensajes.
- Sin desbordamiento horizontal a 360 px en landing, acceso, panel y legal.
