# Teoría desfragmentada · Examen Unidad 1 · Entorno Cliente (DWEC)

> **Qué es esto:** el temario partido en **145 fichas atómicas**. Cada ficha es un concepto
> entero, se entiende **sin haber leído ninguna anterior** y apunta a las preguntas de
> `Bateria_Preguntas_Examen_Unidad1_DWEC.md` que resuelve.
>
> Fuentes: `Resumen T1 y T2 DWEC.pdf` (16 págs.), `Apuntes_Unidad1_Clientes_Web.docx` y los
> PDF de `Entorno Cliente\U1\Tema 1`, `Tema 1.2` … `Tema 1.6`.
> Cada apartado pesa **16,67 % del RA1 = 0,833 % de la nota final del módulo**.

## Cómo usar cada ficha

Las cuatro líneas son siempre las mismas:

| Línea | Qué es |
|---|---|
| **Teoría** | El concepto explicado desde cero. Si no lo entiendes aquí, vuelve al PDF. |
| **Dato exacto** | El literal que puede caer en una pregunta de opción o de desarrollo. |
| **Trampa** | La confusión que el temario provoca a propósito. |
| **Responde a** | Las preguntas de la batería que esta ficha te permite responder. |

**Ritmo de una sesión (45-60 min):**

1. Lee el bloque entero una vez sin retener nada, solo entender.
2. Cierra el documento y responde de memoria las preguntas de **Responde a** de cada ficha.
3. Vuelve y contrasta. Marca cada ficha como **la sé** o **la fallé** en la versión HTML
   (`Teoria_Desfragmentada_Unidad1_DWEC.html`), que guarda el progreso en el navegador.
4. Solo repasa las marcadas como falladas. No vuelvas a leer las que ya sabes.

**Reparto de los dos días (examen martes 6):**

| Día | Bloques |
|---|---|
| Domingo tarde | 0 (prerrequisitos) → 1.1 → 1.2 |
| Domingo noche | 1.3 → 1.4 |
| Lunes mañana | 1.5 → 1.6 → repaso de sintaxis |
| Lunes tarde | Los 14 ejercicios resueltos + las 151 preguntas |
| Lunes noche | Nada de temario nuevo |

## Índice

| Bloque | Tema | Fichas | Preguntas que resuelve |
|---|---|---|---|
| 0 | Prerrequisitos: HTTP, URL, servidores | 6 | 7 |
| 1.1 | Modelos de ejecución en servidor y cliente | 19 | 1.1.01 – 1.1.22 |
| 1.2 | Capacidades y mecanismos de los navegadores | 24 | 1.2.01 – 1.2.25 |
| 1.3 | Lenguajes de programación de cliente | 23 | 1.3.01 – 1.3.24 |
| 1.4 | Guiones (scripts) y objeto `Date` | 25 | 1.4.01 – 1.4.28 |
| 1.5 | Integración HTML + JavaScript | 11 | 1.5.01 – 1.5.12 |
| 1.6 | Herramientas de programación y prueba | 21 | 1.6.01 – 1.6.22 |
| E | Repaso práctico de sintaxis | 16 | Extra.01 – Extra.18 |
| | **Total** | **145** | **151** |

---

# Bloque 0 · Prerrequisitos (no están en el temario, pero sin ellos no se entiende)

### F-0-01 · Qué es una petición HTTP
**Teoría.** Al abrir una página, el navegador pide cada recurso al servidor: el documento HTML, el CSS, las imágenes, los scripts. Cada recurso es una petición (request) con un método, una URL y cabeceras; el servidor devuelve una respuesta (response) con un código de estado, cabeceras y el contenido.
**Dato exacto.** En el panel **Red** de las DevTools hay una fila por recurso, con su código (**200 OK**, **404 Not Found**, **500 Server Error**), su tiempo y su tamaño.
**Trampa.** "Petición" y "carga de página" no son lo mismo: una SPA hace muchas peticiones sin recargar la página.
**Responde a.** 1.1.10 · 1.2.11 · 1.6.13

### F-0-02 · Métodos GET y POST
**Teoría.** El método indica la intención de la petición: **GET** pide datos (van en la URL) y **POST** los envía (van en el cuerpo). El servidor es quien decide qué hacer con ellos.
**Dato exacto.** GET = obtener · POST = enviar · un GET no debería cambiar nada en el servidor.
**Trampa.** El método lo elige el cliente; el servidor solo lo atiende.
**Responde a.** 1.2.11

### F-0-03 · Códigos de estado: 200, 404, 500
**Teoría.** El primer dígito es la familia: **2xx** correcto, **3xx** redirección, **4xx** error del cliente, **5xx** error del servidor.
**Dato exacto.** 200 = correcto · 404 = no encontrado · 500 = error interno del servidor.
**Trampa.** Un 404 en un `.js` significa ruta incorrecta o fichero inexistente, **no** un error de sintaxis del JavaScript.
**Responde a.** 1.5.12 · 1.6.13

### F-0-04 · URL, DNS y dominio
**Teoría.** La URL es la dirección completa del recurso (protocolo + dominio + ruta). El **DNS** traduce el nombre de dominio a una dirección IP, que es donde vive el servidor.
**Dato exacto.** `https://educacionadistancia.juntadeandalucia.es/centro/curso` → protocolo `https`, dominio, ruta.
**Trampa.** El nombre de dominio no es la IP: el DNS es quien lo traduce.
**Responde a.** 1.2.01

### F-0-05 · HTTPS y certificados
**Teoría.** HTTPS es HTTP dentro de un canal cifrado con TLS. El certificado digital autentica al servidor y evita que el navegador avise de "conexión no segura".
**Dato exacto.** Sin HTTPS el navegador marca la página como no segura (el aviso del candado).
**Trampa.** HTTPS cifra el transporte, **no** el código: el código del cliente sigue siendo legible con F12.
**Responde a.** 1.1.03 · 1.2.01

### F-0-06 · Servidor dedicado frente a nube
**Teoría.** Un servidor dedicado es una máquina física que tú gestionas. La nube alquila capacidad **bajo demanda** y se paga por uso. El back-end vive en un dedicado o en una instancia en la nube.
**Dato exacto.** El temario cita **AWS (Amazon Web Services)**.
**Trampa.** "En la nube" no significa "en el cliente": la nube es back-end.
**Responde a.** 1.1.06

---

# 1.1 · Modelos de ejecución en servidor y cliente (CE 1.a)

### F-1.1-01 · El código del cliente se ejecuta en el navegador
**Teoría.** El front-end son HTML, CSS y JavaScript. El navegador los descarga, los interpreta y los ejecuta en el **dispositivo del usuario**, con su CPU, su RAM y su batería. El servidor solo entrega los archivos.
**Dato exacto.** Cliente = navegador + dispositivo del usuario. Servidor = máquina remota o nube.
**Trampa.** "JavaScript del cliente" no es "JavaScript en el servidor": eso es Node.js.
**Responde a.** 1.1.01 · 1.1.11

### F-1.1-02 · El back-end es privado, el front-end es público
**Teoría.** El código del servidor nunca se envía al navegador: se ejecuta allí y solo se comunica por la red. El código del cliente sí viaja entero, en texto plano, dentro de la petición.
**Dato exacto.** Todo el front-end se lee con **F12** (DevTools).
**Trampa.** Minificarlo u ocultarlo no es seguridad: sigue siendo público.
**Responde a.** 1.1.02

### F-1.1-03 · Por qué nada sensible va en el cliente
**Teoría.** Como el código del cliente es público y auditable, cualquier clave, contraseña o operación contable escrita en él es conocida por cualquiera. La regla: lo que aporta **integridad y seguridad** se resuelve en el servidor, el único sitio que el usuario no controla.
**Dato exacto.** Claves de cifrado, contraseñas, cobros y comprobación de permisos van **siempre** en el back-end.
**Trampa.** Validar un formulario solo en el cliente no protege nada: es una ayuda visual, no una garantía.
**Responde a.** 1.1.03

### F-1.1-04 · El nacimiento de la web
**Teoría.** La web nació para compartir documentos entre científicos. Tim Berners-Lee propuso un sistema de documentos enlazados, que fue el punto de partida de la World Wide Web.
**Dato exacto.** **1989** · **CERN** · **Tim Berners-Lee**.
**Trampa.** No es Bell Labs ni el MIT, y no es 1991: ese año fue el primer sitio web público.
**Responde a.** 1.1.04

### F-1.1-05 · W3C
**Teoría.** El World Wide Web Consortium es el organismo internacional que publica los **estándares** de la web (HTML5, CSS3, la forma de la etiqueta `<script>`) para que todo funcione igual en cualquier navegador.
**Dato exacto.** Su delegación española es **w3c.es**.
**Trampa.** El W3C no escribe navegadores: define estándares.
**Responde a.** 1.1.05

### F-1.1-06 · Computación en nube
**Teoría.** Es contratar espacio y potencia de cálculo bajo demanda en vez de comprar y mantener servidores propios. El back-end puede ejecutarse en un servidor dedicado o en una instancia en la nube.
**Dato exacto.** **AWS** (Amazon Web Services) es la plataforma que cita el temario.
**Trampa.** Nube ≠ cliente: la nube es la parte del servidor.
**Responde a.** 1.1.06

### F-1.1-07 · Los lenguajes del back-end
**Teoría.** El back-end se programa con lenguajes que se ejecutan en el servidor: PHP, Java, Python, C# (.NET) y Node.js.
**Dato exacto.** **Node.js = JavaScript en el servidor.**
**Trampa.** Node.js no es un lenguaje nuevo: es JavaScript fuera del navegador.
**Responde a.** 1.1.07

### F-1.1-08 · SQL frente a NoSQL
**Teoría.** Las relacionales (**SQL**) guardan la información en tablas de filas y columnas y se consultan con SQL. Las documentales (**NoSQL**) la guardan en documentos o bloques, con esquemas más flexibles.
**Dato exacto.** SQL: **MySQL, MariaDB**, PostgreSQL, Oracle · NoSQL documental: **MongoDB**.
**Trampa.** MongoDB no guarda tablas: guarda documentos, y ese es el motivo del nombre "documental".
**Responde a.** 1.1.08

### F-1.1-09 · Qué hace el back-end
**Teoría.** El back-end autentica usuarios, gestiona sesiones, se conecta a las bases de datos, resuelve consultas complejas y procesa los cobros con pasarelas de pago.
**Dato exacto.** Las tres tareas del temario: **autenticar · cobrar · conectar con la base de datos**.
**Trampa.** Maquetar la interfaz, escribir el HTML o aplicar colores es trabajo del front-end.
**Responde a.** 1.1.09

### F-1.1-10 · Acceso a los datos: solo el servidor, directo
**Teoría.** El navegador no habla nunca con el motor de base de datos. Accede a los datos de forma **indirecta**: hace una petición HTTP al servidor, y este, que sí tiene acceso directo al motor SQL o NoSQL, devuelve la respuesta.
**Dato exacto.** Cliente → petición HTTP → servidor → acceso directo → SQL / NoSQL.
**Trampa.** El `fetch()` del navegador va al servidor, nunca a la base de datos.
**Responde a.** 1.1.10

### F-1.1-11 · Recursos y latencia de cada lado
**Teoría.** Cada lado consume lo suyo: el front-end, la CPU, la RAM y la batería del dispositivo del usuario; el back-end, la potencia y los discos del servidor. La latencia del cliente es inmediata en acciones locales; la del servidor depende de la red y de la carga del servidor.
**Dato exacto.** Cliente = inmediatez · Servidor = red + carga.
**Trampa.** "El cliente siempre es más rápido" es falso en operaciones masivas: con 10.000 usuarios, ordenar en el servidor es 10.000 veces más trabajo.
**Responde a.** 1.1.11 · 1.1.12

### F-1.1-12 · La tabla comparativa cliente/servidor
**Teoría.** El temario compara ambos lados en varias filas: lugar de ejecución, visibilidad del código, recursos que consumen, latencia, acceso a los datos, escalado y tipo de aplicaciones que se pueden hacer.
**Dato exacto.** Visibilidad: cliente **público** (F12) / servidor **privado**.
**Trampa.** La fila que separa las dos columnas es la del acceso a la base de datos: directo en el servidor, indirecto en el cliente.
**Responde a.** 1.1.12 · 1.1.15

