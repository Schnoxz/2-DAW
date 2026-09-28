# 10 · Práctica guiada, página completa

> Todo lo anterior, en una sola página real. Hazla **tú**, sin mirar el andamiaje.

---

## El enunciado

Vas a construir la web de una panadería ficticia. **La Espiga**.

### Requisitos

**HTML**
- [ ] Documento con DOCTYPE, `lang="es"` y `charset`
- [ ] Un solo `<h1>` y encabezados bien escalonados (`h1` → `h2` → `h3`, sin saltos)
- [ ] Estructura semántica: `header`, `nav`, `main`, `footer`, y al menos un `article` y un `aside`
- [ ] Navegación con lista `<ul>` dentro de `<nav>`
- [ ] Un enlace externo (con `rel="noopener noreferrer"`) y uno a una sección propia
- [ ] Una imagen con `alt` descriptivo y otra decorativa con `alt=""`
- [ ] Una tabla de productos con `caption`, `thead`, `tbody` y `scope`
- [ ] Un formulario con `label`+`for`+`id`+`name` en todos los controles,
      `method="post"` y al menos un `required`
- [ ] Una dirección de contacto con `<address>`

**CSS**
- [ ] Fichero externo `css/estilos.css` enlazado con `<link>` (**cero estilos en línea**)
- [ ] Variables en `:root`, y al menos cuatro usadas en el fichero
- [ ] `box-sizing: border-box` en `*`
- [ ] Tipografía en `rem` y `line-height` sin unidad
- [ ] Una `@media query` que adapte la maquetación al móvil
- [ ] Estados `:hover` y `:focus-visible` en los enlaces
- [ ] Sin `!important` en todo el fichero
- [ ] Solo clases como selectores (sin `#id` para dar estilo)

**Estructura de ficheros sugerida**

```
panaderia/
├── index.html
├── contacto.html
└── css/
    └── estilos.css
```

---

## Cómo se hace: el orden que funciona

Este es el enfoque. **No empieces por el CSS.**

### Paso 1 · El HTML, sin estilos

Escribe todo el HTML **sin una sola regla de CSS** y ábrelo en el navegador. Se verá feo, pero
**se debe ver TODO el contenido, en orden y sin cortes**. Eso es HTML bien hecho.

Si algo no se ve o está en un sitio raro, es un problema de **HTML**, no de CSS.

### Paso 2 · Validar antes de dar estilo

