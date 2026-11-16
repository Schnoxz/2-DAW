// cryptoRandomFloat()
// Genera un decimal entre 0 (incluido) y 1 (excluido) con la entropía del
// sistema operativo en lugar del generador pseudoaleatorio del motor de JS.
// No recibe parámetros. Devuelve un Number.
function cryptoRandomFloat() {
  // Uint32Array(1) reserva un entero sin signo de 32 bits, de 0 a 4.294.967.295
  const buffer = new Uint32Array(1);

  // getRandomValues() rellena el array en el sitio: no devuelve nada
  crypto.getRandomValues(buffer);

  // Se divide entre 2^32 para que el resultado caiga siempre en [0, 1).
  // Hay que usar buffer[0]: dividir el array entero da NaN.
  return buffer[0] / 4294967296;
}
