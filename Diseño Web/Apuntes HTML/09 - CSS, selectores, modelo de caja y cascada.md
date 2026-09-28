# 09 · CSS, selectores, modelo de caja y cascada

> El apunte que explica **por qué** tu CSS no hace lo que quieres. El más importante de la parte CSS.

---

# Parte 1 · Selectores: "¿a quién aplico esto?"

El selector es la primera parte de una regla:

```css
.tarjeta {
    background-color: #eee;
}
```

`.tarjeta` es el selector: "esto se aplica a los elementos con la clase `tarjeta`".

## Los selectores básicos

### Por etiqueta

```css
h1 { font-size: 2rem; }
p  { line-height: 1.6; }
```

Se aplica a **todas** las etiquetas de ese tipo. Es el más genérico y el más fácil de usar mal:
un `h1 { color: red }` afecta a todos los títulos de la página, y eso normalmente no es lo que quieres.

### Por clase (`.`) — **el que más vas a usar**

```html
<div class="tarjeta">
<div class="tarjeta destacado">
```

```css
.tarjeta   { border: 1px solid #ccc; }
.destacado { background: #fffbdd; }
```

- Una clase puede ir en **muchos elementos** a la vez.
- Un elemento puede tener **muchas clases**: `class="tarjeta destacado grande"`.
- **Puedes reutilizar la misma clase en 50 sitios.**
- Empieza siempre por punto: `.tarjeta`, no `tarjeta`.

> **Enfoque profesional:** si te pones a escribir `id="titulo1"`, `id="titulo2"`, `id="titulo3"`,
> estás en el camino equivocado. Enseña **clases** reutilizables. La razón técnica: los estilos
> de una clase se pueden **modificar** en cualquier momento; los de un `id` ganan siempre
> (más de eso abajo).

### Por id (`#`)

```html
<h1 id="titulo-principal">Bienvenido</h1>
```

```css
#titulo-principal { color: navy; }
```

- **Un id es único** en todo el documento. No lo repitas.
- Se usa para cosas concretas: el ancla de navegación, un `label for`, un destino de JavaScript.
- **Prioridad altísima** en la cascada: gana a casi todo. Úsalo con Stitch.

> **Consejo:** en la práctica, estiliza con **clases**, no con ids. Si necesitas un id para el
> ancla o el JS, ponlo también, pero no le pongas reglas CSS.

### Universal (`*`)

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
```

Aplica a todo. Se usa para el "reset" de estilos del navegador.

> **Ojo:** el patrón `margin: 0; padding: 0` en `*` **borra los márgenes de los `h1`, `p` y `ul`**,
> que es justo lo que se quiere. Pero si lo haces mal y los `h1` se pegan al texto, la página
> se ve fatal. Mejor un reset selectivo si acabas de empezar.

### Combinadores: la parte que se pide en exámenes

Aquí está la clave: **no todos los selectores significan lo mismo** según dónde pongas el espacio.

```html
<nav>
    <ul>
        <li><a href="#">Inicio</a></li>
    </ul>
</nav>
```

| Selector | Significado | ¿Aplica aquí? |
|---|---|---|
| `nav a` | **descendiente**: un `a` que esté en algún sitio dentro de un `nav` | Sí |
| `nav > ul` | **hijo directo**: un `ul` que sea hijo inmediato de `nav` | Sí |
| `ul > li > a` | cadena de hijos directos | Sí |
| `nav + ul` | **hermano siguiente**: un `ul` que vaya justo detrás de un `nav` | No |
| `nav ~ ul` | **hermano general**: cualquier `ul` después de un `nav` | No |
| `a[href="#"]` | **atributo**: los `a` cuyo `href` valga `#` | Sí |

**El detalle que se confunde siempre:** `nav a` (con espacio) es descendiente, `nav > a` es hijo
directo. En este caso ambos aplican, pero si metieras un `<div>` en medio, `nav > a` dejaría de funcionar.

```html
<nav>
    <div>
        <a href="#">Inicio</a>   <!-- este SÍ es descendiente de nav -->
    </div>
</nav>
```

```
nav a   → se aplica
nav > a → NO se aplica (el padre directo del <a> es <div>)
```

> **Truco para recordarlo:** el `>` es una flecha. Se lee "**va justo aquí**".
> El espacio es "está en algún sitio por aquí dentro".

### Varios selectores a la vez (coma)

```css
h1, h2, h3 {
    color: #2c3e50;
}
```

Aplica lo mismo a los tres. Es cuando **agrupas reglas para no repetirlas**.

### Pseudo-clases: el elemento cambia de estado

```css
a:hover      { color: red; }              /* el ratón está encima */
a:visited    { color: purple; }           /* ya lo has visitado */
a:link       { color: blue; }             /* aún no lo has visitado */
a:focus-visible { outline: 2px solid orange; }  /* enfocado con el teclado */

input:checked  { background: green; }    /* checkbox marcado */
input:disabled { opacity: 0.5; }         /* campo deshabilitado */
input:required { border-left: 3px solid red; }
input:valid    { border-color: green; }
input:invalid  { border-color: red; }

li:first-child  { font-weight: bold; }   /* el primero */
li:last-child   { color: gray; }         /* el último */
li:nth-child(2) { color: red; }          /* el segundo */
li:nth-child(odd)  { background: #f9f9f9; }  /* impares */
li:nth-child(even) { background: #eee; }      /* pares */
```

