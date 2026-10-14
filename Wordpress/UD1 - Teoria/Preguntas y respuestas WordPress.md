# Cuestionario WordPress: Preguntas y respuestas

Respuestas sencillas, en español, organizadas por bloques.

## Conceptos básicos

**1. ¿Qué es WordPress y para qué se utiliza principalmente?**
WordPress es un sistema de gestión de contenidos (CMS) de código abierto que permite crear sitios web sin necesidad de programar desde cero. Se utiliza principalmente para montar blogs, webs corporativas, tiendas online, portafolios y casi cualquier tipo de página web mediante temas y plugins.

**2. Explica la diferencia entre WordPress.com y WordPress.org.**
- **WordPress.org**: es el software gratuito que te instalas tú en un servidor propio (hosting). Tienes control total, puedes usar cualquier tema y plugin, pero debes gestionar el hosting, la seguridad y las copias de seguridad.
- **WordPress.com**: es un servicio en la nube donde WordPress te aloja el sitio. Es más fácil de usar al principio, pero las funciones avanzadas (plugins, temas propios, etc.) suelen estar limitadas o de pago.

**3. ¿Qué es un CMS y por qué WordPress es considerado uno de los más populares?**
Un CMS (Content Management System) es un programa que permite crear, editar y publicar contenidos en una web sin tocar código. WordPress es el CMS más popular porque es gratuito, fácil de usar, tiene una enorme comunidad, miles de temas y plugins, y sirve para todo tipo de webs (según algunos estudios, impulsa más del 40 % de la web mundial).

**4. Nombra al menos tres tipos de contenidos que se pueden gestionar en WordPress.**
- Entradas o posts (artículos del blog).
- Páginas (información estática, como "Sobre nosotros" o "Contacto").
- Imágenes, vídeos y archivos (medios de la biblioteca).
- También se pueden gestionar productos (tiendas) o eventos mediante plugins.

**5. ¿Qué ventajas ofrece WordPress frente a desarrollar un sitio web desde cero?**
- Mucho más rápido: no hay que programar cada página.
- No se necesitan grandes conocimientos de código para empezar.
- Es fácil de actualizar y ampliar con plugins y temas.
- Gran comunidad: ayuda, documentación y soluciones para casi todo.
- Coste menor: con temas y plugins gratuitos se monta una web completa por poco dinero.
- SEO y mantenimiento mucho más sencillos que un desarrollo a medida completo.

## Instalación y configuración

**6. ¿Cuáles son los requisitos mínimos para instalar WordPress?**
Actualmente se recomienda: PHP 7.4 o superior, MySQL 5.7+ / MariaDB 10.3+, y un servidor web como Apache o Nginx. También se necesita un dominio y un hosting (o un entorno local como XAMPP) donde instalar los archivos.

**7. Explica brevemente el proceso de instalación de WordPress.**
1. Descargar WordPress desde wordpress.org.
2. Subir los archivos al servidor (o copiarlos en la carpeta web de XAMPP).
3. Crear una base de datos y un usuario en MySQL.
4. Acceder a la web en el navegador (p. ej. `localhost/wordpress`).
5. Introducir los datos de la base de datos y rellenar el asistente (idioma, nombre del sitio, usuario y contraseña de administrador).
6. ¡Listo! Ya puedes entrar en `wp-admin` y empezar a gestionar.

**8. ¿Qué información se necesita para conectar WordPress a una base de datos?**
- Nombre de la base de datos.
- Usuario de la base de datos.
- Contraseña del usuario.
- Servidor de la base de datos (normalmente "localhost").

**9. ¿Qué es el archivo wp-config.php y para qué se utiliza?**
Es el archivo de configuración principal de WordPress. Guarda los datos de conexión a la base de datos, las claves de seguridad (salts) y ajustes avanzados como la tabla de prefijos o el idioma. Está en la raíz de la instalación y nunca debe subirse a repositorios públicos.

**10. Menciona tres ajustes importantes que deberías configurar después de instalar WordPress.**
- Cambiar los enlaces permanentes (permallinks) para que las URLs sean amigables para el SEO.
- Establecer zona horaria y formato de fecha correctos en Ajustes > Generales.
- Configurar el nombre del sitio, el sustituo (titular) y el idioma, además de instalar un tema base, cambiar la contraseña del administrador y usuarios que puedas (usuarios/roles).

