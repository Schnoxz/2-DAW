# 08 · CSS, qué es y cómo se enlaza

> Aquí empieza la otra mitad. Con este apunte y el siguiente ya puedes maquetar.

---

## Qué es CSS

**C**ascading **S**tyle **S**heets = hojas de estilo en cascada.

Es un lenguaje **declarativo** (como HTML): tú escribes reglas del tipo
**"este elemento se ve así"** y el navegador las aplica.

```css
h1 {
    color: blue;
    font-size: 30px;
}
```

Se lee así:

- **selector** → *a quién* se aplica la regla (aquí, a todos los `h1`).
- **llaves `{ }`** → delimitan la regla.
- **declaraciones** → cada línea `propiedad: valor;` dentro de las llaves.

Ojo al **punto y coma** al final de cada declaración. Es opcional en la última, pero ponlo siempre:
si te olvidas de uno, **todo lo que viene después se rompe en silencio**.

---

## Los tres métodos para meter CSS

### 1. Estilo en línea (evítalo)

```html
<h1 style="color: red; font-size: 24px;">Título</h1>
```

- ✅ Funciona y es rápido para una prueba.
- ❌ No se reutiliza: si tienes 20 títulos, editas 20 sitios.
- ❌ No se puede poner `media query` (el responsive es imposible).
- ❌ El profesor suele marcarlo como **desaconsejado** directamente.

**Úsalo solo para pruebas de 30 segundos.** Nunca en un trabajo entregado.

### 2. CSS interno (en el `<head>`)

```html
<head>
    <style>
        h1 { color: red; }
        p  { color: #333; }
    </style>
</head>
```

- ✅ Todo el CSS en un sitio, se ve y se edita bien.
- ✅ Admite `media query`.
- ❌ Va dentro de cada página HTML: si tienes 20 páginas, el CSS se repite 20 veces.

**Úsalo para una página única** o para una prueba rápida. Aceptable en un ejercicio pequeño.

### 3. CSS externo (el que se usa de verdad) ✅

```html
<head>
    <link rel="stylesheet" href="css/estilos.css">
</head>
```

Desglose del `<link>`:

- `link` → etiqueta de enlace a un recurso externo.
- `rel="stylesheet"` → la **relación**: "esto es una hoja de estilos".
- `href="css/estilos.css"` → la **ruta** al fichero.

- ✅ Un solo fichero CSS para **todas** las páginas.
- ✅ Se cachea en el navegador: se descarga una vez y se reutiliza.
- ✅ Permite mantener HTML y CSS separados.
- ❌ Si la ruta está mal, la página sale **sin estilos** (y parece que "el CSS no funciona").

> **Este es el método estándar.** Cualquier trabajo que entregues en DAW debería tener
> `index.html` + `css/estilos.css`. Si te piden "no usar estilos en línea", ya sabes por qué.

### ¿Y si meto varios? Gana el último.

Si en un mismo documento hay CSS interno y enlazado externo, **el enlazado externo gana**
(va después en el orden). Esto forma parte de la "cascada", que es el tema del apunte 09.

---

## ¿Cuál elijo?

| Situación | Método |
|---|---|
| Prueba de 2 minutos | En línea |
| Ejercicio suelto de una página | Interno (`<style>`) |
| **Trabajo, práctica o proyecto** | **Externo (`<link>`)** |

---

## Un primer CSS real

```css
/* Comentario: así se anota algo en CSS */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
}

header {
    background-color: #2c3e50;
    color: white;
    padding: 20px;
    text-align: center;
}

main {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.tarjeta {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 20px;
}
```

```html
<body>
    <header>
        <h1>Mi web</h1>
    </header>
    <main>
        <div class="tarjeta">
            <h2>Primera tarjeta</h2>
            <p>Contenido de la tarjeta.</p>
        </div>
    </main>
</body>
```

**Fíjate en `class="tarjeta"`.** La clase es el puente entre HTML y CSS: el HTML dice *qué hay*,
el CSS dice *cómo se ve cada cosa de ese tipo*. Así se trabaja profesionalmente: no estilizas
"este div concreto", estilizas "**las tarjetas**".

---

## Unidades: la trampa de los `px` a todo

```css
p {
    font-size: 16px;
    width: 300px;
    margin: 20px;
}
```

Y también:

```css
p {
    font-size: 1rem;     /* relativo a la fuente raíz */
    width: 50%;          /* relativo al contenedor */
    margin: 2em;         /* relativo a la fuente del propio elemento */
    padding: 5vh;        /* vh/vw: 1% de la altura/ancho de la ventana */
    line-height: 1.6;    /* SIN unidad: múltiplo del tamaño de fuente */
}
```

| Unidad | Es relativa a | Cuándo usarla |
|---|---|---|
| `px` | Nada (píxel) | Bordes, tamaños pequeños, detalles fijos |
| `rem` | La fuente de `<html>` | **Todo lo tipográfico** |
| `em` | La fuente del propio elemento | Espaciados internos |
| `%` | El contenedor padre | Anchuras fluidas |
| `vw` `vh` | El tamaño de la ventana | Alturas de pantalla completa |
| `fr` | La rejilla (Grid) | Reparto de columnas |

