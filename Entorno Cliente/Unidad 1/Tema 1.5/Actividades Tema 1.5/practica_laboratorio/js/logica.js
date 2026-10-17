function mostrarMensaje() {
    const mensaje = document.getElementById('mensaje');
    if (mensaje) {
        mensaje.textContent = '¡Script externo cargado correctamente!';
        mensaje.style.color = 'green';
        mensaje.style.fontWeight = 'bold';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const boton = document.getElementById('btnMostrar');
    if (boton) {
        boton.addEventListener('click', mostrarMensaje);
    }
});