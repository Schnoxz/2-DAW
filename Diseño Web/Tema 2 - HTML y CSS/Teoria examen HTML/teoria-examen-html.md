<div class="cover">
  <div class="banda"></div>
  <p class="etiqueta">Diseño de Interfaces Web · 2.º DAW</p>
  <h1>HTML: teoría y<br>ejercicios resueltos</h1>
  <p class="subtitulo">Cuadernillo para el examen escrito</p>
  <div class="linea"></div>
  <p class="descripcion">Todo el Tema 2 explicado para poder escribirlo a mano: formación de etiquetas, bloques, documento completo, texto, enlaces, imágenes, tablas, formularios y contenido incrustado. Con ejercicios resueltos paso a paso, simulacro de examen, rellenar huecos y busca el error.</p>
  <p class="meta">Basado en los apuntes y ejercicios del curso (Tema 2 · HTML y CSS) y en los enlaces de eniun.com recogidos en Moodle.<br>2.º DAW · I.E.S. Kursaal</p>
</div>

<div class="toc">
<h2>Índice</h2>

<p><span class="num">1</span><a href="#sec1">Cómo se escribe una etiqueta</a></p>
<p class="sub">Anatomía · atributos · etiquetas vacías · anidamiento · entidades</p>

<p><span class="num">2</span><a href="#sec2">Bloques y elementos en línea</a></p>
<p class="sub">div y span · reglas de anidamiento · display</p>

<p><span class="num">3</span><a href="#sec3">El documento HTML completo</a></p>
<p class="sub">DOCTYPE · head · body · charset · viewport · title</p>

<p><span class="num">4</span><a href="#sec4">Texto, listas y contenido</a></p>
<p class="sub">h1-h6 · p · br · hr · pre · ul · ol · dl · figure · citas</p>

<p><span class="num">5</span><a href="#sec5">Enlaces e imágenes</a></p>
<p class="sub">a · target · rutas · anclas · img · alt · imágenes en fila</p>

<p><span class="num">6</span><a href="#sec6">Elementos semánticos</a></p>
<p class="sub">header · nav · main · article · section · aside · footer</p>

<p><span class="num">7</span><a href="#sec7">Tablas</a></p>
<p class="sub">caption · thead · tbody · th · td · colspan · rowspan · alineación</p>

<p><span class="num">8</span><a href="#sec8">Formularios</a></p>
<p class="sub">form · label · input · select · textarea · fieldset · pattern</p>

<p><span class="num">9</span><a href="#sec9">Contenido incrustado</a></p>
<p class="sub">img · iframe · video · audio · source · svg</p>

<p><span class="num">10</span><a href="#sec10">El CSS que acompaña al HTML</a></p>
<p class="sub">dónde va · selectores · caja · display · centrar · tablas</p>

<p><span class="num">11</span><a href="#sec11">Simulacro de examen resuelto</a></p>
<p class="sub">Dos ejercicios de desarrollo completos, como en el examen</p>

<p><span class="num">12</span><a href="#sec12">Rellenar huecos</a></p>
<p class="sub">40 frases para practicar en papel, con soluciones</p>

<p><span class="num">13</span><a href="#sec13">Busca el error</a></p>
<p class="sub">14 fragmentos con su corrección explicada</p>

<p><span class="num">14</span><a href="#sec14">Chuleta final</a></p>
<p class="sub">Todo lo imprescindible en una página</p>

<p><span class="num">15</span><a href="#sec15">Recursos y temario</a></p>
<p class="sub">Enlaces de eniun y archivos del curso</p>

<div class="nota intro">

**Cómo está organizado.** Los temas 1 a 10 son la teoría del Tema 2 en el mismo orden en que se pregunta en el examen. Los temas 11, 12 y 13 son práctica: un simulacro resuelto, 40 frases para rellenar y 14 fragmentos con errores. El 14 es la chuleta del último repaso y el 15 recoge los enlaces del temario.

**En el examen.** Empieza siempre por `<!DOCTYPE html>` y el esqueleto `html > head > body`: son puntos regalados. Etiquetas en minúsculas, todo lo que se abre se cierra y ninguna imagen sin `alt`. Antes de entregar, repasa con la lista del tema 3.

</div>

</div>

# 1. Cómo se escribe una etiqueta {#sec1}

<div class="regla">

**Las 10 reglas de oro para el examen en papel**

1. La primera línea es siempre `<!DOCTYPE html>`.
2. Todo lo que se abre se cierra, y en orden inverso: lo último que abres es lo primero que cierras.
3. Los atributos van **en la etiqueta de apertura**, con el valor entre comillas: `href="pagina.html"`.
4. Las etiquetas vacías no se cierran: `br`, `hr`, `img`, `input`, `meta`, `link`, `source`, `wbr`.
5. Todo el texto visible va dentro de `<body>`; lo que no se ve, en `<head>`.
6. Un solo `<h1>`, un solo `<main>` y un solo `<body>` por documento.
7. Las imágenes llevan siempre `alt`; si son decorativas, `alt=""`.
8. Una tabla lleva `table` → `caption` → `thead`/`tbody` → `tr` → `th`/`td`.
9. Un formulario lleva `form` → `fieldset`/`legend` → `label` + `input`, y el `for` del label coincide con el `id`.
10. Si dudas, escribe la etiqueta **completa y bien cerrada**: mejor sobrar cierre que dejarlo abierto.

</div>

## 1.1. Anatomía de una etiqueta

```html
<a href="contacto.html" target="_blank">Escríbeme</a>
```

| Parte | En el ejemplo | Qué es |
|---|---|---|
| Etiqueta de apertura | `<a ...>` | Empieza el elemento. Lleva el nombre y los atributos. |
| Nombre | `a` | Tipo de elemento. Siempre en minúsculas. |
| Atributo | `href` | Característica que se configura. Va solo en la apertura. |
| Valor | `"contacto.html"` | Lo que vale el atributo. Entre comillas dobles. |
| Contenido | `Escríbeme` | Lo que se ve o lo que hay dentro. |
| Etiqueta de cierre | `</a>` | Termina el elemento. Lleva barra `/`. |

La fórmula general es:

```html
<etiqueta atributo1="valor1" atributo2="valor2">contenido</etiqueta>
```

**Un atributo booleano** no necesita valor: basta con que aparezca. `required`, `checked`, `selected`, `disabled`, `readonly`, `multiple`, `controls`, `autoplay`, `muted`, `loop`, `reversed` y `download` funcionan así.

```html
<input type="email" id="correo" name="correo" required>
<option value="daw" selected>DAW</option>
```

<div class="trampa">

**Trampa de examen:** `required="required"` y `required` significan lo mismo, pero se escribe corto. Y `checked` no es lo mismo que `selected`: `checked` es para `checkbox` y `radio`; `selected` es para `<option>`.

</div>

## 1.2. Etiquetas vacías (sin cierre)

Son elementos que no tienen contenido dentro, así que no llevan `</...>`.

| Etiqueta | Para qué |
|---|---|
| `<br>` | Salto de línea |
| `<hr>` | Línea horizontal / cambio de tema |
| `<img>` | Imagen |
| `<input>` | Campo de formulario |
| `<meta>` | Metadatos del documento |
| `<link>` | Enlazar CSS u otros recursos |
| `<source>` | Archivo alternativo de vídeo o audio |
| `<wbr>` | Punto donde se puede cortar una palabra larga |
| `<col>` | Columna de una tabla (dentro de `colgroup`) |
| `<track>` | Subtítulos de un vídeo |
| `<embed>` | Contenido externo incrustado |

Se pueden escribir `<br>` o `<br />`. Las dos formas valen en HTML5; en el examen usa `<br>` para no confundirte.

## 1.3. Anidamiento: lo último que abres es lo primero que cierras

```html
<!-- BIEN: strong está dentro de p y se cierra antes que p -->
<p>Esto es <strong>muy importante</strong> y sigue el párrafo.</p>

<!-- MAL: se cruzan las etiquetas -->
<p>Esto es <strong>muy importante</p></strong>
```

El navegador intenta arreglar el desorden, pero el documento deja de ser válido y el resultado puede cambiar. En papel, cuenta las aperturas y los cierres como si fueran paréntesis.

```text
<p> ... <strong> ... </strong> ... </p>
(     (          )          )        correcto
<p> ... <strong> ... </p> ... </strong>
(     (          )    )              mal: se cruzan
```

## 1.4. Comentarios

```html
<!-- Esto no se ve en la página; sirve para explicar el código -->
<p>Texto visible</p>
```

Un comentario empieza por `<!--` y termina en `-->`. No se pueden anidar comentarios dentro de otro comentario.

## 1.5. Entidades: escribir caracteres especiales

Hay caracteres que HTML interpreta como código (`<`, `>`, `&`) y otros que no están en el teclado. Se escriben con una entidad: empieza por `&` y termina en `;`.

| Quieres ver | Entidad | Código decimal |
|---|---|---|
| `<` | `&lt;` | `&#60;` |
| `>` | `&gt;` | `&#62;` |
| `&` | `&amp;` | `&#38;` |
| `"` | `&quot;` | `&#34;` |
| `©` | `&copy;` | `&#169;` |
| `€` | `&euro;` | `&#8364;` |
| `÷` | `&divide;` | `&#247;` |
| `←` | `&larr;` | `&#8592;` |
| espacio que no se colapsa | `&nbsp;` | `&#160;` |

<div class="nota">

**Por qué existe esto:** si escribes `<p>5 < 7</p>`, el navegador cree que empieza una etiqueta. Lo correcto es `<p>5 &lt; 7</p>`. Lo mismo pasa con `&`: para escribir "A & B" hay que poner `A &amp; B`.

</div>

## 1.6. Ejercicios resueltos de formación de etiquetas

<div class="ejercicio">

### Ejercicio 1 · Construir la etiqueta a partir de los datos

Escribe la etiqueta completa para cada caso:

1. Un enlace a `https://www.eniun.com` que se abra en una pestaña nueva y se vea "Ir a Eniun".
2. Una imagen `img/logo.png` con texto alternativo "Logo del instituto" y 200 px de ancho.
3. Un párrafo con la palabra "importante" en negrita semántica.
4. Un campo de correo obligatorio, con `id` y `name` iguales a `correo`.
5. Una tabla con una sola fila y dos celdas de datos.

**Solución**

```html
<a href="https://www.eniun.com" target="_blank" rel="noopener noreferrer">Ir a Eniun</a>

<img src="img/logo.png" alt="Logo del instituto" width="200">

<p>Esto es <strong>importante</strong>.</p>

<input type="email" id="correo" name="correo" required>

<table>
  <tr>
    <td>Dato 1</td>
    <td>Dato 2</td>
  </tr>
</table>
```

</div>

<div class="ejercicio">

### Ejercicio 2 · Corregir el anidamiento

Corrige estos cuatro fragmentos:

```html
1. <p><strong>Hola</p></strong>
2. <ul><li>Uno<li>Dos</ul>
3. <img src="a.jpg"></img>
4. <table><td>Dato</td></table>
```

**Solución**

```html
1. <p><strong>Hola</strong></p>
2. <ul><li>Uno</li><li>Dos</li></ul>
3. <img src="a.jpg" alt="Descripción de la imagen">
4. <table><tr><td>Dato</td></tr></table>
```

En el 3 hay dos fallos: `img` es vacía y no lleva cierre, y le falta el `alt`. En el 4 falta la fila `tr`: una celda no puede ir suelta dentro de `table`.

</div>

<div class="ejercicio">

### Ejercicio 3 · Marcar un texto con etiquetas en línea

Escribe el código de este párrafo:

> El HTML es un lenguaje de marcado. La etiqueta `<strong>` indica importancia y `<em>` indica énfasis. El agua es H₂O y la energía se mide en kWh. La fecha es el 8 de noviembre de 2026.

**Solución**

```html
<p>
  El <strong>HTML</strong> es un lenguaje de marcado. La etiqueta
  <code>&lt;strong&gt;</code> indica importancia y <code>&lt;em&gt;</code>
  indica énfasis. El agua es H<sub>2</sub>O y la energía se mide en
  kWh. La fecha es el <time datetime="2026-11-08">8 de noviembre de 2026</time>.
</p>
```

Fíjate en que, para mostrar las etiquetas como texto, hay que escribir `&lt;` y `&gt;`. Si escribes `<strong>` dentro del párrafo, el navegador lo interpreta como etiqueta y no se ve.

</div>

## 1.7. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<p>Hola<p>Mundo` | Un `p` no puede contener otro `p` | `<p>Hola</p><p>Mundo</p>` |
| `<img src="a.png">` | Falta el texto alternativo | `<img src="a.png" alt="...">` |
| `<a href=www.web.com>` | Sin comillas y sin protocolo | `<a href="https://www.web.com">` |
| `<br></br>` | `br` es vacía | `<br>` |
| `<INPUT TYPE="text">` | Funciona, pero no es el estilo del curso | `<input type="text">` |
| `<p>5 < 7</p>` | El `<` abre una etiqueta falsa | `<p>5 &lt; 7</p>` |
| `<div><p>Hola</div></p>` | Se cruzan las etiquetas | `<div><p>Hola</p></div>` |

## 1.8. Repaso rápido de la sección

Si en el examen te piden «explica qué es una etiqueta» o «escribe esta etiqueta», estas ocho respuestas cubren lo que se pregunta:

