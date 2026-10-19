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