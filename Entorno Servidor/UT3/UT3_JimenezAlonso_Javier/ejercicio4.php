<?php
// Práctica guiada UT3 - Ejercicio 4
// Conductor: Javier Jiménez Alonso | Navegante: pendiente de confirmar compañero/a
// Formulario que se envía a sí mismo y calcula la nota media.

// Estos valores se rellenan cuando llega el formulario. Empiezan vacíos para
// que la primera visita muestre los campos en blanco.
$nombre = "";
$nota1 = "";
$nota2 = "";
$errores = [];
$resultado = "";

// Solo se procesa si la petición es POST, no en la primera carga de la página.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // filter_input recoge el dato ya saneado; nunca se toca $_POST directamente.
  // FILTER_SANITIZE_SPECIAL_CHARS convierte los caracteres peligrosos en entidades.
  $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_SPECIAL_CHARS);
  $nota1 = filter_input(INPUT_POST, "nota1", FILTER_SANITIZE_SPECIAL_CHARS);
  $nota2 = filter_input(INPUT_POST, "nota2", FILTER_SANITIZE_SPECIAL_CHARS);

  // Si el campo no llega, filter_input devuelve null; lo paso a cadena vacía
  // para poder usar las mismas comprobaciones.
  if ($nombre === null) { $nombre = ""; }
  if ($nota1 === null) { $nota1 = ""; }
  if ($nota2 === null) { $nota2 = ""; }

  $nombre = trim($nombre);
  $nota1 = trim($nota1);
  $nota2 = trim($nota2);

  // Validaciones: nombre obligatorio y las dos notas numéricas entre 0 y 10.
  if ($nombre === "") {
    $errores[] = "El nombre no puede estar vacío.";
  }
  if (!is_numeric($nota1) || $nota1 < 0 || $nota1 > 10) {
    $errores[] = "La primera nota debe ser un número entre 0 y 10.";
  }
  if (!is_numeric($nota2) || $nota2 < 0 || $nota2 > 10) {
    $errores[] = "La segunda nota debe ser un número entre 0 y 10.";
  }

  // Solo si no hay errores se calcula la media y la calificación.
  if (count($errores) == 0) {
    $media = ($nota1 + $nota2) / 2;

    if ($media < 5) {
      $calificacion = "Suspenso";
    } elseif ($media < 7) {
      $calificacion = "Aprobado";
    } elseif ($media < 9) {
      $calificacion = "Notable";
    } else {
      $calificacion = "Sobresaliente";
    }

    $resultado = "Alumno: <strong>$nombre</strong> · Nota media: "
      . number_format($media, 2, ",", ".") . " · Calificación: <strong>$calificacion</strong>";
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UT3 · Ejercicio 4</title>
  <style>
    body { font-family: Segoe UI, Arial, sans-serif; max-width: 620px; margin: 2rem auto; padding: 0 1rem; color: #0f172a; }
    form { border: 1px solid #cbd5e1; border-radius: 8px; padding: 1.2rem; margin-top: 1rem; }
    label { display: block; margin-top: .8rem; font-weight: 600; }
    input { width: 100%; padding: .45rem; margin-top: .3rem; border: 1px solid #94a3b8; border-radius: 6px; box-sizing: border-box; }
    button { margin-top: 1rem; padding: .5rem 1.2rem; background: #1d4ed8; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
    .aviso { color: #b91c1c; }
    .ok { color: #166534; }
  </style>
</head>
<body>

<h1>Cálculo de nota media</h1>

<?php
// Mensajes de error: se listan todos para que el usuario corrija de una vez.
if (count($errores) > 0) {
  echo "<ul class='aviso'>";
  foreach ($errores as $error) {
    echo "<li>$error</li>";
  }
  echo "</ul>";
}

// Si todo ha ido bien, aquí está la media con la calificación.
if ($resultado !== "") {
  echo "<p class='ok'>$resultado</p>";
}
?>

<form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
  <label for="nombre">Nombre</label>
  <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>">

  <label for="nota1">Nota 1</label>
  <input type="text" id="nota1" name="nota1" value="<?= $nota1 ?>">

  <label for="nota2">Nota 2</label>
  <input type="text" id="nota2" name="nota2" value="<?= $nota2 ?>">

  <button type="submit">Calcular media</button>
</form>

</body>
</html>