### F-1.1-13 · La regla de reparto
**Teoría.** La decisión literal del temario: lo que aporta **usabilidad e inmediatez** va al cliente (desplegar un menú, ordenar y filtrar datos ya cargados en memoria); lo que exige **integridad y seguridad** va al servidor (cobros, comprobar privilegios, consultas sobre millones de registros).
**Dato exacto.** **Usabilidad e inmediatez → cliente. Integridad y seguridad → servidor.**
**Trampa.** Ordenar y filtrar en memoria es del cliente; ordenar y filtrar millones de registros en la base de datos es del servidor.
**Responde a.** 1.1.13 · 1.1.14 · 1.1.15

### F-1.1-14 · Web clásica frente a SPA
**Teoría.** En la web clásica cada clic genera una petición y el servidor devuelve un HTML nuevo completo: la página se recarga con pantalla en blanco. En una SPA se descarga la plantilla y los recursos **una sola vez**; después, JavaScript pide solo los datos (empaquetados en JSON) y actualiza de forma selectiva las partes del árbol visual que cambian.
**Dato exacto.** SPA = **Single Page Application**: sin recarga + datos asíncronos en **JSON** + actualización selectiva del DOM.
**Trampa.** En una SPA el servidor ya no devuelve HTML de página: devuelve datos.
**Responde a.** 1.1.16

### F-1.1-15 · DevTools y renderizado
**Teoría.** Las **DevTools** son las utilidades de diagnóstico integradas en el navegador y se abren con F12, con Ctrl+Shift+I o con el clic derecho. **Renderizar** es el proceso por el que el motor del navegador calcula tamaño y posición de cada elemento y lo pinta en pantalla; no es compilar ni enviar la página al servidor.
**Dato exacto.** **F12** · **Ctrl + Shift + I** · clic derecho → *Inspeccionar*.
**Trampa.** Renderizar ≠ compilar: el motor de renderizado no genera binarios.
**Responde a.** 1.1.17 · 1.1.18

### F-1.1-16 · Medir el coste: console.time
**Teoría.** Para saber cuánto tarda una ordenación o un filtrado se mide con `console.time("etiqueta")` al empezar y `console.timeEnd("etiqueta")` al terminar: la consola muestra los **milisegundos** transcurridos.
**Dato exacto.** `time()` inicia la medida · `timeEnd()` la cierra e imprime los ms.
**Trampa.** El panel Network mide tiempos de **red**, no de cálculo.
**Responde a.** 1.1.19

### F-1.1-17 · El crecimiento real: O(n log n)
**Teoría.** `sort()` no es lineal: es **O(n log n)**. Al pasar de 150.000 a 500.000 registros el tiempo no se multiplica por 3,33 sino por algo mayor, porque el factor log también crece.
**Dato exacto.** `(500000·log₂500000)/(150000·log₂150000) ≈ 3,33·(18,93/17,19) ≈ 3,7`.
**Trampa.** Si te dicen que el tiempo se triplica exactamente al triplicar los datos, es falso: el crecimiento es superior al lineal.
**Responde a.** 1.1.20

### F-1.1-18 · El orden en paralelo
**Teoría.** Si 10.000 usuarios tardan 60 ms en ordenar el catálogo y lo hacen en su dispositivo, el cómputo total sigue siendo el mismo, pero repartido: cada uno espera solo su propio tiempo. Eso reduce la carga y el coste de infraestructura, mejora la escalabilidad (cada usuario aporta su propia potencia) y baja la latencia percibida.
**Dato exacto.** `10.000 × 60 ms = 600.000 ms = 600 s` de CPU, **repartidos** entre 10.000 dispositivos.
**Trampa.** No se ahorra cómputo: se reparte. La ventaja es la distribución, no la desaparición del trabajo.
**Responde a.** 1.1.21

### F-1.1-19 · Paginación y carga progresiva
**Teoría.** Descargar 8 millones de registros al cliente (cientos de megabytes de RAM, mucho tiempo de descarga, bloqueo del hilo principal y riesgo de agotar la memoria) no es viable. La solución es pedir solo lo necesario: paginación con `LIMIT`/`OFFSET` en lotes de unos 50 registros, ordenación y filtrado en el servidor apoyados en **índices**, carga progresiva (scroll infinito o "cargar más") y virtualización de la lista.
**Dato exacto.** ~**50 registros** por página · `LIMIT`/`OFFSET` · **índices** en el servidor.
**Trampa.** La paginación no son solo los botones de "siguiente": la ordenación y el filtrado también van al servidor.
**Responde a.** 1.1.22

---

# 1.2 · Capacidades y mecanismos de los navegadores (CE 1.b)

### F-1.2-01 · Los 7 módulos del navegador
**Teoría.** Por dentro, un navegador se divide en: interfaz de usuario, motor del navegador, motor de renderizado, motor de JavaScript, capa de red, UI backend y almacenamiento de datos.
**Dato exacto.** UI · browser engine · motor de renderizado · motor de JS · red · UI backend · almacenamiento.
**Trampa.** "Motor del navegador" y "motor de renderizado" no son lo mismo: el primero coordina, el segundo pinta.
**Responde a.** 1.2.01

### F-1.2-02 · Browser engine, motor de renderizado y motor de JavaScript
**Teoría.** El **motor del navegador (browser engine)** es el puente entre la interfaz externa y los motores internos: gestiona órdenes como abrir una pestaña nueva o descargar un archivo. El **motor de renderizado** dibuja los píxeles y el **motor de JavaScript** interpreta el código.
**Dato exacto.** Browser engine = **coordina** · Renderizado = **pinta** · Motor de JS = **interpreta**.
**Trampa.** "Motor del navegador" no es "motor de JavaScript".
**Responde a.** 1.2.02

### F-1.2-03 · UI backend
**Teoría.** Es el módulo que conecta el navegador con el **sistema operativo** para poder dibujar controles con aspecto nativo: las ventanas de alerta, los selectores de archivo, los menús del sistema.
**Dato exacto.** UI backend = **el 6.º de los 7 módulos**.
**Trampa.** La ventana de `alert()` la dibuja el sistema operativo, no el motor de renderizado.
**Responde a.** 1.2.01

### F-1.2-04 · Los motores de cada navegador
**Teoría.** Los navegadores actuales usan un motor de renderizado y un motor de JavaScript distintos: Blink con V8 en los basados en Chromium, Gecko con SpiderMonkey en Firefox, WebKit con JavaScriptCore en Safari.
**Dato exacto.** Chrome/Edge/Brave/Opera = **Blink + V8** · Firefox = **Gecko + SpiderMonkey** · Safari = **WebKit + JavaScriptCore**.
**Trampa.** Blink es el de renderizado y V8 el de JavaScript: ponerlos al revés es la respuesta incorrecta clásica.
**Responde a.** 1.2.04

### F-1.2-05 · Blink
**Teoría.** Chrome usó el motor WebKit (el de Apple) hasta 2013. Ese año Google bifurcó el proyecto y nació **Blink**, hoy el motor de la mayoría de navegadores basados en Chromium.
**Dato exacto.** **2013** · Chrome salió en **2008** (no en 2013).
**Trampa.** Blink no es un motor de JavaScript: es de renderizado.
**Responde a.** 1.2.05

### F-1.2-06 · iOS obliga a usar WebKit
**Teoría.** En iPhone y iPad cualquier navegador usa internamente el motor WebKit, aunque se llame Chrome o Firefox, porque lo impone la política de la tienda de aplicaciones de Apple.
**Dato exacto.** Todos los navegadores de **iOS** = **WebKit** por dentro.
**Trampa.** En iOS no hay diferencia entre navegadores: solo cambia la envoltura.
**Responde a.** 1.2.06

### F-1.2-07 · JIT (Just-In-Time)
**Teoría.** El motor de JavaScript detecta qué funciones se ejecutan muchas veces y las traduce directamente a **código máquina nativo** del procesador. Esa compilación en tiempo de ejecución es el JIT.
**Dato exacto.** JIT = **Just-In-Time** · las funciones muy ejecutadas se compilan a **código máquina**.
**Trampa.** "JavaScript no se compila nunca" es **falso**: el JIT compila lo que se usa mucho.
**Responde a.** 1.2.03 · 1.4.10

### F-1.2-08 · Los 4 pasos del renderizado
**Teoría.** El motor de renderizado construye dos árboles en memoria (**DOM** y **CSSOM**), los combina en un **Render Tree**, calcula la disposición de cada caja (**layout**: ancho, alto y coordenadas) y por último **pinta** los píxeles.
**Dato exacto.** 1) DOM + CSSOM → 2) **Render Tree** → 3) **Layout** → 4) **Paint**.
**Trampa.** El orden va de la estructura al píxel: nadie pinta antes de calcular la disposición.
**Responde a.** 1.2.07

### F-1.2-09 · Qué queda fuera del Render Tree
**Teoría.** El Render Tree solo incluye los elementos **visibles**. Quedan fuera la cabecera `<head>` y los elementos con `display: none`, aunque estén presentes en el DOM.
**Dato exacto.** Fuera: **`<head>`** y **`display: none`**.
**Trampa.** No es que `display: none` borre el elemento del DOM: sigue ahí, solo que no se pinta.
**Responde a.** 1.2.08

### F-1.2-10 · Un script sin defer ni async
**Teoría.** Si el navegador encuentra un `<script>` sin esos atributos mientras lee el HTML, **detiene el análisis** hasta que el archivo se descarga y se ejecuta por completo. Si el script es pesado, la pantalla se queda en blanco unos instantes.
**Dato exacto.** Sin atributo = **bloquea el parseo** y ejecuta de inmediato.
**Trampa.** El navegador no lo salta ni lo aplaza: lo espera.
**Responde a.** 1.2.09

### F-1.2-11 · La etiqueta script en HTML5
**Teoría.** HTML5 ya no necesita el atributo `type="text/javascript"`: el navegador asume que es JavaScript. El atributo `language="javascript"` no es válido en HTML5.
**Dato exacto.** `<script>…</script>` · el cierre `</script>` es **obligatorio**.
**Trampa.** `type` sigue existiendo para otros usos (`type="module"`, `type="importmap"`), pero ya no para declarar el lenguaje.
**Responde a.** 1.2.10 · 1.5.01

### F-1.2-12 · Catálogo de capacidades del navegador
**Teoría.** El navegador de escritorio puede modificar el DOM y los estilos, guardar datos en local, pedir datos a un servidor **sin recargar la página** con `fetch()`, usar la cámara o el micrófono y leer archivos del disco.
**Dato exacto.** La API que pide datos sin recargar la página es **`fetch()`** (peticiones en segundo plano).
**Trampa.** `console.log()` y `alert()` no son peticiones al servidor: son salidas y diálogos.
**Responde a.** 1.2.11

### F-1.2-13 · Capacidades que exigen permiso del usuario
**Teoría.** Todo lo que toca el dispositivo físico o datos personales del usuario requiere autorización explícita, con una pregunta del navegador.
**Dato exacto.** Geolocalización · cámara · micrófono · **estado de la batería** · **estado de la red**.
**Trampa.** Modificar el DOM o guardar en `localStorage` no necesitan permiso.
**Responde a.** 1.2.14

### F-1.2-14 · Cómo comprobar que el navegador soporta una función
**Teoría.** Los navegadores incorporan las novedades en momentos distintos, así que antes de usar una función se comprueba que existe con el operador `in` dentro de un `if`. Para saber en qué versiones funciona cada característica está **Can I Use** (caniuse.com).
**Dato exacto.** `if ("geolocation" in navigator) { … }` · **caniuse.com**.
**Trampa.** El método que explica el temario es `in`, no un `try { … } catch`.
**Responde a.** 1.2.15

### F-1.2-15 · Los cuatro mecanismos de salida
**Teoría.** Hay cuatro formas de sacar información del script: a la consola (invisible), a un elemento de la página (visible), al flujo del documento con `document.write()` (visible pero obsoleto) y a una ventana modal del sistema con `alert()` (visible y bloqueante).
**Dato exacto.** `console.log()` **no se ve** en la página · `innerHTML` / `textContent` sí · `document.write()` sí · `alert()` sí.
**Trampa.** Si el enunciado dice "que el texto se vea en la página", la respuesta es `innerHTML` o `textContent`, **nunca `console.log()`**.
**Responde a.** 1.2.19 · Extra.18