## Administración y gestión de contenido

**11. Explica la diferencia entre entradas (posts) y páginas (pages) en WordPress.**
- **Entradas (posts)**: artículos del blog, aparecen en orden cronológico, suelen ir con categorías, etiquetas y comentarios.
- **Páginas (pages)**: contenido estático y atemporal (Inicio, Acerca de, Contacto) que no se publica en la lista del blog y no usa normalmente categorías ni etiquetas.

**12. ¿Qué son las categorías y etiquetas en WordPress y cómo se utilizan?**
- **Categorías**: agrupación general y jerárquica de las entradas (por ejemplo "Cocina", "Tecnología"). Se puede crear con jerarquías (subcategorías).
- **Etiquetas (tags)**: descriptores más concretos y libres para afinar un tema concreto (por ejemplo "recetas veganas"). Ambas ayudan a organizar el contenido y mejoran la navegación y el SEO.

**13. Describe el proceso para crear y publicar una nueva entrada en WordPress.**
1. Ir a Entradas > Añadir nueva.
2. Escribir el título y el contenido con el editor (bloques).
3. Guardar como borrador mientras se trabaja.
4. Añadir categoría, etiquetas e imagen destacada.
5. Pulsar el botón **Publicar** para que quede visible. También es posible programar una fecha de publicación.

**14. ¿Qué es el editor Gutenberg y en qué se diferencia del editor clásico?**
Gutenberg es el editor actual de WordPress basado en **bloques**: cada elemento (párrafo, imagen, botón, vídeo…) es un bloque que se arrastra, ordena y edita visualmente. El editor clásico se limitaba a una caja de texto con barra de herramientas (como un procesador). Gutenberg da más flexibilidad de diseño sin usar código.

**15. ¿Cómo se gestionan los comentarios en WordPress y por qué es importante moderarlos?**
Los comentarios se gestionan en Comentarios: se pueden aprobar, marcar como spam, ponerlos en moderación (aprobación previa) o desactivarlos por página/entrada. Es importante moderarlos para evitar spam, contenido ofensivo o enlaces maliciosos, y para mantener un debate respetuoso que aporte valor a la web.

## Apariencia y temas

**16. ¿Qué es un tema de WordPress y qué funcionalidades proporciona?**
Un tema es el conjunto de archivos (plantillas, CSS, JS) que controla el **diseño y la estructura** del sitio: colores, tipografías, cabecera, menús, disposición de las entradas, etc. Se puede cambiar sin que afecte al contenido, porque separa apariencia de contenido.

**17. Explica cómo instalar y activar un nuevo tema en WordPress.**
En el panel: Apariencia > Temas > Añadir nuevo. Se puede buscar por palabras clave, subir un tema en zip o desde el repositorio. Al pulsar "Instalar" se descarga y luego se pulsa "Activar" para que comience a usarse.

**18. ¿Qué es un tema hijo (child theme) y por qué se utiliza?**
Un tema hijo hereda las funciones y estilo de un tema padre, pero permite hacer modificaciones (CSS, plantillas, functions.php) **sin que se pierdan al actualizar el tema padre**. Se usa para personalizar un tema sin romper las actualizaciones y sin tener que mantener una copia entera del tema.

**19. Menciona tres elementos que se pueden personalizar generalmente desde el personalizador de WordPress.**
- El título y el logotipo del sitio.
- Los colores y la tipografía.
- La cabecera, el fondo de página y el menú de navegación.
(También el widget de pie de página y la página de inicio en muchos temas.)

**20. ¿Qué consideraciones deberías tener al elegir un tema para un sitio web?**
- Que sea compatible con la versión de WordPress y con los plugins que vayas a usar.
- Que sea **responsive** (que se vea bien en móviles y tablets).
- Que cargue rápido y tenga buenas actualizaciones y soporte.
- Que sea accesible y permita personalizar lo que necesitas (colores, menús, plantillas de página).
- Que esté traducido al español si lo necesitas y tenga valoraciones positivas.

