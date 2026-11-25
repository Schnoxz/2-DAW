# Cuestionario de Evaluación · Fundamentos y configuración de Apache

## 1. Rutas por defecto de Apache en Debian

Al instalar Apache en un GNU/Linux Debian se crea la **página web inicial** en
`/var/www/index.html`. Esa página está referenciada desde el archivo
`/etc/apache2/sites-available/default`, que contiene la configuración por defecto
generada en la instalación: el `DocumentRoot` y las directivas con las que Apache
sirve el sitio.

El procedimiento que describen los apuntes es sustituir ese `index.html` por la
página propia, o subir más páginas al mismo directorio, manteniendo siempre el
nombre `index.html` para la **página principal**, porque es el nombre que Apache
busca por defecto cuando se solicita el directorio.

Hay un matiz de versión: el documento trabaja con **Debian 6**. En las versiones
actuales de Debian y Ubuntu el `DocumentRoot` por defecto es `/var/www/html` y el
archivo de configuración del sitio por defecto es
`/etc/apache2/sites-available/000-default.conf`. El funcionamiento es el mismo;
solo cambian la ruta y el nombre del fichero.

## 2. Página estática frente a página dinámica

Un manual de instrucciones que se actualiza a mano sigue siendo una **página
estática** porque lo que define el concepto no es la frecuencia con la que cambia
el contenido, sino **quién genera ese contenido**. En una página estática el
servidor se limita a entregar el archivo tal y como está guardado en disco: no se
ejecuta código en el servidor (por ejemplo `PHP`) ni en el cliente (por ejemplo
`JavaScript`) para construir la respuesta. Que el administrador edite el HTML y
lo vuelva a subir no cambia nada de eso; el servidor sigue sirviendo un fichero ya
escrito.

El requisito técnico que marca la diferencia es la **necesidad de ejecutar
código** al atender la petición: si para mostrar la página hace falta que se
ejecute código en el servidor o en el cliente, o que se consulte una **base de
datos**, la página es **dinámica**; si basta con entregar el archivo `HTML` o
`XHTML` junto con su `CSS`, es **estática**.

## 3. Consecuencias del contenido dinámico para el servidor

Ofrecer páginas dinámicas tiene tres consecuencias:

- **Consumo de recursos:** cada petición obliga a ejecutar código (`PHP`, `CGI`,
  `Perl`...), lo que consume más tiempo de **CPU** y más **memoria** que servir un
  fichero estático. El resultado se tiene que construir en cada petición, y eso se
  nota en el rendimiento y en el número de usuarios simultáneos que puede
  atender.
- **Administración:** la configuración es más compleja. Hay que instalar,
  configurar y mantener los módulos que dan soporte a ese contenido (`mod_php`,
  `mod_cgi`, `mod_perl`, `mod_python`, `mod_include`, `mod_ldap`...). Cuantos más
  módulos, más trabajo de configuración y de actualización.
- **Seguridad:** cada módulo añadido es una **superficie de ataque** más. Cuantos
  más módulos haya cargados, más probabilidades de sufrir un problema de
  seguridad, y además hay que controlar qué código se ejecuta en el servidor,
  porque ese código corre con los permisos del usuario del servicio web.

## 4. HTTP frente a HTTPS

**HTTP** envía la información en **texto claro**. El navegador traduce el dominio
a una IP mediante **DNS**, conecta con el servidor en el **puerto TCP 80** —el que
Apache escucha por defecto para HTTP, definido con la directiva `Listen`— y se
intercambian la petición y la respuesta sin cifrar. Cualquiera que capture el
tráfico de la red puede leer el contenido e incluso modificarlo.

**HTTPS** añade una capa de **cifrado** con `SSL/TLS` sobre el mismo esquema. El
flujo es parecido, pero usa el **puerto TCP 443** por defecto y, antes de
transferir la página, se abre una **negociación SSL**: el servidor presenta su
**certificado**, el navegador comprueba que lo ha firmado una entidad de
certificación en la que confía y, si es válido, se acuerda el cifrado de la
conexión. A partir de ahí la información viaja cifrada y con garantías de
**autenticidad** e **integridad**.

El precio del cifrado es cómputo: HTTPS consume más **CPU** en el servidor que
HTTP. Por eso a veces se protege solo la autenticación o determinadas zonas del
sitio. Los dos protocolos pueden convivir en el mismo dominio.

## 5. Certificados autofirmados y confianza del navegador

