# Batería de preguntas · Examen Unidad 1 · Entorno Cliente (DWEC)

> **Temario cubierto:** apartados **1.1 a 1.6** (RA1 · CE 1.a a 1.f). Los seis apartados pesan
> igual: **16,67 % del RA1 = 0,833 % de la nota final del módulo**.
> Fuentes: `Resumen T1 y T2 DWEC.pdf` (16 págs.) y `Apuntes_Unidad1_Clientes_Web.docx`.
> **151 preguntas** con respuesta razonada.
>
> Tipos: `[MC]` opción múltiple · `[VF]` verdadero/falso · `[DEF]` definición o desarrollo.
> Las **20 preguntas trampa** del final son las que más se caen en el examen.

---

## Índice de apartados

| Apartado | Tema | Preguntas |
|---|---|---|
| 1.1 | Modelos de ejecución en servidor y cliente | 22 |
| 1.2 | Capacidades y mecanismos de los navegadores | 25 |
| 1.3 | Lenguajes de programación de cliente | 24 |
| 1.4 | Guiones (scripts) y objeto `Date` | 28 |
| 1.5 | Integración HTML + JavaScript | 12 |
| 1.6 | Herramientas de programación y prueba | 22 |
| Extra | Repaso práctico de sintaxis (HTML, CSS, JS) | 18 |
| | **Total** | **151** |

---

# 1.1 · Modelos de ejecución en servidor y cliente (CE 1.a)

**1.1.01** `[MC]` ¿Dónde se ejecuta el código del entorno cliente (front-end)?
- a) En el servidor remoto o en la nube
- b) En el navegador del usuario, en su dispositivo
- c) En el sistema operativo del servidor

**R:** **b)** El navegador descarga los archivos y los interpreta localmente con la CPU y la RAM del dispositivo del usuario.

---

**1.1.02** `[MC]` La visibilidad del código del back-end es:
- a) Pública, se lee con F12
- b) Privada, reside solo en el servidor
- c) Pública solo en entornos de prueba

**R:** **b)** El usuario final nunca tiene acceso al código del servidor. En cambio, **todo** el código del cliente es público y auditable con F12.

---

**1.1.03** `[DEF]` ¿Por qué nunca deben situarse en el cliente las claves de cifrado, las contraseñas ni las operaciones contables o de seguridad?

**R:** Porque el código del cliente es completamente público: cualquiera puede abrir las DevTools (F12) y leer o auditar el JavaScript en tiempo de ejecución. Lo que aporta **integridad y seguridad** debe residir en el servidor.

---

**1.1.04** `[MC]` ¿En qué lugar y en qué año nació la Web?
- a) En Bell Labs, 1991
- b) En el CERN, 1989
- c) En el MIT, 1983

**R:** **b)** Nació en **1989** en el laboratorio europeo de física de partículas (**CERN**) de la mano de **Tim Berners-Lee**, que buscaba un sistema para compartir documentos enlazados entre científicos.

---

**1.1.05** `[DEF]` ¿Qué es el W3C y por qué importa en el entorno cliente?

**R:** **World Wide Web Consortium**: organismo internacional que elabora los **estándares oficiales** de la web (como HTML5, CSS3 y la etiqueta `<script>`) para que las páginas funcionen igual en cualquier navegador. Su delegación española es **w3c.es**.

---

**1.1.06** `[DEF]` ¿Qué es la computación en nube y qué plataforma se cita en el temario?

**R:** Es el alquiler **bajo demanda** de espacio y potencia de cálculo, en lugar de mantener servidores propios. El temario cita **AWS (Amazon Web Services)**. El back-end puede ejecutarse en servidores dedicados o en instancias en la nube.

---

**1.1.07** `[MC]` ¿Cuál de estos lenguajes es «JavaScript del lado del servidor»?
- a) PHP
- b) Ruby
- c) Node.js

**R:** **c)** **Node.js** es JavaScript en el servidor. Los lenguajes habituales en back-end son PHP, Java, Python, Node.js y C# (.NET).

---

**1.1.08** `[MC]` ¿Cuál de estas bases de datos es **documental (NoSQL)**?
- a) MySQL
- b) MariaDB
- c) MongoDB

**R:** **c)** **MongoDB** es documental: guarda la información en **documentos/bloques**. Las relacionales (**SQL**) como MySQL, MariaDB, PostgreSQL u Oracle la guardan en **tablas, filas y columnas**.

---

**1.1.09** `[MC]` ¿Cuáles son las tareas principales del back-end según el temario?
- a) Autenticar usuarios, realizar cobros y conectarse a bases de datos
- b) Maquetar la interfaz y aplicar colores y tipografías
- c) Escribir el HTML y los estilos de la página

**R:** **a)** Autenticar la identidad de los usuarios (credenciales y sesiones), realizar cobros y pagos seguros y conectarse a sistemas gestores de bases de datos.

---

**1.1.10** `[MC]` En el cliente, el acceso a los datos es:
- a) Directo, mediante conexión nativa al motor de base de datos
- b) Indirecto, mediante peticiones HTTP a través de internet
- c) Imposible: el cliente no puede acceder a datos

**R:** **b)** Es **indirecto**. El servidor es quien tiene el acceso **directo** a los motores SQL o NoSQL.

---

**1.1.11** `[MC]` ¿Qué recursos consume el entorno cliente?
- a) CPU, memoria RAM y batería del dispositivo del usuario
- b) Potencia de cómputo del servidor y sus discos
- c) Solo ancho de banda del servidor

**R:** **a)** El front-end se apoya en el **dispositivo local**: CPU, RAM y batería. El back-end consume la potencia y memoria del servidor.

---

**1.1.12** `[VF]` La latencia de respuesta del cliente es inmediata en acciones visuales locales, mientras que la del servidor está sujeta a la latencia de red y a la carga del servidor.

**R:** **Verdadero.** Es una de las filas de la tabla comparativa cliente/servidor.

---

**1.1.13** `[MC]` El principio para decidir dónde va cada cosa es:
- a) Lo que aporta **usabilidad e inmediatez**, al cliente; lo que exige **integridad y seguridad**, al servidor
- b) Lo que sea más fácil de programar, al cliente
- c) Todo al servidor, por seguridad

**R:** **a)** Regla literal del temario: *usabilidad e inmediatez → cliente; integridad y seguridad → servidor*.

---

**1.1.14** `[MC]` ¿Cuál de estas operaciones es **exclusiva del servidor**?
- a) Desplegar y ocultar un menú
- b) Ordenar y filtrar datos ya cargados en memoria
- c) Comprobar privilegios antes de conceder un acceso administrativo

**R:** **c)** También son exclusivas del servidor los **cobros con pasarelas de pago** (el importe final se calcula en el servidor para evitar manipulaciones) y las **consultas complejas sobre miles o millones de registros**.

---

**1.1.15** `[VF]` Ordenar y filtrar colecciones de datos que ya están cargadas en memoria es una operación propia del front-end.

**R:** **Verdadero.** En cambio, ordenar o filtrar millones de registros en una base de datos es del back-end.

---

**1.1.16** `[DEF]` ¿Qué diferencia hay entre el modelo web tradicional y una SPA?

**R:**
- **Web clásica:** cada clic genera una petición **síncrona**; el servidor procesa y ensambla un **HTML nuevo completo**; la interfaz sufre recarga íntegra, con **pantalla en blanco y parpadeo**.
- **SPA (Single Page Application):** descarga la plantilla y los recursos base **una sola vez**; al interactuar no recarga; JS pide de forma **asíncrona** solo los datos necesarios **empaquetados en JSON** y actualiza **selectivamente** las partes del árbol visual que cambian.

---

**1.1.17** `[DEF]` ¿Qué son las DevTools y cómo se abren?

**R:** Conjunto de utilidades de **diagnóstico integradas en el navegador** (tecla **F12**, o clic derecho → *Inspeccionar*, o `Ctrl + Shift + I`). Permiten auditar el DOM, monitorizar las peticiones de red y depurar el código JavaScript.

---

**1.1.18** `[MC]` ¿Qué significa **renderizar**?
- a) Compilar el JavaScript a binario
- b) El proceso por el que el motor del navegador interpreta el código para **pintar los elementos visuales en pantalla**
- c) Enviar la página al servidor

**R:** **b)** Renderizar es calcular tamaño y posición de cada elemento y dibujarlo en pantalla.

---

**1.1.19** `[MC]` En el proyecto de la actividad con **150.000 productos**, ¿qué se usa para medir el tiempo de ordenación y filtrado?
- a) `console.time()` y `console.timeEnd()`
- b) `performance.now()` exclusivamente
- c) El panel Network

**R:** **a)** `console.time("etiqueta")` inicia la medida y `console.timeEnd("etiqueta")` la cierra mostrando los **milisegundos** transcurridos.

---

**1.1.20** `[MC]` Al pasar de 150.000 a 500.000 registros, ¿por qué el tiempo **no** se multiplica exactamente por 3,33?
- a) Porque el motor de JavaScript paraleliza el `sort()`
- b) Porque los algoritmos eficientes son **O(n log n)**: el factor real es **≈ 3,7**
- c) Porque el navegador cachea el array

