# Análisis de competencia — TachoTools

**Proyecto:** TachoAviso — Control de vencimientos legales para transportistas autónomos y microflotas
**Autor:** Javier Jimenez Alonso
**Módulo:** Proyecto Intermodular de Desarrollo de Aplicaciones Web (2.º DAW) · U1 · Hito 1
**Sitio analizado:** <https://tachotools.com/>
**Fecha del análisis:** 25/10/2026
**Método:** navegación real con navegador instrumentado (DOM en ejecución, cabeceras de respuesta, métricas de `Performance API`) + lectura de `robots.txt` y `sitemap.xml`. Auditoría **pasiva**: no se ha enviado ningún fichero `.DDD` ni se ha atacado el sitio.

---

## 1. Identificación

| Campo | Dato |
|---|---|
| Nombre comercial | TachoTools |
| URL | https://tachotools.com/ |
| Origen declarado | «Hecho en Barcelona, por gente del transporte» |
| Sector | Software de análisis de tacógrafo digital para transporte por carretera |
| Idiomas | Español (`/es/`), inglés (`/en/`), alemán (`/de/`), polaco (`/pl/`) |
| Contacto | `info@tachotools.com`, `support@tachotools.com` |
| Redes | Instagram, LinkedIn, canal de WhatsApp |
| Última modificación del HTML | 22/10/2026 (cabecera `last-modified`) |
| Estado aparente | Producto joven, en evolución («Dashboard 2.0» en desarrollo) |

**Relación con el proyecto propio:** competidor **directo en el nicho** (transportistas y flotas, tacógrafo digital, España) y **parcial en funcionalidad**: su producto analiza el pasado a partir de ficheros; TachoAviso avisa del futuro a partir de fechas. El solapamiento real está en el control de **plazos de descarga** de tarjeta y vehículo.

---

## 2. Modelo de negocio y precios

Estrategia *freemium* con imán de leads:

1. **Subir el archivo sin registro** → análisis gratuito y PDF inmediato («Sin tarjetas. Sin datos bancarios.»).
2. Creación de cuenta y recepción de credenciales.
3. Activación de la suscripción desde el panel privado.

| Plan | Precio declarado | Contenido (según su FAQ) |
|---|---|---|
| Custodio | **3 €/mes** | Subida, análisis y custodia/copia de los `.DDD` |
| Pyme Digital | **5 €/mes** | Añade gestión de varios conductores y vehículos |
| API Business | No publicado | Integración con ERP o software de nóminas |

Notas de modelo:

- Los ficheros de la modalidad gratuita **se eliminan a los 7 días**; en caso de impago hay **7 días de cortesía** para descargar y después borrado.
- Declaran expresamente que su «custodia legal» es **solo copia de seguridad**, no custodia con validez legal, y que devuelven el fichero sin verificar firma ni integridad. Es una salvedad legal bien redactada: conviene imitarla en TachoAviso.
- Tienen página **«Uso de IA»** dentro del aviso legal (transparencia sobre el tratamiento automatizado).

**Lectura para el informe:** existe alguien **cobrando** por resolver un problema de este nicho. Con las cifras que ellos declaran (+25 empresas), el volumen es pequeño, pero **valida la demanda** y el precio que el mercado tolera (3–5 €/mes).

---

## 3. Funcionalidades observadas

| # | Funcionalidad | Detalle |
|---|---|---|
| 1 | Análisis de ficheros | `.DDD` (tarjeta de conductor) y `.TGD` (unidad de vehículo) |
| 2 | Cobertura de generaciones | Tacógrafo 1.ª, 2.ª y 2.1 — Siemens VDO, Stoneridge e inteligente |
| 3 | Validación de firma digital | Comprueban la firma del fichero antes de analizarlo |
| 4 | Informe PDF | Listo para presentar en inspección |
| 5 | Panel de jornada | Actividad minuto a minuto contra el Reglamento (CE) 561/2006 |
| 6 | Infracciones cuantificadas | Gravedad (leve / grave / muy grave), minutos de exceso y **multa estimada**; lo no valorable se marca y no se suma |
| 7 | Ficha por conductor | Descansos reducidos, conducción continuada, trabajo nocturno, reparto de tiempos |
| 8 | Panel de flota | «Más de 40 indicadores»: **descargas fuera de plazo**, conductores sin fichero, excesos de velocidad, calibraciones a punto de caducar |
| 9 | Alertas de descarga | **Aviso cuando la descarga de la tarjeta va con retraso** |
| 10 | Internacional | Días por país y cruces de frontera; exportación **CSV** para obligaciones IMI |
| 11 | Multiusuario | Roles administrador, gestor y consulta; multiempresa para asesorías |
| 12 | Custodia / respaldo | Copia de los ficheros subidos mientras la suscripción esté activa |
| 13 | API | Integración con ERP y nóminas (plan superior) |

