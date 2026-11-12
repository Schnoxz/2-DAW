# Cuadernillo de HTML — Tema 2

Resumen del Tema 2 (HTML) de Diseño de Interfaces Web preparado para el
examen escrito en papel. 51 páginas en A4.

## Archivos

| Archivo | Qué es |
|---|---|
| `Tema2_HTML_Teoria_Examen.pdf` | El cuadernillo listo para imprimir |
| `teoria-examen-html.md` | El contenido, en Markdown |
| `estilo-print.css` | El diseño de impresión (A4, tipografía, cajas) |
| `build.ps1` | Genera el PDF a partir del Markdown y el CSS |
| `_teoria.html` | HTML intermedio que se pasa a Edge (se regenera) |

## Contenido

1. Cómo se escribe una etiqueta (anatomía, vacías, anidamiento, entidades, errores)
2. Bloques y elementos en línea
3. El documento HTML completo (DOCTYPE, head, body, charset, viewport)
4. Texto, listas y contenido
5. Enlaces e imágenes (tres formas de poner imágenes en fila)
6. Elementos semánticos
7. Tablas (anatomía, alineación, `colspan` y `rowspan` con un horario resuelto)
8. Formularios
9. Contenido incrustado (`iframe`, `video`, `audio`, `svg`)
10. El CSS que acompaña al HTML
11. Simulacro de examen resuelto
12. Rellenar huecos (40 frases con soluciones)
13. Busca el error (14 fragmentos corregidos)
14. Chuleta final
15. Recursos y temario

Cada sección empieza en página nueva. Los temas 1 a 10 son teoría; del 11 al
13, práctica; el 14 es la chuleta y el 15 los enlaces de eniun del temario.

## Cómo regenerar el PDF

```powershell
.\build.ps1
```

Necesita **pandoc** y **Microsoft Edge** instalados. El script genera
`_teoria.html` con el CSS incrustado y luego llama a Edge en modo headless
para imprimirlo a PDF con `--no-pdf-header-footer`.

Si cambias el contenido, edita `teoria-examen-html.md`; si cambias el aspecto,
`estilo-print.css`. No hace falta tocar el HTML intermedio.

## Decisiones de maquetación

- **A4 con márgenes de 13/12/14/12 mm**, letra de 9,3 pt y `pre` de 7,55 pt:
  cabe mucho por página sin que cueste leerlo en papel.
- **La portada es un bloque normal**, no un `flex`. Con `flex` y altura fija,
  Edge partía la portada en dos páginas.
- **`page-break-before: always` en los `h1`**, para que cada tema empiece en
  página nueva y sea fácil de localizar hojeando.
- **El diagrama de la caja (modelo `margin`/`border`/`padding`) va dentro de
  `.keep`** para que no se parta entre dos páginas.
- **Sin números de página**: Chrome y Edge no los generan desde CSS en modo
  headless, y el índice enlaza por anclas internas, no por página.

## Aviso

Los márgenes laterales son de 12 mm, así que si vas a encuadernar conviene
imprimir con un pequeño desplazamiento interior para que no se coma el texto
del margen izquierdo.
