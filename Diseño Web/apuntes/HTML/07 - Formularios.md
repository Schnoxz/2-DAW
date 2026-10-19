# 07 · Formularios

> La parte donde HTML se parece más a "programar", pero sigue siendo **marcado**.
> Y donde se conjugan **HTML + CSS + servidor**.

---

## Qué es un formulario

Un formulario es el conjunto de controles con los que una persona **introduce datos**.
HTML solo se encarga de marcarlos y de validar lo básico. Lo que pase después (guardarlos, mandarlos por correo)
es trabajo del **servidor** (PHP, en tu caso).

```
Persona rellena  →  Navegador valida  →  Se envía al servidor  →  PHP lo procesa
     (HTML)           (HTML5)              (action/method)          (backend)
```

---

## La etiqueta `<form>`

```html
<form action="procesar.php" method="post">
    <!-- aquí dentro, los controles -->
</form>
```

| Atributo | Qué hace |
|---|---|
| `action` | **A dónde** se envían los datos (fichero que los procesa) |
| `method` | **Cómo** se envían: `get` o `post` |

### `get` vs `post` (se explica, no se memoriza)

| | `method="get"` | `method="post"` |
|---|---|---|
| Cómo viaja | En la **URL** (`?nombre=Javier&edad=20`) | En el **cuerpo** de la petición |
| Se ve en la barra | **Sí** | No |
| Límite de tamaño | Corto (~2000 caracteres) | Grande |
| Para qué | Buscar, filtrar, compartir una búsqueda | **Enviar datos**: formularios de contacto, registros, contraseñas |

> **Regla práctica:** si el formulario tiene una **contraseña**, un **correo** o datos personales
> → siempre `post`. Con `get` los datos quedan escritos en la barra de direcciones y en el historial.
> Nunca uses `get` para contraseñas. Es el fallo de seguridad más tonto y más común que existen.

Si no pones `action`, el formulario se envía a la propia página. Y si no pones `method`, es `get`.

---

## `<label>`: el apunte más importante del tema

```html
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre">
```

El atributo **`for`** del `<label>` apunta al **`id`** del control. Eso **los ata**.

### ¿Por qué es obligatorio en la práctica?

1. **Clic en la etiqueta** → se enfoca el campo. En un móvil, eso significa que se abre el teclado.
2. **Lectores de pantalla**: al leer "Nombre" pulsan Tab y el lector dice "campo de texto, Nombre".
   Sin `<label>`, dice "campo de texto, sin etiqueta" y es inusable.
3. **Contraste y zoom**: la etiqueta sigue siendo legible aunque agrandes la fuente hasta el 200 %.
4. **Se evalúa en DAW.** Un formulario con campos sin `label` es un formulario mal hecho.

> **Error clásico:** `<label name="nombre">` — ese `name` no hace nada. Lo que ata el label
> al campo es **`for` + `id`**. Punto.

---

## Los `<input>`: un elemento, muchos tipos

```html
<input type="text" id="nombre" name="nombre">
```

| `type` | Qué se ve | Se usa para |
|---|---|---|
| `text` | Campo de texto normal | Nombres, apellidos, usuario |
| `email` | Campo de texto | Correo (el móvil pone `@`, valida el formato) |
| `password` | Puntos `••••` | Contraseñas (¡nunca `text`!) |
| `number` | Con flechitas | Edad, cantidad, precio. Acepta decimales si `step` |
| `tel` | Teclado numérico en móvil | Teléfono |
| `url` | Campo de texto | Direcciones web completas |
| `date` | Calendario | Fechas |
| `time` | Reloj | Horas |
| `datetime-local` | Calendario + hora | Fecha y hora a la vez |
| `color` | Muestra de color | Selector de color |
| `file` | Botón "Elegir fichero" | Subir imágenes o PDF |
| `checkbox` | Casilla | Opción sí/no, se puede marcar varias |
| `radio` | Círculo | Opción sí/no, **solo una** del grupo |
| `hidden` | Invisible | Datos que se mandan solos (id del usuario, token CSRF) |
| `search` | Campo con la X de borrar | Buscadores |

> **`type` no es solo estética.** `type="email"` en un móvil **cambia el teclado** y **valida** el formato.
> `type="number"` impide escribir letras. Eso es funcionalidad, no decoración.

### Atributos que importan de verdad

```html
<input
    type="text"
    id="nombre"
    name="nombre"
    placeholder="Escribe tu nombre"
    required
    minlength="3"
    maxlength="50"
    pattern="[A-ZÁÉÍÓÚÑ][a-záéíóúñ ]{2,49}"
    autocomplete="name"
    readonly>
```