Si el **certificado** lo ha emitido el propio servidor (**autofirmado**) y la
página es pública en Internet, el navegador mostrará un **aviso de seguridad**:
conexión no privada, certificado no válido o riesgo de suplantación, y pedirá al
usuario que acepte la excepción manualmente para continuar.

El motivo técnico es que los navegadores llevan una lista de **entidades de
certificación (CA) de confianza** y solo aceptan certificados cuya **cadena de
firma** termina en una de ellas. En un certificado autofirmado el emisor y el
titular son el mismo servidor, así que no hay una tercera parte de confianza que
lo avale y el navegador no puede validar la cadena. No significa que el cifrado
sea malo, pero sí que no hay forma de comprobar que ese certificado pertenece
realmente a ese dominio.

Por eso los certificados autofirmados se usan en **entornos internos o de
pruebas**, donde el cliente se configura para confiar en ellos, y para un sitio
público se contrata un certificado a una **autoridad de certificación
reconocida**.

## 6. El estándar MIME y la cabecera de tipo de contenido

El estándar **MIME** (*Multipurpose Internet Mail Extensions*) especifica cómo un
programa debe transferir archivos de texto, imagen, audio, vídeo o cualquier otro
que no esté codificado en `US-ASCII`, y permite que el receptor sepa **qué tipo de
archivo** está recibiendo para abrirlo con el programa adecuado. Se define en
varios RFC (2045, 2046, 2047, 4288, 4289 y 2077).

El servidor avisa del tipo de datos mediante el campo **`Content-Type`** de la
**cabecera de respuesta HTTP**. Por ejemplo, `Content-Type: text/html` indica que
el contenido es una página HTML y `Content-Type: text/css` una hoja de estilos; el
identificador tiene dos partes, la **categoría general** (`text`, `image`,
`video`...) y el **tipo concreto** (`html`, `gif`, `mp4`...).

Si un archivo no tiene un tipo MIME especificado, el programa cliente puede
**deducirlo por la extensión** del archivo: un `.txt` lo interpreta como texto.
También puede venir indicado en el propio código de la página, en los atributos
`type` de `link`, `script`, `object`, `form` o `meta`.

## 7. `DefaultType` frente a `ForceType`

Las dos directivas sirven para decidir el `Content-Type` que envía Apache, pero
actúan en momentos distintos.

**`DefaultType`** es un **valor de respaldo**. Asigna el `Content-Type` indicado a
cualquier archivo cuyo tipo MIME **no se pueda determinar por la extensión**. Es
decir, primero Apache mira la extensión en `/etc/mime.types` (a través de
`mods-available/mime.conf`) y, solo si no la reconoce, aplica el `DefaultType`.
Por ejemplo, `DefaultType text/plain` hace que un archivo desconocido se muestre
como texto.

**`ForceType`** es una **imposición**. Hace que todos los archivos a los que se
aplique esa directiva se sirvan **como el tipo MIME que se indique**, aunque su
extensión diga otra cosa. Por ejemplo, `ForceType image/gif` sirve como imagen
GIF los ficheros de ese ámbito, tengan la extensión que tengan.

En resumen: `DefaultType` solo entra cuando Apache **no sabe qué tipo es el
archivo**; `ForceType` manda siempre y **sustituye** a lo que diga la extensión.

## 8. Los hosts virtuales

Los **hosts virtuales** (`VirtualHost`) permiten que un mismo servidor web aloje
**varios dominios o sitios distintos**, cada uno con su propio `DocumentRoot`, su
`ServerName` y sus `ServerAlias`. Sin ellos, un servidor solo podría servir un
sitio; con ellos, en la misma IP y el mismo Apache pueden convivir `empresa1.com`,
`empresa2.com`... y cada petición se atiende con la configuración del virtualhost
cuyo nombre coincide con el dominio solicitado.

Cada virtualhost se define en un **archivo independiente** dentro de
`/etc/apache2/sites-available/`, lo que permite activarlo o desactivarlo por
separado con `a2ensite` y `a2dissite`.

La relación con la configuración principal es de **herencia**: todo lo que no esté
definido dentro de un `VirtualHost` se hereda de `apache2.conf`. Por eso las
directivas comunes a todos los sitios, como `Timeout 300`, se escriben una sola
vez en la configuración principal y no repetidas en cada virtualhost. Si una
directiva aparece en el virtualhost, **prevalece sobre la global** para ese sitio.

Existen tres tipos: **basados en nombre** (varios dominios en la misma IP, el
método habitual), **basados en IP** (una IP por sitio, más difícil de mantener) y
**varios servidores principales** (varios `apache2.conf` independientes, solo para
casos complejos).
