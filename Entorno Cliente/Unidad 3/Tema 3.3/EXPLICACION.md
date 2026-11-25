# Tema 3.3 · Cómo está resuelto

## De qué va

El tema es manipular la apariencia desde JavaScript sin tocar el CSS a mano: se
cambian clases con `classList`, se mueve la página con `scrollTo()` y se abre y
controla una ventana secundaria con `window.open()`.

Son cuatro actividades, cada una en su página, con un `index.html` que hace de
portal.

## Qué pide el enunciado

1. **3.3.1** · Una caja de 200 × 100 px con borde rojo que pasa a 300 × 250 px con
   borde discontinuo verde, añadiendo o quitando una clase.
2. **3.3.2** · Un documento largo con un botón flotante «Subir al inicio» que use
   `window.scrollTo({ behavior: "smooth" })`.
3. **3.3.3** · El panel de control del tema, ampliado con un estado de error y con
   el texto del botón de modo oscuro.
4. **3.3.4** · Abrir una ventana de 500 × 400 con `window.open()`, detectar el
   bloqueador y controlarla con `resizeBy`, `moveBy`, `focus` y `close`.

## Paso a paso

### 3.3.1 · Cambiar una clase

La caja lleva siempre `.caja-inicial` (200 × 100, borde rojo sólido). El cambio
consiste en añadir o quitar una segunda clase:

```css
.caja-grande {
  width: 300px;
  height: 250px;
  border: 3px dashed #22c55e;
}
```

```js
caja.classList.toggle("caja-grande");
```

`toggle()` añade la clase si no estaba y la quita si estaba, así que un solo botón
sirve de interruptor. Para restablecer se usa `remove()`, que no falla aunque la
clase no exista.

La transición de tamaño y borde está en CSS (`transition`), no en JavaScript: el
script solo cambia clases.

### 3.3.2 · Subir al inicio

La página se hace larga a propósito para que aparezca la barra vertical. El botón
va fuera del flujo del documento:

```css
.flotante {
  position: fixed;
  right: 20px;
  bottom: 20px;
}
```

Y al pulsarlo:

```js
window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
```

`behavior: "smooth"` hace que el navegador interpole la posición. Sin eso el
salto es instantáneo. Antes de llamar se guarda `window.scrollY` para mostrar
desde qué píxel se ha subido.

### 3.3.3 · El panel de control

Se parte del ejemplo del tema. Tiene seis botones y una tarjeta que va cambiando
de estado.

**El estado de error.** Se añade la clase `.estado-error` con el fondo `#fee2e2`,
el borde `#ef4444` y el texto `#7f1d1d`. El detalle está en cómo se aplica:

```js
tarjeta.classList.remove("estado-pendiente", "estado-completado");
tarjeta.classList.add("estado-error");
```

Si se usara `replace("estado-pendiente", "estado-error")`, al pulsar el error
desde el estado completado no pasaría nada, porque esa clase ya no estaba. Por eso
se quitan los dos estados posibles antes de poner el nuevo.

**El texto del botón de modo oscuro.**

```js
document.body.classList.toggle("modo-oscuro");

if (document.body.classList.contains("modo-oscuro")) {
  btnOscuro.textContent = "Modo Claro";
} else {
  btnOscuro.textContent = "Modo Oscuro";
}
```

No se guarda una variable de estado: la clase del `body` ya dice cómo está la
página, así que el botón no se puede desincronizar.

**Reiniciar.** `tarjeta.className = "caja estado-pendiente"` borra todas las clases
de golpe y deja solo las dos iniciales.

### 3.3.4 · La ventana secundaria

```js
ventanaAuxiliar = window.open(
  "3.3.4-auxiliar.html",
  "ventanaAuxiliar",
  "width=500,height=400,resizable=yes,scrollbars=yes"
);
```

Lo importante son las dos comprobaciones:

```js
if (ventanaAuxiliar === null) { /* el bloqueador la ha cortado */ }
if (ventanaAuxiliar === null || ventanaAuxiliar.closed) { /* no hay ventana */ }
```

El bloqueador **no lanza error**: devuelve `null`. Si se usara sin comprobar, el
script petaría con un `TypeError`. Y el usuario puede cerrar la ventana a mano, así
que antes de `resizeBy` o `moveBy` hay que mirar `closed`.

Los cuatro controles:

| Botón | Método |
|---|---|
| +40 px de ancho y alto | `ventanaAuxiliar.resizeBy(40, 40)` |
| Bajar 30 px | `ventanaAuxiliar.moveBy(0, 30)` |
| Traer al frente | `ventanaAuxiliar.focus()` |
| Cerrar | `ventanaAuxiliar.close()` |

`resizeBy` y `moveBy` **suman** a lo que ya hay; `resizeTo` y `moveTo` fijan un
valor absoluto.

## El código, pieza a pieza

```
index.html                portal con enlaces
3.3.1-clases.html         js/clases.js
3.3.2-scroll.html         js/scroll.js
3.3.3-tarjeta.html        js/tarjeta.js
3.3.4-principal.html      js/ventanas.js
3.3.4-auxiliar.html       la ventana que se abre
css/estilos.css
```

## Trampas y dudas

- **`className` sustituye todo.** Asignar `className = "x"` borra las demás
  clases; `classList` trabaja clase a clase.
- **`toggle` devuelve `true` si ha añadido** la clase, pero aun así se comprueba
  con `contains()` para que se lea mejor.
- **`scrollTo` con dos números** salta de golpe; con el objeto y `behavior` se
  controla la animación.
- **La ventana emergente necesita un servidor.** Con `file://` algunos navegadores
  la bloquean o la tratan distinto.

## Si me preguntan

- **¿Por qué no se cambia el `style` directamente?** Porque mezclar estilos en el
  JavaScript complica el mantenimiento: las clases viven en el CSS y el script
  solo decide cuál toca.
- **¿`resizeBy` o `resizeTo`?** `By` suma al tamaño actual, `To` lo fija. Para
  «+40 px» el que vale es `By`.
- **¿Qué pasa si el navegador bloquea la ventana?** `window.open()` devuelve
  `null`; no hay excepción, así que hay que comprobarlo.
