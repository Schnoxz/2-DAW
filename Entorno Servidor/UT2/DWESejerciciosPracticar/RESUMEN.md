# UT2_2 Ejercicios para practicar - qué he usado y dónde está en la teoría

Todos los ejercicios van en pestañas dentro de `index.php`, como pide el enunciado.
Todo el código usa solo cosas que salen en el PDF de la teoría
`../UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf`.

## Cómo abrirlo con XAMPP

1. Abre el **XAMPP Control Panel** y pulsa **Start** en **Apache**.
2. Escribe esto en el navegador:

   ```
   http://localhost/2-DAW/Entorno%20Servidor/UT2/DWESejerciciosPracticar/
   ```

3. Los cinco ejercicios están en la barra de pestañas de arriba. Cambiar de pestaña lo hace el
   JavaScript de Bootstrap, que es la línea `<script>` del final.

## Cómo abrir el ejercicio 5

Este lo pide el enunciado aparte, con el servidor propio de PHP y no con XAMPP. En una
terminal, dentro de la carpeta `Ejercicio5`:

```
php -S localhost:8000
```

Y abre `http://localhost:8000/tiposDeDato.php` para la salida 1 y
`http://localhost:8000/tiposDeDato2.php` para la salida 2.

**¿Por qué este con `php -S` y los otros con XAMPP?** Es lo que pide la nota del enunciado:
"ejecútalo con el servidor propio de PHP (PHP Built-in Web Server). Así lo probamos". El
servidor propio es una cosa que trae PHP ya instalado, arranca con un solo comando y no necesita
configurar nada. XAMPP, en cambio, es Apache, que es un servidor aparte y más pesado.

Ojo con el puerto: XAMPP usa el 80 y el de `php -S` usa el 8000, por eso pueden convivir sin
pisarse. Si el 8000 está ocupado salta un error y hay que probar con otro, por ejemplo
`php -S localhost:8001`.

## Las decisiones que he tomado en cada ejercicio

### Ejercicio 1: la fecha y la hora

El enunciado pide la fecha y la hora del día actual, y pone un ejemplo: `Friday, September 15th
2023` y `Son las 10:18:21`.

**La decisión fue usar `date()` con dos formatos distintos**, porque la fecha y la hora se
escriben con letras diferentes:

```php
date("l, F jS Y")   // la fecha -> Monday, September 28th 2026
date("H:i:s")       // la hora  -> 20:36:00
```

Cada letra es una parte del formato, como si fueran huecos en una plantilla:

| Letra | Qué pone | Ejemplo |
|---|---|---|
| `l` | Nombre del día en texto | Monday |
| `F` | Nombre del mes en texto | September |
| `j` | Día del mes sin ceros delante | 28 |
| `S` | Sufijo del día, para el `1st`, `2nd`, `3rd` | th |
| `Y` | Año con 4 cifras | 2026 |
| `H` | Hora de 00 a 23 | 20 |
| `i` | Minutos | 36 |
| `s` | Segundos | 00 |

El `S` es el que hace que aparezca `28th` en vez de solo `28`. Sin esa letra saldría el día
desnudo, y el ejemplo del enunciado sí lleva el sufijo.

### Ejercicio 2: por qué sale 1,6 y no 1.6

El enunciado muestra el resultado de dividir como `1.6`, con coma. Pero **en PHP el separador de
los decimales es siempre el punto**, y no hay forma de cambiarlo con el idioma, porque el
punto es el que usa PHP por dentro.

Así que lo he hecho en dos pasos:

```php
$divisionRedondeada = round($division, 1);                  // 1.6
$divisionBonita = str_replace(".", ",", $divisionRedondeada); // 1,6
```

Primero `round()` con un segundo parámetro de `1` para que redondee a una sola cifra decimal, que
si no saldría `1.6000000000000001`. Después `str_replace()` cambiando el punto por la coma, que es
la función que ya usaba en el ejercicio 3 para quitar los espacios, pero al revés: allí quité
espacios y aquí cambio un carácter.

