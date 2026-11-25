# Tema 1.6 · Cómo está resuelto

## De qué va

El tema no pide código: pide **reconocer herramientas** de programación y prueba
para el cliente web y evaluarlas. Hay que elegir un editor, instalar extensiones
útiles y explicar para qué sirve cada una, con una captura que lo demuestre.

## Qué pide el enunciado

1. Elegir un editor o IDE y decir cuál se usa.
2. Instalar y probar herramientas de apoyo: servidor local, ejecución rápida de
   JavaScript y aviso de errores.
3. Justificar cada una con una captura y una explicación corta.

## Paso a paso

### El editor

Visual Studio Code sobre Windows. Se elige porque es gratuito, ligero y tiene
extensiones para todo lo que se usa en el ciclo (HTML, CSS, JavaScript, PHP,
Markdown y Git integrado).

### 1 · Live Server

Extensión `ritwickdey.liveserver`.

**El problema que resuelve:** al abrir un `index.html` con doble clic, el navegador
lo carga con el protocolo `file://`. Desde ahí muchas cosas no funcionan: las
peticiones `fetch`, los módulos ES y algunas APIs se bloquean por seguridad.

**Lo que hace:** levanta un servidor local y sirve el proyecto por
`http://localhost:5500`. Se arranca con el botón **Go Live** de la barra de estado.
Además recarga la página sola cada vez que se guarda un archivo, así que no hay que
pulsar F5.

**Cómo se comprueba:** se abre el proyecto con Go Live, se cambia una línea, se
guarda y la página se actualiza sin tocar nada.

![Live Server sirviendo el proyecto en localhost](Capturas/1_live_server.png)

### 2 · Quokka.js

Extensión `wallabyjs.quokka-vscode`.

**El problema que resuelve:** para probar dos líneas de JavaScript había que abrir
el navegador, la consola y recargar. Mucho ruido para algo pequeño.

**Lo que hace:** ejecuta el archivo mientras se escribe y muestra el resultado al
lado de cada línea. Sirve para probar lógica sin salir del editor: una operación,
una función, un `map`.

**Cómo se comprueba:** se escribe una función y su llamada, y el valor aparece
flotando a la derecha sin ejecutar nada más.

![Quokka mostrando los valores en línea](Capturas/2_quokka_js.png)

### 3 · Error Lens

Extensión `usernamehw.errorlens`.

**El problema que resuelve:** VS Code marca los errores con un subrayado rojo
diminuto, y para leer el mensaje hay que pasar el ratón por encima. En un archivo
largo, eso hace que se pasen errores por alto.

**Lo que hace:** escribe el mensaje completo al final de la línea, con fondo rojo.
Se activa y desactiva con **Error Lens: Toggle**.

**Cómo se comprueba:** se provoca un error a propósito (una variable sin declarar,
por ejemplo) y el aviso aparece en la misma línea.

![Error Lens señalando un error en la línea](Capturas/3_error_lens.png)

## El código, pieza a pieza

No hay código propio: la entrega es la memoria con las tres capturas.

```
Actividades Tema 1.6/
├── Entrega Tema 1.6.pdf
└── Capturas/
    ├── 1_live_server.png
    ├── 2_quokka_js.png
    └── 3_error_lens.png
```

## Trampas y dudas

- **Live Server no es un servidor de producción.** Es para desarrollo: no tiene
  HTTPS, ni caché, ni configuración de dominios.
- **Quokka ejecuta el archivo tal cual.** Si el código usa `document`, falla: no
  hay navegador detrás. Para DOM se usa el navegador o Live Server.
- **Error Lens no corrige nada.** Solo muestra el mensaje que ya detectaba VS Code.
- **Las extensiones consumen recursos.** Tener veinte activas hace el editor más
  lento; conviene desactivar las que no se usan.

## Si me preguntan

- **¿Qué diferencia hay entre editor e IDE?** El IDE trae compilador, depurador y
  herramientas integradas; el editor, con extensiones, se le acerca.
- **¿Por qué no abrir el HTML con doble clic?** Porque `file://` bloquea peticiones
  y módulos; con `http://localhost` se comporta como un servidor real.
- **¿Qué otro herramienta se usa en el ciclo?** El depurador del navegador (F12),
  la pestaña Red y el validador del W3C.
