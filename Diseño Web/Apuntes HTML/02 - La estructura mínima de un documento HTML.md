# 02 · La estructura mínima de un documento HTML

> Todo lo que necesitas para que una página exista: **dos bloques opcionales** y nada más.

---

## El esqueleto universal

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi primera página</title>
</head>
<body>
    <h1>Hola mundo</h1>
    <p>Esto es un párrafo.</p>
</body>
</html>
```

Copia esto tal cual en `index.html` y ya tienes una página web válida. Ahora veamos qué es cada cosa.

---

## Anatomía del esqueleto

### 1. `<!DOCTYPE html>` — la declaración

Es la **primera línea, siempre**, antes de nada. No es una etiqueta: es una declaración.

Su trabajo es **quitarle una duda al navegador**: "¿me lees esto en modo quirks (archivo antiguo, 1998)
o en modo estándar (como debe ser)?".

> **Trampa clásica:** muchos editores la borran "porque no es HTML". **No la borres jamás.**
> Sin DOCTYPE, el navegador entra en modo quirks y el CSS se comporta raro (anchuras y márgenes distintos).
> Es la causa nº 1 de "a mí en mi navegador sí funciona".

Se escribe en mayúsculas por costumbre, pero `doctype` en minúsculas también vale. Lo estándar es `<!DOCTYPE html>`.

### 2. `<html lang="es">` — el elemento raíz

- `html` es el **elemento raíz**: todo lo demás va dentro. Es la raíz del árbol DOM.
- `lang="es"` declara **en qué idioma está el contenido**. Sirve para:
  - que los lectores de pantalla elijan la pronunciación correcta;
  - que los buscadores ofrezcan la página a quien la busca en español;
  - que el navegador te sugiera traducciones.

**Ponlo siempre.** Es un atributo (`lang`) de una etiqueta. En español: `es`, `en`, `eu`...

### 3. `<head>` — la "cabecera técnica"

Contiene información **sobre** la página, que **no se ve** en la pantalla.

#### `<meta charset="UTF-8">`

Le dice al navegador **en qué codificación está escrito el archivo**. Sin esto verás acentos rotos:
`a��o` en lugar de `año`.

- `UTF-8` es el estándar. Escribe siempre `UTF-8`, con guion, y en mayúsculas.
- Debe ser **la primera etiqueta dentro de `<head>`**, antes de nada que muestre texto.

> **El bug más frustrante del aula:** acentos que aparecen como `Ã±`, `Ã©`... casi siempre es
> (a) que falta el `charset` o (b) que el archivo está guardado en UTF-8 y el editor/meta dice otra cosa.
> Si los tienes, mira esto primero.

#### `<meta name="viewport" content="width=device-width, initial-scale=1.0">`

Esta línea es **obligatoria hoy** y mucha gente aún no la tiene. Sin ella, si abres tu web en un móvil,
el navegador hace "zoom out" a toda la página y la ves diminuta.

Traducción: "usa el ancho real del dispositivo y no cambies el zoom inicial". Es lo que hace que tu web
se vea bien en el móvil. **Cópiala tal cual en todas tus páginas.**

#### `<title>Mi primera página</title>`

El título de la pestaña del navegador. **No se ve en la página**, pero es importantísimo:

- es lo que se ve en la **pestaña**;
- es lo que sale en los **resultados de Google** (el título azul);
- es lo que sale en la **pestaña de "favoritos"**;
- es lo que leen los lectores de pantalla al empezar.

**Una pestaña sin `<title>` se llama "Documento sin título".** Nunca dejes una así.

> Truco: el `<title>` debería ser lo que la persona **quiere leer**. Si pones "index.html", no te
> encuentra nadie. Si pones "Panadería La Espiga | Pan y bollería en Madrid", sí.

#### ¿Y `<link>`? — aquí entra el CSS

```html
<link rel="stylesheet" href="css/estilos.css">
```

Esa línea es la que **conecta el HTML con tu CSS**. La vemos a fondo en el apunte 08.

### 4. `<body>` — el "cuerpo"

Aquí dentro va **todo lo que sí se ve**: títulos, párrafos, imágenes, botones, formularios...

```html
<body>
    <h1>Hola mundo</h1>
