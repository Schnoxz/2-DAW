# UT3_3 - Ejercicios de funciones y excepciones

Proyecto de la **Entrega UT3_3 - Funciones y excepciones** (Desarrollo web en
entorno servidor, 2º DAW).
Fecha límite en Moodle: **14/11/2026, 11:23**.

## Estructura

```
DWESEjerciciosUT3_3/
├── index.php                       <- única página con las 9 pestañas (Bootstrap 5)
├── ejercicios/
│   ├── funciones.php               <- todas las funciones de la relación
│   ├── ejercicio1.php              <- 5 números: suma, división ($tmp) y volumen
│   ├── ejercicio2.php              <- inicializar_array + mostrar_array
│   ├── ejercicio3.php              <- calcular_media
│   ├── ejercicio4.php              <- calcular_maximo
│   ├── ejercicio5.php              <- calcular_minimo
│   ├── ejercicio6.php              <- imprimir_array en tabla
│   ├── ejercicio7.php              <- OBLIGATORIO: UT3_2 resuelto con funciones
│   ├── ejercicio8.php              <- OBLIGATORIO: pestaña que muestra la web del ejercicio 8
│   └── ejercicio9.php              <- OBLIGATORIO: try/catch de las tres funciones
├── ejercicio8/                     <- la web completa del ejercicio 8
│   ├── index.php                   <- elige el tema y pinta el contenido
│   ├── header.php                  <- cabecera con los dos enlaces de tema
│   ├── footer.php                  <- pie de página (el archivo que nos dan)
│   └── css/
│       ├── temaClaro.css           <- hoja del tema claro (la que nos dan)
│       ├── temaOscuro.css          <- hoja del tema oscuro (la que nos dan)
│       └── estilosComunes.css      <- cabecera y enlaces, iguales en los dos temas
├── capturas/                       <- capturas de cada pestaña y de la validación
├── validacion-w3c.json             <- resultado del validador para index.php
├── validacion-w3c-ejercicio8.json  <- resultado del validador para la web del ejercicio 8
├── ENTREGA_UT3_3.md                <- memoria de la entrega
├── Entrega_UT3_3_JimenezAlonsoJavier.pdf
└── README.md
```

## Cómo probarlo

Con el servidor embebido de PHP, desde esta carpeta:

```bash
php -S localhost:8000
```

Y abrir <http://localhost:8000/index.php>. La web del ejercicio 8 está en
<http://localhost:8000/ejercicio8/index.php> y también se ve dentro de su
pestaña. Funciona igual copiando la carpeta dentro de `htdocs` de XAMPP.

El ejercicio 8 no necesita nada más: el tema se cambia con los enlaces
`index.php?tema=claro` e `index.php?tema=oscuro`.

## Relación con la teoría de la UT3

| Ejercicio | Punto de la teoría (`UT3_Estructuras de control, arrays y formularios.pdf`) |
|---|---|
| 1 | 4. Funciones y librerías: parámetros, valor devuelto y funciones sin `return` |
| 1b | 5. Excepciones: `throw`, `try` y `catch` |
| 2-6 | 4.2 Funciones propias: parámetros, valor por defecto y `return` |
| 7 | 4.2 Funciones propias + `require_once` de una librería (`funciones.php`) |
| 7 | 3. Arrays: `foreach`, `array_sum`, `count`, `sort`, `rsort`, `array_slice` |
| 8 | `include`/`require` de `header.php` y `footer.php` + paso de datos por la URL (`$_GET`) |
| 9 | 5.3 Excepciones: lanzar y capturar errores con mensajes propios |

## Decisiones de implementación

- **Una sola página `index.php`** en la raíz, con pestañas de Bootstrap 5, igual
  que en la UT3_1. Cada pestaña incluye su archivo de `ejercicios/` con
  `include`, así el código de cada ejercicio se lee por separado.
- **`funciones.php` es la librería de la relación** y se carga una sola vez
  desde `index.php` con `require_once 'ejercicios/funciones.php';`. Además de
  las funciones de los ejercicios 1 a 7 guarda las tres del ejercicio 9
  (`sumar`, `dividir`, `calcularAreaTriangulo`), porque también son funciones
  propias y así no se repiten. El enunciado solo pide meter allí las anteriores,
  pero separarlas obligaría a tener dos archivos de librería sin necesidad.
- **Comentarios de función con parámetros y valor devuelto, sin `/** */`**: el
  enunciado pide indicar los parámetros y qué devuelve cada función. Cada
  `function` lleva encima tres líneas `//` con su nombre, sus parámetros y lo que
  devuelve (o «no devuelve nada»), sin `@param` ni `@return`.
