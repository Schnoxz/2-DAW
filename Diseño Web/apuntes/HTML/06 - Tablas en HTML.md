# 06 · Tablas en HTML

> Dos cosas: cómo se construye una tabla **correctamente** y cuándo **no** debes usarla.

---

## Antes de nada: ¿es una tabla de verdad?

Esta pregunta va antes de aprender la sintaxis, porque el 80 % de los errores que veo son
tablas usadas para maquetar.

**Una tabla de verdad** es una rejilla de **datos relacionados entre sí**, donde cada fila es
un registro del mismo tipo y cada columna es un atributo.

| | SÍ es tabla | NO es tabla |
|---|---|---|
| Ejemplo | Horario de clases | Distribución de la página en bloques |
| Ejemplo | Comparativa de productos | Menú de navegación |
| Ejemplo | Resultados de una encuesta | Una foto con un texto al lado |
| Criterio | **Celdas con datos que se cruzan** | Solo sirve para colocar cosas |

> **La regla de oro:** si quitas el CSS y la tabla sigue teniendo sentido leyendo los datos,
> es una tabla. Si desaparece todo y solo quedan bloques por la pantalla, **era maquetación
> y está mal hecho**.

Antes de HTML5, los `<table>` se usaban como contenedores para maquetar (el famoso
"table layout"). **Eso está obsoleto.** Hoy se usa CSS (Flexbox y Grid). Si ves una web con
tablas para maquetar, es antigua.

---

## La anatomía de una tabla

Toda tabla necesita **cinco piezas**:

```html
<table>
    <caption>Horario del curso 2º DAW</caption>
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

| Etiqueta | Significado | Obligatoria |
|---|---|---|
| `<table>` | La tabla entera | Sí |
| `<caption>` | Título de la tabla | No (pero **muy recomendable**) |
| `<thead>` | Fila/cabecera de encabezados | Opcional |
| `<tbody>` | Cuerpo, las filas de datos | Sí (aunque el navegador lo ponga solo) |
| `<tfoot>` | Pie de tabla (totales) | Opcional |
| `<tr>` | **T**able **r**ow = una fila | — |
| `<th>` | **T**able **h**eader = celda de encabezado | — |
| `<td>` | **T**able **d**ata = celda de dato | — |

**La diferencia entre `<th>` y `<td>`** es la clave del apunte:

- `<td>` = un dato normal.
- `<th>` = un encabezado. **Negrita por defecto, centrada**, y es lo que un lector de pantalla
  usa para saber de qué columna o de qué fila va cada valor.

> Por eso las cabeceras son `<th>` y no `<td>` con `style="font-weight:bold"`.
> No es estética: es información. Y `<th scope="col">` / `scope="row"` le dice **en qué dirección**
> se aplica, que es justo lo que necesita saber quien usa un lector de pantalla.

---

## Atributos que se usan

### `colspan` y `rowspan`

```html
<table>
    <tr>
        <th colspan="2">Cabecera que ocupa 2 columnas</th>
    </tr>
    <tr>
        <td>A</td>
        <td>B</td>
    </tr>
    <tr>
        <td rowspan="2">Esta celda ocupa 2 filas hacia abajo</td>
        <td>C</td>
    </tr>
    <tr>
        <td>D</td>
    </tr>
</table>
```

- `colspan="n"` → la celda ocupa **n columnas** hacia la derecha.
- `rowspan="n"` → la celda ocupa **n filas** hacia abajo.

> **Trampa:** con `colspan` y `rowspan` a la vez es muy fácil que las filas tengan distinto número
> de celdas que las del `thead`. Es el error que más veces se ve en exámenes. **Cuenta siempre.**

### Sobre `<caption>`

```html
<table>
    <caption>Precio de los productos</caption>
    ...
