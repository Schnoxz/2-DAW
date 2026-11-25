# Tema 1.4 · Cómo está resuelto

## De qué va

El tema compara los **scripts** con la programación tradicional: un script se
interpreta, no se compila, se ejecuta en el navegador y no tiene tipos fijos. Todo
eso tiene ventajas (rapidez, no hace falta instalar nada) y desventajas (errores que
solo aparecen al ejecutar, código visible).

Los ejercicios son de `Date`, que es donde se ven mejor las rarezas del lenguaje.

## Qué pide el enunciado

1. Predecir qué fecha construye cada uno de cinco `new Date(...)`.
2. `calcularDiasDiferencia(inicio, fin)` con cadenas `YYYY-MM-DD`.
3. `obtenerUltimoDiaMes(año, mes)` aprovechando el desbordamiento.
4. `formatearFechaEspanola(fecha)` con el formato `DD/MM/YYYY HH:mm`.
5. Comparar JavaScript con Java.
6. Ventajas de los scripts.
7. Práctica de laboratorio.

## Paso a paso

### 1 · Los cinco constructores

| Código | Resultado | Por qué |
|---|---|---|
| `new Date(2026, 0, 10)` | 10 de enero de 2026 | el mes empieza en **0** |
| `new Date(2026, 12, 1)` | 1 de enero de **2027** | el mes 12 se desborda al año siguiente |
| `new Date(2026)` | 1 de enero de 2026, 00:00 UTC | un solo número se interpreta como milisegundos desde 1970 |
| `new Date("2026-02-28")` | 28 de febrero de 2026 | el formato ISO se interpreta en **UTC** |
| `new Date("2026/02/28")` | 28 de febrero de 2026 | con barras se interpreta en hora **local** |

Las dos últimas dan el mismo día pero distinto instante: la primera a medianoche
UTC y la segunda a medianoche local. En España, eso son una o dos horas de
diferencia.

### 2 · Diferencia en días

```js
function calcularDiasDiferencia(fechaInicio, fechaFin) {
  const inicio = new Date(fechaInicio);
  const fin = new Date(fechaFin);
  const milisegundos = fin.getTime() - inicio.getTime();
  return Math.round(milisegundos / (1000 * 60 * 60 * 24));
}
```

Se resta en milisegundos y se divide entre los milisegundos de un día. Se redondea
porque los cambios de hora hacen que un día tenga 23 o 25 horas y la división no
dé un entero exacto.

### 3 · Último día del mes

El truco es pedir el día **0** del mes siguiente:

```js
function obtenerUltimoDiaMes(anio, mes) {
  return new Date(anio, mes, 0).getDate();
}
```

`new Date(2026, 2, 0)` es el último día de febrero de 2026, porque el día 0 es el
anterior al 1. Como `mes` llega en formato humano (1 = enero), se pasa tal cual:
el constructor ya lo trata como «el mes siguiente».

### 4 · Formatear a mano

```js
function formatearFechaEspanola(fecha) {
  const dia = String(fecha.getDate()).padStart(2, "0");
  const mes = String(fecha.getMonth() + 1).padStart(2, "0");
  const anio = fecha.getFullYear();
  const horas = String(fecha.getHours()).padStart(2, "0");
  const minutos = String(fecha.getMinutes()).padStart(2, "0");
  return `${dia}/${mes}/${anio} ${horas}:${minutos}`;
}
```

`getMonth()` devuelve 0–11, así que hay que sumar 1. `padStart(2, "0")` pone el
cero de delante.

### 5 · JavaScript frente a Java

Son lenguajes distintos que comparten nombre por motivos comerciales. Las
diferencias que importan:

| | JavaScript | Java |
|---|---|---|
| Ejecución | interpretado por el navegador | compilado a bytecode |
| Tipos | dinámicos | estáticos |
| Dónde corre | cliente (y servidor con Node) | servidor, escritorio, Android |
| Errores | aparecen al ejecutar | muchos se detectan al compilar |

### 6 · Ventajas de los scripts

- No hay que compilar ni instalar: se edita y se recarga.
- Se ejecuta en la máquina del usuario, así que el servidor se ahorra trabajo.
- La respuesta es inmediata, sin recargar la página.
- El código se puede leer y aprender de él.

Y las desventajas: es público, cada navegador puede comportarse distinto y un error
de sintaxis no se detecta hasta que se ejecuta.

### 7 · Laboratorio

Se comprueban en consola los cinco constructores y las funciones, comparando lo
predicho con lo que sale. La conclusión es que `Date` es fácil de usar mal: el mes
desde 0, el desbordamiento y las dos formas de interpretar una cadena.

## El código, pieza a pieza

```
Actividades Tema 1.4/
├── Ejercicio 1/index.html    los cinco constructores
├── Ejercicio 2/index.html    diferencia de días
├── Ejercicio 3/index.html    último día del mes
├── Ejercicio 4/index.html    formato DD/MM/YYYY HH:mm
├── Ejercicio 5/Ejercicio5.md respuesta teórica
├── Ejercicio 6/Ejercicio6.md ventajas de los scripts
└── Ejercicio 7/index.html    laboratorio
```

## Trampas y dudas

- **El mes empieza en 0.** Enero es 0 y diciembre es 11. Es el error número uno.
- **`new Date("2026-02-28")` es UTC**, no local. Por eso a veces sale un día menos.
- **Restar fechas da milisegundos**, no días: hay que dividir.
- **`getMonth()` no devuelve el nombre del mes.** Para eso está
  `toLocaleString("es-ES", { month: "long" })`.

## Si me preguntan

- **¿Por qué se dice que JavaScript no tiene tipos?** Porque una variable puede
  pasar de número a texto sin declararlo; el tipo va con el valor, no con la
  variable.
- **¿Qué es un script?** Código que el navegador interpreta línea a línea, sin
  compilación previa.
- **¿`Date` sirve para todo?** Para lo básico sí, pero para zonas horarias y
  cálculos serios está `Temporal`, que se ve en el tema 3.1.1.