**R:** **b)** `(500000·log₂500000)/(150000·log₂150000) ≈ 3,33·(18,93/17,19) ≈ 3,7`. El crecimiento es **superior al lineal**. En la práctica, la gestión de memoria y la caché de la CPU pueden aumentar la diferencia.

---

**1.1.21** `[DEF]` Con 10.000 usuarios tardando 60 ms cada uno en ordenar el catálogo, ¿qué ventaja tiene ejecutar la ordenación en el cliente?

**R:** El cómputo acumulado es `10.000 × 60 ms = 600.000 ms = 600 s` de CPU, pero **repartido en paralelo** entre 10.000 dispositivos: cada usuario espera solo `t`. Ventajas: **menor carga y coste de infraestructura** en el servidor, **mejor escalabilidad** (cada usuario aporta su propia potencia) y **menor latencia percibida** (no depende de la red ni de la cola de peticiones).

---

**1.1.22** `[DEF]` ¿Qué problema hay con descargar 8 millones de registros al cliente y cuál es la solución?

**R:** Cada objeto ocupa del orden de **cien bytes**, así que el array requeriría **cientos de megabytes** de RAM, además de mucho tiempo y volumen de descarga, bloqueo del hilo principal (la página dejaría de responder) y riesgo de agotar la memoria en dispositivos modestos.
**Solución:** trasladar el trabajo al servidor y entregar solo lo necesario: **paginación** con `LIMIT`/`OFFSET` (o paginación por cursor) en lotes de ~50 registros, **ordenación y filtrado en servidor** apoyados en **índices**, **carga progresiva** (scroll infinito o botón «cargar más») y **virtualización** de la lista.

---

# 1.2 · Capacidades y mecanismos de los navegadores (CE 1.b)

**1.2.01** `[MC]` ¿Cuáles son los **7 módulos** en los que se divide el interior de un navegador?

**R:** 1. Interfaz de usuario (UI) · 2. Motor del navegador (browser engine) · 3. Motor de renderizado · 4. Motor de JavaScript (JS engine) · 5. Capa de red (networking) · 6. UI backend · 7. Almacenamiento de datos.
*[MC] ¿Cuál conecta el navegador con el sistema operativo para dibujar controles con aspecto nativo?* → **UI backend** (el 6).

---

**1.2.02** `[MC]` ¿Qué hace el **motor del navegador (browser engine)**?
- a) Interpreta el JavaScript
- b) Es el puente entre la interfaz externa y los motores internos; gestiona órdenes como abrir una pestaña nueva
- c) Dibuja los píxeles en la GPU

**R:** **b)** El motor de JavaScript interpreta el código y el de renderizado dibuja. El browser engine coordina interfaz y motores.

---

**1.2.03** `[DEF]` ¿Qué es la compilación **JIT** (Just-In-Time) y por qué es importante?

**R:** Mecanismo del **motor de JavaScript** que detecta **qué funciones se ejecutan muchas veces** y las traduce directamente a **código máquina nativo del procesador**, ganando velocidad. Por eso es **FALSO** decir que «JavaScript no se compila nunca».

---

**1.2.04** `[MC]` ¿Cuáles son los motores de renderizado y los motores de JavaScript de los navegadores actuales?

| Navegador | Motor de renderizado | Motor de JavaScript | Empresa |
|---|---|---|---|
| Chrome | Blink | V8 | Google |
| Edge | Blink | V8 | Microsoft |
| Brave / Opera | Blink | V8 | Brave SW, Opera |
| Firefox | Gecko | SpiderMonkey | Mozilla |
| Safari | WebKit | JavaScriptCore | Apple |

*[MC] ¿Cuál es el motor de JavaScript de Chrome?* → **V8**. ¿Y su motor de renderizado? → **Blink**.

---

**1.2.05** `[MC]` ¿En qué año nació **Blink** y por qué?
- a) 2013, cuando Google bifurcó el proyecto WebKit
- b) 2008, cuando salió Chrome
- c) 1997, con ECMAScript

**R:** **a)** Chrome usó **WebKit** (el de Apple) hasta 2013; ese año Google copió/bifurcó el proyecto y nació **Blink**, hoy el motor de la mayoría de navegadores basados en Chromium.

---

**1.2.06** `[VF]` En iPhone e iPad cualquier navegador usa internamente el motor WebKit, aunque se llame Chrome o Firefox.

**R:** **Verdadero.** Lo obliga la tienda de aplicaciones de Apple (política de la App Store).

---

**1.2.07** `[MC]` ¿Cuáles son los **4 pasos** del proceso de renderizado y en qué orden?
- a) Layout → Pintado → DOM/CSSOM → Render Tree
- b) Creación de DOM y CSSOM → Render Tree → Layout (disposición) → Pintado
- c) Pintado → Layout → DOM → Parseo

**R:** **b)** 1) **Creación del DOM y del CSSOM** (dos árboles en memoria) · 2) **Render Tree** (combina ambos) · 3) **Layout** (ancho, alto y coordenadas de cada caja) · 4) **Paint** (colores, bordes, imágenes, píxel a píxel).

---

**1.2.08** `[MC]` ¿Qué elementos quedan **fuera** del árbol de renderizado?
- a) Los que tienen `display: none` y el `<head>`
- b) Solo el `<head>`
- c) Las etiquetas `<script>`

**R:** **a)** El Render Tree **solo incluye los elementos visibles**: quedan fuera `<head>` y los elementos con `display: none`.

---

**1.2.09** `[MC]` ¿Qué ocurre si el navegador encuentra un `<script>` sin `defer` ni `async` mientras lee el HTML?
- a) Lo salta y lo ejecuta al final
- b) **Detiene el análisis del HTML** hasta que el script se descarga y se ejecuta por completo
- c) Lo descarga en segundo plano

**R:** **b)** Si el script es muy pesado, la **pantalla se queda en blanco** durante unos instantes.

---

**1.2.10** `[MC]` ¿Cuál es el equivalente moderno a `<script type="text/javascript">`?
- a) `<script language="javascript">`
- b) `<script>` a secas: en HTML5 el navegador asume JavaScript
- c) `<javascript>`

**R:** **b)** El atributo `type` era obligatorio en versiones antiguas; los navegadores actuales lo reconocen por compatibilidad pero **ya no hace falta escribirlo**.

---

**1.2.11** `[MC]` ¿Qué API permite pedir datos a un servidor **sin recargar la página**?
- a) `console.log()`
- b) `fetch()`
- c) `alert()`

**R:** **b)** `fetch()` es la capacidad de **peticiones en segundo plano**.

---

**1.2.12** `[MC]` ¿Qué mecanismo de almacenamiento **se borra al cerrar la pestaña**?
- a) `localStorage`
- b) `sessionStorage`
- c) `IndexedDB`

**R:** **b)** `sessionStorage` guarda datos **mientras la pestaña siga abierta**. `localStorage` es **permanente** (≈5-10 MB) e `IndexedDB` es una base de datos grande en el navegador para **trabajar sin conexión**.

---

**1.2.13** `[MC]` ¿Cuál es la capacidad aproximada de una **cookie**?
- a) 4 KB
- b) 5 MB
- c) Sin límite

**R:** **a)** Las cookies son textos muy pequeños (hasta **4 KB**) y **se envían al servidor en cada petición**, por lo que sirven para mantener la sesión.

---

**1.2.14** `[MC]` ¿Cuál de estas capacidades del navegador **requiere siempre permiso del usuario**?
- a) Modificar el DOM
- b) Acceder a la geolocalización, la cámara o el micrófono
- c) Guardar en `localStorage`

**R:** **b)** Acceso a dispositivos físicos: geolocalización, cámara y micrófono, estado de la batería y de la red. Siempre con permiso.

---

**1.2.15** `[MC]` ¿Cómo se comprueba si el navegador soporta una función antes de usarla?
- a) Con `if ("geolocation" in navigator) { ... }`
- b) Con `try { navigator.geolocation } catch { }` siempre
- c) No se puede comprobar

**R:** **a)** No todos los navegadores incorporan las novedades al mismo tiempo, así que se verifica la existencia con `in`. Para consultar en qué versiones funciona cada característica se usa **Can I Use** (caniuse.com).

---

**1.2.16** `[DEF]` ¿Qué es el DOM y por qué se dice que JavaScript «no dibuja»?

**R:** El **DOM (Document Object Model)** es la estructura en forma de **árbol invertido** que el navegador crea **en la memoria RAM** a partir del documento: cada etiqueta es un nodo, y cada nodo es un objeto con propiedades y métodos. JavaScript **no dibuja directamente** en la tarjeta gráfica: busca nodos en el DOM, lee o cambia sus propiedades, y es el **motor de renderizado** quien recalcula y pinta.

---

**1.2.17** `[MC]` ¿Cuál es la **raíz global** del entorno cliente: `window` o `document`?
- a) `document`
- b) `window`
- c) `navigator`

**R:** **b)** `window` es el objeto raíz (**BOM**). `document` (el DOM) es **una propiedad que cuelga de `window`**: `window.document`. El árbol es: `window → document → html → (head/body)`.

---

**1.2.18** `[VF]` `window.alert("x")` y `alert("x")` son equivalentes.