</table>
```

Va **inmediatamente después de `<table>`**, antes de `<thead>`. No es un `<h2>` suelto: es el
título **propio de la tabla**, y es el que el lector de pantalla anuncia al entrar en ella.
Se posiciona arriba por defecto, pero se puede mover con CSS (`caption-side: bottom`).

---

## Bordes: NO uses el atributo `border`

```html
<!-- OBSOLETO. No hagas esto -->
<table border="1">
```

Ese atributo existe desde 1995 y **ya no funciona en los navegadores modernos**.
Los bordes se ponen en CSS:

```css
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #999;
    padding: 8px 12px;
    text-align: left;
}
```

- `border-collapse: collapse` → une los bordes en una sola línea. Sin esto salen bordes dobles.
- `width: 100%` → la tabla ocupa todo el ancho disponible. **Ojo: en móvil esto es un problema**,
  ver más abajo.

---

## Tablas responsive (el problema real en móvil)

Una tabla de 6 columnas en un móvil de 360 px no cabe. Y **no puedes meter un `<div>` dentro
de un `<tr>` ni de un `<td>` para arreglarlo**: el modelo de tabla es estricto.

Hay dos salidas razonables:

### Opción A: que la tabla se desplace horizontalmente

```css
.tabla-scroll {
    overflow-x: auto;
}

.tabla-scroll table {
    min-width: 600px;
}
```

```html
<div class="tabla-scroll">
    <table>...</table>
</div>
```

Es la solución más simple y la más común. El scroll lo hace el contenedor, no la página.

### Opción B: pasar los datos a "tarjetas" en pantallas pequeñas

Con CSS se puede hacer que cada fila se convierta en una tarjeta usando
`display: block` sobre `tr`, `td` y `th`, y `::before` para poner la etiqueta de cada dato:

```css
@media (max-width: 600px) {
    table, tbody, tr, th, td { display: block; }
    thead { display: none; }
    td::before {
        content: attr(data-label) ": ";
        font-weight: bold;
    }
}
```

```html
<td data-label="Lunes">Entorno Cliente</td>
```

Es más trabalho, pero es la solución "de verdad" cuando la tabla es clave en la página.

> **Consejo práctico en DAW:** usa la opción A salvo que te pidas expresamente la versión B.
> Es más simple, funciona siempre y se ve bien.

---

## Cómo se lee una tabla por partes

Antes de escribir el HTML, rellena esto:

1. ¿Cuál es el **título**? → `<caption>`
2. ¿Qué **columnas** hay? → una fila de `<th scope="col">` dentro de `<thead>`
3. ¿Cuántos **registros** hay? → un `<tr>` por registro dentro de `<tbody>`
4. ¿Alguna fila tiene un nombre (producto, hora, alumno)? → ese dato va en `<th scope="row">`
5. ¿Alguna celda abarca varias? → `colspan` / `rowspan`

**Hacerlo en este orden evita el 95 % de los errores.** Escribe primero solo los `td` de una fila
en un papel, y luego decide qué parte es encabezado.

---

## Errores típicos

| ❌ | 💥 | ✅ |
|---|---|---|
| `border="1"` | No hace nada | Bordes en CSS |
| `<td>` para las cabeceras | Se pierde la semántica | `<th>` |
| Olvidar `scope` | El lector de pantalla no sabe qué es cabecera | `scope="col"` / `scope="row"` |
| Poner `<tr>` directamente en `<table>` | Sin cabecera ni cuerpo | Usa `<thead>` y `<tbody>` |
| `<div>` dentro de `<td>` para maquetar | Hoy es inválido; usa CSS | Grid o Flexbox |
| Filas con distinto nº de celdas por un `colspan` | Tabla descuadrada | Cuenta celdas por fila |
| Usar tabla para maquetar la página | Obsoleto desde HTML5 | `<div>` + CSS |
| Sin `<caption>` en tablas con datos | Falta el título accesible | Añádelo |

---

## Minirrégimen

1. Convierte tu horario de clase en una tabla **con `thead`, `tbody`, `caption` y `scope`**.
2. Añade un `colspan` en una celda. Comprueba que todas las filas siguen teniendo el mismo ancho.
3. Pásalo por el validador. Luego bórralo todo y pon solo `<table><tr><td>` a ver qué te dice.
4. Aplica `border-collapse` y quita `border="1"`. ¿Qué cambia? Nada: nunca funcionó.
5. En móvil: ¿hay scroll horizontal? Envolve la tabla con `overflow-x: auto`.

---

*Siguiente apunte → [07 · Formularios](07%20-%20Formularios.md)*
*← Anterior · [05 · Elementos semánticos](05%20-%20Elementos%20sem%C3%A1nticos.md)*