> **`:focus-visible` no es opcional.** Es lo que le dice a quien navega con teclado dónde está.
> Si lo quitas, la página es **inaccesible** y se penaliza. Nunca quites el contorno de foco
> sin poner un `outline` propio.

`:focus-visible` dibuja el contorno **solo** cuando navegas con teclado, no cuando haces clic con
el ratón. Es la forma correcta: no molesta al ratón y sí ayuda al teclado.

### `::before` y `::after`: contenido que CSS pone

```html
<p class="aviso">Recuerda bringar el DNI</p>
```

```css
.aviso::before {
    content: "⚠️ ";
}
```

No añaden nada al HTML, solo lo pintan. Se usan para iconos, comillas en las citas, o para limpiar
el *float* (`::after { content: ""; display: block; clear: both; }`).

> **Los selectores de pseudo-elemento llevan DOS puntos** (`::before`).
> Los de pseudo-clase llevan UNO (`:hover`).

---

# Parte 2 · El modelo de caja (box model)

Cuando el navegador dibuja cualquier elemento, lo hace como una caja con **cinco zonas**:

```
        margin  (exterior: espacio respecto a lo de fuera)
   ┌──────────────────────────────────────────┐
   │  border  (borde)                         │
   │  ┌────────────────────────────────────┐  │
   │  │  padding  (relleno interior)       │  │
   │  │  ┌──────────────────────────────┐  │  │
   │  │  │  content  (el texto, la img) │  │  │
   │  │  └──────────────────────────────┘  │  │
   │  └────────────────────────────────────┘  │
   └──────────────────────────────────────────┘
```

**Mnemotécnico: "el borde protege al padding, que abriga al contenido, y el margin respira".**
Se lee de dentro hacia fuera: `content` → `padding` → `border` → `margin`.

```html
<div class="ejemplo">Hola</div>
```

```css
.ejemplo {
    width: 200px;
    padding: 20px;
    border: 5px solid black;
    margin: 30px;
}
```

**¿Cuánto mide de ancho este `div`?**

- Solo `width`: 200 px.
- Con `padding` y `border`: 200 + 20×2 + 5×2 = **250 px**.

Esto es lo que confunde a todo el mundo. Y la solución es una línea:

```css
* {
    box-sizing: border-box;
}
```

Con `border-box`, el `width: 200px` **ya incluye** el padding y el borde. El div mide
exactamente 200 px. **Pon esta regla al principio de tu CSS.**

> **Truco para recordar los tres valores del atajo:** **M**argin, **B**order, **P**adding, **C**ontent.
> "**M**e **B**ueno el **P**a**C**o". Es el orden de
> `margin: 10px 20px; border: 2px; padding: 8px 15px;`
> (reducir y crecer con esos valores es la excepción que no necesitas todavía).

```css
.ejemplo {
    margin: 20px 40px;             /* arriba/abajo 20, izquierda/derecha 40 */
    padding: 10px 30px 15px 5px;   /* arriba, derecha, abajo, izquierda */
}
```

### El colapso de márgenes

Dos bloques seguidos con `margin-bottom: 20px` y `margin-top: 20px` **no quedan separados 40 px**.
Se quedan separados **20 px**: los márgenes verticales **se suman, no se apilan**.

```
┌─────────────┐   20px   ┌─────────────┐
│   Bloque 1  │ ───────► │   Bloque 2  │
└─────────────┘   20px   └─────────────┘
              = 20px, no 40px
```

Esto es un comportamiento **heredado de los primeros navegadores** (no está en el estándar),
pero sigue así hoy. La solución moderna es usar `gap` con Flexbox o Grid, que no colapsa nada:

```css
main {
    display: grid;
    gap: 20px;
}
```

### El problema del ancho al 100 %

```css
.tarjeta {
    width: 300px;
    padding: 20px;
    border: 1px solid #ccc;
}
```

Con `box-sizing: content-box` (el valor por defecto), esto mide 300 + 40 + 2 = **342 px**, y
cuatro tarjetas de esas **no caben** en un contenedor de 1200 px.

**Solución:**

```css
* { box-sizing: border-box; }
```

Y si además quieres que se adapten solas:

```css
.contenedor {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}
```

Con `minmax(280px, 1fr)`: cada columna tiene **mínimo 280 px** y las que sobren reparten el espacio.
Cuando no cabe ninguna más, salta de fila. **Se adapta solo a cualquier pantalla.**

---

# Parte 3 · La cascada: qué gana

Si dos reglas dicen cosas distintas del mismo elemento, **¿cuál se aplica?**

Hay **tres criterios**, en este orden. Gana el primero que desempate:

```
1. ¡IMPORTANTE!   →   gana siempre, sin mirar nada más
2. ESPECIFICIDAD  →   cuánto es "de específico" el selector
3. ORDEN          →   gana la ÚLTIMA regla escrita
```

