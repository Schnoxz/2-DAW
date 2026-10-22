# Etiquetas del epígrafe 'Contenido incrustado' (HTML)

Según la captura del trabajo y lo que pide el enunciado:

## Etiquetas principales para contenido incrustado
| Etiqueta | Uso | Ejemplo |
|---|---|---|
| <img> | Imágenes | <img src="imagen.jpg" alt="texto alternativo"> |
| <iframe> | Incrustar otra página web | <iframe src="https://es.wikipedia.org/wiki/HTML" width="300" height="200"></iframe> |
| <video> | Reproductor de vídeo | <video src="video.mp4" controls></video> |
| <source> | Fuentes alternativas para vídeo/audio | <source src="video.webm" type="video/webm"> |
| <audio> | Reproductor de audio | <audio src="audio.mp3" controls></audio> |
| <canvas> | Lienzo para dibujar con JavaScript (sólo estructura) | <canvas width="200" height="100"></canvas> |
| <embed> | Incrustar contenido externo (PDF, audio, etc.) | <embed src="archivo.pdf" type="application/pdf" width="300" height="200"> |
| <object> | Incrustar objetos externos con alternativa | <object data="archivo.pdf" type="application/pdf" width="300" height="200">Texto alternativo</object> |
| <svg> | Gráficos vectoriales | <svg width="100" height="100"><circle cx="50" cy="50" r="40"/></svg> |

## Notas para el trabajo
- **Dos niveles**: index.html (nivel 1) y detalle.html (nivel 2) enlazados con <a href>.
- **No es obligatorio duplicar todo**: basta con usar las etiquetas. Puedes poner unas en index.html y otras en detalle.html.
- **Iframe con webs**: Si el sitio bloquea X-Frame-Options, puede no mostrarse, pero la etiqueta está correctamente usada. Usar sitios que lo permitan (como Wikipedia) funciona mejor.
- **CSS simplista**: Con <style> es suficiente, tal como pide la rúbrica.
