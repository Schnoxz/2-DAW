# 02 · Variables y memoria

> Apuntes §2.3 a §2.3.6 (págs. 10-21) · Guía de repaso §02 y §03 (pág. 2-3).

## 1. Las variables no se declaran: se crean

PHP es un lenguaje **no fuertemente tipado** (**tipado débil**). No se indica el
tipo al crear la variable: se crea **la primera vez que se le asigna un valor**,
y el tipo depende de ese valor.

```php
$entero = 4;        // integer
$precio = "cien";   // ahora es string (el tipo puede cambiar)
```

Reglas de los identificadores:

- Siempre empiezan por **`$`**.
- Después, **una letra o un guion bajo `_`**. Nunca un número: `$5alumnos` es
  **error de sintaxis**.
- El resto puede llevar letras, números y `_`.

Para saber el tipo: `gettype($variable)` devuelve `"integer"`, `"string"`,
`"boolean"`, `"double"` (float), `"array"`, `"NULL"`…

## 2. Asignación por copia y por referencia

| Asignación | Qué pasa en memoria | Ejemplo |
|---|---|---|
| `$b = $a;` (**copia**) | Se reserva una **dirección nueva** y se copia el valor. Son cajas independientes | `$a = 10; $b = $a; $b = 20;` → `$a` sigue valiendo **10** |
| `$b = &$a;` (**referencia**) | `$b` apunta a la **misma dirección** que `$a`: dos nombres para el mismo dato | `$a = 4; $b = &$a; $a = 6;` → `$b` vale **6** |

El `&` se pone **en la variable que recibe** (a la derecha del `=`).

Ejemplo completo (el de los apuntes, con su salida real):

```php
<?php
  $var1 = 100;
  $var2 = &$var1;   // referencia: comparten memoria
  $var3 = $var1;    // copia: independiente

  echo "Var1 $var1<br>";   // Var1 100
  echo "Var2 $var2<br>";   // Var2 100

  $var2 = 300;      // cambia también $var1
  echo "Var1 $var1<br>";   // Var1 300

  $var3 = 400;      // no afecta a $var1
  echo $var1;              // 300
?>
```

## 3. Variables no inicializadas

Si se usa una variable antes de asignarle valor, PHP:

1. Emite un **aviso** (no interrumpe el script).
2. Toma el **valor por defecto del contexto**: `0` en operaciones numéricas,
   `""` en cadenas, `FALSE` en condiciones.
3. Sigue ejecutando.

```php
$total = 50 + $noDefinida;   // aviso; $noDefinida vale 0 -> $total = 50
```

**Nivel de error — ojo, aquí los apuntes están desactualizados:**

| Versión de PHP | Qué sale |
|---|---|
| PHP 7.x (con la que se hicieron los apuntes) | `Notice: Undefined variable` (**E_NOTICE**) |
| **PHP 8.x (tu XAMPP)** | `Warning: Undefined variable` (**E_WARNING**) |

De cara al examen, contesta **`E_NOTICE`** (es lo que dice el tema), pero sabe
que en PHP 8 el mensaje real es un *Warning*.

## 4. Constantes

```php
define("LIMITE", 1000);
echo LIMITE;            // 1000
```

- Se definen con `define("NOMBRE", valor)`.
- El nombre va **sin `$`** y **entre comillas**; por convención, **en
  mayúsculas**.
- Su valor **no puede modificarse** después.
- Hay constantes predefinidas del lenguaje: `PHP_VERSION`, `PHP_INT_MAX`,
  `PHP_EOL`…

## 5. Ámbito de las variables

El **ámbito** es la parte del código donde la variable es visible.

- Una variable declarada en un fichero está disponible **en ese fichero y en
  los que este incluya** (`include`/`require`).
- Cada **función crea un ámbito local cerrado**: dentro solo se ven las
  variables locales y los argumentos. Desde una función **no** se ve lo global.
- Para usar una global dentro de una función hay dos opciones:

```php
$contador = 0;

function sumar() {
  global $contador;      // opción 1: palabra reservada global
  $contador++;
}

function sumar2() {
  $GLOBALS['contador']++; // opción 2: array $GLOBALS
}
```

> **Corrección:** es **`$GLOBALS`**, sin guion bajo. En los apuntes (pág. 21)
> aparece escrito `$_GLOBALS`, que **no existe**; la propia tabla de la pág. 22
> lo escribe bien.

## 6. Resumen de memoria (para el test)

- `$b = $a` → copia → cambiar `$b` **no** cambia `$a`.
- `$b = &$a` → referencia → cambiar cualquiera cambia las dos.
- Sin inicializar → aviso y valor neutro (`0`, `""`, `FALSE`), el script sigue.
- Dentro de una función no se ve lo global salvo con `global` o `$GLOBALS`.