| Pregunta | Respuesta corta |
|---|---|
| ¿Cómo se delimita una etiqueta? | Con `<` y `>`: `<p>` abre y `</p>` cierra |
| ¿Dónde van los atributos? | En la etiqueta de apertura, con el valor entre comillas |
| ¿Qué etiquetas no se cierran? | Las vacías: `br`, `hr`, `img`, `input`, `meta`, `link`, `source` |
| ¿En qué orden se cierran las anidadas? | En orden inverso: la última que abres es la primera que cierras |
| ¿Cómo se escribe un `<` que se vea? | Con la entidad `&lt;` |
| ¿Se pueden anidar comentarios? | No; el primero que se cierra corta el comentario |
| ¿Mayúsculas o minúsculas? | Minúsculas; `INPUT` funciona pero no es el estilo del curso |
| ¿Qué le falta a `<img src="a.png">`? | El atributo `alt` con el texto alternativo |

<div class="trampa">

**Los dos fallos que más puntos cuestan:** cruzar etiquetas (`<p><strong>Hola</p></strong>`) y dejar una imagen sin `alt`. El primero no valida y el segundo es un problema de accesibilidad que se pregunta aparte.

</div>

# 2. Bloques y elementos en línea {#sec2}

## 2.1. La diferencia que hay que saber explicar

| | Elemento de bloque | Elemento en línea |
|---|---|---|
| Empieza en | Una línea nueva | Donde esté el texto |
| Ocupa | Todo el ancho disponible | Solo lo que mide su contenido |
| `width` y `height` | Se respetan | Se ignoran |
| Márgenes verticales | Suman y separan bloques | No separan líneas |
| Se puede poner dentro de | Casi cualquier sitio | Solo dentro de bloques o de texto |
| Ejemplos | `div`, `p`, `h1`, `ul`, `li`, `table`, `form`, `section`, `header`, `footer` | `span`, `a`, `strong`, `em`, `b`, `i`, `img`, `input`, `label`, `code`, `br` |

```html
<!-- Dos bloques: cada uno ocupa su línea -->
<p>Primer párrafo</p>
<p>Segundo párrafo</p>

<!-- Dos elementos en línea: van seguidos, en la misma línea -->
<p>Texto <strong>en negrita</strong> y <em>en cursiva</em> seguido.</p>
```

<div class="nota">

**Cómo se ve en la página:** un `div` o un `p` se coloca debajo del anterior aunque en el código esté en la misma línea. Un `span` o un `strong` se coloca al lado, dentro del mismo renglón. Esa es la prueba para saber si un elemento es de bloque o en línea.

</div>

## 2.2. `div` y `span`: los contenedores sin significado

- `<div>` es un contenedor **de bloque**. Agrupa cosas para darles estilo o para maquetar.
- `<span>` es un contenedor **en línea**. Agrupa un trozo de texto dentro de un párrafo.

```html
<div class="tarjeta">
  <h2>HTML</h2>
  <p>Lenguaje de marcado que organiza el contenido.</p>
  <span class="etiqueta">Estructura</span>
</div>
```

Ni `div` ni `span` dicen qué hay dentro: solo agrupan. Por eso, cuando existe una etiqueta semántica (`header`, `nav`, `main`, `article`, `section`, `aside`, `footer`), se usa esa y no un `div`.

<div class="trampa">

**No metas un `div` dentro de un `p`.** Un `p` solo admite contenido en línea; si metes un bloque, el navegador cierra el párrafo antes de tiempo y el documento se descuadra.

```html
<!-- MAL -->
<p>Texto <div>bloque</div> más texto</p>

<!-- BIEN -->
<p>Texto</p>
<div>bloque</div>
<p>Más texto</p>
```

</div>

## 2.3. Reglas de anidamiento

1. Un elemento en línea puede ir dentro de un bloque: `<p><strong>Hola</strong></p>`.
2. Un bloque puede ir dentro de otro bloque: `<div><p>Hola</p></div>`.
3. Un bloque **no** va dentro de un elemento en línea: `<span><div>...</div></span>` es incorrecto.
4. Un `p` no contiene otro `p` ni un `div`.
5. Un `a` no contiene otro `a`.
6. Un `li` solo va dentro de `ul` u `ol`.
7. Un `td` o un `th` solo va dentro de `tr`.
8. Un `tr` va dentro de `table`, `thead`, `tbody` o `tfoot`.

```text
body
├── header          bloque
│   └── nav         bloque
│       └── ul      bloque
│           └── li  bloque
│               └── a        en línea
├── main            bloque
│   └── p           bloque
│       ├── strong  en línea
│       └── em      en línea
└── footer          bloque
```

## 2.4. Cambiar el comportamiento con CSS

La etiqueta trae un comportamiento por defecto, pero CSS lo puede cambiar con `display`:

```css
span { display: block; }          /* ahora el span ocupa una línea entera */
div  { display: inline; }         /* ahora el div fluye con el texto */
img  { display: block; margin: 0 auto; }  /* imagen centrada como bloque */
.tarjeta { display: inline-block; }       /* bloque que se pone en fila */
```

`inline-block` es un híbrido: por fuera se comporta como en línea (se pone al lado de otros) y por dentro como bloque (acepta `width`, `height`, márgenes verticales). Es la clave para poner imágenes o tarjetas en fila sin Flexbox.

## 2.5. Ejercicio resuelto: el mismo contenido de dos formas

<div class="ejercicio">

### Ejercicio 4 · Bloque o en línea

Quieres mostrar tres datos seguidos: "HTML", "CSS" y "JavaScript". Escribe dos versiones, una con `div` y otra con `span`, y explica qué cambia.

**Solución**

```html
<!-- Versión 1: cada div ocupa una línea -->
<div>HTML</div>
<div>CSS</div>
<div>JavaScript</div>

<!-- Versión 2: los span van seguidos en la misma línea -->
<span>HTML</span> <span>CSS</span> <span>JavaScript</span>
```

La versión 1 se ve en tres líneas porque `div` es de bloque. La versión 2 se ve en una sola línea porque `span` es en línea. El contenido es el mismo; cambia el comportamiento por defecto de la etiqueta.

</div>

## 2.6. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<span><div>Hola</div></span>` | Bloque dentro de en línea | `<div><span>Hola</span></div>` |
| `<p><div>Hola</div></p>` | El navegador rompe el párrafo | `<div><p>Hola</p></div>` |
| `<a href="#"><a href="#">Dos</a></a>` | Enlaces anidados | Un solo enlace |
| `<ul><div>Elemento</div></ul>` | Dentro de `ul` solo va `li` | `<ul><li>Elemento</li></ul>` |
| `<table><td>Dato</td></table>` | Falta la fila | `<table><tr><td>Dato</td></tr></table>` |
| Poner `width` a un `span` sin `display` | No hace nada | `display: inline-block` o `block` |

# 3. El documento HTML completo {#sec3}

## 3.1. El esqueleto universal

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Descripción de la página">
  <title>Título de la pestaña</title>
  <link rel="stylesheet" href="css/estilos.css">
  <style>
    body { font-family: Arial, sans-serif; }
  </style>
</head>
<body>
  <h1>Título visible de la página</h1>
  <p>Contenido visible.</p>
</body>
</html>
```

## 3.2. Qué es cada línea

| Línea | Para qué sirve |
|---|---|
| `<!DOCTYPE html>` | Declara que el documento es HTML5. No es una etiqueta y no se cierra. Va siempre la primera. |
| `<html lang="es">` | Elemento raíz. `lang` indica el idioma del contenido. |
| `<head>` | Información sobre la página que **no se ve**: metadatos, título, CSS, scripts. |
| `<meta charset="UTF-8">` | Codificación de caracteres. Sin esto se rompen las tildes y las eñes. |
| `<meta name="viewport" ...>` | Hace que la página se adapte al ancho del móvil. |
| `<meta name="description" ...>` | Resumen que usan los buscadores. |
| `<title>` | Título de la pestaña y de los resultados de búsqueda. Obligatorio. |
| `<link rel="stylesheet" href="...">` | Enlaza una hoja de estilos externa. |
| `<style>` | CSS interno, dentro de `head`. |
| `<script src="...">` | Enlaza JavaScript. |
| `<body>` | Todo lo que se ve en la página. |

<div class="trampa">

**`<head>` no es lo mismo que `<header>`.** `head` es la cabecera técnica del documento (no se ve). `header` es la cabecera visible de la página o de una sección (logo, título, menú). Es un error clásico de examen.

</div>

## 3.3. `head` frente a `body`

| Va en `<head>` | Va en `<body>` |
|---|---|
| `meta`, `title`, `link`, `style`, `script`, `base` | `header`, `nav`, `main`, `section`, `article`, `aside`, `footer` |
| Información *sobre* la página | Contenido *de* la página |
| No se ve | Se ve |

## 3.4. Ejercicio resuelto: de hoja en blanco a documento válido

<div class="ejercicio">

### Ejercicio 5 · Escribir el documento desde cero

Escribe el código completo de una página titulada "Mi primera página", en español, con un encabezado y un párrafo. Debe estar preparada para el móvil y usar una hoja de estilos externa llamada `estilos.css`.

**Solución, paso a paso**

1. La declaración: `<!DOCTYPE html>`.
2. La raíz con el idioma: `<html lang="es">`.
3. Abrir `<head>` y poner el `charset` como primera etiqueta.
4. Añadir el `viewport` para el móvil.
5. Poner el `<title>`.
6. Enlazar el CSS con `<link rel="stylesheet" href="estilos.css">`.
7. Cerrar `</head>`, abrir `<body>`, escribir el `h1` y el `p`, y cerrar `</body>` y `</html>`.

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi primera página</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <h1>Mi primera página</h1>
  <p>Esto es un párrafo de ejemplo.</p>
</body>
</html>
```

</div>

<div class="ejercicio">

### Ejercicio 6 · Encontrar los errores del documento

Este documento tiene seis fallos. Localízalos y escribe la versión correcta.

```html
<html lang="es">
<head>
  <title>Mi web</title>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Hola</h1>
  <p>Bienvenido a mi web.<p>
  <img src="foto.jpg">
</body>
```

**Solución**

1. Falta `<!DOCTYPE html>` en la primera línea.
2. El `charset` debe ir antes que el `title` (es lo primero del `head`).
3. Falta el `viewport` para el móvil (recomendado, no obligatorio para validar).
4. El segundo `<p>` debería ser `</p>`.
5. La imagen no tiene `alt`.
6. Falta cerrar `</html>`.

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi web</title>
</head>
<body>
  <h1>Hola</h1>
  <p>Bienvenido a mi web.</p>
  <img src="foto.jpg" alt="Descripción de la foto">
</body>
</html>
```

**Antes de entregar, repasa:** `<!DOCTYPE html>` en la primera línea · un solo `html`, `head` y `body` · `charset` dentro del `head` y antes del `title` · todas las etiquetas cerradas en orden · un solo `h1` · `alt` en todas las imágenes. El validador del W3C (`validator.w3.org/nu/`) señala el error y la línea, pero en el examen no lo tienes: esta lista es tu validador.

</div>

# 4. Texto, listas y contenido {#sec4}

## 4.1. Encabezados: `h1` a `h6`

```html
<h1>Título principal de la página</h1>
<h2>Apartado</h2>
<h3>Subapartado</h3>
<h4>Detalle</h4>
<h5>Casi nunca</h5>
<h6>Nunca</h6>
```

Reglas:

1. **Un solo `h1` por página.**
2. **No te saltes niveles:** de `h1` se pasa a `h2`, de `h2` a `h3`. No de `h1` a `h4`.
3. El nivel indica **jerarquía**, no tamaño. El tamaño se cambia con CSS.
4. El `h1` va dentro de `main` o de `header`, no suelto al final.

```html
<!-- MAL -->
<h1>Recetas</h1>
<h4>Bizcocho</h4>

<!-- BIEN -->
<h1>Recetas</h1>
<h2>Bizcocho</h2>
```

## 4.2. Párrafos y saltos

```html
<p>Un párrafo puede ocupar varias líneas en el archivo y el navegador lo junta en un solo bloque.</p>

<p>Primera línea<br>Segunda línea</p>

<hr>

<p>Después de una línea horizontal, que marca un cambio de tema.</p>
```

- Los saltos de línea del archivo **no cuentan**: HTML los convierte en un espacio.
- Los espacios repetidos también se colapsan: `Hola     mundo` se ve `Hola mundo`.
- Para un salto de verdad: `<br>`.
- Para una línea horizontal: `<hr>`.
- Para conservar espacios y saltos: `<pre>`.

```html
<pre>
  Esto   conserva    los espacios
  y los saltos de línea.
</pre>
```

<div class="nota">

`<pre>` se usa para texto preformateado, por ejemplo código o un poema. Hoy lo normal es `<pre><code>...</code></pre>`. No lo uses para maquetar la página entera.

</div>

## 4.3. Citas

```html
<!-- Cita en bloque, de otra fuente -->
<blockquote cite="https://www.eniun.com">
  <p>La práctica hace al maestro.</p>
</blockquote>

<!-- Cita corta, dentro de un párrafo -->
<p>Como dijo alguien: <q>lo importante es no dejar de aprender</q>.</p>

<!-- Título de una obra -->
<p>He leído <cite>El Quijote</cite>.</p>
```

`cite` en `<blockquote>` es la URL de la fuente, no un enlace visible. `<q>` añade las comillas automáticamente.

## 4.4. Listas

### Lista sin orden: `<ul>`

```html
<ul>
  <li>Pan</li>
  <li>Leche</li>
  <li>Huevos</li>
</ul>
```

### Lista ordenada: `<ol>`

```html
<ol>
  <li>Entrar en la web</li>
  <li>Hacer login</li>
  <li>Enviar el formulario</li>
</ol>
```

### Lista de definiciones: `<dl>`

```html
<dl>
  <dt>HTML</dt>
  <dd>Lenguaje de marcado de hipertexto.</dd>
  <dt>CSS</dt>
  <dd>Hojas de estilo en cascada.</dd>
