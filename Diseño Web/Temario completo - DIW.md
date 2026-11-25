<style>
.diw {
  --tinta: #1b1714; --teja: #b4401f; --verdemar: #0f6f5c; --linea: #e0d5c7;
  --verde: #0f6f5c;
  --ambar: #c98a3f;
  --rojo: #b4401f;
  
}
.diw h1 { border-bottom: 3px solid var(--teja); padding-bottom: 6px; }
.diw h2 {
  margin-top: 2.4em;
  padding: 8px 12px;
  border-left: 6px solid var(--teja);
  background: #faf5ef;
  border-radius: 4px;
  font-size: 1.25em;
}
.diw h3 { margin-top: 1.6em; color: var(--verdemar); font-size: 1.05em; }
.diw pre {
  background: #f7f2ea;
  border-left: 3px solid #b4401f;
  border-radius: 0;
  padding: 12px 14px !important;
  overflow-x: auto;
  font-size: 0.85em;
  line-height: 1.55;
}
.diw pre code {
  background: transparent !important;
  color: #1e293b;
  font-family: "Cascadia Code", "JetBrains Mono", Consolas, monospace;
  padding: 0 !important;
}
.theme-dark .diw pre { background: #14110f !important; }
.theme-dark .diw pre code { color: #f3ece4; }
.theme-dark .diw pre { border-left-color: #d9704a; }
.diw code {
  background: rgba(100, 116, 139, 0.18);
  border-radius: 3px;
  padding: 1px 5px;
  font-family: "Cascadia Code", Consolas, monospace;
  font-size: 0.9em;
}
.diw p.que { color: inherit; font-style: italic; font-size: 0.92em; margin-top: -2px; padding-left: 12px; border-left: 2px solid rgba(100, 116, 139, 0.4); }
.diw table { width: 100%; border-collapse: collapse; margin: 14px 0 20px; font-size: 0.9em; }
.diw th { background: #f3e7db; text-align: left; }
.diw th, .diw td { border: 1px solid rgba(100, 116, 139, 0.35); padding: 6px 9px; vertical-align: top; }
.diw tbody tr:nth-child(even) td { background: rgba(100, 116, 139, 0.05); }
.diw .ojo, .diw .clave {
  border-radius: 0;
  padding: 8px 12px;
  margin: 12px 0;
  border-left: 5px solid;
  font-size: 0.94em;
}
.diw .ojo { background: #fbf0ec; border-color: var(--rojo); }
.diw .clave { background: #eef5f1; border-color: var(--verde); }
</style>

<div class="diw">

# Diseño de Interfaces Web · temario completo

Ruta de estudio que va de lo más básico (qué hace el navegador con un archivo de
texto) hasta Bootstrap y los trabajos del curso. Cada bloque trae el código y lo
que hay que entender de él.

## Parte 0 · De dónde sale una página web

### 0.1 Cliente y servidor

El navegador pide un recurso y el servidor responde. El protocolo es HTTP y los
dos métodos que se usan en el módulo son GET (pedir) y POST (enviar datos de un
formulario).

```
Navegador  --GET /index.html-->  Servidor
Navegador  <--200 + HTML-------- Servidor
```

<p class="que">El navegador recibe HTML, lo convierte en un árbol de elementos (DOM), carga el CSS y el JavaScript, y pinta el resultado. Nada de eso se ve en el archivo: el HTML es texto.</p>

### 0.2 Herramientas

| Herramienta | Para qué |
|---|---|
| VS Code | escribir el código |
| Live Server | servirlo en `http://localhost` y recargar al guardar |
| F12 → Elementos | ver el DOM real y cambiar estilos en vivo |
| F12 → Red | comprobar que el CSS y las imágenes cargan (200, no 404) |
| validator.w3.org/nu | validar el HTML |
| PageSpeed Insights | medir rendimiento y accesibilidad |

## Parte 1 · HTML

### 1.1 Estructura mínima

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi primera página</title>
</head>
<body>
  <h1>Hola</h1>
  <p>Texto de ejemplo.</p>
</body>
</html>
```

<p class="que"><code>DOCTYPE</code> avisa de que es HTML5. <code>lang</code> dice el idioma (lectores de pantalla y traductores lo usan). <code>charset</code> evita que las tildes salgan como símbolos. <code>viewport</code> es lo que hace que en el móvil se vea a escala real y no como una web de 1998.</p>

### 1.2 Texto y listas

```html
<h1>Título principal</h1>
<h2>Sección</h2>
<p>Un párrafo con <strong>importancia</strong> y <em>énfasis</em>.</p>

<ul>
  <li>Elemento sin orden</li>
</ul>

<ol type="a" start="2">
  <li>Elemento ordenado, empieza en b</li>
</ol>

<dl>
  <dt>HTML</dt>
  <dd>Lenguaje de marcas para estructurar contenido.</dd>
</dl>
```

<p class="que">Se usa un solo <code>h1</code> por página y los <code>h2</code> en orden, sin saltarse niveles: eso es lo que lee un lector de pantalla para navegar. <code>strong</code> y <code>em</code> aportan significado; <code>b</code> e <code>i</code> solo cambian el aspecto.</p>

### 1.3 Enlaces e imágenes

```html
<a href="contacto.html">Contacto</a>
<a href="https://example.com" target="_blank" rel="noopener">Externo</a>
<a href="mailto:info@example.com">Escríbenos</a>
<a href="#opiniones">Ir a opiniones</a>

<img src="img/logo.png" alt="Logotipo de la empresa" width="120">

<figure>
  <img src="img/plaza.jpg" alt="Plaza Alta de Algeciras al atardecer">
  <figcaption>Plaza Alta, Algeciras.</figcaption>
</figure>
```

<p class="que">El <code>alt</code> no es decorativo: si la imagen no carga, se lee; y si el usuario usa un lector de pantalla, se anuncia. Si la imagen es puramente decorativa, se deja <code>alt=""</code>. <code>width</code> y <code>height</code> reservan el hueco y evitan que la página salte al cargar.</p>

### 1.4 Elementos semánticos

```html
<body>
  <header>
    <h1>Algeciras Digital</h1>
    <nav>
      <ul>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="detalle.html">El puerto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <article>
      <h2>El puerto de Algeciras</h2>
      <p>Primer puerto de España en tráfico de mercancías.</p>
    </article>

    <aside>
      <h2>Datos rápidos</h2>
      <p>Más de 200.000 camiones al año.</p>
    </aside>
  </main>

  <footer>
    <p>© 2026 Algeciras Digital</p>
  </footer>
</body>
```

<p class="que"><code>header</code>, <code>nav</code>, <code>main</code>, <code>article</code>, <code>aside</code> y <code>footer</code> describen qué es cada zona. Un <code>div</code> no dice nada y obliga a adivinar la estructura. Solo hay un <code>main</code> por página.</p>

### 1.5 Tablas

```html
<table>
  <caption>Horario de 2º DAW</caption>
  <thead>
    <tr>
      <th scope="col">Hora</th>
      <th scope="col">Lunes</th>
      <th scope="col">Martes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">15:00</th>
      <td>DWEC</td>
      <td>DWES</td>
    </tr>
    <tr>
      <td colspan="3">Recreo</td>
    </tr>
  </tbody>
</table>
```

<p class="que"><code>caption</code> describe la tabla, <code>thead</code> agrupa los títulos y <code>scope</code> dice si una cabecera encabeza una columna o una fila. <code>colspan</code> une columnas y <code>rowspan</code> une filas. Las tablas son para datos tabulados, nunca para maquetar.</p>

### 1.6 Formularios

```html
<form method="POST" action="guardar.php">
  <fieldset>
    <legend>Datos de contacto</legend>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required maxlength="40">

    <label for="correo">Correo</label>
    <input type="email" id="correo" name="correo" required>

    <label for="tema">Tema</label>
    <select id="tema" name="tema">
      <option value="info">Información</option>
      <option value="soporte">Soporte</option>
    </select>

    <label for="mensaje">Mensaje</label>
    <textarea id="mensaje" name="mensaje" rows="4"></textarea>

    <button type="submit">Enviar</button>
  </fieldset>
</form>
```

<p class="que">El <code>for</code> del <code>label</code> tiene que coincidir con el <code>id</code> del campo: así al pulsar el texto se activa el campo y el lector de pantalla lo anuncia. El <code>name</code> es la clave con la que llega al servidor. <code>required</code> y <code>type="email"</code> validan en el navegador, sin JavaScript.</p>

### 1.7 Contenido incrustado

```html
<iframe src="https://www.google.com/maps/embed?pb=..." title="Mapa del puerto"
        width="600" height="400" loading="lazy"></iframe>

<video controls width="480" poster="img/portada.jpg">
  <source src="video/puerto.mp4" type="video/mp4">
  Tu navegador no admite vídeo.
</video>

<audio controls>
  <source src="audio/ambiental.mp3" type="audio/mpeg">
</audio>

<svg width="120" height="120" viewBox="0 0 100 100">
  <circle cx="50" cy="50" r="40" fill="#0284c7" />
</svg>

<object data="ficha.pdf" type="application/pdf" width="400" height="300">
  <p>Descarga la <a href="ficha.pdf">ficha técnica</a>.</p>
</object>
```

<p class="que">Son las etiquetas del trabajo de clase: la misma información se puede incrustar como página (<code>iframe</code>), vídeo, audio, dibujo vectorial o documento. El texto de dentro de <code>video</code> u <code>object</code> es el respaldo para navegadores que no lo admiten.</p>

## Parte 2 · CSS

### 2.1 Cómo se enlaza

```html
<!-- 1. en línea: solo para pruebas -->
<p style="color: red;">Hola</p>

<!-- 2. en el head, para una sola página -->
<style>
  p { color: red; }
</style>

<!-- 3. hoja externa: la forma correcta -->
<link rel="stylesheet" href="css/estilos.css">
```

<p class="que">La hoja externa se guarda en caché, se reutiliza en todas las páginas y separa contenido de presentación. Las otras dos se usan solo para probar algo puntual.</p>

Qué regla gana cuando dos afectan al mismo elemento:

```css
p { color: blue; }        /* especificidad 0-0-1 */
.aviso { color: orange; } /* 0-1-0  <- gana */
#principal { color: red; } /* 1-0-0 <- gana a todas */
```

<p class="que">Cuenta primero los ids, después las clases y por último las etiquetas. A igualdad, gana la que está más abajo. <code>!important</code> rompe esa lógica y se usa lo mínimo.</p>

### 2.2 Selectores

| Selector | Qué elige |
|---|---|
| `p` | todas las etiquetas `p` |
| `.aviso` | los elementos con esa clase |
| `#cabecera` | el elemento con ese id |
| `ul li` | los `li` que están dentro de un `ul`, a cualquier nivel |
| `ul > li` | solo los hijos directos |
| `h2 + p` | el `p` inmediatamente siguiente a un `h2` |
| `a[target="_blank"]` | por atributo |
| `a:hover` | al pasar el ratón |
| `li:nth-child(2n)` | los pares |
| `p::first-line` | la primera línea del párrafo |

```css
.nav a { color: #1e293b; }
.nav a:hover { color: #2563eb; }
.tarjeta:nth-child(even) { background: #f1f5f9; }
```

<p class="que">Los pseudo-elementos (<code>::before</code>, <code>::after</code>) crean contenido decorativo que no está en el HTML; los pseudo-clases (<code>:hover</code>, <code>:focus</code>, <code>:first-child</code>) seleccionan según el estado o la posición.</p>

### 2.3 Unidades

| Unidad | Cuándo |
|---|---|
| `px` | bordes, sombras, 1-2 px de detalle |
| `rem` | texto y espaciados (respeta el tamaño del usuario) |
| `em` | relativo al padre, útil en componentes |
| `%` | anchos dentro de un contenedor |
| `vw` / `vh` | proporción de la ventana |
| `ch` | ancho de un carácter, para líneas de texto |

```css
body { font-size: 1rem; }
h1 { font-size: 2.5rem; }
.contenedor { width: min(100% - 2rem, 1100px); margin-inline: auto; }
.hero { min-height: 70vh; }
```

<p class="que">Con <code>rem</code> el texto crece cuando el usuario sube el tamaño de fuente del navegador; con <code>px</code> no. <code>100vw</code> incluye la barra de desplazamiento y provoca scroll horizontal; <code>100%</code> no.</p>

### 2.4 Modelo de caja

```css
.tarjeta {
  width: 320px;
  padding: 16px;
  border: 1px solid #cbd5e1;
  margin: 24px auto;
  box-sizing: border-box;
}
```

<p class="que">Cada elemento es una caja con contenido, relleno (<code>padding</code>), borde y margen. Por defecto el <code>width</code> solo cuenta el contenido, así que la caja real mide más. Con <code>box-sizing: border-box</code> el ancho incluye relleno y borde, que es lo que espera cualquiera al maquetar.</p>

### 2.5 Colores y fondos

```css
:root {
  --azul: #0284c7;
  --texto: #1e293b;
  --fondo: #f8fafc;
}

body {
  color: var(--texto);
  background-color: var(--fondo);
}

.boton {
  background: var(--teja);
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 0;
}

.hero {
  background: linear-gradient(135deg, #0ea5e9, #1e3a8a);
  background-size: cover;
  background-position: center;
}
```

<p class="que">Los colores se escriben en hexadecimal (<code>#0284c7</code>), en <code>rgb()</code> o en <code>hsl()</code>. Las variables de <code>:root</code> permiten cambiar la paleta entera en un sitio. Todo texto tiene que tener contraste suficiente con su fondo.</p>

### 2.6 Propiedades del texto

```css
body {
  font-family: "Segoe UI", Roboto, system-ui, sans-serif;
  font-size: 1rem;
  line-height: 1.6;
  letter-spacing: 0.01em;
}

h1 {
  font-weight: 700;
  text-align: center;
  text-transform: uppercase;
}

.destacado {
  text-decoration: underline wavy;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
}
```

<p class="que"><code>line-height</code> entre 1.4 y 1.7 hace que un párrafo largo se lea cómodo. La familia se pone con alternativas separadas por comas y una genérica al final (<code>sans-serif</code>), que siempre existe.</p>

### 2.7 Listas y tablas

```css
ul.limpia { list-style: none; padding-left: 0; }

table {
  width: 100%;
  border-collapse: collapse;
}

th, td { border: 1px solid #94a3b8; padding: 8px 10px; text-align: left; }
thead th { background: #f3ece4; }
tbody tr:nth-child(even) { background: #f8fafc; }
```

<p class="que"><code>border-collapse: collapse</code> une los bordes de las celdas y quita el doble borde. Las filas alternas (<code>nth-child(even)</code>) se leen mejor en tablas largas.</p>

### 2.8 Layout: display y position

```css
.bloque { display: block; }
.en-linea { display: inline; }
.oculto { display: none; }

.relativo { position: relative; }
.etiqueta {
  position: absolute;
  top: 8px;
  right: 8px;
}
.barra {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
}
.pegado {
  position: sticky;
  top: 0;
}
```

<p class="que"><code>absolute</code> se coloca respecto al primer ancestro con <code>position: relative</code>; si no hay ninguno, respecto a la página. <code>fixed</code> se queda pegado a la ventana y <code>sticky</code> se pega solo al llegar a una posición.</p>

### 2.9 Flexbox

```css
.barra-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.galeria {
  display: flex;
  gap: 12px;
}

.galeria img {
  flex: 1 1 200px;
  object-fit: cover;
}
```

<p class="que"><code>justify-content</code> reparte en el eje principal y <code>align-items</code> alinea en el secundario. <code>gap</code> separa sin márgenes. Con <code>flex: 1 1 200px</code> cada imagen crece y encoge partiendo de 200 px.</p>

### 2.10 Grid

```css
.productos {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

.layout {
  display: grid;
  grid-template-columns: 240px 1fr;
  grid-template-areas:
    "menu contenido"
    "pie  pie";
  gap: 16px;
}

.layout header { grid-area: pie; }
```

<p class="que"><code>auto-fit</code> con <code>minmax</code> crea tantas columnas como caben y pasa a una sola en móvil sin media queries. <code>fr</code> reparte el espacio libre. <code>grid-template-areas</code> dibuja la página con texto, que se lee de un vistazo.</p>

### 2.11 Responsive

```css
img { max-width: 100%; height: auto; }

@media (max-width: 768px) {
  .layout { grid-template-columns: 1fr; }
  h1 { font-size: 1.8rem; }
}
```

<p class="que">Se escribe primero el móvil y luego se amplía, o al revés, pero con un criterio. <code>max-width: 100%</code> en las imágenes evita que se salgan del contenedor. Nunca se bloquea el zoom: el <code>maximum-scale=1</code> del viewport incumple la accesibilidad.</p>

### 2.12 Transiciones

```css
.boton {
  transition: background-color 0.2s ease, transform 0.2s ease;
}
.boton:hover {
  background-color: #0369a1;
  transform: translateY(-2px);
}
```

<p class="que"><code>transition</code> suaviza el cambio entre dos estados. Se animan propiedades baratas (color, opacidad, transform); animar <code>width</code> o <code>top</code> obliga al navegador a recalcular la página en cada fotograma.</p>

## Parte 3 · Bootstrap 5

### 3.1 Qué es y cómo se enlaza

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```

<p class="que">Bootstrap es una hoja de estilos con clases ya escritas y un pequeño JavaScript para los componentes que se abren y se cierran (modal, desplegable, carrusel). El <code>bundle</code> incluye Popper, necesario para los desplegables y los tooltips.</p>

### 3.2 Rejilla

```html
<div class="container">
  <div class="row g-4">
    <div class="col-12 col-md-6 col-lg-4">Tarjeta 1</div>
    <div class="col-12 col-md-6 col-lg-4">Tarjeta 2</div>
    <div class="col-12 col-md-6 col-lg-4">Tarjeta 3</div>
  </div>
</div>
```

<p class="que">Son doce columnas. <code>col-12</code> ocupa todo en móvil, <code>col-md-6</code> la mitad desde tablet y <code>col-lg-4</code> un tercio en escritorio. <code>g-4</code> pone separación entre columnas y <code>container-fluid</code> ocupa el ancho completo.</p>

### 3.3 Utilidades

```html
<div class="d-flex justify-content-between align-items-center p-3 mb-4 bg-light rounded shadow-sm">
  <h2 class="h4 mb-0">Catálogo</h2>
  <a class="btn btn-primary btn-sm" href="carrito.html">Ver carrito</a>
</div>

<p class="text-muted small">Precios con IVA incluido.</p>
```

<p class="que">Las utilidades se llaman por su abreviatura: <code>d-flex</code> (display), <code>p-3</code> (padding), <code>mb-4</code> (margen inferior), <code>text-muted</code> (color), <code>btn</code> (botón). Ahorran escribir CSS propio para lo de todos los días.</p>

### 3.4 Tablas y tipografía

```html
<table class="table table-striped table-hover align-middle">
  <thead class="table-dark">
    <tr><th>Libro</th><th class="text-end">Precio</th></tr>
  </thead>
  <tbody>
    <tr><td>El Quijote</td><td class="text-end">19,90 €</td></tr>
  </tbody>
</table>

<h1 class="display-5">Librería Kursaal</h1>
<p class="lead">Libros de segunda mano revisados uno a uno.</p>
```

<p class="que"><code>table-striped</code> alterna el fondo de las filas y <code>align-middle</code> centra verticalmente el contenido de las celdas. <code>display-5</code> y <code>lead</code> son estilos de titular y entradilla ya definidos.</p>

### 3.5 Botones, tarjetas y avisos

```html
<button class="btn btn-primary">Comprar</button>
<button class="btn btn-outline-secondary">Ver más</button>

<div class="card" style="width: 18rem;">
  <img src="img/quijote.jpg" class="card-img-top" alt="Portada de El Quijote">
  <div class="card-body">
    <h5 class="card-title">El Quijote</h5>
    <p class="card-text">Edición de bolsillo, 900 páginas.</p>
    <span class="badge bg-success">Disponible</span>
    <a href="#" class="btn btn-sm btn-primary mt-3">Añadir al carrito</a>
  </div>
</div>

<div class="alert alert-warning">Quedan 2 unidades.</div>
```

<p class="que">La tarjeta es el bloque que se repite en un catálogo: imagen, cuerpo, texto y acción. El <code>badge</code> sirve para estados y el <code>alert</code> para mensajes; los dos tienen variantes de color (<code>bg-success</code>, <code>alert-warning</code>).</p>

### 3.6 Formularios

```html
<form class="row g-3">
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" required>
  </div>
  <div class="col-md-6">
    <label for="cp" class="form-label">Código postal</label>
    <input type="text" class="form-control" id="cp" pattern="[0-9]{5}">
    <div class="form-text">Cinco cifras.</div>
  </div>
  <div class="col-12">
    <button class="btn btn-success" type="submit">Confirmar pedido</button>
  </div>
</form>
```

<p class="que"><code>form-control</code> da el estilo a los campos y <code>form-label</code> a las etiquetas. La rejilla también funciona dentro del formulario, así que nombre y código postal quedan en dos columnas en escritorio y una en móvil.</p>

### 3.7 Componentes con JavaScript

```html
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.html">Librería Kursaal</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html">Catálogo</a></li>
        <li class="nav-item"><a class="nav-link" href="carrito.html">Carrito</a></li>
      </ul>
    </div>
  </div>
</nav>

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aviso">Aviso</button>
<div class="modal fade" id="aviso" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Pedido enviado</h5></div>
      <div class="modal-body">Recibirás la factura por correo.</div>
    </div>
  </div>
</div>
```

<p class="que">Los componentes se abren con atributos <code>data-bs-*</code>, sin escribir JavaScript. El botón del menú móvil apunta con <code>data-bs-target</code> al <code>id</code> del bloque que se despliega.</p>

### 3.8 Ejemplo completo: catálogo

```html
<section class="container py-5">
  <div class="row g-4">
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card h-100">
        <img src="img/quijote.jpg" class="card-img-top" alt="El Quijote">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">El Quijote</h5>
          <p class="card-text text-muted small">Cervantes</p>
          <p class="fw-bold mt-auto">19,90 €</p>
          <button class="btn btn-primary w-100" data-id="1">Añadir al carrito</button>
        </div>
      </div>
    </div>
    <!-- repetir la columna por cada libro -->
  </div>
</section>
```

<p class="que"><code>h-100</code> iguala la altura de las tarjetas y <code>mt-auto</code> empuja el precio al fondo, así los botones quedan alineados aunque los títulos ocupen distinto. <code>w-100</code> hace que el botón ocupe todo el ancho de la tarjeta.</p>

## Parte 4 · Los ejercicios del curso

### 4.1 Listas y tabla de horarios

Primero listas (ordenada con letras, desordenada) y después una tabla real con
cabecera, cuerpo y celdas combinadas.

```html
<table>
  <caption>Horario DAW · 2º curso</caption>
  <thead>
    <tr><th scope="col">Hora</th><th scope="col">Lunes</th><th scope="col">Martes</th></tr>
  </thead>
  <tbody>
    <tr><th scope="row">15:00</th><td>DWEC</td><td>DWES</td></tr>
    <tr><td colspan="3">Recreo</td></tr>
  </tbody>
</table>
```

<p class="que">Se comprueba que <code>colspan</code> cuenta celdas y no horas, y que <code>caption</code> va dentro de la tabla para quedar asociado a ella.</p>

### 4.2 Etiquetas de incrustación

Web de dos niveles: una página enlaza con otra y entre las dos se usan
`img`, `iframe`, `video`, `audio`, `canvas`, `embed`, `object` y `svg`.

```html
<canvas id="lienzo" width="300" height="150">
  Tu navegador no admite canvas.
</canvas>

<embed src="ficha.pdf" type="application/pdf" width="400" height="300">

<object data="ficha.pdf" type="application/pdf" width="400" height="300">
  <a href="ficha.pdf">Descargar ficha</a>
</object>
```

<p class="que"><code>embed</code> no admite contenido alternativo y <code>object</code> sí, por eso se usan los dos: sirve para comparar qué pasa cuando el navegador no puede mostrar el PDF.</p>

### 4.3 Prueba de estilos

Cuatro páginas pequeñas para ver el efecto del viewport, de las unidades
relativas y de los selectores.

```html
<!-- 12.2: zoom permitido -->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.5, maximum-scale=3, user-scalable=yes">
```

```css
.elemento { height: 50vh; width: 75vw; }
.elemento img { width: 100%; height: 100%; object-fit: cover; }
```

<p class="que">Con <code>maximum-scale=1</code> el usuario no puede ampliar el texto y eso es un fallo de accesibilidad. <code>object-fit: cover</code> recorta la imagen para llenar la caja sin deformarla.</p>

### 4.4 Blog con Bootstrap

Trabajo evaluable: una web con plantilla de Bootstrap, contenido y una sección
de blog. Lo que se valora en la rúbrica:

| Criterio | Qué se mira |
|---|---|
| Nivel técnico | estilos propios, entre 2 y 10 |
| Cobertura del temario | uso de elementos CSS vistos en clase |
| Aspecto formal | cuidado de la apariencia |
| Comentario en el código | explicar lo que no se ve |
| Preguntas del docente | defender el trabajo |

```html
<article class="card mb-4">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="img/post.jpg" class="img-fluid rounded-start" alt="Portada del artículo">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Cómo elegir un libro de segunda mano</h5>
        <p class="card-text text-muted">12 de noviembre de 2026</p>
        <p class="card-text">Revisar el lomo, el estado de las páginas y la edición.</p>
        <a href="#" class="btn btn-outline-primary btn-sm">Leer más</a>
      </div>
    </div>
  </div>
</article>
```

<p class="que">La tarjeta horizontal con <code>row g-0</code> es el patrón típico de un listado de blog: imagen a un lado, texto al otro, y en móvil se apilan porque la columna pasa a ocupar las doce.</p>

### 4.5 Análisis de calidad web

El trabajo de la UT1: medir una web real con PageSpeed Insights y explicar los
números.

| Métrica | Qué mide | Bien |
|---|---|---|
| FCP | primer texto o imagen pintada | ≤ 1,8 s |
| LCP | elemento más grande pintado | ≤ 2,5 s |
| TBT | tiempo con el hilo bloqueado | ≤ 200 ms |
| CLS | saltos de maquetación | ≤ 0,1 |
| SI | velocidad media de pintado | ≤ 3,4 s |

<p class="que">La web analizada sacó 63 en rendimiento y 8,7 s de LCP: el problema no era el JavaScript (TBT 0 ms) sino el peso de las imágenes y las fuentes. Las mejoras van por ahí: comprimir, usar WebP, cargar en diferido y no bloquear el renderizado.</p>

## Parte 5 · Calidad

### 5.1 Validar

```text
https://validator.w3.org/nu/
```

Se pega la URL o el HTML y devuelve errores y avisos. Un error típico del módulo:
`<div>` sueltos donde debería haber un elemento semántico.

### 5.2 Accesibilidad

- Todas las imágenes llevan `alt` (vacío si son decorativas).
- El contraste de texto llega a 4.5:1 como mínimo.
- La página funciona con teclado: `Tab` recorre los enlaces y `:focus` se ve.
- El zoom no está bloqueado.
- Cada campo del formulario tiene su `label`.
- Los encabezados van en orden, sin saltarse niveles.

### 5.3 Rendimiento

```html
<img src="foto.webp" alt="Puerto de Algeciras" width="800" height="500" loading="lazy">
```

<p class="que"><code>loading="lazy"</code> retrasa la carga de las imágenes que están fuera de pantalla. El formato WebP pesa menos que JPG con la misma calidad, y declarar el ancho y el alto evita el salto de maquetación que penaliza el CLS.</p>

## Anexo · De dónde sale cada bloque

| Bloque | Material del aula | Enlace |
|---|---|---|
| Arquitectura y protocolo | `Arquitectura cliente-servidor.pdf` | eniun |
| Texto y etiquetas | `01 Etiquetas de contenido y texto.pdf` | https://www.eniun.com/etiquetas-contenido-texto-html/ |
| Semántica | `02 Elementos semanticos HTML5.pdf` | https://www.eniun.com/html5-estructura-basica-elementos-semanticos/ |
| Tablas | `03 Tablas de contenido.pdf` | https://www.eniun.com/etiquetas-tablas-contenido-html5/ |
| Formularios | `04 Formularios HTML.pdf` | https://www.eniun.com/etiquetas-formularios-html5/ |
| Ejercicios resueltos | `05 Ejercicios resueltos HTML.pdf` | https://www.eniun.com/ejercicios-resueltos-html/ |
| Selectores | `CSS/01 Tipos de selectores.pdf` | https://www.eniun.com/selectores-css-tipos/ |
| Unidades | `CSS/02 Unidades de medida.pdf` | https://www.eniun.com/unidades-medida-css/ |
| Colores y fondo | `CSS/03 Colores y fondo.pdf` | https://www.eniun.com/atributos-propiedades-colores-css/ |
| Texto | `CSS/04 Propiedades de texto.pdf` | https://www.eniun.com/atributos-propiedades-textos-css/ |
| Listas | `CSS/05 Propiedades de las listas.pdf` | https://www.eniun.com/atributos-propiedades-listas-css/ |
| Tablas | `CSS/06 Propiedades de las tablas.pdf` | https://www.eniun.com/atributos-propiedades-tablas-css/ |
| Bootstrap | apuntes de rejillas, tipografía, botones, tablas, imágenes y componentes | eniun / getbootstrap.com |

Los ejercicios del apartado 4 son los del curso: listas y horario, etiquetas de
incrustación, prueba de estilos, blog con Bootstrap y análisis de calidad.

</div>