### F-1.2-16 · alert: modal, síncrono y bloqueante
**Teoría.** `window.alert()` abre una ventana **modal nativa del sistema operativo** con un mensaje y un botón de aceptar. Es síncrona: hasta que el usuario pulsa "Aceptar" el hilo principal de JavaScript queda congelado, las animaciones se paran y la página no atiende otros eventos.
**Dato exacto.** Modal del **sistema operativo** · **bloqueante** · `window.alert("x")` es igual que `alert("x")`.
**Trampa.** No es un `div` ni un método del DOM: es una ventana del sistema operativo.
**Responde a.** 1.2.21 · 1.2.18

### F-1.2-17 · document.write() está obsoleto
**Teoría.** Solo funciona de forma segura mientras el navegador está cargando la página. Si se llama **después** de que la página haya cargado, **borra de forma irreversible todo el documento** y deja solo lo escrito en esa llamada. Hoy se usa `textContent` o `innerHTML`.
**Dato exacto.** Tras la carga = **borra todo el documento**.
**Trampa.** No añade el texto al final: lo borra.
**Responde a.** 1.2.20

### F-1.2-18 · console.warn, console.error, console.time
**Teoría.** La consola tiene niveles de mensaje: `warn()` emite **avisos amarillos** y `error()` muestra los **errores en rojo**. `time("etiqueta")` y `timeEnd("etiqueta")` miden el tiempo entre ambas llamadas y lo muestran en **milisegundos**.
**Dato exacto.** `warn()` = amarillo · `error()` = rojo · `time()`/`timeEnd()` = **ms**.
**Trampa.** No sirven para modificar la página ni para declarar variables.
**Responde a.** 1.2.22

### F-1.2-19 · El DOM
**Teoría.** El navegador crea en la **memoria RAM** una estructura en forma de **árbol invertido** a partir del documento: el **DOM (Document Object Model)**. Cada etiqueta es un nodo y cada nodo es un objeto con propiedades y métodos.
**Dato exacto.** DOM = **Document Object Model** · vive en **RAM**, no en el fichero.
**Trampa.** JavaScript **no dibuja** en la tarjeta gráfica: modifica el DOM y es el motor de renderizado quien pinta.
**Responde a.** 1.2.16

### F-1.2-20 · window es la raíz global
**Teoría.** El objeto raíz del navegador es **`window`** (el BOM). `document` (el DOM) **cuelga de él** como una propiedad: `window.document`. El árbol es `window → document → html → head/body`.
**Dato exacto.** `window.document` · el BOM es la raíz y el DOM cuelga de él.
**Trampa.** `document` no es un objeto paralelo a `window`: es una **propiedad** suya.
**Responde a.** 1.2.17 · 1.2.18

### F-1.2-21 · Reflow y repaint
**Teoría.** **Reflow** es el recálculo de dimensiones y posiciones: ocurre cuando cambia algo que altera el espacio (por ejemplo `fontSize` o el contenido de un elemento). **Repaint** es redibujar píxeles sin recalcular el espacio: por ejemplo al cambiar `color` o `backgroundColor`.
**Dato exacto.** Reflow: `fontSize`, `innerHTML` · Repaint: `color`, `backgroundColor`.
**Trampa.** Cambiar el color no hace reflow; cambiar el tamaño de letra sí.
**Responde a.** 1.2.24

### F-1.2-22 · camelCase: el guion es la resta
**Teoría.** En JavaScript el guion significa **resta**, así que las propiedades CSS compuestas se escriben en **camelCase**: se elimina el guion y se pone en mayúscula la letra siguiente. El valor es **siempre una cadena** e **incluye la unidad**.
**Dato exacto.** `background-color → style.backgroundColor` · `font-size → style.fontSize` · `style.fontSize = "25px"`.
**Trampa.** Escribir `style.font-size` es un error de sintaxis, y `style.fontSize = 25` sin unidad no aplica nada visible.
**Responde a.** 1.2.25 · Extra.15

### F-1.2-23 · Los cuatro almacenes del navegador
**Teoría.** Las **cookies** guardan muy poco texto y viajan al servidor en cada petición (sesión). **sessionStorage** vive mientras la pestaña siga abierta. **localStorage** es permanente. **IndexedDB** es una base de datos grande en el navegador, para trabajar sin conexión.
**Dato exacto.** cookie ≈ **4 KB** y va al servidor · sessionStorage = hasta cerrar la pestaña (~5 MB) · localStorage = permanente (5-10 MB) · IndexedDB = sin conexión.
**Trampa.** La que se borra al cerrar la pestaña es `sessionStorage`; `localStorage` sobrevive al cierre del navegador.
**Responde a.** 1.2.12 · 1.2.13

### F-1.2-24 · XSS: innerHTML frente a textContent
**Teoría.** Al escribir contenido en un elemento, `innerHTML` **interpreta** el texto como HTML; si el dato viene de un usuario desconocido, podría inyectar un `<script>` malicioso que se ejecute en el navegador de los demás. Para texto plano se recomienda **`textContent`**, que no interpreta HTML y además es más rápido.
**Dato exacto.** XSS = **Cross-Site Scripting** · texto plano → **`textContent`**.
**Trampa.** El riesgo aquí no es SQL injection (eso ocurre contra la base de datos, en el servidor): es inyección de HTML en el navegador.
**Responde a.** 1.2.23

---

# 1.3 · Lenguajes de programación de cliente (CE 1.c)

### F-1.3-01 · HTML y CSS no son lenguajes de programación
**Teoría.** HTML es un **lenguaje de marcado** basado en etiquetas y CSS es un **lenguaje declarativo de estilos**. Ninguno de los dos tiene variables, bucles ni condiciones, así que no son lenguajes de programación.
**Dato exacto.** HTML = **marcado** · CSS = **declarativo de estilos** · JavaScript = el único de la tríada que es lenguaje de programación.
**Trampa.** "HTML es un lenguaje de programación" es falso; y "CSS también", por el mismo motivo.
**Responde a.** 1.3.01

### F-1.3-02 · La tríada
**Teoría.** Cada capa tiene una responsabilidad: **HTML** aporta estructura y semántica, **CSS** aporta aspecto, estética y maquetación, **JavaScript** aporta dinamismo (eventos, validación local y cambios en caliente del documento).
**Dato exacto.** HTML = estructura · CSS = presentación · JavaScript = lógica y eventos.
**Trampa.** Son capas independientes: se puede cambiar el CSS sin tocar el HTML, y al revés.
**Responde a.** 1.3.02

### F-1.3-03 · Cómo es JavaScript
**Teoría.** Es un lenguaje **dinámico** (el tipo lo determina el valor, no la declaración), **débilmente tipado** (una variable puede cambiar de tipo) y **orientado a eventos** (su unidad de trabajo es el manejador que responde a un evento).
**Dato exacto.** **Dinámico** · **débilmente tipado** · **orientado a eventos**.
**Trampa.** "Tipado estático" describe a TypeScript, no a JavaScript.
**Responde a.** 1.3.03

### F-1.3-04 · TypeScript
**Teoría.** Es una **capa sobre JavaScript** que le añade **tipado estático**: se escribe con tipos y se compila a JavaScript estándar, que es el que llega al navegador. Se usa como estándar actual de la industria.
**Dato exacto.** Superconjunto de Microsoft que **añade tipado estático** y **se compila a JavaScript**.
**Trampa.** El navegador no ejecuta TypeScript: ejecuta el JavaScript generado.
**Responde a.** 1.3.04

### F-1.3-05 · 1995: Brendan Eich
**Teoría.** JavaScript nació en **mayo de 1995**, cuando la web estaba dominada por Netscape. **Brendan Eich** lo escribió en unos **10 días** para dar interactividad básica a los documentos HTML. Antes se llamó Mocha y después LiveScript.
**Dato exacto.** **1995** · **Brendan Eich** · **Netscape** · **10 días** · Mocha → LiveScript → JavaScript.
**Trampa.** James Gosling es el de Java: no es el autor de JavaScript.
**Responde a.** 1.3.05

### F-1.3-06 · 1996: JScript y la guerra de navegadores
**Teoría.** Microsoft lanzó **JScript** con Internet Explorer 3.0, obtenido por ingeniería inversa del motor de Netscape. Empezó así la primera **guerra de navegadores**, y con ella los problemas de compatibilidad entre navegadores.
**Dato exacto.** **1996** · **Microsoft** · **Internet Explorer 3.0** · ingeniería inversa → **guerra de navegadores**.
**Trampa.** En 1996 no nació ECMAScript (nació en 1997) ni se publicó ES5 (2009).
**Responde a.** 1.3.06

### F-1.3-07 · 1997: ECMAScript
**Teoría.** Netscape entregó la especificación a **Ecma International** y nació **ECMAScript (ECMA-262)**, que es el estándar. **JavaScript es una implementación** de ese estándar.
**Dato exacto.** **1997** · **ECMA-262** · ECMAScript = estándar · JavaScript = implementación.
**Trampa.** La relación está invertida en casi todas las trampas: el estándar es ECMAScript.
**Responde a.** 1.3.07

### F-1.3-08 · 1999: ES3
**Teoría.** ES3 consolidó el lenguaje durante una década. Aportó **expresiones regulares**, **`try/catch`** y mejoras en el manejo de cadenas y objetos.
**Dato exacto.** **1999** (1998-1999) · expresiones regulares · `try/catch`.
**Trampa.** Las funciones flecha y `let` son de ES6 (2015), no de ES3.
**Responde a.** 1.3.08

### F-1.3-09 · ES4 abandonado y el atasco del TC39
**Teoría.** La propuesta **ES4** era una reescritura radical del lenguaje (con tipado estático y clases) y se abandonó por su **complejidad** y por falta de consenso del comité **TC39**, que estuvo en desacuerdo entre 2000 y 2008. De ahí el salto de ES3 a ES5.
**Dato exacto.** ES4 = **abandonado** · TC39 en desacuerdo entre **2000 y 2008**.
**Trampa.** ES4 no es "la versión que no llegó por falta de fondos": existió como propuesta técnica.
**Responde a.** 1.3.09

### F-1.3-10 · 2005: AJAX
**Teoría.** **Jesse James Garrett** acuñó el término **AJAX** en **2005** para describir la combinación de pedir datos en segundo plano y mostrarlos en la página sin recargarla. Lo hace posible la API **XMLHttpRequest**.
**Dato exacto.** **Jesse James Garrett** · **2005** · **`XMLHttpRequest`** · Google Maps y Gmail como ejemplos.
**Trampa.** `fetch()` es posterior: en 2005 la API era XMLHttpRequest.
**Responde a.** 1.3.10

### F-1.3-11 · 2006: jQuery, Prototype y MooTools
**Teoría.** Aparecieron tres librerías para **unificar las APIs del DOM**, que eran distintas en cada navegador. Ese problema es el que explica por qué hoy existen los frameworks.
**Dato exacto.** **jQuery**, **Prototype**, **MooTools** (2006).
**Trampa.** React, Vue y Angular no nacieron para eso: son plataformas completas.
**Responde a.** 1.3.11

### F-1.3-12 · 2009: ES5
**Teoría.** ECMAScript 5 (**diciembre de 2009**) incorporó modo estricto (`"use strict"`), métodos funcionales de array, **soporte nativo de JSON**, getters y setters, `Object.freeze` y `Object.keys`.
**Dato exacto.** **diciembre de 2009** · "use strict" · JSON nativo · getters/setters.
**Trampa.** No incluyó funciones flecha ni `const`: eso llegó en ES6.
**Responde a.** 1.3.12

### F-1.3-13 · 2008-2009: V8 y Node.js
**Teoría.** En esas fechas Google lanzó Chrome con el motor **V8**, que compila con JIT. **Ryan Dahl** lo usó como base para crear **Node.js**, llevando JavaScript al back-end. Sigue siendo JavaScript, pero fuera del navegador.
**Dato exacto.** **Ryan Dahl** · sobre el motor **V8** · **2008-2009**.
**Trampa.** Node.js no es un lenguaje nuevo: es JavaScript ejecutándose en el servidor.
**Responde a.** 1.3.13