Lo mismo hago en el ejercicio 4 con el área y el perímetro del círculo.

### Ejercicio 3: quitar espacios y el lío de la longitud

Para quitar los espacios uso `str_replace()` cambiando un espacio por nada:

```php
$fraseSinEspacios = str_replace(" ", "", $frase);
```

El segundo parámetro es `""`, que es una cadena vacía, o sea, nada. Por eso desaparecen los
espacios.

**Sobre la longitud hay un error en el enunciado.** La foto dice que la frase sin espacios mide
46, pero a mí me sale 45, y creo que el enunciado se equivocó al contar. La frase tiene 11
espacios y 56 - 11 = 45. Lo he dejado en 45, que es lo correcto, y te lo explico en la página
por si el profesor te lo dice.

También he puesto una línea que compara `mb_strlen()` con `strlen()`, para que se vea por qué
uso la primera: `strlen()` daría 57 en vez de 56, por el byte extra de la í de "decidí".

### Ejercicio 4: constantes

El enunciado pide crear una constante con `define()` que sea distinta a la del ejemplo, hacer una
operación con ella y mostrar el entero más grande de PHP.

- `define("PI", 3.141592)` para la constante. A partir de ahí `PI` se usa sin el signo del
  dollar, porque ya no es una variable sino una constante.
- `PHP_INT_MAX` para el entero más grande. Esa es una constante ya creada por PHP, y es de la
  misma familia que las que explica la teoría con `PHP_INT_SIZE` y `PHP_INT_MIN`.
- Para las operaciones uso el radio, que es una variable normal, y multiplico `PI * $radio * $radio`
  para el área y `2 * PI * $radio` para el perímetro.

### Ejercicio 5: por qué hay dos archivos

La nota del enunciado pide este ejercicio en un proyecto aparte y, además, dice dos veces que no
se modifique el código, **solo los valores de las variables**. Eso es imposible en un solo
archivo, porque si cambias el valor pierdes la salida anterior.

Por eso hay dos archivos:

| Archivo | `numFloat` | `variableSinValor` | Para qué sirve |
|---|---|---|---|
| `tiposDeDato.php` | `5.7` | `null` | La salida 1, los valores del enunciado |
| `tiposDeDato2.php` | `12` | un texto | La salida 2, con los valores ya cambiados |

El código es idéntico en los dos, solo cambian las dos líneas de asignación. Eso demuestra
justo lo que pide la nota: que el mismo código da respuestas distintas según el valor.

**Y en la salida 1 pongo `$variableSinValor = null;` en vez de crear la variable vacía.** El
enunciado dice "no le asignes ningún valor", y crear una variable con solo el punto y coma hace
justo eso, pero entonces `is_null()` avisa de que la variable no existe y la página sale con un
error en rojo. Escribiendo `null` a secas es lo mismo por dentro, sin el aviso, que es lo que el
enunciado quiere porque pide que la página valide bien.

## Ejercicio 1: fecha y hora

| Qué | Dónde está en la teoría |
|---|---|
| `date()` para obtener la fecha y la hora del momento | Anexo **4.4.- Fechas** (pág. 54) |
| Los formatos de `date()`: `l`, `F`, `j`, `S`, `Y` para la fecha y `H`, `i`, `s` para la hora | Anexo **4.4.- Fechas**, donde se explica el parámetro `format` |

## Ejercicio 2: dos números

| Qué | Dónde está en la teoría |
|---|---|
| El operador `%` para el resto de una división | Apartado 2.5.2.- *Operadores* (pág. 24) |
| El operador `/` para dividir y el `+` para sumar | Apartado 2.5.2.- *Operadores* |
| `round()` para redondear a una cifra decimal | Anexo **4.1.- Numéricas** (pág. 34) |
| `str_replace()` para cambiar el punto por la coma | Anexo **4.2.- Cadenas** (pág. 36) |

