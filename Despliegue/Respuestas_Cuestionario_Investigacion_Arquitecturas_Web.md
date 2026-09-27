# Respuestas al cuestionario de investigación: modelos y servicios web

**Módulo:** Despliegue de Aplicaciones Web

**Unidad:** Implantación de arquitecturas web y servidores

**Contexto:** Actividad de investigación inicial

## Introducción

Estas respuestas utilizan como base la lectura técnica de *Implantación de arquitecturas web* y contrastan los conceptos con la documentación actual de Apache HTTP Server, Apache Tomcat, Docker, systemd, MDN y OWASP. El material de lectura está basado en tecnologías y distribuciones antiguas, como Debian 6, Tomcat 6, Flash, Java Applets y scripts SysV. Por eso, cuando una explicación histórica ya no representa la práctica actual, lo indico expresamente en lugar de repetirla como una recomendación vigente.

# Bloque I: fundamentos de arquitecturas y pilas de software

## 1. Servidor web frente a servidor de aplicaciones

Apache HTTP Server y Apache Tomcat cumplen funciones distintas dentro de una infraestructura multicapa, aunque ambos pueden recibir peticiones HTTP y devolver respuestas.

| Componente | Función principal | Peticiones que procesa de forma nativa | Relación con las demás capas |
|---|---|---|---|
| **Apache HTTPD** | Servidor web: recibe HTTP/HTTPS, sirve recursos estáticos, administra hosts virtuales, registros, compresión, autenticación, cachés y TLS. | Peticiones de recursos web: HTML, CSS, JavaScript, imágenes, vídeo, archivos y rutas que correspondan a un sistema de archivos o a un módulo. | Puede actuar como proxy inverso y enviar las rutas dinámicas a Tomcat u otro servidor de aplicaciones. |
| **Apache Tomcat** | Contenedor de Servlets y JSP; ejecuta la lógica de aplicaciones Java y administra el ciclo de vida de los componentes web. | Peticiones HTTP que deben convertirse en peticiones a un Servlet, JSP u otro componente de una aplicación Java. | Suele acceder a una base de datos y expone una aplicación que Apache puede servir mediante HTTP o AJP. |

Por tanto, **Tomcat no incorpora Apache**. Tomcat es un servidor independiente, aunque su documentación histórica lo describe como un servidor web y de aplicaciones porque puede servir también contenido estático y responder a peticiones HTTP. En una arquitectura típica se puede representar así:

```text
Navegador
    |
    | HTTPS
    v
Apache HTTPD o CDN
    |---------------- contenido estático
    |
    | HTTP interno, HTTPS o AJP
    v
Tomcat
    |
    v
Base de datos
```

Apache es especialmente adecuado como capa de entrada porque puede resolver eficientemente las siguientes tareas:

- establecer la conexión TLS y proteger el tráfico entre el cliente y el servidor;
- servir directamente HTML, CSS, imágenes, JavaScript y otros archivos;
- aplicar reglas de caché, compresión, límites de peticiones y cabeceras de seguridad;
- decidir qué rutas se dirigen a cada aplicación o servidor de aplicaciones;
- mantener registros de acceso y métricas en el punto de entrada;
- actuar como proxy inverso y, en una granja, como balanceador.

Tomcat, por su parte, está preparado para ejecutar la lógica de negocio. Un Servlet puede recibir una petición, consultar una base de datos, aplicar reglas de negocio y generar una respuesta. Tomcat administra además los hilos de trabajo, las sesiones, el despliegue de las aplicaciones WAR y los componentes Jakarta Servlet y JSP; la aplicación o su framework gestiona normalmente el pool de conexiones.

Aunque Tomcat puede servir archivos estáticos, no es recomendable confiarle todo el contenido estático de alto tráfico. En ese caso se desaprovecharían recursos de la JVM y del contenedor para atender archivos que no necesitan ejecutar lógica Java. Apache, un CDN o un servidor de archivos puede atender esas peticiones con menos coste de procesamiento y aplicar cachés de forma más sencilla. La separación no es obligatoria en proyectos pequeños, pero sí es habitual en producción.

**Material base:** páginas 3, 20-25 y 27-29.

