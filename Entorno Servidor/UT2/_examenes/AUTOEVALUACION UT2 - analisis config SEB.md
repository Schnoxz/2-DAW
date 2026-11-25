# Config SEB de la autoevaluación UT2

- **Curso:** Desarrollo web en entorno servidor (2º DAW)
- **Actividad:** `AUTOEVALUACIÓN UT2` — `mod/quiz/view.php?id=445228`
- **Fichero:** `AUTOEVALUACION UT2.seb` (1.046 bytes)
- **Origen:** botón «Descargar configuración» del propio cuestionario
- **Fecha del análisis:** 16/11/2026

> El cuestionario ya está hecho: intento 1 del 19/10/2026, 8,00/40,00 → 2,00/10,00.
> Esto analiza la config, no el examen.

## 1. Qué es el fichero

No es un binario ni un ZIP: es un **plist XML de Apple** (`application/seb`) en texto
plano, con una única `<dict>` de 21 claves. Se abre con el Bloc de notas.

No lleva `<data>`, así que **no está cifrado**, y no hay ni rastro de hashes de
contraseña (`hashedQuitPassword`, `hashedAdminPassword`) ni de sales
(`configKeySalt`, `examKeySalt`). Es la config tal cual la genera Moodle para ese
cuestionario.

## 2. Clave por clave

| Clave | Valor | Qué hace |
|---|---|---|
| `startURL` | `.../mod/quiz/view.php?id=445228` | Página que abre SEB al arrancar: la portada del cuestionario. |
| `sendBrowserExamKey` | `true` | SEB manda en cada petición las cabeceras `X-SafeExamBrowser-RequestHash` / `-ConfigKeyHash`. Es lo que permite a Moodle comprobar que la config no se ha tocado. |
| `browserWindowWebView` | `3` | Política «Prefer Modern»: usa Edge WebView2 (Windows) / WKWebView (macOS-iOS). Motor moderno y con la API JavaScript de SEB disponible. |
| `allowQuit` | `true` | El alumno **puede cerrar SEB** cuando quiera. |
| `quitURLConfirm` | `true` | Antes de cerrar pregunta «¿Seguro?». |
| `showTaskBar` | `true` | Se ve la barra de tareas de Windows. |
| `showReloadButton` | `true` | Botón de recargar visible en la barra de SEB. |
| `browserWindowAllowReload` | `true` | La recarga está permitida (coherente con lo anterior). |
| `showTime` | `true` | Reloj visible. |
| `showInputLanguage` | `true` | Indicador del idioma del teclado (útil para saber si estás en ES o EN). |
| `allowSpellCheck` | `false` | Sin corrector ortográfico: nada de subrayados ni sugerencias. |
| `allowWlan` | `false` | Sin WLAN. En Windows no tiene efecto (la gestiona el sistema); manda en iOS/iPadOS. |
| `audioControlEnabled` | `false` | Sin control de volumen dentro de SEB. |
| `audioMute` | `false` | El audio no está silenciado; una página puede sonar. |
| `browserMediaCaptureCamera` | `false` | Bloquea la cámara para las webs (`getUserMedia`). |
| `browserMediaCaptureMicrophone` | `false` | Bloquea el micrófono. |
| `URLFilterEnable` | `false` | **Filtro de URLs desactivado**: no hay lista blanca de dominios. |
| `URLFilterEnableContentFilter` | `false` | Sin filtro de contenido. |
| `URLFilterRules` | `[]` | Cero reglas: no hay nada que permitir ni bloquear. |
| `examSessionClearCookiesOnStart` | `false` | No borra cookies ni datos de sesión al arrancar. |
| `allowPreferencesWindow` | `false` | No se puede abrir la ventana de preferencias de SEB. |

## 3. Lo que NO trae (y es lo importante)

- **Ni contraseña de salida ni de administración.** Con `allowQuit=true` y sin
  `hashedQuitPassword`, salir de SEB es solo confirmar un diálogo. No es una
  jaula: es un kiosco «de cortesía».
- **Sin `quitURL` ni `restartExamURL`.** Al cerrar no vuelve a Moodle ni fuerza
  un reinicio del intento.
- **Sin `URLFilterRules`.** SEB no limita a qué dominios se puede navegar. Lo
  único que impide teclear una URL es que no hay barra de direcciones; pero los
  enlaces que haya en la página sí se pueden pulsar.
- **Sin `sebServerURL` / `sebMode` distinto de 0.** No está gestionada por SEB
  Server; es una config estática.
- **Sin `allowSwitchToApplications`, `enableAltTab`, `enableEsc`, `enableF1`–`F12`,
  `enablePrintScreen`…** No aparecen, así que SEB aplica sus valores por defecto
  de examen, que son bloquearlos. La barra de tareas se ve, pero no se puede
  cambiar de aplicación.
- **Sin certificados ni proxy.**

## 4. Cómo se protege de verdad

La gracia no está en el fichero, está en el hash. Con `sendBrowserExamKey=true`,
SEB calcula el **Config Key** (SHA-256 de las claves ordenadas) y lo manda junto a
la URL de cada petición. Si alguien abre el `.seb` con el Config Tool, cambia algo
—por ejemplo, pone `allowQuit=false` o añade una regla— y lo guarda, el Config Key
cambia y **Moodle rechaza la petición**. Es decir: la config no está bloqueada,
pero sí es *a prueba de manipulación* mientras el cuestionario tenga activada la
regla de acceso SEB y Moodle tenga guardada la clave.

Con los datos de este fichero, el Config Key sale:

```
747a1f0e03289ad7facaab76537ec6ef96f1ce59c9189412629cd6fd96d4b09e
```

(Recalculado aquí con el método que documenta SEB: plist → JSON ordenado sin
espacios → SHA-256. Sirve para comparar, no se puede leer desde el cliente.)

## 5. Puntos débiles, en la práctica

1. **Se puede salir sin contraseña.** Es el fallo más grande para un examen
   puntuable: cerrar, mirar los apuntes y volver a entrar. En Moodle el intento
   sigue corriendo, pero el alumno ya ha visto lo que quería.
2. **No hay lista blanca de URLs.** Desde la propia página del cuestionario se
   pueden pulsar enlaces del curso (temas, recursos, foros) y navegar dentro de
   SEB. Moodle solo comprueba la cabecera SEB en las páginas del cuestionario.
3. **Las cookies persisten** (`examSessionClearCookiesOnStart=false`). En un
   ordenador compartido, la sesión de Moodle de un alumno puede sobrevivir al
   siguiente arranque de SEB con el mismo usuario de Windows.
4. **La barra de tareas se ve.** Aunque no se pueda cambiar de app, sí se ve qué
   hay abierto y se puede intentar cerrar cosas.
5. **Cámara y micrófono bloqueados.** Si el examen pidiera webcam, no funcionaría;
   aquí no se pide, pero conviene saberlo.

## 6. Lectura práctica

- Es una autoevaluación, no el examen puntuable: la config busca «que no se
  distraiga» más que «que no copie».
- Lo esperado al abrirla: pantalla completa con WebView2, reloj, idioma del
  teclado, botón de recargar, sin corrector, sin cámara ni micro, y salida con
  confirmación.
- Si algún día se usa para nota, lo mínimo sería: `allowQuit=false` con
  `hashedQuitPassword`, `quitURL` al cuestionario y `URLFilterEnable=true` con
  reglas solo para el dominio del centro.
- La descarga correcta es siempre desde el botón del cuestionario: así el
  Config Key coincide con el que espera Moodle. Un `.seb` guardado de otra
  sesión o de otro cuestionario no vale.
