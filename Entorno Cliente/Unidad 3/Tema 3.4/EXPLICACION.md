# Tema 3.4 · Cómo está resuelto

## De qué va

El tema es **crear contenido desde JavaScript**: construir nodos, insertarlos en
el sitio que toque y elegir bien entre `textContent` e `innerHTML`.

Las tres actividades van en una sola página, con un archivo por actividad.

## Qué pide el enunciado

1. **3.4.1** · Crear una lista con los módulos DWEC, DWES y DIW usando solo
   `createElement()`, `createTextNode()` y `appendChild()`.
2. **3.4.2** · Una lista de tareas con `append()`, `prepend()` y
   `replaceChildren()`, sin añadir nada si el campo está vacío.
3. **3.4.3** · Insertar la misma cadena con `textContent` y con `innerHTML` y
   comprobar la diferencia.

## Paso a paso

### 3.4.1 · Construir la lista a mano

En el HTML solo hay un contenedor vacío. La lista se crea entera:

```js
const lista = document.createElement("ul");

for (const modulo of modulos) {
  const item = document.createElement("li");
  const texto = document.createTextNode(modulo);
  item.appendChild(texto);
  lista.appendChild(item);
}

contenedorLista.appendChild(lista);
```

El orden importa: primero se monta cada `<li>` en memoria, luego se cuelga del
`<ul>` y solo al final el `<ul>` entra en el documento. Así el navegador
recalcula el diseño una vez y no una por elemento.

### 3.4.2 · Insertar al principio, al final y reiniciar

```js
listaTareas.append(crearItem(texto));      // al final
listaTareas.prepend(crearItem(texto));     // al principio
listaTareas.replaceChildren(crearItem("Lista reiniciada"));  // todo de golpe
```

`append()` y `prepend()` aceptan nodos o cadenas de texto. Aquí se les pasa un
`<li>` ya creado para que se vea el proceso.

Antes de insertar se comprueba el campo:

```js
const texto = campo.value.trim();
if (texto === "") {
  avisar("El campo está vacío: no se ha añadido nada.");
  return;
}
```

Sin esa comprobación se crearía un `<li>` vacío que no se ve pero ocupa sitio.

`replaceChildren()` sustituye el patrón antiguo de borrar hijo a hijo:

```js
while (lista.firstChild) { lista.removeChild(lista.firstChild); }
```

### 3.4.3 · `textContent` frente a `innerHTML`

La misma cadena se inserta en dos cajas:

```js
resultadoTexto.textContent = campoTexto.value;   // se ve el texto tal cual
resultadoHtml.innerHTML = campoTexto.value;      // el navegador lo interpreta
```

Con `textContent` las etiquetas se ven escritas y no se crea ningún elemento. Con
`innerHTML` el navegador analiza la cadena, crea el `<strong>` y el `<span>` y
aplica el `color:red`.

La prueba de seguridad: si la cadena es
`<img src='x' onerror='window.__xss = true'>`, con `textContent` no pasa nada y
con `innerHTML` el navegador intenta cargar la imagen, falla y **ejecuta el
`onerror`**. Eso es XSS.

La regla que sigo: `innerHTML` solo con cadenas escritas por mí, `textContent`
siempre que haya un dato del usuario.

## El código, pieza a pieza

```
index.html          las tres secciones
css/estilos.css
js/lista.js         3.4.1
js/tareas.js        3.4.2
js/texto.js         3.4.3
```

## Trampas y dudas

- **`createElement` no inserta nada.** Crea el nodo en memoria; hasta que no se
  hace `appendChild`, no está en la página.
- **`appendChild` mueve, no copia.** Si el nodo ya estaba en el documento, se
  traslada.
- **`innerHTML` destruye los hijos.** Al reasignarlo, los elementos anteriores se
  borran y se reconstruyen: se pierden los `addEventListener` que tuvieran.
- **`innerHTML +=` es lo peor.** Serializa todo el contenido y lo vuelve a crear,
  así que además de lento borra los eventos.

## Si me preguntan

- **¿Por qué no usar `innerHTML` para todo?** Porque es más lento en inserciones
  grandes, borra los eventos de los hijos y abre la puerta a XSS si la cadena
  viene del usuario.
- **¿Cuándo sí `innerHTML`?** Cuando la cadena es mía y ya está escrita en el
  código, o cuando vengo de una plantilla de confianza.
- **¿`textContent` o `innerText`?** `textContent` lee todo, incluido lo oculto con
  `display:none`, y es más rápido; `innerText` mira lo que se ve y fuerza un
  recálculo de estilos.
