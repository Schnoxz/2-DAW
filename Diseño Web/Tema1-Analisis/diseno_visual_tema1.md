# Dirección de arte · Tema 1 "Nada es casualidad: todo es causalidad"
### Sistema visual para recrear en Gamma (paleta, tipografía, rejilla y objetos)

> **Concepto:** *sobrio, cálido y comunicativo*. Nada de colores vivos ni efectos: papel, tiza, tierra.
> El protagonismo lo tiene la **tipografía**, el **espacio en blanco** y la **línea fina**.
> El único color con fuerza es un **terracota apagado**, que aparece muy poco y siempre para señalar
> **atención** (CTAs, puntos clave, el dato importante de la diapositiva).

---

## 1. Paleta (usar exactamente estos códigos)

| Nombre | Hex | Uso |
|---|---|---|
| **Blanco roto** | `#F4F0E8` | Fondo principal de casi todas las diapositivas |
| **Arena** | `#EAE3D6` | Superficies suaves: tarjetas, paneles, bandas |
| **Piedra** | `#D3C9B8` | Líneas, bordes, rellenos neutros, retículas |
| **Tabaco** | `#6E6152` | Texto secundario, subtítulos, etiquetas, iconos |
| **Cacao** | `#2B2521` | Texto principal (el "negro marrón") y titulares |
| **Negro marrón** | `#1E1915` | Fondo oscuro alterno (portada, cierre, diapositivas de impacto) |
| **Terracota** | `#B07A57` | **Acento único de atención**: CTA, punto clave, dato destacado |
| **Oliva** | `#8C8A63` | Acento secundario: "correcto / natural / ok" |
| **Camel** | `#C9A57C` | Acento terciario: datos, gráficos, series |

**Reglas de color**

- Fondo = **blanco roto** (o **negro marrón** en portada, cierre y 2-3 diapositivas de golpe de efecto).
- Texto = **cacao**; nunca negro puro `#000`.
- **Terracota** se usa **una sola vez por diapositiva** como máximo, y siempre señalando lo importante.
- Nada de degradados, sombras duras ni más de un acento por tarjeta.

**Accesibilidad (contraste)**

| Combinación | Contraste aprox. | Veredicto |
|---|---|---|
| Cacao sobre blanco roto | ≈13:1 | ✅ perfecto para texto |
| Tabaco sobre blanco roto | ≈4,9:1 | ✅ texto secundario |
| Blanco roto sobre negro marrón | ≈13:1 | ✅ texto sobre fondo oscuro |
| Terracota sobre blanco roto | ≈3,2:1 | ⚠️ solo texto **grande** y elementos gráficos, nunca párrafos |

---

## 2. Tipografía

| Rol | Fuente propuesta | Alternativas | Tratamiento |
|---|---|---|---|
| **Titulares** | *Fraunces* (serif suave) | *Playfair Display*, *Lora*, cualquier serif de contraste moderado | Cacao, interlineado ajustado, mucho aire |
| **Cuerpo y datos** | *Inter* (sans humanista) | *Source Sans 3*, *Work Sans*, cualquier sans neutra | Tabaco / cacao, 22-24 px |
| **Etiquetas y números** | La sans, MAYÚSCULAS | — | Letter-spacing amplio (0,12em), tabaco, 14-16 px |

> Si Gamma no tiene esas fuentes exactas, **prioriza**: titulares = serif editorial; cuerpo = sans
> neutra. Y elige el **tema/generador de estilo "Minimalista / Editorial"** y personaliza el fondo al
> blanco roto.

**Jerarquía (sobre 1920×1080)**

| Nivel | Tamaño | Notas |
|---|---|---|
| Título de portada | 96-120 px | Serif |
| Título de diapositiva | 56-64 px | Serif, máx. 2 líneas |
| Subtítulo / idea | 28-32 px | Sans, tabaco |
| Cuerpo / bullets | 22-24 px | Sans, máx. 3-4 líneas cada uno |
| Etiqueta / pie | 14-16 px | Sans, MAYÚSCULAS espaciadas |

---

## 3. Rejilla y espaciado

- **Formato 16:9** (1920×1080).
- **Rejilla de 12 columnas**: margen exterior `96 px`, canal (gutter) `24 px`.
- **Línea base** de 8 px para alinear bloques.
- Zonas fijas de cada diapositiva:
  - **Cabecera de tarjeta:** título arriba-izquierda (color cacao).
  - **Cuerpo:** contenido a la izquierda y/o objeto visual a la derecha (alternando).
  - **Pie:** línea fina `1px #D3C9B8` + etiqueta a la izquierda "TEMA 1 · DISEÑO DE INTERFACES" y
    número de diapositiva a la derecha (tabaco).
- **Aire:** como mínimo el 30 % de cada tarjeta debe quedar vacío.
- **Bordes:** radios suaves `12-16 px` en tarjetas; `999 px` (píldora) en botones.

---

