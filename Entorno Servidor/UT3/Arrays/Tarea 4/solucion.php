<?php

$anioActual = (int) date('Y');
$diaElegido = $_POST['dia'] ?? '';
$mesElegido = $_POST['mes'] ?? '';
$anioElegido = $_POST['anio'] ?? '';

?>
<form method="post">
    <label for="dia">Día</label>
    <select name="dia" id="dia">
        <?php
        $dias = range(1, 31);
        foreach ($dias as $dia) {
            $sel = ($dia == $diaElegido) ? ' selected' : '';
            echo "<option value=\"$dia\"$sel>$dia</option>";
        }
        ?>
    </select>

    <label for="mes">Mes</label>
    <select name="mes" id="mes">
        <?php
        for ($mes = 1; $mes <= 12; $mes++) {
            $sel = ($mes == $mesElegido) ? ' selected' : '';
            echo "<option value=\"$mes\"$sel>$mes</option>";
        }
        ?>
    </select>

    <label for="anio">Año</label>
    <select name="anio" id="anio">
        <?php
        $anio = 1900;
        while ($anio <= $anioActual) {
            $sel = ($anio == $anioElegido) ? ' selected' : '';
            echo "<option value=\"$anio\"$sel>$anio</option>";
            $anio++;
        }
        ?>
    </select>

    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($diaElegido !== '' && $mesElegido !== '' && $anioElegido !== '') {
        if (checkdate((int) $mesElegido, (int) $diaElegido, (int) $anioElegido)) {
            echo "<p>Has nacido el $diaElegido/$mesElegido/$anioElegido</p>";
        } else {
            echo "<p>Esa fecha no existe</p>";
        }
    } else {
        echo "<p>Elige los tres campos</p>";
    }
}
?>