Pega el HTML en [validator.w3.org/nu/](https://validator.w3.org/nu/). Si sale verde, tienes
seguro el 80 % de los problemas. Cambia a "Mostrar todos" y lee también los avisos de accesibilidad.

### Paso 3 · El esqueleto visual

Marca los bloques principales con colores chillones:

```css
header { background: #ffcccc; }
nav    { background: #ccffcc; }
main   { background: #ccccff; }
footer { background: #ffffcc; }
```

Esto se llama un **wireframe en colores**. Es brutalmente eficaz: ves de un vistazo si las zonas
están donde deben, si falta un `padding` o si el `main` no existe.

### Paso 4 · Medir y ajustar

Pon límites a todo:

```css
* { outline: 1px solid rgba(255, 0, 0, 0.3); }
```

Con el `outline` ves dónde acaba cada caja **sin cambiar el tamaño** (a diferencia de `border`,
que sí añade espacio). **Quítalo cuando termines**, pero no antes: es la mejor herramienta
de depuración que existe.

### Paso 5 · Los colores de verdad

Ahora sí: aplica el diseño, las tipografías, los espacios.

### Paso 6 · El móvil

Reduce la ventana del navegador hasta 320 px de ancho (o usa el modo dispositivo del inspector)
y arregla lo que se rompa con `@media`.

### Paso 7 · Limpieza

- Quita los `outline` de depuración.
- Pasa el HTML por el validador otra vez.
- Revisa la **pestaña Network**: ¿hay errores 404? (imágenes que no existen, CSS mal enlazado).

---

## Andamiaje: el esqueleto que puedes reutilizar

Esto es tuyo, cópialo y **adáptalo**. Va deliberadamente a medio hacer: lo terminas tú.

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Espiga | Panadería en Madrid</title>
    <meta name="description" content="Panadería artesanal. Pan y bollería horneada cada mañana en Madrid.">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <a href="#contenido" class="salto">Saltar al contenido principal</a>

    <header>
        <a href="index.html" class="logo">
            <img src="img/logo.png" alt="Logotipo de la panadería La Espiga">
        </a>

        <nav aria-label="Navegación principal">
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="contacto.html">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main id="contenido">
        <h1>Pan recién horneado, cada mañana</h1>

        <article>
            <h2>Nuestros panes</h2>
            <p>Aquí escribes un párrafo normal sobre la masa madre, el horno de leña y
               lo que tardas en prepares cada pan. Usa <strong>negrita</strong> en la parte
               que de verdad quieras destacar.</p>
            <img src="img/pan.jpg" alt="Barra de pan rústica recién horneada sobre una mesa de madera">
        </article>

        <section id="productos">
            <h2>Productos y precios</h2>
            <div class="tabla-scroll">
                <table>
                    <caption>Catálogo de productos de la temporada</caption>
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Pan de millet</th>
                            <td>Con semillas, 500 g</td>
                            <td>3,20 €</td>
                        </tr>
                        <!-- mete tú al menos 4 productos más -->
                    </tbody>
                </table>
            </div>
        </section>

        <aside>
            <h2>Datos de contacto</h2>
            <address>
                <p>Calle del Trigo, 12<br>28004 Madrid</p>
                <p>
                    Tel: <a href="tel:+34910000000">910 000 000</a><br>
                    Email: <a href="mailto:hola@laespiga.es">hola@laespiga.es</a>
                </p>
            </address>
        </aside>
    </main>

    <footer>
        <p>© 2026 La Espiga · <a href="legal.html">Aviso legal</a></p>
    </footer>
</body>
</html>
```

```css
/* ==================================
   1. VARIABLES
   ================================== */
:root {
    --color-primario: #8b5e34;
    --color-texto: #2f2f2f;
    --color-fondo: #fdf8f0;
    --color-acento: #d9a441;
    --ancho-max: 1100px;
    --espaciado: 1rem;
}

/* ==================================
   2. BASE
   ================================== */
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Georgia, "Times New Roman", serif;
    font-size: 1rem;
    line-height: 1.6;
    color: var(--color-texto);
    background-color: var(--color-fondo);
}

img {
    max-width: 100%;
    height: auto;
}

a {
    color: var(--color-primario);
}

a:hover {
    color: var(--color-acento);
}

:focus-visible {
    outline: 2px solid var(--color-primario);
    outline-offset: 2px;
}

/* ==================================
   3. ENLACE DE SALTO (accesibilidad)
   ================================== */
.salto {
    position: absolute;
    left: -9999px;
}

.salto:focus {
    left: 1rem;
    top: 1rem;
    padding: 0.5rem 1rem;
    background: var(--color-primario);
    color: white;
    z-index: 10;
}

/* ==================================
   4. CABECERA Y NAVEGACIÓN
   ================================== */
header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: var(--espaciado);
    padding: var(--espaciado) 2rem;
    background-color: var(--color-primario);
}

nav ul {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 0.5rem 0;
    border-bottom: 2px solid transparent;
}

nav a:hover {
    border-bottom-color: var(--color-acento);
}

/* ==================================
   5. CONTENIDO
   ================================== */
main {
    max-width: var(--ancho-max);
    margin: 0 auto;
    padding: 2rem;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

caption {
    text-align: left;
    font-weight: bold;
    padding-bottom: 0.5rem;
}

th, td {
    border: 1px solid #ddd;
    padding: 0.6rem 0.8rem;
    text-align: left;
}

thead th {
    background-color: var(--color-primario);
    color: white;
}

/* ==================================
   6. MÓVIL
   ================================== */
@media (max-width: 600px) {
    header {
        flex-direction: column;
        text-align: center;
    }

    main {
        padding: var(--espaciado);
    }

    .tabla-scroll {
        overflow-x: auto;
    }

    table {
        min-width: 500px;
    }
}
```

> **Reparte el trabajo:** el andamiaje de arriba trae huecos a propósito.
> Añade el contacto real, la tabla completa, el formulario y el diseño de productos.
> **El objetivo del ejercicio no es copiar, es construir.** Si lo copias tal cual no aprendes nada;
> si lo rehaces con tus palabras, el HTML y el CSS se te quedan.

---

## Reto: el formulario completo

Añade a `contacto.html` un formulario que envíe a `enviar.php` (aunque el PHP todavía no exista):

```html
<form action="enviar.php" method="post">
    <p>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required minlength="3" autocomplete="name">
    </p>

    <p>
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" required autocomplete="email">
    </p>

    <p>
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}">
    </p>

    <p>
        <label for="pedido">Tipo de pedido</label>
        <select id="pedido" name="pedido">
            <option value="">-- Elige una opción --</option>
            <option value="pan">Pan</option>
            <option value="bolleria">Bollería</option>
            <option value="pasteles">Pasteles</option>
        </select>
    </p>

    <p>
        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" rows="6" required></textarea>
    </p>

    <p>
        <input type="checkbox" id="privacidad" name="privacidad" value="aceptada" required>
        <label for="privacidad">Acepto la política de privacidad</label>
    </p>

    <p>
        <button type="submit">Enviar pedido</button>
    </p>
