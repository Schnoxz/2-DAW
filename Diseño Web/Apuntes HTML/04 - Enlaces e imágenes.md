# 04 · Enlaces e imágenes

> El "hipertexto" del que habla el nombre HTML. Dos etiquetas, un montón de matices.

---

## Enlaces: `<a>`

```html
<a href="https://www.eniun.com">Ir a Eniun</a>
```

Se descompone en:

- `<a>` = *anchor*, ancla. Es la etiqueta.
- `href` = **hypertext reference**. Es la dirección de destino. **Sin `href`, el enlace no funciona.**
- El texto entre `<a>` y `</a>` es lo que la persona ve y hace clic.

> Dato: HTML viene de "hiper**texto**". Es decir, la idea de poder saltar de un documento a otro
> ya estaba en el nombre del lenguaje. Los enlaces son lo que hace que la web sea la web.

### Tipos de enlace según el destino

| `href` | Lleva a | Ejemplo |
|---|---|---|
| URL absoluta | Otra web, desde cualquier sitio | `https://www.w3.org` |
| URL relativa | Otra página de **tu** proyecto | `contacto.html` |
| Ruta relativa con carpetas | Una página dentro de una subcarpeta | `blog/2026/post.html` |
| Ancla | Un punto dentro de la **misma** página | `#contacto` |
| Enlace a correo | Abre el programa de correo | `mailto:hola@midominio.com` |
| Enlace a teléfono | Abre el teclado en el móvil | `tel:+34600111222` |
| Descarga |Fuerza a descargar el fichero | `href="cv.pdf" download` |

```html
<a href="pagina2.html">Ir a la página 2</a>
<a href="docs/manual.pdf" download>Descargar el manual (PDF)</a>
<a href="mailto:hola@midominio.com">Escríbeme</a>
<a href="tel:+34600111222">Llámame</a>
<a href="#seccion-final">Baja al final de la página</a>
```

### Rutas relativas: la fuente de headaches

`href="pagina2.html"` significa: "busca `pagina2.html` **en la misma carpeta que esta página**".
Si las pones en carpetas distintas, la ruta cambia:

```
mi-web/
├── index.html
├── blog/
│   ├── post.html
│   └── 2026/
│       └── post-2026.html
└── img/
    └── logo.png
```

- Desde `index.html` → `blog/post.html`
- Desde `index.html` → `img/logo.png`
- Desde `blog/post.html` → `../index.html`  (los `..` suben una carpeta)
- Desde `blog/2026/post-2026.html` → `../../img/logo.png`  (dos niveles arriba)

> **Truco:** si un enlace da error, mira en la pestaña **Network/Red** del inspector qué ruta está
> pidiendo realmente. Suele faltar un `../` o sobrar una barra.

### Un enlace, mil matices

```html
<!-- Abrir en una pestaña nueva -->
<a href="https://www.w3.org" target="_blank">W3C</a>

<!-- Abrir en pestaña nueva, de forma segura y accesible -->
<a href="https://www.w3.org" target="_blank" rel="noopener noreferrer">W3C</a>
```

> **Por qué `rel="noopener noreferrer"`:** sin esto, la página que abres tiene acceso a tu
> `window.opener` y puede redirigir tu pestaña original (un truco viejo de phishing y anuncios).
> `noopener` corta esa posibilidad. Además, muchos profesores lo **exigen en DAW**: `target="_blank"` sin
> `rel="noopener"` es falta de accesibilidad y seguridad.

### Dentro de un enlace solo texto en línea

```html
<a href="pagina.html">
    <div>Esto ya es inválido: <div> es de bloque</div>
</a>
```

Un `<a>` es de línea, así que dentro solo caben etiquetas de línea. Y **nunca dos enlaces anidados**
(`<a>` dentro de `<a>`): está prohibido.

### Enlaces de salto y "volver arriba"

```html
<a href="#contenido" class="skip">Saltar al contenido principal</a>
```

Es el **primer enlace de la página**, invisible pero presente. Sirve para que quien navega con
teclado o lector de pantalla se salte el menú y vaya directo al contenido. Se hace visible al
pulsar Tab. **Es un estándar de accesibilidad real**, no un capricho.

---

## Imágenes: `<img>`

```html
<img src="img/logo.png" alt="Logotipo de la panadería La Espiga">
```

Se descompone en:

