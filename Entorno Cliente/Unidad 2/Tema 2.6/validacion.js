// Actividad 3: "Validación de Entrada con do...while"

let codigo;

do {
    codigo = prompt("Introduce un código numérico de 4 dígitos:");

    // Cancelar devuelve null asi que no hay nada que validar, por lo qque se sale
    if (codigo === null) break;

    // Se repite mientras no sean exactamente 4 dígitos.
} while (!/^[0-9]{4}$/.test(codigo));

// Si se ha introducido un código válido, se muestra en consola
if (codigo !== null) {
    console.log("Código válido introducido:", codigo);
}