> **Por qué `rem` y no `px` para la letra:** si el usuario tiene el texto del navegador ampliado al
> 150 % y tú has puesto todo en `px`, la página no le hace caso y **no se puede leer**.
> Con `rem` todo crece con él. **Es un requisito de accesibilidad**, y se evalúa.

```css
html {
    font-size: 100%;   /* respeta la preferencia del usuario */
}
```

### `line-height` sin unidad

```css
p { line-height: 1.6; }   /* 1,6 veces su propio tamaño de fuente */
```

Se expresa **sin unidad** a propósito: así, si cambias el `font-size`, el interlineado se ajusta solo.
Texto con interlineado de 1,4 a 1,6 es mucho más cómodo de leer que con 1,0.

---

## Organizar el fichero CSS: comentarios de sección

Cuando un proyecto crece, el CSS se vuelve inmaneable. La solución es ordenarlo por secciones
y marcarlo con comentarios:

```css
/* ==================================
   1. VARIABLES
   ================================== */
:root {
    --color-primario: #2c3e50;
    --color-texto: #333;
    --ancho-max: 900px;
    --espaciado: 16px;
}

/* ==================================
   2. BASE
   ================================== */
body {
    font-family: Arial, sans-serif;
    color: var(--color-texto);
    line-height: 1.6;
}

/* ==================================
   3. CABECERA
   ================================== */
header { background-color: var(--color-primario); }

/* ==================================
   4. TARJETAS
   ================================== */
.tarjeta { padding: var(--espaciado); }
```

### Las variables CSS

```css
:root {
    --color-primario: #2c3e50;
}

header {
    background-color: var(--color-primario);
    border-bottom: 4px solid var(--color-primario);
}
```

Las variables empiezan **siempre por `--`** y se declaran en `:root` (que es el `<html>`).
Con esto, si el profe cambia el color de la web, cambias **una línea** en vez de veinte.

**Truco de la vida real:** al final de un proyecto, cambia una variable de `:root` a un color
absurdo y mira cómo cambia **toda** la página. Así ves si la has usado bien.

> **Las variables son una cosa que se pregunta mucho en exámenes.** Se declaran con
> `--nombre: valor;` y se usan con `var(--nombre)`.

---

## Los comentarios en CSS

```css
/* Una línea */

/*
   Varias líneas.
   Útil para una sección entera.
*/
```

---

## `box-sizing`: ponlo en el primer minuto

```css
* {
    box-sizing: border-box;
}
```

Con `border-box`, el `width` que pones **incluye el padding y el borde**. Sin esto, un `div`
de `width: 200px` con `padding: 20px` mide en realidad **240 px** de ancho y nunca cuadras nada.

**Poner esta línea al principio de todo CSS es una costumbre de profesionales.**
El modelo de caja entero está en el apunte 09.

---

## Colores

```css
color: red;                    /* palabra clave */
color: #2c3e50;                /* hexadecimal (la más usada) */
color: rgb(44, 62, 80);        /* rojo, verde, azul */
color: rgba(44, 62, 80, 0.8);  /* con transparencia: de 0 a 1 */
color: hsl(210, 29%, 24%);     /* tono, saturación, luminosidad */
```

**Transparencia:** `opacity: 0.5` afecta al elemento **entero, incluidos sus hijos**.
Para transparentar solo el fondo, usa `rgba()`. Es una diferencia que se nota.

---

## Trucos para aprender CSS

1. **No memorices propiedades.** Memoriza la idea y busca la sintaxis.
   Nadie se sabe de memoria todos los valores de `box-shadow`.
2. **Usa el inspector.** Apunta un margen, cámbialo, mira el valor. Aprendes en 10 segundos.
3. **Busca en MDN.** [developer.mozilla.org](https://developer.mozilla.org/es/docs/Web/CSS)
   está en español, es la documentación oficial de referencia y es **la mejor**.
4. **Copia de MDN, no de blogs random.** Los blogs se equivocan; MDN no.
5. **Ordena las reglas dentro del bloque** así (funciona, y luego lo entiendes):
   `tipo de letra → color → fondo → caja (margin, padding, border) → posición → otros`.

---

## Minirrégimen

1. Crea `index.html` + `css/estilos.css` y enlázalos. **Borra la ruta a propósito**: ¿qué pasa?
2. Duplica el HTML en `otra.html` y mete el CSS en línea. ¿Notas la diferencia al cambiar algo?
3. Pasa a externo y comprueba que las dos páginas cambian a la vez.
4. Declara `--color-primario` en `:root`, úsalo en tres sitios y cámbialo. Cuenta cuántos sitios
   has tenido que tocar: **uno**.
5. Pon `font-size` en `px` y luego en `rem`, y compara con el texto del navegador ampliado.
6. Mete `box-sizing: border-box` en `*` y mide un `div` con padding. ¿Cuánto mide ahora?

---

*Siguiente apunte → [09 · CSS, selectores, modelo de caja y cascada](09%20-%20CSS%2C%20selectores%2C%20modelo%20de%20caja%20y%20cascada.md)*
*← Anterior · [07 · Formularios](07%20-%20Formularios.md)*
