# UT2_1 · Ejercicios iniciales

## De qué va

Son los tres primeros ejercicios de PHP: generar números, escribir caracteres
Unicode y contar letras dentro de una cadena. Todo va en pestañas dentro de un
único `index.php`.

## Qué pide el enunciado

1. Un número al azar que además se pinte con un tamaño también al azar (200 %–800 %).
2. Un emoticono al azar entre los caracteres Unicode 128512 y 128586.
3. Contar cuántas «t» hay en la cadena `This is a test`.

## Paso a paso

### 1 · Número con tamaño aleatorio

Son **dos** valores independientes, así que van dos llamadas a `rand()`:

```php
$numero = rand(1, 1000);
$tamano = rand(200, 800);   // es un porcentaje
echo "<p style='font-size: $tamano%;'>$numero</p>";
```

No se puede deducir el tamaño del número: el enunciado quiere que el número sea
cualquiera y el tamaño también.

La unidad `%` del `font-size` es la clave: 450 % significa cuatro veces y media el
tamaño normal del texto.

### 2 · Emoticono Unicode

```php
$codigo = rand(128512, 128586);
echo "&#$codigo;";
```

El navegador convierte `&#128512;` en el dibujo del emoticono. Si se escribiera el
número sin la entidad, se vería la cifra.

Ojo: el archivo tiene que estar guardado en UTF-8 y la página declarar
`<meta charset="UTF-8">`, o algunos caracteres salen como símbolos raros.

### 3 · Contar las «t»

```php
$texto = "This is a test";
$cuenta = 0;

for ($i = 0; $i < strlen($texto); $i++) {
  if ($texto[$i] === "t") {
    $cuenta++;
  }
}
echo "Hay $cuenta letras t.";
```

Distingue mayúsculas: la «T» de *This* no cuenta. Para contar las dos habría que
comparar con `strtolower($texto[$i])`.

`strlen()` cuenta **bytes**, no caracteres; con texto acentuado da más de lo que
parece. Para eso está `mb_strlen()`.

## El código, pieza a pieza

```
DWESejerciciosIniciales/
└── index.php    las tres pestañas (Bootstrap 5) con el código de cada una
```

## Trampas y dudas

- **`rand()` incluye los extremos.** `rand(1, 1000)` puede dar 1 y 1000.
- **El `%` va en el CSS, no en PHP.** `font-size: 450%` es válido; `450px` no es lo
  mismo.
- **`strlen` cuenta bytes.** Con «camión» devuelve 7, no 6.

## Si me preguntan

- **¿`rand()` o `random_int()`?** `random_int()` es criptográficamente seguro; para
  un ejercicio vale `rand()`, para contraseñas no.
- **¿Por qué el emoticono necesita entidad HTML?** Porque el código del carácter no
  es un carácter imprimible en el código fuente.
- **¿Y si la cadena tiene acentos?** `mb_strlen()` y `mb_substr()` trabajan con
  caracteres en vez de bytes.
