# UT2_3 Ejercicio avanzado - qué he usado y dónde está en la teoría

A diferencia de los otros dos ejercicios, este **no va en pestañas**. El enunciado pide una
página principal (`index.php`) con tres botones que abran tres páginas PHP distintas, así que
cada apartado es un archivo aparte.

Todo el código usa solo cosas que salen en el PDF de la teoría
`../UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf`.

## Cómo abrirlo con XAMPP

1. Abre el **XAMPP Control Panel** y pulsa **Start** en **Apache**.
2. Escribe esto en el navegador:

   ```
   http://localhost/2-DAW/Entorno%20Servidor/UT2/DWESejerciciosAvanzados/
   ```

3. Te sale la página principal con los tres botones. Las demás páginas son:

   | Página | Dirección |
   |---|---|
   | Principal | `http://localhost/2-DAW/Entorno%20Servidor/UT2/DWESejerciciosAvanzados/` |
   | Matemáticas | `.../matematicas.php?num1=8&num2=15&num3=3` |
   | Cadenas | `.../cadena.php?cadena1=Paco tiene una carniceria&cadena2=en la esquina de la calle` |
   | Servidor | `.../infoServidor.php` |

**¿Por qué funciona con la ruta del Escritorio?** Porque en `C:\xampp\htdocs` hay un acceso
directo (un *junction*) llamado `2-DAW` que apunta a `C:\Users\javie\Desktop\2-DAW`. Apache
sigue el enlace, así que no hay que copiar nada.

## Las decisiones que he tomado en cada apartado

### index.php: los parámetros van dentro del enlace

El enunciado pide que cada botón pase sus datos por GET. La forma de hacerlo es poner los
parámetros dentro del `href` del propio enlace, separados por `&`:

```html
<a class="btn btn-primary btn-lg"
   href="matematicas.php?num1=8&amp;num2=15&amp;num3=3">Operaciones Matemáticas</a>
```

Después del `?` van los datos. El nombre de cada dato y su valor se separan con `=`, y cada
parámetro con `&`. La parte de la derecha la lee PHP en `$_GET`.

El `&amp;` en vez de `&` es por el validador del W3C: un `&` a secas, el navegador lo interpreta
como el principio de una entidad y se come el parámetro siguiente. Con `&amp;` el HTML es válido.

**Los espacios y las tildes van tal cual, sin codificar.** Al principio los tenía escritos como
`El+ni%C3%B1o+pepe...`, que es la forma codificada, pero es ilegible y se puede liar uno. Lo
probé y el navegador los pone bien solo, así que en el enlace se escribe el texto normal.

Eligí los valores `8`, `15` y `3` para las matemáticas, que dan una suma, un producto y una media
que no salen redondas y se nota que las operaciones funcionan.

### matematicas.php: los números llegan como texto

El dato más importante de este apartado es que **por la URL solo pueden viajar cadenas de
texto**, aunque escribas `8` en el enlace. Cuando llega a PHP, `$_GET['num1']` no es el número 8
sino el texto `"8"`.

Por eso uso `intval()`, que convierte ese texto en el número 8 de verdad. Sin eso, al sumar dos
textos PHP los pegaría en vez de sumarlos.

Para el número más grande y el más pequeño **no hay función en la teoría**, así que los busco a
mano con `if` / `elseif` / `else` comparando con `>` y `<`. El razonamiento es: si el primer
número es mayor que los otros dos, es el mayor; si no, miro si el segundo es mayor que el tercero,
y si no es el tercero.

La media sale como `8.67` con punto y no `8,67` con coma, porque **en PHP el separador decimal
es el punto**, siempre. `round()` redondea pero no cambia el separador.

### cadena.php: qué cadena se reemplaza

Aquí hay que tener claro qué contiene cada cadena, porque el `str_replace()` se aplica a una
concreta:

| Variable | Contiene |
|---|---|
| `cadena1` | `Paco tiene una carniceria` |
| `cadena2` | `en la esquina de la calle` |

Como la palabra **Paco está en la cadena 1**, el `str_replace()` va sobre `$cadena1`:

```php
$reemplazada = str_replace("Paco", "Maria", $cadena1);
```

Da `Maria tiene una carniceria`. Si lo hubiera puesto sobre `$cadena2` no habría encontrado la
palabra y habría devuelto la cadena sin cambiar, que es lo que hace `str_replace()` cuando lo
que busca no está en el texto.

**`str_replace()` no escribe dentro de la cadena.** Devuelve una cadena nueva, y esa es la que
guardo en `$reemplazada`. Por eso arriba sale `Paco tiene una carniceria` (el original, intacto)
y abajo en la tabla sale `Maria tiene una carniceria` (la copia).

Para la concatenación pego las dos cadenas y además `" del barrio"`, para que la frase resulting
tenga sentido:

```php
$concatenada = $cadena1 . " " . $cadena2 . " del barrio";
```