</dl>
```

- `<dl>` = definition list.
- `<dt>` = término que se define.
- `<dd>` = definición del término.
- Cada `dt` puede tener uno o varios `dd`.

### Atributos de las listas

| Atributo | Etiqueta | Valores | Ejemplo |
|---|---|---|---|
| `type` | `ol` | `1`, `A`, `a`, `I`, `i` | `<ol type="A">` |
| `type` | `ul` | `disc`, `circle`, `square` | `<ul type="square">` |
| `start` | `ol` | número donde empieza | `<ol start="5">` |
| `reversed` | `ol` | booleano, cuenta atrás | `<ol reversed>` |

```html
<!-- Letras mayúsculas empezando por la C -->
<ol type="A" start="3">
  <li>Primero</li>
  <li>Segundo</li>
</ol>
```

### Listas anidadas

```html
<ul>
  <li>Frutas
    <ul>
      <li>Manzana</li>
      <li>Plátano</li>
    </ul>
  </li>
  <li>Verduras</li>
</ul>
```

La sublista va **dentro del `li`**, no directamente dentro del `ul`.

## 4.5. Etiquetas de texto en línea

| Etiqueta | Significado | Se ve |
|---|---|---|
| `<strong>` | Importancia (semántico) | Negrita |
| `<b>` | Negrita solo visual | Negrita |
| `<em>` | Énfasis (semántico) | Cursiva |
| `<i>` | Cursiva solo visual | Cursiva |
| `<u>` | Subrayado | Subrayado |
| `<s>` | Contenido que ya no es correcto | Tachado |
| `<mark>` | Resaltado | Fondo amarillo |
| `<small>` | Letra pequeña, avisos legales | Más pequeño |
| `<sub>` | Subíndice: H₂O | Más bajo |
| `<sup>` | Superíndice: x² | Más alto |
| `<code>` | Código de programación | Monoespaciada |
| `<kbd>` | Tecla del teclado | Con borde |
| `<samp>` | Salida de un programa | Monoespaciada |
| `<var>` | Variable matemática | Cursiva |
| `<abbr title="...">` | Abreviatura | Muestra el título al pasar el ratón |
| `<time datetime="...">` | Fecha u hora | Texto normal |
| `<dfn>` | Término que se define | Cursiva |
| `<span>` | Contenedor en línea genérico | Nada |
| `<br>` | Salto de línea | Salto |
| `<wbr>` | Punto de corte de palabra | Nada |

<div class="trampa">

**La diferencia que más cae:** `<strong>` y `<em>` tienen **significado** (importancia y énfasis); `<b>` e `<i>` solo cambian el **aspecto**. Para el navegador se ven igual, pero para un lector de pantalla y para un buscador no.

</div>

## 4.6. `figure` y `figcaption`

```html
<figure>
  <img src="img/playa.jpg" alt="Playa de Getares al atardecer">
  <figcaption>Playa de Getares, Algeciras.</figcaption>
</figure>
```

`figure` agrupa una imagen (o un vídeo, un diagrama, una tabla) con su pie. `figcaption` es el pie o leyenda y va dentro de `figure`, normalmente después de la imagen.

## 4.7. Ejercicio resuelto: una noticia completa

<div class="ejercicio">

### Ejercicio 7 · Noticia con títulos, listas y cita

Escribe una noticia con: un titular, una entradilla, dos secciones con subtítulo, una lista de datos, una cita en bloque y un enlace a la fuente.

**Solución**

```html
<h1>Algeciras abre un centro para conocer el Estrecho</h1>

<p>Redacción local | Algeciras, 12 de octubre de 2026</p>

<h2>Un punto de encuentro junto al mar</h2>
<p>
  Algeciras es una ciudad de la provincia de Cádiz situada junto al
  <strong>Estrecho de Gibraltar</strong>, entre el mar Mediterráneo y el
  océano Atlántico.
</p>

<h2>Datos de interés</h2>
<ul>
  <li>Población: unos 120 000 habitantes.</li>
  <li>Comarca: Campo de Gibraltar.</li>
  <li>Fiestas: Feria Real y Semana Santa.</li>
</ul>

<h2>Una frase para la historia</h2>
<blockquote>
  «Algeciras es la puerta sur de Europa y un lugar de encuentro entre culturas.»
</blockquote>

<p>Fuente: <a href="https://es.wikipedia.org/wiki/Algeciras">Wikipedia</a></p>
```

**Por qué está bien:** un solo `h1`, los `h2` no se saltan niveles, la lista usa `ul` porque los datos no tienen orden, la cita va en `blockquote` y el enlace lleva `href` completo con `https://`.

</div>

<div class="ejercicio">

### Ejercicio 8 · Lista anidada y de definiciones

Escribe una lista de la compra con dos categorías (frutas y verduras) y, debajo, un glosario con dos términos.

**Solución**

```html
<h2>Lista de la compra</h2>
<ul>
  <li>Frutas
    <ul>
      <li>Manzanas</li>
      <li>Plátanos</li>
    </ul>
  </li>
  <li>Verduras
    <ul>
      <li>Tomates</li>
      <li>Lechuga</li>
    </ul>
  </li>
</ul>

<h2>Glosario</h2>
<dl>
  <dt>HTML</dt>
  <dd>Lenguaje de marcado que estructura el contenido.</dd>
  <dt>CSS</dt>
  <dd>Lenguaje que da estilo y presentación.</dd>
</dl>
```

</div>

## 4.8. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<h1>` y luego `<h4>` | Salto de nivel | `<h2>` |
| Dos `<h1>` | Solo puede haber uno | Un `h1` y el resto `h2` |
| `<li>` suelto sin `ul` | No tiene sentido | `<ul><li>...</li></ul>` |
| `<ul><li>Uno<li>Dos</ul>` | Faltan cierres | `<li>Uno</li><li>Dos</li>` |
| `<ol>` para algo sin orden | Comunica un orden falso | `<ul>` |
| `<br><br><br>` para separar secciones | HTML no maqueta | `<p>` o CSS |
| `<b>` para "importante" | No aporta significado | `<strong>` |
| `<p>` dentro de `<p>` | Se rompe el documento | Párrafos separados |

# 5. Enlaces e imágenes {#sec5}

## 5.1. Enlaces: `<a>`

```html
<a href="https://www.eniun.com">Ir a Eniun</a>
```

- `<a>` viene de *anchor* (ancla).
- `href` es la dirección de destino. **Sin `href`, el enlace no funciona.**
- El texto entre `<a>` y `</a>` es lo que se ve y en lo que se hace clic.

### Tipos de enlace según el destino

| `href` | Lleva a | Ejemplo |
|---|---|---|
| URL absoluta | Otra web | `https://www.w3.org` |
| URL relativa | Otra página de tu proyecto | `contacto.html` |
| Ruta con carpetas | Una página en una subcarpeta | `blog/post.html` |
| Ancla | Un punto de la misma página | `#contacto` |
| Correo | Abre el programa de correo | `mailto:info@web.com` |
| Teléfono | Abre el marcador en el móvil | `tel:+34600111222` |
| Descarga | Fuerza la descarga | `cv.pdf` con `download` |

```html
<a href="pagina2.html">Ir a la página 2</a>
<a href="docs/manual.pdf" download="manual.pdf">Descargar el manual</a>
<a href="mailto:info@web.com">Enviar un correo</a>
<a href="tel:+34600111222">Llamar</a>
<a href="#final">Bajar al final</a>
```

### `target`: dónde se abre

| Valor | Dónde se abre |
|---|---|
| `_self` | En la misma pestaña (valor por defecto) |
| `_blank` | En una pestaña o ventana nueva |
| `_parent` | En el marco padre (frames) |
| `_top` | En la ventana completa, sustituyendo los frames |

```html
<a href="https://www.w3.org" target="_blank" rel="noopener noreferrer">W3C</a>
```

`rel="noopener noreferrer"` es una medida de seguridad y accesibilidad que acompaña a `target="_blank"`. En el examen, si pones `_blank`, añádela.

### Rutas relativas

```text
mi-web/
├── index.html
├── contacto.html
├── blog/
│   └── post.html
└── img/
    └── logo.png
```

| Desde | Hasta | Ruta |
|---|---|---|
| `index.html` | `contacto.html` | `contacto.html` |
| `index.html` | `blog/post.html` | `blog/post.html` |
| `index.html` | `img/logo.png` | `img/logo.png` |
| `blog/post.html` | `index.html` | `../index.html` |
| `blog/post.html` | `img/logo.png` | `../img/logo.png` |

Cada `../` sube una carpeta. Si una ruta falla, casi siempre falta o sobra un `../`.

### Marcadores o anclas

```html
<!-- Enlace que salta a un destino de la misma página -->
<a href="#contacto">Ir a contacto</a>

<!-- Destino: el id del elemento al que se salta -->
<h2 id="contacto">Contacto</h2>

<!-- Desde otra página -->
<a href="index.html#contacto">Contacto de la página principal</a>
```

Regla: en el destino se pone `id="nombre"`; en el enlace, `href="#nombre"` **con almohadilla**. Si falta la almohadilla, el navegador busca un archivo llamado `contacto` y no salta.

## 5.2. Imágenes: `<img>`

```html
<img src="img/logo.png" alt="Logotipo del instituto" width="200">
```

| Atributo | Para qué | ¿Obligatorio? |
|---|---|---|
| `src` | Ruta del archivo de imagen | Sí |
| `alt` | Texto alternativo; describe la imagen | Sí (puede ser `alt=""`) |
| `width` / `height` | Tamaño en píxeles | No |
| `title` | Texto que sale al pasar el ratón | No |
| `loading="lazy"` | Carga la imagen solo cuando se acerca | No |

### La regla del `alt`

- Si la imagen **transmite información**, se describe: `alt="Gráfico: las ventas subieron un 40 % en marzo"`.
- Si la imagen es **decorativa**, se deja vacía: `alt=""`.
- Lo que **nunca** se hace es omitir el atributo, ni repetir el nombre del archivo (`alt="logo_v3_final.png"`).

```html
<!-- Imagen informativa -->
<img src="img/grafico.png" alt="Ventas por trimestre: 120, 150 y 180 unidades">

<!-- Imagen decorativa -->
<img src="img/adorno.png" alt="">
```

### Tamaño y responsive

```html
<img src="img/foto.jpg" alt="Playa de Getares" width="800" height="600" loading="lazy">
```

```css
img {
  max-width: 100%;
  height: auto;
}
```

Sin `max-width: 100%`, una imagen grande provoca scroll horizontal en el móvil. Con `width` y `height` el navegador reserva el hueco antes de que cargue y evita saltos.

## 5.3. Imágenes en fila (el ejercicio clásico)

Una imagen es un elemento **en línea**, así que varias imágenes seguidas se colocan una al lado de otra si caben. El problema es que se descuadran fácilmente: los espacios del código cuentan, los tamaños son distintos y en cuanto no caben bajan de línea. Hay tres formas de hacerlo bien.

### Método A · `inline-block` (el de los apuntes del curso)

Cada imagen va dentro de un `figure` con su pie. Los `figure` se ponen en fila con `display: inline-block` y el contenedor los centra con `text-align: center`.

```html
<div class="galeria">
  <figure>
    <img src="img/plaza.jpg" alt="Plaza Alta de Algeciras">
    <figcaption>Plaza Alta</figcaption>
  </figure>
  <figure>
    <img src="img/puerto.jpg" alt="Puerto de Algeciras">
    <figcaption>Puerto</figcaption>
  </figure>
  <figure>
    <img src="img/getares.jpg" alt="Playa de Getares">
    <figcaption>Getares</figcaption>
  </figure>
</div>
```

```css
.galeria {
  text-align: center;
}

.galeria figure {
  display: inline-block;
  width: 260px;
  margin: 10px;
  vertical-align: top;
}

.galeria img {
  width: 100%;
  height: 170px;
  object-fit: cover;
}

.galeria figcaption {
  font-size: 0.9rem;
  margin-top: 4px;
}
```

- `display: inline-block` pone las figuras una al lado de otra.
- `vertical-align: top` alinea los pies de foto aunque las imágenes midan distinto.
- `width: 100%` + `height: 170px` + `object-fit: cover` hace que todas las fotos tengan el mismo tamaño sin deformarse.
- `text-align: center` en el contenedor centra el conjunto.

<div class="trampa">

`figure` trae un margen por defecto (`1em 40px`) que descuadra la fila. Hay que ponerle `margin` propio. Y si en el HTML dejas un salto de línea entre dos `figure`, el navegador lo convierte en un espacio y aparece una separación extra. Con `inline-block` eso es normal; se controla con el `margin`.

</div>

### Método B · Flexbox (el más cómodo)

```html
<div class="galeria">
  <figure>
    <img src="img/plaza.jpg" alt="Plaza Alta de Algeciras">
    <figcaption>Plaza Alta</figcaption>
  </figure>
  <figure>
    <img src="img/puerto.jpg" alt="Puerto de Algeciras">
    <figcaption>Puerto</figcaption>
  </figure>
  <figure>
    <img src="img/getares.jpg" alt="Playa de Getares">
    <figcaption>Getares</figcaption>
  </figure>
</div>
```

```css
.galeria {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  justify-content: center;
}

.galeria figure {
  width: 260px;
  margin: 0;
}

.galeria img {
  width: 100%;
  height: 170px;
  object-fit: cover;
}
```

- `display: flex` pone los hijos en fila.
- `flex-wrap: wrap` hace que bajen a la siguiente línea si no caben.
- `gap` separa sin necesidad de márgenes.
- `justify-content: center` centra el conjunto.

### Método C · Grid (el de los ocho ejemplos)

```css
.galeria {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
}

.galeria figure {
  margin: 0;
}

.galeria img {
  width: 100%;
  height: 170px;
  object-fit: cover;
}
```

