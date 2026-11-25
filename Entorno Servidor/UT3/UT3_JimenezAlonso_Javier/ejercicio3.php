<?php
// Práctica guiada UT3 - Ejercicio 3
// Conductor: Javier Jiménez Alonso | Navegante: pendiente de confirmar compañero/a
// Control de excepciones con try / catch / finally.

// validarEdadRegistro($edad)
// Comprueba que la edad sea un número y que sea mayor o igual que 18.
// Devuelve true si es válida y lanza una Exception si no lo es.
function validarEdadRegistro($edad)
{
  // empty() cubre el string vacío y el 0; is_numeric() descarta las letras.
  if (empty($edad) || !is_numeric($edad)) {
    throw new Exception("Error: el dato introducido no es un valor numérico válido.");
  }

  if ($edad < 18) {
    throw new Exception("Error: debes ser mayor de edad para completar el registro.");
  }

  return true;
}

// Casos de prueba: uno válido, uno menor, uno con letras, uno vacío y otro válido.
$casosPrueba = [25, 15, "abc", "", 40];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UT3 · Ejercicio 3</title>
  <style>
    body { font-family: Segoe UI, Arial, sans-serif; max-width: 720px; margin: 2rem auto; padding: 0 1rem; color: #0f172a; }
    ul { list-style: none; padding: 0; }
    li { border-bottom: 1px solid #e2e8f0; padding: .6rem 0; }
    .ok { color: #166534; }
    .error { color: #b91c1c; }
    .fin { color: #64748b; font-size: .9rem; }
  </style>
</head>
<body>

<h1>Ejercicio 3: excepciones</h1>

<ul>
<?php
// Cada caso se prueba por separado: si uno falla, el catch lo recoge y el
// bucle sigue con el siguiente.
foreach ($casosPrueba as $edad) {
  echo "<li>";

  try {
    validarEdadRegistro($edad);
    echo "<span class='ok'>Edad $edad válida: registro permitido.</span>";
  } catch (Exception $e) {
    // getMessage() devuelve el texto que se puso en el throw.
    echo "<span class='error'>" . $e->getMessage() . " (edad recibida: \"" . $edad . "\")</span>";
  } finally {
    // finally se ejecuta siempre, haya error o no.
    echo "<div class='fin'>Comprobación finalizada</div>";
  }

  echo "</li>";
}
?>
</ul>

</body>
</html>
