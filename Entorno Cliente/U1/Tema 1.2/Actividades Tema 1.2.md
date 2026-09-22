# Actividades Prácticas y de Consolidación — Tema 1.2

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Fuente: Sección **J. Actividades Prácticas y de Consolidación** del temario «Capacidades y mecanismos de ejecución de código de los navegadores Web» (Criterio 1.2).

## Índice de ejercicios

1. [Ejercicio 1 — Segundo botón que modifica el `<h1>`](#ejercicio-1--segundo-botón-que-modifica-el-h1)
2. [Ejercicio 2 — Evento clic con `console.log()`](#ejercicio-2--evento-clic-con-consolelog)
3. [Ejercicio 3 — Modal con `alert()`](#ejercicio-3--modal-con-alert)
4. [Ejercicio 4 — Saludo multidioma con color](#ejercicio-4--saludo-multidioma-con-color)
5. [Ejercicio 5 — Salida multidioma solo por consola](#ejercicio-5--salida-multidioma-solo-por-consola)
6. [Ejercicio 6 — Salida directa con `document.write()`](#ejercicio-6--salida-directa-con-documentwrite)
7. [Ejercicio 7 — Interfaz con tres botones (Consola / Estilo / Alerta)](#ejercicio-7--interfaz-con-tres-botones-consola--estilo--alerta)
8. [Ejercicio 8 — Test interactivo de Verdadero/Falso](#ejercicio-8--test-interactivo-de-verdadero-falso)
9. [Ejercicio 9 — Secuencia cíclica de imágenes](#ejercicio-9--secuencia-cíclica-de-imágenes)

---

## Ejercicio 1 — Segundo botón que modifica el `<h1>`

Añadir un **segundo botón** al ejemplo de los apuntes. Al pulsarlo, no solo debe alterar el párrafo, sino que debe cambiar también el **texto del encabezado `<h1>`** mediante `document.getElementById()` e `innerHTML`.

**Código base de los apuntes:**

```html
<!DOCTYPE html>
<html>
<body>

  <h1>Modificando el código HTML</h1>

  <p id="prueba">Modificando el contenido.</p>

  <!--
  Al hacer clic, document.getElementById localiza el nodo y cambia su texto interno
  -->

  <button type="button" onclick="document.getElementById('prueba').innerHTML = 'CAMBIANDO el contenido!'">
    ¡Dale!
  </button>

</body>
</html>
```

---

## Ejercicio 2 — Evento clic con `console.log()`

Implementar una página que **capture el evento `clic` de un botón** para emitir una **traza informativa** a las herramientas de desarrollo mediante `console.log()`.

---

## Ejercicio 3 — Modal con `alert()`

Modificar el ejercicio anterior sustituyendo la escritura en el párrafo por **ventanas de aviso emergentes modales**, utilizando el método `window.alert()` / `alert()`.

---

## Ejercicio 4 — Saludo multidioma con color

Construir una web con **tres botones** («Ruso», «Español», «Inglés») que alteren un párrafo (`<p>`) mostrando un **saludo en el idioma elegido**, y aplicando a dicho párrafo un **color de fuente CSS diferente** para cada idioma mediante `.style.color`.

---

## Ejercicio 5 — Salida multidioma solo por consola

Adaptar el mismo ejercicio para que las salidas en los **tres idiomas** se impriman **únicamente a través de la consola del desarrollador**.

---

## Ejercicio 6 — Salida directa con `document.write()`

Transformar el código para generar los textos **directamente en el flujo de la página** mediante el método `document.write()`.

---

## Ejercicio 7 — Interfaz con tres botones (Consola / Estilo / Alerta)

Diseñar una interfaz compuesta por:

- Un titular `<h1>`.
- Un párrafo `<p id="estado">Sistema en espera</p>`.
- Tres botones:

1. **Botón 1 (Consola):** emite una traza mediante `console.log()` indicando la **hora del sistema**.
2. **Botón 2 (Estilo):** modifica el **color de fondo** del párrafo a **verde** y su texto a **"Sistema Activo"**, mediante `innerHTML` y `.style.backgroundColor`.
3. **Botón 3 (Alerta):** lanza un **cuadro modal** mediante `window.alert()` avisando de que **el proceso ha concluido**.

---

## Ejercicio 8 — Test interactivo de Verdadero/Falso

Desarrollar un **test interactivo de siete preguntas** con botones «Verdadero» y «Falso».

Cuando el usuario hace clic, el script **evalúa el acierto** y modifica la propiedad de estilo:

- `.style.color = "green"` → **acierto**.
- `.style.color = "red"` → **error**.

---

## Ejercicio 9 — Secuencia cíclica de imágenes

Crear una **secuencia cíclica de al menos 4 imágenes, fotograma a fotograma**.

Al hacer clic sobre la imagen, el script comprueba **cuál se está visualizando** (mediante una condición o extrayendo un contador de un `array`) y reasigna el atributo **`.src`** para mostrar la siguiente imagen.