**R:** **Verdadero.** Por la **regla de ámbito global**: las funciones nativas y las variables globales declaradas con `var` a nivel superior pasan a ser **propiedades de `window`**.

---

**1.2.19** `[MC]` ¿Cuál de estos mecanismos de salida es **invisible para el usuario**?
- a) `innerHTML`
- b) `console.log()`
- c) `window.alert()`

**R:** **b)** `console.log()` escribe en el panel de diagnóstico (F12). `innerHTML` y `document.write()` muestran el cambio en la página, y `alert()` abre una ventana modal visible.

---

**1.2.20** `[MC]` ¿Qué ocurre si se llama a `document.write()` **después** de que la página haya cargado?
- a) Añade el texto al final de la página
- b) **Borra de forma irreversible todo el documento** y deja solo lo escrito en esa llamada
- c) No hace nada

**R:** **b)** Solo funciona de forma segura **mientras el navegador está cargando la página**. Por eso está **obsoleto** y no se usa en desarrollos modernos: se usa `textContent` o `innerHTML`.

---

**1.2.21** `[VF]` `window.alert()` es **síncrono y bloqueante**: hasta que el usuario pulsa «Aceptar» el hilo principal de JavaScript queda congelado, las animaciones se paran y la página no atiende otros eventos.

**R:** **Verdadero.** Es una ventana **modal nativa del sistema operativo**, con un mensaje y un botón de aceptar.

---

**1.2.22** `[MC]` ¿Para qué sirven `console.warn()`, `console.error()`, `console.time()` y `console.timeEnd()`?
- a) Para mostrar avisos amarillos, errores y medir tiempos exactos de cálculo
- b) Para modificar el texto de la página
- c) Para declarar variables

**R:** **a)** `warn()` emite **avisos amarillos**, `error()` **errores** (rojo), y `time()`/`timeEnd()` miden el tiempo **entre ambas llamadas, en milisegundos**.

---

**1.2.23** `[MC]` ¿Cuál es el problema de seguridad de usar `innerHTML` con datos de un usuario desconocido?
- a) **XSS** (Cross-Site Scripting): podría inyectar un `<script>` malicioso que se ejecute en el navegador de otros
- b) SQL injection
- c) Ninguno

**R:** **a)** Para insertar **texto plano** se recomienda **`textContent`**, inmune a ese tipo de inyección y más rápido. Nombre completo del ataque: **XSS = Cross-Site Scripting**.

---

**1.2.24** `[MC]` ¿Qué diferencia hay entre **reflow** y **repaint**?
- a) Son lo mismo
- b) **Reflow**: el cambio altera dimensiones o posición (p. ej. `fontSize`, `innerHTML`) → el navegador recalcula el espacio y desplaza lo que rodea. **Repaint**: solo cambia una propiedad visual que no altera el espacio (p. ej. `color`, `backgroundColor`) → solo repinta los píxeles afectados
- c) El reflow solo ocurre en el servidor

**R:** **b)** Los cambios que provocan **reflow continuos dentro de un bucle** ralentizan la página: hay que **agrupar las modificaciones** para evitar parpadeos y caídas de FPS.

---

**1.2.25** `[MC]` ¿Por qué `background-color` se escribe `style.backgroundColor` en JavaScript?

**R:** Porque el guion `-` representa **la resta** en JavaScript. La regla **camelCase** para propiedades compuestas es: eliminar el guion y escribir en mayúscula la letra siguiente.
`background-color → style.backgroundColor` · `font-size → style.fontSize` · `margin-top → style.marginTop` · `border-radius → style.borderRadius`. El **valor es siempre una cadena e incluye la unidad**: `x.style.fontSize = "25px";`.

---

# 1.3 · Lenguajes de programación de cliente (CE 1.c)

**1.3.01** `[VF]` HTML es un lenguaje de programación.

**R:** **Falso.** HTML es un **lenguaje de marcado basado en etiquetas**. Tampoco CSS es un lenguaje de programación: es **declarativo de estilos**. Los dos carecen de variables, bucles y condiciones.

---

**1.3.02** `[MC]` ¿Cuáles son las tres responsabilidades de la tríada?
- a) HTML = estructura, CSS = presentación, JavaScript = lógica y eventos
- b) HTML = presentación, CSS = estructura, JavaScript = base de datos
- c) Las tres hacen lo mismo

**R:** **a)** **HTML** estructura y semántica · **CSS** aspecto, estética y maquetación · **JavaScript** dinamismo, eventos, validación local y alterar el documento en caliente.

---

**1.3.03** `[MC]` ¿Cómo se caracteriza JavaScript como lenguaje?
- a) Compilado, fuertemente tipado, orientado a objetos puro
- b) **Dinámico, débilmente tipado y orientado a eventos**
- c) Estático y con tipado estricto

**R:** **b)** El tipo lo determina el **valor**, no la declaración.

---

**1.3.04** `[MC]` ¿Qué es **TypeScript** en relación con JavaScript?
- a) Un sustituto de JavaScript
- b) Una **capa sobre JavaScript que le añade tipado estático**
- c) Un lenguaje de marcado

**R:** **b)** Se usa como **estándar actual de la industria**: es un superconjunto de Microsoft que añade tipado estático y se compila a JavaScript estándar.

---

**1.3.05** `[MC]` ¿Quién creó JavaScript, en qué año, para qué empresa y en cuánto tiempo?
- a) James Gosling, 1995, Sun, 5 años
- b) **Brendan Eich, 1995, Netscape, en 10 días**
- c) Dennis Ritchie, 1972, Bell Labs

**R:** **b)** Nació en **mayo de 1995** cuando la web estaba dominada por Netscape. Pasó por los nombres **Mocha → LiveScript → JavaScript**. Su objetivo era dar interactividad básica a los documentos HTML.

---

**1.3.06** `[MC]` ¿Qué ocurrió en 1996 y por qué fue importante?
- a) Nació ECMAScript
- b) Microsoft lanzó **JScript** con Internet Explorer 3.0 por ingeniería inversa → comenzó la primera **guerra de navegadores**
- c) Se publicó ES5

**R:** **b)** Empezó la primera «guerra de navegadores» y con ella los problemas de compatibilidad entre navegadores.

---

**1.3.07** `[MC]` ¿Qué pasó en 1997?
- a) Netscape entrega la especificación a **Ecma International** y nace **ECMAScript (ECMA-262)**, el estándar del que JavaScript es **implementación**
- b) Nació AJAX
- c) Se lanzó Chrome

**R:** **a)** Clave de examen: **ECMAScript es el estándar; JavaScript es una implementación**.

---

**1.3.08** `[MC]` ¿Qué aportó **ES3** (1998-1999)?
- a) Funciones flecha y `let`
- b) **Expresiones regulares, `try/catch`, mejoras en cadenas y objetos**; consolidó el lenguaje durante una década
- c) Clases y módulos

**R:** **b)** Fue la fase de consolidación del lenguaje.

---

**1.3.09** `[MC]` ¿Por qué se abandonó **ES4**?
- a) Por falta de fondos
- b) Por su **complejidad** (reescritura radical con tipado estático y clases) y falta de consenso del comité TC39
- c) Porque nunca existió

**R:** **b)** El comité TC39 entró en un periodo de desacuerdo entre 2000 y 2008.

---

**1.3.10** `[MC]` ¿Quién acuñó el término **AJAX** y en qué año? ¿Qué API lo hace posible?
- a) Jesse James Garrett, 2005; `XMLHttpRequest`
- b) Brendan Eich, 1995; `XMLHttpRequest`
- c) Ryan Dahl, 2009; `fetch()`

**R:** **a)** Permitió actualizar páginas sin recargarlas (Google Maps, Gmail) y convirtió a JavaScript de adorno en herramienta de aplicaciones web completas.

---

**1.3.11** `[MC]` ¿Qué librerías aparecieron en 2006 para unificar las APIs del DOM entre navegadores?
- a) React, Vue, Angular
- b) **jQuery, Prototype y MooTools**
- c) Ember, Backbone, Meteor

**R:** **b)** Nacen con esa finalidad; los frameworks actuales son plataformas completas.

---

**1.3.12** `[MC]` ¿Qué incorporó **ECMAScript 5 (diciembre de 2009)**?
- a) Modo estricto (`"use strict"`), métodos funcionales de array, **soporte nativo de JSON**, getters y setters
- b) Funciones flecha y `const`
- c) DOM virtual

**R:** **a)** También `Object.freeze` y `Object.keys`.

---

**1.3.13** `[MC]` ¿Quién creó **Node.js** y sobre qué motor?
- a) Brendan Eich sobre SpiderMonkey
- b) **Ryan Dahl, sobre el motor V8** (2008-2009), llevando JavaScript al back-end
- c) James Gosling sobre la JVM

**R:** **b)** En esas mismas fechas Google lanzó **Chrome con el motor V8** (compilación JIT).

---

**1.3.14** `[MC]` ¿Qué suponía **ES6 / ECMAScript 2015**?
- a) Una actualización menor
- b) **La mayor refundición desde 1995**: `let`, `const`, funciones flecha, clases, módulos, plantillas de texto
- c) El abandono de los frameworks