| Atributo | Para qué |
|---|---|
| `name` | **El nombre del dato** que se envía al servidor. Sin `name`, el campo **no viaja**. |
| `id` | Identificador único en la página (para el `for` del label, CSS y JS) |
| `placeholder` | Texto gris de ejemplo. **No sustituye a la etiqueta.** |
| `required` | Obligatorio |
| `min` / `max` / `step` | Rangos en `number`, `date`, `range` |
| `minlength` / `maxlength` | Longitud del texto |
| `pattern` | Expresión regular que debe cumplir |
| `autocomplete` | Sugiere al navegadorAutocompletar (facilita mucho al usuario) |
| `readonly` | Se ve pero no se edita |
| `disabled` | Se ve pero inactivo, **y además no se envía** |

> **`id` vs `name`, la confusión clásica:**
> - `name` → **para el servidor**. Es el dato que viaja. Si no lo pones, el campo no se envía.
> - `id` → **para el navegador**: CSS, JavaScript, y para el `for` del `<label>`.
> En muchos casos son iguales, pero **no tienen por qué serlo** (y no deben repetirse nunca).

---

## `checkbox` vs `radio`

```html
<!-- Casillas: se pueden marcar varias -->
<fieldset>
    <legend>Aficiones</legend>
    <input type="checkbox" id="af1" name="aficiones" value="lectura">
    <label for="af1">Lectura</label>
    <input type="checkbox" id="af2" name="aficiones" value="cine">
    <label for="af2">Cine</label>
</fieldset>

<!-- Radios: solo una del grupo -->
<fieldset>
    <legend>Turno preferido</legend>
    <input type="radio" id="t1" name="turno" value="manana" required>
    <label for="t1">Mañana</label>
    <input type="radio" id="t2" name="turno" value="tarde">
    <label for="t2">Tarde</label>
</fieldset>
```

- Lo que **agrupa** los radios es que tengan el **mismo `name`**. Si les pones nombres distintos,
  se pueden marcar los dos y ya no es una elección única.
- Cada `radio`/`checkbox` necesita su **propio `id`** y su **propio `label`**.

### `<fieldset>` y `<legend>`

No son obligatorios, pero **agrupan** controles relacionados y dan un título al grupo.
Visualmente los pone el navegador con un borde, y en el inspector se ve que agrupan.
Úsalos: es lo correcto semánticamente y se valora.

### La trampa del `value`

Un checkbox marcado **sin `value`** envía el valor `on` (o `1`, según el navegador). Si marcas
"deportes" y quieres saber cuál era, **el `value` es imprescindible**:

```html
<input type="checkbox" name="deportes" value="futbol">  <!-- envía "deportes=futbol" -->
```

---

## Áreas de texto y listas desplegables

```html
<label for="mensaje">Mensaje:</label>
<textarea id="mensaje" name="mensaje" rows="6" cols="50" required></textarea>

<label for="provincia">Provincia:</label>
<select id="provincia" name="provincia">
    <option value="">-- Elige una --</option>
    <optgroup label="Comunidad de Madrid">
        <option value="madrid">Madrid</option>
        <option value="toledo">Toledo</option>
    </optgroup>
    <optgroup label="Comunidad Valenciana">
        <option value="valencia" selected>Valencia</option>
    </optgroup>
</select>
```

- `<textarea>` **sí tiene etiqueta de cierre** `</textarea>`. Su contenido va dentro, no como atributo.
- `rows` y `cols` dan el tamaño inicial (el CSS manda después).
- `selected` marca la opción por defecto.
- `<optgroup>` agrupa opciones con un subtítulo. Se ve muy bien y es "gratis".
- En un `<select>`, la primera opción con `value=""` suele ser "-- Elige una --" y lleva `required`
  al select, para obligar a elegir de verdad.

### `datalist`: el autocompletado nativo

```html
<input type="text" id="pais" name="pais" list="lista-paises">
<datalist id="lista-paises">
    <option value="España">
    <option value="México">
    <option value="Argentina">
</datalist>
```

Es como un `select` pero **escribes** y filtra. Muy útil y solo con HTML.

---

## Los botones

```html
<!-- Botón de envío (dentro de un form) -->
<button type="submit">Enviar</button>

<!-- Botón normal, no envía nada -->
<button type="button">Cancelar</button>

<!-- Fora de un form: es un simple <button> sin type -->
<button>Haz clic</button>
```

- **`<input type="submit" value="Enviar">`** también funciona, y es HTML antiguo.
  En HTML5 lo moderno es `<button>`, porque admite **cualquier contenido dentro** (iconos, `<span>`...).

