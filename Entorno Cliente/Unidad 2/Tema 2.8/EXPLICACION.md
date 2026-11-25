# Tema 2.8 · Cómo está resuelto

## De qué va

El tema son las **herramientas de depuración**: cómo encontrar un fallo que no
rompe la página. El laboratorio trae tres errores escondidos en un archivo que
funciona a simple vista: el script arranca, el botón responde y, sin embargo, el
resultado está mal.

## Qué pide el enunciado

1. Localizar y corregir los tres fallos de `depurador_lab.js`.
2. Grabar un vídeo de cuatro fases enseñando a depurarlos con las herramientas del
   navegador.
3. Justificar cada corrección con lo que se ve en el depurador.

## Los tres fallos

| # | Fallo | Qué provoca | Dónde se ve | Corrección |
|---|---|---|---|---|
| 1 | Lee `unidades` como texto | `"5"` en vez de `5`: con datos limpios la cuenta sale por casualidad; con basura da `NaN` sin avisar | en **Scope**, `unidades` aparece entre comillas | `Number(campo.value)` |
| 2 | `acumuladoTotal = 0;` sin declarar | crea una global: fuga de ámbito que cualquier script puede pisar | en **Scope → Global** aparece la variable | `"use strict"` + `let acumuladoTotal` |
| 3 | `for (let i = 0; i <= lotes.length; i++)` | cuando `i` llega a `length` se lee fuera del array: sale `undefined` y el total se rompe | en **Watch**, `lotes[i]` es `undefined` | `i < lotes.length` |

Ninguno es un `SyntaxError`. Los tres son **errores de lógica o de ámbito**, y por
eso solo se ven ejecutando paso a paso.

## Cómo se depura, fase por fase

### Fase 1 · Ámbitos y control paso a paso

- **F9** pone un punto de interrupción en la línea del cálculo.
- **F10** ejecuta la línea sin entrar en funciones.
- **F11** entra dentro de la función llamada.
- El panel **Scope** muestra las variables locales, las del cierre y las globales.

Ahí se ve el fallo 1: `unidades` tiene comillas, es texto.

### Fase 2 · Watch y punto condicional

En **Watch** se añade la expresión `typeof unidades` y se ve `"string"`. Para no
parar en cada vuelta del bucle, se pone un punto de interrupción condicional con
`i === lotes.length`, que es donde aparece el `undefined`.

### Fase 3 · Depuración por mutaciones del DOM

Se para en la línea que escribe en la página y se comprueba qué texto se está
pintando. Muchas veces el fallo no está en el cálculo sino en lo que se muestra.

### Fase 4 · Event Listener Breakpoints

En la pestaña **Sources**, el desplegable **Event Listener Breakpoints** permite
parar en cualquier `click`. Así se ve el recorrido completo desde que el usuario
pulsa el botón hasta que se actualiza el resultado.

## El código, pieza a pieza

```
Tema 2.8/
├── index.html                  la página del laboratorio
├── depurador_lab.js            con los tres fallos
├── depurador_lab_corregido.js  con las tres correcciones
├── estilos.css
└── Guion del video - paso a paso.md
```

La diferencia entre los dos `.js` es exactamente las tres líneas corregidas, así
que sirve para compararlos.

## Trampas y dudas

- **Un `console.log` no es depurar.** Sirve para mirar un valor, no para seguir el
  flujo ni ver el ámbito.
- **El error puede no lanzar excepción.** `undefined` en una suma da `NaN` y el
  script sigue; eso es lo que lo hace difícil.
- **`<=` en un `for` sobre un array** es el error de índice más común.
- **Sin `"use strict"` una variable sin declarar no da error**, y se cuela como
  global.

## Si me preguntan

- **¿Diferencia entre F10 y F11?** F10 pasa a la línea siguiente; F11 entra en la
  función que se va a ejecutar.
- **¿Qué es un watch?** Una expresión que el depurador evalúa en cada parada.
- **¿Por qué es peligrosa una variable global?** Porque cualquier otro script de la
  página puede cambiarla y el fallo aparece lejos de donde se creó.