## Plugins y funcionalidad extendida

**21. ¿Qué es un plugin de WordPress y para qué se utiliza?**
Un plugin es una extensión que añade funciones nuevas a WordPress: desde formularios y tiendas hasta SEO, seguridad o traducciones. Son "piezas intercambiables" que se activan y desactivan para ampliar la web sin tocar el núcleo del CMS.

**22. Explica cómo instalar y activar un plugin en WordPress.**
En el panel: Plugins > Añadir nuevo. Puedes buscar en el repositorio, instalar desde un zip (Plugins > Añadir nuevo > Subir plugin) e instalar automáticamente pulsando "Instalar". Después se activa con el botón "Activar" y ya aparece en el menú para configurarlo.

**23. Menciona tres tipos de funcionalidades que se pueden añadir mediante plugins.**
- Seguridad (cortafuegos, protección contra ataques, doble autenticación).
- SEO (análisis de palabras clave, mapas del sitio, meta descripciones).
- Comercio electrónico (tienda online, carrito, pasarelas de pago).
- Otras: formularios de contacto, galerías, backup, "me gusta" en redes sociales, etc.

**24. ¿Qué precauciones se deben tomar al instalar plugins de terceros?**
- Descargarlos solo de fuentes fiables (repositorio oficial de WordPress o desarrolladores conocidos).
- Leer las valoraciones, el número de instalaciones y la fecha de la última actualización.
- No instalar plugins demasiados ni innecesarios: más plugins = más riesgo y más carga.
- Hacer una copia de seguridad antes de instalar o actualizar.
- Comprobar compatibilidad con la versión de WordPress y con los demás plugins.

**25. Nombra tres plugins populares de WordPress y describe brevemente su función.**
- **Yoast SEO**: ayuda a optimizar el SEO (palabras clave, meta descripciones, análisis de legibilidad).
- **WooCommerce**: convierte WordPress en una tienda online completa (productos, carrito, pagos).
- **Akismet**: filtra automáticamente el spam de los comentarios del blog.
(Otros muy usados: Contact Form 7, Elementor, WP Super Cache.)

## Personalización y desarrollo

**26. ¿Qué son los shortcodes en WordPress y para qué se utilizan?**
Son pequeños códigos entre corchetes, como `[galeria]` o `[boton]`, que insertan contenido o funcionalidad dentro de páginas y entradas sin escribir código. Se utilizan para añadir elementos por ejemplo de plugins (formularios, galerías) de forma rápida.

**27. Explica qué es y para qué sirve el archivo functions.php de un tema.**
Es el archivo principal de "funciones" del tema: añade características y personalizaciones al sitio (registrar menús y zonas de widgets, cargar CSS/JS, crear shortcodes, modificar funciones por defecto…). Es como el "cerebro programable" del tema y se ejecuta en cada carga.

**28. ¿Qué son los Custom Post Types y cuándo deberías utilizarlos?**
Los tipos de contenido personalizados (CPT) permiten crear tipos de contenido propios además de entradas y páginas, por ejemplo "Productos", "Recetas" o "Proyectos". Deberías utilizarlos cuando necesitas un tipo de contenido con campos y listados propios que no encaja en un post normal (por ejemplo los productos de una tienda, casos de éxito o ofertas de empleo).

**29. Describe brevemente cómo se crea un menú personalizado en WordPress.**
En Apariencia > Menús: se crea un menú nuevo (p. ej. "Menú principal"), se añaden elementos desde la columna de la izquierda (páginas, entradas, categorías o enlaces personalizados), se ordenan arrastrando, y se guarda asignándolo a una ubicación de menú del tema (cabecera, pie de página…).

**30. ¿Qué es el Loop de WordPress y para qué se utiliza?**
Es el bucle principal de WordPress (código PHP dentro de las plantillas) que se repite mostrando las entradas: consulta a la base de datos y, mientras haya entradas, imprime sus títulos, contenido, autor, fecha, etc. Es la base de prácticamente todas las plantillas del tema.

## Seguridad y mantenimiento

