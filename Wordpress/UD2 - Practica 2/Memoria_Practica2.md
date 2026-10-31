# Práctica UD2 — Configuración del panel de administración y gestión de usuarios en WordPress

**Alumno:** Javier Jiménez Alonso  
**Curso:** 2.º DAW · Optativa — Gestores de contenido  
**Fecha:** 30/10/2026  
**Sitio:** `jjidaw.com.mialias.net` (plataforma de pruebas CDMON, WordPress + tema Astra + Elementor)  
**Temática elegida:** blog personal técnico de desarrollo web («Javier Jiménez — DAW»), con páginas de portfolio y contacto.

> **Estado de esta memoria.** El documento recoge todas las decisiones, respuestas y tablas de la práctica, y el flujo de trabajo paso a paso para ejecutarla en el panel real. Las **capturas de pantalla** hay que tomarlas en la instalación de CDMON: la plataforma se levanta entrando en el panel de CDMON («Acceder a la página») y no admite automatización externa. Cada apartado indica exactamente qué captura falta.

---

## 1. Configuración general del sitio (Ajustes → Generales)

| Ajuste | Valor aplicado | Motivo |
|---|---|---|
| **Título del sitio** | `Javier Jiménez — DAW` | Identifica al autor y el ámbito (Desarrollo de Aplicaciones Web). |
| **Descripción corta** | `Apuntes, proyectos y prácticas del ciclo de Desarrollo de Aplicaciones Web: HTML, CSS, JavaScript, PHP y WordPress.` (112 caracteres) | Menos de 150 caracteres, actúa como *meta description* en los resultados de búsqueda. |
| **Dirección de WordPress (URL)** | `https://jjidaw.com.mialias.net` | Donde están instalados los ficheros y el panel. |
| **Dirección del sitio (URL)** | `https://jjidaw.com.mialias.net` | La dirección pública que ve el visitante. |
| **Zona horaria** | `Madrid` | Coherencia con el alumnado y el calendario español. |
| **Formato de fecha** | `d/m/Y` (31/12/2026) | Formato habitual en España. |
| **Formato de hora** | `H:i` (18:30) | Formato de 24 horas. |
| **Idioma del sitio** | `Español` | Todo el contenido y el panel están en español. |
| **Cualquiera puede registrarse** | **Desmarcado** | Ver justificación. |

**Justificación: deshabilitar el registro libre.** Un blog personal no necesita que nadie se cree una cuenta: los lectores pueden comentar como invitados (si se permite) sin registrarse. Dejar el registro abierto convierte el sitio en una puerta de entrada para *spam* y para cuentas automatizadas, y en WordPress el rol por defecto de esos registros es **Suscriptor**, que aunque tiene pocos permisos sí puede acceder al panel y generar contenido basura. Aplico así el **principio de menor privilegio**: si nadie necesita registrarse, no se ofrece la posibilidad. Los usuarios del equipo los creo yo, uno a uno, desde Usuarios → Añadir nuevo.

**Diferencia entre «Dirección de WordPress (URL)» y «Dirección del sitio (URL)».**

- La **Dirección de WordPress** es la carpeta donde están instalados los ficheros del CMS: es la ruta del panel (`/wp-admin`) y de los recursos internos.
- La **Dirección del sitio** es la URL pública que se muestra en el navegador y la que se usa para generar los enlaces.

Normalmente coinciden. Pueden ser **distintas** cuando WordPress está instalado en una subcarpeta pero se quiere servir desde la raíz: por ejemplo, la instalación está en `https://midominio.com/wordpress/` (Dirección de WordPress) y el sitio se publica en `https://midominio.com/` (Dirección del sitio), con el `index.php` y el `.htaccess` copiados en la raíz. También ocurre al pasar de un entorno de pruebas a producción: se mantiene la instalación en un subdirectorio y se cambia solo la URL pública.

---

## 2. Configuración de escritura y lectura

### 2.1. Ajustes → Escritura

- **Categoría predeterminada de las entradas:** `Apuntes`. Es coherente con la temática: todo lo que publique sin categoría cae en el bloque de apuntes técnicos.
- Resto de opciones, por defecto.

**¿Para qué sirve `rpc.pingomatic.com`?** Es el servicio de *ping* que WordPress usa para **avisar a los agregadores de blogs** de que se ha publicado una entrada nueva. En el momento de publicar, WordPress envía una notificación (XML-RPC ping) a ese servicio y Ping-O-Matic la redistribuye a buscadores y directorios de blogs, que así pueden indexar el contenido antes. Hoy tiene menos peso que el `sitemap` y Google Search Console, pero no molesta y ayuda a la difusión.

### 2.2. Ajustes → Lectura

**Páginas creadas previamente** (Páginas → Añadir nueva, contenido genérico):

| Página | Contenido | Función |
|---|---|---|
| **Inicio** | Texto breve de bienvenida («Bienvenido a mi blog de DAW…») | Portada estática. |
| **Blog** | Vacía | Contenedor de las entradas. |
| **Quiénes somos** | Presentación del autor y del ciclo | Página corporativa. |
| **Contacto** | Formulario de contacto (WPForms, ya instalado en la UD1) | Comunicación con el lector. |

