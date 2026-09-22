# Ejercicio 1 — Arquitecturas y Tecnologías sobre Clientes Web

> Materia: Desarrollo Web en Entorno Cliente
> Curso: 2º DAW
> Fecha: 22/09/2026
> Archivos: ver **[4. Estructura de archivos](#4-estructura-de-archivos)**

---

## 1. Resumen del tema: modelos de ejecución cliente / servidor

Toda aplicación web funciona con el **modelo cliente/servidor**, donde el trabajo se reparte entre dos máquinas conectadas por internet:

| Dimensión | Entorno Cliente (Front-end) | Entorno Servidor (Back-end) |
|---|---|---|
| **Dónde se ejecuta** | Navegador del usuario (Chrome, Firefox, Safari, Edge) | Servidor remoto físico o instancia en la nube (AWS) |
| **Visibilidad del código** | **Público**: se inspecciona con F12 / DevTools | **Privado**: reside solo en el servidor |
| **Tecnologías clave** | HTML5, CSS3, JavaScript (React, Vue, Angular) | PHP, Python, Java, Node.js, C# (.NET) |
| **Acceso a datos** | Indirecto: peticiones HTTP | Directo: conexión SQL / NoSQL |
| **Consumo de recursos** | CPU, RAM y batería del dispositivo local | Potencia de cómputo y memoria del servidor |
| **Seguridad** | Bajo: modificable por el cliente | Alto: núcleo fiable (cobros, roles, permisos) |

### Los 3 pilares del front-end
- **HTML** → estructura del documento (títulos, párrafos, tablas, formularios).
- **CSS** → presentación visual (colores, tipografías, maquetación responsive).
- **JavaScript** → capa lógica interactiva (eventos, DOM dinámico, validación local).

### Premisa de seguridad
El código de cliente es **completamente público**. Con F12 / DevTools cualquier usuario puede ver, auditar y modificar el HTML y el JavaScript. Por tanto, **claves, contraseñas y operaciones contables jamás deben vivir en el cliente**: eso siempre es back-end.

### ¿Qué va en el cliente y qué en el servidor?
- **Cliente (inmediatez y usabilidad):** desplegar/ocultar menús, animaciones, hover, y **ordenar/filtrar colecciones ya cargadas en memoria**.
- **Servidor (integridad y seguridad):** cobros con pasarelas de pago, consultas sobre millones de registros, comprobación de privilegios y roles.

### Evolución: Web clásica → SPA
- **Web clásica:** cada clic dispara una petición síncrona, el servidor regenera todo el HTML y la página entera parpadea.
- **Web moderna (SPA):** la plantilla se descarga una sola vez, y JavaScript pide únicamente datos (JSON) para **actualizar de forma selectiva** el árbol visual sin recargar la página.

---

## 2. Qué he hecho y por qué (las 3 modificaciones guiadas)

La práctica pide tomar `catalogo.html` y aplicar 3 cambios, sustituyendo el procesamiento del servidor por procesamiento **en el cliente**. Resultado entregado en `PracticaDepuracion/catalogoPrueba.html`, comentado por partes.

### M3 — Generación de datos (prueba de estrés en RAM)
- **Antes:** `TOTAL_REGISTROS = 150000` (150.000 productos).
- **Ahora:** `TOTAL_REGISTROS = 500000` (500.000 productos).
- **Por qué:** al generar 500.000 objetos en el navegador se observa con el Gestor de Tareas un **mayor consumo de RAM local** del dispositivo y un tiempo mayor en `console.time` que con 150.000.

### M1 — Invertir criterio de ordenación (CPU intensiva)
- **Antes:** `catalogoProductos.sort((a, b) => a.precio - b.precio)` → ascendente (más barato primero).
- **Ahora:** `catalogoProductos.sort((a, b) => b.precio - a.precio)` → **descendente** (más caro primero).
- **Ajuste de salida:** el mensaje muestra primero el producto **más caro** y después el **más barato**.
- **Por qué:** sort() consume intensivamente la CPU del navegador; invertir el predicado demuestra que el algoritmo se ejecuta con recursos locales.

### M2 — Cambiar la categoría del filtro
- **Antes:** `categoria === "Informática"`.
- **Ahora:** `categoria === "Telefonía"`.
- **Por qué:** se mantiene la lógica de `.filter()` (procesamiento declarativo que **asigna nueva memoria**), pero seleccionando otra categoría. El servidor no ejecuta ninguna consulta SQL.

---

## 3. Cuestionario de análisis técnico

### Cuestión 1 — Auditoría de tiempos con `console.time`
> ¿El tiempo consumido por el navegador (150.000 vs 500.000 elementos) crece de forma lineal o en otra proporción?

**Método usado:** `catalogoPrueba1.html` genera el array, lo ordena y lo filtra a 4 tamaños (150k, 200k, 250k, 500k) midiendo con `performance.now()`. Cada botón *Generar* **resetea la RAM** antes de rellenar, y se repite varias veces para mitigar warm-up y garbage collector.

**Mediciones reales — GENERACIÓN (4 pasadas por tamaño):**

| Tamaño | Medidas (ms) | Media | Coste / 1.000 reg. |
|---|---|---|---|
| 150.000 | 59,2 · 45,4 · 34,6 · 53,3 | **48,13** | 0,321 |
| 200.000 | 85,8 · 59,2 · 85,8 · 56,0 | **71,70** | 0,359 |
| 250.000 | 80,9 · 71,5 · 83,7 · 103,7 | **84,95** | 0,340 |
| 500.000 | 184,7 · 156,9 · 146,7 · 192,0 | **170,08** | 0,340 |

**Mediciones reales — ORDENACIÓN y FILTRADO (1 pasada):**

| Tamaño | Ordenación (ms) | Filtrado (ms) | Registros Telefonía |
|---|---|---|---|
| 150.000 | 131,40 | 5,10 | 30.053 (20,0 %) |
| 200.000 | 98,50 | 7,40 | 39.945 (20,0 %) |
| 250.000 | 126,70 | 17,60 | 50.038 (20,0 %) |
| 500.000 | 293,20 | 42,00 | 100.604 (20,1 %) |

**Ratios clave (media):**

| Comparación | Generación real | Esperado si fuese proporcional |
|---|---|---|
| 200k / 150k | 1,49× | 1,33× |
| 250k / 150k | 1,77× | 1,67× |
| 500k / 150k | 3,53× | 3,33× |

**Conclusión de la Cuestión 1:**
- La **generación** crece de forma **lineal**: el coste por registro se mantiene prácticamente constante (≈ 0,32–0,36 ms/1.000 en todos los tamaños) y multiplicar los datos ×3,33 sube el tiempo ~×3,53 (+6 % de ruido por GC).
- El **filtrado** es O(n) lineal (es un recorrido), pero al ser 1 sola pasada le afectó el GC (picos en 250k y 500k), lo que disparó los ratios.
- La **ordenación** usa `sort` (Timsort en Chrome), complejidad de peor caso **O(n·log n)**, con lo que crece **algo más que lineal**. Con 1 sola pasada el ruido (warm-up: ordenar 200k salió más rápido que 150k) impide afirmar un número exacto; habría exigido repetir.
- Dato fiable adicional: la categoría **Telefonía representa ~20 %** en los 4 tamaños → confirma la distribución uniforme al generar con `Math.random()`.

> **Lineal vs proporcional (matiz importante):** la generación es **lineal** pero **no estrictamente proporcional**. Proporcional exigiría que el cociente tiempo/datos fuese exactamente constante y que la recta pasara por el origen; en la práctica hay un **coste fijo** (reservar el array, arranque del motor JS, warm-up) más **ruido del GC**, por eso la recta de tiempos no pasa por (0,0) y los ratios salen 1,49 en vez de 1,33. La proporcionalidad es un caso particular de linealidad en el que el término independiente es 0.

### Cuestión 2 — Ahorro de procesamiento en el servidor (10.000 usuarios)
> Si 10.000 usuarios consultan y reordenan el catálogo a la vez, ¿cuánto trabajo ejecutan los navegadores? ¿Qué beneficio le aporta a la empresa que esto corra en el cliente en lugar de lanzar ORDER BY al servidor?

**Respuesta:** los 10.000 navegadores ejecutan **10.000 copias paralelas** del algoritmo de ordenación/filtro, cada una usando la RAM y CPU de su propio dispositivo. La empresa lo mide y queda encriptado en el cronómetro de cada equipo.

El beneficio clave es **descargar el servidor**:
- El servidor **no** ejecuta 10.000 consultas `ORDER BY` ni consume hilos/CPU en la base de datos.
- Se elimina el cuello de botella centralizado: en vez de 10.000 peticiones SQL concurrentes, solo hay peticiones HTTP ligeras (una única carga de datos) y el cómputo se reparte gratis a 10.000 dispositivos.
- **Escala horizontal ilimitada:** cuantos más usuarios, más CPUs "gratuitas" aportan sus propios navegadores.
- El servidor queda libre para tareas que sí le corresponden: seguridad, cobros y consultas que no deban ir al cliente.

### Cuestión 3 — Límite arquitectónico y necesidad de paginación
> Si el inventario contara con 8 millones de registros, ¿sería viable descargarlos todos en un solo array en el navegador para que el cliente los ordene? ¿Qué solución propondrías?

**Respuesta: NO es viable.** Enviar 8 millones de registros al navegador provocaría:
- **Agotamiento de RAM** del dispositivo (miles de objetos en un solo array) y posible congelación del navegador.
- **Lentitud de red:** descargar millones de registros por HTTP es lento y gastaría la batería/datos móviles.
- **Filtrado/ordenación inviable en el cliente** con tantos objetos sin paginar.

**Solución propuesta: paginación + búsqueda declarativa en servidor (o virtualización):**
1. **Paginación (página 1..N):** el servidor devuelve solo ~50-200 registros por página con SQL `LIMIT/OFFSET`, y las consultas de ordenado/filtrado se hacen **en el servidor** (índices, `ORDER BY`, `WHERE`).
2. **Búsqueda con `LIKE`/Full-Text / índices** para localizar sin traer todo.
3. **Scroll infinito / virtualización (react-window, paginación en el front)** para pintar solo los elementos visibles y no crear 8 millones de nodos DOM.
4. **Caché y filtros en servidor** para evitar transferir todo el catálogo.

Con esto, el peso donde corresponde: cómputo y filtrado SQL en el servidor, y en el cliente solo la visualización de la página actual → se cumple el principio "lo que requiere integridad/seguridad va al servidor".

---

## 4. Estructura de archivos

```
Entorno Cliente\Ejercicio1\
├── Ejercicio1.md                        ← este documento (análisis y cuestionario)
├── PracticaDepuracion\                  ← la práctica guiada con breakpoints para ver los pasos
│   ├── catalogoPrueba.html              ← copia comentada con JS inline
│   ├── catalogoPruebaSeparado.html      ← versión con JS externo (Sources → script.js)
│   └── script.js                        ← JS externo con los 3 `debugger;`
└── MedicionTiempos\                     ← pruebas para medir tiempos a mano (Cuestión 1)
    └── catalogoPrueba1.html             ← botones 150k/200k/250k/500k + ordenar/filtrar + limpiar RAM
```

- `PracticaDepuracion/catalogoPrueba.html` y `catalogoPruebaSeparado.html` — HTML interactivos comentados por partes (generación, ordenación descendente, filtrado Telefonía) que ejecutan el procesamiento en la CPU/RAM del navegador e incluyen `debugger;` para auditar paso a paso con F12.
- `MedicionTiempos/catalogoPrueba1.html` — herramienta de medición de tiempo en ms (generación, ordenación, filtrado) para responder la Cuestión 1, con botón de limpieza de RAM.
