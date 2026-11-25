# Tema 1.5 · Cómo está resuelto

## De qué va

El tema es cómo se engancha el JavaScript al HTML y qué pasa en cada forma. Hay
tres maneras: archivo externo, script embebido y atributos de evento en las
etiquetas. Todas funcionan, pero no se comportan igual durante la carga.

## Qué pide el enunciado

1. **Actividad 1** · Un `index.html` que enlace un `script.js` externo y muestre un
   `alert("hola")` al cargar.
2. **Actividad 2** · El mismo aviso con el script embebido en el `<head>`.
3. **Práctica guiada** · Reorganizar un proyecto en tres carpetas: raíz, `css/` y
   `js/`.
4. **Práctica de laboratorio** · Repetir la estructura con los ejercicios
   anteriores.

## Paso a paso

### 1 · Fichero externo

```html
<script src="script.js"></script>
```

```js
function diAlgo() {
  alert("hola");
}
diAlgo();
```

El navegador descarga el archivo y lo ejecuta como si estuviera escrito dentro del
documento. Ventaja: el HTML queda limpio y el navegador puede guardar el `.js` en
caché.

### 2 · Script embebido

```html
<head>
  <script>
    alert("hola");
  </script>
</head>
```

El aviso sale **antes** de que se pinte el `<body>`, porque el intérprete se para
en el `alert()` hasta que se acepta. Es la diferencia importante: el script
embebido en el `<head>` bloquea la carga de la página.

### 3 · El orden de ejecución

Si el script va en el `<head>` y busca elementos del `<body>`, no los encuentra:
todavía no existen. Hay tres soluciones:

```html
<!-- 1. dejarlo al final del body -->
<script src="script.js"></script>
</body>

<!-- 2. con defer: se ejecuta cuando el HTML está leído -->
<script src="script.js" defer></script>

<!-- 3. esperar al evento -->
<script>
  document.addEventListener("DOMContentLoaded", () => { /* ... */ });
</script>
```

### 4 · Reorganizar el proyecto

Antes cada ejercicio tenía los tres archivos sueltos en la misma carpeta. La
estructura que se pide es:

```
mi_proyecto/
├── index.html
├── css/
│   └── estilos.css
└── js/
    └── logica.js
```

Y los enlaces cambian de ruta:

```html
<link rel="stylesheet" href="css/estilos.css">
<script src="js/logica.js"></script>
```

Es el mismo esquema que usan los proyectos reales: separar por tipo de archivo
para que no acabe todo mezclado.

### 5 · Verificar que funciona

En cada una de las formas se comprueba lo mismo:

- Que el aviso sale al cargar.
- Que la consola no muestra errores (ni 404 del `.js`, ni `ReferenceError`).
- Que los estilos se aplican (si el CSS está bien enlazado).
- En la pestaña **Red**, que el navegador ha pedido el `.js` y el `.css` y los ha
  recibido con estado 200.

## El código, pieza a pieza

```
Actividades Tema 1.5/
├── Ejercicio 1/index.html + script.js     aviso con fichero externo
├── Ejercicio 2/index.html                 aviso embebido
├── Ejercicio 4/index.html + css/ + js/    integración completa
├── mi_proyecto/                           estructura final
├── practica_laboratorio/                  práctica guiada
└── capturas/                              estado inicial, alerta y pestaña Red
```

## Trampas y dudas

- **La ruta del `src` es relativa al HTML**, no al archivo desde donde se edita.
  Si el `.js` está en `js/`, hay que escribir `js/script.js`.
- **Un 404 en el `.js` no siempre se ve.** La página funciona pero el código no se
  ejecuta; hay que mirar la consola o la pestaña Red.
- **`defer` mantiene el orden** de los scripts; `async` no. Si uno depende de otro,
  `defer`.
- **El script embebido bloquea.** Un `alert()` en el `<head>` deja la página en
  blanco hasta que se acepta.

## Si me preguntan

- **¿Cuál es la mejor forma?** Archivo externo con `defer`. Separa el código,
  permite caché y no bloquea el pintado.
- **¿Por qué no se pone JavaScript en el `onclick`?** Porque mezcla estructura y
  lógica, y con dos líneas ya cuesta leerlo.
- **¿Qué significa que un script bloquee el renderizado?** Que el navegador deja de
  pintar la página mientras lo descarga y ejecuta.
