# 00 · Índice y ruta de aprendizaje

> Apuntes propios para aprender **HTML y CSS desde cero**, pensados para ir avanzando poco a poco
> sin agobios. Cada apunte es corto: léelo, copia los ejemplos y **toça el código a mano**.

---

## ¿Qué vas a aprender aquí?

- **HTML** → la *estructura* de la página. Qué hay, en qué orden y qué significa.
- **CSS** → la *apariencia*. Colores, tamaños, espacios, posiciones.

Una frase que te va a servir toda la carrera:

> **HTML es el esqueleto, CSS es la piel.** Si el esqueleto está mal, ningún maquillaje lo arregla.

---

## Los apuntes, en orden

| # | Apunte | Qué te llevas |
|---|--------|---------------|
| 00 | [Índice y ruta de aprendizaje](00%20-%20%C3%8Dndice%20y%20ruta%20de%20aprendizaje.md) | El orden y el método de estudio |
| 01 | [Qué es HTML y qué hace el navegador](01%20-%20Qu%C3%A9%20es%20HTML%20y%20qu%C3%A9%20hace%20el%20navegador.md) | La idea mental correcta: HTML no es "programar" |
| 02 | [La estructura mínima de un documento HTML](02%20-%20La%20estructura%20m%C3%ADnima%20de%20un%20documento%20HTML.md) | El esqueleto obligatorio de cualquier página |
| 03 | [Etiquetas de contenido y organización del texto](03%20-%20Etiquetas%20de%20contenido%20y%20organizaci%C3%B3n%20del%20texto.md) | Encabezados, párrafos, listas, énfasis, texto semántico |
| 04 | [Enlaces e imágenes](04%20-%20Enlaces%20e%20im%C3%A1genes.md) | La web es hipertexto: `a` e `img` |
| 05 | [Elementos semánticos](05%20-%20Elementos%20sem%C3%A1nticos.md) | `header`, `nav`, `main`, `footer`... y por qué importan |
| 06 | [Tablas en HTML](06%20-%20Tablas%20en%20HTML.md) | `table`, `tr`, `td`... y cuándo **no** usarlas |
| 07 | [Formularios](07%20-%20Formularios.md) | `form`, `input`, `label`, `select`... |
| 08 | [CSS, qué es y cómo se enlaza](08%20-%20CSS%2C%20qu%C3%A9%20es%20y%20c%C3%B3mo%20se%20enlaza.md) | Los tres métodos de meter CSS y cuál usar |
| 09 | [CSS, selectores, modelo de caja y cascada](09%20-%20CSS%2C%20selectores%2C%20modelo%20de%20caja%20y%20cascada.md) | Cómo se pican las reglas entre sí |
| 10 | [Práctica guiada, página completa](10%20-%20Pr%C3%A1ctica%20guiada%2C%20p%C3%A1gina%20completa.md) | Juntas todo en una sola página real |

---

## Método: cómo estudiar esto de verdad

Esto es lo que separa a quien **entiende** HTML de quien solo copia y pega.

1. **Nada de copiar y pegar.** Escribe cada ejemplo a mano. Suena viejo, pero escribirlo es lo que crea la memoria muscular.
2. **Rompe las cosas a propósito.** Borra una etiqueta de cierre y mira qué pasa. Añade texto suelto sin etiqueta. Abre el HTML en el navegador *antes* de tocar el CSS.
3. **Usa el inspector** (`F12` o clic derecho → *Inspeccionar*). Cambia etiquetas en vivo: es el mejor profesor que vas a tener.
4. **No busques la etiqueta perfecta.** Al principio casi todo se resuelve con `<div>`, `<p>` y `<h1>`. Las etiquetas especiales se aprenden usándolas, no leyendo listas.
5. **Un concepto = un apunte.** Si algo no lo entiendes, vuelve al apunte en vez de seguir hacia abajo.

### Herramientas que vas a necesitar

- **Editor de texto**: [VS Code](https://code.visualstudio.com/) (el que usa el profe seguro). Solo con esto vale.
- **Navegador**: Chrome o Firefox. Con el **inspector** incluido.
- **Validador**: [validator.w3.org/nu/](https://validator.w3.org/nu/) — pegas tu HTML y te dice qué está mal. Ojo: en DAW **no valen los <div> sueltos**.

---

## Las 3 trampas del principiante

1. **Olvidar `alt` en las imágenes** → aviso de accesibilidad siempre.
2. **Cerrar mal las etiquetas** (`<p>` no se cierra, `<div>` sí). Es la causa nº 1 de "mi web se ha roto sola".
3. **Querer posicionar con `<div>` + `margin`**. Eso se hace con CSS. HTML solo describe *qué* es cada cosa.

---

*Siguiente apunte → [01 · Qué es HTML y qué hace el navegador](01%20-%20Qu%C3%A9%20es%20HTML%20y%20qu%C3%A9%20hace%20el%20navegador.md)*