### F-1.3-14 · 2015: ES6 y las 4 fases
**Teoría.** **ES6 / ECMAScript 2015** fue la mayor refundición desde 1995: `let`, `const`, funciones flecha, clases, módulos y plantillas de texto. A partir de ahí el TC39 aprobó un proceso de **4 fases (Stages 0 a 4)** con **publicaciones anuales**.
**Dato exacto.** **ES2015** · `let`, `const`, flecha, clases, módulos, plantillas · **4 fases** · **publicación anual**.
**Trampa.** Las 4 fases son del proceso de propuestas **posterior** a ES6, no de ES6 en sí.
**Responde a.** 1.3.14

### F-1.3-15 · Las 4 ventajas de los frameworks
**Teoría.** El temario destaca cuatro: **coste nulo** de licencia, **fiabilidad** (más seguridad y mejor rendimiento), **velocidad de entrega** y **estandarización** (todos los equipos del proyecto hablan el mismo idioma).
**Dato exacto.** **Coste nulo** · **fiabilidad/seguridad/rendimiento** · **velocidad de entrega** · **estandarización de equipos**.
**Trampa.** No son frameworks "gratis porque sean de código abierto": lo relevante es que no hay coste de licencia.
**Responde a.** 1.3.15

### F-1.3-16 · React
**Teoría.** Framework de **Meta (Facebook)** que usa **DOM virtual** y **JSX**, con programación **orientada a componentes** reutilizables, cada uno con su propio estado.
**Dato exacto.** **Meta (Facebook)** · **DOM virtual** · **JSX** · componentes con estado propio.
**Trampa.** React lo creó Meta, no Google; y JSX no es un lenguaje aparte (ver F-1.3-21).
**Responde a.** 1.3.16

### F-1.3-17 · Angular
**Teoría.** Framework de **Google** que se programa en **TypeScript** y tiene una curva de aprendizaje **pronunciada** (inyección de dependencias, RxJS, rigidez estructural). La primera versión se llamaba **AngularJS**.
**Dato exacto.** **Google** · **TypeScript** · curva **pronunciada** · antes **AngularJS**.
**Trampa.** No se programa en JavaScript puro: su lenguaje es TypeScript.
**Responde a.** 1.3.17

### F-1.3-18 · Vue
**Teoría.** Lo diseñó **Evan You** con la premisa de tomar las **mejores características de React y de Angular**. Usa DOM virtual, tiene curva de aprendizaje **progresiva** y se combina bien con back-ends como Laravel.
**Dato exacto.** **Evan You** · mejores ideas de React y Angular · DOM virtual · curva **progresiva** · Laravel.
**Trampa.** No es de Google ni de Meta.
**Responde a.** 1.3.18

### F-1.3-19 · Alternatives al trío principal
**Teoría.** El temario cita también **EmberJS** (convención sobre configuración), **BackboneJS** (modelos y vistas ligeras) y **MeteorJS** (tiempo real, cliente y servidor unificados), además de Aurelia.js, Polymer y Mithril.js.
**Dato exacto.** EmberJS · BackboneJS · MeteorJS · Aurelia.js · Polymer · Mithril.js.
**Trampa.** Django, Rails, Laravel y Symfony son frameworks de back-end, no de cliente.
**Responde a.** 1.3.19

### F-1.3-20 · El DOM virtual
**Teoría.** El framework guarda en RAM una **copia ligera del DOM**. Cuando cambian los datos, calcula las **diferencias mínimas** entre esa copia y el DOM real (reconciliación) y **actualiza solo los nodos necesarios**, lo que minimiza los costosos reflow y repaint.
**Dato exacto.** copia en RAM → **diferencias mínimas** → actualizar **solo lo necesario**.
**Trampa.** El DOM virtual no acelera al navegador por sí mismo: sirve para no tocar el DOM real innecesariamente.
**Responde a.** 1.3.20

### F-1.3-21 · JSX
**Teoría.** Es una **extensión de sintaxis de JavaScript**, parecida a un lenguaje de plantillas, que **se compila a JavaScript**. Se usa sobre todo con React.
**Dato exacto.** JSX = **extensión de JavaScript** que **se compila a JavaScript**.
**Trampa.** "JSX es un lenguaje de programación independiente" es falso.
**Responde a.** 1.3.21

### F-1.3-22 · La programación reactiva
**Teoría.** Se declara la relación entre los datos y, cuando un valor cambia, los dependientes **se actualizan solos**. La analogía es la **hoja de cálculo**: si C1 contiene `=A1+B1`, al cambiar A1 o B1 se recalcula. La usan Vue, React y Angular.
**Dato exacto.** analogía de la **hoja de cálculo** · "recalcula solo".
**Trampa.** No es que el programa se ejecute solo: es que la dependencia está declarada.
**Responde a.** 1.3.22

### F-1.3-23 · Tres formas de declarar una función
**Teoría.** La **declaración tradicional** (`function f(){}`) se eleva al principio de su ámbito (**hoisting**) y se puede llamar antes de escribirla. La **expresión de función** (`const f = function(){}`) y la **flecha** (`const f = () => {}`) no. En la flecha, si el cuerpo es una sola expresión, el `return` y las llaves son implícitos.
**Dato exacto.** Solo la **declaración** tiene hoisting · `const sumar = (a, b) => a + b;` · `const cuadrado = x => x * x;` (un parámetro, sin paréntesis).
**Trampa.** Una flecha **con llaves** se comporta como una función normal y necesita `return` explícito.
**Responde a.** 1.3.23 · 1.3.24

---

# 1.4 · Programación de guiones (scripts) y objeto `Date` (CE 1.d)

## Guiones (scripts)

### F-1.4-01 · Qué es un script
**Teoría.** Un guion (*script*) nació como **secuencia de comandos** para **automatizar tareas rutinarias y repetitivas** de los sistemas operativos. Hoy son programas completos de miles de líneas y **siempre los ejecuta un intérprete** o motor subyacente.
**Dato exacto.** Guion = secuencia de comandos · siempre ejecutado por un **intérprete**.
**Trampa.** "Script" no significa "pequeño": hoy un guion puede tener miles de líneas.
**Responde a.** 1.4.01

### F-1.4-02 · Compilación e interpretación
**Teoría.** En los lenguajes tradicionales el programador **compila antes de ejecutar** y se genera un ejecutable. En los de script **no hay paso previo**: el intérprete va leyendo y ejecutando línea a línea en tiempo de ejecución.
**Dato exacto.** tradicional = compilación previa · script = interpretación en tiempo de ejecución.
**Trampa.** La opción "ambos necesitan compilarse" no es una diferencia: es justo lo que los diferencia.
**Responde a.** 1.4.02

### F-1.4-03 · El anfitrión (host)
**Teoría.** El anfitrión es el entorno que permite ejecutar el script y del que **reutiliza los componentes preexistentes**. En JavaScript el anfitrión es el **navegador**: los elementos HTML, el DOM, el motor gráfico y la red.
**Dato exacto.** Anfitrión de JavaScript = **el navegador**.
**Trampa.** El anfitrión no es el compilador: es quien aloja el script y le da los servicios.
**Responde a.** 1.4.03

### F-1.4-04 · Cuándo se detectan los errores
**Teoría.** En un lenguaje tradicional, el error se detecta **al compilar**: si hay un fallo, no se genera el ejecutable. En un script, el error aparece **en tiempo de ejecución**, en la línea exacta que falla, y detiene el script a partir de ahí.
**Dato exacto.** tradicional = error en **compilación** · script = error en **ejecución**, línea a línea.
**Trampa.** Por eso en los scripts hay que probar: un fallo en una rama poco transitada puede pasar inadvertido.
**Responde a.** 1.4.04

### F-1.4-05 · La clasificación del temario
**Teoría.** El temario clasifica como **tradicionales** a C, C++, Java, Swift y Pascal; y como **de script** a JavaScript, Shell, Perl, PHP, Python y Ruby.
**Dato exacto.** Tradicionales: **C, C++, Java, Swift, Pascal** · De script: **JavaScript, Shell, Perl, PHP, Python, Ruby**.
**Trampa.** Python y Ruby son de script, no tradicionales.
**Responde a.** 1.4.05

### F-1.4-06 · Nativos frente a gestionados por máquina virtual
**Teoría.** Dentro de los tradicionales, los **compilados nativos** producen binarios autónomos que no necesitan nada instalado (C++, Go, Rust). Los **gestionados** se compilan a código intermedio y necesitan un entorno instalado para ejecutarse: Java necesita la JVM y C# necesita .NET.
**Dato exacto.** Nativos: **C++, Go, Rust** · Gestionados: **Java → JVM**, **C# → .NET**.
**Trampa.** Los gestionados **sí** se compilan: a código intermedio.
**Responde a.** 1.4.06

### F-1.4-07 · La frontera se ha difuminado
**Teoría.** La frontera entre tradicional y de script ya no es nítida: JavaScript y Python corren también **fuera del navegador** (Node.js, terminal) y pueden **empaquetarse** como aplicaciones con PyInstaller, pkg o Electron.
**Dato exacto.** Fuera del navegador: **Node.js**, terminal · empaquetado: **PyInstaller, pkg, Electron**.
**Trampa.** Que un lenguaje de script se empaquete no lo convierte en tradicional: sigue siendo dinámico.
**Responde a.** 1.4.07

### F-1.4-08 · Ventajas de los guiones
**Teoría.** Son **sencillos** y su curva de aprendizaje es rápida; dan **agilidad** porque no hay que esperar a compilar (se guarda y se recarga); se **integran** de forma natural en el anfitrión; y son **portables**, porque su funcionalidad viene de quien los ejecuta.
**Dato exacto.** **sencillez** · **agilidad sin compilar** · **integración** · **portabilidad por el anfitrión**.
**Trampa.** "Rendimiento bruto alto y código oculto" son las **desventajas**, no las ventajas.
**Responde a.** 1.4.08

### F-1.4-09 · Desventajas de los guiones
**Teoría.** Tienen **más errores en tiempo de ejecución**, un **rendimiento bruto inferior** con mayor consumo de memoria y CPU, y el **código fuente queda expuesto**.
**Dato exacto.** Errores en ejecución · peor rendimiento bruto · **exposición del código fuente**.
**Trampa.** En JavaScript el código viaja al cliente como texto plano: por eso nada sensible puede ir ahí.
**Responde a.** 1.4.09

### F-1.4-10 · "JavaScript no se compila nunca"
**Teoría.** La afirmación es **falsa**. Los motores actuales aplican **JIT**: detectan las funciones que se ejecutan muchas veces y las compilan a código máquina nativo del procesador.
**Dato exacto.** **JIT = Just-In-Time** · compila a **código máquina** las funciones muy usadas.
**Trampa.** Es una **pregunta trampa** clásica del temario, y su respuesta es siempre la misma: falso.
**Responde a.** 1.4.10

### F-1.4-11 · Java frente a JavaScript
**Teoría.** **Java** es fuerte y estáticamente tipado, se compila a **bytecode**, se ejecuta en la JVM y orienta a objetos con clases reales, y sus errores se detectan al compilar. **JavaScript** es débil y dinámicamente tipado, se interpreta, está orientado a eventos con prototipos y sus errores aparecen en ejecución.
**Dato exacto.** Java = fuerte/estático, **bytecode**, clases, error en compilación · JavaScript = débil/dinámico, interpretado, prototipos, error en ejecución.
**Trampa.** Comparten el nombre por razones **comerciales** de su origen histórico, no por parecido técnico.
**Responde a.** 1.4.11

### F-1.4-12 · Python
**Teoría.** El temario destaca Python como **lenguaje de referencia en inteligencia artificial, computación científica y tratamiento masivo de datos**. Es la proyección del ecosistema de scripting.
**Dato exacto.** IA · ciencia · **datos**.
**Trampa.** Python no es "el lenguaje de la web": en el navegador se usa JavaScript.
**Responde a.** 1.4.12

## El objeto `Date`

### F-1.4-13 · El objeto Date
**Teoría.** En JavaScript las fechas **no son un tipo primitivo**: son **instancias del objeto nativo `Date`**. Representan una **instantánea fija** en el tiempo: no se actualizan como un reloj.
**Dato exacto.** **instancia del objeto `Date`**, no primitivo · **instantánea fija**.
**Trampa.** `new Date()` sin argumentos sí lee el reloj actual; el objeto creado después ya no cambia.
**Responde a.** 1.4.13