## 4. Biblioteca de objetos (lo que debe dibujar Gamma)

> Todos los objetos comparten el mismo lenguaje: **ilustración vectorial plana, línea fina de 1-2 px
> en `#6E6152` o `#2B2521`, sin sombras, sin degradados**, sobre el fondo blanco roto, con **terracota
> solo como acento puntual**. Estilo "plano editorial", nunca caricaturesco ni 3D.

| # | Objeto | Descripción que le das a Gamma |
|---|---|---|
| **O1** | **Muestra de color (swatch)** | Círculo o cuadradito de 48 px con el color, y debajo su nombre y el hex en etiqueta pequeña. |
| **O2** | **Círculo cromático** | Anillo dividido en 12 porciones de tonos **apagados** (tierra, oliva, terracota, azul grisáceo, etc.). Línea fina entre porciones. |
| **O3** | **Comparativa de formas** | Cuadrado y círculo lado a lado, solo contorno fino, con las esquinas del cuadrado marcadas para mostrar su "filo". |
| **O4** | **Tira de formas** | Círculo · cuadrado · rectángulo · esfera, cada uno seguido de su aplicación en web (avatar, tarjeta, bloque, sello). |
| **O5** | **Mockup de móvil** | Marco de teléfono de líneas finas con una interfaz esquemática: barra superior, dos tarjetas redondeadas y un botón píldora terracota. |
| **O6** | **Wireframe de web** | Rectángulo con cabecera, hero, fila de 3 tarjetas y pie; todo con rectángulos redondeados y líneas finas. |
| **O7** | **Retícula de tercios** | Cuadrado dividido en 9 con 2 líneas verticales y 2 horizontales finas, y 4 puntos terracota en los cruces. |
| **O8** | **Mapa de mirada** | Wireframe gris con trazos de calor suaves (manchas beige/terracota al 30 %) formando un patrón **F** y otro **Z**, con puntos de fijación. |
| **O9** | **Diagrama de espaciado** | Bloque central con cotas y líneas de medida: margen, padding interno y gutter entre columnas, etiquetados. |
| **O10** | **Rejilla de columnas** | 12 barras verticales finas (piedra) indicando las columnas del layout. |
| **O11** | **Anatomía de web anotada** | El wireframe O6 con **líneas guía y etiquetas** señalando: cabecera, menú, hero, cuerpo, barra lateral, tarjetas, CTA, pie. |
| **O12** | **Comparativa tipográfica** | Dos "Aa" gigantes: uno serif con la etiqueta "tradición · autoridad", otro sans con "moderno · tecnología". |
| **O13** | **Tabla de jerarquía tipográfica** | Cuatro líneas de ejemplo (Título grande / Subtítulo / Cuerpo / Etiqueta) con su tamaño anotado al lado. |
| **O14** | **Iconos lineales** | Trazo fino, un solo tono: ojo, diana, corazón, escudo, hoja, carrito, llave, rayo. Sin relleno. |
| **O15** | **Escenarios por sector** | Cinco mini-tarjetas: Banca (azul grisáceo), Salud (oliva), Lujo (negro marrón + camel), Rebajas (terracota), Comida (rojo apagado), cada una con un mini-icono. |
| **O16** | **Duotono editorial** | Si se usa foto, en **duotono tierra** (cacao + arena), nunca color natural ni personas mirando a cámara. |
| **O17** | **Línea separadora** | Regla horizontal de 1 px en `#D3C9B8` a todo el ancho de la columna de texto. |
| **O18** | **Número grande fantasma** | Cifra grande en serif, color piedra al 40 %, como marca de agua de sección. |
| **O19** | **Tarjeta de pregunta** | Tarjeta neutra con un gran "?" y el texto "¿Qué te sugiere este color?" (para abrir la ronda). |
| **O20** | **Tarjetas flash de color** | Un color a pantalla completa con "¿QUÉ TE SUGIERE?" y un gran "?"; y su versión **revela**, con el efecto y las marcas en una banda inferior. |

