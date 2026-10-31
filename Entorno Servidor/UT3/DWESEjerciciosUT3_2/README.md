# UT3_2 - Ejercicios de arrays

Proyecto de la **Entrega UT3_2 - Arrays** (Desarrollo web en entorno servidor, 2º DAW).
Fecha límite en Moodle: **31/10/2026, 12:23**.

## Estructura

```
DWESEjerciciosUT3_2/
├── index.php                  <- única página con las 8 pestañas (Bootstrap 5)
├── ejercicios/
│   ├── auxiliar.php           <- funciones propias para pintar arrays
│   ├── ejercicio1.php         <- 10 aleatorios 1-30
│   ├── ejercicio2.php         <- media, 3 máximos, 3 mínimos, copia ordenada, borrar 2º
│   ├── ejercicio3.php         <- array multidimensional países -> ciudades
│   ├── ejercicio4.php         <- asort / ksort / arsort / krsort
│   ├── ejercicio5.php         <- capitales ordenadas por clave y en mayúsculas
│   ├── ejercicio6.php         <- json_encode() del array anterior
│   ├── ejercicio7.php         <- OBLIGATORIO: 50 aleatorios y sustituir < 5 por "suspenso"
│   └── ejercicio8.php         <- OBLIGATORIO: suma de pares e impares en tabla
└── README.md
```

## Cómo probarlo

Con el servidor embebido de PHP, desde esta carpeta:

```bash
php -S localhost:8000
```

Y abrir <http://localhost:8000/index.php>. También funciona copiando la carpeta
dentro de `htdocs` de XAMPP.

## Relación con la teoría de la UT3

| Ejercicio | Punto de la teoría (`UT3_Estructuras de control, arrays y formularios.pdf`) |
|---|---|
| 1 | 3. Arrays: declaración con `[]`, claves automáticas, `foreach` |
| 2 | 3. Arrays + 4.1 funciones predefinidas (`array_sum`, `count`, `sort`, `rsort`, `array_slice`, `array_splice`) |
| 3 | 3. Arrays: array asociativo con valores que son arrays (multidimensional) |
| 4 | 3. Arrays: ordenación con `asort`, `ksort`, `arsort`, `krsort` |
| 5 | 3. Arrays (`ksort`) + 4.2 funciones propias (recorrido con `foreach` y `strtoupper`) |
| 6 | `json_encode()`; un array asociativo se serializa como objeto JSON |
| 7 | 3. Arrays: **`foreach` por referencia** (`&$valor`) para modificar el array |
| 8 | 2. Estructuras de control (`for`, `if/else`, operador `%`) + 3. Arrays |

## Decisiones de implementación

- **Una sola página `index.php`** con pestañas de Bootstrap, tal y como pide el
  enunciado. Cada pestaña incluye su archivo con `include`, de modo que el HTML
  de la página queda legible y el ejercicio se puede leer por separado.
- **Todo el CSS es Bootstrap 5 por CDN**: no hay hoja de estilos propia ni
  estilos en línea. Solo se usan clases (`container`, `card`, `table`,
  `badge`, `row`, `col-md-6`, `table-responsive`...).
- **Funciones propias** (`mostrarArray`, `mostrarAsociativo`) en `auxiliar.php`
  para no repetir el mismo `foreach` en varios ejercicios. La librería se carga
  una sola vez desde `index.php` con `require_once 'ejercicios/auxiliar.php';`,
  igual que en el ejemplo de `include`/`require` de la teoría.
- **`htmlspecialchars()` solo donde hace falta**: los datos de estos ejercicios
  están escritos en el propio código, no llegan del usuario. Se escapa la salida
  cuando el valor viene de fuera (un formulario), como en la UT3_1.
- **`foreach` con referencia** en el ejercicio 7: es el caso que explica la
  teoría (página 24: "si se pretende modificar el contenido del array al
  recorrerlo con `foreach`, hay que utilizar una referencia").
- **`array_splice()`** en el ejercicio 2 para borrar el segundo elemento y
  reindexar; con `unset()` quedarían huecos en las claves.
- El ejercicio 8 usa **solo arrays y estructuras de control**; Bootstrap se
  emplea únicamente para dar formato a la tabla.

## Entrega (completada el 30/10/2026)

- [x] Capturas de pantalla de cada pestaña → `capturas/01-ejercicio1.png` …
      `capturas/08-ejercicio8.png` (PHP 8.2.12 + Chromium, 1200 px).
- [x] Validación en <https://validator.w3.org/> (servicio Nu): **0 errores y
      0 avisos**. Evidencia en `validacion-w3c.json` y en
      `capturas/09-validacion-w3c.png`.
- [x] Memoria exportada a PDF → `Entrega_UT3_2_JimenezAlonsoJavier.pdf`
      (fuente: `ENTREGA_UT3_2.md`). Un apartado por página: cada `#` de la
      memoria va precedido de `<div class="pagebreak"></div>` y ese salto lo
      aplica el CSS de `.moodle/md2pdf.mjs`.

### Cómo se generó

```powershell
# 1. Servir el proyecto con PHP (XAMPP)
C:\xampp\php\php.exe -S 127.0.0.1:8130 -t .

# 2. Validar el HTML generado contra el W3C
#    POST https://validator.w3.org/nu/?out=json  (Content-Type: text/html)
#    -> {"version":"26.10.18","messages":[],"language":"es"}

# 3. PDF de la memoria (desde esta carpeta)
node ..\..\..\..\.moodle\md2pdf.mjs ENTREGA_UT3_2.md Entrega_UT3_2_JimenezAlonsoJavier.pdf "Entrega UT3_2 - Ejercicios de arrays"
```