### F-1.4-14 · Época Unix y milisegundos
**Teoría.** JavaScript representa internamente una fecha como los **milisegundos transcurridos desde el 1 de enero de 1970 a las 00:00:00 UTC**. Positivo = instante posterior; negativo = anterior. `Date.now()` devuelve ese timestamp actual en ms **sin instanciar un objeto**, mientras que `new Date()` crea el objeto con la fecha y hora del **reloj local**.
**Dato exacto.** **1 día = 86.400.000 ms** · `new Date(86400000)` = 2 de enero de 1970 · `new Date(0)` = 1 de enero de 1970 · `Date.now()` = ms sin objeto.
**Trampa.** Un único número siempre son **milisegundos**, nunca años ni segundos. `getTime()` también devuelve ms.
**Responde a.** 1.4.14 · 1.4.15 · 1.4.27

### F-1.4-15 · Las 4 formas de construir un Date
**Teoría.** Hay cuatro formas principales: **sin argumentos** (fecha y hora actuales), **con texto** (se recomienda el formato ISO `AAAA-MM-DD`), **con componentes numéricos** (de 2 a 7 argumentos) y **con milisegundos**.
**Dato exacto.** `new Date()` · `new Date("2026-02-28")` · `new Date(año, mes, día, h, min, s, ms)` · `new Date(milisegundos)`.
**Trampa.** El constructor por componentes usa el **mes con índice 0**; el resto de unidades van en su valor real.
**Responde a.** 1.4.16

### F-1.4-16 · Los meses empiezan en cero
**Teoría.** En el constructor por componentes el mes es un **índice de 0 a 11** (enero = 0 … diciembre = 11) y los **días van de 1 a 31**.
**Dato exacto.** `new Date(2026, 11, 25, 10, 30)` → **25 de diciembre de 2026, 10:30**.
**Trampa.** Un `<select>` que pinte `getMonth()` directamente muestra un mes adelantado: hay que sumar 1 al leer y restar 1 al enviar.
**Responde a.** 1.4.17 · 1.4.24

### F-1.4-17 · `new Date(2026)` no es el año 2026
**Teoría.** Con un **único argumento numérico**, ese número son **milisegundos desde 1970**. Para escribir el año 2026 hay que usar el constructor por componentes.
**Dato exacto.** `new Date(2026)` = **2026 ms** después de 1970 · correcto: `new Date(2026, 0, 1)`.
**Trampa.** Es la trampa más repetida del temario.
**Responde a.** 1.4.18

### F-1.4-18 · El desbordamiento automático
**Teoría.** JavaScript **no da error** cuando un valor se sale de rango: lo **ajusta automáticamente** y avanza a la siguiente unidad. Un mes 15 equivale a un año más tres meses; un día 35 en un mes de 30 días pasa al mes siguiente.
**Dato exacto.** `new Date(2026, 15, 20)` → **20 de abril de 2027** · `new Date(2026, 5, 35)` → 5 de julio de 2026 · `new Date(2026, 12, 1)` → 1 de enero de 2027.
**Trampa.** No lanza error: es una característica del lenguaje, no un fallo.
**Responde a.** 1.4.19

### F-1.4-19 · Los años 0 a 99
**Teoría.** Por compatibilidad histórica, un año de **dos cifras entre 0 y 99** se interpreta como **del siglo XX**, con 1900 delante. El 95 se convierte en 1995, no en 2095 ni en el 95.
**Dato exacto.** `new Date(95, 5, 15)` → **15 de junio de 1995**.
**Trampa.** Solo afecta a los años de dos cifras: `new Date(2026, …)` no se toca.
**Responde a.** 1.4.20

### F-1.4-20 · ISO con guiones frente a barras
**Teoría.** El formato **ISO con guiones** (`AAAA-MM-DD`) se interpreta en **hora UTC**; el de **barras** (`AAAA/MM/DD`) se interpreta en **hora local**. Según la zona del navegador, un mismo texto puede ser un instante distinto.
**Dato exacto.** `"2026-02-28"` → **UTC** · `"2026/02/28"` → **hora local**.
**Trampa.** Para intercambiar datos con un servidor o una base de datos, siempre **ISO con guiones**.
**Responde a.** 1.4.21

### F-1.4-21 · Los métodos to*String()
**Teoría.** Hay varios: `toISOString()` para **intercambiar con APIs y bases de datos** (UTC), `toUTCString()` para **cabeceras HTTP y cookies**, `toString()` para texto completo con zona, `toDateString()` solo fecha, `toTimeString()` solo hora con huso y `toLocaleDateString()` según el idioma y la región del usuario.
**Dato exacto.** `toISOString()` → **APIs y BD** · `toUTCString()` → **HTTP y cookies** · `toLocaleDateString()` → es-ES: `28/9/2026`.
**Trampa.** `toLocaleDateString()` depende del idioma del navegador: no des por hecho que dará siempre el mismo formato.
**Responde a.** 1.4.22

### F-1.4-22 · Getters: getDay, getDate, getMonth
**Teoría.** `getDay()` devuelve el **día de la semana con 0 = domingo … 6 = sábado**. El día del mes está en `getDate()` (1-31) y el mes en `getMonth()` (0-11).
**Dato exacto.** `getDay()` → **0 domingo, 6 sábado** (no es el día del mes).
**Trampa.** Es el mismo error del constructor: hay que sumar 1 a `getMonth()` para mostrar el mes real.
**Responde a.** 1.4.23

### F-1.4-23 · Comparar dos fechas
**Teoría.** Dos objetos `Date` son **objetos distintos**, así que `===` los declara diferentes aunque representen el mismo instante. Para compararlas o calcular la diferencia hay que usar `getTime()`, que devuelve **milisegundos**.
**Dato exacto.** `fin.getTime() - inicio.getTime()` → **diferencia en ms** · días = `diferencia / 86.400.000`.
**Trampa.** Restar los objetos directamente (`fin - inicio`) sí funciona porque el motor los convierte a número, pero **comparar con `===` nunca**.
**Responde a.** 1.4.25

### F-1.4-24 · El último día del mes
**Teoría.** El **día 0 de un mes equivale al último día del mes anterior**, así que para obtenerlo se usa `new Date(anio, mes, 0).getDate()`. Ojo con el desfase: el constructor espera el índice (0 = enero) y el mes se recibe en formato humano (1 = enero), de modo que el valor pasado tal cual designa el mes siguiente.
**Dato exacto.** `(2026, 1)` → **31** (enero) · `(2026, 2)` → 28 · `(2028, 2)` → **29** (bisiesto).
**Trampa.** No hace falta escribir la regla de bisiesto: `Date` ya la aplica (divisible entre 4 y no entre 100, salvo entre 400).
**Responde a.** 1.4.26

### F-1.4-25 · padStart y por qué hace falta String()
**Teoría.** `padStart` devuelve una **cadena nueva** de la longitud indicada, **rellenada a la izquierda**. Es un método de cadena, así que **no existe en los números**: hay que envolver el número con `String()`.
**Dato exacto.** `"5".padStart(2, "0")` → `"05"` · `String(7).padStart(4, "0")` → `"0007"` · `String(fecha.getDate()).padStart(2, "0")`.
**Trampa.** `fecha.getDate().padStart(...)` falla: `getDate()` devuelve un número, no una cadena.
**Responde a.** 1.4.28

---

# 1.5 · Integración de HTML + JavaScript (CE 1.e)

### F-1.5-01 · La etiqueta script en HTML5
**Teoría.** La forma actual de declarar un script es `<script>…</script>`. En HTML5 el navegador asume JavaScript por defecto, así que `type="text/javascript"` es innecesario y `language="javascript"` no es válido.
**Dato exacto.** `<script>…</script>` · cierre **siempre** presente.
**Trampa.** `type="text/javascript"` no es incorrecto (los navegadores lo reconocen por compatibilidad), pero está obsoleto.
**Responde a.** 1.5.01

### F-1.5-02 · El cierre es obligatorio
**Teoría.** **HTML no es XML**, así que las etiquetas no pueden cerrarse de forma abreviada. Escribir `<script src="script.js" />` hace que **el resto de la página no se muestre**: hay que escribir `</script>` siempre, incluso cuando el script es externo y no tiene contenido interno.
**Dato exacto.** `<script src="x.js" />` = **página rota** · correcto: `<script src="x.js"></script>`.
**Trampa.** El navegador no avisa de este error: simplemente desaparece la página.
**Responde a.** 1.5.02

### F-1.5-03 · Ventajas de los ficheros externos
**Teoría.** Un `.js` externo se descarga **una sola vez** y el navegador lo reutiliza (caché) al saltar entre páginas del mismo sitio, ahorrando ancho de banda. Además permite trabajar en paralelo (diseñadores en el HTML/CSS y programadores en el JS), facilita el **mantenimiento y la reutilización**, y organiza el código en un directorio `js`.
**Dato exacto.** **caché** · **modularidad** · **mantenimiento y reutilización** · **carpeta `js`**.
**Trampa.** Una ventaja no es "evitar cerrar `</script>`": el cierre se escribe igual.
**Responde a.** 1.5.03

### F-1.5-04 · Cuándo usar código embebido
**Teoría.** El resultado visual es **exactamente el mismo** con fichero externo o con código embebido, así que la decisión es de mantenimiento: embebido solo cuando las líneas son **mínimas, específicas de una única página y no previsiblemente modificables**.
**Dato exacto.** Embebido = **mínimas + específicas de una página + sin modificaciones previstas**.
**Trampa.** No es "más rápido": es igual de rápido.
**Responde a.** 1.5.04

### F-1.5-05 · Script en el head buscando en el body
**Teoría.** Si un `<script>` en el `<head>` llama a `document.getElementById('prueba')`, **falla**: ese elemento del `<body>` todavía no ha sido leído ni construido en el DOM. `getElementById` devuelve `null` y cualquier acceso a una propiedad lanza `TypeError`.
**Dato exacto.** `null` → **`TypeError`**.
**Trampa.** No es que el navegador no soporte `getElementById`: es que el elemento **aún no existe**.
**Responde a.** 1.5.05

### F-1.5-06 · La ubicación tradicional del script
**Teoría.** La recomendación clásica es colocarlo **al final del `<body>`, justo antes de `</body>`**, para que todo el marcado, los textos y las imágenes ya estén analizados e insertados en el DOM antes de que se ejecute la lógica de interacción.
**Dato exacto.** `<script src="..."></script>` justo antes de `</body>`.
**Trampa.** Al final del `<body>` el script bloquea lo que queda por parsear, pero ya no queda nada.
**Responde a.** 1.5.06

### F-1.5-07 · El atributo defer
**Teoría.** En un script **externo**, `defer` **descarga el archivo en segundo plano** mientras el navegador sigue construyendo el HTML, pero **retrasa la ejecución hasta que el documento se ha analizado por completo**, **respetando el orden** de los scripts. Uso típico: scripts de la aplicación que **manipulan el DOM**.
**Dato exacto.** `<script defer src="./js/logica.js"></script>` · espera al HTML · **respeta el orden**.
**Trampa.** `defer` no ejecuta el script "en cuanto llega": espera al final del parseo.
**Responde a.** 1.5.07

### F-1.5-08 · El atributo async
**Teoría.** `async` **descarga el archivo en segundo plano y lo ejecuta de inmediato en cuanto termina la descarga**, sin esperar a que el HTML termine de leerse y **sin respetar el orden**. Uso típico: **servicios independientes**, como analítica o contadores.
**Dato exacto.** `<script async src="script.js"></script>` · no espera al HTML · **no respeta el orden**.
**Trampa.** `async` no es "defer pero sin orden": además ejecuta antes de que termine el parseo.
**Responde a.** 1.5.08

### F-1.5-09 · Los tres casos y la regla práctica
**Teoría.** Sin atributo, el navegador **detiene el análisis** y ejecuta de inmediato. Con `defer`, descarga en paralelo, espera al final del parseo y mantiene el orden. Con `async`, descarga en paralelo y ejecuta en cuanto llega, sin esperar ni ordenar. La **regla práctica** cuando aún no se dominan los matices: al final del `<body>` **o** en el `<head>` con `defer`.
**Dato exacto.** sin atributo = bloquea · `defer` = espera y ordena · `async` = ni espera ni ordena.
**Trampa.** La diferencia entre los tres está en **cuándo se ejecuta** el script, no en si se descarga o no.
**Responde a.** 1.5.09 · 1.5.10