</form>
```

Comprueba tú mismo que: sin rellenar el nombre, **el navegador no deja enviar**. Y comprueba
también que **se puede saltar** la validación. Por eso, cuando hagas el PHP, tendrás que
validar otra vez allí.

---

## Lista de comprobación final

Antes de entregar cualquier trabajo, pásalo por esta lista. Es más rápida que el profe.

**Antes de abrir nada**
- [ ] ¿Tiene DOCTYPE, `lang`, `charset`, `viewport` y `<title>`?
- [ ] ¿Pasa el validador de W3C sin errores?
- [ ] ¿Un solo `<h1>`? ¿Encabezados escalonados sin saltos?
- [ ] ¿Todas las imágenes con `alt` (o `alt=""` si son decorativas)?
- [ ] ¿Estructura semántica (`header`/`nav`/`main`/`footer`)?
- [ ] ¿El CSS es externo? ¿Queda algún `style="..."` suelto?
- [ ] ¿Varias clases en una regla? Entonces tienes reglas de sobra separadas.

**Mirando la pantalla**
- [ ] ¿Se ve bien a 320 px? ¿Hay scroll horizontal?
- [ ] ¿Los enlaces cambian al pasar el ratón? ¿Se ve dónde estás con el `Tab`?
- [ ] ¿La letra cambia si amplías el texto del navegador?

**En el servidor**
- [ ] ¿Todos los `src` y `href` están en minúsculas?
- [ ] ¿Las rutas llevan `../` bien puestos?
- [ ] ¿Los `alt` describen la imagen y no repiten el nombre del fichero?

---

## Si te atascas

En este orden, que va de menos a más coste:

1. **Validador de W3C** → te dice el fallo exacto, con número de línea.
2. **Inspector (`F12`)**: mira si el elemento está donde debería. A veces está en el sitio correcto
   y lo que falla es un color que se ve igual que el fondo.
3. **Aísla el problema**: comenta con `/* ... */` el CSS entero y ve añadiendo reglas poco a poco.
   Cuando se rompe, ya sabes cuál es la culpable.
4. **Busca en MDN** la propiedad concreta.
5. **Google**: el error literal entre comillas. Suele llevar a la respuesta exacta.

**Nunca te quedes 40 minutos atascado.** Anota el problema, sigue avanzando y vuelve después.
Es lo que hacen los profesionales.

---

## ¿Y ahora qué?

Ya tienes la base. Lo siguiente que merece la pena, en este orden:

1. **Maquetación moderna**: **Flexbox** (`display: flex`) y **CSS Grid** (`display: grid`).
   Con eso se acaban el 90 % de los problemas de maquetación que quedan. Son dos vídeos de
   20 minutos y cambian tu manera de trabajar.
2. **Estados**: `:hover` fino, transiciones (`transition`) y animaciones.
3. **Responsive de verdad**: `@media`, `minmax()`, `clamp()`.
4. **Buenas prácticas**: BEM para nombrar clases, variables, accesibilidad real, rendimiento.

**Y no te olvides de lo más importante:** sigue haciendo páginas. La teoría se olvida, las manos no.

---

*Volver al [00 · Índice y ruta de aprendizaje](00%20-%20%C3%8Dndice%20y%20ruta%20de%20aprendizaje.md)*
*← Anterior · [09 · CSS, selectores, modelo de caja y cascada](09%20-%20CSS%2C%20selectores%2C%20modelo%20de%20caja%20y%20cascada.md)*