**R:** **b)** A partir de ES6, el TC39 aprobó un proceso en **4 fases (Stages 0 a 4)** con **publicaciones anuales** (ES2016+).

---

**1.3.15** `[MC]` ¿Cuáles son las **4 ventajas** de los frameworks en el desarrollo empresarial?
- a) Coste nulo, fiabilidad/seguridad/rendimiento, velocidad de entrega, estandarización de equipos
- b) Solo velocidad
- c) Solo coste nulo

**R:** **a)** Las cuatro aparecen en el temario.

---

**1.3.16** `[MC]` Completa: React es de ____ (Meta), usa ____ y ____.
- a) Google · TypeScript · RxJS
- b) **Meta (Facebook) · DOM virtual · JSX**
- c) Evan You · DOM virtual · plantillas

**R:** **b)** Programación **orientada a componentes** reutilizables, cada uno con su propio estado.

---

**1.3.17** `[MC]` Angular se programa en ____ y tiene curva de aprendizaje ____.
- a) JavaScript · suave
- b) **TypeScript · pronunciada** (inyección de dependencias, RxJS, rigidez estructural)
- c) Python · nula

**R:** **b)** La primera versión se denominó **AngularJS**. Es la opción para equipos grandes con tipado estricto.

---

**1.3.18** `[MC]` ¿Quién diseñó Vue.js y con qué premisa?
- a) Google · corregir Angular
- b) **Evan You · tomar las mejores características de React y Angular**
- c) Meta · para el back-end

**R:** **b)** Emplea también **DOM virtual**, curva **progresiva** y se combina con back-ends como **Laravel**.

---

**1.3.19** `[MC]` ¿Cuáles son los otros frameworks y librerías alternativos citados?
- a) EmberJS, BackboneJS, MeteorJS, Aurelia.js, Polymer y Mithril.js
- b) Django, Rails, Laravel, Symfony
- c) Solo jQuery

**R:** **a)** EmberJS = convención sobre configuración · BackboneJS = modelos y vistas ligeras · MeteorJS = tiempo real, cliente y servidor unificados.

---

**1.3.20** `[DEF]` ¿Qué es el **DOM virtual**?

**R:** El framework guarda en la **memoria RAM una copia ligera del DOM**. Cuando los datos cambian, calcula las **diferencias mínimas** entre la copia y el DOM real (**reconciliación**) y **actualiza solo los nodos necesarios**, lo que minimiza los costosos reflow y repaint del navegador.

---

**1.3.21** `[VF]` JSX es un lenguaje de programación independiente de JavaScript.

**R:** **Falso.** JSX es una **extensión de sintaxis de JavaScript** (parecida a un lenguaje de plantillas) que **se compila a JavaScript**. Se usa sobre todo en React.

---

**1.3.22** `[MC]` ¿Qué analogía explica la **programación reactiva**?
- a) La calculadora de un móvil
- b) **La hoja de cálculo**: si C1 contiene `=A1+B1`, al cambiar A1 o B1 se recalcula sola
- c) El intérprete de comandos

**R:** **b)** Se declara la relación entre los datos y, cuando el valor original varía, los dependientes **se actualizan automáticamente**, sin que el programador invoque la actualización. La usan Vue, React y Angular.

---

**1.3.23** `[MC]` ¿Qué forma de declarar una función **disfruta de hoisting** (se puede llamar antes de escribirla)?
- a) Expresión de función (`const f = function(){}`)
- b) **Declaración tradicional** (`function f(){}`)
- c) Función flecha

**R:** **b)** Solo la declaración tradicional se **eleva** al principio de su ámbito. La expresión de función y la flecha **no** se pueden usar antes de definirse.

---

**1.3.24** `[MC]` ¿Qué carácter permite el retorno implícito en una función flecha?
- a) El acento grave con `${}` solo para texto
- b) `=>` : si el cuerpo es una sola expresión, el `return` y las llaves `{}` son implícitos
- c) `;`

**R:** **b)** `const sumar = (a, b) => a + b;` y `const cuadrado = x => x * x;` (con un solo parámetro se omiten los paréntesis).

---

# 1.4 · Programación de guiones (scripts) y objeto `Date` (CE 1.d)

**1.4.01** `[DEF]` ¿Cómo nacieron los scripts y qué los define?

**R:** Surgieron como **secuencias de comandos** diseñadas para **automatizar tareas rutinarias y repetitivas** en los sistemas operativos. **Siempre son ejecutados por un intérprete** de comandos o motor subyacente. De pequeñas macros han pasado a ser programas completos de miles de líneas.

---

**1.4.02** `[MC]` ¿Cuál NO es una diferencia entre lenguajes tradicionales y de script?
- a) Compilación previa frente a interpretación
- b) Programa independiente frente a integración en un anfitrión (host)
- c) Ambos necesitan siempre compilarse antes de ejecutarse

**R:** **c)** Esa es justamente la diferencia: los de script **se interpretan línea a línea en tiempo de ejecución**, sin que el programador genere un ejecutable.

---

**1.4.03** `[MC]` ¿Qué es el **anfitrión (host)** y qué ejemplo se da?
- a) El compilador
- b) El entorno que permite ejecutar el script; por ejemplo, **el navegador** para JavaScript
- c) El sistema de archivos

**R:** **b)** Los scripts **reutilizan los componentes preexistentes** del anfitrión: en JavaScript, los elementos HTML y las funcionalidades del navegador (DOM, motor gráfico, red).

---

**1.4.04** `[MC]` ¿Cuándo se detectan los errores en cada modelo?
- a) En los dos, en compilación
- b) **Tradicionales: en compilación** (si hay fallo no se genera el binario). **Script: en tiempo de ejecución**, línea a línea
- c) En los dos, al ejecutar

**R:** **b)** Por eso en los scripts es importante **realizar pruebas**: un fallo en una rama poco transitada puede pasar inadvertido.

---

**1.4.05** `[MC]` ¿Cuáles son **lenguajes tradicionales** y cuáles **de script**?
- a) Tradicionales: C, C++, Java, Swift, Pascal · Script: JavaScript, Shell, Perl, PHP, Python, Ruby
- b) Tradicionales: Python, Ruby · Script: C, C++
- c) Todos son de script

**R:** **a)** Esa clasificación es la del temario.

---

**1.4.06** `[MC]` Dentro de los lenguajes tradicionales, ¿qué diferencia hay entre compilados nativos y gestionados por máquina virtual?
- a) Los nativos producen binarios autónomos (C++, Go, Rust); los gestionados se compilan a código intermedio y necesitan entorno instalado (Java → JVM, C# → .NET)
- b) Son lo mismo
- c) Los gestionados no se compilan

**R:** **a)** Los binarios autónomos **no** necesitan nada instalado; los gestionados sí (JVM o .NET).

---

**1.4.07** `[MC]` ¿Por qué se dice que la frontera «se ha difuminado»?
- a) Porque los lenguajes de script ya no existen
- b) Porque JavaScript y Python corren también **fuera del navegador** (Node.js, terminal) y pueden **empaquetarse** con herramientas como PyInstaller, pkg o Electron
- c) Porque C++ ya no se compila

**R:** **b)** Es una de las «preguntas trampa» habituales.

---

**1.4.08** `[MC]` ¿Cuáles son las **ventajas** de los guiones?
- a) Sencillez y curva rápida · agilidad sin esperar compilación · integración natural · portabilidad por el anfitrión
- b) Rendimiento bruto alto y código oculto
- c) Solo la agilidad

**R:** **a)** Las cuatro. «Agilidad» significa: se recarga la página y se prueba, sin compilar.

---

**1.4.09** `[MC]` ¿Cuáles son las **desventajas** de los guiones?
- a) Mayor tasa de errores en tiempo de ejecución · rendimiento bruto inferior y mayor consumo de memoria/CPU · **exposición del código fuente**
- b) No se pueden portar
- c) Necesitan compilación previa

**R:** **a)** La exposición del código fuente es la más citada: en JavaScript el código viaja al cliente como **texto plano**.

---

**1.4.10** `[VF]` Decir que «JavaScript no se compila nunca» es FALSO.

**R:** **Verdadero** que es falso: los motores actuales aplican **JIT**, que compila a código máquina las funciones más ejecutadas.

---

**1.4.11** `[MC]` ¿Qué diferencia hay entre Java y JavaScript?
- a) Son casi lo mismo
- b) **Java: fuerte y estático, compilado a bytecode, OO basado en clases, errores en compilación. JavaScript: débil y dinámico, interpretado, orientado a eventos con prototipos, errores en ejecución**
- c) Java es de script y JavaScript tradicional

**R:** **b)** Comparten parte del nombre por **razones comerciales de su origen histórico**, pero son de filosofías opuestas.

---

**1.4.12** `[MC]` ¿Por qué se destaca **Python** en el temario?
- a) Por ser el lenguaje de la web
- b) Por ser el **lenguaje de referencia en IA, computación científica y tratamiento masivo de datos**
- c) Por ser el más rápido

**R:** **b)** Es la proyección del ecosistema de scripting.

---

## Objeto `Date` (parte de 1.4)

**1.4.13** `[VF]` En JavaScript las fechas son un tipo primitivo.

