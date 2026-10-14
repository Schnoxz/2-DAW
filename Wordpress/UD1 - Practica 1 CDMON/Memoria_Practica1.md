# Práctica 1 — Publicación de una web con WordPress

Javier Jiménez Alonso · 2º DAW · 13 de octubre de 2026

En esta práctica he publicado una web con WordPress sobre una plataforma de pruebas
gratuita de CDMON. Me registré con la cuenta del centro (`@g.educaand.es`), creé la
plataforma con mi dominio `jjidaw.com.mialias.net` (sin `www`) e instalé el CMS. A partir
de ahí monté la web con el tema Astra y el constructor Elementor, añadí un formulario de
contacto y preparé el blog. En cada apartado dejo las capturas y una explicación breve de
lo que hice.

### 00 — Registro en CDMON

Me registré en CDMON con el correo `@g.educaand.es`. Esta plataforma da acceso a cinco
plataformas de prueba gratuitas, sin necesidad de contratar un hosting. Como pide el
enunciado, guardé el usuario y la contraseña en un documento de Google, porque más
adelante se generan claves nuevas y hay que tenerlas siempre a mano.

![Correo de activación que recibo al registrar la cuenta.](00-Registro CDMON/00-01-email-activacion.png)

![Primer acceso al panel de CDMON.](00-Registro CDMON/00-02-primer-acceso-panel.png)

### 01 — Creación de la plataforma de pruebas

Desde el panel creé mi plataforma de prueba. Al crearla hay que escribir el dominio sin
`www` y aceptar las condiciones de contratación. Una vez creada, entré en su
configuración para tenerla lista e instalar WordPress.

![Pantalla para crear la plataforma de prueba.](01-Plataforma de pruebas/01-01-nueva-plataforma.png)

![Dominio escrito sin `www`.](01-Plataforma de pruebas/01-02-dominio-sin-www.png)

![Configuración de la plataforma ya creada.](01-Plataforma de pruebas/01-03-configuracion.png)

### 02 — Instalación de WordPress

Dentro de la configuración de la plataforma, en el apartado de aplicaciones, instalé
WordPress y acepté sus políticas. Al terminar me llegó un correo con la URL del panel
(`.../wp-admin`) y las credenciales de WordPress, que copié al documento de Google. Ese
correo con la URL y las claves es imprescindible para poder entrar después.

![Aceptación de las políticas de WordPress.](02-Instalar WordPress/02-01-aceptar-politicas.png)

![Confirmación de que WordPress se ha instalado.](02-Instalar WordPress/02-02-wordpress-instalado.png)

![Confirmación final de la instalación.](02-Instalar WordPress/02-03-confirmacion.png)

### 03 — Acceso a WordPress

Para entrar hay que hacerlo siempre por el camino largo: iniciar sesión en CDMON, abrir la
plataforma, pulsar "Acceder a la página" y desde ahí ir a la URL del documento. Entré con
el usuario y la contraseña de WordPress y me apareció el escritorio, que es donde se
gestiona toda la web.

> Nota: al principio intenté entrar escribiendo la URL directamente en el navegador y me
> salía un error 500. Era por dos motivos: el dominio no lleva `www`, y la plataforma
> estaba "dormida" porque hay que levantarla entrando por CDMON ("Acceder a la página").
> Entrando por ese camino, el escritorio carga sin problema.

![Pantalla de acceso a WordPress.](03-Acceso a WordPress/03-01-login-wp-admin.png)

![Escritorio de WordPress, ya dentro.](03-Acceso a WordPress/03-02-escritorio-wordpress.png)

### 04 — Tema Astra

Como base del diseño instalé el tema Astra desde Apariencia → Temas → Añadir nuevo,
buscándolo por su nombre. Es un tema muy ligero y compatible con Elementor, que es el que
usé después para construir las páginas.

![Búsqueda del tema Astra.](04-Tema Astra/04-01-buscar-astra.png)

![Astra instalado y activo.](04-Tema Astra/04-02-astra-activado.png)

### 05 — Plugin Elementor

Después instalé el constructor visual Elementor desde Plugins → Añadir nuevo. Con
Elementor puedo montar las páginas arrastrando widgets, sin tener que escribir código.

![Instalación del plugin Elementor.](05-Plugin Elementor/05-01-nuevo-plugin-elementor.png)

![Elementor activo en la lista de plugins.](05-Plugin Elementor/05-02-elementor-activo.png)

### 06 — Cabecera y pie de página

Con Elementor creé la plantilla de cabecera (logo y menú) y la apliqué a todo el sitio,
para que la cabecera aparezca en todas las páginas de la web.

![Plantilla de cabecera creada con Elementor.](06-Header y Footer/06-01-plantillas-elementor.png)

![Cabecera configurada y aplicada.](06-Header y Footer/06-02-header-configurado.png)

### 07 — Formulario de contacto con WPForms

Para el formulario usé el plugin WPForms. Lo instalé, creé un formulario de contacto y lo
inserté en una página con el widget de WPForms de Elementor. Después le di formato
(colores y fondo) desde las pestañas de contenido, estilo y avanzado.

![Instalación del plugin WPForms.](07-Formulario WPForms/07-01-instalar-wpforms.png)

![Creación del formulario de contacto.](07-Formulario WPForms/07-02-crear-formulario.png)

![Creación de una página nueva.](07-Formulario WPForms/07-03-crear-pagina.png)

![La página nueva abierta en el editor.](07-Formulario WPForms/07-04-pagina-nueva.png)

![Formulario de contacto ya publicado en la web.](07-Formulario WPForms/07-05-formulario-en-pagina.png)

## Conclusión

Con esta práctica he aprendido a publicar una web completa con WordPress desde cero:
registrar una cuenta en CDMON, crear una plataforma de pruebas, instalar el CMS y montar
el diseño con un tema y un constructor visual. Lo que más me ha costado ha sido el acceso:
entender que hay que entrar siempre por el panel de CDMON y no por la URL directa, porque
si no la plataforma está apagada y da error 500.
