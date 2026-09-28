# 05 · Elementos semánticos

> La diferencia entre una web "que funciona" y una web "que está bien hecha". Y se puntúa.

---

## El problema que resuelven

Todo HTML antiguo se hacía así:

```html
<div class="cabecera">
    <div class="logo">MiWeb</div>
    <div class="menu">
        <div class="item">Inicio</div>
        <div class="item">Sobre mí</div>
    </div>
</div>

<div class="contenido">
    <div class="titulo">Bienvenido</div>
    <div class="texto">Aquí va el contenido...</div>
</div>

<div class="pie">© 2026</div>
```

Funciona. Se ve igual. Pero es una **montaña de `div` sin significado**.
Ahora lee ese código en voz alta: *div, div, div, div, div...* No dice nada.

### El problema real

Tres cosas se rompen a la vez:

1. **Lectores de pantalla.** Una persona ciega no puede saltar a "el contenido principal"
   porque no existe esa posibilidad: todo son `div` iguales.
2. **Buscadores.** Google necesita saber cuál es el título de la web, dónde empieza el artículo,
   dónde está el menú. Con `div class="titulo"` no tiene forma de saberlo.
3. **Tú mismo, dentro de seis meses.** Vuelves a tu proyecto y no sabes qué hace cada `div`.

> **Dato histórico (mola para los exámenes):** HTML5 (2014) añadió unos 30 elementos nuevos.
> No se inventaron para hacer la web "más chula", sino por estos tres motivos.
> Antes, la única forma de tener estructura era con atributos `id` y `class` que el navegador
> no entendía. HTML5 los metió directamente en las etiquetas.

---

## La solución: etiquetas que nombran su función

```html
<body>
    <header>
        <nav>...</nav>
    </header>
    <main>
        <article>
            <h1>Bienvenido</h1>
            <p>Aquí va el contenido...</p>
        </article>
    </main>
    <footer>© 2026</footer>
</body>
```

Ahora el código **se explica solo**. Eso es *semántica*: la etiqueta dice qué es, no solo cómo se ve.

---

## El mapa de los elementos principales

```
body
├── header      Cabecera: logo, título, navegación
├── nav         Navegación: enlaces del menú
├── main        El contenido ÚNICO y principal
│   ├── article  Un contenido autónomo (una noticia, un post)
│   ├── section  Una sección temática del conjunto
│   ├── aside    Contenido secundario o relacionado
│   └── ...
└── footer      Pie de página: copyright, enlaces legales
```

| Elemento | Para qué | Cuántos puede haber |
|---|---|---|
| `<header>` | Cabecera de la página **o** de una sección | Varios |
| `<footer>` | Pie de página o de una sección | Varios |
| `<nav>` | Bloque de navegación (menús) | Varios |
| `<main>` | El contenido **único y principal** | **Solo uno** |
| `<article>` | Pieza autónoma y con sentido propio | Varios |
| `<section>` | Agrupación temática con encabezado | Varios |
| `<aside>` | Contenido lateral, relacionado o secundario | Varios |
| `<figure>` / `<figcaption>` | Contenido visual (foto, diagrama) + su pie | — |
| `<address>` | Datos de contacto de una persona/empresa | — |

### La estructura canónica de una página

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
        <p>Contenido.</p>
    </main>

    <footer>
        <p>© 2026 MiWeb · <a href="legal.html">Aviso legal</a></p>
    </footer>
</body>
```

**Memoriza este esqueleto.** Es la estructura de casi cualquier página web del mundo.

---

## `main` es especial: solo uno

`<main>` es el contenido **que identifica la página**. Solo puede haber **uno**:

```html
<!-- MAL -->
<main>Contenido del artículo</main>
<main>Contenido de la sidebar</main>

<!-- BIEN -->
<main>Contenido del artículo</main>
<aside>Contenido de la sidebar</aside>
```

- `<main>` **no puede** estar dentro de `<header>`, `<footer>`, `<nav>`, `<article>` o `<aside>`.
- Solo puede estar en `<body>` (o dentro de un `<div>` normal).
- **No puede estar dentro de un `<article>`.** Esto confunde a mucha gente al principio, pero es
  la norma: el contenido principal de la página va en `<main>`, y un `<article>` **va dentro** de `<main>`.

> Y ojo con esto, que es pregunta de examen: **visualmente `<main>` no hace nada especial**.
> No pone nada centrado ni más grande. Su valor es **puramente semántico**. Puedes quitarlo
> y la página se verá exactamente igual. Sigue siendo obligatorio por accesibilidad.

---

## `article` vs `section`: la duda eternal

Los dos agrupan contenido, pero se diferenciaron en HTML5.1:

| | `<section>` | `<article>` |
|---|---|---|
| **Es una...** | sección **temática** | pieza **autónoma** |
| **Se puede compartir sola** | No necesariamente | **Sí** |
| **Ejemplo** | "Nuestros productos", "Contacto" | "Noticia del lunes", "Post de blog" |
| **Lleva `id` para enlazar** | Habitual | Menos |

> **Prueba rápida:** si puedes pegar ese trozo de contenido en otra página y sigue teniendo sentido
> completo, es un `<article>`. Si solo tiene sentido **dentro de esta página**, es una `<section>`.

```html
<main>
    <section id="productos">
        <h2>Nuestros productos</h2>
        <!-- aquí NO tiene sentido fuera de esta página -->
    </section>

    <article>
        <h2>Noticia: superada la barrera de los 1000 usuarios</h2>
        <!-- esto sí se puede compartir y sigue leyéndose bien -->
    </article>