**Fuentes actuales:** [documentación de Apache HTTP Server](https://httpd.apache.org/docs/2.4/en/), [documentación de Apache Tomcat](https://tomcat.apache.org/tomcat-11.0-doc/index.html).

## 2. Renderizado y ejecución mediante `file://`

Sí es posible visualizar una página web sin que medie un servidor HTTP, siempre que se trate de una página estática y de un HTML básico funcional. Por ejemplo, al abrir:

```text
file:///C:/proyecto/index.html
```

el navegador no hace una petición a Apache. Lee el fichero desde el sistema local, interpreta el HTML y carga los recursos relacionados mediante referencias locales, como una hoja de estilos, una imagen o un script clásico.

Sin embargo, esa forma de abrir el documento no equivale a una aplicación web completa:

- no hay un servidor que procese PHP, Java, Python, CGI o una base de datos;
- no existen rutas de servidor que puedan generar una respuesta diferente para cada petición;
- el usuario solo está viendo los ficheros que ya existen en su equipo;
- el comportamiento y la seguridad dependen del navegador y del sistema operativo;
- no se puede atender a varios usuarios a través de una dirección web.

### Restricciones de `fetch`, CORS y módulos ECMAScript

Una página cargada mediante `file://` tiene un origen local opaco, normalmente representado como `null`. Esto crea problemas con la política de mismo origen y con CORS. CORS está pensado para interacciones entre orígenes HTTP o HTTPS; una petición que intenta utilizar una URL `file://` puede producir un error de CORS y ser bloqueada.

La situación es especialmente importante con JavaScript:

- `fetch()` y `XMLHttpRequest` realizan peticiones a un origen HTTP o HTTPS cuando se comunican con un servidor externo;
- los archivos locales pueden ser tratados como recursos opacos en los navegadores modernos, incluso si están en la misma carpeta;
- un módulo local cargado con `<script type="module" src="app.js">` puede ser rechazado por las restricciones de seguridad de los módulos y por CORS;
- cargar un módulo desde un dominio remoto exige que ese servidor entregue las cabeceras CORS adecuadas;
- el navegador también comprueba que el recurso se sirva con un tipo MIME de JavaScript válido.

Por eso, una página que utiliza módulos ECMAScript, AJAX o llamadas a una API debería probarse mediante un servidor local, por ejemplo:

```console
python -m http.server 8000
```

Después se abriría `http://localhost:8000/`. En ese caso, el documento, el módulo y la API se sirven mediante HTTP, se puede controlar el origen y se reproducen mejor las condiciones de producción.

La conclusión es que `file://` es útil para probar un HTML estático, pero no es un sustituto de un servidor web. Para una aplicación dinámica o para una aplicación modular, lo correcto es utilizar HTTP local, GitHub Pages, Apache, Nginx, Tomcat u otro servidor.

**Material base:** páginas 5-7.

**Fuentes actuales:** [MDN: CORS con URLs que no son HTTP](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS/Errors/CORSRequestNotHttp) y [MDN: módulos de JavaScript y pruebas locales](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules).

## 3. Transición y obsolescencia tecnológica

Las tecnologías históricas cumplieron su función en un contexto tecnológico concreto, pero presentaban problemas de seguridad, consumo de recursos o compatibilidad. No conviene decir que todas desaparecieron exactamente por el mismo motivo.

| Tecnología | Problemas principales | Estándares o alternativas actuales |
|---|---|---|
| **CGI con scripts Perl o C** | El modelo clásico solía crear un proceso externo por petición. La creación y destrucción constante de procesos era costosa. Una CGI mal diseñada también podía producir inyección de comandos, exposición de variables de entorno, validación insuficiente o agotamiento de recursos. | CGI sigue siendo un patrón válido y está definido en un estándar, pero se emplean variantes persistentes como FastCGI y SCGI, además de entornos de ejecución como PHP-FPM o pools de procesos. En Java se utilizan Servlets, Jakarta EE y otros frameworks. |
| **Java Applets** | Dependían de un plugin y de una máquina virtual Java instalada en el cliente. El plugin amplía la superficie de ataque, podía exigir firmas digitales o certificados de firma específicos y debía integrarse de forma diferente en cada navegador. También podían consumir memoria y CPU del equipo del usuario. | HTML5, JavaScript, WebAssembly, Web Workers y APIs web estándar. Java sigue utilizándose en el servidor, pero ya no como Applet de navegador. |
| **ActiveX** | Era una tecnología muy ligada a Windows e Internet Explorer. Los controles podían acceder a recursos del sistema y ampliar una superficie de seguridad considerable. No funcionaba de forma multiplataforma. | HTML, CSS, JavaScript, WebAssembly y APIs web. Las extensiones de navegador siguen existiendo, pero deben utilizarse con permisos, aislamiento y revisión de seguridad. |
| **VBScript** | Estaba diseñado principalmente para el ecosistema de Microsoft y para Internet Explorer. No era una opción estándar para navegadores modernos ni multiplataforma. | JavaScript y ECMAScript en el cliente; en el servidor se utilizan lenguajes y frameworks como .NET, Node.js, PHP, Python o Java. |

Es importante corregir una expresión del material base: **CGI no fue abandonado como estándar de la misma forma que los Applets, ActiveX o VBScript**. Lo que dejó de ser habitual fue la implementación ingenua que iniciaba un proceso independiente para cada petición. FastCGI y las arquitecturas de servidores persistentes resuelven precisamente el problema de rendimiento manteniendo una separación clara entre el servidor web y la lógica de aplicación.

Los Applets de Java fueron marcados como obsoletos para su eliminación y los navegadores retiraron el soporte del plugin. JavaScript y WebAssembly permiten ejecutar lógica en el cliente sin instalar un plugin propietario, aplicando las restricciones de seguridad del propio navegador. En el servidor, los Servlets, Jakarta REST, PHP, ASP.NET y otros frameworks ofrecen funciones equivalentes de forma más controlada.

**Material base:** páginas 6-7 y 12.

**Fuentes actuales:** [RFC 3875, CGI](https://www.rfc-editor.org/rfc/rfc3875), [JEP 398: deprecación de la API Applet](https://openjdk.org/jeps/398), [MDN: módulos ECMAScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules).

## 4. Comparativa de LAMP y WISA, aprovisionamiento manual y contenedores

LAMP y WISA son dos combinaciones históricas de tecnologías que cubren capas distintas de una aplicación web. No son arquitecturas incompatibles: son modelos de organización y licenciamiento que pueden combinarse con otras soluciones.

| Elemento | LAMP | WISA |
|---|---|---|
| Sistema operativo | Linux | Windows |
| Servidor web | Apache HTTP Server | Internet Information Services |
| Base de datos | MySQL, aunque también pueden utilizarse MariaDB, PostgreSQL y otras | SQL Server |
| Lenguaje de servidor | PHP, aunque pueden utilizarse Perl o Python | ASP/ASP.NET |
| Organización del producto | Generalmente combina proyectos libres y abiertos, con distintos modelos de licencia | Integración fuerte con el ecosistema Microsoft y componentes propietarios o con licencias comerciales |
| Coste y operación | Puede reducir costes de licencia, pero requiere administración técnica | Puede requerir licencias de Windows, SQL Server y otros componentes, además de conocimiento del ecosistema Microsoft |

La afirmación del material de que LAMP está formado completamente por software libre debe entenderse con matiz. Linux, Apache y PHP tienen licencias abiertas, pero el coste de una instalación LAMP no es cero: hay que pagar o asumir el coste del servidor, del mantenimiento, de la seguridad, del backup y del personal. Además, MySQL Community se distribuye bajo una licencia libre, mientras que algunas ediciones comerciales requieren una licencia pagada; por eso hay que revisar la edición y el uso concreto.

WISA significa Windows, IIS, SQL Server y ASP.NET. IIS y SQL Server son productos propietarios, y ASP.NET se ejecuta habitualmente sobre infraestructura Windows. No obstante, algunas tecnologías de .NET son de código abierto y pueden ejecutarse en otros sistemas. Por eso, el nombre WISA describe una combinación tradicional, no una limitación técnica absoluta de todos los componentes que contiene.

### Aprovisionamiento manual y contenedores

El aprovisionamiento manual de una pila sobre un host solía implicar:

1. instalar el sistema operativo y sus actualizaciones;
2. instalar las versiones correctas de Apache, PHP, MySQL y librerías;
3. crear usuarios, permisos, certificados y reglas de firewall;
4. configurar el inicio del servicio y el registro de actividad;
5. repetir el proceso en cada servidor nuevo;
6. mantener las mismas versiones y resolver manualmente las diferencias entre entornos.

Esto genera deriva de configuración, conflictos de puertos, dependencias implícitas, actualizaciones incompletas y dificultades para reconstruir un servidor. Las máquinas virtuales ayudan a aislar el sistema completo, pero cada una incluye un sistema operativo completo y puede reservar bastantes recursos.

Una imagen de Docker empaqueta la aplicación, sus dependencias y la configuración necesaria. Un contenedor se ejecuta como un proceso aislado, comparte el kernel del host y puede utilizar una red y volúmenes gestionados. La estructura habitual es:

```text
Host Linux
├── Contenedor Apache o Nginx
├── Contenedor de la aplicación
├── Contenedor de Tomcat
└── Contenedor de PostgreSQL, MySQL o Redis
```

Con un `Dockerfile` se documenta cómo se construye la imagen y con Docker Compose se pueden definir servicios, redes, volúmenes y variables de entorno. Un orquestador puede crear réplicas, sustituir contenedores defectuosos y distribuir la carga. Esto mejora la reproducibilidad, aunque no sustituye la actualización de seguridad, la gestión de secretos ni un diseño fiable de la aplicación.

**Material base:** páginas 14-15.

**Fuentes actuales:** [Docker: qué es un contenedor](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-a-container/) y [Docker: comparación entre contenedores y máquinas virtuales](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-a-container/).

## 5. Alojamientos múltiples y Virtual Hosts

El fichero `000-default` que aparece en el material pertenece a la distribución de Apache de Debian y Ubuntu. No es el nombre universal del archivo de configuración por defecto de Apache. En esas distribuciones suele estar en `/etc/apache2/sites-available/000-default.conf` (abreviado como `000-default` en el material), y se activa mediante un enlace simbólico desde `sites-enabled`.

Las directivas principales tienen funciones distintas:

- `Listen 80` y `Listen 443` indican los sockets en los que Apache acepta conexiones.
- `DocumentRoot` indica el directorio del sistema de archivos desde el que se sirve un sitio.
- `ServerName` identifica el nombre principal de un virtual host.
- `ServerAlias` permite asociar otros nombres al mismo sitio.
- `<VirtualHost *:80>` define un sitio que utiliza cualquier dirección local y el puerto 80.

`Listen 443` abre el socket en ese puerto, pero no activa por sí solo HTTPS; también hay que configurar el módulo TLS y el virtual host correspondiente. Un ejemplo simplificado sería:

```apache
<VirtualHost *:80>
    ServerName ejemplo.local
    ServerAlias www.ejemplo.local
    DocumentRoot /var/www/ejemplo
</VirtualHost>

<VirtualHost *:80>
    ServerName tienda.local
    DocumentRoot /var/www/tienda
</VirtualHost>
```

Ambos sitios pueden escuchar en la misma dirección IPv4 y en el mismo puerto porque la conexión no queda identificada únicamente por la IP. El DNS debe apuntar ambos nombres a esa misma dirección para que las peticiones lleguen al servidor correcto. Cuando llega una petición, Apache examina la dirección y el puerto y, si hay varios candidatos, compara el nombre recibido con `ServerName` y `ServerAlias`. Por ejemplo, estas peticiones pueden recibir contenidos diferentes:

```http
GET / HTTP/1.1
Host: ejemplo.local
```

```http
GET / HTTP/1.1
Host: tienda.local
```

La respuesta se obtiene de `/var/www/ejemplo` en el primer caso y de `/var/www/tienda` en el segundo. Si el nombre no coincide con ningún virtual host, Apache utiliza el primero que coincida con la dirección y el puerto, o el virtual host definido como predeterminado en la configuración.

En HTTPS hay una precisión adicional: el servidor necesita saber qué certificado debe presentar **antes** de recibir la cabecera `Host`. Por eso se utiliza la extensión **Server Name Indication (SNI)**. El nombre del servidor se incluye en el inicio de TLS para seleccionar el certificado y el virtual host correspondiente. Después de completar el cifrado, Apache vuelve a utilizar `Host` y las directivas del virtual host para atender la petición.

Por tanto, la afirmación del material de que los virtual hosts se distinguen únicamente por puertos diferentes queda incompleta. En Apache 2.4, los virtual hosts basados en nombre son precisamente la forma habitual de compartir una IP y un puerto. La combinación que identifica cada sitio está formada por la dirección, el puerto y el nombre solicitado, con SNI añadida al proceso de selección inicial de HTTPS.

**Material base:** páginas 22 y 25.

**Fuentes actuales:** [Apache: virtual hosts basados en nombre](https://httpd.apache.org/docs/2.4/en/vhosts/name-based.html) y [Apache: directiva `ServerName`](https://httpd.apache.org/docs/2.4/en/mod/core.html#servername).

# Bloque II: escalabilidad, balanceo e integración de servicios

## 6. Dimensionamiento: escalabilidad vertical frente a horizontal

La escalabilidad vertical, o *scale-up*, consiste en aumentar los recursos de un nodo existente: más CPU, más memoria, un disco más rápido o una máquina física o virtual más potente. La escalabilidad horizontal, o *scale-out*, consiste en añadir nuevos nodos y repartir la carga entre ellos.

| Criterio | Escalabilidad vertical (*scale-up*) | Escalabilidad horizontal (*scale-out*) |
|---|---|---|
| **Ventajas** | Es sencilla de implantar y monitorizar. Puede mejorar el rendimiento sin modificar la aplicación. Es útil para bases de datos o servicios que no se pueden duplicar fácilmente. | Permite aumentar capacidad de forma gradual y, normalmente, sin detener todo el servicio. Facilita el crecimiento por módulos y puede mejorar la disponibilidad si se añaden mecanismos de redundancia y conmutación. |
| **Limitaciones técnicas** | Existe un techo físico: cuando el servidor no puede crecer más, hay que migrarlo. Aumentar un componente puede no resolver un cuello de botella en otro, como el acceso a disco o la base de datos. | Requiere balanceo, coordinación, comunicación entre nodos, una estrategia de sesión coherente, despliegue automatizado y diseño de una base de datos capaz de soportar la concurrencia. La latencia de red puede reducir el rendimiento. |
| **Costes** | Puede exigir una parada para cambiar hardware y un equipo de mayor precio. El coste crece de forma importante al acercarse al límite del servidor. | Requiere más servidores, conmutadores de red, almacenamiento compartido, licencias o servicios de orquestación. El coste total aumenta, pero se puede crecer por fases y reutilizar nodos pequeños. |
| **Puntos únicos de fallo** | El servidor principal es un SPOF: si falla, se pierde la disponibilidad. | La sustitución de un nodo reduce este problema, pero no lo elimina automáticamente. El balanceador, la base de datos, la red o el almacenamiento pueden seguir siendo SPOF si no se redundan. |
| **Sesiones y estado** | Es más fácil mantener el estado en memoria local. | La memoria de un nodo no es suficiente: hay que usar afinidad, replicación o estado compartido. |

Un ejemplo sería aumentar la RAM de un único servidor Tomcat. Eso puede resolver rápidamente un problema de memoria, pero si el servidor falla, toda la aplicación deja de estar disponible. En un escalado horizontal se pueden ejecutar tres Tomcats, pero hay que añadir un balanceador, decidir qué ocurre con las sesiones y comprobar que la base de datos aguanta el aumento de peticiones.

La elección no es absoluta. Durante el crecimiento de una aplicación, una vertical puede ser más económica y sencilla. Cuando la demanda es variable o se necesita alta disponibilidad, el escalado horizontal suele ser más flexible. También es habitual combinar ambos: más recursos en cada nodo y varios nodos trabajando en paralelo.

**Material base:** páginas 15-17.

**Fuentes actuales:** [Apache: balanceo con `mod_proxy_balancer`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy_balancer.html) y [Tomcat: clustering](https://tomcat.apache.org/tomcat-11.0-doc/config/cluster.html).

## 7. Persistencia de sesiones en entornos distribuidos

HTTP es un protocolo sin estado. Para recordar el usuario entre varias peticiones, la aplicación necesita un mecanismo de sesión. El problema aparece cuando un balanceador envía la segunda petición de un usuario a otro nodo que no tiene el `HttpSession` guardado en su memoria local.

### Sticky sessions

Las sesiones pegajosas o *sticky sessions* intentan mantener la afinidad del usuario con un mismo nodo:

- por **IP**: el balanceador asocia la dirección del cliente a un servidor;
- por **cookie**: una cookie indica qué nodo debe atender la siguiente petición;
- también pueden utilizarse reglas de URL o etiquetas de ruta.

Ventajas:

- son sencillas de implantar;
- la aplicación puede seguir utilizando sesiones locales;
- no necesitan replicar todos los objetos de sesión.

Inconvenientes:

- la carga puede quedar desequilibrada si un usuario genera muchas peticiones;
- los usuarios que cambian de IP o pasan por otra red de proxies pueden perder la afinidad;
- si el nodo asignado falla, la sesión local se pierde;
- la cookie o la dirección IP del cliente debe protegerse y gestionarse correctamente;
- el balanceador mantiene información adicional sobre las rutas.

### Replicación de sesiones

Tomcat y otros servidores de clúster pueden replicar los objetos de sesión entre nodos. Así, si una petición llega a cualquiera de los nodos, este puede encontrar la información de la sesión.

El problema es que la replicación consume CPU, red y memoria, y puede introducir latencia. También hay que serializar y validar los objetos, gestionar la concurrencia y decidir qué ocurre cuando dos peticiones modifican la misma sesión. Una base de datos compartida también evita parte del problema, pero puede convertirse en un cuello de botella si cada lectura o escritura de sesión pasa por ella.

### Aplicaciones sin estado

En una aplicación *stateless*, los nodos no necesitan guardar la sesión en su memoria local. Hay dos opciones habituales:

1. **Almacenamiento distribuido:** se guarda la sesión en Redis o Memcached mediante un identificador opaco. Cada nodo consulta o actualiza ese repositorio.
2. **Tokens firmados:** un JWT contiene información de sesión o autorización, y su contenido está firmado por el servidor. Los nodos validan la firma y pueden atender la petición sin consultar la memoria de otro nodo.

Redis es una opción habitual para datos compartidos y ofrece estructuras y funciones de expiración. Memcached también puede utilizarse como caché distribuida, pero no debe tratarse como una base de datos durable sin más.

Un JWT firmado no es automáticamente seguro. Hay que utilizar algoritmos criptográficamente fuertes, controlar la expiración, proteger la clave, evitar incluir datos sensibles y tener un mecanismo de revocación o rotación. En muchos casos resulta más sencillo y revocable almacenar un identificador opaco en Redis que incluir todos los datos de sesión en un token. Si se utiliza una cookie de sesión, debe transportarse por HTTPS y emplear atributos como `HttpOnly`, `Secure` y `SameSite`.

En resumen, la opción más flexible suele ser una aplicación sin estado con almacenamiento compartido, mientras que las sesiones pegajosas son útiles para una transición rápida o para aplicaciones cuyo estado local no pueda cambiarse fácilmente.

**Material base:** páginas 16 y 27.

**Fuentes actuales:** [OWASP: gestión de sesiones](https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html), [Redis: almacenamiento de sesiones](https://redis.io/docs/latest/develop/use-cases/session-store/) y [RFC 6265 sobre cookies](https://www.rfc-editor.org/rfc/rfc6265).

## 8. Algoritmos de reparto de carga

Un balanceador decide qué nodo atiende cada petición. La elección puede hacerse en capa 4, trabajando con conexiones, o en capa 7, interpretando datos HTTP como la URL, las cabeceras o la cookie de sesión.

| Algoritmo | Principio | Ventaja | Limitación |
|---|---|---|---|
| **Round Robin** | Alterna las peticiones entre los nodos: A, B, C, A, B, C. | Muy sencillo, predecible y económico cuando todos los nodos tienen capacidad parecida. | No tiene en cuenta la duración de una petición, conexiones abiertas ni la carga real. Puede repartir mal una aplicación con peticiones muy distintas. |
| **Least Connections** | Selecciona el nodo con menos conexiones activas. | Se adapta mejor cuando unas peticiones ocupan el servidor durante mucho tiempo y otras son rápidas. | Depende de que el balanceador conozca correctamente las conexiones activas y puede no reflejar bien la CPU o la memoria utilizada. |
| **Weighted Round Robin** o balanceo ponderado | Reparte las peticiones según un peso asignado a cada nodo. Por ejemplo, un nodo de 8 núcleos puede recibir más tráfico que uno de 2. | Permite aprovechar hardware heterogéneo y ajustar capacidad de forma progresiva. | Los pesos deben mantenerse coherentes con la capacidad real; una mala estimación provoca saturación o desperdicio. |
| **Weighted Traffic Counting** | Tiene en cuenta los bytes transferidos y el peso configurado. | Útil cuando el coste de la aplicación depende mucho del tamaño de las respuestas. | Requiere estadísticas de tráfico y puede producir un reparto desigual con conexiones muy diferentes. |
| **LRU** | En una caché, elimina el elemento que lleva más tiempo sin utilizarse. | Mantiene los elementos utilizados más recientemente y puede favorecer la reutilización de recursos recién consultados. | **No es un algoritmo estándar de balanceo HTTP.** Es una política de expulsión de cachés, aunque algunos productos pueden aplicar una idea parecida a otros mecanismos internos. |

La diferencia entre *least connections* y *least response time* es que el primero cuenta conexiones y el segundo compara el tiempo de respuesta. También existen algoritmos basados en carga de CPU, colas, latencia o selección aleatoria ponderada. La elección debe realizarse observando métricas de rendimiento, no solo suponiendo que el reparto secuencial es suficiente.

Sobre LRU aplicado al tráfico HTTP, si un producto propietario lo utiliza con ese nombre, debe documentar qué tabla o estado está manteniendo: puede ser una decisión sobre rutas, sesiones o recursos de una caché, pero no existe una definición universal de LRU como algoritmo de reparto de carga.

La documentación actual de Apache `mod_proxy_balancer` ofrece métodos como Request Counting, Weighted Traffic Counting, Pending Request Counting y Heartbeat Traffic Counting. También permite sticky sessions mediante cookies o parámetros de URL, aunque estas deben utilizarse con precaución porque pueden crear desequilibrios y perder afinidad si cambia la ruta del cliente.

**Material base:** página 16.

**Fuentes actuales:** [Apache: algoritmos de `mod_proxy_balancer`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy_balancer.html), [Apache: Request Counting](https://httpd.apache.org/docs/2.4/en/mod/mod_lbmethod_byrequests.html) y [Apache: Weighted Traffic Counting](https://httpd.apache.org/docs/2.4/en/mod/mod_lbmethod_bytraffic.html).

## 9. Patrón Proxy Inverso y protocolo AJP

En el patrón de proxy inverso, Apache HTTPD es el servidor frontal y Tomcat queda detrás. Apache recibe la conexión pública, sirve el contenido estático, termina TLS y decide qué peticiones deben llegar a la aplicación.

```text
Cliente
  |
  | HTTP en 80 o HTTPS en 443
  v
Apache HTTPD
  ├── HTML, CSS, JS e imágenes
  ├── TLS, autenticación, cabeceras y registros
  └── Proxy inverso
        |
        | HTTP interno, HTTPS o AJP
        v
      Tomcat 1
      Tomcat 2
      Tomcat n
```

Las directivas `ProxyPass` y `BalancerMember` permiten configurar el proxy y sus miembros. `ProxyPreserveHost On` ayuda a que Tomcat reciba el nombre de host original, algo importante para construir redirecciones y enlaces absolutos correctos.

El protocolo **AJP/1.3** es un protocolo binario pensado para integrar Tomcat con un servidor web frontal. En el material aparece el puerto 8009, mientras que el conector HTTP de Tomcat suele utilizar el 8080 en los ejemplos de desarrollo. El protocolo AJP no es simplemente HTTP: transmite atributos internos de la petición, por lo que la documentación actual de Tomcat advierte que requiere extremar las precauciones de seguridad.

No es recomendable exponer Tomcat directamente a Internet por el puerto 8080, ni el conector AJP por el 8009, porque esa configuración puede eludir las políticas del servidor frontal y aumentar la superficie de ataque. Un servidor frontal permite:

- terminar TLS y redirigir todo el tráfico a HTTPS;
- ocultar la estructura interna de la aplicación;
- servir estáticos sin pasar por la JVM;
- aplicar límites, autenticación, cabeceras de seguridad y registros;
- comprobar el estado de los nodos antes de enviarles tráfico;
- cambiar de un nodo a otro sin modificar las URL públicas.

Además, el puerto 8080 no implica por sí mismo que el servicio sea seguro ni que esté protegido por TLS. El 8009 tampoco debe abrirse a cualquier red. El conector AJP debe utilizar un `secret` no vacío, configurar `secretRequired=true` y limitarse a una red privada o a la interfaz de loopback. La documentación de Tomcat 11 indica que el conector escucha en loopback por defecto en la configuración actual de sus conectores Java, pero es recomendable fijar explícitamente la dirección y verificar el firewall.

AJP no debe considerarse un sustituto de TLS en una red no confiable. Si Apache y Tomcat están en máquinas diferentes, la comunicación debe atravesar una red privada protegida, una VPN o un túnel seguro. Si no se puede garantizar la confianza de la red, es más seguro utilizar un proxy HTTP con TLS, autenticar las peticiones y cerrar los puertos de administración.

Por último, el balanceador no debe convertirse en un proxy abierto. Si se activan el `BalancerManager` o endpoints de administración, hay que protegerlos con autenticación, autorización y restricción de red.

**Material base:** páginas 29 y 32-33.

**Fuentes actuales:** [Tomcat 11: conector AJP](https://tomcat.apache.org/tomcat-11.0-doc/config/ajp.html), [Apache: `mod_proxy_ajp`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy_ajp.html) y [Apache: seguridad de `mod_proxy`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy.html#access).

## 10. Evolución de la administración de servicios en GNU/Linux

El material describe la administración mediante scripts SysV, como `/etc/init.d/apache2`, y mediante `apachectl`. Esas prácticas fueron habituales en distribuciones antiguas, pero las distribuciones actuales utilizan normalmente **systemd** como sistema de inicialización y gestión de servicios.

En Debian y Ubuntu, el nombre habitual de la unidad es `apache2.service`:

```console
sudo systemctl start apache2
sudo systemctl stop apache2
sudo systemctl restart apache2
sudo systemctl reload apache2
sudo systemctl status apache2 --no-pager --full
sudo systemctl enable apache2
sudo systemctl disable apache2
sudo systemctl is-active apache2
sudo systemctl is-enabled apache2
```

En RHEL, CentOS Stream, Rocky Linux y AlmaLinux el servicio suele denominarse `httpd.service`, por lo que se utiliza, por ejemplo:

```console
sudo systemctl status httpd --no-pager --full
```

`start`, `stop` y `restart` gestionan el estado del servicio. `reload` vuelve a leer la configuración de forma más suave, siempre que el módulo de recarga y la configuración lo permitan. `status` muestra si la unidad está activa, el proceso principal, los registros recientes y los errores. `enable` crea el enlace necesario para que el servicio se inicie automáticamente al arrancar el sistema; `is-active` e `is-enabled` permiten comprobar rápidamente su estado actual y su arranque automático.

Antes de aplicar una modificación de configuración es recomendable comprobar la sintaxis. En Debian y Ubuntu el comando suele ser `apache2ctl`:

```console
sudo apache2ctl configtest
```

En RHEL y sus derivados se utiliza normalmente `apachectl`:

```console
sudo apachectl configtest
```

Si la prueba devuelve `Syntax OK`, se puede recargar el servicio. `daemon-reload` solo es necesario cuando se ha creado o modificado una unidad de systemd; no hace falta ejecutarlo después de cambiar la configuración normal de Apache.

Esta administración ofrece ventajas frente a ejecutar scripts manualmente: los servicios se gestionan de forma uniforme, se registran como dependencias, se les puede activar al inicio, se les define un estado y se consultan sus registros mediante el journal. Las rutas y comandos citados en el material deben conservarse como contexto histórico, pero no constituyen la forma habitual de administrar Apache en una distribución actual.

**Material base:** páginas 24-25.

**Fuentes actuales:** [manual de `systemctl` de systemd](https://freedesktop.org/software/systemd/man/latest/systemctl.html) y [documentación de Apache sobre `apachectl`](https://httpd.apache.org/docs/2.4/en/programs/apachectl.html).

# Conclusiones

Las diez cuestiones muestran que una arquitectura web actual no se define únicamente por elegir un servidor web. También hay que separar responsabilidades, controlar el estado, diseñar la seguridad de las comunicaciones y aceptar que el crecimiento puede obligar a añadir nodos, balanceo y almacenamiento compartido.

Las ideas principales que se pueden extraer son:

- Apache y Tomcat pueden colaborar, pero no son componentes equivalentes y Tomcat no incorpora Apache.
- El contenido estático debe situarse donde pueda atenderse de forma eficiente, normalmente en el servidor frontal, CDN o caché.
- `file://` permite probar contenido estático, pero no reproduce el origen, CORS ni las capacidades de una aplicación servida por HTTP.
- Las tecnologías históricas no deben copiarse sin revisar sus riesgos; algunas, como CGI, tienen equivalentes modernizados.
- Los virtual hosts por nombre permiten compartir una única dirección IPv4 y los puertos 80 o 443.
- El escalado horizontal mejora la flexibilidad, pero obliga a resolver las sesiones, la consistencia y la disponibilidad del balanceador.
- Los puertos de aplicación, especialmente AJP, no deben exponerse sin una protección de red y una configuración segura.
- La administración de servicios se ha desplazado de los scripts SysV a `systemd` y `systemctl`.

# Fuentes consultadas

## Material de lectura

- *Implantación de arquitecturas web*, especialmente páginas 2-3, 5-7, 12, 14-17, 20-25 y 27-36.
- *Cuestionario de Investigación: Modelos y servicios Web*, páginas 1-2.

## Documentación técnica y referencias actuales

- [Apache HTTP Server 2.4: documentación principal](https://httpd.apache.org/docs/2.4/en/).
- [Apache HTTP Server 2.4: virtual hosts basados en nombre](https://httpd.apache.org/docs/2.4/en/vhosts/name-based.html).
- [Apache HTTP Server 2.4: directivas principales](https://httpd.apache.org/docs/2.4/en/mod/core.html).
- [Apache HTTP Server 2.4: `mod_proxy_balancer`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy_balancer.html).
- [Apache HTTP Server 2.4: `mod_proxy_ajp`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy_ajp.html).
- [Apache HTTP Server 2.4: seguridad de `mod_proxy`](https://httpd.apache.org/docs/2.4/en/mod/mod_proxy.html#access).
- [Apache Tomcat 11: documentación principal](https://tomcat.apache.org/tomcat-11.0-doc/index.html).
- [Apache Tomcat 11: conector AJP](https://tomcat.apache.org/tomcat-11.0-doc/config/ajp.html).
- [Apache Tomcat 11: clustering](https://tomcat.apache.org/tomcat-11.0-doc/config/cluster.html).
- [Docker: qué es un contenedor](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-a-container/).
- [MDN: CORS cuando la URL no es HTTP](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS/Errors/CORSRequestNotHttp).
- [MDN: módulos de JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules).
- [OWASP: Session Management Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html).
- [Redis: Session Store](https://redis.io/docs/latest/develop/use-cases/session-store/).
- [RFC 3875: Common Gateway Interface](https://www.rfc-editor.org/rfc/rfc3875).
- [OpenJDK JEP 398: Applet API](https://openjdk.org/jeps/398).
- [Manual de `systemctl`](https://freedesktop.org/software/systemd/man/latest/systemctl.html).
