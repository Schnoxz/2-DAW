// Ejercicio 7 - Los tres botones del 1.2·7, cada uno en su función

// El párrafo de estado, que se modificará desde JavaScript.
const estado = document.getElementById('estado');

// Botón 1: traza con la hora del sistema.
function consola() {
  console.log('Hora del sistema: ' + new Date().toLocaleTimeString());
}

// Botón 2: cambia el texto y el fondo del párrafo de estado.
function estilo() {
  estado.innerHTML = 'Sistema Activo';        // contenido
  estado.style.backgroundColor = 'green';     // fondo (camelCase)
}

// Botón 3: ventana emergente modal de aviso.
function alerta() {
  window.alert('El proceso ha concluido.');
}