**R:** **Falso.** Son **instancias del objeto nativo `Date`**, y representan una **instantánea fija** en el tiempo: no se actualizan como un reloj.

---

**1.4.14** `[DEF]` ¿Qué es la época Unix y cómo se almacena internamente una fecha?

**R:** JavaScript representa las fechas mediante los **milisegundos transcurridos desde el 1 de enero de 1970 a las 00:00:00 UTC**. Positivo = instante posterior; negativo = anterior. 1 segundo = 1.000 ms · **1 día = 86.400.000 ms**.

---

**1.4.15** `[MC]` ¿Qué devuelve `new Date(86400000)`?
- a) El año 86400000
- b) Un día después del inicio de la época Unix (2 de enero de 1970)
- c) 86400000 días después

**R:** **b)** Un único número **siempre** son milisegundos desde 1970. `new Date(0)` = 1 de enero de 1970 UTC.

---

**1.4.16** `[MC]` ¿Cuántas formas principales tiene `new Date`?
- a) Dos: número o texto
- b) **Cuatro**: sin argumentos (fecha y hora actuales), texto (se recomienda **ISO `AAAA-MM-DD`**), componentes numéricos y milisegundos
- c) Una sola

**R:** **b)** El constructor por componentes admite de **2 a 7 argumentos**: `new Date(año, mes, día, horas, minutos, segundos, ms)`.

---

**1.4.17** `[MC]` ¿Qué valores devuelve `new Date(2026, 11, 25, 10, 30)`?
- a) 11 de enero de 2026
- b) **25 de diciembre de 2026, 10:30** (el mes 11 es diciembre)
- c) Un error

**R:** **b)** **Los meses empiezan en 0**: enero = 0 … diciembre = 11. Los **días empiezan en 1** (del 1 al 31).

---

**1.4.18** `[MC]` ¿Qué hace `new Date(2026)`?
- a) El 1 de enero de 2026
- b) **2026 milisegundos después de 1970** (no es el año)
- c) El año 2026 en diciembre

**R:** **b)** Para el año 2026: `new Date(2026, 0, 1)`. Es la **TRAMPA** clásica del temario.

---

**1.4.19** `[MC]` ¿Qué devuelve `new Date(2026, 15, 20)`?
- a) Un error
- b) **20 de abril de 2027** (desbordamiento automático: mes 15 = 1 año + 3 meses)
- c) 15 de junio de 2026

**R:** **b)** JavaScript **ajusta automáticamente** los valores fuera de rango y avanza a la siguiente unidad. Otros ejemplos: `new Date(2026, 5, 35)` → 5 de julio de 2026; `new Date(2026, 12, 1)` → 1 de enero de 2027.

---

**1.4.20** `[MC]` ¿Qué devuelve `new Date(95, 5, 15)`?
- a) 95 de junio de 2015
- b) **15 de junio de 1995** (los años de 0 a 99 se interpretan como siglo XX)
- c) Un error

**R:** **b)** Regla histórica de JavaScript.

---

**1.4.21** `[MC]` ¿Cuál es la diferencia entre `new Date("2026-02-28")` y `new Date("2026/02/28")`?
- a) Ninguna
- b) La **ISO con guiones se interpreta en UTC**; la de **barras, en hora local** → puede haber desfase de horas
- c) La de barras da error

**R:** **b)** Usa siempre **ISO con guiones** para intercambiar datos.

---

**1.4.22** `[MC]` ¿Para qué se usa `toISOString()` y para qué `toUTCString()`?
- a) `toISOString()` para depurar; `toUTCString()` para la interfaz de usuario
- b) `toISOString()` para **intercambio con APIs y bases de datos** (UTC); `toUTCString()` para **cabeceras HTTP y cookies**
- c) Ambas para la consola

**R:** **b)** El resto: `toString()` (texto completo con zona), `toDateString()` (solo fecha), `toTimeString()` (solo hora con huso), `toLocaleDateString()` (según idioma y región del usuario, p. ej. `28/9/2026` en es-ES).

---

**1.4.23** `[MC]` ¿Qué devuelve `getDay()`?
- a) El día del mes (1-31)
- b) El **día de la semana (0 = domingo … 6 = sábado)**
- c) El mes (0-11)

**R:** **b)** Para el día del mes está `getDate()` y para el mes `getMonth()`.

---

**1.4.24** `[MC]` Un `<select>` pinta directamente `getMonth()` esperando el mes 9 = septiembre. ¿Qué se ve?
- a) Septiembre
- b) **Octubre**, porque los meses van de 0 a 11
- c) Nada

**R:** **b)** Hay que sumar 1 al leer o restar 1 al enviar. Error clásico del temario.

---

**1.4.25** `[MC]` ¿Cómo se comparan correctamente dos objetos `Date`?
- a) Con `===`
- b) Restándolos: `fin.getTime() - inicio.getTime()` (o comparando `getTime()`)
- c) Con `innerHTML`

**R:** **b)** Son **objetos distintos**: `===` los declara diferentes aunque representen el mismo instante. Restarlos da la diferencia en **milisegundos**, lo que permite calcular intervalos (por ejemplo, días: `diferencia / 86.400.000`).

---

**1.4.26** `[MC]` ¿Cómo se obtiene el último día de un mes?
- a) `new Date(anio, mes, 0).getDate()`
- b) `new Date(anio, mes + 1, 0)`
- c) `new Date(anio, mes, 31).getDate()`

**R:** **a)** El **día 0 de un mes equivale al último día del mes anterior**. Ojo: como el constructor espera el índice (0 = enero) y el mes se recibe en formato humano (1 = enero), el valor pasado tal cual designa el mes siguiente. Ejemplos: `obtenerUltimoDiaMes(2026, 1)` → 31 (enero); `(2026, 2)` → 28; `(2028, 2)` → **29 (bisiesto)**.

---

**1.4.27** `[MC]` ¿Cuál es la diferencia entre `Date.now()` y `new Date()`?
- a) Ninguna
- b) `Date.now()` devuelve el **timestamp actual en ms sin instanciar un objeto**; `new Date()` crea el objeto con la fecha y hora del **reloj local**
- c) `Date.now()` devuelve segundos

**R:** **b)** `getTime()` también devuelve **milisegundos**, nunca segundos.

---

**1.4.28** `[MC]` ¿Para qué sirve `padStart` y por qué hay que envolver con `String()`?
- a) Para recortar cadenas
- b) Devuelve una **nueva cadena de la longitud indicada, rellenada a la izquierda**; como es un método de cadena, **no** existe en los números
- c) Para formatear números sin `String()`

**R:** **b)** `"5".padStart(2, "0")` → `"05"`; `String(7).padStart(4, "0")` → `"0007"`. Se usa para formatear fechas: `String(fecha.getDate()).padStart(2, "0")`.

---

# 1.5 · Integración de HTML + JavaScript (CE 1.e)

**1.5.01** `[MC]` ¿Cuál es la sintaxis actual (HTML5) de la etiqueta `<script>`?
- a) `<script type="text/javascript">…</script>`
- b) `<script>…</script>`
- c) `<script language="js" />`

**R:** **b)** El navegador asume JavaScript por defecto.

---

**1.5.02** `[DEF]` ¿Por qué `<script src="script.js" />` **no funciona**?

**R:** Porque **HTML no es XML**: la etiqueta **nunca puede cerrarse de forma abreviada**. Si se escribe así, el resto de la página no se muestra. Siempre hay que escribir `</script>`, incluso cuando enlaza un archivo externo sin contenido interno. **Cierre obligatorio.**

---

**1.5.03** `[MC]` ¿Cuáles son las **ventajas de los ficheros externos** (`.js`)?
- a) Caché del navegador · modularidad (diseñadores y programadores a la vez) · mantenimiento y reutilización · organización en un directorio `js`
- b) Solo la primera
- c) Evitan tener que cerrar `</script>`

**R:** **a)** El archivo se descarga **una sola vez** y se reutiliza en otras páginas del mismo sitio, ahorrando ancho de banda y tiempo de carga.

---

**1.5.04** `[MC]` ¿Cuál es el criterio de uso del **código embebido** en el HTML?
- a) Siempre, es más rápido
- b) Solo cuando las líneas de código son **mínimas, específicas de una única página y no previsiblemente modificables**
- c) Nunca, en ningún caso

**R:** **b)** El resultado visual es **exactamente el mismo** que con fichero externo, pero los bloques `<script>` diseminados por `<head>` y `<body>` dificultan la depuración y el mantenimiento.

---

**1.5.05** `[MC]` Un `<script>` en el `<head>` llama a `document.getElementById('prueba')`. ¿Qué pasa?
- a) Funciona siempre
- b) **Falla**: ese elemento del `<body>` todavía no ha sido leído ni construido en el DOM → `null` → `TypeError`
- c) Se ejecuta dos veces

**R:** **b)** El navegador **detiene el análisis del HTML** hasta que el script se descarga y se ejecuta.

---

**1.5.06** `[DEF]` ¿Cuál es la recomendación tradicional de ubicación del script?

**R:** Colocarlo **al final del `<body>`, justo antes de `</body>`**, para que todo el marcado, los textos y las imágenes ya estén analizados e insertados en el DOM antes de que se ejecute la lógica de interacción.

