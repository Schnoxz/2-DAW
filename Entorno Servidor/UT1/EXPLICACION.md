# UT1 · Cómo está resuelto

## De qué va

La UT1 es de teoría: cómo se organiza una aplicación web, qué hace el servidor y
qué el cliente, y cómo se genera una página dinámica. No hay ejercicios prácticos
publicados en Moodle (la tarea aparece sin enunciado ni adjuntos), así que lo que
hay que dominar es el PDF de la unidad.

## Qué pide el enunciado

La tarea de Moodle no tiene descripción. Los criterios del ciclo, que sí están en
el PDF, marcan lo que entra:

1. Diferenciar los modelos de ejecución en cliente y en servidor.
2. Ventajas de generar páginas dinámicas frente a incluir guiones en la página.
3. Mecanismos de ejecución de código en el servidor.
4. Qué aporta un servidor de aplicaciones frente a un servidor web.
5. Lenguajes y tecnologías del lado servidor.
6. Integración de los lenguajes de marcas con los de programación.
7. Herramientas de programación en entorno servidor.

## Paso a paso

### 1 · Cliente y servidor

- El **cliente** pide (navegador) y pinta: HTML, CSS y JavaScript.
- El **servidor** recibe la petición, ejecuta código y devuelve una respuesta.

La diferencia práctica es la visibilidad: el código del cliente se descarga y se
puede leer con F12; el del servidor nunca llega al navegador. Por eso las
contraseñas, los permisos y los cobros viven en el servidor.

### 2 · Página estática frente a dinámica

| | Estática | Dinámica |
|---|---|---|
| Qué envía el servidor | el archivo tal cual | el HTML generado al ejecutar código |
| Cambia el contenido | solo si se edita el archivo | según datos, usuario o base de datos |
| Coste | bajo | más CPU y memoria por petición |

La página dinámica permite personalizar (un panel con los datos del usuario) y
actualizar sin tocar archivos.

### 3 · Cómo ejecuta código el servidor

Hay tres mecanismos clásicos:

- **Módulo del servidor** (por ejemplo `mod_php` en Apache): el intérprete va
  dentro del propio servidor web. Es lo más rápido y lo más habitual.
- **CGI**: el servidor lanza un proceso por cada petición. Sencillo y aislado, pero
  lento con mucha carga.
- **Servidor de aplicaciones** (Tomcat, Node, Gunicorn): el código corre en un
  proceso aparte y el servidor web le pasa las peticiones. Se usa con Java, Python
  o Node.

### 4 · Servidor web y servidor de aplicaciones

El servidor web (Apache, Nginx) sirve archivos y atiende HTTP. El de aplicaciones
ejecuta la lógica del negocio y mantiene el estado (sesiones, conexiones a base de
datos). En instalaciones grandes van separados: Nginx delante, la aplicación
detrás.

### 5 · Lenguajes del lado servidor

PHP, Python, Java, C# (ASP.NET), Node.js. Todos comparten lo mismo: reciben datos
del cliente, ejecutan lógica y generan una respuesta HTML o JSON.

### 6 · Integración con los lenguajes de marcas

El código del servidor se mezcla con el HTML de dos formas:

- **Incrustado:** el HTML lleva trozos de código (`<?php ... ?>`) y el servidor los
  sustituye antes de enviar la página.
- **Plantillas:** el motor de plantillas rellena huecos; el código queda aparte y
  más limpio.

### 7 · Herramientas

XAMPP para montar Apache + PHP + MySQL en local, VS Code como editor, el navegador
con sus herramientas de desarrollo y Git para versionar.

## El código, pieza a pieza

```
UT1/
├── UT1_Arquitecturas de desarrollo web.pdf   teoría de la unidad (25 págs.)
└── Tarea - Entrega de actividades (UT1).md   nota de la tarea en Moodle
```

## Trampas y dudas

- **«Dinámica» no es «interactiva».** Una página dinámica se genera en el servidor
  en cada petición; la interactividad es cosa del JavaScript.
- **CGI no está muerto**, pero con mucho tráfico se queda corto.
- **El servidor de aplicaciones no sustituye al web**: lo complementa.

## Si me preguntan

- **¿Por qué no poner toda la lógica en el cliente?** Porque el código es público y
  manipulable; y porque los datos y las reglas de negocio no deben salir del
  servidor.
- **¿Qué es una arquitectura de tres capas?** Cliente (presentación), servidor de
  aplicaciones (lógica) y base de datos (datos).
- **¿Qué es un servidor de aplicaciones?** El que ejecuta el código de la
  aplicación y mantiene su estado, separado del que sirve los archivos.
