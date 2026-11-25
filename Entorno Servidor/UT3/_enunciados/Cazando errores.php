<?php
// EJERCICIO DE REVISIÓN DE CÓDIGO (T3): Encuentra y corrige los 8 errores

$talleres = [
    "php" => "Desarrollo Backend con PHP",
    "js"  => "JavaScript Moderno",
    "bd"  => "Diseño de Bases de Datos"
];

$errores = [];
$registroCompletado = false;

// 1. Comprobamos si el formulario se ha enviado por POST
if ($_SERVER['METHOD_REQUEST'] == 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $tallerElegido = $_POST['taller'] ?? '';
    $lenguajes = $_POST['lenguajes'] ?? [];

    // 2. Validación de campos
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }

    // Comprobamos que el taller elegido exista en las claves del array $talleres
    if (!in_array($tallerElegido, $talleres)) {
        $errores[] = "El taller seleccionado no es válido.";
    }

    if (count($lenguajes) = 0) {
        $errores[] = "Debes marcar al menos un lenguaje.";
    }

    if (empty($errores)) {
        $registroCompletado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción Hackathon</title>
</head>
<body>
    <h2>Inscripción al Hackathon</h2>

    <!-- Mostrar errores si existen -->
    <?php if (!empty($errores)): ?>
        <ul style="color: red;">
            <?php foreach ($errores as $indice => $mensaje) ?>
                <li><?= $mensaje ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Mostrar resumen si todo es correcto -->
    <?php if ($registroCompletado): ?>
        <div style="border: 1px solid green; padding: 10px;">
            <p>¡Gracias, <strong><?= $nombre ?></strong>!</p>
            <p>Taller: <?= $talleres[$tallerElegido] ?></p>
            <p>Lenguajes: <?= implode(", ", $lenguajes) ?></p>
        </div>
    <?php endif; ?>

    <!-- Formulario de inscripción -->
    <form action="inscripcion_hackathon.php">
        <p>
            <label>Nombre completo:</label><br>
            <input type="text" name="nombre" value="<?= $nombre ?>">
        </p>

        <p>
            <label>Elige un taller:</label><br>
            <select name="taller">
                <?php foreach ($talleres as $titulo => $codigo): ?>
                    <option value="<?= $codigo ?>"><?= $titulo ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label>Lenguajes que conoces:</label><br>
            <input type="checkbox" name="lenguajes" value="PHP"> PHP
            <input type="checkbox" name="lenguajes" value="Python"> Python
            <input type="checkbox" name="lenguajes" value="Java"> Java
        </p>

        <button type="submit">Enviar inscripción</button>
    </form>
</body>
</html>