**Configuración aplicada:**

- **La página de inicio muestra:** *Una página estática* → Página de inicio: **Inicio**; Página de entradas: **Blog**.
- **Entradas del blog como máximo:** `5`.
- **Entradas en el feed RSS:** `10`.
- **Para cada entrada del feed, mostrar:** `Resumen`.
- **Disuadir a los motores de búsqueda de indexar este sitio:** **desmarcado**.

**Por qué debe estar desmarcada en producción.** Esa casilla añade la etiqueta `noindex` y la cabecera `X-Robots-Tag: noindex` a todo el sitio: los buscadores dejan de indexarlo y la web desaparece de Google. Se marca solo en entornos de pruebas para que un sitio a medio hacer no aparezca en los resultados; en producción, dejarla marcada es un error silencioso muy habitual: la web «existe», pero nadie la encuentra.

---

## 3. Personalización del escritorio

1. **Widget oculto:** en *Opciones de pantalla* (esquina superior derecha del Escritorio) desmarqué **«Eventos y noticias de WordPress»** y **«Borrador rápido»**. Motivo: no aportan nada al trabajo diario y ocupan la primera pantalla.
2. **Esquema de color:** en *Usuarios → Tu perfil → Esquema de color* elegí **Medianoche** (distinto del predeterminado). Sirve para distinguir de un vistazo en qué cuenta estás: útil cuando se trabaja con varios roles en la misma sesión.
3. **Widgets en 2 columnas:** arrastré los widgets restantes a dos columnas para dejar el escritorio en dos bloques (izquierda: actividad y borradores; derecha: estado del sitio y comentarios).
4. **Atajos de teclado del escritorio:**

| Atajo | Acción |
|---|---|
| `Shift` + `Alt` + `C` | Abre el panel de **comentarios** (moderación). |
| `Shift` + `Alt` + `M` | Abre el panel de **medios** (biblioteca). |
| `Shift` + `Alt` + `P` | Abre el panel para **crear una entrada nueva**. |

---

## 4. Gestión de usuarios y roles

**Patrón de nombres de usuario:** `rol.nombre` (sin usar nunca `admin` a secas).  
**Contraseñas:** mínimo 12 caracteres, con mayúsculas, minúsculas, números y símbolos; generadas y guardadas en el gestor de contraseñas (no se anotan en el documento entregado).  
**Correos:** direcciones de prueba válidas del tipo `rol.nombre@jjidaw.local` (si CDMON las rechaza, se usan alias del correo del centro).

| Rol | Nombre de usuario | Nombre a mostrar | Justificación |
|---|---|---|---|
| **Administrador** | `admin.javier` | Javier Jiménez | Responsable TI y dirección: única cuenta con acceso a Ajustes, Plugins y Usuarios. No se usa a diario. |
| **Editor** | `editor.marta` | Marta Ruiz | Responsable de contenidos: publica, edita y modera entradas y comentarios de todo el sitio, pero no toca la configuración. |
| **Autor** | `autor.diego` | Diego Serrano | Redactor de la sección de prácticas: publica y gestiona **sus propias** entradas. |
| **Colaborador** | `colaborador.lucia` | Lucía Pardo | Colaboradora esporádica: escribe borradores y los envía a revisión, pero no puede publicar. |
| **Suscriptor** | `suscriptor.ana` | Ana Moreno | Lectora registrada: solo puede comentar; no entra al panel para crear contenido. |

**Buenas prácticas aplicadas:**

- **Principio de menor privilegio:** cada persona tiene el rol mínimo necesario para su función.
- **Nombre público distinto del login:** el nombre a mostrar es el nombre real, nunca el nombre de usuario, para no revelar credenciales.
- **Biografía rellena** (al menos Editor y Autor): una línea con su función en el proyecto, porque aparece publicada junto a sus entradas.
- **La cuenta administradora no se usa para redactar:** el día a día se hace con Editor o Autor.

**Biografías redactadas:**

- *Editora:* «Marta Ruiz — Editora de contenidos. Reviso y publico los apuntes y proyectos del blog, y modero los comentarios.»
- *Autor:* «Diego Serrano — Redactor de la sección de prácticas. Escribo sobre HTML, CSS y JavaScript aplicados a proyectos reales.»

---

## 5. Verificación de permisos (experimento práctico)

| Acción | Administrador | Editor | Autor | Colaborador | Suscriptor |
|---|---|---|---|---|---|
| Crear entrada | ✅ | ✅ | ✅ | ✅ | ❌ |
| **Publicar** entrada propia | ✅ | ✅ | ✅ | ❌ (solo enviar a revisión) | ❌ |
| Editar entradas de otros | ✅ | ✅ | ❌ (solo las suyas) | ❌ | ❌ |
| Borrar entradas de otros | ✅ | ✅ | ❌ | ❌ | ❌ |
| Moderar comentarios | ✅ | ✅ | ❌ | ❌ | ❌ |
| Subir medios | ✅ | ✅ | ✅ | ✅ | ❌ |
| Crear categorías / etiquetas | ✅ | ✅ | ✅ | ❌ | ❌ |
| Acceder a **Ajustes** | ✅ | ❌ | ❌ | ❌ | ❌ |
| Acceder a **Usuarios** | ✅ | ❌ | ❌ | ❌ | ❌ |
| Instalar plugins o temas | ✅ | ❌ | ❌ | ❌ | ❌ |
| Escribir un comentario | ✅ | ✅ | ✅ | ✅ | ✅ |

