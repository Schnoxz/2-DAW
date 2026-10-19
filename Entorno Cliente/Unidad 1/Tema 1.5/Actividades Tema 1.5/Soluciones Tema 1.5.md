# Soluciones Tema 1.5 — Verificación de los mecanismos de integración de lenguajes de marcas con lenguajes de programación de cliente Web

> Materia: Desarrollo Web en Entorno Cliente (2º DAW)
> Tema: 1.5. Verificación de los mecanismos de integración de JavaScript con HTML

---

## 1. Análisis de los ejercicios de referencia (1.1, 1.2, 1.4)

Tras analizar los ejercicios realizados en las carpetas **1.1**, **1.2** y **1.4**, se aprecia un patrón común que se ha mantenido en estas soluciones:

### Estilo observado

- **Estructura clara y ordenada.** Cada ejercicio se presenta con título, enunciado, solución y concepto clave (siguiendo el formato de 1.2).
- **Código básico, claro y efectivo.** Se prioriza la legibilidad frente a complejidad innecesaria (ejercicios de 1.2 con HTML+JS mínimo y funcional).
- **Separación de responsabilidades.** En 1.1 y 1.4 se aprecia el uso de HTML bien estructurado, con comentarios breves cuando aporta valor.
- **Uso de buenas prácticas.** En 1.4 se trabaja con funciones, `addEventListener` en lugar de atributos `onclick` y separación lógica (estilo moderno).
- **Explicación concisa.** Cada solución va acompañada de una breve explicación conceptual (tabla comparativa en 1.4 Ej.5, listado de ventajas en Ej.6).

### Conclusión para Tema 1.5

Siguiendo ese estilo, las soluciones de Tema 1.5 son **básicas, claras y efectivas**: se enfocan en demostrar los mecanismos de integración (embebido vs externo), la ubicación del `<script>` y la organización profesional con carpetas separadas (HTML, CSS, JS).

---

## 2. Estructura de archivos

```
Actividades Tema 1.5/
├── Ejercicio 1/
│   ├── index.html        → Enlace a script.js externo
│   └── script.js         → Lógica con alert("hola")
├── Ejercicio 2/
│   └── index.html        → Código JavaScript embebido
├── mi_proyecto/
│   ├── css/
│   │   └── estilos.css   → Estilos separados
│   ├── js/
│   │   └── logica.js     → Lógica separada
│   └── index.html        → Estructura principal
├── practica_laboratorio/
│   ├── css/
│   │   └── estilos.css   → Estilos separados
│   ├── js/
│   │   └── logica.js     → Lógica separada
│   └── index.html        → Estructura con ruta relativa ./js/logica.js
└── Soluciones Tema 1.5.md → Este documento
```

---

## 3. Ejercicio 1 — Ficheros separados (recomendado)

**Enunciado:** Crear un archivo llamado `index.html` y otro llamado `script.js` en la misma carpeta utilizando el código de ficheros separados. Abrirlo con el navegador y comprobar que se muestra el cuadro de alerta con el texto `"hola"` al cargarse la página.

### index.html

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Fichero externo</title>
    <script src="script.js"></script>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <p>Fichero JavaScript externo (script.js).</p>
</body>
</html>
```

### script.js

```js
// Ejercicio 1: Fichero JavaScript externo separado
function diAlgo() {
    alert("hola");
}

diAlgo();
```

**Concepto clave:** Separar HTML (estructura) y JS (comportamiento). El navegador descarga y ejecuta `script.js` al encontrar la etiqueta `<script src="...">`. Esto permite reutilizar código, aprovechar caché y facilita el mantenimiento.

---

## 4. Ejercicio 2 — Código embebido

**Enunciado:** Crear el archivo `index.html` con código embebido. Observar cómo se interrumpe la carga para mostrar el mensaje al navegante.

### index.html

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Código embebido</title>
    <script>
        // Código JavaScript embebido
        function diAlgo() {
            alert("hola");
        }
    </script>
</head>
<body>
    <h1>Ejercicio 2</h1>
    <p>Código JavaScript embebido dentro de la etiqueta &lt;script&gt;.</p>
    <script>
        diAlgo();
    </script>
</body>
</html>
```

**Concepto clave:** El código embebido funciona igual, pero dificulta la reutilización y el mantenimiento. Si se coloca antes de los elementos del DOM a los que accede, puede haber problemas de acceso; por ello, en este ejemplo se ejecuta la llamada al final del `<body>` (antes de `</body>`), siguiendo la recomendación del tema.

---