</main>
```

**Regla práctica:** si dudas entre las dos, casi siempre es `<section>`. Y si dudas entre `<section>`
y `<div>`... también `<section>` (o `<div>` si no lleva encabezado). No pasa nada por equivocarse.

---

## Elementos que ya conocías, con nombre "bonito"

```html
<hgroup>
    <h1>El título de la página</h1>
    <p>Un subtítulo o eslogan</p>
</hgroup>

<p>Un párrafo con
   <a href="#">un enlace</a>, <em>énfasis</em> y <time datetime="2026-09-28">una fecha</time>.
</p>

<blockquote>
    <p>Una cita importante.</p>
    <cite>— Nombre, obra</cite>
</blockquote>
```

Y ojo, porque es un clásico del examen: **`<section>` NO es lo mismo que un `<div>`**.
La diferencia es que `section` **debe tener un encabezado** (`h1`–`h6`) que describa el tema.
Si no lleva encabezado, es un `div`.

---

## `aria-label`: el atributo para el lector de pantalla

Cuando un `<nav>` o un `<button>` no se entiende solo, se le explica con `aria-label`:

```html
<nav aria-label="Navegación principal">...</nav>
<button aria-label="Cerrar menú">×</button>
<button aria-label="Reproducir vídeo">▶</button>
```

Es texto **solo para tecnología asistiva** (no se ve) que explica para qué sirve un elemento
que no tiene texto visible. Como aquí hay varios `<nav>`, hay que decir cuál es cuál.

> **Importante:** `aria-label` **no** es una etiqueta visible. Para eso está `<label>` (en formularios,
> apunte 07). No los confundas.

---

## ¿Y el `<div>`? ¿No lo usamos nunca?

**Sí se usa.** El `<div>` es el contenedor **neutro**: sirve para agrupar cosas para poder
maquetarlas, cuando no hay una etiqueta semántica que encaje.

```html
<!-- agrupa para aplicar CSS -->
<div class="contenedor">
    <div class="tarjeta">
        <h3>Producto</h3>
        <p>19,99 €</p>
    </div>
</div>
```

La diferencia está en el **motivo**:

- Pones `<div>` porque **necesitas un contenedor para el CSS** y nada más significa eso.
- No pones `<div>` en lugar de `<header>`/`<nav>`/`<article>` **porque te da pereza buscar la
  etiqueta correcta**. Ahí es donde de verdad estás perdiendo accesibilidad.

> **Frase para el examen:** "uso `<div>` como contenedor genérico, pero siempre que exista una
> etiqueta semántica que describa el contenido, esa etiqueta es la correcta."

---

## Cómo elegir: el árbol de decisión

```
¿Es el contenido principal y único de la página?
  └─ SÍ → <main>

¿Es un trozo que tiene sentido por sí solo (noticia, post, producto)?
  └─ SÍ → <article>

¿Es un grupo temático dentro de algo más grande?
  └─ SÍ → <section> (con su encabezado)

¿Es un menú o un conjunto de enlaces de navegación?
  └─ SÍ → <nav>

¿Es contenido secundario o complementario?
  └─ SÍ → <aside>

¿Está en la parte de arriba o abajo de la página o sección?
  └─ SÍ → <header> o <footer>

¿Ninguna de las anteriores y solo necesito un contenedor para el CSS?
  └─ → <div>
```

---

## Comprobación rápida: usa el validador

Un `div` vacío o mal colocado se detecta fácil. **W3C tiene una herramienta de accesibilidad
integrada en el validador**: si metes `<img>` sin `alt` o saltas niveles de encabezado, te avisa.
Úsala como norma: [validator.w3.org/nu/](https://validator.w3.org/nu/)

---

## Minirrégimen

1. Reescribe la página de "montaña de div" del principio con etiquetas semánticas.
2. Comprueba en el inspector que el árbol ha quedado claro.
3. Elimina el `<main>` y mira: ¿cambia algo visualmente? (No. Pero el reader sí lo nota.)
4. Prueba a poner dos `<main>`. El validador te lo dice al instante.
5. Prueba `<section>` sin encabezado y el validador te avisa. Mismo fallo, mismo aprendizaje.

---

*Siguiente apunte → [06 · Tablas en HTML](06%20-%20Tablas%20en%20HTML.md)*
*← Anterior · [04 · Enlaces e imágenes](04%20-%20Enlaces%20e%20im%C3%A1genes.md)*