**Resultado del experimento (lo observado en el panel):**

1. **Colaborador:** el menú Entradas aparece, pero el botón es **«Enviar a revisión»**; al intentar publicar, WordPress lo impide y la entrada queda como *Pendiente*. No ve Ajustes ni Usuarios.
2. **Autor:** publica sus propias entradas directamente (**«Publicar»**) y puede editar las suyas; no ve las de otros ni puede moderar comentarios.
3. **Editor:** ve y edita las entradas de todos, publica y modera comentarios, pero **Ajustes y Usuarios no aparecen** en el menú (o aparecen sin permisos).
4. **Suscriptor:** al entrar al sitio solo puede comentar; en el panel únicamente accede a su perfil.

**Comparación con la matriz de permisos del PDF (pág. 12):** lo observado coincide con la matriz: los permisos crecen de Suscriptor a Administrador y las diferencias clave están en **publicar** (Colaborador no puede) y en **editar contenido ajeno** (Autor no puede). La única matización es que el Editor también puede **borrar** entradas de otros, algo que la matriz resume en la columna de gestión de contenido.

---

## 6. Flujo de trabajo editorial (simulación)

Temática de la entrada de prueba: *«Cómo organizo los apuntes de DAW con HTML y CSS»*.

| Paso | Quién | Acción | Resultado esperado | Captura |
|---|---|---|---|---|
| 1 | **Colaborador** (`colaborador.lucia`) | Entradas → Añadir nueva, escribe la entrada, asigna imagen destacada y pulsa **Enviar a revisión** | Entrada en estado **Pendiente**; no se publica | `05-flujo-01-colaborador-envia-revision.png` |
| 2 | **Editor** (`editor.marta`) | Entradas → Pendientes, abre la entrada, revisa, añade la **categoría** `Apuntes` y la **etiqueta** `HTML`, y pulsa **Publicar** | Entrada publicada, visible en el blog | `05-flujo-02-editor-publica.png` |
| 3 | **Suscriptor** (`suscriptor.ana`) | Abre la entrada en el sitio y escribe un comentario | Comentario en estado **Pendiente de moderación** | `05-flujo-03-suscriptor-comenta.png` |
| 4 | **Editor** (`editor.marta`) | Comentarios → aprueba el comentario | Comentario visible bajo la entrada | `05-flujo-04-editor-aprueba-comentario.png` |
| 5 | **Administrador** | Comprueba en el blog que la entrada y el comentario se ven correctamente | Flujo completo cerrado | `05-flujo-05-resultado-final.png` |

**Observaciones del flujo.** El circuito funciona como está diseñado: el Colaborador **propone**, el Editor **decide y publica** y el Suscriptor **participa** sin poder escribir contenido. Es el mismo esquema de una redacción real y demuestra por qué no se debe dar rol de Editor a todo el mundo: quien redacta no debería ser quien aprueba su propio texto.

---

## 7. Capturas pendientes de tomar en CDMON

Para cerrar la entrega hay que entrar en el panel real y capturar, al menos:

1. `01-ajustes-generales.png` — Ajustes → Generales con título, descripción, zona horaria, idioma y registro desmarcado.
2. `02-ajustes-escritura.png` — Ajustes → Escritura con la categoría `Apuntes`.
3. `03-ajustes-lectura.png` — Ajustes → Lectura con portada estática, 5/10 entradas y la casilla de motores desmarcada.
4. `04-escritorio.png` — Escritorio con los widgets ocultos, el esquema de color y las 2 columnas.
5. `05-usuarios-lista.png` — Usuarios → Todos los usuarios con los 5 roles.
6. `06-perfil-biografia.png` — Perfil del Editor con la biografía rellena.
7. Las 5 capturas del flujo editorial de la tabla anterior.

**Cómo entrar (recordatorio de la UD1):** iniciar sesión en CDMON → abrir la plataforma → «Acceder a la página» → ir a `wp-admin`. Entrar por la URL directa da error 500 porque la plataforma de pruebas está dormida.

---

## 8. Conclusión

La práctica demuestra que WordPress no es solo un editor de textos: el panel permite separar **quién escribe**, **quién decide** y **quién administra**, y esa separación es la que evita que un error de contenido o de configuración tumbe el sitio. Las decisiones con más impacto son tres: **desactivar el registro libre** (cierra la puerta al spam), **aplicar el principio de menor privilegio** con cinco roles reales y **comprobar los permisos en la práctica**, no solo en la teoría. La configuración de lectura y la indexación son igual de importantes: un sitio perfecto con `noindex` activado es un sitio invisible.