**Funcionalidades más demandadas que se deducen de su oferta** (para RA1.c):

1. Conversión del fichero técnico del tacógrafo en un **PDF comprensible** para inspección.
2. **Traducción de la infracción a dinero** (multa estimada) — es el argumento comercial más fuerte de la portada.
3. **Alertas de plazos de descarga** (28/56/90 días), que es justo el núcleo de TachoAviso.
4. **Custodia ordenada** de los ficheros para no perderlos.
5. **Acceso multiusuario** para asesorías y flotas.

---

## 4. Tecnología, rendimiento y SEO

| Aspecto | Medición | Valoración |
|---|---|---|
| Naturaleza | Sitio **estático** (HTML + jQuery 2.2.3 + Bootstrap 5.1.3) | Sin WordPress ni SPA: no es requisito de mercado usar WordPress |
| CDN / hosting | Fastly (`x-cache: HIT`, `alt-svc` HTTP/3) | Infraestructura profesional |
| TTFB | **19 ms** | Excelente |
| First Contentful Paint | **428 ms** | Excelente |
| `load` completo | **577 ms** | Excelente |
| Peticiones / peso | 29 peticiones · **627 KB** | Muy contenido |
| Imágenes | 9, todas con `alt`; 6 con `loading="lazy"`; con dimensiones declaradas | Buena práctica |
| SEO | `sitemap` index por idioma + **~20 landings** de cola larga (normativa, infracciones, dietas, ADR, laboral, formación, multiempresa, app) | Estrategia de contenido madura |
| Metadatos | `title`, `description`, Open Graph y Twitter Card correctos; `canonical`; `lang="es"` | Correcto |
| Accesibilidad | Enlace «Saltar al contenido», landmarks `nav`/`main`/`footer` | Mejorable: sin `<header>`, salto de encabezado `h2→h6`, 21 objetivos táctiles < 40 px, 1 rol ARIA sin nombre accesible |
| Analítica | Google Analytics 4 (`G-L5PQJHRHLY`) | Ver sección 5 |

**Benchmark útil:** su portada (627 KB / 577 ms) es una referencia razonable para el objetivo «diseñar una landing responsive y accesible» de TachoAviso.

---

## 5. Seguridad y protección de datos (auditoría pasiva)

| Severidad | Hallazgo | Evidencia | Impacto |
|---|---|---|---|
| 🔴 | **Cookies analíticas sin consentimiento** | `_ga` y `_ga_L5PQJHRHLY` se crean en la primera visita; no se detecta banner ni CMP en portada, precios ni subida; GA4 cargado directamente desde `googletagmanager.com` | Posible incumplimiento de LSSI-CE art. 22.2 y del criterio AEPD: cookies no exentas antes del consentimiento |
| 🔴 | **Sin Content-Security-Policy** y sin `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy` ni `Permissions-Policy` | Solo se devuelve `strict-transport-security: max-age=31556926` | Sin defensa en profundidad frente a XSS y clickjacking |
| 🟡 | **HSTS incompleto** | `max-age=31556926`, sin `includeSubDomains` ni `preload` | Subdominios no cubiertos |
| 🟡 | **jQuery 2.2.3 (2016)** | `jQuery.fn.jquery === "2.2.3"`; sin atributos `integrity` en los CDN | Versión con CVE documentadas: CVE-2019-11358 (*prototype pollution*), CVE-2020-11022 y CVE-2020-11023 (XSS en `htmlPrefilter`) |
| 🟡 | **Bootstrap 5.1.3** (2021) | `bootstrap.Tooltip.VERSION` | Versión por detrás de la rama actual (5.3.x); sin CVE críticas conocidas en esta rama |
| 🟡 | Formulario de subida sin token CSRF visible | `<form method="get">` con `input type="file"`, sin campo `csrf`/`token`; la subida real la gestiona `tachos.js` | **No verificable** sin enviar un fichero: se documenta como punto a comprobar, no como vulnerabilidad confirmada |
| 🟢 | Sin secretos en cliente | Sin claves de API ni tokens en código inline ni en `localStorage` (solo `lang`); `/sitemap.xml` y `/robots.txt` sin información sensible | Correcto |
| 🟢 | Transparencia | Página «Uso de IA» y salvedad sobre el alcance de su custodia | Buena práctica replicable |

**Uso en el informe:** TachoTools sirve como **contraejemplo** para justificar que TachoAviso implemente consentimiento previo real, política de cookies y cabeceras de seguridad, tal y como se promete en los objetivos del proyecto.

---

## 6. Comparativa TachoAviso vs. TachoTools