> El nombre "**cascading**" viene de aquí: las reglas **caen** en cascada sobre el elemento,
> y la más específica gana.

## Especificidad: se calcula con números

Imagina que cada selector tiene tres columnas: **ID - CLASE - ETIQUETA**.

| Selector | ID | Clase | Etiqueta | Se lee |
|---|---|---|---|---|
| `p` | 0 | 0 | 1 | `0-0-1` |
| `.error` | 0 | 1 | 0 | `0-1-0` |
| `p.error` | 0 | 1 | 1 | `0-1-1` |
| `nav ul li a` | 0 | 0 | 4 | `0-0-4` |
| `#portada` | 1 | 0 | 0 | `1-0-0` |
| `#portada .titulo` | 1 | 1 | 0 | `1-1-0` |

Se comparan **de izquierda a derecha**, como una cifra.

> **Mnemotécnico: "cuanto más largo, más específico".** Pero ojo: `#portada` (corto) gana a
> `nav ul li li li li a` (larguísimo), porque los ids **mandan más** que todo lo demás junto.

**El orden de las columnas, de mayor a menor peso:**
`#id` (100) > `.clase` / `:hover` / `[atributo]` (10) > `etiqueta` / `*` (1)

## Ejemplo práctico de cascada

```html
<p class="destacado error">Ojo</p>
```

```css
p         { color: gray; }    /* 0-0-1 */
.destacado { color: blue; }   /* 0-1-0 → gana */
.error     { color: red; }    /* 0-1-0 → empate */
.error     { color: green; }  /* 0-1-0 → empate, gana la última */
```

El párrafo sale **verde**: los dos `.error` empatan en especificidad, así que gana el último.

Si le añado un id:

```css
#aviso { color: purple; }     /* 1-0-0 → gana a todo lo anterior */
```

Ahora sale **morado** aunque esté **por debajo** de los otros. Porque un id gana siempre.
**Por eso no se estilan con ids.**

## `!important`: la última palabra

```css
h1 { color: red !important; }
```

Gana a **todo**, sin importar especificidad ni orden.

**¿Cuándo se usa en serio?** Casi nunca. Se usa para sobreescribir estilos de terceros que no
puedes cambiar (un plugin, una librería). Si te pones a llenar tu CSS de `!important`, es que tu
CSS está mal organizado.

**En DAW: evítalo salvo que te lo pidan explícitamente.** Muchos profesores lo restan.

## El orden en el que se aplica

Cuando todo lo demás empata:

```html
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="otro-fichero.css">   <!-- este va después, este gana -->
<link rel="stylesheet" href="final.css">          <!-- y este gana a los dos -->
```

Y también: si un selector **igual** aparece dos veces en el **mismo fichero**, gana el segundo.
Por eso **no repitas selectores en un mismo fichero**: agrúpalos y ordena por secciones.

---

## Resumen en una tabla

```
¿Qué gana cuando hay conflicto?
    ¿Tiene !important?           → GANA
    ¿Tiene algún #id?            → GANA sobre clases y etiquetas
    ¿Tiene más clases/atributos? → GANA sobre etiquetas
    ¿Tienen la misma?             → GANA EL ÚLTIMO ESCRITO
```

---

## Errores típicos

| ❌ | 💥 | ✅ |
|---|---|---|
| Estilizar con ids | Spec altísima, imposible de cambiar | Usa clases |
| Llenar de `!important` | El CSS deja de ser mantenible | Ordena bien el fichero |
| Duplicar el mismo selector | Gana el último, desconcierta | Agrúpalos en una regla |
| `nav a` cuando quieres hijo | Se aplica a nietos también | `nav > a` |
| Olvidar el `:` o `::` | No funciona | `:hover` (1), `::before` (2) |
| Quitar el `:focus` | Inaccesible con teclado | Usa `:focus-visible` |
| Olvidar `box-sizing: border-box` | Los anchos no cuadran | Ponlo en `*` |

---

## Minirrégimen

1. En el inspector, mira el panel **Computed**: te enseña la cascada ya resuelta y la
   especificidad de cada regla. **Es la herramienta que más vas a usar de tu vida.**
2. Crea un párrafo con `class="a b"` y aplica `p`, `.a` y `.b`. ¿Gana la última escrita?
   ¿Y si subes `.a` por encima de `.b`?
3. Crea un `<div>` con un `ul` dentro y prueba `div a` y `div > ul > li`.
4. Pon un `div` con `width:300px; padding:30px; border:5px` y mide.
   Añade `box-sizing: border-box` y vuelve a medir.
5. Prueba un margen colapsando entre dos `div` y luego con `gap`.
6. Elimina el `:focus` de un enlace y navega con el `Tab`. ¿Dónde estás? No lo ves.

---

*Siguiente apunte → [10 · Práctica guiada, página completa](10%20-%20Pr%C3%A1ctica%20guiada%2C%20p%C3%A1gina%20completa.md)*
*← Anterior · [08 · CSS, qué es y cómo se enlaza](08%20-%20CSS%2C%20qu%C3%A9%20es%20y%20c%C3%B3mo%20se%20enlaza.md)*