### F-1.5-10 · Rutas relativas y estructura del proyecto
**Teoría.** Un script externo se enlaza con una **ruta relativa** que incluya la carpeta del proyecto. La estructura típica separa `css/` y `js/` junto al `index.html`.
**Dato exacto.** `<script src="./js/logica.js"></script>` · `mi_proyecto/ ├── css/estilos.css ├── js/logica.js └── index.html`.
**Trampa.** `src="logica.js"` no encuentra nada si el fichero está dentro de la carpeta `js`.
**Responde a.** 1.5.11

### F-1.5-11 · Un 404 al cargar el JavaScript
**Teoría.** En el panel **Network**, un **404 Not Found** al cargar tu `.js` significa que la ruta del atributo `src` es incorrecta o que el fichero no existe en esa carpeta. Un **200 OK** confirma que el navegador lo localizó y descargó.
**Dato exacto.** **200 OK** = localizado y descargado · **404** = ruta o nombre incorrectos.
**Trampa.** Un error de sintaxis del JavaScript **no** da 404: el fichero se descargó bien y el error aparece en la consola.
**Responde a.** 1.5.12

---

# 1.6 · Herramientas de programación y prueba (CE 1.f)

### F-1.6-01 · Visual Studio Code
**Teoría.** Es el editor más usado para JavaScript y TypeScript: es el **estándar absoluto de la industria**, soporta TypeScript de fábrica (el propio editor está escrito en TypeScript) y tiene extensiones como **ESLint**, **Prettier** y los Snippets de React y Vue.
**Dato exacto.** **VS Code 75,9 %** de uso global · más del **80 %** de los desarrolladores front-end lo usa.
**Trampa.** El 75,9 % es de uso global, no de uso exclusivo.
**Responde a.** 1.6.01

### F-1.6-02 · Notepad++
**Teoría.** En Windows se sigue usando para **edición rápida de scripts sueltos**, manipulación veloz de archivos `.json` gigantes o tareas ligeras de automatización. No indexa un proyecto con React ni gestiona dependencias: para eso hace falta un IDE.
**Dato exacto.** **27,4 %**.
**Trampa.** No está obsoleto: su nicho es la ligereza, no los proyectos profesionales.
**Responde a.** 1.6.02

### F-1.6-03 · Vim y Neovim
**Teoría.** Corren **directo en la terminal a máxima velocidad** y, con Neovim, ofrecen el mismo autocompletado y tipado inteligente de TypeScript que VS Code. Son el favorito de los desarrolladores avanzados y de los administradores de servidores.
**Dato exacto.** **Vim 24,3 % + Neovim 14 % = 38,3 %** combinado.
**Trampa.** 38,3 % es la **suma de los dos**; el 75,9 % de VS Code sigue siendo el mayor.
**Responde a.** 1.6.03

### F-1.6-04 · Cursor
**Teoría.** Es un **clon exacto de VS Code con IA nativa** para generar componentes interactivos o refactorizar TypeScript en lenguaje natural. Es la herramienta de IA que más rápido ha escalado en los rankings.
**Dato exacto.** **17,9 %** y subiendo.
**Trampa.** No es un framework ni un motor de renderizado: es un editor.
**Responde a.** 1.6.04

### F-1.6-05 · JetBrains y WebStorm
**Teoría.** **WebStorm** es un IDE de pago cuyo **motor de refactorización y detección de rutas rotas** es el más inteligente y seguro del mercado. Su cuota es menor porque es una herramienta tradicionalmente **comercial de pago**, aunque JetBrains ha liberado una versión gratuita para uso no comercial.
**Dato exacto.** **WebStorm 7,6 %** · **JetBrains 15,1 %** combinados.
**Trampa.** WebStorm es un IDE, no un editor ligero; y "de pago" no significa "imposible de usar".
**Responde a.** 1.6.05

### F-1.6-06 · VS Code y VSCodium
**Teoría.** Ambos usan el mismo código libre (**Code -OSS**), pero el instalador de VS Code incluye **licencia comercial y telemetría**. **VSCodium** es un proyecto independiente que compila ese mismo código fuente de forma limpia: **100 % libre, sin telemetría ni rastreo**.
**Dato exacto.** Mismo **Code -OSS** · VS Code con **telemetría** · VSCodium **100 % libre**.
**Trampa.** VSCodium no tiene más funciones: tiene **menos telemetría**.
**Responde a.** 1.6.06

### F-1.6-07 · Windsurf, Void y Zed
**Teoría.** El temario cita tres editores independientes con IA nativa: **Windsurf** (Codeium, fork de VS Code, modo agente **Cascade**), **Void** (código abierto, con claves de API propias) y **Zed** (escrito en Rust, con uso de GPU y clave de API propia).
**Dato exacto.** **Windsurf** (Cascade) · **Void** · **Zed** (Rust + GPU).
**Trampa.** No son frameworks de JavaScript: son editores.
**Responde a.** 1.6.07

### F-1.6-08 · Las 6 características de un entorno profesional
**Teoría.** Para elegir un entorno profesional se miran seis cosas: que sea de **código abierto y gratuito**, que tenga **arquitectura modular**, **gestor de paquetes integrado**, **autocompletado predictivo**, **sistema de paneles múltiples** y **soporte con canales comunitarios**.
**Dato exacto.** **6**: código abierto/gratuitidad · arquitectura modular · **gestor de paquetes** · autocompletado predictivo · **paneles múltiples** · soporte.
**Trampa.** El "color del editor" y el framework no son criterios del temario. El **gestor de paquetes** registra, instala, actualiza y elimina librerías y extensiones de forma desatendida.
**Responde a.** 1.6.08

### F-1.6-09 · Git y GitHub
**Teoría.** **Git** es el sistema de **control de versiones distribuido** que rastrea cada modificación de los archivos a lo largo del tiempo. **GitHub** es la **plataforma en la nube** que aloja repositorios Git y facilita *pull requests*, *issues* e integración continua.
**Dato exacto.** Git = **control de versiones** · GitHub = **plataforma en la nube**.
**Trampa.** GitHub no es el lenguaje de programación ni sustituye a Git: lo aloja.
**Responde a.** 1.6.09

### F-1.6-10 · Coding Ground (Tutorialspoint)
**Teoría.** Es un entorno **online** accesible desde el navegador, con editor con resaltado de sintaxis, **visualización previa (Preview)** y **consola de ejecución simultánea**. Permite gestionar varios ficheros, descargar el código o importar archivos.
**Dato exacto.** navegador + **Preview** + **consola simultánea** · varios ficheros.
**Trampa.** No es un IDE de escritorio: es online.
**Responde a.** 1.6.10

### F-1.6-11 · CodeSandbox, StackBlitz y JSFiddle
**Teoría.** Permiten arrancar proyectos de **React, Angular o Vue directamente desde el navegador** en segundos, sin instalación previa, y sirven para evaluar librerías y componentes.
**Dato exacto.** React / Angular / Vue **desde el navegador**, en segundos.
**Trampa.** No solo ejecutan JavaScript: levantan el proyecto entero.
**Responde a.** 1.6.11

### F-1.6-12 · Abrir las DevTools
**Teoría.** Las herramientas de diagnóstico del navegador se abren con **F12**, con **Ctrl + Shift + I** o con el clic derecho → *Inspeccionar*.
**Dato exacto.** **F12** · **Ctrl + Shift + I** · clic derecho → *Inspeccionar*.
**Trampa.** F1 y Esc no abren las DevTools.
**Responde a.** 1.6.12

### F-1.6-13 · El panel Red
**Teoría.** Supervisa las **peticiones HTTP** (HTML, CSS, `.js`, imágenes y peticiones asíncronas) y muestra el **código de respuesta** (**200 OK**, **404 Not Found**, **500 Server Error**), el **tiempo** y el **tamaño** de cada recurso.
**Dato exacto.** **200** correcto · **404** no encontrado · **500** error del servidor.
**Trampa.** Un `.js` que aparece con 200 OK se descargó bien: si no funciona, el error está en su código.
**Responde a.** 1.6.13

### F-1.6-14 · El panel Fuentes
**Teoría.** Permite examinar los ficheros `.js`, establecer **puntos de interrupción (breakpoints)**, inspeccionar variables paso a paso y analizar la **pila de llamadas (Call Stack)**. Al alcanzar un breakpoint, el navegador **congela el script**.
**Dato exacto.** **breakpoint** = congela la ejecución · **Call Stack** = pila de llamadas.
**Trampa.** No es "el panel de las fuentes del HTML": es el depurador.
**Responde a.** 1.6.14 · 1.6.22

### F-1.6-15 · El panel Consola
**Teoría.** Permite **interactuar con el motor de JavaScript en tiempo real**, muestra las salidas de `console.log()` y resalta en **rojo** las excepciones y los errores no capturados, indicando **archivo y número de línea**.
**Dato exacto.** salida de `console.log()` · errores en **rojo** con **archivo y nº de línea**.
**Trampa.** Es donde ve el programador, no el usuario: nada de lo que se escribe ahí se ve en la página.
**Responde a.** 1.6.15

### F-1.6-16 · Editor ligero frente a IDE completo
**Teoría.** La elección depende de cuatro parámetros: **escenario de uso** (pruebas rápidas frente a proyectos profesionales), **consumo de recursos** (mínimo frente a medio-alto), **control de versiones** (limitado frente a integración profunda con Git) y **personalización** (escasa frente a elevada).
**Dato exacto.** **escenario · recursos · control de versiones · personalización**.
**Trampa.** El precio es irrelevante: los dos pueden ser gratuitos.
**Responde a.** 1.6.16

### F-1.6-17 · Live Server
**Teoría.** Levanta un **servidor web local** en el equipo con un clic y **recarga el navegador automáticamente** cada vez que guardas. Es imprescindible en front-end: si no, hay que abrir el archivo desde la carpeta y pulsar F5 constantemente.
**Dato exacto.** **servidor local** + **recarga automática al guardar**.
**Trampa.** No compila TypeScript: solo sirve y recarga.
**Responde a.** 1.6.17

### F-1.6-18 · Quokka.js
**Teoría.** Ejecuta el JavaScript **en tiempo real dentro del editor** y muestra el resultado **flotando junto a la línea** de código, sin abrir el navegador ni la terminal. Ideal para probar lógica rápido.
**Dato exacto.** **resultado flotante junto a la línea**.
**Trampa.** Es lo contrario de Live Server: no recarga nada.
**Responde a.** 1.6.18

### F-1.6-19 · Error Lens
**Teoría.** Convierte la marca de error de una línea (la ola roja) en un **mensaje completo con fondo rojo al final de la línea**, visible sin pasar el cursor por encima. Las tres extensiones resuelven problemas distintos sobre el mismo archivo.
**Dato exacto.** **error legible al final de la línea**, sin *hover*.
**Trampa.** No ejecuta código ni compila: solo muestra mejor el error.
**Responde a.** 1.6.19

### F-1.6-20 · El problema de abrir con doble clic (file://)
**Teoría.** Un `index.html` abierto con doble clic se sirve por el protocolo **`file://`** y sufre las **restricciones de seguridad del navegador (política de origen único)**: no permite cargar correctamente algunos recursos ni usar `fetch()`. La solución es un **servidor local**.
**Dato exacto.** **`file://`** · política de origen único · `fetch()` no funciona · solución: **Live Server**.
**Trampa.** No es que falte el `</script>`: es la seguridad del navegador.
**Responde a.** 1.6.20

### F-1.6-21 · Guardar sin guardar de verdad
**Teoría.** El error de herramientas más traicionero: si el editor tiene cambios **sin guardar**, el navegador recarga la versión anterior del archivo y parece que el cambio no se aplica.
**Dato exacto.** Live Server y Error Lens vigilan el **fichero en disco**, no el búfer del editor.
**Trampa.** El síntoma (el cambio "no funciona") parece un error de JavaScript, pero es de guardado.
**Responde a.** 1.6.21

---

# Extra · Repaso práctico de sintaxis (HTML, CSS, JS)

### F-E-01 · Anatomía de un documento HTML5
**Teoría.** Un documento empieza por `<!DOCTYPE html>`, que indica que usa **HTML5**, seguido de `<meta charset="UTF-8">` para la **codificación de caracteres** (tildes y ñ correctas), `<html lang="es">` para el idioma, `<head>` con la configuración (**no se muestra**) y `<title>` (el texto de la pestaña), y `<body>` con todo lo visible.
**Dato exacto.** `<!DOCTYPE html>` = HTML5 · `charset="UTF-8"` = codificación · `<head>` = **no visible** · `<title>` = texto de la **pestaña**.
**Trampa.** `<title>` no es el título de la página: es el de la pestaña del navegador.
**Responde a.** Extra.01

