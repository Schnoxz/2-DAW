# Tema 2.4 · Cómo está resuelto

## De qué va

El tema son las **conversiones entre tipos**: cómo JavaScript pasa de texto a
número, de número a booleano y qué pasa cuando el tipo no está claro. Es un
lenguaje de tipado débil, así que las conversiones ocurren solas y a veces
sorprenden.

## Qué pide el enunciado

1. Explicar el «enigma» de la igualdad con booleanos.
2. Un inspector de conversiones: una página que recibe un valor, lo convierte con
   `Number`, `String` y `Boolean` y muestra el resultado y el tipo.

## Paso a paso

### 1 · El enigma

```js
console.log("0" == false);   // true
if ("0") { /* entra */ }      // entra, porque "0" es truthy
```

Las dos líneas parecen contradecirse, pero preguntan cosas distintas:

- `==` **convierte** los dos operandos a número: `Number("0")` es 0 y
  `Number(false)` es 0, así que `0 == 0` da `true`.
- `if ("0")` no compara: pregunta si el valor es **truthy**. Una cadena no vacía lo
  es, aunque sea `"0"`.

Con `===` el resultado sería `false`, porque además exige el mismo tipo.

### 2 · El inspector de conversiones

El campo de texto siempre devuelve texto, así que hay que interpretarlo:

```js
function interpretar(texto) {
  if (texto === "undefined") return undefined;
  if (texto === "NaN") return NaN;
  try {
    return JSON.parse(texto);   // 5, true, null, "hola", [1,2]
  } catch {
    return texto;               // si no es JSON válido, queda como texto
  }
}
```

`JSON.parse` permite escribir `5`, `true` o `[1,2]` sin comillas. Lo que no es JSON
válido se queda como cadena.

Después se muestran las tres conversiones:

```js
Number(valor);
String(valor);
Boolean(valor);
```

Y el tipo real con `typeof`.

### 3 · Las trampas que avisa la página

| Valor | `Number` | `String` | `Boolean` | Comentario |
|---|---|---|---|---|
| `0` | 0 | "0" | false | el cero es falsy |
| `"0"` | 0 | "0" | **true** | texto no vacío: truthy |
| `""` | 0 | "" | false | texto vacío: falsy |
| `"abc"` | **NaN** | "abc" | true | no se puede convertir |
| `[]` | **0** | "" | true | un array vacío pasa a texto vacío |
| `{}` | NaN | "[object Object]" | true | |

### 4 · `+ 10` frente a `- 10`

```js
"5" + 10   // "510"  concatena
"5" - 10   // -5     resta
```

El `+` está sobrecargado: si uno de los dos es texto, concatena. El `-` no tiene
esa ambigüedad y siempre convierte a número.

## El código, pieza a pieza

```
Actividades Tema 2.4/
├── Ejercicio 1 - El enigma de la igualdad con booleanos/
├── Ejercicio 2 - Inspector de conversiones y tipado débil/
└── capturas/   resultados de cada caso probado
```

## Trampas y dudas

- **`Number("")` vale 0.** Un campo vacío no da error: da cero. Por eso hay que
  comprobar el texto antes.
- **`Number(null)` vale 0** y `Number(undefined)` vale `NaN`.
- **`Boolean("false")` es `true`.** Cualquier texto no vacío es verdadero.
- **`[] == false` es `true`.** El array se convierte a "" y luego a 0.

## Si me preguntan

- **¿Qué es el tipado débil?** Que el tipo lo lleva el valor, no la variable, y el
  motor convierte cuando hace falta.
- **¿Cómo se comprueba si algo es un número?** `Number.isNaN()` para descartar, y
  `Number.isFinite()` para descartar también `Infinity`.
- **¿Por qué `"0" == false` pero `"0"` es truthy?** Porque `==` convierte a número
  y `if` solo mira si el valor cuenta como verdadero.
