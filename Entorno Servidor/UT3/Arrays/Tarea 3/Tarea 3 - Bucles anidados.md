# Tarea 3 - Bucles anidados

## Enunciado

1. Suma los números del 1 al 100.
2. Supongo que el ejemplo anterior está claro y no tienes dudas. ¡Demuéstramelo!
   - ¿Cuántas veces se ejecuta el primer `foreach`?
   - ¿Cuántas veces se ejecuta el segundo `foreach`?
   - ¿Cuántos `echo` se han realizado? ¿Corresponde a las respuestas anteriores?
   - En el ejemplo tienes 2 loops anidados. ¿Cuántos piensas que pueden
     existir como máximo (un bucle dentro de un bucle de otro bucle...)?

## Resolución

Fichero: `solucion.php`

### Suma del 1 al 100

```php
$suma = 0;
for ($i = 1; $i <= 100; $i++) {
    $suma += $i;
}
```

Se necesita una variable **fuera** del bucle (`$suma`) que acumule. Si se
declarara dentro, se perdería en cada vuelta. El resultado es `5050`.

Atajo: `$suma = (100 * 101) / 2;` (fórmula de Gauss), pero el enunciado pide
el bucle.

### El ejemplo de los dos `foreach`

```php
$frutas = ['fresa', 'naranja', 'uva'];
$colores = ['rojo', 'verde'];

foreach ($frutas as $fruta) {
    foreach ($colores as $color) {
        echo "La $fruta es $color<br>";
    }
}
```

Respuestas:

| Pregunta | Respuesta | Por qué |
|---|---|---|
| ¿Cuántas veces se ejecuta el primer `foreach`? | **3** | Una vuelta por cada elemento del array exterior, y tiene 3. El bucle exterior es el que "manda". |
| ¿Cuántas veces se ejecuta el segundo `foreach`? | **6** | Se reinicia **completo** por cada vuelta del exterior: 3 elementos × 2 colores. |
| ¿Cuántos `echo`? | **6** | Hay un `echo` dentro del bucle interior, y el interior se ejecuta 6 veces. Coincide. |
| ¿Cuántos bucles anidados puede haber como máximo? | **Los que quieras** | PHP no impone ningún límite. El límite real es la memoria y el tiempo de ejecución. |

### La trampa del enunciado

Lo que se suele responder mal es "el segundo `foreach` se ejecuta 2 veces",
contando sus propias vueltas como si el exterior no influyera. Un bucle
anidado **se vuelve a inicializar** en cada vuelta del exterior. El interior
solo ejecuta 2 veces *por cada vuelta del exterior*.

### Puntos que conviene mirar

- El coste de los bucles anidados es **multiplicativo**: 3 × 2 = 6, pero
  1000 × 1000 serían un millón de vueltas. Por eso `foreach` sobre un array es
  más rápido que `for` con `count()` en cada vuelta.
- Un bucle anidado sirve para recorrer **combinaciones**: pares, triplas,
  tablas, etc.