---

**1.5.07** `[DEF]` ¿Qué hace el atributo **`defer`**?

**R:** En un `<script>` **externo**: **descarga el archivo en segundo plano** mientras el navegador sigue construyendo el HTML, pero **retrasa su ejecución hasta que el documento se ha analizado por completo**, **respetando el orden** de los scripts. Uso típico: scripts de la aplicación que **manipulan el DOM**.
`<script defer src="./js/logica.js"></script>`

---

**1.5.08** `[DEF]` ¿Qué hace el atributo **`async`**?

**R:** **Descarga el archivo en segundo plano y lo ejecuta de inmediato en cuanto termina la descarga**, sin esperar a que el HTML termine de leerse y **sin respetar el orden**. Uso típico: **servicios independientes**, como analítica o contadores.
`<script async src="script.js"></script>`

---

**1.5.09** `[MC]` ¿Cuál es la diferencia clave entre `defer` y `async`?
- a) `defer` espera al HTML y respeta el orden; `async` no espera al HTML ni respeta el orden
- b) `defer` no descarga en segundo plano; `async` sí
- c) Son idénticos

**R:** **a)** Los tres casos: **sin atributo** → detiene el análisis y ejecuta de inmediato; **`defer`** → en paralelo, al terminar el parseo, respetando orden; **`async`** → en paralelo, en cuanto acaba la descarga, sin esperar ni ordenar.

---

**1.5.10** `[MC]` ¿Cuál es la **regla práctica** cuando aún no se dominan los matices?
- a) Colocar el `<script>` antes de `</body>` **o** en el `<head>` con `defer`
- b) Siempre en el `<head>` sin atributos
- c) Siempre embebido

**R:** **a)**

---

**1.5.11** `[MC]` ¿Cómo se enlaza un script externo dentro de un proyecto organizado?
- a) `<script src="logica.js"></script>`
- b) `<script src="./js/logica.js"></script>`
- c) `<script src="C:\js\logica.js"></script>`

**R:** **b)** Con **ruta relativa** e incluyendo la carpeta. Estructura típica: `mi_proyecto/ ├── css/estilos.css ├── js/logica.js └── index.html`.

---

**1.5.12** `[MC]` En el panel **Network** aparece un **404** al cargar tu `.js`. ¿Cuál es la causa más probable?
- a) El JavaScript tiene un error de sintaxis
- b) La **ruta del atributo `src` es incorrecta** o el fichero no existe en esa carpeta
- c) Falta el atributo `defer`

**R:** **b)** Un **200 OK** confirma que el navegador localizó y descargó el archivo; un **404 Not Found** significa ruta o nombre incorrectos.

---

# 1.6 · Herramientas de programación y prueba (CE 1.f)

**1.6.01** `[MC]` ¿Cuál es el editor más usado para JavaScript/TypeScript según el ranking del temario?
- a) Vim
- b) **Visual Studio Code (75,9 % de uso global)**
- c) Dreamweaver

**R:** **b)** Más del **80 % de los desarrolladores front-end** lo usan como herramienta principal. Es el estándar absoluto de la industria: soporta TypeScript de fábrica (el propio editor está escrito en TypeScript) y tiene extensiones como **ESLint, Prettier** y los Snippets de React/Vue.

---

**1.6.02** `[MC]` ¿Para qué se sigue usando **Notepad++ (27,4 %)**?
- a) Para armar una aplicación moderna compleja tipo Next.js
- b) En Windows para **edición rápida de scripts sueltos**, manipulación veloz de archivos `.json` gigantes o tareas ligeras de automatización
- c) Para nada, está obsoleto

**R:** **b)** No indexa un proyecto con React ni gestiona dependencias: para eso hace falta un IDE.

---

**1.6.03** `[MC]` ¿Cuál es la particularidad de **Vim/Neovim (38,3 % combinado)**?
- a) Es un IDE gráfico de Microsoft
- b) Corre **directo en la terminal a máxima velocidad**, con el mismo autocompletado y tipado inteligente de TypeScript que VS Code (con Neovim)
- c) Es el motor de renderizado de Firefox

**R:** **b)** Vim 24,3 % + Neovim 14 %. Es el favorito de los desarrolladores avanzados y administradores de servidores.

---

**1.6.04** `[MC]` ¿Qué es **Cursor (17,9 % y subiendo)**?
- a) Un framework de JavaScript
- b) Un **clon exacto de VS Code con IA nativa** para generar componentes interactivos o refactorizar TypeScript en lenguaje natural
- c) Un motor de renderizado

**R:** **b)** La herramienta de IA que más rápido ha escalado en los rankings.

---

**1.6.05** `[MC]` ¿Qué editores de **JetBrains** se citan y por qué están cotizados?
- a) VS Code, por su velocidad
- b) **WebStorm (7,6 %, 15,1 % combinados)**: su **motor de refactorización y detección de rutas rotas** es el más inteligente y seguro del mercado
- c) Atom, por ser open source

**R:** **b)** Su porcentaje global es menor porque es una herramienta tradicionalmente **comercial de pago** (aunque JetBrains ha liberado una versión gratuita para uso no comercial). Está muy cotizado en entornos profesionales y corporativos.

---

**1.6.06** `[MC]` ¿Cuál es la diferencia entre **VS Code** y **VSCodium**?
- a) VSCodium tiene más funciones
- b) Ambos usan el mismo código libre (**Code -OSS**), pero el instalador de VS Code incluye **licencia comercial y telemetría**; VSCodium es **100 % libre**, sin telemetría ni rastreo
- c) VSCodium es de JetBrains

**R:** **b)** VS Code pertenece a Microsoft y restringe algunas extensiones oficiales en otros editores. VSCodium es un proyecto independiente que compila el mismo código fuente de forma limpia.

---

**1.6.07** `[MC]` ¿Cuáles son los **editores independientes con IA nativa** que menciona el temario?
- a) **Windsurf** (Codeium, fork de VS Code, modo agente **Cascade**), **Void** (código abierto, claves de API propias) y **Zed** (Rust, uso de GPU, API Key propia)
- b) Solo Sublime Text
- c) Dreamweaver y Word

**R:** **a)** Windsurf es el competidor más directo de Cursor; Void compite con el modelo comercial cerrado; Zed es de rendimiento extremo, escrito en Rust.

---

**1.6.08** `[MC]` ¿Cuáles son las **6 características técnicas fundamentales** para elegir un entorno profesional?
- a) Código abierto y gratuidad · arquitectura modular · gestor de paquetes integrado · autocompletado predictivo · sistema de paneles múltiples · soporte y canales comunitarios
- b) Solo el color, un framework y Git
- c) Solo rendimiento

**R:** **a)** El **gestor de paquetes** registra, instala, actualiza y elimina librerías, extensiones y temas **de forma desatendida**.

---

**1.6.09** `[DEF]` ¿Qué diferencia hay entre **Git** y **GitHub**?
- a) Son lo mismo
- b) **Git** es el sistema de control de versiones **distribuido** que rastrea cada modificación de los archivos a lo largo del tiempo. **GitHub** es la plataforma **en la nube** que aloja repositorios Git y facilita **pull requests, issues e integración continua**
- c) GitHub es el lenguaje de programación

**R:** **b)** Los editores como VS Code integran **paneles nativos de Git** para confirmar cambios (commit), alternar entre ramas y resolver conflictos sin salir del editor.

---

**1.6.10** `[MC]` ¿Qué es **Coding Ground (Tutorialspoint)**?
- a) Un IDE de escritorio
- b) Un entorno online accesible desde el navegador con editor con resaltado de sintaxis, **visualización previa (Preview)** y **consola de ejecución simultánea**, que permite gestionar varios ficheros, descargar el código o importar archivos
- c) Un navegador

**R:** **b)** Útil para probar fragmentos de código sin configurar un entorno local o desde dispositivos con restricciones de instalación.

---

**1.6.11** `[MC]` ¿Qué ofrecen **CodeSandbox, StackBlitz y JSFiddle**?
- a) Solo ejecutar JavaScript
- b) Arrancar proyectos de **React, Angular o Vue directamente desde el navegador** en segundos, sin instalación previa, y evaluar librerías y componentes
- c) Son editores de vídeo

**R:** **b)**

---

**1.6.12** `[MC]` ¿Con qué combinación de teclas se abren las **DevTools**?
- a) F1 y Esc
- b) **F12** o **Ctrl + Shift + I**
- c) Ctrl + Alt + Supr

**R:** **b)** También clic derecho → *Inspeccionar*.

---

**1.6.13** `[MC]` ¿Para qué sirve el **panel Red (Network)**?
- a) Para escribir CSS
- b) Para **supervisar las peticiones HTTP** (HTML, CSS, .js, imágenes, peticiones asíncronas), comprobar el **código de respuesta (200 OK, 404 Not Found, 500 Server Error)**, el **tiempo** y el **tamaño** de los recursos
- c) Para ver el historial del navegador

**R:** **b)** Un `.js` que aparece con **200 OK** confirma que se localizó y descargó.

---

