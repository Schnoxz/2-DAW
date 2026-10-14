# Entrega UT2 — Desarrollo Web en Entorno Servidor

## Qué he hecho

En esta unidad he aprendido a programar en PHP y a meterlo dentro de páginas HTML.
He hecho las tres partes que pedía la unidad:

- **UT2_1, ejercicios iniciales**: un número aleatorio con tamaño aleatorio, un
  emoticono Unicode al azar y contar cuántas "t" tiene una frase.
- **UT2_2, ejercicios para practicar**: la fecha y hora actual, operaciones con dos
  números, quitar los espacios de una frase, constantes y tipos de dato.
- **UT2_3, ejercicio avanzado**: una página principal con tres botones que pasan
  datos por la URL a tres scripts (matemáticas, cadenas e información del servidor).

## Qué he aprendido

- Lo primero que pillé fue cómo se mezcla PHP con HTML: abrir y cerrar `<?php ... ?>`
  y usar `echo` para sacar HTML desde dentro del código.
- Las variables, las constantes con `define()` y los tipos de dato, con `is_float()`
  e `is_null()` para comprobarlos.
- Los operadores: sumar, dividir, el resto con `%`, comparar con `>` y `<`, y pegar
  cadenas con el punto `.`.
- Funciones que ya he usado un montón: `rand()`, `substr_count()`, `date()` con sus
  formatos, `str_replace()`, `round()`, `intval()` y `mb_strlen()`.
- A recoger los datos que llegan por la URL con `$_GET` y a mirar cosas del servidor
  con `$_SERVER`.
- Un detalle que me costó: **en PHP los decimales van con punto**, siempre, aunque
  aquí usemos coma. Si quieres que se vea con coma hay que cambiarlo a mano con
  `str_replace()`.

## Ayuda con opencode

El PHP lo he pensado y escrito yo, pero para la estructura HTML me he apoyado en
opencode. Sobre todo para montar las pestañas de Bootstrap (`nav-tabs`, los
`data-bs-target` y el script que las hace cambiar) y para dejar el HTML válido.
También me ayudó a ordenar el proyecto y a escribir esta memoria.

## Lo que más me ha costado

Lo que más me costó fue pasar datos de una página a otra por la URL en el ejercicio
avanzado. Al principio no entendía por qué lo que yo escribía como número llegaba
como texto, y las operaciones no sumaban: pegaban las cifras. Hasta que caí en que
**todo lo que viaja por la URL es texto** y hay que convertirlo con `intval()`.
Añádele lo del `&` que en el HTML hay que escribir como `&amp;` para que sea
válido... fue la parte que más veces tuve que parar y repensar.
