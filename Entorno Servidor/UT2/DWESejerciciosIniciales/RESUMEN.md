# UT2_1 Ejercicios iniciales - qué he usado y dónde está en la teoría

Los tres ejercicios van en pestañas dentro de `index.php`, como pide el enunciado.
Todo el código usa solo cosas que salen en el PDF de la teoría
`../UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf`.

## Cómo abrirlo con XAMPP

1. Abre el **XAMPP Control Panel** y pulsa **Start** en **Apache**.
2. Escribe esto en el navegador:

   ```
   http://localhost/2-DAW/Entorno%20Servidor/UT2/DWESejerciciosIniciales/
   ```

3. Los tres ejercicios están en la barra de pestañas de arriba. Cambiar de pestaña lo hace el
   JavaScript de Bootstrap, que es la línea `<script>` del final del body.

## Las decisiones que he tomado en cada ejercicio

### Ejercicio 1: número aleatorio con tamaño aleatorio

El enunciado pide dos cosas: un número al azar y, además, que se vea a un tamaño también al
azar entre el 200 % y el 800 %.

**La decisión fue generar dos números aleatorios, con dos llamadas distintas a `rand()`.** No
se puede sacar el tamaño del número, porque son cosas independientes: el enunciado quiere que
el número sea cualquiera y que además el tamaño sea cualquiera. Así que:

- `rand(1, 1000)` para el número. El enunciado no dice entre qué valores, así que le puse un
  rango de 1 a 1000.
- `rand(200, 800)` para el tamaño, que es el rango que sí pide el enunciado.

El tamaño se aplica con `style='font-size: $tamano%;'` dentro de un `<p>`. La idea es que el
número de la derecha sea un porcentaje, así que si `$tamano` vale 450, el HTML queda
`font-size: 450%;` y la letra se escribe cuatro veces y media más grande de lo normal.

### Ejercicio 2: emoticono Unicode

El enunciado pide un emoticono entre los caracteres Unicode 128512 y 128586, y da una pista con
una tabla de la w3schools.

**La decisión fue usar `rand(128512, 128586)`** para elegir el número, y luego escribir ese
número con los códigos de entidad de HTML para que el navegador lo pinte como el dibujo y no
como una cifra.

La parte que más confunde es esta línea:

```php
echo "<p style='font-size: 100px;'>&#$emoticono;</p>";
```

Lo que se ve en pantalla es `😀😃😄` y en el código aparece `&#` + el número + `;`. Esos tres
signos no se escriben a mano juntos, se separan: escribo `&#`, luego `$emoticono` (que la
sustituye PHP por su número, por ejemplo 128512) y luego el `;` de cierre. Al final queda
`&#128512;`, que es el emoticono. La teoría explica esto en el apartado 2.2 de *Sintaxis de PHP*.

Si lo pongo sin el `;` final, el navegador no lo reconoce y sale el texto `&#128512` en vez del
dibujo.

### Ejercicio 3: contar las "t" de "This is a test"

El enunciado da la pista: usar `substr_count($texto, $subcadena)`.

**La decisión de la parte 1** es llamar a `substr_count($frase, "t")`, que cuenta cuántas veces
aparece el texto `"t"` dentro de la frase. Sale un 2, porque están en "test" y en "la" de
"This". La `T` mayúscula de "This" no se cuenta, porque `substr_count()` **distingue mayúsculas
de minúsculas**.

**La decisión de la parte 2** es la que pregunta el enunciado: qué habría que añadir para
contarlas todas. La respuesta es que hay que sumar también la cuenta de la `"T"` mayúscula:

```php
$todas = $minusculas + substr_count($frase, "T");
```

Como las dos cuentas están en variables distintas, el `+` las suma sin tocar el resultado de la
parte 1. Así se ve mejor la respuesta, que es lo que el enunciado pide que se explique.

## Funciones y de dónde sale cada una

| Función o cosa | Qué hace | Dónde está en la teoría |
|---|---|---|
| `rand(desde, hasta)` | Número entero al azar dentro de un rango | Anexo **4.1.- Numéricas** (pág. 34), con el ejemplo `rand(1, 9)` |
| `substr_count($texto, $subcadena)` | Cuenta cuántas veces aparece un texto dentro de otro | Anexo **4.2.- Cadenas** (pág. 36), ejemplo `substr_count($text, 'is')` que cuenta 2 |
| `echo` | Muestra un texto o el valor de una variable | Apartado 2.2.- *Sintaxis de PHP* (pág. 9) |
| El operador `+` para sumar | Suma las dos cuentas de letras | Apartado 2.5.2.- *Operadores* (pág. 24) |
| La interpolación `$variable` dentro de comillas dobles | Escribe el valor de la variable dentro de un texto | Apartado 2.2.- *Sintaxis de PHP*, con las cadenas de texto |

## Sobre el HTML de las pestañas

El enunciado pide pestañas, así que copié el ejemplo "Navs and tabs" de la documentación de
Bootstrap. Lo básico, por si hay que tocarlo:

- `<ul class="nav nav-tabs">` es la barra de botones de arriba.
- Cada `<button>` lleva `data-bs-toggle="tab"` y `data-bs-target="#panelEjercicioN"`, que es el
  `id` del panel que quiere abrir.
- El primero lleva además la clase `active`, que es el que se ve al abrir la página.
- `<div class="tab-content">` envuelve los `<div class="tab-pane">`, que son los paneles.
- El `<script src=".../bootstrap.bundle.min.js">` del final del body es el que hace que funcionen.
  Sin él los botones se ven pero no cambian de panel.

## Sobre las comillas dentro de los `echo`

Como todo el `card-body` es un bloque `<?php ... ?>`, el HTML va dentro de los `echo` y eso obliga
a cuidar las comillas:

```php
echo "<p class='text-secondary small'>Tamaño de la letra: $tamano%</p>";
//   ↑ dobles: cierra el texto de PHP          ↑ simples: atributo de HTML
```

Las comillas de PHP son las **dobles** de fuera, y las de los atributos de HTML son las
**simples** de dentro. Si se pusieran al revés, PHP cerraría el texto en el sitio equivocado y
el código se rompería.

## Avisos

- `rand()` da un número distinto en cada recarga, así que los resultados cambian cada vez que
  se abre la página. Es lo que pide el enunciado.
- El tamaño del texto va entre 200 % y 800 %, así que en pantallas pequeñas el emoticono puede
  salirse. No es un error.
- Los archivos van guardados en UTF-8, que es lo que indica `<meta charset="UTF-8">`. Si al
  abrirlos con un editor te salen las tildes raras, es que el editor no está leyendo bien el
  archivo, no que esté mal.