### F-E-02 · El atributo id
**Teoría.** El `id` asigna un **nombre único** dentro del documento y es el mecanismo principal para que JavaScript localice un elemento. Dos elementos no pueden compartirlo.
**Dato exacto.** `document.getElementById("id")` · si no existe, o el elemento no está en el DOM, devuelve **`null`** → `TypeError`.
**Trampa.** Un `id` distinto en el HTML y en el JS es el error más repetido del temario.
**Responde a.** Extra.02

### F-E-03 · Etiquetas vacías y catálogo
**Teoría.** `<img>` y `<br>` son **vacías**: no tienen contenido ni cierre. Las de contenido llevan cierre: `<h1>`…`<h6>` encabezados, `<p>` párrafo, `<button>` botón, `<div>` bloque genérico, `<span>` en línea, `<a href>` enlace, `<ul>/<ol>/<li>` listas y `<input>` campo de formulario.
**Dato exacto.** vacías: **`<img>`, `<br>`** · `div` = bloque genérico · `span` = en línea.
**Trampa.** `<head>` y `<body>` no son vacías: tienen contenido y cierre.
**Responde a.** Extra.03

### F-E-04 · margin, padding y propiedades CSS
**Teoría.** `margin` es el espacio **exterior** del elemento y `padding` el **interior**. Otras propiedades clave: `color` (color del texto), `background-color` (fondo), `font-size` (tamaño de letra), `border` (borde) y `display` (tipo de caja; `display: none` oculta el elemento y por eso queda fuera del Render Tree).
**Dato exacto.** **margin = exterior** · **padding = interior** · `display: none` oculta.
**Trampa.** Los estilos pueden declararse en un `<style>`, en un archivo `.css` externo o en el atributo `style` del elemento.
**Responde a.** Extra.04

### F-E-05 · Flexbox, Grid y responsive
**Teoría.** La maquetación moderna usa **Flexbox** para alinear en **una dimensión** y **Grid** para **cuadrículas** de dos dimensiones. Con **`@media`** se consigue diseño **responsive** según el tamaño del dispositivo.
**Dato exacto.** **Flexbox** = una dimensión · **Grid** = cuadrícula 2D · **`@media`** = responsive.
**Trampa.** Grid no sustituye a Flexbox: se complementan.
**Responde a.** Extra.05

### F-E-06 · let, const y var
**Teoría.** `const` **no** se puede reasignar y `let` sí. `let` y `const` tienen **ámbito de bloque**; `var` tiene **ámbito de función** con hoisting, por lo que se desaconseja.
**Dato exacto.** En código moderno se usa **`const` por defecto** y `let` cuando el valor debe cambiar.
**Trampa.** `const` impide **reasignar**, no **mutar**: un array u objeto declarado con `const` sí puede modificarse por dentro.
**Responde a.** Extra.06

### F-E-07 · typeof y los tipos
**Teoría.** No hay tipado en la declaración: una misma variable puede contener tipos distintos, y es el **valor** el que determina lo que devuelve `typeof`. Hay `number` (enteros y decimales juntos), `string`, `boolean`, `undefined` (declarada sin valor), `null` (ausencia intencionada), `object` (objetos, arrays y fechas) y `function` (las funciones son valores).
**Dato exacto.** El resultado de una operación numérica inválida es **`NaN`** (por ejemplo `"abc" * 2`).
**Trampa.** `null` es un valor, no un tipo; y los arrays y las fechas son `object`.
**Responde a.** Extra.07

### F-E-08 · == frente a ===
**Teoría.** `==` **convierte los tipos automáticamente** antes de comparar; `===` compara valor y tipo **sin conversión**. Se recomienda `===`. El operador `=` asigna.
**Dato exacto.** `5 == "5"` → **true** · `5 === "5"` → **false** · `5 !== "5"` → **true**.
**Trampa.** Escribir `=` donde debía ir `===` asigna en vez de comparar: es un error frecuente.
**Responde a.** Extra.08

### F-E-09 · filter, map, sort y reduce
**Teoría.** `filter` y `map` **devuelven un array nuevo**; **`sort` modifica el original**; `reduce` **acumula** (suma) un valor. La función de `sort` devuelve un número: negativo → el primero antes; positivo → después; cero → equivalentes.
**Dato exacto.** `nums.sort((a,b) => a - b)` ascendente · `nums.sort((a,b) => b - a)` descendente.
**Trampa.** `sort` con `a - b` sin paréntesis es un error de sintaxis.
**Responde a.** Extra.09

### F-E-10 · Cadenas, plantillas y acentos graves
**Teoría.** En JavaScript las cadenas admiten comillas dobles, simples o **acentos graves**. Con acentos graves y `${}` se **interpolan** valores y se admiten varias líneas, al estilo de las plantillas de texto.
**Dato exacto.** `` `Hola, ${nombre}` `` · equivale a concatenar con `+` · admite **varias líneas**.
**Trampa.** Mezclar tipos de comillas es un error de sintaxis; en Java solo se admiten comillas dobles.
**Responde a.** Extra.10

### F-E-11 · Los eventos y cuándo se producen
**Teoría.** `click` al pulsar y soltar el ratón · `keydown`/`keyup` al pulsar/soltar una tecla · `input` al escribir en un campo · `change` al cambiar el valor y **perder el foco** · `submit` al enviar un formulario · `DOMContentLoaded` al terminar de analizar el HTML. También `mouseover`/`mouseout` cuando el puntero entra o sale del elemento.
**Dato exacto.** `change` = **valor cambiado + foco perdido** · `DOMContentLoaded` = HTML analizado.
**Trampa.** `input` salta en cada pulsación; `change` solo al confirmar.
**Responde a.** Extra.11

### F-E-12 · onclick frente a addEventListener
**Teoría.** En el **atributo HTML** la función se escribe **con paréntesis** (`onclick="cambiar()"`), porque el navegador la ejecuta al ocurrir el evento. Con **`addEventListener`** se pasa la **referencia sin paréntesis** (`addEventListener("click", cambiar)`), lo que además permite **varios manejadores** para el mismo evento y mantiene el JS separado del HTML.
**Dato exacto.** **con paréntesis** en el atributo · **sin paréntesis** en `addEventListener` (el recomendado).
**Trampa.** `addEventListener("click", cambiar())` ejecuta la función de inmediato y entrega su resultado, no la función.
**Responde a.** Extra.12

### F-E-13 · Localizar elementos y el manejador
**Teoría.** `getElementById("x")` devuelve el elemento con ese id · `querySelector(".clase")` devuelve el **primero** que cumple un selector CSS · `querySelectorAll("p")` y `getElementsByTagName("p")` devuelven **todos**. Para crear un elemento: `document.createElement("li")`, rellenar `textContent` y `document.getElementById("lista").appendChild(li)`. El **manejador** es la función que se ejecuta como respuesta a un evento.
**Dato exacto.** `querySelector` devuelve **uno** · `querySelectorAll` devuelve **todos**.
**Trampa.** `document.createElement()` no inserta nada en la página: hay que hacer `appendChild`.
**Responde a.** Extra.13 · Extra.14

### F-E-14 · Estilos desde JavaScript
**Teoría.** Las propiedades compuestas se escriben en **camelCase** porque el guion es la resta, y el valor es **siempre una cadena** que **incluye la unidad**.
**Dato exacto.** `x.style.fontSize = "25px"` · `x.style.backgroundColor = "red"`.
**Trampa.** `style.font-size` no existe; `style.fontSize = 25` (número sin unidad) tampoco aplica. Al reasignar `src` de una imagen, el navegador **descarga** el nuevo recurso y repinta.
**Responde a.** Extra.15

### F-E-15 · Los errores frecuentes
**Teoría.** El anexo de errores del temario: `id` distinto en HTML y JS (→ `null`) · script en el `<head>` buscando el `<body>` · `addEventListener("click", cambiar())` · `onclick="cambiar"` sin paréntesis · `<script src="x.js" />` sin cerrar · `=` en vez de `===` · `style.font-size` · `new Date(2026)` esperando el año · meses sin el índice 0 · comillas mezcladas · `document.write()` tras la carga.
**Dato exacto.** Las dos que **rompen la página**: `document.write()` tras la carga y `<script src="x.js" />`.
**Trampa.** Recomendación de trabajo: mantener abierta la consola (F12) mientras se desarrolla; el mensaje indica **archivo y número de línea**.
**Responde a.** Extra.16 · Extra.17

### F-E-16 · Resumen express de los cuatro mecanismos de salida
**Teoría.** `console.log()` va al panel de la Consola y **no se ve** en la página · `innerHTML` / `textContent` escriben en un elemento y **sí se ven** · `document.write()` va al flujo del documento, se ve pero está obsoleto (tras la carga **borra todo**) · `alert()` abre una ventana modal del sistema, se ve y **bloquea**.
**Dato exacto.** Si el enunciado dice "que el texto **se vea en la página**": `innerHTML` o `textContent`.
**Trampa.** `console.log()` nunca es la respuesta cuando el enunciado pide que se vea en la página.
**Responde a.** Extra.18

---

# Ejercicios resueltos · los 9 de 1.2

### E-1 · Botón que cambia el color y el tamaño de un `h1`
**Qué pide.** Un botón que, al pulsarlo, cambie el color y el tamaño de letra de un `<h1>`.
**Clave.**
```html
<button onclick="cambiar()">Cambiar</button>
<h1 id="titulo">Título</h1>
<script>
  function cambiar() {
    const titulo = document.getElementById("titulo");
    titulo.style.color = "red";
    titulo.style.fontSize = "40px";
  }
</script>
```
**Por qué funciona.** El `onclick` del atributo invoca el manejador cuando ocurre el evento; este busca el elemento por `id` en el DOM y le cambia dos propiedades de estilo. Como cambia el tamaño de letra, provoca un **reflow**; como cambia el color, un **repaint**.
**Error típico.** Escribir `style.font-size` en vez de `style.fontSize` (el guion es la resta).

### E-2 · Mostrar un texto en la consola
**Qué pide.** Mostrar un texto en la consola del navegador.
**Clave.** `console.log("Hola, mundo");` — se ve en F12 → Consola, **no** en la página.
**Por qué funciona.** La consola es el punto de salida de diagnóstico del navegador, alimentado por el panel que el temario llama "interactuar con el motor de JavaScript en tiempo real".
**Error típico.** Creer que se ve en la página. Si el enunciado dice "que se vea en la página", hay que usar `innerHTML`.

### E-3 · Mostrar un mensaje con alert
**Qué pide.** Mostrar un mensaje mediante una ventana emergente.
**Clave.** `alert("Hola, mundo");` (equivalente a `window.alert("Hola, mundo");`)
**Por qué funciona.** La función es una propiedad de `window` y abre una ventana **modal nativa del sistema operativo**. Es síncrona y bloqueante: hasta que se pulsa "Aceptar" el hilo principal queda congelado.
**Error típico.** Escribir `window.alert = "Hola"` (asignar en vez de llamar) o esperar que devuelva algo: devuelve `undefined`.

### E-4 · Cambiar el idioma de la página (tres botones)
**Qué pide.** Tres botones (español, inglés, alemán) que cambien el texto de la página y el color de fondo.
**Clave.**
```js
const textos = { es: "Hola", en: "Hello", de: "Hallo" };
const colores = { es: "white", en: "black", de: "yellow" };

function cambiarIdioma(idioma) {
  document.getElementById("texto").textContent = textos[idioma];
  document.body.style.backgroundColor = colores[idioma];
}
```
```html
<button onclick="cambiarIdioma('es')">Español</button>
```
**Por qué funciona.** Un único manejador recibe como parámetro el idioma del botón y decide qué texto y qué color aplicar. El contenido del objeto se busca con los corchetes.
**Error típico.** Confundir `textContent` con `innerHTML` e inyectar datos de fuera (XSS); o pretender cambiar el idioma real del navegador, que no se puede desde una página.

