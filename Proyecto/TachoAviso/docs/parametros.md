# Parámetros de TachoAviso

Este documento explica dónde vive cada dato configurable y cómo viaja desde PHP
hasta el navegador y hasta el CSS. La idea es que un cambio de plazo, de color o
de precio no obligue a buscar números repartidos por el código.

## El recorrido de un parámetro

```
includes/config.php
   tachoaviso_config()
        │
        ├── plantillas/*.php        Lo usan directamente al pintar
        │
        └── includes/shortcodes.php
               tachoaviso_datos_js()
                    │
                    └── wp_localize_script(..., 'TachoAvisoDatos', ...)
                             │
                             ├── assets/js/config.js   window.TachoAviso.config
                             └── assets/js/panel.js    filtros, resumen, diálogos
```

En la demo estática no hay WordPress: `prototipo/demo.js` define el mismo objeto
`window.TachoAvisoDatos` antes de cargar `config.js`. Por eso el panel de la demo
y el panel real calculan igual.

## Plazos legales

Están en `config.php`, dentro de `plazos`. Cada trámite tiene etiqueta, días y
norma de referencia.

| Clave PHP / JS           | Etiqueta visible              | Días | Norma                    |
|--------------------------|-------------------------------|------|--------------------------|
| `tarjeta_conductor`      | Tarjeta del conductor         | 28   | Reglamento (UE) 165/2014 |
| `tarjeta_conductor_g2v2` | Tarjeta del conductor (G2V2)  | 56   | Reglamento (UE) 2016/799 |
| `unidad_vehiculo`        | Unidad del vehículo           | 90   | Reglamento (UE) 165/2014 |
| `itv`                    | ITV                           | 365  | Real Decreto 920/2017    |
| `seguro`                 | Seguro                        | 365  | Ley 50/1980              |

- En PHP se leen con `tachoaviso_plazo($tipo)`.
- En JavaScript llegan como lista `TachoAvisoDatos.plazos` y se consultan con
  `TachoAviso.etiquetaPlazo()` y `TachoAviso.intervaloPlazo()`.
- El selector «Trámite» del diálogo pinta una opción por cada plazo y guarda los
  días en `data-dias`. Al cambiar de trámite, `panel.js` rellena el intervalo.

## Avisos por correo

| Parámetro            | Clave PHP                  | Valor por defecto        | Dónde se usa                         |
|----------------------|----------------------------|--------------------------|--------------------------------------|
| Antelaciones         | `avisos.antelaciones`      | `[7, 15, 30]`            | Tarea diaria y ajustes del usuario   |
| Hora del envío       | `avisos.hora`              | `8`                      | Programación de la tarea             |
| Remitente            | `avisos.remitente`         | `avisos@tachoaviso.es`   | Cabecera `From` de `wp_mail`         |
| Nombre del remitente | `avisos.nombre_remitente`  | `TachoAviso`             | Cabecera `From`                      |
| Asunto               | `avisos.asunto`            | `[TachoAviso] %s vence el %s` | Asunto del correo               |
| Tarea programada     | `avisos.cron`              | `tachoaviso_revisar_avisos` | `wp_schedule_event`               |
| Frecuencia           | `avisos.frecuencia`        | `daily`                  | `wp_schedule_event`                  |

Las antelaciones, la hora y el remitente se pueden sobrescribir desde
**TachoAviso → Ajustes** (opciones `tachoaviso_antelaciones`,
`tachoaviso_remitente` y `tachoaviso_hora`). `config.php` lee esas opciones y
devuelve los valores ya resueltos.

`tachoaviso_antelaciones()` ordena los días de menor a mayor. El bucle de avisos
recorre esa lista y envía **solo la primera antelación que ya toca**: si quedan 6
días, manda el aviso de 7 y no los de 15 y 30.

## Semáforo

| Clave PHP / JS | Valor | Significado                                  |
|----------------|-------|----------------------------------------------|
| `rojo_hasta`   | 7     | De 7 días o menos, y cualquier fecha pasada  |
| `ambar_desde`  | 8     | Primer día del tramo ámbar                   |
| `verde_desde`  | 31    | Primer día del tramo verde                   |

La función que decide es la misma en los dos lados:

- PHP: `tachoaviso_estado_semaforo($dias)` en `includes/vencimientos.php`.
- JavaScript: `TachoAviso.estadoSemaforo($dias)` en `assets/js/config.js`.

Los nombres de estado (`rojo`, `ambar`, `verde`) se usan como clases CSS:

| Estado  | Insignia            | Punto            | Resumen                   |
|---------|---------------------|------------------|---------------------------|
| `rojo`  | `.ta-badge--rojo`   | `.ta-punto--rojo`  | `.ta-resumen__dato--rojo`  |
| `ambar` | `.ta-badge--ambar`  | `.ta-punto--ambar` | `.ta-resumen__dato--ambar` |
| `verde` | `.ta-badge--verde`  | `.ta-punto--verde` | `.ta-resumen__dato--verde` |

Si se cambia un límite en PHP hay que cambiarlo también en
`prototipo/demo.js` (bloque `semaforo`) para que la demo siga enseñando lo mismo.

