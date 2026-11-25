# Tema 1 · Análisis de calidad web

## De qué va

Es el trabajo de análisis del tema 1: coger una web real y medirla con una
herramienta profesional. No es opinar si la página es bonita, es sacar números y
explicar qué significan.

Se analiza `ieskursaal.es` con **PageSpeed Insights**, la herramienta gratuita de
Google que ejecuta Lighthouse sobre una URL.

## Qué pide el enunciado

- Analizar una página web con PageSpeed Insights.
- Explicar las métricas y las cuatro categorías que mide.
- Interpretar los resultados y proponer un plan de mejora.

## Paso a paso

### 1 · Condiciones de la prueba

Antes de mirar la nota hay que fijar el escenario, porque los resultados cambian
mucho según el dispositivo.

- Dispositivo emulado: **Moto G Power**, gama media.
- Conexión: **4G lenta**.
- Lighthouse 13.5.0 sobre HeadlessChromium.
- Fecha y hora del análisis, y una sola sesión de carga.

Analizar en móvil es lo lógico: es el escenario más habitual y el que peor se
comporta.

### 2 · Las métricas

| Métrica | Qué mide | Bien | Malo |
|---|---|---|---|
| **FCP** | cuándo aparece el primer texto o imagen | ≤ 1,8 s | > 3,0 s |
| **LCP** | cuándo se pinta el elemento grande | ≤ 2,5 s | > 4,0 s |
| **TBT** | tiempo con el hilo bloqueado por JavaScript | ≤ 200 ms | > 600 ms |
| **CLS** | saltos de elementos mientras carga | ≤ 0,1 | > 0,25 |
| **SI** | velocidad media de pintado | ≤ 3,4 s | > 5,8 s |

Las cuatro categorías son rendimiento, accesibilidad, prácticas recomendadas y SEO.

### 3 · Los resultados

| Categoría | Puntuación |
|---|---|
| Rendimiento | **63** / 100 |
| Accesibilidad | **89** / 100 |
| Prácticas recomendadas | **73** / 100 |
| SEO | **92** / 100 |

Y las métricas de la prueba:

| Métrica | Valor | Diagnóstico |
|---|---|---|
| FCP | 5,0 s | malo |
| LCP | **8,7 s** | malo |
| TBT | 0 ms | bien |
| CLS | 0,001 | bien |
| Speed Index | 5,0 s | mejorable |

### 4 · Qué dicen los números

El contraste es el hallazgo interesante: la página **no salta** mientras carga
(CLS casi cero) y el JavaScript **no bloquea** el hilo (TBT 0 ms). El problema es
que tarda muchísimo en pintar, sobre todo el elemento principal: 8,7 segundos de
LCP son más del triple del límite.

Eso apunta a recursos pesados que retrasan el primer pintado: imágenes sin
optimizar, fuentes que bloquean, CSS crítico que no está en línea.

### 5 · Plan de mejora

1. **Comprimir y redimensionar las imágenes** y servirlas en formatos modernos
   (WebP o AVIF) con `srcset` para no bajar una imagen de 2000 px a un móvil.
2. **Cargar las imágenes de debajo del pliegue en diferido** (`loading="lazy"`).
3. **Eliminar el CSS y el JavaScript que bloquean el renderizado**, o cargarlos con
   `defer` / `async`.
4. **Servir el texto crítico con el HTML** y el resto de estilos después.
5. **Activar caché y compresión** en el servidor, y HTTP/2.

Con eso se ataca justo lo que falla: FCP y LCP. El resto de categorías ya están
por encima del 70 y se pueden subir con ajustes pequeños de contraste y metadatos.

## El código, pieza a pieza

```
Analisis de calidad web/
├── Analisis_calidad_web_ieskursaal.pdf   informe con los datos y las gráficas
└── capturas/psi-movil.png                captura del análisis en móvil
```

## Trampas y dudas

- **La nota cambia en cada pasada.** Es una medición, no una propiedad de la web:
  hay que anotar fecha, dispositivo y conexión.
- **100 no existe en la práctica.** Rendimiento por encima de 90 ya es bueno.
- **CLS bajo no significa que la página sea buena.** Solo dice que no se mueve.
- **No se arregla con CSS.** La mayor parte de estas mejoras son de servidor y de
  peso de los recursos.

## Si me preguntan

- **¿Qué diferencia hay entre FCP y LCP?** FCP es lo primero que aparece; LCP es lo
  más grande, que es cuando el usuario percibe que la página está lista.
- **¿Por qué TBT puede ser 0 y el LCP malo?** Porque el problema no es el
  JavaScript, sino los recursos (imágenes, fuentes) que tardan en llegar.
- **¿Sirve para SEO?** Sí: Google usa estas métricas como señal de experiencia de
  página, aunque el SEO depende de más cosas.