### E-5 · Salida solo por consola
**Qué pide.** Que el resultado **solo** aparezca en la consola y no en la página.
**Clave.** Solo `console.log(...)`: nada de `innerHTML`, `document.write()` ni `alert()`.
**Por qué funciona.** La consola es el único canal de salida invisible al usuario.
**Error típico.** Añadir un `alert()` "para que se vea": ya no cumple el requisito.

### E-6 · Mostrar texto en la parte superior de la página
**Qué pide.** Escribir un texto en la parte superior de la página.
**Clave.**
```html
<p id="superior"></p>
```
```js
document.getElementById("superior").textContent = "Texto";
```
**Por qué funciona.** Se busca el elemento por `id` y se le cambia el contenido; el `<p>` está al principio del `<body>`, así que el texto aparece arriba.
**Error típico.** Usar `document.write()`: hoy está obsoleto y, si se llama tras la carga, **borra el documento**. La solución moderna es `textContent` o `innerHTML`.

### E-7 · Panel con tres botones
**Qué pide.** Un panel con tres botones: mostrar por consola, cambiar estilo y mostrar una alerta.
**Clave.**
```js
document.getElementById("btnConsola").addEventListener("click", mostrar);
document.getElementById("btnEstilo").addEventListener("click", estilo);
document.getElementById("btnAlerta").addEventListener("click", alerta);

function mostrar() { console.log("Mensaje"); }
function estilo()  { document.body.style.backgroundColor = "lightblue"; }
function alerta()  { window.alert("Aviso"); }
```
**Por qué funciona.** Cada botón tiene su propio manejador; con `addEventListener` se pueden añadir varios por evento y el JS queda separado del HTML.
**Error típico.** `addEventListener("click", mostrar())` con paréntesis: ejecuta la función al registrar el manejador y entrega su resultado.

### E-8 · Test de verdadero/falso
**Qué pide.** Un test de cinco preguntas de verdadero/falso que corrija las respuestas y muestre la puntuación.
**Clave.**
```js
const preguntas = [
  { texto: "HTML es un lenguaje de programación", correcta: false },
  { texto: "document cuelga de window", correcta: true }
];
let aciertos = 0;

function corregir(respuestas) {
  aciertos = 0;
  preguntas.forEach((p, i) => {
    if (respuestas[i] === p.correcta) { aciertos++; }   // === y no ==
  });
  console.log(`Aciertos: ${aciertos} de ${preguntas.length}`);
}
```
**Por qué funciona.** Un array de objetos guarda el enunciado y la respuesta correcta; el manejador compara con `===` (valor y tipo, sin conversiones) y va sumando.
**Error típico.** Usar `==`, o incrementar el contador aunque la respuesta sea falsa.

### E-9 · Galería de imágenes
**Qué pide.** Una galería que cambia de imagen al pulsar un botón y vuelve a la primera cuando llega a la última.
**Clave.**
```js
const imagenes = ["uno.jpg", "dos.jpg", "tres.jpg"];
let indice = 0;

function siguiente() {
  indice = (indice + 1) % imagenes.length;
  document.getElementById("foto").src = imagenes[indice];
}
```
**Por qué funciona.** El módulo `%` con la longitud hace el ciclo: al llegar al último índice vuelve al 0. Al reasignar `src`, el navegador **descarga** el nuevo recurso y repinta la imagen.
**Error típico.** Olvidar el `%`: el índice crece, `imagenes[indice]` devuelve `undefined` y la imagen queda rota.

---

# Ejercicios resueltos · el objeto `Date` (1.4)

### ED-1 · Fechas y desbordamiento
**Qué pide.** Construir fechas con `new Date` comprobando qué ocurre con valores fuera de rango.
**Clave.**
```js
new Date(2026, 0, 1);    // 1 de enero de 2026
new Date(2026, 15, 20);  // 20 de abril de 2027
new Date(2026, 5, 35);   // 5 de julio de 2026
new Date(2026, 12, 1);   // 1 de enero de 2027
new Date(2026);           // 2026 ms después de 1970 (¡no es el año!)
new Date(95, 5, 15);      // 15 de junio de 1995
```
**Por qué funciona.** No hay validación: cada unidad que se sale de rango se ajusta y arrastra a la siguiente (mes 15 = +1 año +3 meses; día 35 de junio = 5 de julio). El único límite real es el máximo de milisegundos que admite una fecha (unos 8,64 × 10¹⁵ ms, del orden de 275.760 años).
**Error típico.** `new Date(2026)` esperando el año 2026, o pensar que el mes 15 da error.

### ED-2 · Diferencia en días entre dos fechas
**Qué pide.** Calcular cuántos días hay entre dos fechas.
**Clave.**
```js
const inicio = new Date("2026-03-01");
const fin    = new Date("2026-03-31");
const dias = (fin.getTime() - inicio.getTime()) / 86400000;
```
**Por qué funciona.** `getTime()` devuelve milisegundos desde 1970; al restarlos sale el intervalo y al dividir entre los **86.400.000 ms** de un día salen los días.
**Error típico.** Comparar con `===` (son objetos distintos) o dividir entre 86.400 (ese es el número de **segundos** de un día, no de milisegundos).
**Nota.** Con fechas ISO (con guiones) el cálculo es fiable porque se interpretan en **UTC**; con barras depende de la zona horaria y el resultado puede no ser entero.

### ED-3 · Último día del mes (y bisiesto)
**Qué pide.** Obtener el último día de un mes.
**Clave.**
```js
function ultimoDia(anio, mes) {   // mes en formato humano: 1 = enero
  return new Date(anio, mes, 0).getDate();
}
ultimoDia(2026, 1);   // 31  (enero)
ultimoDia(2026, 2);   // 28
ultimoDia(2028, 2);   // 29  (bisiesto)
```
**Por qué funciona.** El **día 0 de un mes es el último día del mes anterior**; como el constructor espera el índice (0 = enero) y aquí se recibe el mes humano (1 = enero), el valor recibido designa el mes siguiente y el día 0 retrocede al final del mes buscado. Además `Date` ya aplica la regla de bisiesto (divisible entre 4 y no entre 100, salvo entre 400).
**Error típico.** Pasar el mes ya con el índice 0 y obtener el día del mes equivocado: la función documenta que recibe el mes en formato humano.

### ED-4 · Formateador `dd/mm/aaaa hh:mm`
**Qué pide.** Mostrar una fecha en el formato `dd/mm/aaaa hh:mm` siempre con dos dígitos.
**Clave.**
```js
function formatear(f) {
  const d   = String(f.getDate()).padStart(2, "0");
  const m   = String(f.getMonth() + 1).padStart(2, "0");
  const h   = String(f.getHours()).padStart(2, "0");
  const min = String(f.getMinutes()).padStart(2, "0");
  return `${d}/${m}/${f.getFullYear()} ${h}:${min}`;
}
```
**Por qué funciona.** `padStart` rellena a la izquierda hasta la longitud pedida, así que "5" pasa a "05". Se necesita `String()` porque `padStart` es un método de cadena, no de número, y `getDate()` devuelve un número. El `+ 1` corrige el índice 0 de los meses.
**Error típico.** `f.getDate().padStart(2, "0")` sin el `String()` (lanza error) u olvidar el `+ 1` del mes.

### ED-5 · Laboratorio: error en tiempo de ejecución
**Qué pide.** Depurar un programa que calcula los días entre dos fechas y ver por qué en la consola aparece `NaN`.
**Clave.**
```js
const f1 = new Date("2026-03-01");
const f2 = new Date("2026-03-31");
const dias = f1 - f2 / 86400000;   // bug: falta el paréntesis
```
**Por qué funciona.** El fallo es de operador, no del navegador: sin paréntesis se divide `f2` (un objeto, que se convierte a milisegundos) entre 86.400.000, y al restarlo a un objeto `Date` el resultado es `NaN`. El navegador detecta el error **en tiempo de ejecución**, en esa línea, y detiene el script ahí; en Java, el mismo fallo impediría generar el ejecutable. Por eso son imprescindibles el `console.log()` y el punto de interrupción del panel **Fuentes**: el aviso indica archivo y número de línea.
**Error típico.** Buscar un error de sintaxis en el HTML o el CSS. El aviso estaba en la pestaña **Consola**, con archivo y línea.

---

# Cobertura: ficha → preguntas

| Bloque | Fichas | IDs cubiertos | Total |
|---|---|---|---|
| 0 | `F-0-01` … `F-0-06` | 1.1.03 · 1.1.06 · 1.1.10 · 1.2.01 · 1.2.11 · 1.5.12 · 1.6.13 | 7 |
| 1.1 | `F-1.1-01` … `F-1.1-19` | 1.1.01 – 1.1.22 | 22 / 22 |
| 1.2 | `F-1.2-01` … `F-1.2-24` | 1.2.01 – 1.2.25 | 25 / 25 |
| 1.3 | `F-1.3-01` … `F-1.3-23` | 1.3.01 – 1.3.24 | 24 / 24 |
| 1.4 | `F-1.4-01` … `F-1.4-25` | 1.4.01 – 1.4.28 | 28 / 28 |
| 1.5 | `F-1.5-01` … `F-1.5-11` | 1.5.01 – 1.5.12 | 12 / 12 |
| 1.6 | `F-1.6-01` … `F-1.6-21` | 1.6.01 – 1.6.22 | 22 / 22 |
| E | `F-E-01` … `F-E-16` | Extra.01 – Extra.18 | 18 / 18 |
| | **145 fichas** | | **151 / 151** |

Cada identificador de la batería aparece al menos una vez en la línea **Responde a** de alguna ficha
(los del bloque 0 son requisito previo, no pregunta propia).

## Chuleta de datos de memoria

- **Origen:** 1989 · CERN · Tim Berners-Lee. **Estándares:** W3C (w3c.es). **Nube:** AWS.
- **Motores:** Chrome/Edge/Brave/Opera = **Blink + V8** · Firefox = **Gecko + SpiderMonkey** · Safari = **WebKit + JavaScriptCore**. **Blink nació en 2013**.
- **7 módulos** del navegador: UI · browser engine · renderizado · JS · red · UI backend · almacenamiento.
- **4 pasos de renderizado:** DOM + CSSOM → Render Tree → Layout → Paint. Fuera: `<head>` y `display: none`.
- **Almacenamiento:** cookies ~**4 KB** (van al servidor) · sessionStorage (hasta cerrar la pestaña) · localStorage (permanente, 5-10 MB) · IndexedDB (sin conexión).
- **Historia JS:** 1995 Eich / Netscape / 10 días (Mocha→LiveScript→JS) · 1996 JScript (guerra de navegadores) · 1997 ECMAScript ECMA-262 · 1999 ES3 · 2005 AJAX (Jesse James Garrett, `XMLHttpRequest`) · 2006 jQuery/Prototype/MooTools · 2008-09 V8 + Node.js (Ryan Dahl) · 2009 ES5 · 2015 ES6 · ES2016+ TC39 con 4 fases anuales.
- **Frameworks:** React (Meta, DOM virtual, JSX) · Angular (Google, TypeScript, curva pronunciada) · Vue (Evan You, DOM virtual, progresiva, Laravel).
- **Script vs tradicional:** compilación/interpretación · standalone/anfitrión · desde cero/reutilizar componentes · errores en compilación/ejecución · **C, C++, Java, Swift, Pascal** / **JavaScript, Shell, Perl, PHP, Python, Ruby**.
- **Date:** época Unix 1/1/1970 UTC · **1 día = 86.400.000 ms** · meses **0-11** · días 1-31 · desbordamiento automático · años 0-99 = siglo XX · ISO = UTC · `toISOString()` APIs/BD · `toUTCString()` HTTP/cookies.
- **Reflow** = cambia dimensiones o posición (`fontSize`, `innerHTML`). **Repaint** = solo visual (`color`, `backgroundColor`).
- **1.6 ranking:** VS Code 75,9 % · Vim/Neovim 38,3 % · Notepad++ 27,4 % · Cursor 17,9 % · JetBrains 15,1 % (WebStorm 7,6 %).
- **DevTools:** F12 o Ctrl+Shift+I · Consola · Fuentes (breakpoints, Call Stack) · Red (200/404/500).
- **Extensiones:** Live Server (servidor local + recarga) · Quokka.js (resultado flotante en vivo) · Error Lens (error a final de línea).
- **Ponderación:** cada uno de los 6 apartados = **16,67 % del RA1** = **0,833 % de la nota final**.