# Tarea 1 - Arrays

## Enunciado

1. Guarda en un array tus 6 películas favoritas.
2. Imprime en párrafos con el siguiente formato: `Película: Los Vengadores`
3. Añade la posición de la película: `Película 4: Godzilla`
4. **Pro:** imprime en lugar de párrafos... ¡una tabla! Añade un poco de CSS para
   mejorar el diseño. Cada título debe tener un color aleatorio.
   *Pista:* `random_int(0, 255)`

## Resolución

Fichero: `solucion.php`

### Cómo está hecho

El array se declara con corchetes y comas:

```php
$peliculas = [
    'Los Vengadores',
    'Godzilla',
    'Interstellar',
    'El Padrino',
    'Matrix',
    'Casablanca',
];
```

- **Punto 2.** Un `foreach` normal entrega solo el **valor**, así que no hay
  forma de saber en qué posición estamos.
- **Punto 3.** La forma `foreach ($array as $clave => $valor)` entrega también
  la clave. Como en PHP los índices empiezan en 0 pero el enunciado cuenta
  desde 1, se suma 1 al imprimir.
- **Punto 4.** Se sustituye el párrafo por `<tr><td>` y se envuelve todo en
  `<table>`. El color sale de pedir tres componentes RGB:

  ```php
  $r = random_int(0, 255);
  $g = random_int(0, 255);
  $b = random_int(0, 255);
  ```

  y aplicarlos con `style="color: rgb($r, $g, $b)"`. Al usar tres llamadas
  distintas, cada recarga da una combinación diferente.

### Salida esperada

```
Película: Los Vengadores
Película: Godzilla
...
Película 1: Los Vengadores
Película 4: Godzilla
...
```

### Puntos que conviene mirar

- `echo` añade un salto de línea al final, por eso los `<p>` y `<tr>` se
  comportan bien sin CSS.
- Si se quiere **espaciado fijo** entre celdas, hay que usar `<pre>` o
  `white-space: pre` en la CSS: el HTML normal colapsa los espacios.
- `random_int()` es más seguro que `rand()` porque no se.predictable y no
  devuelve valores sesgados.