# Teoría UT2 · Lenguaje PHP — Inserción de código en páginas web

**Módulo:** Desarrollo Web en Entorno Servidor (DWES) · 2º DAW
**Curso:** 2026/2027 · **Estado:** material de estudio para el examen del tema 2

Aquí está **toda la teoría disponible del tema 2**, extraída de los apuntes
oficiales y de la guía de repaso del profesor, ordenada por bloques y
**corregida**: donde los apuntes tienen una errata, el capítulo trae el dato
correcto y el detalle está en `11 - Errata de los apuntes.md`.

> Esta carpeta vive dentro del repo `2-DAW`. No se ha hecho `git add` ni
> `commit` de nada.

## Índice

| # | Documento | Qué contiene |
|---|---|---|
| **00** | `00 - Teoria UT2 completa (PDF).pdf` | **Todo el tema en un solo PDF**: portada, índice con números de página y capítulos 01-13 (46 págs., con marcadores) |
| 01 | `01 - Sintaxis y ejecucion.md` | Cómo funciona PHP, bloques `<?php ?>`, comentarios, salida HTML |
| 02 | `02 - Variables y memoria.md` | Identificadores, tipado débil, copia vs `&`, `E_NOTICE`, constantes, ámbito |
| 03 | `03 - Tipos de datos.md` | Escalares, compuestos, tabla de conversión a `FALSE`, casting |
| 04 | `04 - Operadores.md` | Aritméticos, comparación (`==`/`===`), lógicos, `++`/`--`, `??`, precedencia |
| 05 | `05 - Superglobales.md` | `$_GET`, `$_POST`, `$_REQUEST`, `$_SERVER`, `$GLOBALS` y lectura segura |
| 06 | `06 - Comprobar variables y depurar.md` | `isset`, `empty`, `is_*`, `gettype`, `var_dump`, `print_r` |
| 07 | `07 - Funciones de cadenas.md` | `strlen`/`mb_strlen`, `substr`, `trim`, `str_replace`, `strpos`, `strtr`… |
| 08 | `08 - Numericas y fechas.md` | `round`, `floor`, `ceil`, `rand`, `date`, `mktime`, `strtotime`, `checkdate` |
| 09 | `09 - Ejercicios resueltos.md` | Los ejercicios de tus tres entregas, comentados |
| 10 | `10 - Codigo trampa.md` | El reto de depuración de la guía y el `escape_room.php` (con soluciones) |
| 11 | `11 - Errata de los apuntes.md` | Los fallos detectados en los apuntes y su corrección |
| 12 | `12 - Test tipo test (prompt).md` | Prompt básico para generar un test de 40 preguntas en NotebookLM |
| 12b | `12 - Examen final UT2 (prompt).md` | **Prompt completo** para generar un examen final con test, 3 ejercicios prácticos (nivel inicial, intermedio y avanzado) y 1 ejercicio de depuración |
| 13 | `13 - Glosario.md` | Términos del tema y glosario inglés-español |
| — | `fuentes/` | Los PDF originales del profesor, tal cual |

> `00 - Sintesis del tema (PDF).pdf` es la síntesis anterior, más corta: sirve
> para un repaso rápido, pero no lleva las erratas del capítulo 11. Para
> estudiar o imprimir, usa `00 - Teoria UT2 completa (PDF).pdf`.

## Cómo estudiarlo

0. Si prefieres papel, imprime **`00 - Teoria UT2 completa (PDF).pdf`**: lleva
   lo mismo que los capítulos 01-13 seguidos. En el visor del PDF, el panel de
   marcadores (Ctrl+B en Edge/Acrobat) salta a cualquier apartado.
1. **Una pasada rápida** por 01 a 05 (son los cimientos: sintaxis, memoria,
   tipos, operadores, superglobales).
2. **Funciones** (06, 07 y 08) con papel: tapa la salida de cada ejemplo y
   escribe qué crees que imprime.
3. **09 y 10** como simulacro: primero intenta el `escape_room.php` sin mirar,
   y solo después lee el capítulo 10.
4. **12** (`Test tipo test`) para generar un test rápido y detectar puntos flojos.
   **12b** (`Examen final UT2`) para un simulacro completo con ejercicios prácticos y de depuración.
5. **13** para el vocabulario: la guía avisa de que hay preguntas en inglés.
6. Lee **11** antes del examen: son exactamente las trampas donde el material
   del profesor se equivoca.

## Mapa de fuentes

| Material | Ruta original |
|---|---|
| Apuntes oficiales del tema (59 págs.) | `..\UT2_Lenguaje PHP. Insercion de codigo en paginas web.pdf` |
| Guía de repaso del profesor (10 págs.) | `..\Presentación de Repaso - UT2 Lenguaje PHP.pdf` |
| Síntesis (fuente editable, Markdown) | `..\Sintesis examen UT2.md` |
| Entregas resueltas | `..\DWESejerciciosIniciales\`, `..\DWESejerciciosPracticar\`, `..\DWESejerciciosAvanzados\` |
| Simulacro de errores | `..\escape_room.php` |
| Plan de estudio y chuleta | `..\Examen lunes - plan y chuleta.md` |
| Enunciados de los ejercicios | `..\UT2_1- Ejercicios_iniciales (Opcionales).pdf`, `..\UT2_2- ...`, `..\UT2_3- ...` |

## Notas de fiabilidad

- Todo el código de estos capítulos se ha **ejecutado con PHP 8.2.12** (el de tu
  XAMPP) para comprobar las salidas.
- Los apuntes están hechos con **PHP 7.4** (se ve en la captura de la pág. 22).
  Donde el comportamiento cambió en PHP 8, el capítulo lo indica.
- Las salidas con fechas dependen de la zona horaria: en los apuntes se usó
  `Europe/Madrid` y aquí se avisa cuando influye.