| Criterio | TachoTools | TachoAviso |
|---|---|---|
| Pregunta que responde | ¿Qué ha pasado ya en el tacógrafo y qué multa arriesgo? | ¿Qué plazo me vence y cuándo debo actuar? |
| Enfoque temporal | Retrospectivo (análisis de ficheros) | Preventivo (calendario de vencimientos) |
| Entrada de datos | Ficheros `.DDD` / `.TGD` | Fechas y alias (sin ficheros) |
| Datos personales | Ficheros de tarjeta de conductor alojados en su servidor | Minimizados: alias, sin nombres |
| Plazos cubiertos | Descargas 28/56/90 días, calibraciones | Descargas 28/56/90, **ITV, seguro, tarjeta de conductor** |
| Avisos | Panel y alertas de retraso | Email con antelación configurable (30/15/7 días) |
| Precio | Gratis con límites · 3–5 €/mes | MVP sin coste para el usuario; coste de explotación 66–132 €/año |
| Stack | HTML estático + jQuery | WordPress + PHP + JS (plugin a medida) |
| Multiusuario / API | Sí (planes superiores) | Fuera del MVP |
| Acceso sin registro | Sí (análisis gratuito) | Registro necesario |

**Conclusión clave:** no es un sustituto, es **complementario**. Un transportista puede usar TachoTools para el análisis del fichero y TachoAviso para no olvidar plazos. Eso reduce el riesgo de canibalización, pero **obliga a corregir el argumento de diferenciación** del documento de propuesta.

---

## 7. Conclusiones (para el informe)

1. **El nicho está validado y ya monetizado**, aunque con volúmenes pequeños: alguien cobra 3–5 €/mes por resolver problemas de este mismo colectivo.
2. **La sencillez, el idioma y el precio han dejado de ser diferenciadores**: el competidor es español, muy simple, rápido y barato. El documento de propuesta debe cambiar ese argumento (ver sección 8).
3. **El hueco real de TachoAviso es el enfoque preventivo con huella mínima de datos**: no requiere subir ficheros del tacógrafo y cubre plazos que TachoTools no toca (ITV, seguro, tarjeta).
4. **No conviene ampliar el MVP** hacia la lectura de `.DDD`: es su fortaleza y está fuera del alcance aprobado («descarga automática del tacógrafo» figura como fuera del MVP).
5. **El competidor es inmaduro**: declara «Dashboard 2.0» en desarrollo y mezcla mensajes de producto operativo con «contacta con soporte». Hay ventana de oportunidad, pero también poca tracción demostrable.
6. **Las cifras de marketing no son verificables** («+700 conductores/mes», «+25 empresas», «+3 TB», «Líderes en Europa»): en el informe deben citarse siempre como *«según declara el sitio»*.
7. **Su modelo de negocio gratuito sin registro** es una táctica de captación replicable en la landing pública de TachoAviso (por ejemplo, un análisis de demostración con datos ficticios, sin pedir cuenta).

---

## 8. Recomendaciones y cambios sugeridos en la propuesta

| Acción | Motivo |
|---|---|
| Añadir TachoTools al apartado de competencia del informe con la tabla de la sección 3 | Cubre RA1.a (clasificar empresas), RA1.c (necesidades más demandadas) y RA1.d (oportunidad de negocio) con evidencia real y fechada |
| **Reescribir la fila «Competencia» de RIESGOS**: sustituir «diferenciación por sencillez, idioma y precio» por «no requiere subir ficheros (huella RGPD mínima) + plazos no tacográficos (ITV, seguro, tarjeta)» | El argumento actual queda desmentido por este competidor |
| Mantener la lectura de `.DDD` fuera del MVP | Es su foso competitivo y no está en el alcance aprobado |
| Copiar el patrón de **landings de cola larga** para la landing pública | Su estrategia SEO es trasladable a un MVP con WordPress |
| Citar TachoTools como contraejemplo en el apartado de cookies y protección de datos | Justifica el banner de consentimiento y las cabeceras de seguridad prometidas en los objetivos |
| Imitar sus salvedades legales («no sustituye asesoramiento legal», «la custodia es un respaldo») | Reduce riesgo y a la vez es honesto con el usuario |

---

## 9. Limitaciones del análisis

- Auditoría **pasiva y externa**: no se ha probado la subida de ficheros ni el panel privado, por lo que el CSRF y la validación del lado servidor quedan **sin verificar**.
- Los precios provienen de la FAQ pública de su página de precios; pueden variar o no incluir impuestos.
- Las métricas de rendimiento se tomaron en una única carga desde una conexión concreta; sirven como orden de magnitud, no como medición de laboratorio.
- Las cifras de uso («+700 conductores/mes», «+25 empresas») son **declaraciones del propio sitio**, no datos auditados.

---

### Fuentes consultadas

- Portada: <https://tachotools.com/>
- Precios y FAQ: <https://tachotools.com/es/precios.html>
- Subida de ficheros: <https://tachotools.com/es/subir-tacografo.html>
- `robots.txt` y `sitemap.xml` del dominio
- Reglamento (CE) n.º 561/2006 (referenciado por el propio sitio para los tiempos de conducción y descanso)