- `src` = **source**: la ruta del fichero.
- `alt` = **alternative text**: la descripción en texto.
- Etiqueta **sin cierre**.

### La regla del `alt` (no es opcional)

El `alt` describe la imagen **para quien no la ve**. Hay dos casos:

1. **La imagen transmite información** → describe qué dice:
   ```html
   <img src="grafico-ventas.png" alt="Gráfico: las ventas subieron un 40% en marzo">
   ```

2. **La imagen es decorativa** (un fondo, un adorno) → se deja **vacío**:
   ```html
   <img src="rayo-decorativo.png" alt="">
   ```

> **El `alt=""` NO es un error.** Estar vacío significa "esta imagen no aporta nada", y es la forma
> correcta de decirlo. Lo que es un error es **no poner el atributo en absoluto**, porque el lector de
> pantalla dirá "imagen" a secas o leerá el nombre del fichero: `logo_v3_final.png`.

> **Regla mnemotécnica:** `alt="Foto de Javier practicing pádel"`. Si suena raro, no lo pongas.

### Los atributos que te van a servir

```html
<!-- Redimensionar manteniendo proporciones -->
<img src="logo.png" alt="Logotipo" width="200">

<!-- El navegador reserva el hueco antes de que cargue (evita saltos) -->
<img src="grande.jpg" alt="Foto" width="800" height="600" loading="lazy">

<!-- Permitir que la imagen crezca hasta el 100% del contenedor -->
<img src="logo.png" alt="Logotipo" style="max-width:100%">
```

Esa última es **casi obligatoria hoy**: sin `max-width: 100%`, en un móvil una imagen de 2000 px
hace scroll horizontal y la página se ve fatal. Y para que no se vea pixelada al ampliar, usa
preferiblemente vectores (`.svg`) o imágenes de resolución suficiente.

### Imágenes externas y derechos

```html
<img src="https://ejemplo.com/foto.jpg" alt="Foto de un paisaje">
```

Funciona, pero tiene dos problemas:
1. si el servidor remoto cae o bloquea el acceso, tu imagen no aparece;
2. **no tienes los derechos** de esa imagen.

En trabajos de DAW, mejor **descarga las imágenes** a una carpeta `img/` dentro de tu proyecto y
enlázalas desde ahí. Además, revisa la licencia (en Figma o Google Images busca "licencia de uso").

---

## Errores típicos

| ❌ | 💥 | ✅ |
|---|---|---|
| `<a>texto</a>` sin `href` | No es clicable | `<a href="...">texto</a>` |
| `<img src="a.png">` sin `alt` | Fallo de accesibilidad | Siempre `alt`, aunque sea `""` |
| `href="www.eniun.com"` | Busca una carpeta local | `href="https://www.eniun.com"` |
| `src="C:\fotos\a.png"` | Ruta del ordenador, no de la web | `src="img/a.png"` |
| `target="_blank"` sin `rel` | Inseguro | `rel="noopener noreferrer"` |
| `<img src="a.png" alt="a.png">` | El alt repite el nombre del archivo | Describe lo que se ve |
| Confundir mayúsculas: `IMG/Logo.PNG` | En Linux no encuentra nada | Todo en minúsculas |

> **Detalle de Windows que muerde:** tu Windows no distingue `Logo.png` de `logo.png`, pero un
> servidor Linux **sí**. Por eso en web se recomienda escribir **todo en minúsculas**: evita fallos
> que en clase nunca te pasan y al subir al servidor sí.

---

## Minirrégimen

1. Crea una carpeta `img`, mete una imagen y una subcarpeta `docs` con un PDF.
2. Enlaza a la imagen, al PDF con `download`, a un `mailto:` y a un `tel:`.
3. Crea `pagina2.html` en otra carpeta y enlázala con `../`.
4. Pon `target="_blank"` + `rel="noopener noreferrer"` y compruébalo.
5. **Rompe el `alt` a propósito**: quítalo y pasa el lector de pantalla (o mira el inspector).
6. Comprueba en el móvil: ¿hay scroll horizontal? Probablemente sí, por una imagen sin `max-width`.

---

*Siguiente apunte → [05 · Elementos semánticos](05%20-%20Elementos%20sem%C3%A1nticos.md)*
*← Anterior · [03 · Etiquetas de contenido y organización del texto](03%20-%20Etiquetas%20de%20contenido%20y%20organizaci%C3%B3n%20del%20texto.md)*