> **PNG ya generados** en `…\Tema1-Analisis\objetos\`: `o01`…`o16` (los objetos) más
> `flash_<color>.png` y `flash_<color>_revela.png` para 8 colores (rojo, azul, verde, amarillo,
> naranja, morado, negro y blanco). Fondo transparente, línea fina y paleta tierra.

---

## 5. Estructura visual diapositiva a diapositiva

> **IZQ = texto · DER = objeto** salvo donde se indica. Fondo entre paréntesis.

| # | Título | Fondo | Objeto(s) | Disposición |
|---|---|---|---|---|
| 1 | Nada es casualidad: todo es causalidad | Negro marrón | **O7** retícula tenue de fondo + un punto terracota | Portada centrada, tipografía grande, firma abajo |
| 2 | Mira tu móvil: nada está al azar | Blanco roto | **O5** mockup de móvil | Texto izq. · móvil der. |
| 3 | Diseñar es resolver problemas | Blanco roto | **O14** iconos (llave + escudo) + flecha "problema → solución" | Dos columnas |
| 4 | Toda interfaz tiene un triple objetivo | Arena | **O14** ojo · diana · corazón en tres columnas | Tres columnas iguales |
| 5 | Cómo mira el ojo (por qué esto funciona) | Blanco roto | **O8** mapa de mirada (patrón F y Z) | Objeto a todo el ancho, texto debajo |
| 6 | La psicología de las formas | Blanco roto | **O3** cuadrado vs círculo | Comparación 50/50 |
| 7 | Las formas en pantalla: qué usar y para qué | Blanco roto | **O4** tira de formas + aplicaciones | Fila de 4 |
| 8 | La psicología del color | Blanco roto | **O1** ochos muestras + **O2** círculo cromático | Círculo a la izq. · lista de colores der. |
| 9 | El color en escenarios reales | Arena | **O15** escenarios por sector + ejemplo de contraste | Rejilla de 5 + fila de nota |
| 10 | La tipografía es la voz de la marca | Blanco roto | **O12** comparativa "Aa" serif / sans | Dos columnas grandes |
| 11 | Tipografía aplicada: jerarquía y legibilidad | Blanco roto | **O13** tabla de jerarquía | Texto izq. · tabla der. |
| 12 | Composición: dirigir la mirada | Blanco roto | **O7** tercios + flecha de gravedad (centro real vs visual) | Objeto grande izq. · texto der. |
| 13 | Anatomía de una web: las zonas | Blanco roto | **O11** wireframe anotado | Objeto grande + etiquetas |
| 14 | Los espacios y la estructura | Arena | **O9** diagrama de espaciado + **O10** rejilla de columnas | Dos objetos apilados |
| 15 | De la teoría a la pantalla (ejemplo) | Blanco roto | **O6** wireframe completo con *callouts* de color/tipo/forma | Objeto grande centrado |
| 16 | Nada es casualidad, todo es causalidad | Negro marrón | **O7** retícula tenue + punto terracota (cierra como abrió) | Tipografía grande centrada |

---

## 6. Bloque para pegar en Gamma (añádelo al prompt de contenido)

```text
DIRECCIÓN DE ARTE (obligatoria):
Paleta EXACTA, sin añadir otros colores:
- Fondo principal: blanco roto #F4F0E8
- Superficies/tarjetas: arena #EAE3D6
- Líneas y bordes: piedra #D3C9B8
- Texto secundario: tabaco #6E6152
- Texto principal: cacao #2B2521 (nunca negro puro)
- Fondo oscuro alterno (portada, cierre y 2-3 diapositivas de impacto): negro marrón #1E1915
- Único acento de atención: terracota #B07A57 (máximo una vez por diapositiva)
- Acentos secundarios: oliva #8C8A63 y camel #C9A57C (solo datos y gráficos)
Estilo: sobrio, cálido, editorial y muy comunicativo. Nada de degradados, sombras duras ni colores
vivos. Mucho espacio en blanco (mínimo 30 % vacío por tarjeta).

TIPOGRAFÍA: titulares en serif editorial (Fraunces, Playfair o Lora), cuerpo en sans neutra (Inter o
Source Sans), etiquetas en MAYÚSCULAS con letter-spacing amplio. Título de diapositiva 56-64 px,
cuerpo 22-24 px, etiquetas 14-16 px.

OBJETOS: usa solo ilustraciones VECTORIALES PLANAS de línea fina (1-2 px), sin sombras ni 3D, en
tonos tierra; terracota solo como acento puntual. Un objeto visual por diapositiva, alternando
izquierda/derecha.
Objetos a recrear: muestra de color; círculo cromático apagado; comparativa cuadrado vs círculo;
tira de formas con su aplicación web; mockup de móvil; mapa de mirada (patrón F y Z); diagrama de
espaciado con cotas; rejilla de columnas; wireframe de web anotado con etiquetas de zonas; comparativa
tipográfica "Aa" serif/sans; tabla de jerarquía tipográfica; iconos lineales finos (ojo, diana,
corazón, escudo, hoja, carrito, llave); escenarios por sector con su color. Si usas fotos, en duotono
tierra, nunca en color natural.

ESTRUCTURA por tarjeta: título arriba-izquierda (cacao) + cuerpo de 2-4 bullets cortos + un objeto
visual. Pie con línea fina #D3C9B8, etiqueta "TEMA 1 · DISEÑO DE INTERFACES" a la izquierda y el
número de página a la derecha. Tarjetas con bordes redondeados 12-16 px; botones tipo píldora.

FONDOS: blanco roto en la mayoría; negro marrón solo en las diapositivas 1 y 16 (y a lo sumo una más
de impacto).
```

---

*Este sistema es la capa visual del tema; el contenido de las diapositivas está en
`prompt_gamma_tema1.md` y el guion hablado en `guion_exposicion_tema1.md`.*