`repeat(auto-fit, minmax(200px, 1fr))` crea tantas columnas como caben, cada una de mínimo 200 px y repartiendo el espacio sobrante. Es la solución más moderna y la que se adapta sola al móvil.

### ¿Cuál uso en el examen?

| Situación | Método |
|---|---|
| El enunciado pide "sin CSS" o solo HTML | Pon las imágenes seguidas; se colocan en línea solas |
| El ejercicio es como el del curso (`figure` + `inline-block`) | Método A |
| Quieres que se adapte al móvil sin media queries | Método B o C |
| Te piden una rejilla de tarjetas o fotos | Grid (C) |

<div class="ejercicio">

### Ejercicio 9 · Galería de cuatro fotos en fila

Escribe una galería con cuatro imágenes, cada una con su pie de foto, centrada, con todas las fotos del mismo tamaño y que se adapte al móvil.

**Solución con Flexbox**

```html
<h1>Lugares de Algeciras</h1>

<div class="galeria">
  <figure>
    <img src="img/plaza.jpg" alt="Plaza Alta de Algeciras">
    <figcaption>Plaza Alta</figcaption>
  </figure>
  <figure>
    <img src="img/puerto.jpg" alt="Puerto de Algeciras">
    <figcaption>Puerto</figcaption>
  </figure>
  <figure>
    <img src="img/getares.jpg" alt="Playa de Getares">
    <figcaption>Getares</figcaption>
  </figure>
  <figure>
    <img src="img/rio.jpg" alt="Río de la Miel">
    <figcaption>Río de la Miel</figcaption>
  </figure>
</div>

<style>
  .galeria {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 16px;
  }
  .galeria figure {
    width: 220px;
    margin: 0;
  }
  .galeria img {
    width: 100%;
    height: 150px;
    object-fit: cover;
  }
  .galeria figcaption {
    text-align: center;
    font-size: 0.9rem;
  }
</style>
```

**Por qué está bien:** el `alt` describe cada foto, el pie va en `figcaption`, las imágenes tienen el mismo alto con `object-fit: cover`, el `gap` separa sin márgenes raros y `flex-wrap` las baja de línea en el móvil.

</div>

<div class="ejercicio">

### Ejercicio 10 · Enlaces de un menú

Escribe un menú con cuatro enlaces: Inicio (misma carpeta), Productos (sección de la misma página), Contacto (otra página) y una descarga de PDF.

**Solución**

```html
<nav>
  <ul>
    <li><a href="index.html">Inicio</a></li>
    <li><a href="#productos">Productos</a></li>
    <li><a href="contacto.html">Contacto</a></li>
    <li><a href="docs/catalogo.pdf" download>Catálogo (PDF)</a></li>
  </ul>
</nav>

<h2 id="productos">Productos</h2>
```

</div>

## 5.4. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<a>Texto</a>` sin `href` | No es un enlace | `<a href="...">Texto</a>` |
| `href="www.web.com"` | Busca un archivo local | `href="https://www.web.com"` |
| `href="seccion"` | Busca una página | `href="#seccion"` |
| `<img src="a.png">` sin `alt` | Falla la accesibilidad | `alt="..."` o `alt=""` |
| `<img src="C:\fotos\a.png">` | Ruta del ordenador, no de la web | `src="img/a.png"` |
| `target="_blank"` sin `rel` | Pestaña insegura | `rel="noopener noreferrer"` |
| Imagen de 2000 px sin `max-width` | Scroll horizontal en el móvil | `max-width: 100%` |
| `alt="foto.jpg"` | Repite el nombre del archivo | Describe lo que se ve |

# 6. Elementos semánticos {#sec6}

## 6.1. El problema de la montaña de `div`

```html
<div class="cabecera">
  <div class="logo">MiWeb</div>
  <div class="menu">
    <div class="item">Inicio</div>
  </div>
</div>
<div class="contenido">...</div>
<div class="pie">© 2026</div>
```

Funciona y se ve igual, pero el código no dice qué es cada cosa. HTML5 añadió etiquetas que **nombran la función** del contenido. Eso es la semántica.

Ventajas: mejor para buscadores (SEO), para lectores de pantalla (accesibilidad) y para ti cuando vuelves al proyecto meses después.

## 6.2. Mapa de etiquetas

| Etiqueta | Para qué | ¿Cuántas? |
|---|---|---|
| `<header>` | Cabecera de la página o de una sección | Varias |
| `<nav>` | Menú de navegación | Varias |
| `<main>` | Contenido principal y único | **Solo una** |
| `<section>` | Sección temática con su encabezado | Varias |
| `<article>` | Contenido autónomo (noticia, post, ficha) | Varias |
| `<aside>` | Contenido secundario o lateral | Varias |
| `<footer>` | Pie de página o de una sección | Varias |
| `<address>` | Datos de contacto | — |
| `<figure>` / `<figcaption>` | Imagen o multimedia + su pie | — |

## 6.3. Estructura canónica de una página

```html
<body>
  <header>
    <a href="index.html"><img src="img/logo.png" alt="Logo de MiWeb"></a>
    <nav aria-label="Navegación principal">
      <ul>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="about.html">Sobre mí</a></li>
        <li><a href="contacto.html">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Título único de la página</h1>
    <p>Contenido principal.</p>
  </main>

  <footer>
    <p>© 2026 MiWeb · <a href="legal.html">Aviso legal</a></p>
  </footer>
</body>
```

Este es el esqueleto de casi cualquier página web. Memorízalo.

## 6.4. `main` es especial: solo uno

- Solo puede haber **un `<main>`** por documento.
- No puede estar dentro de `header`, `footer`, `nav`, `article` o `aside`.
- Va directamente en `body` (o dentro de un `div` normal).
- Visualmente no hace nada: su valor es semántico. Aun así es obligatorio por accesibilidad.

```html
<!-- MAL -->
<main>Contenido del artículo</main>
<main>Contenido de la barra lateral</main>

<!-- BIEN -->
<main>Contenido del artículo</main>
<aside>Contenido de la barra lateral</aside>
```

## 6.5. `article` frente a `section`

| | `<section>` | `<article>` |
|---|---|---|
| Es | una sección temática | una pieza autónoma |
| ¿Se puede compartir sola? | No necesariamente | Sí |
| Ejemplo | "Nuestros productos" | "Noticia del lunes" |
| ¿Lleva encabezado? | Sí, debe tenerlo | Sí, normalmente |

La prueba rápida: si puedes copiar ese trozo a otra página y sigue teniendo sentido completo, es un `article`. Si solo tiene sentido dentro de esta página, es una `section`. Y si no lleva encabezado, es un `div`.

## 6.6. Árbol de decisión

```text
¿Es el contenido principal y único de la página?       → main
¿Es un trozo con sentido por sí solo (noticia, post)?  → article
¿Es un grupo temático con encabezado?                  → section
¿Es un menú o conjunto de enlaces?                     → nav
¿Es contenido secundario o lateral?                    → aside
¿Está arriba o abajo de la página o sección?           → header / footer
¿Solo necesito un contenedor para CSS?                 → div
```

<div class="ejercicio">

### Ejercicio 11 · Página semántica completa

Convierte este contenido en una página con `header`, `nav`, `main`, `article`, `aside` y `footer`:

- Cabecera con el nombre "DAW Kursaal" y un menú con Inicio y Contacto.
- Contenido principal: un artículo titulado "Fórmate como desarrollador web" con un párrafo.
- Barra lateral con los datos de contacto.
- Pie con el copyright.

**Solución**

```html
<body>
  <header>
    <strong>DAW - I.E.S. Kursaal</strong>
    <nav>
      <ul>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="contacto.html">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <article>
      <h1>Fórmate como desarrollador web</h1>
      <p>El ciclo de Desarrollo de Aplicaciones Web te prepara para crear
         y mantener aplicaciones web.</p>
    </article>

    <aside>
      <h2>Contacto</h2>
      <address>
        <p>Calle Real, 1<br>11201 Algeciras</p>
        <p><a href="mailto:info@kursaal.es">info@kursaal.es</a></p>
      </address>
    </aside>
  </main>

  <footer>
    <p>© 2026 DAW Kursaal</p>
  </footer>
</body>
```

</div>

## 6.7. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| Dos `<main>` | Solo puede haber uno | Un `main` y el resto `section`/`aside` |
| `<main>` dentro de `<article>` | Prohibido | `article` dentro de `main` |
| `<section>` sin encabezado | No es una sección, es un `div` | Añade `h2` o usa `div` |
| `div` para el menú | Pierdes semántica | `<nav>` |
| `<header>` para el `head` | Son cosas distintas | `head` técnico, `header` visible |
| `article` para todo | Pierde sentido | `section` si no es autónomo |

## 6.8. Repaso rápido de la sección

| Si te preguntan… | Contesta |
|---|---|
| ¿Cuántos `main` puede haber? | Uno, y no dentro de `header`, `footer`, `nav`, `article` ni `aside` |
| ¿`section` o `article`? | `article` si el trozo tiene sentido por sí solo; `section` si es un grupo temático con encabezado |
| ¿`section` sin `h2`? | Está mal: sin encabezado es un `div` |
| ¿`head` y `header` son lo mismo? | No: `head` es técnico (no se ve) y `header` es la cabecera visible |
| ¿Para qué sirve `div` entonces? | Solo como contenedor para CSS o JavaScript, sin significado |
| ¿Se gana algo visible con la semántica? | No cambia el aspecto, pero mejora accesibilidad, SEO y legibilidad del código |

<div class="regla">

**Frase para el examen:** «las etiquetas semánticas no cambian cómo se ve la página, cambian lo que la página significa». Con eso y el árbol de decisión se resuelve cualquier supuesto práctico.

</div>

# 7. Tablas {#sec7}

## 7.1. ¿Es una tabla de verdad?

Una tabla sirve para **datos relacionados**: cada fila es un registro y cada columna un atributo. Horarios, precios, notas, comparativas.

No sirve para maquetar la página. La prueba: si quitas el CSS y la tabla sigue teniendo sentido leyendo los datos, es una tabla. Si solo queda un montón de bloques colocados, era maquetación y está mal.

## 7.2. Anatomía completa

```html
<table>
  <caption>Horario del curso 2.º DAW</caption>
  <thead>
    <tr>
      <th scope="col">Hora</th>
      <th scope="col">Lunes</th>
      <th scope="col">Martes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">08:00</th>
      <td>Entorno Cliente</td>
      <td>Diseño Web</td>
    </tr>
    <tr>
      <th scope="row">09:00</th>
      <td>Entorno Servidor</td>
      <td>Diseño Web</td>
    </tr>
  </tbody>
</table>
```

| Etiqueta | Significado | ¿Obligatoria? |
|---|---|---|
| `<table>` | La tabla entera | Sí |
| `<caption>` | Título de la tabla | No, pero muy recomendable |
| `<thead>` | Cabecera de la tabla | Opcional |
| `<tbody>` | Cuerpo con las filas de datos | Sí (el navegador la pone si falta) |
| `<tfoot>` | Pie de tabla (totales) | Opcional |
| `<tr>` | Una fila (*table row*) | — |
| `<th>` | Celda de encabezado (*table header*) | — |
| `<td>` | Celda de dato (*table data*) | — |

- `caption` va **justo después de abrir `table`**, antes de `thead`.
- `th` sale en negrita y centrado por defecto, pero eso es lo de menos: sirve para que el lector de pantalla sepa qué columna o fila está leyendo.
- `scope="col"` indica que la cabecera es de una columna; `scope="row"`, de una fila.

## 7.3. `colspan` y `rowspan`

- `colspan="n"`: la celda ocupa **n columnas** hacia la derecha.
- `rowspan="n"`: la celda ocupa **n filas** hacia abajo.

```html
<table>
  <tr>
    <th colspan="2">Cabecera que ocupa 2 columnas</th>
    <th>C</th>
  </tr>
  <tr>
    <td rowspan="2">Ocupa 2 filas</td>
    <td>D</td>
    <td>E</td>
  </tr>
  <tr>
    <td>F</td>
    <td>G</td>
  </tr>
</table>
```

Así queda la rejilla:

```text
        col1        col2        col3
fila1   [ A ─────── A ]         [ C ]
fila2   [ B ]       [ D ]       [ E ]
fila3   [ B ]       [ F ]       [ G ]
```

`A` es un `colspan="2"`. `B` es un `rowspan="2"`.

### El truco para no equivocarse

1. Cuenta las columnas de la tabla (las de la primera fila).
2. Cada fila debe sumar **el mismo número de columnas**.
3. Una celda con `colspan="2"` cuenta como 2.
4. Si en una fila hay un `rowspan="2"`, la fila siguiente lleva **una celda menos**, porque esa columna ya está ocupada.
5. Dibuja la rejilla en el papel antes de escribir el código. Es lo que evita el 95 % de los errores.

<div class="trampa">

**Error clásico de examen:** poner `rowspan="2"` y luego escribir todas las celdas de la fila siguiente. Si la celda de arriba ya ocupa dos filas, en la segunda fila esa columna no se escribe. Cuenta siempre.

</div>

## 7.4. Alineación de la tabla

### Alinear el texto de las celdas

```css
th, td {
  text-align: left;      /* izquierda (por defecto en td) */
}

th {
  text-align: center;    /* las cabeceras, centradas */
}

td.numero {
  text-align: right;     /* los números, a la derecha */
}

td.centrado {
  text-align: center;
}

td.justificado {
  text-align: justify;
}
```

`text-align` se aplica a la celda (`th` o `td`), no a la tabla. Los valores son `left`, `center`, `right` y `justify`.

### Alinear verticalmente

