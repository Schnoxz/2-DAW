# 01 · Qué es HTML y qué hace el navegador

> El apunte que te quita la duda de fondo: **HTML no es un programa**. Nadie lo "ejecuta".

---

## La idea central

HTML son iniciales de **H**yper**T**ext **M**arkup **L**anguage: *lenguaje de marcado*.

Suena imponente, pero la clave está en la última palabra: **marcado**. No describes pasos ni lógica.
Simplemente **marcas** pieces de contenido diciendo qué son.

```html
<h1>Mi nombre es Javier</h1>
<p>Tengo 20 años.</p>
```

Eso es todo. No hay variables, no hay bucles, no hay "si". Hay contenido y hay etiquetas que dicen
**"esto de aquí es un título"** y **"esto de aquí es un párrafo"**.

---

## ¿Qué hace el navegador con eso?

Este es el flujo mental que te va a resolver dudas el resto del curso:

```
1. El navegador pide el archivo  →  hola.html
2. Lee el archivo de arriba abajo
3. Construye un ÁRBOL de elementos en memoria  →  el DOM
4. Lo pinta en pantalla aplicando el CSS
5. Si encuentra un <link> a un CSS, vuelve a por él y lo aplica
```

Ese paso 3 es el que importa: el navegador **convierte tu texto en una estructura jerárquica**
(una etiqueta dentro de otra, como una caja dentro de otra caja). Esa estructura se llama **DOM**
(*Document Object Model*).

> **Por qué se llama DOM y por qué el CSS lo necesita:**
> el CSS no busca "el segundo párrafo de la página", busca "**todos los `p` que cuelgan de un `article`**".
> Eso solo es posible porque existe un árbol donde preguntar "¿de quién eres hijo?".
> Por eso en CSS escribirás cosas como `nav ul li a` — eso es un camino en el árbol.

### Comprobación rápida
Abre cualquier página → `F12` → pestaña **Elements**. Lo que ves es **exactamente** el árbol de tu HTML.
Toca una etiqueta y verás resaltado todo su contenido: eso es el árbol funcionando.

---

## HTML no es un lenguaje de programación

| | HTML | Programación (JS, Python…) |
|---|---|---|
| ¿Qué hace? | Marca contenido | Ejecuta instrucciones |
| ¿Tiene variables? | No | Sí |
| ¿Tiene condiciones (`if`)? | No | Sí |
| ¿Puede "fallar"? | Casi nunca | Sí |
| ¿Quién lo ejecuta? | El navegador lo **interpreta** al pintarlo | El intérprete o compilador |

HTML es **declarativo**: tú declaras *qué es cada cosa* y el navegador decide *cómo mostrarlo*.
Por eso la misma página se ve distinta en Chrome, Firefox y Safari: cada uno "interpreta" a su manera.

> **Consecuencia práctica:** si tu HTML está bien, se verá bien en todas partes. Si se ve bien solo en
> tu navegador, tienes un error de HTML, no de "navegador".

---

## HTML vs CSS: quién hace qué

Piensa en una página como un documento de un examen:

- **HTML** = el texto del examen. El contenido, la estructura, qué es un título y qué es un apartado.
- **CSS** = la maquetación. Que el título vaya en negrita azul, que los apartados vayan en dos columnas,
  que el texto tenga un margen cómodo de lectura.
- **JavaScript** = la conducta. Que al hacer clic en "Enviar" aparezca un mensaje.

Cada uno tiene su trabajo. **Cuando un HTML hace COSAS de CSS (o al revés), es que algo está mal.**

### El ejemplo mal hecho

```html
<h1 style="color: red; font-size: 40px">Informe</h1>
<p style="font-family: Arial">Resultado...</p>
```

Funciona, sí. Pero:
- si quieres cambiar el color de los 20 títulos, tienes que editar 20 sitios;
- el estilo vive **dentro del contenido**, así que no se puede reutilizar ni mantener.

### El ejemplo bien hecho

```html
<h1>Informe</h1>
<p>Resultado...</p>
```

```css
h1 { color: red; font-size: 40px; }
p  { font-family: Arial; }
```

Mismo resultado. Un solo sitio donde cambiar el color de todos los títulos.
**Esto se llama _separar responsabilidades_ y es el 90 % de ser buen webmaster.**

---

## La extensión: HTML, CSS y HTML5

- **HTML** → el lenguaje de marcado en general.
- **HTML5** → la "versión 5" (y desde 2014 no se pone versión, HTML es HTML5). Antes era HTML 4.01 y
  antes HTML 2, 3.2... Por eso oirás "HTML4" en tutoriales viejos: **trátalos como antiguos**.
- **XHTML** → un intento fallido de reescribir HTML con reglas de XML. Murió. Ignóralo.

### ¿Y `.html` o `.htm`?

Son **lo mismo**. `.html` es el estándar, `.htm` se usaba en Windows 3.1 (95/98) por el límite de
nombre de archivo. Los servidores hoy aceptan ambos. Usa `.html`.

---

## Minirrégimen para fijar la idea

1. Crea `prueba1.html` con un `h1` y un `p`.
2. Ábrelo con doble clic (funciona sin servidor: el navegador lo lee directo del disco).
3. En el inspector, cambia el `h1` por un `h6` a ver qué pasa.
4. Escribe un párrafo **sin etiquetas**, solo texto suelto. ¿Qué lo diferencia de un `<p>`?

Esa pregunta del punto 4 es la clave de todo el apunte siguiente.

---

*Siguiente apunte → [02 · La estructura mínima de un documento HTML](02%20-%20La%20estructura%20m%C3%ADnima%20de%20un%20documento%20HTML.md)*
*← Anterior · [Índice](00%20-%20%C3%8Dndice%20y%20ruta%20de%20aprendizaje.md)*
