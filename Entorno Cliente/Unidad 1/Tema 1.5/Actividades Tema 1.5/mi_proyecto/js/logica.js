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