```css
td {
  vertical-align: middle;  /* centrado vertical (por defecto en las celdas) */
}

td.arriba {
  vertical-align: top;     /* el texto empieza arriba */
}

td.abajo {
  vertical-align: bottom;
}
```

`vertical-align` sirve sobre todo cuando una celda es más alta que otra, por ejemplo por un `rowspan`.

### Centrar la tabla en la página

```css
table {
  width: 80%;          /* hace falta un ancho */
  margin: 0 auto;      /* reparte el espacio sobrante a izquierda y derecha */
  border-collapse: collapse;
}
```

`margin: 0 auto` centra un bloque **solo si tiene un ancho definido**. `text-align: center` en el `table` no centra la tabla: centra su contenido. El antiguo `align="center"` está obsoleto.

### Título y bordes

```css
caption {
  caption-side: top;      /* top o bottom */
  text-align: center;
  font-weight: bold;
  padding: 6px;
}

table {
  border-collapse: collapse;   /* une los bordes en una sola línea */
  width: 100%;
}

th, td {
  border: 1px solid #999;
  padding: 8px 12px;
}
```

Sin `border-collapse: collapse` se ven bordes dobles, porque cada celda dibuja el suyo.

### Tabla completa con estilos

```html
<table class="horario">
  <caption>Horario de 2.º DAW</caption>
  <thead>
    <tr>
      <th scope="col">Hora</th>
      <th scope="col">Lunes</th>
      <th scope="col">Martes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">15:45</th>
      <td>Inglés</td>
      <td>DIWEB</td>
    </tr>
    <tr>
      <th scope="row">16:45</th>
      <td>DIWEB</td>
      <td>IPE II</td>
    </tr>
  </tbody>
</table>
```

```css
.horario {
  width: 80%;
  margin: 0 auto;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

.horario caption {
  caption-side: top;
  text-align: center;
  font-weight: bold;
  padding: 8px;
}

.horario th,
.horario td {
  border: 1px solid #888;
  padding: 8px;
}

.horario thead th {
  background-color: #dddddd;
  text-align: center;
}

.horario tbody th {
  text-align: left;
  background-color: #f2f2f2;
}

.horario td {
  text-align: center;
}
```

## 7.5. Ejercicio resuelto: horario con `colspan`

<div class="ejercicio">

### Ejercicio 12 · Tabla de horario

Escribe la tabla de un horario con las columnas Hora, Lunes, Martes, Miércoles, Jueves y Viernes. La fila del descanso debe ocupar todas las columnas de clases. Añade título, cabecera, cuerpo y bordes.

**Solución**

```html
<table>
  <caption>Horario DAW - Curso 2026/2027</caption>
  <thead>
    <tr>
      <th scope="col">Hora</th>
      <th scope="col">Lunes</th>
      <th scope="col">Martes</th>
      <th scope="col">Miércoles</th>
      <th scope="col">Jueves</th>
      <th scope="col">Viernes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">15:45 - 16:45</th>
      <td>Inglés</td>
      <td>DIWEB</td>
      <td>Optativa</td>
      <td>DWEC</td>
      <td>Despliegue</td>
    </tr>
    <tr>
      <th scope="row">16:45 - 17:45</th>
      <td>DIWEB</td>
      <td>IPE II</td>
      <td>IPE II</td>
      <td>DWEC</td>
      <td>DWES</td>
    </tr>
    <tr>
      <th scope="row">18:45 - 19:00</th>
      <td colspan="5">Descanso</td>
    </tr>
    <tr>
      <th scope="row">19:00 - 20:00</th>
      <td>DWES</td>
      <td>Inglés</td>
      <td>DIWEB</td>
      <td>DWEC</td>
      <td>DWEC</td>
    </tr>
  </tbody>
</table>
```

```css
table {
  border-collapse: collapse;
}
caption {
  font-weight: bold;
}
th, td {
  border: 1px solid #888;
  padding: 8px;
}
thead th {
  background-color: #ddd;
}
```

**Cuenta de celdas:** la tabla tiene 6 columnas. La fila del descanso lleva un `th` (la hora) + un `td` con `colspan="5"` = 1 + 5 = 6. Correcto.

</div>

## 7.6. Ejercicio resuelto: `rowspan` y `colspan` a la vez

<div class="ejercicio">

### Ejercicio 13 · Tabla de reparto de horas

Escribe una tabla con estas columnas: Turno, Lunes y Martes. El turno de mañana ocupa dos filas. La cabecera "Fin de semana" no hace falta. Añade una fila final que ocupe las tres columnas con el texto "Total: 30 horas".

**Solución**

```html
<table>
  <caption>Reparto de horas semanal</caption>
  <thead>
    <tr>
      <th scope="col">Turno</th>
      <th scope="col">Lunes</th>
      <th scope="col">Martes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" rowspan="2">Mañana</th>
      <td>DIWEB</td>
      <td>DWES</td>
    </tr>
    <tr>
      <td>DWEC</td>
      <td>DWES</td>
    </tr>
    <tr>
      <th scope="row">Tarde</th>
      <td>Proyecto</td>
      <td>Libre</td>
    </tr>
    <tr>
      <td colspan="3">Total: 30 horas</td>
    </tr>
  </tbody>
</table>
```

**Comprobación:**

- La tabla tiene 3 columnas.
- La primera fila de datos: `th rowspan="2"` (1) + `td` (1) + `td` (1) = 3.
- La segunda fila de datos: solo 2 `td`, porque la primera columna la ocupa el `rowspan` de arriba. 2 + 1 ocupada = 3.
- La fila del total: un `td colspan="3"` = 3.

</div>

## 7.7. Tablas en el móvil

Una tabla de 6 columnas no cabe en un móvil de 360 px. La solución más simple es envolverla en un contenedor con scroll horizontal:

```html
<div class="tabla-scroll">
  <table>...</table>
</div>
```

```css
.tabla-scroll {
  overflow-x: auto;
}

.tabla-scroll table {
  min-width: 600px;
}
```

El scroll lo hace el contenedor, no la página entera. Es la opción recomendada en el curso.

## 7.8. Plantilla de tabla para memorizar

```html
<table>
  <caption>Título de la tabla</caption>
  <thead>
    <tr>
      <th scope="col">Columna 1</th>
      <th scope="col">Columna 2</th>
      <th scope="col">Columna 3</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Fila 1</th>
      <td>Dato</td>
      <td>Dato</td>
    </tr>
    <tr>
      <th scope="row">Fila 2</th>
      <td>Dato</td>
      <td>Dato</td>
    </tr>
  </tbody>
</table>
```

## 7.9. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<table border="1">` | Atributo obsoleto | Bordes en CSS |
| `<td>` para las cabeceras | Se pierde la semántica | `<th scope="col">` |
| `<table><td>Dato</td></table>` | Falta la fila | `<tr><td>...</td></tr>` |
| Filas con distinto número de celdas | Tabla descuadrada | Cuenta con `colspan`/`rowspan` |
| `align="center"` en `table` | Obsoleto y no centra igual | `margin: 0 auto` con ancho |
| `text-align` en `table` para centrar la tabla | Centra el contenido, no la tabla | `margin: 0 auto` |
| Usar tabla para maquetar | Obsoleto desde HTML5 | `div` + CSS |
| `caption` después de `thead` | Debe ir justo después de `table` | Moverlo arriba |
| `th` sin `scope` | El lector no sabe si es columna o fila | `scope="col"` o `scope="row"` |

# 8. Formularios {#sec8}

## 8.1. La estructura

```html
<form action="procesar.php" method="post">
  <fieldset>
    <legend>Datos personales</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="email">Correo:</label>
    <input type="email" id="email" name="email" required>
  </fieldset>

  <button type="submit">Enviar</button>
</form>
```

| Etiqueta | Para qué |
|---|---|
| `<form>` | El formulario entero |
| `<fieldset>` | Agrupa controles relacionados |
| `<legend>` | Título visible del grupo |
| `<label>` | Texto o título de un campo |
| `<input>` | Campo de entrada; su comportamiento depende de `type` |
| `<select>` + `<option>` | Lista desplegable y sus opciones |
| `<optgroup>` | Grupo de opciones dentro de un `select` |
| `<textarea>` | Caja de texto de varias líneas (sí se cierra) |
| `<button>` | Botón; puede llevar HTML dentro |
| `<datalist>` | Sugerencias mientras se escribe |

## 8.2. `action` y `method`

| Atributo | Qué hace |
|---|---|
| `action` | URL del archivo que procesa los datos |
| `method` | Cómo se envían: `get` o `post` |

| | `get` | `post` |
|---|---|---|
| Cómo viaja | En la URL (`?nombre=Ana`) | En el cuerpo de la petición |
| Se ve | Sí | No |
| Límite | Corto | Grande |
| Para qué | Buscar, filtrar | Registros, contraseñas, datos personales |

Si no pones `method`, se usa `get`. Si no pones `action`, se envía a la propia página.

<div class="trampa">

**Nunca uses `get` para contraseñas.** Los datos quedan escritos en la barra de direcciones y en el historial. Para cualquier formulario con datos personales, `method="post"`.

</div>

## 8.3. `label`: el atributo que más se evalúa

```html
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre">
```

El `for` del `label` debe coincidir con el `id` del control. Eso los ata:

- al pulsar el texto, se activa el campo;
- el lector de pantalla dice qué campo es;
- es obligatorio para que el formulario esté bien hecho.

<div class="trampa">

`<label name="nombre">` **no sirve**. Lo que ata el label al campo es `for` + `id`. `name` es para el servidor.

</div>

## 8.4. Tipos de `input`

| `type` | Se usa para |
|---|---|
| `text` | Texto normal |
| `email` | Correo; valida el formato |
| `password` | Contraseña (se ven puntos) |
| `number` | Números; acepta `min`, `max`, `step` |
| `tel` | Teléfono; en el móvil abre el teclado numérico |
| `url` | Direcciones web |
| `search` | Buscador |
| `date` | Fecha con calendario |
| `time` | Hora |
| `datetime-local` | Fecha y hora |
| `month` / `week` | Mes / semana |
| `color` | Selector de color |
| `range` | Barra deslizante |
| `file` | Subir un archivo |
| `checkbox` | Casilla; se pueden marcar varias |
| `radio` | Círculo; solo una del grupo |
| `submit` | Botón que envía |
| `reset` | Botón que borra el formulario |
| `button` | Botón sin acción propia |
| `image` | Botón de envío que se ve como imagen |
| `hidden` | Campo invisible que se envía |

```html
<input type="text" id="nombre" name="nombre">
<input type="email" id="email" name="email">
<input type="password" id="pass" name="pass">
<input type="number" id="edad" name="edad" min="18" max="99">
<input type="date" id="fecha" name="fecha">
<input type="color" id="color" name="color">
<input type="range" id="nivel" name="nivel" min="0" max="10">
<input type="file" id="archivo" name="archivo">
```

## 8.5. Atributos de `input`

| Atributo | Qué hace |
|---|---|
| `name` | Nombre del dato que llega al servidor. **Sin `name`, el campo no se envía** |
| `id` | Identificador único; se usa para el `for`, CSS y JavaScript |
| `value` | Valor inicial o valor enviado |
| `placeholder` | Texto gris de ayuda dentro del campo |
| `required` | Campo obligatorio |
| `readonly` | Solo lectura: se envía, pero no se edita |
| `disabled` | Desactivado: no se usa y **no se envía** |
| `autofocus` | El cursor aparece ahí al cargar |
| `minlength` / `maxlength` | Longitud mínima / máxima |
| `min` / `max` / `step` | Rango y salto en números, fechas y `range` |
| `size` | Caracteres visibles |
| `pattern` | Expresión regular que debe cumplir |
| `checked` | Checkbox o radio marcado de inicio |
| `multiple` | En `select` o `file`, permite elegir varios |

```html
<input type="text" id="usuario" name="usuario"
       placeholder="Tu usuario" required minlength="3" maxlength="20">
```

<div class="nota">

**`id` frente a `name`:** `name` es para el servidor (el dato que viaja); `id` es para el navegador (label, CSS, JavaScript). Muchas veces coinciden, pero no tienen por qué. El `id` no se puede repetir en la página.

</div>

## 8.6. `checkbox` frente a `radio`

```html
<!-- Checkbox: se pueden marcar varias -->
<fieldset>
  <legend>Aficiones</legend>
  <input type="checkbox" id="af1" name="aficiones" value="lectura">
  <label for="af1">Lectura</label>
  <input type="checkbox" id="af2" name="aficiones" value="cine">
  <label for="af2">Cine</label>
</fieldset>

<!-- Radio: solo una del grupo -->
<fieldset>
  <legend>Turno</legend>
  <input type="radio" id="t1" name="turno" value="manana" required>
  <label for="t1">Mañana</label>
  <input type="radio" id="t2" name="turno" value="tarde">
  <label for="t2">Tarde</label>
</fieldset>
```

- Lo que agrupa los `radio` es que tengan **el mismo `name`**. Si tienen nombres distintos, se pueden marcar todos.
- Cada `radio` o `checkbox` necesita su propio `id` y su propio `label`.
- Un `checkbox` sin `value` envía `on`; ponle siempre `value` para saber qué se marcó.

## 8.7. `select`, `textarea` y `datalist`

```html
<label for="ciclo">Ciclo:</label>
<select id="ciclo" name="ciclo">
  <option value="">-- Elige uno --</option>
  <optgroup label="Grado Superior">
    <option value="daw" selected>DAW</option>
    <option value="dam">DAM</option>
  </optgroup>
</select>

<label for="mensaje">Mensaje:</label>
<textarea id="mensaje" name="mensaje" rows="5" cols="40"></textarea>

<label for="navegador">Navegador:</label>
<input id="navegador" name="navegador" list="navegadores">
<datalist id="navegadores">
  <option value="Chrome">
  <option value="Firefox">
  <option value="Edge">
</datalist>
```