```html
<button type="submit">
    <svg ...></svg>
    <span>Enviar formulario</span>
</button>
```

> **Consejo de accesibilidad:** si un `<button>` no tiene texto visible (solo un icono),
> añádele `aria-label="Enviar"`. Un botón que solo tiene una flechita y no dice nada es
> inusable para un lector de pantalla.

### `type="reset"` y `type="button"`

- `reset` → borra todo el formulario y vuelve al estado inicial. Úsalo con cuidado
  (un botón "Borrar" junto a "Enviar" es un peligro: un clic de más y pierdes todo).
- `button` → no hace absolutely nada por sí solo. Se usa para que JavaScript le asigna
  una conducta. Sin JS, es un botón decorativo.

---

## Un formulario completo y bien hecho

```html
<form action="registro.php" method="post">
    <h2>Datos de registro</h2>

    <p>
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" required minlength="3" autocomplete="name">
    </p>

    <p>
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" required autocomplete="email">
    </p>

    <p>
        <label for="pass">Contraseña</label>
        <input type="password" id="pass" name="pass" required minlength="8" autocomplete="new-password">
    </p>

    <p>
        <label for="edad">Edad</label>
        <input type="number" id="edad" name="edad" min="14" max="99" required>
    </p>

    <p>
        <input type="checkbox" id="priv" name="privacidad" value="si" required>
        <label for="priv">He leído y acepto la política de privacidad</label>
    </p>

    <p>
        <button type="submit">Crear cuenta</button>
        <button type="reset">Borrar todo</button>
    </p>
</form>
```

Fíjate en que **cada control tiene su `id` + `name` + `<label for>`**. Ese es el patrón.

---

## La validación automática: `required` y los `:invalid` del CSS

Cuando pones `required` y dejas el campo vacío, el navegador **lo dice solo**: pone el borde en rojo,
sale un globo con el motivo y **no deja enviar**. Sin escribir ni una línea de JavaScript.

```css
input:required {
    border-left: 4px solid #c0392b;
}

input:valid {
    border-color: green;
}

input:invalid {
    border-color: red;
}
```

> **Limitación importante que debes saber:** esta validación la hace el navegador,
> y **se puede saltar**. Cualquiera que pulse Enter en la barra de direcciones puede mandar
> datos sin pasar por el formulario. Por eso **el servidor SIEMPRE tiene que volver a validar**.
> Nunca confíes en que el HTML ya lo ha comprobado. Esto se llama **validación en cliente vs servidor**.

---

## Errores típicos

| ❌ | 💥 | ✅ |
|---|---|---|
| `<label name="x">` | No se ata al campo | `<label for="x">` + `id="x"` |
| Campos sin `name` | **No se envían** al servidor | Siempre `name` |
| `method="get"` con contraseña | La contraseña queda visible | `method="post"` |
| `placeholder` en vez de `<label>` | Desaparece al escribir, inaccesible | Ambos: etiqueta + placeholder |
| Varios `radio` con distinto `name` | Se pueden marcar todos | Mismo `name` |
| `checkbox` sin `value` | Llega `on`, no sabes qué era | `value="lo-que-sea"` |
| `type="text"` para contraseñas | Se ve la contraseña | `type="password"` |
| `method` y `action` inventados | El formulario no llega a ningún sitio | Apunta a tu fichero PHP real |
| Anidar `<form>` dentro de `<form>` | Prohibido | Un solo form, con fieldset si hace falta |
| Confiar solo en la validación HTML | Se salta en un segundo | Validar también en el servidor |

---

## Minirrégimen

1. Monta un formulario de contacto con nombre, correo, teléfono, provincia y mensaje.
2. **Nada de `placeholder` sin `<label>`**: pon las dos cosas y compáralo.
3. Pon `method="get"`, envía y mira la URL. Ahora cambia a `post` y repite. ¿Qué ves?
4. Borra el `name` de un campo. ¿Llega al servidor? Compruébalo en la pestaña Network.
5. Descomenta el `required` y deja un campo vacío. Fíjate en cómo lo bloquea el navegador sin JS.
6. **Intenta saltártelo**View source, o en la consola: `form.submit()`. ¿Se manda igual?
   (Sí. Por eso el servidor tiene que validar.)

---

*Siguiente apunte → [08 · CSS, qué es y cómo se enlaza](08%20-%20CSS%2C%20qu%C3%A9%20es%20y%20c%C3%B3mo%20se%20enlaza.md)*
*← Anterior · [06 · Tablas en HTML](06%20-%20Tablas%20en%20HTML.md)*