Da `Paco tiene una carniceria en la esquina de la calle del barrio`.

**Uso `mb_strlen()` y `mb_substr()` en vez de `strlen()` y `substr()`.** La diferencia es que las
versiones normales cuentan *bytes*, no letras. Cada letra acentuada ocupa 2 bytes, así que darían
un número más alto y cortarían las frases por la mitad. La teoría explica esto en el anexo 4.2 al
hablar de la codificación interna de caracteres. Aquí las dos cadenas no llevan tildes, así que
salen el mismo número, pero lo dejo así por si se cambian los textos.

### infoServidor.php: la versión de PHP

El enunciado pide el nombre del servidor, el software y la versión de PHP. Los dos primeros salen
de `$_SERVER`, que es la superglobal con la información del servidor, y es exactamente lo que
hace el script de ejemplo de la teoría en el apartado 2.3.7.

Para la versión de PHP tengo dos opciones y elegí la segunda:

| Opción | Problema |
|---|---|
| `phpversion()` | No sale en la teoría |
| `$_SERVER['PHP_VERSION']` | No existe, esa clave no está en `$_SERVER` |
| **`PHP_VERSION`** (la que uso) | Es una constante ya definida por PHP |

Uso la constante `PHP_VERSION`, que es de la misma familia que las que explica la teoría en el
apartado 2.3.5 (`PHP_INT_SIZE`, `PHP_INT_MAX`, `PHP_INT_MIN`). Ojo: se escribe sin el signo del
dollar delante, porque no es una variable.

## Funciones y de dónde sale cada una

| Función o cosa | Qué hace | Dónde está en la teoría |
|---|---|---|
| `$_GET` | Los parámetros que vienen en la URL | Apartado 2.3.7.- *Variables predefinidas* (pág. 21), tabla de superglobales (pág. 22) |
| `intval()` | Convierte texto en número entero | Apartado 2.6.1.- *La más utilizadas* (pág. 32) y anexo 4.3.- *De tipos* (pág. 48) |
| `round($n, 2)` | Redondea a dos decimales | Anexo 4.1.- *Numéricas* (pág. 34) |
| `if` / `elseif` / `else` | Condiciones | Anexo 4.3.- *De tipos* (pág. 48) |
| `+`, `*`, `/` | Sumar, multiplicar y dividir | Apartado 2.5.2.- *Operadores* (pág. 24) |
| `>`, `<` y `&&` | Comparar dos números | Apartado 2.5.2.- *Operadores* |
| El punto `.` | Pegar dos cadenas | Apartado 2.5.2.- *Operadores* |
| `mb_strlen()` | Contar letras | Anexo 4.2.- *Cadenas* (pág. 36), ejemplo de la longitud "unicode" |
| `mb_substr($cadena, -10)` | Los últimos 10 caracteres | Anexo 4.2.- *Cadenas*, ejemplo con `mb_substr($nombr, 0, 1)` |
| `str_replace()` | Cambiar un trozo por otro | Anexo 4.2.- *Cadenas*, ejemplo `str_replace('manzana', 'naranja', $frase)` |
| `$_SERVER['SERVER_NAME']` | Nombre del servidor | Apartado 2.3.7.- *Variables predefinidas* (pág. 21-22) |
| `$_SERVER['SERVER_SOFTWARE']` | Software del servidor | Apartado 2.3.7.- *Variables predefinidas* (pág. 21-22) |
| `PHP_VERSION` | Versión de PHP | Apartado 2.3.5.- *Tipos de datos escalares* (pág. 16) |
| `<?= $variable ?>` | Mete una variable en el HTML | Apartado 2.- *PHP y HTML. Código incrustado* (pág. 3) |

## Lo que no he usado

Estas funciones se me habrían ocurrido primero, pero no salen en el PDF de la teoría:

- `max()` y `min()` → lo he hecho con `if` / `elseif` / `else`.
- `number_format()` → lo he hecho con `round($media, 2)`.
- `htmlspecialchars()` → muestro las cadenas tal cual, como hace la teoría en sus ejemplos.
- `phpversion()` → lo he hecho con la constante `PHP_VERSION`.
- `isset()` → no hace falta, porque siempre se entra a las páginas pulsando los botones del index.

## Avisos

- `mb_strlen()` y `mb_substr()` necesitan la extensión **mbstring**. En XAMPP ya viene activada.
  En el PHP de WinGet no está, y si se prueba ahí salta un error.
- La media sale como `8.67` con punto y no `8,67` con coma, porque en PHP el separador decimal es
  el punto.
- El enunciado dice que `cadena1` debe ser *"una cadena de texto con una sola palabra"*. La
  cadena 1 que tengo es una frase de cinco palabras, porque es lo que hace que la concatenación
  tenga sentido y lo que permite que el `str_replace()` tenga dónde trabajar. Si el profesor lo
  comprueba con lupa, habría que dejar `cadena1` con una sola palabra.