**31. Menciona tres medidas básicas de seguridad para un sitio WordPress.**
- Usar contraseñas fuertes y cambiar el usuario "admin" por defecto.
- Mantener WordPress, temas y plugins actualizados.
- Instalar un plugin de seguridad (cortafuegos, limitador de intentos de acceso) y activar la autenticación en dos pasos.
(Otros: copias de seguridad periódicas, ocultar la versión de WP, limitar intentos de contraseña.)

**32. ¿Por qué es importante mantener WordPress, temas y plugins actualizados?**
Porque cada actualización corrige **fallos de seguridad y errores**. Si no se actualiza, el sitio queda expuesto a ataques (hackeos, malware) que aprovechan vulnerabilidades conocidas. Además las actualizaciones aportan nuevas funciones y compatibilidad con las versiones del PHP/browser.

**33. Explica la importancia de realizar copias de seguridad periódicas.**
Las copias de seguridad permiten **recuperar el sitio** si se pierde información por un error humano, un ataque, un problema del hosting o una mala actualización. Sin ellas, reconstruir el contenido (textos, imágenes, configuración) puede ser imposible o costar muchísimo tiempo y dinero.

**34. ¿Qué hacer si olvidas la contraseña de administrador de WordPress?**
Se puede recuperar desde la pantalla de inicio de sesión pulsando "¿Has olvidado la contraseña?" (se envía un email de restablecimiento). Si no llega el correo, hay más vías: cambiarla desde el phpMyAdmin (editar la tabla de usuarios), usar la opción "Emergency Password Reset" con una clave de recuperación en `wp-config.php`, o pedirla desde un archivo de scripting / el hosting.

**35. ¿Cómo puedes mejorar el rendimiento de un sitio WordPress?**
- Usar un **plugin de caché** (para páginas y objetos).
- Optimizar (comprimir) las imágenes.
- Elegir un hosting rápido y una CDN.
- Limpiar plugins y temas innecesarios.
- Minimizar el uso de plugins pesados y de fuentes de Google: cargar solo lo esencial.
- Actualizar PHP a una versión reciente.

## SEO y optimización

**36. ¿Qué es el SEO y por qué es importante para un sitio web?**
SEO (Search Engine Optimization) es el conjunto de técnicas para mejorar el **posicionamiento** de una web en los buscadores (Google). Es importante porque un mejor puesto en los resultados = más visitas, más visibilidad y más clientes o lectores potenciales, sin pagar por cada clic.

**37. Menciona tres prácticas básicas de SEO que se pueden implementar en WordPress.**
- Usar **permallinks amigables** (que la URL contenga las palabras clave del contenido).
- Escribir títulos y meta descripciones únicos para cada página/entrada.
- Usar encabezados correctos (H1, H2, H3) y enlaces internos entre contenidos.
(Otras: imágenes con texto alternativo (alt), mapa del sitio XML, web responsive y rápida.)

**38. ¿Qué plugins recomendarías para mejorar el SEO de un sitio WordPress?**
- **Yoast SEO** (o **Rank Math**): análisis de palabras clave, metadatos, mapa del sitio y legibilidad.
- **Google Site Kit**: conecta la web con las herramientas de Google (Search Console, Analytics).
- **WP Super Cache / Litespeed**: velocidad (el rendimiento también cuenta para el SEO).
(Si hay tienda: WooCommerce SEO de Yoast.)

**39. Explica la importancia de los permalinks en WordPress para el SEO.**
Los permalinks (enlaces permanentes) definen la URL de cada contenido. URLs limpias y con palabras clave (p. ej. `demo.es/recetas-pollo`) son más fáciles de leer para el usuario, las comparten mejor en redes y muestran a Google el tema de la página, lo que ayuda en el posicionamiento frente a URLs con números o símbolos (`?p=123`).

**40. ¿Qué es la optimización para móviles y por qué es crucial para el SEO actual?**
Optimizar para móviles significa que la web se vea y funcione bien en teléfonos y tablets (diseño responsive, botones accesibles, carga rápida). Es crucial porque la mayoría de las búsquedas se hacen desde el móvil y porque Google usa la **versión móvil como principal referencia** para posicionar (mobile-first indexing); una web poco usable en móvil pierde posiciones.