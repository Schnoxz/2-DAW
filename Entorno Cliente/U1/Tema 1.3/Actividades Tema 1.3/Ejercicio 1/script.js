// Ejercicio 1 - JavaScript: la lógica, separada del HTML y del CSS.

let contador = 0;

const salida = document.getElementById('contador');
const traza = document.getElementById('traza');

function pintar() {
  salida.textContent = 'Contador: ' + contador;
}

function sumar() {
  contador++;
  pintar();
  traza.textContent = 'última acción: sumar()';
  console.log('[Ej1] Contador incrementado a ' + contador);
}

function reiniciar() {
  contador = 0;
  pintar();
  traza.textContent = 'última acción: reiniciar()';
  console.log('[Ej1] Contador reiniciado');
}

function cambiarEstilo() {
  document.body.classList.toggle('tema-oscuro');
  traza.textContent = 'última acción: cambiarEstilo()';
  console.log('[Ej1] CSS alternado · tema: ' + (document.body.classList.contains('tema-oscuro') ? 'oscuro' : 'claro'));
}

pintar();

document.getElementById('sumar').addEventListener('click', sumar);
document.getElementById('reiniciar').addEventListener('click', reiniciar);
document.getElementById('modo').addEventListener('click', cambiarEstilo);