## Límites y precios

| Parámetro               | Clave PHP               | Valor |
|-------------------------|-------------------------|-------|
| Vehículos plan Autónomo | `limites.autonomo`      | 3     |
| Vehículos plan Microflota | `limites.microflota`  | 10    |
| Conductores por cuenta  | `limites.conductores`   | 10    |
| Altas por día           | `limites.altas_por_dia` | 20    |
| Precio Autónomo         | `precios.autonomo`      | 4 €/mes |
| Precio Microflota       | `precios.microflota`    | 6 €/mes |
| Moneda                  | `precios.moneda`        | `EUR` |
| IVA                     | `precios.iva`           | 21 %  |

El límite se comprueba en `tachoaviso_accion_guardar_vehiculo()` antes de
insertar. Los precios se pintan en la landing con `tachoaviso_config('precios')`.
No hay pasarela de pago en el MVP: el precio es informativo.

## Exportación CSV

| Parámetro     | Clave PHP         | Valor                    |
|---------------|-------------------|--------------------------|
| Separador     | `csv.separador`   | `;`                      |
| Delimitador   | `csv.delimitador` | `"`                      |
| Codificación  | `csv.codificacion`| `UTF-8`                  |
| Nombre        | `csv.nombre`      | `tachoaviso-vencimientos.csv` |

El archivo se genera en `tachoaviso_exportar_csv()` y empieza con BOM para que
Excel abra bien las tildes. Se descarga desde
`admin-post.php?action=tachoaviso_exportar` con nonce.

## Páginas y slugs

`config.php` guarda los slugs en `paginas`. `tachoaviso_url_pagina($clave)`
devuelve el permalink y, si la página no existe, la portada. Así las plantillas no
llevan rutas escritas a mano.

| Clave        | Slug         |
|--------------|--------------|
| `panel`      | `panel`      |
| `acceso`     | `acceso`     |
| `registro`   | `registro`   |
| `privacidad` | `privacidad` |
| `cookies`    | `cookies`    |
| `terminos`   | `terminos`   |

En la demo estática estas claves se sustituyen por `panel.html`,
`acceso.html#ta-registro` y `legal.html#...`.

## Tokens de CSS

Los valores visuales están en `assets/css/base.css`, dentro de `:root`. Los demás
archivos usan `var(--ta-...)`, nunca el color a pelo.

| Variable                | Valor       | Para qué                          |
|-------------------------|-------------|-----------------------------------|
| `--ta-fondo`            | `#f4f6f8`   | Fondo general del panel           |
| `--ta-superficie`       | `#ffffff`   | Tarjetas, tablas y diálogos       |
| `--ta-superficie-alt`   | `#eef2f5`   | Filas alternas y pies de tarjeta  |
| `--ta-texto`            | `#14212e`   | Texto principal                   |
| `--ta-texto-suave`      | `#56677a`   | Texto secundario                  |
| `--ta-borde`            | `#dbe2e8`   | Bordes suaves                     |
| `--ta-borde-fuerte`     | `#b9c6d1`   | Bordes de campos y botones        |
| `--ta-primario`         | `#123a5c`   | Azul marino de marca              |
| `--ta-primario-hover`   | `#0c2b45`   | Azul marino al pasar el ratón     |
| `--ta-primario-suave`   | `#e4edf4`   | Fondos de aviso y hover suave     |
| `--ta-acento`           | `#e9a13b`   | Ámbar de la marca y del foco      |
| `--ta-verde`            | `#1d7a53`   | Semáforo verde                    |
| `--ta-verde-suave`      | `#e3f3ea`   | Fondo de insignia verde           |
| `--ta-ambar`            | `#8a5a0b`   | Texto ámbar con contraste         |
| `--ta-ambar-suave`      | `#fbf0d9`   | Fondo de insignia ámbar           |
| `--ta-rojo`             | `#a93226`   | Semáforo rojo                     |
| `--ta-rojo-suave`       | `#fbe5e2`   | Fondo de insignia roja            |
| `--ta-radio`            | `14px`      | Tarjetas y paneles                |
| `--ta-radio-pequeno`    | `9px`       | Botones, campos e insignias       |
| `--ta-sombra`           | `0 10px 30px rgba(20,33,46,.08)` | Tarjetas         |
| `--ta-sombra-fuerte`    | `0 18px 50px rgba(20,33,46,.14)` | Diálogos         |
| `--ta-ancho`            | `1120px`    | Ancho máximo de la landing        |
| `--ta-fuente`           | sistema     | Tipografía sin fuentes externas   |

Los espaciados (`--ta-espacio-1` a `--ta-espacio-7`) solo se usan para separar
bloques; no representan ninguna regla del negocio.

## Regla para cambiar un parámetro

1. Se cambia primero en `includes/config.php`.
2. Si afecta a la demo, se copia el mismo valor en `prototipo/demo.js`.
3. Se actualiza este documento si el nombre o el significado cambia.
4. El CSS solo se toca si cambia un color, un radio o un espaciado.
5. No se escriben números sueltos en las plantillas ni en `panel.js`.