- `textarea` **sí lleva cierre** `</textarea>`; su contenido va dentro, no en un `value`.
- `selected` marca la opción elegida de inicio.
- `datalist` se une al input con `list="id-del-datalist"`.
- En un `select` obligatorio, la primera opción suele ser `value=""` para forzar a elegir.

## 8.8. Botones

```html
<button type="submit">Enviar</button>
<button type="reset">Borrar</button>
<button type="button">Cancelar</button>

<!-- También vale, pero es HTML antiguo -->
<input type="submit" value="Enviar">
```

- `submit` envía el formulario.
- `reset` borra y vuelve al estado inicial.
- `button` no hace nada por sí solo: lo usa JavaScript.

## 8.9. Validación con `pattern`

Una expresión regular describe qué forma debe tener el valor. El navegador comprueba que coincida **entera**.

| Símbolo | Significado | Símbolo | Significado |
|---|---|---|---|
| `.` | Cualquier carácter | `[abc]` | a, b o c |
| `[^abc]` | Cualquiera salvo a, b o c | `[a-z]` | Rango |
| `\d` | Un dígito | `\w` | Letra, número o guion bajo |
| `\s` | Un espacio | `*` | 0 o más veces |
| `+` | 1 o más veces | `?` | 0 o 1 vez |
| `{5}` | Exactamente 5 | `{2,}` | 2 o más |
| `{1,3}` | Entre 1 y 3 | `(a|b)` | a o b |
| `^` | Inicio | `$` | Final |

```html
<!-- Código postal de 5 cifras -->
<input type="text" id="cp" name="cp" pattern="[0-9]{5}" required>

<!-- DNI: 8 cifras y una letra -->
<input type="text" id="dni" name="dni" pattern="[0-9]{8}[A-Za-z]" required>

<!-- Teléfono español: empieza por 6, 7, 8 o 9 y tiene 9 cifras -->
<input type="tel" id="tel" name="tel" pattern="[6-9][0-9]{8}">

<!-- Fecha AAAA-MM-DD -->
<input type="text" id="fecha" name="fecha" pattern="\d{4}-\d{2}-\d{2}">
```

## 8.10. Ejercicio resuelto: formulario de matrícula

<div class="ejercicio">

### Ejercicio 14 · Formulario completo

Escribe un formulario de matrícula con: nombre y apellidos obligatorios, correo, fecha de nacimiento, modalidad (desplegable), cuatro módulos (casillas), observaciones y botón de envío. Agrupa los módulos en un `fieldset` y usa `label` en todos los campos.

**Solución**

```html
<h1>Matrícula en el ciclo DAW</h1>

<form action="#" method="post">
  <label for="nombre">Nombre</label>
  <input type="text" id="nombre" name="nombre" required>

  <label for="apellidos">Apellidos</label>
  <input type="text" id="apellidos" name="apellidos" required>

  <label for="email">Correo electrónico</label>
  <input type="email" id="email" name="email" required>

  <label for="fecha">Fecha de nacimiento</label>
  <input type="date" id="fecha" name="fecha">

  <label for="modalidad">Modalidad</label>
  <select id="modalidad" name="modalidad">
    <option value="presencial">Presencial</option>
    <option value="semipresencial">Semipresencial</option>
    <option value="distancia">A distancia</option>
  </select>

  <fieldset>
    <legend>Módulos matriculados</legend>

    <label>
      <input type="checkbox" name="modulo" value="dwec" checked> DWEC
    </label>
    <label>
      <input type="checkbox" name="modulo" value="dwes" checked> DWES
    </label>
    <label>
      <input type="checkbox" name="modulo" value="diw" checked> DIW
    </label>
    <label>
      <input type="checkbox" name="modulo" value="despliegue" checked> Despliegue
    </label>
  </fieldset>

  <label for="observaciones">Observaciones</label>
  <textarea id="observaciones" name="observaciones" rows="3"></textarea>

  <button type="submit">Enviar solicitud</button>
</form>
```

**Por qué está bien:** cada campo tiene `id` y `name`, cada `label` tiene su `for`, los checkbox comparten el mismo `name` y llevan `value`, los módulos van agrupados en `fieldset` con `legend` y el formulario usa `post`.

</div>

## 8.11. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<label name="x">` | No se ata al campo | `<label for="x">` + `id="x"` |
| Campo sin `name` | No se envía al servidor | Añadir `name` |
| `method="get"` con contraseña | La contraseña se ve en la URL | `method="post"` |
| `placeholder` en vez de `label` | Desaparece al escribir | Los dos |
| Varios `radio` con distinto `name` | Se pueden marcar todos | Mismo `name` |
| `checkbox` sin `value` | Llega `on`, no sabes qué era | `value="..."` |
| `type="text"` para contraseña | Se ve la contraseña | `type="password"` |
| `<textarea>` sin cierre | Se rompe el formulario | `</textarea>` |
| `for="mail"` e `id="correo"` | No coinciden | Mismo valor |
| Anidar un `form` dentro de otro | Prohibido | Un solo `form` |

# 9. Contenido incrustado {#sec9}

## 9.1. Etiquetas

| Etiqueta | Para qué |
|---|---|
| `<img>` | Imagen (vacía) |
| `<iframe>` | Otra página HTML dentro de la tuya (YouTube, Google Maps) |
| `<video>` | Vídeo |
| `<audio>` | Sonido |
| `<source>` | Archivos alternativos para vídeo o audio |
| `<track>` | Subtítulos de un vídeo |
| `<embed>` / `<object>` | Contenido externo o de plugins |
| `<canvas>` | Lienzo para dibujar con JavaScript |
| `<svg>` | Imagen vectorial; no pierde calidad al ampliarla |

## 9.2. `iframe`: YouTube y Google Maps

```html
<iframe width="560" height="315"
        src="https://www.youtube.com/embed/ID_DEL_VIDEO"
        title="Vídeo de presentación"
        allowfullscreen></iframe>
```

- `src` es la dirección de la página que se incrusta.
- En YouTube: **Compartir → Insertar** y se copia el `iframe` entero.
- En Google Maps: **Compartir → Insertar un mapa** y se copia el HTML.
- `title` describe el contenido del marco (accesibilidad).
- `allowfullscreen` permite verlo a pantalla completa.

## 9.3. `video` y `audio`

```html
<video width="320" height="240" controls autoplay muted loop
       poster="img/portada.jpg">
  <source src="video/peli.mp4" type="video/mp4">
  <source src="video/peli.ogg" type="video/ogg">
  Tu navegador no soporta vídeo.
</video>

<audio controls>
  <source src="audio/cancion.mp3" type="audio/mpeg">
  <source src="audio/cancion.ogg" type="audio/ogg">
</audio>
```

| Atributo | Qué hace |
|---|---|
| `controls` | Muestra los controles (play, pausa, volumen) |
| `autoplay` | Empieza solo; en muchos navegadores exige `muted` |
| `muted` | Sin sonido |
| `loop` | Se repite al terminar |
| `poster` | Imagen que se ve antes de reproducir (solo vídeo) |
| `width` / `height` | Tamaño del reproductor |

Los formatos habituales son MP4, WebM y Ogg. Se ponen varios `<source>` para que el navegador elija el que entiende. El texto final ("Tu navegador no soporta vídeo") es el contenido alternativo.

```html
<video controls>
  <source src="video/algeciras.mp4" type="video/mp4">
  <track src="subs/es.vtt" kind="subtitles" srclang="es" label="Español">
  <track src="subs/en.vtt" kind="subtitles" srclang="en" label="English">
</video>
```

`<track>` añade subtítulos. `kind="subtitles"`, `srclang` con el idioma y `label` con el nombre que se ve en el menú.

## 9.4. `svg`, `canvas`, `embed` y `object`

```html
<!-- SVG: dibujo vectorial escrito con etiquetas -->
<svg width="100" height="100">
  <circle cx="50" cy="50" r="40" fill="blue"></circle>
</svg>

<!-- Canvas: lienzo que se dibuja con JavaScript -->
<canvas id="lienzo" width="300" height="200"></canvas>

<!-- Contenido externo -->
<embed src="documento.pdf" type="application/pdf" width="600" height="400">
```

`svg` es una imagen vectorial: se puede ampliar sin que se vea pixelada. `canvas` está vacío hasta que JavaScript dibuja dentro. `embed` y `object` son la forma antigua de incrustar contenido; hoy casi todo se hace con `iframe`, `video` o `svg`.

<div class="ejercicio">

### Ejercicio 15 · Vídeo con dos formatos y subtítulos

Escribe un vídeo de 640 × 360 con controles, una imagen de portada y dos formatos. Añade subtítulos en español e inglés.

**Solución**

```html
<video width="640" height="360" controls poster="img/portada.jpg">
  <source src="video/algeciras.mp4" type="video/mp4">
  <source src="video/algeciras.webm" type="video/webm">
  <track src="subs/es.vtt" kind="subtitles" srclang="es" label="Español">
  <track src="subs/en.vtt" kind="subtitles" srclang="en" label="English">
  Tu navegador no soporta vídeo.
</video>
```

</div>

## 9.5. Errores típicos

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `<img>` sin `alt` | Falla la accesibilidad | `alt="..."` |
| `<video>` sin `controls` | No se puede reproducir | `controls` |
| `autoplay` sin `muted` | El navegador lo bloquea | `autoplay muted` |
| `<source>` fuera de `video`/`audio` | No hace nada | Dentro del reproductor |
| `iframe` sin `title` | Marco sin descripción | `title="..."` |
| Ruta `C:\video\a.mp4` | No funciona en la web | `video/a.mp4` |

# 10. El CSS que acompaña al HTML {#sec10}

> El examen es de HTML, pero los ejercicios del curso son "HTML con estilos". Este apartado es el mínimo que hay que saber para no quedarse bloqueado.

## 10.1. Dónde va el CSS

```html
<!-- 1. Externo: en el head, la forma recomendada -->
<link rel="stylesheet" href="css/estilos.css">

<!-- 2. Interno: dentro de style, en el head -->
<style>
  body { font-family: Arial, sans-serif; }
</style>

<!-- 3. En línea: en el atributo style de una etiqueta -->
<p style="color: red;">Texto rojo</p>
```

| Forma | Dónde | Cuándo se usa |
|---|---|---|
| Externa | Archivo `.css` enlazado con `link` | Lo normal en un proyecto |
| Interna | `<style>` en el `head` | Un ejercicio de un solo archivo |
| En línea | `style="..."` en la etiqueta | Un cambio puntual; se evita |

## 10.2. Selectores

| Selector | Qué selecciona | Ejemplo |
|---|---|---|
| `etiqueta` | Todas las etiquetas de ese tipo | `p { ... }` |
| `.clase` | Todos los elementos con esa clase | `.tarjeta { ... }` |
| `#id` | El elemento con ese id | `#contacto { ... }` |
| `a:hover` | Cuando el ratón está encima | `a:hover { ... }` |
| `h1, h2` | Varios selectores a la vez | `h1, h2 { ... }` |
| `nav a` | Los `a` dentro de `nav` | `nav a { ... }` |

```css
body {
  font-family: Arial, sans-serif;
  margin: 0;
  color: #222222;
}

h1 {
  color: #0b4f6c;
  text-align: center;
}

.tarjeta {
  border: 1px solid #cccccc;
  padding: 10px;
}

a:hover {
  color: #e0a800;
}
```

## 10.3. El modelo de caja

Todo elemento es una caja con cuatro capas:

<div class="keep">

```text
┌─────────────────────────────┐
│           margin            │
│  ┌───────────────────────┐  │
│  │        border         │  │
│  │  ┌─────────────────┐  │  │
│  │  │    padding      │  │  │
│  │  │  ┌───────────┐  │  │  │
│  │  │  │ contenido │  │  │  │
│  │  │  └───────────┘  │  │  │
│  │  └─────────────────┘  │  │
│  └───────────────────────┘  │
└─────────────────────────────┘
```

</div>

| Propiedad | Qué controla |
|---|---|
| `width` / `height` | Tamaño del contenido |
| `padding` | Espacio interior, entre el contenido y el borde |
| `border` | Borde |
| `margin` | Espacio exterior, entre la caja y las demás |

```css
* {
  box-sizing: border-box;   /* el ancho incluye padding y borde */
}
```

Sin `box-sizing: border-box`, un elemento de `width: 200px` con `padding: 10px` mide 220 px reales. Con él, mide 200 px y el padding va dentro. Es la primera línea de casi cualquier hoja de estilos.

## 10.4. Propiedades de texto y color

```css
p {
  font-family: Georgia, serif;
  font-size: 1rem;
  line-height: 1.5;
  color: #333333;
  text-align: justify;
}

.destacado {
  background-color: #fff3cd;
  font-weight: bold;
  text-decoration: underline;
}
```

| Propiedad | Valores habituales |
|---|---|
| `color` | Color del texto (`#rrggbb`, `rgb()`, nombre) |
| `background-color` | Color de fondo |
| `font-family` | Tipo de letra |
| `font-size` | Tamaño (`px`, `rem`, `em`) |
| `font-weight` | `normal`, `bold`, `400`, `700` |
| `font-style` | `normal`, `italic` |
| `text-align` | `left`, `center`, `right`, `justify` |
| `text-decoration` | `none`, `underline`, `line-through` |
| `line-height` | Altura de línea (sin unidad, por ejemplo `1.5`) |

## 10.5. `display`: cambiar el comportamiento

```css
span   { display: block; }
div    { display: inline; }
.caja  { display: inline-block; }
.fila  { display: flex; }
.rejilla { display: grid; }
.oculto { display: none; }
```

