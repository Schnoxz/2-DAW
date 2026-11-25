# Tema 1 · Ejercicios de HTML

## De qué va

Son los primeros ejercicios de marcas del módulo: listas ordenadas y desordenadas,
y una tabla de horario. Sirven para ver cómo se estructura el contenido antes de
pensar en el diseño.

## Qué pide el enunciado

1. Una página con una lista ordenada y una desordenada.
2. Una tabla con el horario del ciclo, con cabecera y celdas combinadas.

## Paso a paso

### 1 · `Listas.html`

```html
<ol type="a" start="2">
  <li>a</li>
  <li>b</li>
  <li>c</li>
</ol>

<ul>
  <li>a</li>
  <li>b</li>
  <li>c</li>
</ul>
```

- `<ol>` es una lista **ordenada**: numera sola.
- `type="a"` cambia la numeración por letras.
- `start="2"` empieza por la segunda, no por la primera.
- `<ul>` es desordenada: viñetas, sin orden.

`Listas.html` es el ejemplo mínimo; `PruebaListas.html` repite la idea con más
variantes para comparar.

### 2 · `03-tabla-horarios-daw.html`

La tabla del horario usa las tres partes que debe tener una tabla de datos:

```html
<table>
  <caption>Segundo curso - Grupo A (turno de tarde)</caption>
  <thead>
    <tr><th>Hora</th><th>Lunes</th>...</tr>
  </thead>
  <tbody>
    <tr><th>15:00</th><td>DWEC</td>...</tr>
  </tbody>
</table>
```

- `caption` describe la tabla y va dentro de `table`.
- `thead` agrupa la fila de títulos, con `<th>`.
- `tbody` agrupa los datos.
- `th` para celdas de cabecera, `td` para datos.
- `colspan` une columnas (el recreo ocupa todas las horas) y `rowspan` une filas.

El CSS de la tabla va en un `<style>` y usa tres reglas mínimas:

```css
table { border-collapse: collapse; }        /* sin bordes dobles */
th, td { border: 1px solid #888; padding: 8px; }
thead th { background-color: #ddd; }        /* cabecera distinguida */
```

`border-collapse: collapse` es lo que evita el efecto de doble borde entre celdas.

## El código, pieza a pieza

```
Ejercicios/
├── Listas.html                 ejemplo mínimo de ol y ul
├── PruebaListas.html           variantes de listas
└── 03-tabla-horarios-daw.html  tabla del horario, comentada etiqueta a etiqueta
```

## Trampas y dudas

- **`start` empieza a contar en 1.** `start="2"` hace que la lista empiece por la
  letra b.
- **Una tabla sin `thead`/`tbody` funciona**, pero el navegador no distingue
  cabecera de datos y la accesibilidad empeora.
- **`colspan` cuenta celdas, no horas.** Si la fila tiene cinco columnas de día,
  `colspan="5"` ocupa la fila entera.
- **Las tablas no son para maquetar.** Para colocar bloques se usa CSS (grid o
  flex); la tabla es para datos tabulados.

## Si me preguntan

- **¿`ol` o `ul`?** `ol` cuando el orden importa (pasos, ranking), `ul` cuando no.
- **¿Por qué `th` y no `td` en negrita?** Porque `th` aporta significado: los
  lectores de pantalla lo anuncian como cabecera.
- **¿`caption` o un `h2` encima?** `caption` está asociado a la tabla; un `h2`
  suelto no.
