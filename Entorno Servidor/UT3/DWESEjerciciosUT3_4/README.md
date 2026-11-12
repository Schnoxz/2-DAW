# UT3_4 - Ejercicios de formularios

Proyecto de la **Entrega UT3_4 - Formularios** (Desarrollo web en entorno
servidor, 2º DAW).
Fecha límite en Moodle: **21/11/2026**.

## Estructura

```
DWESEjerciciosUT3_4/
├── index.php                       <- única página con las 3 pestañas (Bootstrap 5)
├── css/
│   └── estilos.css                 <- logotipo, miniaturas y modelos de cabecera
├── ejercicio1/                     <- EJERCICIO 1 (opcional): cálculo del salario
│   ├── index.php                   <- formulario nombre, apellidos, salario y edad
│   └── salario.php                 <- calcula la subida y muestra el salario nuevo
├── ejercicio2/                     <- EJERCICIO 2 (obligatorio): viviendas
│   ├── index.php                   <- formulario de alta de una vivienda
│   └── insertarVivienda.php        <- valida y muestra el resumen de los datos
├── ejercicio3/                     <- EJERCICIO 3 (reto): alquiler de viviendas
│   ├── index.php                   <- formulario de alta de la vivienda
│   ├── fotos.php                   <- galería para elegir la foto
│   ├── gestionarViviendas.php      <- listado, orden, filtro, modificar y borrar
│   ├── funciones.php               <- funciones y datos comunes (y sesión)
│   ├── cabecera1.php               <- cabecera de la hora par
│   ├── cabecera2.php               <- cabecera de la hora impar
│   ├── footer1.php                 <- pie de la hora par
│   ├── footer2.php                 <- pie de la hora impar
│   └── img/                        <- logotipo y 6 fotos de ejemplo (SVG)
├── capturas/                       <- capturas de cada estado y de la validación
├── validacion-w3c-*.json           <- resultados del validador Nu de W3C
├── ENTREGA_UT3_4.md                <- memoria de la entrega
├── Entrega_UT3_4_JimenezAlonsoJavier.pdf
└── README.md
```

## Cómo probarlo

Con el servidor embebido de PHP, desde esta carpeta:

```bash
php -S localhost:8000
```

Y abrir <http://localhost:8000/index.php>. Cada ejercicio también se puede abrir
directamente:

- <http://localhost:8000/ejercicio1/index.php>
- <http://localhost:8000/ejercicio2/index.php>
- <http://localhost:8000/ejercicio3/index.php>

Funciona igual copiando la carpeta dentro de `htdocs` de XAMPP, sin base de
datos ni ninguna otra instalación.

## Relación con la teoría de la UT3

| Ejercicio | Punto de la teoría (`UT3_Estructuras de control, arrays y formularios.pdf`) |
|---|---|
| 1 | 6. Formularios: `method="post"`, atributo `name` y array superglobal `$_POST` |
| 1 | Estructuras de control: `if/elseif`, comparaciones y cálculo de porcentajes |
| 1 | `header('Location: ...')` para volver al formulario cuando faltan datos |
| 2 | 6.1 Formulario HTML y 6.2 procesamiento en un fichero aparte |
| 2 | 6.3 Campos de formulario: `select`, `checkbox` con `name="extras[]"` y `textarea` |
| 2 | Arrays: recorrido con `foreach`, `implode()` y `in_array()` |
| 3 | 6.2 Formulario y procesamiento en un solo fichero (`index.php`) |
| 3 | `include`/`require` para la cabecera, el pie y la librería de funciones |
| 3 | Arrays: listado con `foreach`, orden con el método de la burbuja y filtros |
| 3 | `$_GET` para ordenar, filtrar y elegir la foto; `$_POST` para guardar y borrar |

## Decisiones de implementación

- **Una sola página `index.php` con pestañas de Bootstrap 5**, igual que en
  UT3_1 y UT3_3. Los tres ejercicios son aplicaciones completas (cada una tiene
  su formulario y su página de respuesta), así que no se pueden pegar dentro de
  una pestaña: la pestaña los muestra con un `iframe` y deja un botón para
  abrirlos en otra pestaña.
- **Cada ejercicio tiene su propia carpeta** para que no se mezclen los
  archivos: el enunciado pide expresamente `index.php` e `insertarVivienda.php`
  en el ejercicio 2, y `fotos.php` y `gestionarViviendas.php` en el ejercicio 3.
- **Sin JavaScript propio**: el enunciado lo prohíbe en los ejercicios 1 y 2.
  El único JavaScript que se carga es el de Bootstrap, y solo en el `index.php`
  principal, porque es el que hace funcionar las pestañas. Las páginas de los
  ejercicios no lo necesitan.