## 5. Ejercicio 3 — Práctica de laboratorio guiada (estructura profesional)

**Enunciado:** Diseñar una estructura de carpetas profesional (`mi_proyecto/` con `css/`, `js/`, `index.html`). Trasladar un bloque de script embebido que cambie el color de un botón a `js/logica.js`. Enlazarlo desde el `<head>` de `index.html` con la ruta relativa correcta (`./js/logica.js`) y comprobar en Network (F12) que devuelve `200 OK`.

### Estructura

```
mi_proyecto/
├── css/
│   └── estilos.css
├── js/
│   └── logica.js
└── index.html
```

### index.html

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Estructura profesional</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./js/logica.js"></script>
</head>
<body>
    <h1>Ejercicio 3 - Estructura profesional</h1>
    <p>Ejemplo práctico: botón que cambia de color al hacer clic.</p>
    <button id="botonCambiarColor" class="cambiar-color" type="button">
        Cambiar color
    </button>
</body>
</html>
```

### css/estilos.css

```css
body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 20px;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.cambiar-color {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
}

.cambiar-color:hover {
    background-color: #45a049;
}
```

### js/logica.js

```js
// Función para cambiar el color del botón
function cambiarColor() {
    const boton = document.getElementById('botonCambiarColor');
    boton.style.backgroundColor = '#ff6b35';
    boton.textContent = '¡Color cambiado!';
}

// Inicializar eventos cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function () {
    const boton = document.getElementById('botonCambiarColor');
    if (boton) {
        boton.addEventListener('click', cambiarColor);
    }
});
```

**Concepto clave:** Separación completa (HTML/CSS/JS). Uso de ruta relativa `./js/logica.js` para enlazar correctamente. Se usa `DOMContentLoaded` para asegurar que el DOM está construido antes de acceder a elementos (evita el problema de colocar `<script>` en `<head>` sin `defer`).

---

## 6. Ejercicio 4 — Modificando HTML con addEventListener (aplicación práctica)

Basado en el ejemplo del PDF (apartado C), con separación HTML/CSS/JS siguiendo el estilo de 1.2 (claro y efectivo).

### index.html

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Modificando HTML con addEventListener</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./js/script.js"></script>
</head>
<body>
    <h1>Modificando el código HTML</h1>
    <p id="prueba">Modificando el contenido.</p>

    <button type="button" id="btnCambiar">
        ¡Dale!
    </button>
</body>
</html>
```

### css/estilos.css

```css
body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 20px;
}

#prueba {
    font-size: 18px;
    color: #333;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
```

### js/script.js

```js
function cambiarTexto() {
    // Usar textContent si solo cambias texto (más rápido y seguro que innerHTML)
    document.getElementById('prueba').textContent = 'CAMBIANDO el contenido!';
}

document.addEventListener('DOMContentLoaded', function () {
    const boton = document.getElementById('btnCambiar');
    if (boton) {
        boton.addEventListener('click', cambiarTexto);
    }
});
```

**Concepto clave:** Se utiliza `textContent` (más seguro frente a XSS y ligeramente más eficiente) en lugar de `innerHTML`, siguiendo una buena práctica moderna. Además, el evento se registra con `addEventListener` (desacopla JS del HTML).

---

## 7. Práctica de laboratorio (estructura reforzada)

Estructura profesional con ruta relativa `./js/logica.js`, siguiendo exactamente lo indicado en el PDF.

**Concepto clave:** La ruta relativa correcta (`./`) asegura que el navegador localice los ficheros en subcarpetas. En DevTools > Network debe aparecer `logica.js` con código de estado **200 OK**.

---

## 8. Conclusión (integración JS-HTML)

| Aspecto | Embebido (`<script>` interno) | Externo (`src="..."`) |
|---|---|---|
| **Mantenimiento** | Difícil (código disperso) | **Óptimo** (un único fichero) |
| **Reutilización** | Limitada (solo esa página) | **Alta** (varias páginas) |
| **Caché** | No se cachea | **Se cachea** (mejora rendimiento) |
| **Modularidad** | Baja | **Alta** (HTML/CSS/JS separados) |
| **Recomendación** | Solo para casos muy puntuales | **Recomendada** (buenas prácticas) |

**Recomendación de ubicación:** Colocar los scripts **al final del `<body>`** o usar `defer` en `<head>` para garantizar que el DOM esté completamente cargado antes de ejecutar JavaScript.

**Nota:** Siguiendo el estilo de los ejemplos 1.1–1.4, las soluciones son **básicas, claras, efectivas y organizadas**.