**1.6.14** `[MC]` ¿Para qué sirve el **panel Fuentes (Sources / Debugger)**?
- a) Para ver las fuentes del HTML
- b) Para examinar los ficheros `.js`, establecer **puntos de interrupción (breakpoints)**, inspeccionar variables paso a paso y analizar la **pila de llamadas (Call Stack)**
- c) Para descargar imágenes

**R:** **b)** Cuando la ejecución alcanza un breakpoint, el navegador **congela el script**.

---

**1.6.15** `[MC]` ¿Qué muestra el **panel Consola**?
- a) Solo las salidas de `console.log()`
- b) Permite **interactuar con el motor de JavaScript en tiempo real**, muestra las salidas de `console.log()` y resalta en **rojo las excepciones y errores no capturados**
- c) El peso de la página

**R:** **b)** Es también donde el navegador informa de los errores de ejecución, indicando **archivo y número de línea**.

---

**1.6.16** `[MC]` ¿Según qué parámetros se elige un editor ligero/online frente a un IDE completo?
- a) Solo por el precio
- b) **Escenario de uso** (pruebas rápidas vs proyectos profesionales) · **consumo de recursos** (mínimo vs medio-alto) · **control de versiones** (limitado vs integración profunda con Git) · **personalización** (escasa vs elevada)
- c) Solo por el color del editor

**R:** **b)**

---

**1.6.17** `[MC]` ¿Qué hace la extensión **Live Server**?
- a) Compila TypeScript
- b) Levanta un **servidor web local** en el equipo con un clic y **recarga el navegador automáticamente** cada vez que guardas
- c) Colorea el código

**R:** **b)** Imprescindible para front-end: si no, hay que abrir el archivo desde la carpeta y pulsar F5 constantemente.

---

**1.6.18** `[MC]` ¿Qué hace **Quokka.js**?
- a) Es un formateador de código
- b) Ejecuta el JavaScript **en tiempo real dentro del editor** y muestra el resultado **flotando junto a la línea** de código, sin abrir el navegador ni la terminal
- c) Es un servidor de base de datos

**R:** **b)** Ideal para probar lógica rápido.

---

**1.6.19** `[MC]` ¿Qué hace **Error Lens**?
- a) Ejecuta el código
- b) Convierte la marca de error de una línea (la ola roja) en un **mensaje completo con fondo rojo al final de la línea**, visible sin pasar el cursor por encima
- c) Cambia el tema del editor

**R:** **b)** Las tres extensiones resuelven problemas distintos sobre el mismo archivo: Quokka (evaluación en vivo), Live Server (recarga) y Error Lens (detección visual inmediata).

---

**1.6.20** `[MC]` ¿Por qué un `index.html` abierto con doble clic (**file://**) da problemas?
- a) Porque el navegador no reconoce el HTML
- b) Porque sufre las **restricciones de seguridad del navegador (política de origen único)** y no permite cargar correctamente algunos recursos ni usar `fetch()`
- c) Porque falta el `</script>`

**R:** **b)** Para el apartado 1.5 y para las extensiones hay que usar un **servidor local** (Live Server).

---

**1.6.21** `[MC]` ¿Cuál es el error de herramientas más traicionero?
- a) No guardar el archivo antes de recargar
- b) **Guardar sin guardar de verdad**: si el editor tiene cambios sin guardar, el navegador recarga la versión anterior y parece que el cambio no se aplica
- c) Pulsar F12

**R:** **b)** Live Server y Error Lens vigilan el archivo en disco.

---

**1.6.22** `[MC]` Has puesto un **breakpoint** dentro de un `if` que no se cumple y el script no se congela. ¿Por qué?
- a) El breakpoint está mal escrito
- b) Porque el panel Sources **solo congela el script si la ejecución pasa por esa línea**; dentro de un `if` no cumplido nunca se alcanza
- c) Hay que reiniciar el navegador

**R:** **b)**

---

# Extra · Repaso práctico de sintaxis (HTML, CSS, JS)

**Extra.01** `[MC]` ¿Qué indica `<!DOCTYPE html>` y qué hace `<meta charset="UTF-8">`?
- a) Son decorativos
- b) El primero indica que el documento usa **HTML5**; el segundo fija la **codificación de caracteres**, para representar tildes y la ñ correctamente

**R:** **b)** `<html lang="es">` declara el idioma; `<head>` es configuración y **no se muestra**; `<title>` es el texto de la pestaña; `<body>` es todo lo visible.

---

**Extra.02** `[MC]` ¿Por qué el atributo `id` es tan importante para JavaScript?
- a) Es opcional y decorativo
- b) Asigna un **nombre único** dentro del documento y es el mecanismo principal para que JS localice un elemento (`document.getElementById`). Dos elementos no deben compartir `id`

**R:** **b)** Si el `id` no existe o el elemento aún no está en el DOM, `getElementById` devuelve **`null`** y cualquier acceso a una propiedad lanza `TypeError: Cannot read properties of null`.

---

**Extra.03** `[MC]` ¿Qué etiquetas son **vacías**?
- a) `<div>` y `<span>`
- b) `<img>` y `<br>`: no tienen contenido ni cierre
- c) `<head>` y `<body>`

**R:** **b)** El resto: `<h1>`…`<h6>` encabezados · `<p>` párrafo · `<button>` botón · `<div>` bloque genérico · `<span>` en línea · `<a href>` enlace · `<ul>/<ol>/<li>` listas · `<input>` campo de formulario.

---

**Extra.04** `[MC]` ¿Cuál es la diferencia entre `margin` y `padding`?
- a) `margin` es espacio interior; `padding`, exterior
- b) `margin` es **espacio exterior** del elemento; `padding`, **espacio interior**
- c) Son sinónimos

**R:** **b)** Otras: `color` (color del texto) · `background-color` (fondo) · `font-size` (tamaño de letra) · `border` (borde) · `display` (tipo de caja; **`display: none` oculta el elemento**, y por eso queda fuera del Render Tree).

---

**Extra.05** `[MC]` ¿Qué dos sistemas de disposición usa la maquetación moderna y para qué sirve cada uno?
- a) **Flexbox** para alinear en una dimensión; **Grid** para cuadrículas; con `@media` dan diseño **responsive**
- b) Flexbox para 2D; Grid para nada
- c) Grid y Bootstrap

**R:** **a)** Los estilos pueden declararse en un `<style>`, en un archivo `.css` externo o en el atributo `style` del elemento.

---

**Extra.06** `[MC]` ¿Cuál es la diferencia entre `let`, `const` y `var`?
- a) `let` reasignable, `const` no reasignable; `let/const` tienen **ámbito de bloque** y `var` **ámbito de función** con hoisting, por lo que se desaconseja
- b) Los tres son idénticos
- c) `var` es constante

**R:** **a)** En código moderno se usa **`const` por defecto** y `let` cuando el valor debe cambiar.

---

**Extra.07** `[MC]` ¿Qué devuelve `typeof x` si `x` pasó de número a cadena?
- a) `"number"`
- b) `"string"`, porque no existe tipado en la declaración: una misma variable puede contener tipos distintos
- c) `null`

**R:** **b)** Tipos: `number` (enteros y decimales juntos) · `string` · `boolean` · `undefined` (declarada sin valor) · `null` (ausencia intencionada) · `object` (objetos, arrays, fechas) · `function` (las funciones son valores). **`NaN`** es el resultado de una operación numérica inválida, como `"abc" * 2`.

---

**Extra.08** `[MC]` ¿Cuál es la diferencia entre `==` y `===`?
- a) `==` compara valor y tipo; `===` solo valor
- b) `==` convierte tipos automáticamente; `===` compara valor y tipo **sin conversión** (recomendado)
- c) Son idénticos

**R:** **b)** `5 == "5"` → **true** (convierte la cadena); `5 === "5"` → **false**; `5 !== "5"` → **true**. Usar `=` en vez de `===` es un **error frecuente** (asigna en vez de comparar).

---

**Extra.09** `[MC]` ¿Qué hacen `filter`, `map`, `sort` y `reduce`?
- a) Todos modifican el array original
- b) `filter` y `map` **devuelven un array nuevo**; **`sort` modifica el original**; `reduce` **acumula** (suma) un valor

**R:** **b)** `nums.sort((a,b) => a - b)` ascendente; `nums.sort((a,b) => b - a)` descendente. La función de `sort` devuelve un número: negativo → el primero antes; positivo → después; cero → equivalentes.

---

