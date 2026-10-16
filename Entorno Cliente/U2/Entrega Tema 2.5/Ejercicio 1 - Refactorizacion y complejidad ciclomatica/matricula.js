// Codigo refactorizado de calcularMatricula (Tema 2.5)

function calcularMatricula(datos) {
    // Comprobaciones al principio: si algo no vale, se sale aqui mismo
    if (!datos || typeof datos !== "object") {
        return { valido: false, error: "Parámetros de matrícula inválidos." };
    }

    if (typeof datos.precioBase !== "number" || datos.precioBase <= 0) {
        return { valido: false, error: "El precio base debe ser un número positivo." };
    }

    if (!["general", "desempleado", "socio"].includes(datos.tipoEstudiante)) {
        return { valido: false, error: "Tipo de estudiante no reconocido." };
    }

    // Calculo final, ya sin nada que lo envuelva
    let descuentoPorcentaje = 0;

    if (datos.tipoEstudiante === "desempleado") {
        descuentoPorcentaje = 0.30;
    } else if (datos.tipoEstudiante === "socio") {
        descuentoPorcentaje = 0.15;
    }

    let total = datos.precioBase * (1 - descuentoPorcentaje);

    if (datos.codigoDescuento === "WEB2026") {
        total = total - 10;
    }

    if (total < 0) {
        total = 0;
    }

    return { valido: true, total: total };
}

// Se exporta para poder usarla desde el banco de pruebas
module.exports = calcularMatricula;
