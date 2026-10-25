# Ejercicios de HTML con estilos

Nueve ejercicios de HTML con estilos inspirados en la propuesta de
[infogonzalez](https://infogonzalez.com/%F0%9F%93%9A-post-de-ejercicios-resueltos-html-nivel-medio/),
con contexto de Algeciras, del ciclo DAW y de Historia.

Cada ejemplo es un archivo HTML independiente. Todos incluyen la URL de la fuente
de los datos utilizados.

## Lista de ejercicios

| N.º | Archivo | Contenido HTML | Contexto | Fuente de los datos |
|----|---------|----------------|----------|---------------------|
| 1 | `01-noticia-algeciras.html` | Títulos, párrafos, listas, cita y `span` | Algeciras | https://es.wikipedia.org/wiki/Algeciras |
| 2 | `02-formulario-matricula-daw.html` | `form`, `label`, `input`, `select`, `textarea`, `fieldset` | DAW | https://www.todofp.es/que-estudiar/loe/informatica-comunicaciones/des-aplicaciones-web.html |
| 3 | `03-tabla-horarios-daw.html` | `table`, `caption`, `thead`, `tbody`, `th`, `td`, `colspan` | DAW | Horario del I.E.S. Kursaal (2026/2027) |
| 4 | `04-galeria-algeciras.html` | `figure`, `figcaption`, `img` | Algeciras | https://commons.wikimedia.org/ (fotos de Algeciras) |
| 5 | `05-video-historia.html` | `video`, `source`, `track` (dos idiomas) y `poster` | Algeciras / DAW | https://www.youtube.com/watch?v=aNmCmn6cEk8 · https://es.wikipedia.org/wiki/Algeciras |
| 6 | `06-404.html` | Página de error con enlace de vuelta | DAW | — (página propia) |
| 7 | `07-tarjetas-tecnologia.html` | `div`, clases y estilos básicos | DAW | https://es.wikipedia.org/wiki/HTML · https://es.wikipedia.org/wiki/CSS · https://es.wikipedia.org/wiki/JavaScript |
| 8 | `08-landing-daw.html` | `header`, `nav`, presentación y botón | DAW | https://www.todofp.es/que-estudiar/loe/informatica-comunicaciones/des-aplicaciones-web.html |
| 9 | `09-linea-tiempo-historia.html` | `ol`, `li`, `dl`, `dt`, `dd` | Historia | https://es.wikipedia.org/wiki/Historia_de_Algeciras |

`ejercicios/index.html` es un índice con enlaces a los nueve ejercicios.

## Cómo verlo

Abre `ejercicios/index.html` en el navegador y entra en cada ejercicio. El vídeo
y los subtítulos funcionan al abrir el HTML directamente. Si quieres editar los
subtítulos, los archivos `.vtt` están en `ejercicios/assets/`.

## Estilos

Cada archivo usa una hoja `<style>` propia, embebida en el propio HTML, con
estilos mínimos: casi todo son selectores de etiqueta (`body`, `h1`, `h2`, `p`,
`table`, `th`, `td`, `img`…). La única clase es `.tarjeta`, en el ejercicio 7,
porque ese ejercicio trata precisamente de clases. No hay JavaScript ni
frameworks externos. El CSS va comentado regla por regla y compactado en una
sola línea; el HTML también lleva comentarios que explican las etiquetas
principales.

## Recursos

- `ejercicios/assets/`: seis fotografías reales de Algeciras descargadas de
  Wikimedia Commons (para el ejercicio 4), las dos pistas de subtítulos `.vtt`
  (español e inglés) y el vídeo del ejercicio 5 (`algeciras.mp4`, 24 s, 360p,
  1,1 MB) con su póster (`algeciras-poster.jpg`).
- El vídeo del ejercicio 5 es un clip descargado de YouTube y recomprimido para
  que pese poco. Los subtítulos están integrados en el HTML como data URI para
  que funcionen con `file://`; los `.vtt` quedan en `assets/` por si hay que
  editarlos.

## Capturas

En `capturas/` están las capturas de pantalla de cada ejercicio, reunidas también en
`Ejercicios de HTML con estilos - Capturas.pdf`. El PDF tiene una página por
ejercicio con el título y la captura, sin texto adicional.

## Autoría

2.º DAW · I.E.S. Kursaal