</body>
```

> **Regla mental:** si es información *sobre* la página → `head`.
> Si es contenido *de* la página → `body`.
> El color de fondo y los estilos globales se pueden poner en `body` o en `html`.

---

## Visualizándolo: el árbol

```
html
├── head          ← no se ve
│   ├── meta charset
│   ├── meta viewport
│   └── title
└── body          ← se ve
    ├── h1 "Hola mundo"
    └── p "Esto es un párrafo."
```

Los demás elementos van **dentro de `<body>`** y se anidan unos dentro de otros. Esa anidación es
lo que luego permite los selectores CSS como `body nav ul li a`.

---

## Las reglas del anidamiento (importantes)

1. **Siempre cerrar lo que abres**, y en el orden correcto. Nunca `</b>` antes de `<i>`.
2. Los `<p>` **no se pueden anidar dentro de otros `<p>`**. El navegador "rompe" solo el documento
   y te descuadra la página. Es un clásico.
3. Dentro de un `<p>` solo caben etiquetas de **texto en línea** (`<a>`, `<strong>`, `<em>`, `<span>`...).
   Si metes un `<div>`, se corta el `<p>`.
4. Los **elementos de bloque** (`<div>`, `<p>`, `<h1>`, `<ul>`...) se pueden anidar donde quieras.
   Los **en línea** (`<span>`, `<a>`, `<strong>`) van **dentro** de los de bloque, no al revés.

---

## Errores típicos al empezar

| ❌ Lo que haces | 💥 Qué pasa | ✅ Lo correcto |
|---|---|---|
| No pones `<!DOCTYPE html>` | Modo quirks, CSS raro | Siempre la primera línea |
| Cierras las etiquetas en orden raro | Se rompe el anidamiento | Cerrar de dentro a fuera |
| Pones `<title>` después de `<body>` | title en sitio inválido | En `<head>` |
| No pones `lang` | Lectores de pantalla fallan | `<html lang="es">` |
| Guardas como `index.htm` en bloc de notas | Sale `index.html.txt` | Al guardar, quita las comillas del nombre |
| Pones acentos y se ven rotos | Falta el `charset` | `<meta charset="UTF-8">` |

> **El truco delBloc de Notas / "Guardar como":** si escribes el nombre entre comillas
> (`"index.html"`), crea un archivo llamado literalmente `index.html.txt`. **No pongas comillas.**
> En VS Code esto no pasa porque el nombre va en un campo aparte.

---

## Comprobación: valida siempre

Pega tu HTML en [validator.w3.org/nu/](https://validator.w3.org/nu/) y pulsa *Check*. Si sale verde,
tu estructura es correcta. Te ahorra horas de depurar "raridades" que en realidad son etiquetas
sin cerrar. **En DAW esto no es opcional: el HTML sin validar no puntúa.**

---

## Minirrégimen

1. Copia el esqueleto completo en `index.html`.
2. Ponle `<title>` con un nombre de una web que te guste.
3. Cambia `lang="es"` por `lang="en"` y busca en Google qué cambia. (Spoiler: los buscadores).
4. **Borra el `<!DOCTYPE html>`** y compara en el navegador. Nota la diferencia.
5. Pon `<h1>` antes de `<p>` y luego invierte el orden. ¿Cambia algo visualmente? ¿Por qué no?

---

*Siguiente apunte → [03 · Etiquetas de contenido y organización del texto](03%20-%20Etiquetas%20de%20contenido%20y%20organizaci%C3%B3n%20del%20texto.md)*
*← Anterior · [01 · Qué es HTML](01%20-%20Qu%C3%A9%20es%20HTML%20y%20qu%C3%A9%20hace%20el%20navegador.md)*