- **`$tmp` en el ejercicio 1b**: se asigna el resultado de la función a `$tmp`
  tal y como pide el enunciado y se muestra redondeado a dos decimales, porque
  una división puede dar una tira larga de cifras.
- **Excepciones del ejercicio 1b**: `dividirDosDeCinco()` lanza una excepción si
  el divisor es 0 y la llamada va dentro de `try/catch`. Con números aleatorios
  entre 0 y 9 el caso del cero aparece de vez en cuando, así que la captura
  puede mostrar el resultado o el aviso de error; las dos cosas son correctas.
- **El ejercicio 7 usa las funciones de `funciones.php`** en lugar de repetir el
  código: `inicializar_array()`, `mostrar_array()`, `calcular_media()`,
  `calcular_maximo()`, `calcular_minimo()` e `imprimir_array()`. Para los tres
  mayores y los tres menores se añaden `tresMayores()` y `tresMenores()`, que
  copian el array antes de ordenarlo porque `sort()` y `rsort()` lo modifican.
- **El ejercicio 8 vive en su propia carpeta** porque es una página completa:
  tiene su `<!DOCTYPE html>`, su `<head>`, su `header` y su `footer`. La pestaña
  `ejercicio8.php` solo lo muestra con un `iframe` y un botón para abrirlo en
  otra pestaña. El tema se decide en `ejercicio8/index.php` leyendo `$_GET['tema']`:
  solo se acepta el valor `oscuro`; cualquier otra cosa deja el tema claro.
- **El `h1` del `footer.php` original se ha cambiado por un `<p>`**: la página
  debe tener un solo `h1`, y ahora es el título de la cabecera. El aspecto no
  cambia porque el tamaño y la fuente los sigue dando la clase `footer__logo`.
- **La línea «Hecho ♥ remotamente por 2ª DAW» del pie se ha quitado**: venía en
  el `footer.php` que nos dieron y no aporta nada a la web, así que el bloque
  `legal` se queda solo con el aviso de copyright.
- **`estilosComunes.css` es la única hoja propia**: las dos hojas que nos dan
  solo estilan `body` y `.footer`, así que la cabecera y los enlaces del
  contenido se quedarían sin estilo (y en el tema oscuro saldrían en azul
  oscuro sobre negro). Allí solo hay cabecera, enlaces y márgenes; los colores
  de cada tema siguen en `temaClaro.css` y `temaOscuro.css`.

## Entrega (completada el 05/11/2026, regenerada el 07/11/2026)

- [x] Capturas de cada pestaña → `capturas/01-ejercicio1.png` …
      `capturas/09-ejercicio9.png`.
- [x] Capturas de la web del ejercicio 8 en los dos temas →
      `capturas/08b-ejercicio8-claro.png` y `08b-ejercicio8-oscuro.png`.
- [x] Validación en <https://validator.w3.org/> (servicio Nu): **0 errores y
      0 avisos** en `index.php` y en `ejercicio8/index.php`. Evidencia en
      `validacion-w3c.json`, `validacion-w3c-ejercicio8.json` y en
      `capturas/09-validacion-w3c.png` y `capturas/10-validacion-ejercicio8.png`.
- [x] Memoria exportada a PDF → `Entrega_UT3_3_JimenezAlonsoJavier.pdf`
      (fuente: `ENTREGA_UT3_3.md`).

### Cómo se generó

```powershell
# 1. Servir el proyecto con PHP (XAMPP) y comprobar que no sale ningún aviso
C:\xampp\php\php.exe -d display_errors=1 -d error_reporting=E_ALL -S 127.0.0.1:8134 -t .

# 2. Capturas y validación contra el W3C (Playwright, desde la raíz del repo)
node .moodle\shots-ut3_3.mjs http://127.0.0.1:8134 "2-DAW\Entorno Servidor\UT3\DWESEjerciciosUT3_3\capturas"

# 3. PDF de la memoria (desde esta carpeta)
node ..\..\..\..\.moodle\md2pdf.mjs ENTREGA_UT3_3.md Entrega_UT3_3_JimenezAlonsoJavier.pdf "Entrega UT3_3 - Ejercicios de funciones y excepciones"

# 4. ZIP: se crea desde la carpeta padre para que no se incluya a sí mismo
Compress-Archive -Path DWESEjerciciosUT3_3 -DestinationPath D:\Temp\opencode\UT3_3.zip -Force
Move-Item D:\Temp\opencode\UT3_3.zip .\DWESEjerciciosUT3_3_JimenezAlonsoJavier.zip -Force
```

El nombre del comprimido que pide el enunciado es
`DWESEjerciciosUT3_3_ApellidosNombre.rar` (o `.zip`); aquí se entrega como
`DWESEjerciciosUT3_3_JimenezAlonsoJavier.zip`.
