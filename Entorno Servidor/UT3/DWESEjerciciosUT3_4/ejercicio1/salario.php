<?php
// Ejercicio 1: recibe los datos por POST, calcula el salario nuevo y lo muestra.
// Si falta algún dato, se vuelve a index.php con el error por GET.

// Recogemos los valores comprobando antes que existen, para no generar avisos
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
$salario = isset($_POST['salario']) ? trim($_POST['salario']) : '';
$edad = isset($_POST['edad']) ? trim($_POST['edad']) : '';

// Si algún campo está vacío, o el salario o la edad no son números, no se calcula nada
if ($nombre == '' || $apellidos == '' || $salario == '' || $edad == ''
  || !is_numeric($salario) || !is_numeric($edad) || $salario < 0 || $edad < 0) {
  header('Location: index.php?error=1');
  exit;
}

// calcular_salario($salario, $edad)
// Aplica la subida que corresponde según el tramo de salario y la edad.
// Devuelve el salario nuevo.
function calcular_salario($salario, $edad)
{
  // Por encima de 2000 € no cambia nada
  if ($salario > 2000) {
    return $salario;
  }

  // Entre 1000 y 2000 € (ambos incluidos)
  if ($salario >= 1000) {
    if ($edad > 45) {
      return $salario * 1.03;
    }
    return $salario * 1.10;
  }

  // Menos de 1000 €
  if ($edad < 30) {
    // Los menores de 30 pasan a cobrar directamente 1100 €
    return 1100;
  }
  if ($edad <= 45) {
    return $salario * 1.03;
  }
  return $salario * 1.15;
}

// formatear_euros($cantidad)
// Devuelve el número con dos decimales, punto de miles y el símbolo del euro.
function formatear_euros($cantidad)
{
  return number_format($cantidad, 2, ',', '.') . ' €';
}

$nuevo_salario = calcular_salario($salario, $edad);
$subida = $nuevo_salario - $salario;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 1 - Salario calculado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-4">

    <h1 class="h3 text-primary">Salario calculado</h1>

    <div class="card shadow-sm">
      <div class="card-body">
        <p class="mb-1">
          Persona: <strong><?= htmlspecialchars($nombre . ' ' . $apellidos) ?></strong>
        </p>
        <p class="mb-1">
          Salario anterior: <?= formatear_euros($salario) ?> ·
          Edad: <?= htmlspecialchars($edad) ?> años
        </p>
        <p class="fs-5 mb-2">
          Salario nuevo: <strong><?= formatear_euros($nuevo_salario) ?></strong>
        </p>
        <p class="text-muted mb-0">
          <?php
          // Si la subida es 0 no tiene sentido hablar de aumento
          if ($subida > 0) {
            echo 'Subida aplicada: ' . formatear_euros($subida) . '.';
          } else {
            echo 'No le corresponde ninguna subida.';
          }
          ?>
        </p>
      </div>
    </div>

    <a href="index.php" class="btn btn-primary mt-3">Volver al formulario</a>

  </main>
</body>
</html>
