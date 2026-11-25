# Tema 3 · Prueba de estilos

## De qué va

Es una batería de pruebas pequeñas para ver cómo se comportan las unidades de
medida, el zoom del navegador y los selectores. Cada archivo prueba una cosa y se
compara con los demás.

## Qué pide el enunciado

Comprobar en el navegador:

1. Qué cambia entre permitir el zoom del usuario o bloquearlo.
2. Cómo se comportan las unidades `vh` y `vw`.
3. Un esquema de selectores con su hoja de estilos.
4. Una página con imágenes para ver el efecto del tamaño fijo frente al relativo.

## Paso a paso

### 1 · Zoom permitido y zoom bloqueado

`12.1-prueba-sin-zoom.html` bloquea el zoom:

```html
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
```

`12.2-prueba-con-zoom.html` lo permite:

```html
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.5, maximum-scale=3, user-scalable=yes">
```

La diferencia se nota al pellizcar en el móvil: con la primera, el texto no se
puede ampliar. Eso **incumple la accesibilidad** (WCAG pide que el texto se pueda
ampliar al 200 %), así que `maximum-scale=1` y `user-scalable=no` están
desaconsejados.

### 2 · `vh` y `vw`

```css
.elemento {
  height: 50vh;   /* mitad de la altura de la ventana */
  width: 75vw;    /* tres cuartos del ancho */
}

.elemento img {
  width: 100%;
  height: 100%;
  object-fit: cover;   /* recorta sin deformar */
}
```

- `vh` y `vw` son porcentajes de la **ventana**, no del contenedor.
- `100vh` ocupa la pantalla entera, aunque el contenido no llegue.
- `object-fit: cover` evita que la imagen se estire: la recorta.

El detalle importante es que `vh` no descuenta la barra del navegador móvil, así
que `100vh` puede provocar un pequeño desplazamiento. Para eso existe `dvh`.

### 3 · Esquema de selectores

`esquema_simple_selectores.html` con `estilos.css` reúne los selectores básicos:

| Selector | Qué elige |
|---|---|
| `p` | todas las etiquetas `p` |
| `.clase` | los elementos con esa clase |
| `#id` | el elemento con ese id (uno solo) |
| `a:hover` | el enlace cuando se pasa el ratón |
| `ul li` | los `li` dentro de un `ul` |
| `h1 + p` | el `p` que va justo detrás del `h1` |

La cascada decide quién gana cuando dos reglas afectan al mismo elemento: primero
la especificidad, y a igualdad, la que se escribe más abajo.

### 4 · La página de imágenes

`prueba.html` con las cuatro fotos de `img/` sirve para comparar un ancho fijo con
uno relativo: con `px` la imagen se sale en pantallas pequeñas; con `%` o `max-width: 100%`
se adapta.

## El código, pieza a pieza

```
Prueba de estilos/
├── 12.1-prueba-sin-zoom.html      viewport que bloquea el zoom
├── 12.2-prueba-con-zoom.html      viewport que lo permite
├── 3-unidades-vh-vw.html          alturas y anchos relativos a la ventana
├── esquema_simple_selectores.html + estilos.css
├── prueba.html                    página con las imágenes
└── img/                           cuatro fotos de Algeciras
```

## Trampas y dudas

- **`vw` incluye la barra de desplazamiento.** `100vw` puede provocar scroll
  horizontal; `100%` no.
- **Bloquear el zoom es un error de accesibilidad**, no una decisión de diseño.
- **`object-fit` solo funciona con `width` y `height` definidos.** Si no, no hay
  nada que recortar.
- **La especificidad no se suma como puntos.** Un `#id` gana siempre a diez clases.

## Si me preguntan

- **¿Cuándo usar `vh`?** Para secciones a pantalla completa (portadas, héroes), no
  para el contenido normal.
- **¿`px` o `rem`?** `rem` para texto (respeta el tamaño del usuario); `px` para
  bordes y detalles.
- **¿Qué es el viewport?** La ventana del navegador; la etiqueta `meta viewport`
  dice cómo debe escalar la página en móvil.
