# Tema 1.1 · Cómo está resuelto

## De qué va

Es el tema de arranque: qué es una aplicación web, cómo se reparte el trabajo entre
el cliente y el servidor y qué límites tiene ejecutar código en el navegador.

La entrega tiene dos partes: tres cambios sobre un catálogo de productos y cuatro
cuestiones sobre los tiempos y los límites de la arquitectura.

## Qué pide el enunciado

1. Modificar el catálogo de ejemplo de tres formas concretas.
2. Medir cuánto tarda el navegador con 150.000 y con 500.000 registros y decir si
   el tiempo crece igual que los datos.
3. Explicar qué supone para el servidor que ese trabajo lo haga cada cliente.
4. Decidir si sería viable cargar 8 millones de registros en el navegador.

## Paso a paso

### Los tres cambios

**1. Cambiar el orden.** El catálogo ordenaba de barato a caro:

```js
catalogoProductos.sort((a, b) => a.precio - b.precio);
```

Se le da la vuelta cambiando el orden de la resta:

```js
catalogoProductos.sort((a, b) => b.precio - a.precio);
```

El comparador devuelve un número: negativo si `a` va antes, positivo si va después.
Invirtiendo la resta se invierte la lista.

**2. Cambiar el filtro.** El original filtraba «Informática»; ahora «Telefonía»:

```js
productosFiltrados = catalogoProductos.filter(prod => prod.categoria === "Telefonía");
```

**3. Subir el volumen.** De 150.000 a 500.000 registros:

```js
const TOTAL_REGISTROS = 500000;
```

Con eso se puede ver cómo se comporta el navegador cuando los datos crecen.

### Medir los tiempos

`performance.now()` da milisegundos con decimales, mucho más preciso que `Date`:

```js
const inicio = performance.now();
catalogoProductos.sort((a, b) => b.precio - a.precio);
const fin = performance.now();
console.log("Ordenar:", (fin - inicio).toFixed(2), "ms");
```

La medición se repite varias veces por cada tamaño, porque la primera pasada
siempre sale distinta (el navegador todavía está calentando). Se apunta cada
pasada y se saca la media.

El resultado: al multiplicar los datos por 3,3 (de 150.000 a 500.000), el tiempo
crece más o menos en esa proporción, pero el consumo de memoria y el bloqueo de la
interfaz no son lineales: llega un punto en que la pestaña se queda sin memoria y
el navegador la cierra.

### Qué supone para el servidor

Si cada usuario ordena y filtra en su navegador, la empresa se ahorra hacerlo en
el servidor. Con 10.000 visitas, el servidor no ordena 10.000 veces: manda los
datos una vez y cada equipo hace su parte. El servidor queda libre para lo que
solo él puede hacer con seguridad: cobros, accesos, contraseñas y datos.

### Los 8 millones de registros

No es viable cargarlos todos. Tres problemas:

- **Memoria:** millones de objetos a la vez tumban la pestaña en un móvil.
- **Descarga:** tardaría muchísimo y consumiría datos del usuario.
- **Respuesta:** ordenar y filtrar esa cantidad bloquea la interfaz.

La solución es **paginar y filtrar en el servidor**: pedir los registros por
grupos, ya ordenados y filtrados, y pintar solo los que se ven. El navegador no
necesita tener el catálogo entero para mostrarlo.

## El código, pieza a pieza

```
Ejercicio 1/
├── Original/catalogo.html              catálogo de partida
├── PracticaDepuracion/                 versión con el script separado
├── MedicionTiempos/catalogoPrueba1.html  herramienta de medición
└── WebPrueba/                          página mínima para el depurador
```

## Trampas y dudas

- **El primer `sort()` ya modifica el array.** `sort()` no devuelve una copia:
  ordena el original. Si hay que conservarlo, se copia antes con `[...array]`.
- **El comparador no es una resta cualquiera.** Si devuelve 0, el orden entre esos
  dos elementos no cambia.
- **La primera medición engaña.** Sale más lenta por el arranque del motor; por eso
  se repite y se hace la media.
- **`Date` no sirve para medir.** Tiene resolución de milisegundos; `performance.now()`
  da decimales.

## Si me preguntan

- **¿Qué va en el cliente y qué en el servidor?** En el cliente, lo que da
  inmediatez y no es sensible. En el servidor, lo que necesita seguridad, datos
  reales o mucho volumen.
- **¿Por qué el código del cliente no es secreto?** Porque se descarga al
  navegador: con F12 se ve y se puede modificar. Nunca se pone ahí una contraseña
  ni una regla de negocio.
- **¿Y si el usuario desactiva JavaScript?** La página pierde la interactividad,
  pero el HTML y el CSS siguen. Por eso lo importante se genera también en el
  servidor.