| Valor | Comportamiento |
|---|---|
| `block` | Ocupa una línea entera |
| `inline` | Fluye con el texto |
| `inline-block` | Fluye con el texto, pero acepta ancho y alto |
| `flex` | Coloca los hijos en fila o columna |
| `grid` | Coloca los hijos en una rejilla |
| `none` | Lo oculta y lo saca del flujo |

## 10.6. Centrar cosas

```css
/* Centrar texto */
.texto { text-align: center; }

/* Centrar un bloque con ancho */
.caja {
  width: 600px;
  margin: 0 auto;
}

/* Centrar una imagen */
img.centrada {
  display: block;
  margin: 0 auto;
}

/* Centrar con Flexbox */
.contenedor {
  display: flex;
  justify-content: center;
  align-items: center;
}
```

`text-align: center` centra el contenido en línea (texto, imágenes, `inline-block`). `margin: 0 auto` centra un bloque que tiene ancho. `display: flex` + `justify-content: center` centra los hijos.

## 10.7. CSS de tablas

```css
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #999999;
  padding: 8px 12px;
  text-align: left;
}

thead th {
  background-color: #e3edf6;
  text-align: center;
}

tbody tr:nth-child(even) {
  background-color: #f7fafc;
}
```

`nth-child(even)` pinta una fila sí y otra no (filas cebra). Se lee: "los hijos pares".

## 10.8. CSS de imágenes en fila

```css
/* Opción 1: inline-block */
.galeria { text-align: center; }
.galeria figure { display: inline-block; width: 220px; margin: 8px; vertical-align: top; }
.galeria img { width: 100%; height: 150px; object-fit: cover; }

/* Opción 2: flex */
.galeria { display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; }
.galeria figure { width: 220px; margin: 0; }

/* Opción 3: grid */
.galeria { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
```

## 10.9. Media query: el móvil

```css
@media (max-width: 600px) {
  header {
    flex-direction: column;
    text-align: center;
  }

  .galeria {
    grid-template-columns: 1fr;
  }

  table {
    font-size: 0.8rem;
  }
}
```

Se lee: "cuando la pantalla mida 600 px o menos, aplica estas reglas". Es lo que hace que la página se vea bien en el móvil.

## 10.10. Variables

```css
:root {
  --color-primario: #0b4f6c;
  --color-acento: #e0a800;
  --espacio: 1rem;
}

h1 {
  color: var(--color-primario);
}

.boton {
  background-color: var(--color-primario);
  padding: var(--espacio);
}
```

Se declaran en `:root` y se usan con `var(--nombre)`. Sirven para no repetir el mismo color veinte veces.

## 10.11. Errores típicos de CSS

| ❌ Mal | 💥 Qué pasa | ✅ Bien |
|---|---|---|
| `color: #GGG` | Color inválido | `#333` o `#333333` |
| `margin: auto` sin `width` | No centra | Añadir `width` |
| `text-align: center` en `table` | No centra la tabla | `margin: 0 auto` |
| `border: 1` | Falta estilo y color | `border: 1px solid #999` |
| `padding: 10` | Falta unidad | `padding: 10px` |
| Olvidar `;` | La regla siguiente se rompe | Poner `;` |
| `#id` para todo | Difícil de reutilizar | Clases |
| `!important` para arreglar | Guerra de estilos | Selector más específico |

# 11. Simulacro de examen resuelto {#sec11}

> El examen son dos ejercicios de desarrollo en hoja en blanco. Uno suele parecerse a los ejercicios del trabajo de estilos. Aquí tienes dos enunciados completos con su solución y su clave de corrección.

## 11.1. Ejercicio A · Página de un club deportivo

<div class="ejercicio">

### Enunciado

Escribe el código completo de la página de inicio de un club de pádel llamado **Club Pádel Sur**. Debe incluir:

- Documento HTML5 completo, en español, con `charset`, `viewport` y título.
- Cabecera con el nombre del club y un menú con tres enlaces (Inicio, Horarios, Inscripción).
- Sección "Quiénes somos" con un párrafo y una imagen con texto alternativo.
- Sección "Horarios" con una tabla: Día, Hora, Pista y Nivel. Debe tener título, cabecera y una fila de descanso que ocupe las cuatro columnas.
- Sección "Inscripción" con un formulario: nombre, correo, nivel (desplegable), turno (dos radios) y una casilla de aceptación.
- Pie con la dirección y el copyright.

### Solución

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Pádel Sur | Algeciras</title>
</head>
<body>

  <header>
    <h1>Club Pádel Sur</h1>
    <nav>
      <ul>
        <li><a href="#quienes">Quiénes somos</a></li>
        <li><a href="#horarios">Horarios</a></li>
        <li><a href="#inscripcion">Inscripción</a></li>
      </ul>
    </nav>
  </header>

  <main>

    <section id="quienes">
      <h2>Quiénes somos</h2>
      <p>
        El <strong>Club Pádel Sur</strong> es un club de Algeciras con cuatro
        pistas de pádel y clases para todos los niveles.
      </p>
      <img src="img/pistas.jpg" alt="Pistas de pádel del Club Pádel Sur">
    </section>

    <section id="horarios">
      <h2>Horarios</h2>
      <table>
        <caption>Horario de pistas - temporada 2026/2027</caption>
        <thead>
          <tr>
            <th scope="col">Día</th>
            <th scope="col">Hora</th>
            <th scope="col">Pista</th>
            <th scope="col">Nivel</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Lunes</th>
            <td>18:00</td>
            <td>1</td>
            <td>Iniciación</td>
          </tr>
          <tr>
            <th scope="row">Martes</th>
            <td>19:00</td>
            <td>2</td>
            <td>Intermedio</td>
          </tr>
          <tr>
            <td colspan="4">Descanso: mantenimiento de pistas</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section id="inscripcion">
      <h2>Inscripción</h2>
      <form action="inscribir.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" required>

        <label for="nivel">Nivel</label>
        <select id="nivel" name="nivel">
          <option value="">-- Elige uno --</option>
          <option value="iniciacion">Iniciación</option>
          <option value="intermedio">Intermedio</option>
          <option value="avanzado">Avanzado</option>
        </select>

        <fieldset>
          <legend>Turno preferido</legend>
          <input type="radio" id="manana" name="turno" value="manana" required>
          <label for="manana">Mañana</label>
          <input type="radio" id="tarde" name="turno" value="tarde">
          <label for="tarde">Tarde</label>
        </fieldset>

        <input type="checkbox" id="acepto" name="acepto" value="si" required>
        <label for="acepto">Acepto las normas del club</label>

        <button type="submit">Enviar inscripción</button>
      </form>
    </section>

  </main>

  <footer>
    <address>
      Calle de la Playa, 10<br>
      11201 Algeciras (Cádiz)<br>
      <a href="mailto:info@clubpadelsur.es">info@clubpadelsur.es</a>
    </address>
    <p>© 2026 Club Pádel Sur</p>
  </footer>

</body>
</html>
```

### Clave de corrección

| Punto | Qué se comprueba |
|---|---|
| Documento | DOCTYPE, `lang="es"`, `charset`, `viewport`, `title` |
| Semántica | `header`, `nav`, `main`, `section`, `footer`; un solo `main` y un solo `h1` |
| Navegación | Lista dentro de `nav` y enlaces con `#` a los `id` de las secciones |
| Imagen | `src` y `alt` descriptivo |
| Tabla | `caption`, `thead`, `tbody`, `th` con `scope`, `colspan="4"` correcto |
| Formulario | `action`, `method="post"`, `label` con `for`, `id` y `name` en todos los campos, radios con el mismo `name` |
| Cierre | Todas las etiquetas cerradas y bien anidadas |

</div>

## 11.2. Ejercicio B · Galería y tabla de cuotas

<div class="ejercicio">

### Enunciado

Escribe una página con:

- Un `h1` centrado.
- Una galería de cuatro fotos en fila, cada una con su pie. Todas del mismo tamaño y centradas.
- Una tabla de cuotas con las columnas "Modalidad", "Matrícula" y "Cuota mensual". La cabecera "Cuotas" debe ocupar las tres columnas. La modalidad "Socio" debe ocupar dos filas. La tabla debe estar centrada y los números alineados a la derecha.
- Los estilos necesarios dentro de `<style>`.

### Solución

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instalaciones y cuotas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h1 {
      text-align: center;
    }
    .galeria {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 16px;
    }
    .galeria figure {
      width: 220px;
      margin: 0;
    }
    .galeria img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }
    .galeria figcaption {
      text-align: center;
      font-size: 0.9rem;
    }
    table {
      width: 70%;
      margin: 0 auto;
      border-collapse: collapse;
    }
    caption {
      caption-side: top;
      text-align: center;
      font-weight: bold;
      padding: 8px;
    }
    th, td {
      border: 1px solid #999;
      padding: 8px 12px;
    }
    thead th {
      background-color: #e3edf6;
      text-align: center;
    }
    td.numero {
      text-align: right;
    }
  </style>
</head>
<body>

  <h1>Instalaciones y cuotas</h1>

  <div class="galeria">
    <figure>
      <img src="img/pista1.jpg" alt="Pista central de pádel">
      <figcaption>Pista central</figcaption>
    </figure>
    <figure>
      <img src="img/pista2.jpg" alt="Pista cubierta de pádel">
      <figcaption>Pista cubierta</figcaption>
    </figure>
    <figure>
      <img src="img/vestuarios.jpg" alt="Vestuarios del club">
      <figcaption>Vestuarios</figcaption>
    </figure>
    <figure>
      <img src="img/cafeteria.jpg" alt="Cafetería del club">
      <figcaption>Cafetería</figcaption>
    </figure>
  </div>

  <table>
    <caption>Cuotas temporada 2026/2027</caption>
    <thead>
      <tr>
        <th colspan="3">Cuotas</th>
      </tr>
      <tr>
        <th scope="col">Modalidad</th>
        <th scope="col">Matrícula</th>
        <th scope="col">Cuota mensual</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row" rowspan="2">Socio</th>
        <td class="numero">30 €</td>
        <td class="numero">25 €</td>
      </tr>
      <tr>
        <td class="numero">0 €</td>
        <td class="numero">20 €</td>
      </tr>
      <tr>
        <th scope="row">No socio</th>
        <td class="numero">50 €</td>
        <td class="numero">40 €</td>
      </tr>
    </tbody>
  </table>

</body>
</html>
```

### Clave de corrección

| Punto | Qué se comprueba |
|---|---|
| Galería | Cuatro `figure` con `img` + `figcaption`, `alt` correcto, mismo tamaño con `object-fit: cover` |
| Fila | `display: flex` + `flex-wrap` + `gap`, o `inline-block`; el conjunto centrado |
| Tabla | `caption`, dos filas en `thead` (una con `colspan="3"`), `th` con `scope` |
| `rowspan` | "Socio" ocupa dos filas y la segunda fila lleva solo dos `td` |
| Alineación | Tabla centrada con `width` + `margin: 0 auto`; números con `text-align: right` |
| Bordes | `border-collapse: collapse` y `border` en `th` y `td` |

</div>

## 11.3. Checklist antes de entregar

- [ ] ¿Está el `<!DOCTYPE html>` en la primera línea?
- [ ] ¿Hay `lang="es"`, `charset`, `viewport` y `title`?
- [ ] ¿Hay un solo `h1` y un solo `main`?
- [ ] ¿Todos los encabezados siguen el orden `h1` → `h2` → `h3`?
- [ ] ¿Todas las imágenes tienen `alt`?
- [ ] ¿Todos los enlaces tienen `href`?
- [ ] ¿Las tablas tienen `caption`, `thead`, `tbody` y `th` con `scope`?
- [ ] ¿Las filas de la tabla suman las mismas columnas?
- [ ] ¿Todos los campos del formulario tienen `label`, `id` y `name`?
- [ ] ¿Los radios del mismo grupo comparten `name`?
- [ ] ¿Están todas las etiquetas cerradas y bien anidadas?
- [ ] ¿Has usado `post` si hay contraseñas o datos personales?

# 12. Rellenar huecos {#sec12}

> Tapa la columna de soluciones y contesta en papel. Luego comprueba.

1. La primera línea de un documento HTML5 es ______.
2. El título de la pestaña se escribe con `<____>` dentro de `<____>`.
3. Para que se vean bien las tildes y las eñes: `<meta ______="UTF-8">`.
4. Para enlazar una hoja CSS externa: `<link href="estilos.css" ____="stylesheet">`.
5. El contenido principal va en `<____>`, y solo puede haber uno.
6. El menú de navegación va dentro de `<____>`.
7. Una barra lateral es `<____>`; un contenido independiente como un post es `<____>`.
8. Las etiquetas no semánticas son `<____>` (bloque) y `<____>` (en línea).
9. Una lista ordenada con letras mayúsculas que empieza en la C: `<ol type="__" start="__">`.
10. Una lista sin orden con cuadrados: `<ul type="______">`.
11. En una lista de definiciones, el término va en `<__>` y la definición en `<__>`, todo dentro de `<__>`.
12. El pie de foto de un `figure` es `<__________>`.
13. Para que el texto mantenga los espacios y los saltos de línea se usa `<___>`.
14. H₂O se escribe `H<___>2</___>O`.
15. Para que un enlace se abra en una pestaña nueva: `<a href="…" ______="_____">`.
16. Un enlace para enviar un correo: `<a href="______:info@web.com">`.
17. Para escribir el símbolo `<` se usa la entidad ______; para `©`, ______.
18. Un enlace que lleva a la sección `<h2 id="contacto">`: `<a href="______">`.
19. Para llevar a esa sección desde otra página: `<a href="index.html______">`.
20. Una fila de una tabla es `<__>`, una celda de cabecera es `<__>` y una de datos es `<__>`.
21. Para que una celda ocupe 3 columnas: `<td ______="3">`. Para que ocupe 2 filas: `<td ______="2">`.
22. El título de una tabla se pone con `<_______>`.
23. `<form ______="enviar.php" ______="post">`.
24. El método que muestra los datos en la URL es ____; el que los oculta es ____.
25. `<label ___="usuario">` se asocia con `<input ___="usuario">`.
26. Para agrupar campos se usa `<________>`, y su título es `<______>`.
27. Para que un campo sea obligatorio se añade el atributo ________.
28. El texto gris de ayuda dentro de un `input` es el atributo ___________.
29. Para que el cursor aparezca en un campo al cargar la página: _________.
30. Para elegir una sola opción de un grupo se usa `type="_____"`, y todas las opciones deben tener el mismo ____.
31. Una barra deslizante de 0 a 10: `<input type="_____" ___="0" ___="10">`.
32. Una opción marcada de inicio en un `select` lleva ________; un `checkbox` marcado de inicio lleva _______.
33. Un código postal de 5 cifras: `pattern="______"`.
34. Un campo de texto de varias líneas: `<________ rows="5" cols="30"></________>`.
35. Un `input` con sugerencias: `<input ____="ciudades">` + `<________ id="ciudades">`.
36. Una imagen con texto alternativo: `<img ___="foto.jpg" ___="Descripción">`.
37. Un vídeo con controles y dos formatos: `<video ________><______ src="v.mp4" type="video/mp4"></video>`.
38. Para insertar un vídeo de YouTube o un mapa de Google se usa `<______>`.
39. Para centrar una tabla con ancho: `table { width: 80%; ______: 0 auto; }`.
40. Para poner figuras en fila sin Flexbox: `figure { display: ____________; }`.

## Soluciones

| N.º | Solución | N.º | Solución |
|---|---|---|---|
| 1 | `<!DOCTYPE html>` | 21 | `colspan` / `rowspan` |
| 2 | `title` / `head` | 22 | `caption` |
| 3 | `charset` | 23 | `action` / `method` |
| 4 | `rel` | 24 | GET / POST |
| 5 | `main` | 25 | `for` / `id` |
| 6 | `nav` | 26 | `fieldset` / `legend` |
| 7 | `aside` / `article` | 27 | `required` |
| 8 | `div` / `span` | 28 | `placeholder` |
| 9 | `A` / `3` | 29 | `autofocus` |
| 10 | `square` | 30 | `radio` / `name` |
| 11 | `dt` / `dd` / `dl` | 31 | `range` / `min` / `max` |
| 12 | `figcaption` | 32 | `selected` / `checked` |
| 13 | `pre` | 33 | `[0-9]{5}` o `\d{5}` |
| 14 | `sub` | 34 | `textarea` |
| 15 | `target` / `_blank` | 35 | `list` / `datalist` |
| 16 | `mailto` | 36 | `src` / `alt` |
| 17 | `&lt;` / `&copy;` | 37 | `controls` / `source` |
| 18 | `#contacto` | 38 | `iframe` |
| 19 | `#contacto` | 39 | `margin` |
| 20 | `tr` / `th` / `td` | 40 | `inline-block` |