**Extra.10** `[MC]` ¿Cómo se interpolan valores en una cadena?
- a) Con `+` obligatorio
- b) Con **acentos graves** `` ` `` y `${}`: `` `Hola, ${nombre}` ``, admiten además varias líneas (equivalen a la concatenación con `+`)

**R:** **b)** En JavaScript las cadenas admiten comillas dobles, simples o acentos graves; en Java, solo dobles. **Cuidado al mezclar comillas** (error de sintaxis).

---

**Extra.11** `[MC]` Completa: `click` / `keydown` / `input` / `change` / `submit` / `DOMContentLoaded` se producen cuando…
- a) todos al hacer clic
- b) **click** al pulsar y soltar el ratón · **keydown/keyup** al pulsar/soltar tecla · **input** al escribir en un campo · **change** al cambiar el valor y perder el foco · **submit** al enviar un formulario · **DOMContentLoaded** al terminar de analizar el HTML
- c) son métodos de localización

**R:** **b)** También `mouseover` / `mouseout` cuando el puntero entra o sale del elemento.

---

**Extra.12** `[MC]` ¿Cuál es la diferencia entre registrar el manejador en el atributo HTML y con `addEventListener`?
- a) En el atributo se escribe la función **con paréntesis** (`onclick="cambiar()"`); con `addEventListener` se pasa la **referencia sin paréntesis** (`addEventListener("click", cambiar)`), lo que permite además varios manejadores por evento
- b) Al revés
- c) Son idénticos

**R:** **a)** `addEventListener` es el **recomendado**: mantiene el JS separado del HTML. Escribir `cambiar()` ejecutaría la función de inmediato y entregaría su resultado (no la función).

---

**Extra.13** `[MC]` ¿Qué devuelve cada método de localización?
- a) Todos devuelven el mismo tipo
- b) `getElementById("x")` → el elemento con ese id · `querySelector(".clase")` → el **primero** que cumple un selector CSS · `querySelectorAll("p")` → **todos** que lo cumplen · `getElementsByTagName("p")` → todos los de esa etiqueta

**R:** **b)** El **manejador (handler)** es la función que se ejecuta como respuesta a un evento.

---

**Extra.14** `[MC]` ¿Cómo se crea un elemento y se añade al árbol?
- a) `document.getElementById("nuevo")`
- b) `const li = document.createElement("li"); li.textContent = "..."; document.getElementById("lista").appendChild(li);`
- c) `document.write("li")`

**R:** **b)**

---

**Extra.15** `[MC]` ¿Cuál es el valor asignado a una propiedad de estilo y qué error común hay?
- a) Un número sin unidad; error: escribirla en minúsculas
- b) **Siempre una cadena e incluye la unidad** (`x.style.fontSize = "25px";`); error: escribir `style.font-size` (el guion es la resta)
- c) Un color

**R:** **b)** Al reasignar `src` de una imagen, el navegador **descarga automáticamente** el nuevo recurso y repinta la imagen.

---

**Extra.16** `[MC]` Completa la frase: «Un `<script>` en el `<head>` que busca un elemento del `<body>` falla porque…»
- a) el navegador no soporta `getElementById`
- b) el elemento todavía no ha sido leído ni construido en el DOM
- c) hay que cerrar el `</body>`

**R:** **b)** Solución: colocar el script antes de `</body>` o usar `defer`.

---

**Extra.17** `[MC]` ¿Cuáles son los **errores frecuentes** (Anexo A) que más se repiten?
- a) Solo errores de CSS
- b) `id` distinto en HTML y JS (→ null) · script en `<head>` buscando el `<body>` · `addEventListener("click", cambiar())` · `onclick="cambiar"` sin paréntesis · `<script src="x.js" />` sin cerrar · `=` en vez de `===` · `style.font-size` · `new Date(2026)` esperando el año · meses sin el offset 0 · comillas mezcladas · `document.write()` tras la carga (desaparece la página)
- c) Ninguno

**R:** **b)** Recomendación de trabajo: mantener abierta la consola (F12) mientras se desarrolla; el mensaje de error indica **archivo y número de línea**.

---

**Extra.18** `[DEF]` Resumen express de los **cuatro mecanismos de salida** y su visibilidad.

**R:**

| Mecanismo | Destino | ¿Visible para el usuario? |
|---|---|---|
| `console.log()` | Panel Consola (F12) | **No** |
| `innerHTML` / `textContent` | Un elemento de la página | **Sí** |
| `document.write()` | Flujo del documento | **Sí** (pero obsoleto: tras la carga **borra todo**) |
| `alert()` | Ventana modal del SO | **Sí** (y es **bloqueante**) |

Si el ejercicio pide que el texto **se vea en la página**, la respuesta es `innerHTML` o `textContent`, **nunca `console.log()`**.

---

# Preguntas trampa: las 20 que más se fallan

Estas son, con el dato exacto que hay que saber:

1. **Meses en JavaScript empiezan en 0** (enero = 0, diciembre = 11); los días en 1. *TRAMPA 1.4.17*
2. **`new Date(2026)` NO es el año 2026**: son 2026 **milisegundos** desde 1970. *1.4.18*
3. **`getDay()` devuelve el día de la semana con 0 = domingo**, no el día del mes. *1.2.23 / 1.4.23*
4. **`document.write()` tras la carga borra todo el documento** de forma irreversible. *1.2.20*
5. **`alert()` es bloqueante**: congela el hilo principal. *1.2.21*
6. **El motor de renderizado de Chrome es Blink; el de JavaScript es V8**. No al revés. *1.2.04*
7. **En iOS/iPadOS todo navegador usa WebKit**, aunque se llame Chrome o Firefox. *1.2.06*
8. **ECMAScript es el estándar; JavaScript es una implementación** (no al revés). *1.3.07*
9. **`document` es una propiedad de `window`**, no un objeto paralelo. *1.2.17*
10. **`style.fontSize`, nunca `style.font-size`**: el guion es la resta. *1.2.25*
11. **`==` convierte tipos; `===` no**. Usa `===`. *Extra.08*
12. **Un `<script>` en el `<head>` sin `defer`/`async` detiene el análisis del HTML**. *1.2.09*
13. **`<script src="x.js" />` no cierra la etiqueta** y rompe la página. *1.5.02*
14. **`defer` espera al HTML y respeta el orden; `async` no espera ni respeta el orden.** *1.5.09*
15. **Solo la declaración de función tiene hoisting**, no la expresión ni la flecha. *1.3.23*
16. **JSX es una extensión de JavaScript que se compila a JS**, no un lenguaje aparte. *1.3.21*
17. **HTML y CSS NO son lenguajes de programación** (no tienen variables, bucles ni condiciones). *1.3.01*
18. **El back-end es privado; el front-end es público con F12.** De ahí que nunca van claves ni contraseñas solo en el cliente. *1.1.02 / 1.1.03*
19. **Usabilidad e inmediatez → cliente. Integridad y seguridad → servidor.** *1.1.13*
20. **Un fallo en tiempo de ejecución detiene el script en esa línea**; en Java el mismo fallo impediría generar el ejecutable. *1.4.04*

---

# Chuleta de datos de memoria

- **Origen de la web:** 1989, CERN, Tim Berners-Lee. **Estándares:** W3C (w3c.es). **Nube:** AWS.
- **Motores:** Chrome/Edge/Brave/Opera = **Blink + V8** · Firefox = **Gecko + SpiderMonkey** · Safari = **WebKit + JavaScriptCore**.
- **Blink nació en 2013** (bifurkación de WebKit).
- **7 módulos** del navegador: UI · browser engine · renderizado · JS · red · UI backend · almacenamiento.
- **4 pasos de renderizado:** DOM+CSSOM → Render Tree → Layout → Paint.
- **Almacenamiento:** cookies ~**4 KB** (van al servidor) · sessionStorage (hasta cerrar pestaña, ~5 MB) · localStorage (permanente, 5-10 MB) · IndexedDB (para sin conexión).
- **Historia JS:** 1995 Eich/Netscape/10 días (Mocha→LiveScript→JS) · 1996 JScript (guerra de navegadores) · 1997 ECMAScript ECMA-262 · 1999 ES3 · 2005 AJAX (Jesse James Garrett, `XMLHttpRequest`) · 2006 jQuery/Prototype/MooTools · 2009 ES5 · 2008-09 V8 + Node.js (Ryan Dahl) · 2015 ES6 · ES2016+ TC39 4 fases anuales.
- **Frameworks:** React (Meta, DOM virtual, JSX) · Angular (Google, TypeScript, curva pronunciada) · Vue (Evan You, DOM virtual, progresiva, Laravel).
- **Script vs tradicional:** compilación/interpretación · standalone/anfitrión · desde cero/reutilizar componentes · errores en compilación/ejecución · C, C++, Java, Swift, Pascal **/** JavaScript, Shell, Perl, PHP, Python, Ruby.
- **Date:** época Unix 1/1/1970 UTC · **1 día = 86.400.000 ms** · meses 0-11 · días 1-31 · desbordamiento automático · años 0-99 = siglo XX · ISO = UTC · `toISOString()` para APIs/BD · `toUTCString()` para HTTP/cookies.
- **Reflow** = cambia dimensiones/posición (`fontSize`, `innerHTML`). **Repaint** = solo visual (`color`, `backgroundColor`).
- **1.6 ranking:** VS Code 75,9 % · Notepad++ 27,4 % · Vim/Neovim 38,3 % · Cursor 17,9 % · JetBrains 15,1 % (WebStorm 7,6 %).
- **DevTools:** F12 o Ctrl+Shift+I · Consola · Fuentes (breakpoints, Call Stack) · Red (200/404/500).
- **Extensiones:** Live Server (servidor local + recarga) · Quokka.js (resultado flotante en vivo) · Error Lens (error a final de línea).
- **DevTools y errores típicos:** `file://` no permite `fetch()` · 404 = ruta · consola ≠ página · breakpoint en línea que no se ejecuta · API keys nunca en el cliente.
- **Ponderación:** cada uno de los 6 apartados = **16,67 % del RA1** = **0,833 % de la nota final**.