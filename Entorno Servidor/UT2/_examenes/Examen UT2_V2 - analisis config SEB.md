# Examen UT2_V2 — análisis de la config SEB

- **Curso:** Desarrollo web en entorno servidor (2º DAW)
- **Actividad:** `Examen UT2` — anunciada en el módulo como «Examen UT2 - Fecha: 16/11/2026»
- **Cuestionario:** cmid **488264**, **oculto** para el alumnado
- **Fichero previsto:** `Examen UT2_V2 - config prevista.seb` (1.046 bytes)
- **Fecha del análisis:** 16/11/2026

> **Aviso:** este `.seb` **no se ha podido descargar de Moodle**. El cuestionario
> está oculto y Moodle redirige tanto la página como el endpoint de descarga
> (`303 → course/view.php?id=5199`). El fichero que hay en esta carpeta está
> **generado** a partir de la plantilla que usa el profesor en los otros dos
> cuestionarios con SEB del mismo curso. Cuando el examen se publique hay que
> descargar el real y comparar.

## 1. Dónde está el examen

- En la sección UT2 hay un rótulo `EXAMEN:` (cmid 488252) y **debajo no aparece
  nada**: el cuestionario está oculto.
- Probando `mod/quiz/view.php?id=488264` la respuesta es `303` a la portada del
  curso; para un cmid que no es un cuestionario la respuesta es `404`. Es decir,
  **488264 es el cuestionario oculto**.
- No hay ningún otro cuestionario oculto en el curso: se comprobó el rango
  `488257–488340` y solo ese devuelve el 303 de «no visible».
- El rótulo de la portada, `Examen UT2 - Fecha: 16/11/2026` (cmid 488308), es
  solo un aviso de la fecha, no el examen.

## 2. La plantilla del profesor

Los dos cuestionarios con SEB que sí se pueden descargar tienen **la misma
configuración exacta**, solo cambia `startURL`:

| Cuestionario | cmid | `startURL` |
|---|---|---|
| Examen UT1 | 436866 | `.../mod/quiz/view.php?id=436866` |
| AUTOEVALUACIÓN UT2 | 445228 | `.../mod/quiz/view.php?id=445228` |
| Examen UT2_V2 (previsto) | 488264 | `.../mod/quiz/view.php?id=488264` |

Comparadas byte a byte, las dos primeras son idénticas salvo el id. Por eso la
tercera se puede reconstruir con seguridad: es la misma plantilla con
`id=488264`.

## 3. La config, clave por clave

| Clave | Valor | Efecto |
|---|---|---|
| `startURL` | `...?id=488264` | Abre la portada del examen. |
| `sendBrowserExamKey` | `true` | Envía el hash de la config en cada petición. |
| `browserWindowWebView` | `3` | Motor moderno (WebView2 / WKWebView). |
| `allowQuit` | `true` | **Se puede cerrar SEB** con solo confirmar. |
| `quitURLConfirm` | `true` | Pide confirmación antes de cerrar. |
| `showTaskBar` | `true` | Barra de tareas visible. |
| `showReloadButton` + `browserWindowAllowReload` | `true` | Recargar permitido. |
| `showTime` / `showInputLanguage` | `true` | Reloj e idioma del teclado. |
| `allowSpellCheck` | `false` | Sin corrector. |
| `allowWlan` | `false` | Sin WLAN (en Windows no aplica). |
| `audioControlEnabled` / `audioMute` | `false` / `false` | Sin control de volumen; audio activo. |
| `browserMediaCaptureCamera` / `...Microphone` | `false` | Cámara y micrófono bloqueados. |
| `URLFilterEnable` + `URLFilterEnableContentFilter` | `false` | **Sin filtro de URLs.** |
| `URLFilterRules` | `[]` | Cero reglas. |
| `examSessionClearCookiesOnStart` | `false` | Conserva cookies entre arranques. |
| `allowPreferencesWindow` | `false` | No se abren las preferencias. |

Y lo que **no** lleva: contraseña de salida, contraseña de administración,
`quitURL`, `restartExamURL`, `sebServerURL` ni listas blancas.

## 4. Config Key

Calculada con el método de SEB (plist → JSON ordenado → SHA-256):

```
d77ce4f09eb4d1161d87de1ac0aaee5e7c68c10d6be00caa60d22366a622efa8
```

SHA-256 del fichero generado:

```
42186d04f48e5bcd0b6cbf724eaf96637d6f65045a7f6c652e62c9ccbef0c65d
```

Cuando el examen se publique, la descarga real debe dar **el mismo Config Key**
(y el mismo SHA-256). Si no coincide, es que el profesor cambió algún ajuste
para el examen y habrá que rehacer el análisis.

## 5. Qué implica para el examen

- No es una jaula: `allowQuit=true` y sin contraseña. Se puede salir y volver a
  entrar; el intento sigue corriendo en Moodle.
- Sin filtro de URLs: desde la propia página se pueden seguir enlaces del curso.
- La barra de tareas se ve, aunque no se pueda cambiar de aplicación.
- Sin corrector, sin cámara y sin micrófono.
- La integridad la da el hash: si se edita el `.seb`, el Config Key cambia y
  Moodle rechaza la petición.

## 6. Cómo verificarlo cuando esté publicado

1. Abrir el cuestionario y pulsar «Descargar configuración».
2. Comparar con el fichero previsto:
   ```powershell
   Get-FileHash -LiteralPath "Examen UT2_V2 - config prevista.seb" -Algorithm SHA256
   Get-FileHash -LiteralPath "config.seb" -Algorithm SHA256
   ```
3. Si los hashes coinciden, el análisis de este documento vale tal cual.
4. Si no, volver a ejecutar el análisis con el fichero real.