# 13. Busca el error {#sec13}

> Cada fragmento tiene al menos un fallo. Corrígelo y explica por qué.

**1. Anidamiento**

```html
<p><strong>Hola</p></strong>
```

Error: las etiquetas se cruzan. Corrección: `<p><strong>Hola</strong></p>`.

**2. Lista sin cerrar**

```html
<ul><li>Uno<li>Dos</ul>
```

Error: faltan los `</li>`. Corrección: `<ul><li>Uno</li><li>Dos</li></ul>`.

**3. Imagen**

```html
<img src="a.jpg"></img>
```

Error: `img` es vacía y no lleva cierre; además falta `alt`. Corrección: `<img src="a.jpg" alt="Descripción">`.

**4. Tabla sin fila**

```html
<table><td>Dato</td></table>
```

Error: una celda no puede ir suelta dentro de `table`; falta `tr`. Corrección: `<table><tr><td>Dato</td></tr></table>`.

**5. `label` que no coincide**

```html
<label for="mail">Email</label>
<input type="email" id="correo">
```

Error: `for` y `id` no coinciden. Corrección: `for="correo"` o `id="mail"`, pero el mismo valor en los dos.

**6. Ancla sin almohadilla**

```html
<a href="seccion2">Ir</a>
```

Error: falta `#`; así busca una página llamada `seccion2`. Corrección: `<a href="#seccion2">Ir</a>`.

**7. Enlace externo sin protocolo**

```html
<a href="www.eniun.com">Eniun</a>
```

Error: falta `https://`. Corrección: `<a href="https://www.eniun.com">Eniun</a>`.

**8. Salto de nivel**

```html
<h1>Título</h1>
<h3>Apartado</h3>
```

Error: de `h1` se pasa a `h2`, no a `h3`. Corrección: `<h2>Apartado</h2>`.

**9. Bloque dentro de párrafo**

```html
<p>Texto <div>bloque</div> más texto</p>
```

Error: un `div` es de bloque y no va dentro de un `p`. Corrección: cerrar el párrafo antes del `div`.

**10. Formulario con contraseña y GET**

```html
<form action="login.php" method="get">
  <input type="password" id="pass" name="pass">
</form>
```

Error: con `get`, la contraseña se ve en la URL. Corrección: `method="post"`.

**11. Atributos obsoletos**

```html
<table border="1" align="center">
```

Error: `border` y `align` están obsoletos. Corrección: quitar los atributos y usar CSS (`border-collapse`, `border`, `margin: 0 auto`).

**12. `alt` que repite el archivo**

```html
<img src="logo.png" alt="logo.png">
```

Error: el `alt` debe describir la imagen, no repetir el nombre. Corrección: `alt="Logotipo de la empresa"`.

**13. `rowspan` mal contado**

```html
<tr>
  <td rowspan="2">Socio</td>
  <td>30 €</td>
  <td>25 €</td>
</tr>
<tr>
  <td>0 €</td>
  <td>20 €</td>
  <td>30 €</td>
</tr>
```

Error: la segunda fila tiene tres celdas, pero la primera columna ya está ocupada por el `rowspan`. Corrección: dejar solo dos `td` en la segunda fila.

**14. Radios con distinto `name`**

```html
<input type="radio" id="a" name="turno1" value="manana">
<input type="radio" id="b" name="turno2" value="tarde">
```

Error: al tener distinto `name`, no forman un grupo y se pueden marcar los dos. Corrección: mismo `name="turno"`.

**15. Vídeo sin controles**

```html
<video autoplay src="v.mp4"></video>
```

Error: falta `controls` y, en muchos navegadores, `autoplay` sin `muted` se bloquea. Corrección: `<video controls autoplay muted>` y, si hay varios formatos, `<source>` dentro.

**16. `textarea` con `value`**

```html
<textarea value="Hola"></textarea>
```

Error: `textarea` no usa `value`; el contenido va entre las etiquetas. Corrección: `<textarea>Hola</textarea>`.

# 14. Chuleta final {#sec14}

<div class="chuleta">

## Documento mínimo

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Título</title>
</head>
<body>
  <h1>Título visible</h1>
  <p>Contenido.</p>
</body>
</html>
```

</div>

<div class="chuleta">

## Etiquetas que hay que distinguir

| Vacías (sin cierre) | Una sola vez | Semánticas | En línea |
|---|---|---|---|
| `br`, `hr`, `img`, `input`, `meta`, `link`, `source`, `wbr` | `body`, `h1`, `main` | `header`, `nav`, `main`, `section`, `article`, `aside`, `footer` | `a`, `span`, `strong`, `em`, `b`, `i`, `code`, `label` |

</div>

<div class="chuleta">

## Receta de tabla

```html
<table>
  <caption>Título</caption>
  <thead>
    <tr>
      <th scope="col">Columna 1</th>
      <th scope="col">Columna 2</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Fila 1</th>
      <td>Dato</td>
    </tr>
  </tbody>
</table>
```

- `colspan="n"` = horizontal. `rowspan="n"` = vertical.
- Cada fila suma las mismas columnas.
- Si arriba hay un `rowspan="2"`, la fila siguiente lleva una celda menos.
- Centrar la tabla: `width` + `margin: 0 auto`.
- Números: `text-align: right`. Cabeceras: `text-align: center`.
- Bordes: `border-collapse: collapse` + `border: 1px solid #999`.

</div>

<div class="chuleta">

## Receta de formulario

```html
<form action="enviar.php" method="post">
  <label for="nombre">Nombre</label>
  <input type="text" id="nombre" name="nombre" required>
  <button type="submit">Enviar</button>
</form>
```

- `label for` = `input id`.
- `name` es lo que llega al servidor; sin `name` no se envía.
- Radios del mismo grupo: mismo `name`.
- Contraseñas y datos personales: `post`.
- `required`, `placeholder`, `autofocus`, `min`, `max`, `pattern`.

</div>

<div class="chuleta">

## Receta de imágenes en fila

```css
/* Opción corta: inline-block */
.galeria { text-align: center; }
.galeria figure { display: inline-block; width: 220px; margin: 8px; vertical-align: top; }
.galeria img { width: 100%; height: 150px; object-fit: cover; }

/* Opción moderna: flex */
.galeria { display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; }
```

- `figure` + `figcaption` para imagen con pie.
- `object-fit: cover` para que todas midan lo mismo sin deformarse.
- `alt` siempre.

</div>

<div class="chuleta">

## Enlaces, entidades y errores que restan puntos

| Enlace | Código |
|---|---|
| Otra página | `<a href="contacto.html">` |
| Pestaña nueva | `<a href="..." target="_blank" rel="noopener noreferrer">` |
| Ancla | `<a href="#contacto">` + `<h2 id="contacto">` |
| Correo | `<a href="mailto:info@web.com">` |
| Teléfono | `<a href="tel:+34600111222">` |
| Descarga | `<a href="cv.pdf" download>` |

| Entidad | Código |
|---|---|
| `<` | `&lt;` |
| `>` | `&gt;` |
| `&` | `&amp;` |
| `©` | `&copy;` |
| `€` | `&euro;` |
| Espacio fijo | `&nbsp;` |

**Errores que restan puntos:** olvidar el DOCTYPE · dos `h1` · imagen sin `alt` · `label` sin `for` · `for` e `id` distintos · radio con distinto `name` · tabla sin `tr` · `colspan` mal contado · `border="1"` · `align="center"` · `href` sin `#` · `<img></img>` · `<p>` dentro de `<p>` · contraseña con `get`.

</div>

# 15. Recursos y temario {#sec15}

## 15.1. Enlaces del Tema 2 en Moodle

| Recurso | Enlace |
|---|---|
| HTML: etiquetas de contenido | https://www.eniun.com/etiquetas-contenido-texto-html/ |
| HTML: elementos semánticos | https://www.eniun.com/html5-estructura-basica-elementos-semanticos/ |
| HTML: tablas | https://www.eniun.com/etiquetas-tablas-contenido-html5/ |
| HTML: formularios | https://www.eniun.com/etiquetas-formularios-html5/ |
| HTML: ejercicios resueltos | https://www.eniun.com/ejercicios-resueltos-html/ |
| CSS: tipos de selectores | https://www.eniun.com/selectores-css-tipos/ |
| CSS: propiedades de tablas | https://www.eniun.com/atributos-propiedades-tablas-css/ |

## 15.2. Archivos del curso que amplían cada apartado

| Apartado | Archivo |
|---|---|
| Estructura y etiquetas | `apuntes\HTML\02 - La estructura mínima de un documento HTML.md` |
| Texto y listas | `apuntes\HTML\03 - Etiquetas de contenido y organización del texto.md` |
| Enlaces e imágenes | `apuntes\HTML\04 - Enlaces e imágenes.md` |
| Semántica | `apuntes\HTML\05 - Elementos semánticos.md` |
| Tablas | `apuntes\HTML\06 - Tablas en HTML.md` |
| Formularios | `apuntes\HTML\07 - Formularios.md` |
| CSS | `apuntes\HTML\08` y `09` |
| Página completa | `apuntes\HTML\10 - Práctica guiada, página completa.md` |
| Ejercicios con estilos | `Tema 2 - HTML y CSS\Ejercicios de HTML con estilos\` |
| Ocho ejemplos originales | `Diseño Interfaces Web_ HTML nivel medio_ ocho ejemplos (1).pdf` |

## 15.3. Correspondencia con los nueve ejercicios del curso

| Ejercicio | Qué practica | Apartado de este cuadernillo |
|---|---|---|
| 1. Noticia | Títulos, párrafos, listas, cita, `span` | 4 |
| 2. Formulario de matrícula | `form`, `label`, `input`, `select`, `textarea` | 8 |
| 3. Tabla de horarios | `table`, `caption`, `thead`, `tbody`, `colspan` | 7 |
| 4. Galería | `figure`, `figcaption`, `img` en fila | 5 |
| 5. Vídeo | `video`, `source`, `track`, `poster` | 9 |
| 6. Página 404 | Enlaces y estructura mínima | 3 y 5 |
| 7. Tarjetas | `div`, clases, `inline-block` | 2 y 10 |
| 8. Landing | `header`, `nav`, `main`, `footer` | 6 |
| 9. Línea del tiempo | `ol`, `li`, `dl`, `dt`, `dd` | 4 |

<div class="regla">

**Último consejo para el examen:** antes de escribir, haz un esquema de bloques en el margen (cabecera, menú, contenido, pie) y, si hay tabla, dibuja la rejilla y cuenta las celdas. Se tarda un minuto y ahorra media hora de tachones.

</div>

