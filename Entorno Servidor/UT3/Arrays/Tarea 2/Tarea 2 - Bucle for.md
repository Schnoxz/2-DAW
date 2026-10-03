# Tarea 2 - Bucle `for`

## Enunciado

1. Imprime los números del 1 al 10.
2. Imprime los números del 60 al 70.
3. Imprime los números del 20 al 1.
4. Imprime los números del 1 al 1000.
5. Imprime la tabla del 5.
6. **Pro:** imprime la tabla del 5 con este formato: `5 x 3 = 15`

## Resolución

Fichero: `solucion.php`

### Cómo está hecho

Un `for` tiene siempre las tres partes, en este orden:

```php
for ($i = 1; $i <= 10; $i++) {
```

| Parte | Qué es | Ejemplo |
|---|---|---|
| inicialización | de dóndeempieza | `$i = 1` |
| condición | mientras se cumpla, repite | `$i <= 10` |
| incremento | qué pasa al terminar cada vuelta | `$i++` |

- **Punto 3.** Para bajar basta con invertir el sentido del incremento
  (`$i--`) y de la comparación (`$i >= 1`). Si se deja `$i++`, la condición
  nunca se cumple y el bucle no imprime nada.
- **Punto 5.** La tabla del 5 se hace con **dos bucles anidados**: el exterior
  baja por las filas y el interior por las columnas.
- **Punto 6.** Cada celda es el producto de los dos contadores, y se escribe
  `5 x 3 = 15` con `echo` interpolando las variables.

### Salida esperada

```
1
2
...
10
```

```
5 x 1 = 5
5 x 2 = 10
5 x 3 = 15
...
```

### Puntos que conviene mirar

- `<br>` se usa porque `echo` no genera saltos de línea en el HTML. En consola
  bastaría un `\n`.
- El bucle se evalúa **al principio de cada vuelta**: si la condición es
  falsa desde el principio, el cuerpo no se ejecuta ni una vez. Eso explica por
  qué `$i >= 1` con `$i++` no prints nada.
- El número de vueltas de un `for` es `condición final - inicial + 1` si
  avanza de uno en uno, o `(inicial - final) / 1` si retrocede.