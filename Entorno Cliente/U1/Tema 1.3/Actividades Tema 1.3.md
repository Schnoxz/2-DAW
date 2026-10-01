# Actividades Prácticas y de Consolidación — Tema 1.3

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Enunciado: apartado **G. Actividades Prácticas y de Consolidación** del tema «Identificación y caracterización de los principales lenguajes relacionados con la programación de clientes Web» (Criterio 1.3).
> Primera línea del apartado G: **«Realiza los ejercicios del apartado anterior haciendo uso de funciones.»**

## Qué hay que entregar

Los nueve ejercicios del tema 1.2, **rehechos usando funciones**. Cada ejercicio es el mismo que su versión del 1.2, pero con el comportamiento sacado del `onclick` y metido en una función.

Los otros dos puntos del apartado G se resuelven aparte:

- **Actividad Propuesta 1.1** → programación reactiva, cómo se comporta una hoja de cálculo.
- **Actividad de Análisis Comparativo** → tabla justificando ReactJS, Angular o Vue.js en tres escenarios.

## Separación en ficheros

Cada ejercicio tiene tres archivos que deben **mantenerse juntos** en su carpeta:

- `index.html` → estructura y los `onclick` que llaman a las funciones.
- `estilos.css` → presentación.
- `script.js` → las funciones con toda la lógica.

## Qué cambia respecto al 1.2

| Antes (1.2) | Ahora (1.3) |
|---|---|
| El código va suelto en el `onclick` | El `onclick` solo llama a una función |
| Sin fichero aparte | La lógica va en `script.js` |
| El CSS va dentro del `index.html` | El CSS va en `estilos.css` |

## Índice de ejercicios

1. [Ejercicio 1 — Botones que modifican el `<h1>` y el párrafo](#ejercicio-1--botones-que-modifican-el-h1-y-el-párrafo)
2. [Ejercicio 2 — Evento clic con `console.log()`](#ejercicio-2--evento-clic-con-consolelog)
3. [Ejercicio 3 — Modal con `alert()`](#ejercicio-3--modal-con-alert)
4. [Ejercicio 4 — Saludo multidioma con color](#ejercicio-4--saludo-multidioma-con-color)
5. [Ejercicio 5 — Salida multidioma solo por consola](#ejercicio-5--salida-multidioma-solo-por-consola)
6. [Ejercicio 6 — Salida directa con `document.write()`](#ejercicio-6--salida-directa-con-documentwrite)
7. [Ejercicio 7 — Interfaz con tres botones (Consola / Estilo / Alerta)](#ejercicio-7--interfaz-con-tres-botones-consola--estilo--alerta)
8. [Ejercicio 8 — Test interactivo de Verdadero/Falso](#ejercicio-8--test-interactivo-de-verdaderofalso)
9. [Ejercicio 9 — Secuencia cíclica de imágenes](#ejercicio-9--secuencia-cíclica-de-imágenes)

---

## Ejercicio 1 — Botones que modifican el `<h1>` y el párrafo

**Del 1.2·1.** Dos botones: uno cambia el párrafo y el otro el encabezado.

```js
function cambiarParrafo() {
  document.getElementById('prueba').innerHTML = 'CAMBIANDO el contenido!';
}

function cambiarTitulo() {
  document.getElementById('titulo').innerHTML = '¡TÍTULO cambiado!';
}
```

En el 1.2 el segundo botón no existía; el enunciado pedía añadirlo.

---

## Ejercicio 2 — Evento clic con `console.log()`

**Del 1.2·2.** El clic se captura y emite una traza.

```js
function emitirTraza() {
  console.log('Se ha capturado el evento clic del botón.');
}
```

`console.log()` solo escribe en la consola: no altera la página.

---

## Ejercicio 3 — Modal con `alert()`

**Del 1.2·3.** En vez de escribir en el párrafo, se abre una ventana modal.

```js
function mostrarAviso() {
  window.alert('Clic capturado: se muestra una ventana emergente modal.');
}
```

`window.alert()` bloquea la interacción con la página hasta que el usuario confirma.

---

## Ejercicio 4 — Saludo multidioma con color

**Del 1.2·4.** Tres botones que muestran un saludo con su color.

```js
const saludos = {
  ru: { texto: 'Привет!', color: 'purple' },
  es: { texto: '¡Hola!', color: 'green' },
  en: { texto: 'Hello!', color: 'blue' }
};

function saludar(idioma) {
  const p = document.getElementById('saludo');
  p.innerHTML = saludos[idioma].texto;
  p.style.color = saludos[idioma].color;
}
```

El idioma llega como **parámetro**, así que la misma función sirve para los tres botones.

---

## Ejercicio 5 — Salida multidioma solo por consola

**Del 1.2·5.** La misma tabla de saludos, pero escribiéndose únicamente en la consola.

```js
function saludar(idioma) {
  const s = saludos[idioma];
  console.log(s.texto + ' (color sugerido: ' + s.color + ')');
}
```

Esta versión no toca el DOM.

---

## Ejercicio 6 — Salida directa con `document.write()`

**Del 1.2·6.** El saludo se genera en el flujo del documento.

```js
const saludos = { ru: 'Привет!', es: '¡Hola!', en: 'Hello!' };

function saludar(idioma) {
  document.write('<h1>' + saludos[idioma] + '</h1>');
}
```

`document.write()` tras la carga reabre el flujo y **sustituye** todo el contenido, por eso los botones desaparecen al pulsar.

---

## Ejercicio 7 — Interfaz con tres botones (Consola / Estilo / Alerta)

**Del 1.2·7.** Los tres botones, cada uno en su función.

```js
const estado = document.getElementById('estado');

function consola() {
  console.log('Hora del sistema: ' + new Date().toLocaleTimeString());
}

function estilo() {
  estado.innerHTML = 'Sistema Activo';
  estado.style.backgroundColor = 'green';
}

function alerta() {
  window.alert('El proceso ha concluido.');
}
```

Cada función toca una cosa sola: la consola, el estilo o el modal.

---

## Ejercicio 8 — Test interactivo de Verdadero/Falso

**Del 1.2·8.** Siete preguntas con botones «Verdadero» y «Falso».

```js
const respuestas = [true, false, true, true, true, true, true];

function responder(numero, ganaBoton) {
  const esAcierto = (respuestas[numero - 1] === ganaBoton);
  const div = document.getElementById('pregunta' + numero);
  div.style.color = esAcierto ? 'green' : 'red';
}
```

La función recibe dos parámetros: el número de pregunta y qué botón se ha pulsado.

---

## Ejercicio 9 — Secuencia cíclica de imágenes

**Del 1.2·9.** Cuatro fotogramas que avanzan al hacer clic.

```js
function siguiente() {
  indice = (indice + 1) % imagenes.length;
  foto.src = imagenes[indice];
  pie.innerHTML = 'Fotograma ' + (indice + 1) + ' de ' + imagenes.length;
}

document.getElementById('foto').addEventListener('click', siguiente);
```

El módulo `%` hace que el contador vuelva al principio al llegar al último. Aquí el clic se registra con `addEventListener` porque no hay `onclick` en el HTML: el elemento es una imagen.
