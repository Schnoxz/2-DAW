# 03 · Etiquetas de contenido y organización del texto

> Las etiquetas que vas a usar el 90 % de las veces. Con estas, ya sabes escribir una página.

---

## La jerarquía de encabezados: `<h1>` … `<h6>`

```html
<h1>El título principal de la página</h1>
<h2>Un apartado</h2>
<h3>Un subapartado</h3>
<h4>Un detalle</h4>
<h5>Casi nunca</h5>
<h6>Nunca</h6>
```

Un encabezado marca el **título** de una sección. Los números indican el **nivel de jerarquía**,
no el tamaño (el tamaño lo decide el CSS).

### Las 3 reglas de oro

1. **Un solo `<h1>` por página**, y es el título del contenido principal.
2. **No te saltes niveles.** Si el anterior es `h2`, el siguiente debe ser `h3`, no `h4`.
   Ir de `h1` a `h3` es como un escalera al que le falta un peldaño: confunde a quien lee con lector de pantalla.
3. **No elijas el nivel por el tamaño que quieres.** Si quieres el título gigante, escribe `h1` y dale
   el tamaño con CSS. Elegir `h6` para que salga pequeño es el error clásico.

```html
<!-- MAL -->
<h1>Recetas</h1>
<h4>Bizcocho</h4>

<!-- BIEN -->
<h1>Recetas</h1>
<h2>Bizcocho</h2>
```

> **Por qué importa tanto:** un lector de pantalla (usado por personas ciegas) puede saltar de
> encabezado a encabezado como tú saltas de sección en un índice. Si los niveles están bien, esa
> persona "ve" tu documento. Si están mal, no entiende nada. Es **accesibilidad**, y se evalúa en DAW.

---

## Párrafos: `<p>`

```html
<p>Este es un párrafo. Puede ser largo, ocupar varias líneas
   en el archivo y el navegador lo ajusta como un solo bloque.</p>
```

- Los saltos de línea **del archivo no cuentan**. Todo lo que hay entre `<p>` y `</p>` es un bloque,
  llene o no la línea.
- Para hacer un salto de verdad existe `<br>` (o `<br />`), que es una etiqueta **sin cierre**.
- **Un párrafo no contiene párrafos.** Nunca `<p>` dentro de `<p>`.

```html
<p>Primera línea<br>Segunda línea</p>
```

### Los espacios "fantasma"

Si escribes `<p>Hola     mundo</p>` sale `Hola mundo`, con un solo espacio. HTML **colapsa** los
espacios repetidos, las tabulaciones y los saltos de línea en un único espacio. Es un comportamiento
heredado de los primeros navegadores.

**Esto importa al maquetar:** no pongas texto "colgado" esperando que los espacios te cuadren el diseño.
Eso se hace con CSS.

---

## Listas: la parte que más se olvida

Hay dos tipos y son para cosas distintas.

### Lista desordenada — `<ul>` (viñetas)

```html
<ul>
    <li>Pescado</li>
    <li>Carne</li>
    <li>Verduras</li>
</ul>
```

### Lista ordenada — `<ol>` (numerada)

```html
<ol>
    <li>Entrar en la web</li>
    <li>Hacer login</li>
    <li>Enviar el formulario</li>
</ol>
```

### `li` = *list item* = elemento de lista

**Solo puede haber `<li>` dentro de `<ul>` u `<ol>`.** Punto.

La diferencia no es estética: una lista numerada **comunica un orden o una secuencia** (pasos, ranking,
horario). Si no hay orden, usa `ul`.

### Anidar listas

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