- **La validación se hace siempre en PHP**, no con `required` en el HTML. Los
  campos del ejercicio 1 no llevan `required` a propósito: el enunciado pide
  que sea `salario.php` el que detecte que faltan datos y vuelva al formulario.
- **Las viviendas del ejercicio 3 se guardan en `$_SESSION`**. El enunciado
  prohíbe todavía usar una base de datos, pero el listado tiene que sobrevivir
  a los cambios de página, y una variable normal se perdería en cada petición.
  La sesión es el mecanismo que mantiene el array entre páginas.
  La teoría de la UT3 no explica las sesiones: se usa `session_start()` y
  `$_SESSION` como una superglobal más, igual que `$_POST` y `$_GET`, y por eso
  está comentado en `funciones.php`. La alternativa habría sido ir pasando todas
  las viviendas en campos ocultos, que es mucho más frágil.
- **`session_start()` se llama en `funciones.php`** y no en cada página, para
  que se ejecute siempre antes de escribir HTML. Si se llamara después de un
  `echo`, PHP daría el aviso de que las cabeceras ya se han enviado.
- **Las acciones que cambian datos se procesan antes del HTML y terminan con
  `header('Location: ...')` y `exit`**. Así, al recargar la página no se repite
  el borrado ni se guarda dos veces la misma vivienda.
- **El borrado va en un formulario POST, no en un enlace**: un enlace GET se
  puede lanzar sin querer (o desde otra página) y borraría una vivienda.
- **La cabecera y el pie se eligen con `date('H') % 2 == 0`**: la hora actual
  (de 0 a 23) es par o impar, y con esa misma comprobación se cargan
  `cabecera1.php`/`footer1.php` o `cabecera2.php`/`footer2.php`. La función
  `hora_par()` está en `funciones.php` para no repetir la condición en las tres
  páginas.
- **El formulario guarda un borrador en la sesión antes de ir a `fotos.php`**.
  Al elegir la foto se recuperan todos los datos escritos y se vuelve al
  formulario; sin ese borrador, cambiar de página perdería lo que el usuario ya
  había rellenado.
- **Las fotos y el logotipo son SVG propios** (dibujos sencillos hechos a mano).
  El enunciado pide «las fotos disponibles de la vivienda» y un logotipo: no
  hacen falta imágenes externas ni con derechos de autor.
- **`htmlspecialchars()` al imprimir datos del usuario** evita que un `<` o una
  comilla rompan el HTML o se interpreten como etiquetas.
- **Comentarios de función con parámetros y valor devuelto, sin `/** */`**: cada
  `function` lleva encima tres líneas `//` con su nombre, sus parámetros y lo que
  devuelve (o «no devuelve nada»), como en las entregas anteriores.

## Entrega

- [x] Los tres ejercicios resueltos y probados.
- [x] Capturas de cada estado → `capturas/01-…` a `capturas/13-…`.
- [x] Validación en <https://validator.w3.org/> (servicio Nu): **0 errores y
      0 avisos** en el `index.php` principal y en las páginas de los tres
      ejercicios. Evidencia en `validacion-w3c-*.json` y en
      `capturas/14-validacion-w3c.png` y `capturas/15-validacion-ejercicio3.png`.
- [x] Memoria exportada a PDF → `Entrega_UT3_4_JimenezAlonsoJavier.pdf`
      (fuente: `ENTREGA_UT3_4.md`).

### Cómo se generó

```powershell
# 1. Servir el proyecto con PHP (XAMPP) y comprobar que no sale ningún aviso
C:\xampp\php\php.exe -d display_errors=1 -d error_reporting=E_ALL -S 127.0.0.1:8136 -t .

# 2. Capturas y validación contra el W3C (Playwright, desde la raíz del repo)
node .moodle\shots-ut3_4.mjs http://127.0.0.1:8136 "2-DAW\Entorno Servidor\UT3\DWESEjerciciosUT3_4\capturas"

# 3. PDF de la memoria (desde esta carpeta)
node ..\..\..\..\.moodle\md2pdf.mjs ENTREGA_UT3_4.md Entrega_UT3_4_JimenezAlonsoJavier.pdf "Entrega UT3_4 - Ejercicios de formularios"

# 4. ZIP: se crea desde la carpeta padre para que no se incluya a sí mismo
Compress-Archive -Path DWESEjerciciosUT3_4 -DestinationPath D:\Temp\opencode\UT3_4.zip -Force
Move-Item D:\Temp\opencode\UT3_4.zip .\DWESEjerciciosUT3_4_JimenezAlonsoJavier.zip -Force
```

El nombre del comprimido que pide el enunciado es
`DWESEjerciciosUT3_4_ApellidosNombre.rar` (o `.zip`); aquí se entrega como
`DWESEjerciciosUT3_4_JimenezAlonsoJavier.zip`.