> El enunciado muestra el resultado como `1.6` con coma. En PHP el separador de decimales es el
> punto, así que primero redondeo con `round()` y luego cambio el punto por la coma con
> `str_replace()`.

## Ejercicio 3: quitar espacios

| Qué | Dónde está en la teoría |
|---|---|
| `str_replace(" ", "", $frase)` para quitar los espacios | Anexo **4.2.- Cadenas**, ejemplo `str_replace('manzana', 'naranja', $frase)` |
| `mb_strlen()` para contar los caracteres | Anexo **4.2.- Cadenas**, ejemplo de la longitud "unicode" |
| `strlen()` para comparar y ver la diferencia | Anexo **4.2.- Cadenas**, con el ejemplo de que cuenta bytes |

> Uso `mb_strlen()` y no `strlen()` porque la frase lleva la í de "decidí". Con `strlen()` la
> original daría 57 en vez de 56, porque la í ocupa dos bytes. En la página se ve la comparación.

> **Ojo, una diferencia con el enunciado:** la foto del enunciado pone que la longitud de la frase
> final es 46 y a mí me sale 45. La frase tiene 11 espacios, uno de ellos el del final, así que
> 56 - 11 = 45. Creo que en el enunciado se equivocaron al contar, pero lo he dejado como me sale
> a mí, que es lo correcto.

## Ejercicio 4: constantes

| Qué | Dónde está en la teoría |
|---|---|
| `define("PI", 3.141592)` para crear una constante | Apartado 2.3.4.- *Constantes* (pág. 15) |
| Usar el nombre de la constante sin el signo del dollar | Apartado 2.3.4.- *Constantes* |
| `PHP_INT_MAX`, el entero más grande posible | Apartado 2.3.5.- *Tipos de datos escalares* (pág. 16), con `PHP_INT_SIZE` y `PHP_INT_MIN` al lado |
| `round()` y `str_replace()` para el área y el perímetro | Anexos 4.1. y 4.2. |

## Ejercicio 5: tipos de dato

| Qué | Dónde está en la teoría |
|---|---|
| `is_float()` para comprobar si una variable es float | Anexo **4.3.- De tipos** (pág. 48) |
| `is_null()` para comprobar si una variable es NULL | Anexo **4.3.- De tipos**, y también en el resumen de la pág. 32 |

> En la salida 1 pongo `$variableSinValor = null;` en vez de crear la variable vacía con solo el
> punto y coma. Es lo mismo por dentro, pero así `is_null()` no avisa de que la variable no
> existe, y el enunciado pide que la página no tenga errores.
>
> La salida 2 es una copia exacta de la salida 1 con solo los valores cambiados, que es
> literalmente lo que pide la nota del enunciado: no tocar el código, solo los valores.

## El estilo de las pestañas

El HTML de las pestañas lo copié del ejemplo "Navs and tabs" de la documentación de Bootstrap,
igual que hice en `DWESejerciciosIniciales/index.php`. Lo básico:

- `<ul class="nav nav-tabs">` es la barra de botones de arriba.
- Cada `<button>` lleva `data-bs-toggle="tab"` y `data-bs-target="#panelEjercicioN"`, que es
  el `id` del panel que quiere abrir.
- El primero lleva además la clase `active`, que es el que se ve al abrir la página.
- `<div class="tab-content">` envuelve los `<div class="tab-pane">`, que son los paneles.
- El `<script>` de Bootstrap del final es el que hace que funcionen. Sin él los botones se ven
  pero no cambian de panel.

## Aviso

Los archivos van guardados en UTF-8, que es lo que indica la etiqueta `<meta charset="UTF-8">`.
Si al abrirlos con un editor te salen las tildes raras, es que el editor no está leyendo bien el
archivo, no que esté mal.