La sublista va **dentro del `<li>`**, no dentro del `<ul>**.

### Atributos útiles

```html
<ul type="disc">   <!-- viñeta -->
<ul type="circle"> <!-- círculo -->
<ul type="square"> <!-- cuadrado -->
<ol type="A">      <!-- A, B, C -->
<ol start="5">     <!-- empieza en el 5 -->
<ol reversed>      <!-- cuenta hacia atrás -->
```

> **En la práctica:** el tipo de viñeta o de número se cambia con CSS, no con el atributo.
> Usa el atributo solo si necesitas algo muy concreto.

---

## Énfasis: la diferencia entre "estilo" y "significado"

Aquí está el matiz que más se examina y más se confunde.

### Por estilo (NO semánticos) — no los uses

```html
<b>negrita</b>
<i>cursiva</i>
<u>subrayado</u>
<s>tachado</s>
<big>grande</big>              <!-- obsoleto -->
<font color="red">rojo</font>  <!-- obsoleto -->
```

Dicen cómo se ve el texto, pero **no dicen qué significa**. Para el motor de búsqueda, un `<b>` y un
`<strong>` son exactamente lo mismo.

### Por significado (SÍ semánticos) — estos son los buenos

```html
<strong>importante</strong>   <!-- énfasis fuerte: importancia seria -->
<em>subrayado con intención</em>   <!-- acento, "de verdad quiero decir esto" -->
<mark>resaltado</mark>       <!-- relevante o destacado -->
<del>tachado</del>           <!-- ya está obsoleto, se ofrece -->
<ins>subrayado</ins>         <!-- texto nuevo, insertado -->
```

> **La regla:** si solo quieres que se vea en negrita → `strong` (o un `<span>` con CSS).
> Si quieres decir "esto es más importante que lo demás" → `strong`.
> Si quieres acentuar una palabra suelta dentro de un texto → `em`.
> **Nunca uses `<b>` o `<i>` buscando significado.** Ya están en desuso.

### Resumen visual

| Etiqueta | Significa | Se ve |
|---|---|---|
| `<strong>` | importancia | negrita |
| `<em>` | énfasis, acento | cursiva |
| `<mark>` | relevante o destacado | resaltado |
| `<small>` | menos importante | más pequeño |
| `<code>` | es código | monoespaciada |
| `<kbd>` | es una tecla | con borde |
| `<abbr title="...">` | abreviatura | con puntos al pasar el ratón |
| `<sub>` / `<sup>` | sub/superíndice (H₂O, x²) | más bajo / más alto |

---

## Citas y texto "de otro sitio"

```html
<blockquote cite="https://fuente.com">
    <p>Lo que dijo alguien importante.</p>
</blockquote>

<q>Una cita corta dentro de un párrafo.</q>
```

`cite` **no** es para poner un enlace. Es la **URL de la fuente original**. Y no es obligatorio.

---

## Saltos y texto "de soporte"

```html
<br>          <!-- salto de línea -->
<hr>          <!-- línea horizontal -->
<pre>  texto que respeta
       saltos y espacios </pre>
<code>variable</code>
```

`<pre>` respeta los saltos y los espacios tal cual. Antes se usaba para bloques de código; hoy se
prefiere `<pre><code>...</code></pre>`.

---

## Elementos poco conocidos pero útiles

```html
<time datetime="2026-09-28">28 de septiembre</time>

<details>
    <summary>Ver más</summary>
    <p>Contenido oculto que se despliega al pulsar.</p>
</details>
```

`<time datetime="2026-09-28">` es un detalle bonito: el texto puede escribirse como quieras, pero el
`datetime` guarda la fecha **en formato estándar** para que las máquinas la entiendan.
`<details>` y `<summary>` dan un desplegable **sin una línea de JavaScript**.

---

## Ejemplo: un artículo completo con todo lo del apunte

```html
<article>
    <h1>Guía de la paella</h1>

    <p>La <strong>paella</strong> es un plato <em>típicamente</em> levantino.
       No te la saltes si vienes de otra región.</p>

    <h2>Ingredientes</h2>
    <ul>
        <li>Arroz bomba
            <ul>
                <li>400 g</li>
                <li>Caldo bien hecho</li>
            </ul>
        </li>
        <li>Pollo o conejo</li>
        <li>Colorante</li>
    </ul>

    <h2>Pasos</h2>
    <ol>
        <li>Socinar el pollo con el colorante.</li>
        <li>Repartir el arroz por toda la paella, <strong>sin remover nunca</strong>.</li>
        <li>Hervir a fuego fuerte hasta que se evapore el caldo.</li>
        <li>Reposo final: <mark>de 5 a 10 minutos sin tocar nada</mark>.</li>
    </ol>

    <hr>

    <p>Fuentes: <cite>Recetario de la abuela</cite>.</p>
</article>
```

Abre esto en el navegador. Todo lo que has leído en este apunte **está ahí** y funciona.

---

## Trampas finales

| Trampa | Por qué |
|---|---|
| `<p>` dentro de `<p>` | No está permitido; el navegador rompe el documento |
| Usar `<h3>` para que salga grande | El nivel no es el tamaño |
| `<b>` para "importante" | Usa `<strong>` |
| Confundir `<ol>` (números) con `<ul>` (viñetas) | Comunican cosas distintas |
| Meter `<div>` dentro de `<p>` | Un `div` es de bloque; corta el párrafo |
| Saltos de línea para "maquetar" | HTML no maqueta, y los espacios se colapsan |
| `<li>` suelto, sin `<ul>` ni `<ol>` | No tiene sentido sin su lista |

---

*Siguiente apunte → [04 · Enlaces e imágenes](04%20-%20Enlaces%20e%20im%C3%A1genes.md)*
*← Anterior · [02 · Estructura mínima del documento](02%20-%20La%20estructura%20m%C3%ADnima%20de%20un%20documento%20HTML.md)*
